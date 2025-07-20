<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
//use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Validator;
use App\Models\client\Comment; //model
use Illuminate\Support\Facades\Validator;
use DB;

class ReviewController extends Controller
{
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   
		if($request->session()->has('currentClient') && $request->ajax()){
			 
			$this->validate($request, [
				'comment_author' => 'required|regex:/^[A-Za-z ]/',
				'comment_author_phone' => 'required|numeric|digits_between:10,10',
				'comment_author_email' => 'required|email',
				'comment_content' => 'required',
				's_rating' => 'required|numeric|max:5|min:1',
			]);
			
	 
			$currentClient = $request->session()->get('currentClient');
			$dd = DB::table('comments')
						->select(DB::raw("DATEDIFF(DATE(now()),(SELECT max(DATE(`created_at`)) FROM `comments` WHERE `comment_author_email`='".$request->input('comment_author_email')."' AND `comment_client_ID`=".$currentClient->id.")) as date"))
						->take(1)
						->get();
	 
			if(!empty($dd)){
				if($dd[0]->date <= 30 && !is_null($dd[0]->date)){
					return response()->json(["status"=>0,"message"=>"You cannot give review more than one in a month"]);
				}
			}
			
			$comment = new Comment();
			$comment->comment_client_ID = $currentClient->id;
			$comment->comment_author = $request->input('comment_author');
			$comment->comment_author_phone = $request->input('comment_author_phone');
			$comment->comment_author_email = $request->input('comment_author_email');
			$comment->comment_content = $request->input('comment_content');
			$comment->rating = $request->input('s_rating');
			$comment->comment_author_IP = $request->ip();
			if($comment->save()){
				return response()->json(["status"=>1,"message"=>"Review successfully submitted."]);
			}else{
				return response()->json(["status"=>0,"message"=>"Error occured."]);
			}
		}
		return response()->json(["status"=>0,"message"=>"Client not found or invalid ajax request."]);
    }        
}
