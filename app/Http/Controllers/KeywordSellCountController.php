<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;

use DB;

use App\Models\KeywordSellCount; //Model

class KeywordSellCountController extends Controller
{
	protected $danger_msg = '';
	protected $success_msg = '';
	protected $warning_msg = '';
	protected $info_msg = '';
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$keywordSellCounts = KeywordSellCount::all();
		return view('admin/keyword_sell_count',['keywordSellCounts'=>$keywordSellCounts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|alpha|unique:keyword_sell_count',
            'count' => 'required|integer',
            'cat1_price' => 'required|numeric|between:0,99.99',
            'cat2_price' => 'required|numeric|between:0,99.99',
            'cat3_price' => 'required|numeric|between:0,99.99'
        ]);

        if ($validator->fails()) {
            return redirect("developer/keyword_sell_count")
                        ->withErrors($validator)
                        ->withInput();
        }
		
		$keywordSellCount = new KeywordSellCount;
		$keywordSellCount->name = $request->input('name');
		$keywordSellCount->slug = generate_slug($request->input('name'), '-');
		$keywordSellCount->count = $request->input('count');
		$keywordSellCount->cat1_price = $request->input('cat1_price');
		$keywordSellCount->cat2_price = $request->input('cat2_price');
		$keywordSellCount->cat3_price = $request->input('cat3_price');
		$keywordSellCount->save();
		$this->success_msg .= 'keyword Sell Count added succesfully!';
		$request->session()->flash('success_msg', $this->success_msg);
		return redirect("developer/keyword_sell_count");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
		if($request->ajax()){
			$keywordSellCount = KeywordSellCount::find($id);
			$request->session()->put('keywordSellCountToUpdate', $keywordSellCount->id);
			//return response()->json(['status'=>1,'msg'=>'<input type="hidden" name="_token" value="'.csrf_token().'"><input type="hidden" value="'.$city->id.'" name="id"><label>Enter the city name:</label><input type="text" name="city" class="form-control" value="'.$city->city.'">']);
			return response()->json(['status'=>1,'keywordSellCount'=>$keywordSellCount]);
		}		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
		if($request->session()->has('keywordSellCountToUpdate')){

			$validator = Validator::make($request->all(), [
				'name' => 'required|max:255|alpha|unique:keyword_sell_count,name,'.$request->input('id'),
				'count' => 'required|integer',
				'cat1_price' => 'required|numeric|between:80,199.99',
				'cat2_price' => 'required|numeric|between:50,69.99',
				'cat3_price' => 'required|numeric|between:20,49.99'				
			]);

			if ($validator->fails()) {
				return redirect("developer/keyword_sell_count")
							->withErrors($validator)
							->withInput();
			}		
			
			$keywordSellCountToUpdate = $request->session()->get('keywordSellCountToUpdate');
			if($keywordSellCountToUpdate == $request->input('id')){
				$keywordSellCount = KeywordSellCount::find($keywordSellCountToUpdate);
				$keywordSellCount->name = $request->input('name');
				$keywordSellCount->count = $request->input('count');
				$keywordSellCount->cat1_price = $request->input('cat1_price');
				$keywordSellCount->cat2_price = $request->input('cat2_price');
				$keywordSellCount->cat3_price = $request->input('cat3_price');				
				$keywordSellCount->save();
				$this->success_msg .= 'Keyword Sell Count updated succesfully!';
				$request->session()->flash('success_msg', $this->success_msg);
				return redirect("developer/keyword_sell_count");
			}
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
		if($request->ajax()){
			KeywordSellCount::destroy($id);
			return response()->json(['status'=>1,'msg'=>'Keyword Sell Count deleted succesfully!!']);
		} 
    }
}
