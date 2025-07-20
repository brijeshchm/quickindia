<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Client\Client; //model
use App\Models\Client\Comment; //model
use App\Models\Client\AssignedKWDS; //model
 
use App\Models\Citieslists; //model
use DB;
use Session;

class ClientDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    { 	 
      
      $clients = Client::where('business_slug',$slug)->get();	
      $cities = Citieslists::all();		 	
		  $clientLists =  Client::where('logo','<>','')->where('business_intro','<>','')->where('city','noida')->where('paid_status','1')->limit(12)->get();		
		  if(count($clients)>0){
			foreach($clients as $c){
				$client = $c;
				break;
			}
			Session::put('currentClient', $client);
			$comments = Comment::where('comment_client_ID',$client->id)
							   ->where('comment_approved',1)
							   ->orderBy('created_at','desc')			 
							   ->paginate(10);
 
			$sum = Comment::where('comment_client_ID',$client->id)
							   ->where('comment_approved',1)
							   ->sum('rating');
			$count = Comment::where('comment_client_ID',$client->id)
							   ->where('comment_approved',1)
							   ->count();
			$avgRating = 0;
			if($count!=0)
				$avgRating = ($sum/($count*5))*5;
			//'(SELECT COUNT(*) as count, SUM(`rating`) as sum_rating, MONTH(DATE(`created_at`)) as month, DATE(`created_at`) as created_at FROM `comments` WHERE `comment_client_ID`='.$client->id.' AND `comment_approved`=1 AND DATE(`created_at`)>=\':date\' GROUP BY MONTH(DATE(`created_at`)) ORDER BY created_at desc LIMIT 0,3) AS temp'
			$graphQuery = Comment::select(DB::raw('*'))
				->from(DB::raw('(SELECT COUNT(*) as count, SUM(`rating`) as sum_rating, MONTH(DATE(`created_at`)) as month, DATE(`created_at`) as created_at FROM `comments` WHERE `comment_client_ID`='.$client->id.' AND `comment_approved`=1 GROUP BY MONTH(DATE(`created_at`)) ORDER BY created_at desc LIMIT 0,3) AS temp'))
				->orderBy('created_at')
				->get();
			$barGraphQuery = Comment::select(DB::raw('*'))
				->from(DB::raw('(SELECT COUNT(*) as count, SUM(`rating`) as sum_rating, rating FROM `comments` WHERE `comment_client_ID`='.$client->id.' AND `comment_approved`=1 GROUP BY `rating`) AS temp'))
				->orderBy('rating','desc')
				->get();
			 
			$assignedKwds = DB::table('assigned_kwds')
							  ->join('keyword','keyword.id','=','assigned_kwds.kw_id')
								->join('citylists','assigned_kwds.city_id','=','citylists.id')
							  ->join('child_category','child_category.id','=','assigned_kwds.child_cat_id')
							  ->select('keyword.keyword','citylists.city','child_category.child_category as child_category_name')
							  ->where('assigned_kwds.client_id','=',$client->id)
								->groupBy('kw_id')
								->get();	

$assignedCity = DB::table('assigned_kwds')
							  ->join('keyword','keyword.id','=','assigned_kwds.kw_id')
								->join('citylists','assigned_kwds.city_id','=','citylists.id')
							  ->join('child_category','child_category.id','=','assigned_kwds.child_cat_id')
							  ->select('keyword.keyword','citylists.city','child_category.child_category as child_category_name')
							  ->where('assigned_kwds.client_id','=',$client->id)
								->groupBy('assigned_kwds.city_id')
								->get();
		 
 
			return view('client.client-detail',['client'=>$client,'cities'=>$cities,'comments'=>$comments,'count'=>$count,'sum'=>$sum,'avgRating'=>number_format($avgRating, 1, '.', ''),'graphQuery'=>$graphQuery,'barGraphQuery'=>$barGraphQuery,'assignedKwds'=>$assignedKwds,'clientLists'=>$clientLists,'clients'=>$clients,'assignedCity'=>$assignedCity]);
		}else{
			
			return view('client.errorpage',['clientLists'=>$clientLists]);
		}
    }
      
}
