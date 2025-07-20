<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;
use DB;

use App\Models\City; //Model
use App\Models\Citieslists; //Model
use App\Models\Zone;

class CitiesController extends Controller
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
    public function index(Request $request)
    {
    
			if($request->ajax()){
		 
			$cities = Citieslists::orderBy('city','desc');
			if($request->input('search.value')!=''){
				 
				$cities = $cities->where(function($query) use($request){
					$query->orWhere('city','LIKE','%'.$request->input('search.value').'%')						 
						  ->orWhere('state','LIKE','%'.$request->input('search.value').'%');
				});
			}
		 
		 
			$cities = $cities->paginate($request->input('length'));
			$returnLeads = $data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $cities->total();
			$returnLeads['recordsFiltered'] = $cities->total();
			$returnLeads['recordCollection'] = [];
			foreach($cities as $city){
							
				$action = '';
				$separator = ''; 
					$action .= $separator.'<a href="javascript:void(0)" onclick="javascript:updateCity('.$city->id.',this)"><i class="fa fa-refresh fa-fw" aria-hidden="true"></i></a>';
					$separator = ' | ';			 
					 
			 
			 	if($request->user()->current_user_can('administrator')){
				 
					$action .= $separator.'<a href="javascript:void(0)" onclick="javascript:deleteCity('.$city->id.',this)"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></a>';
					$separator = ' | ';		
					
					 		
				}
							
				$data[] = [		
					"<th><input type='checkbox' class='check-box' value='$city->id'></th>",				
			 		$city->city,					 
					$city->state,
					$action
					
				];	
				$returnLeads['recordCollection'][] = $city->id;
			}
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
			}else{
		//echo "<pre>";print_r($state);die;
		 //
		 
			$search = [];
			if($request->has('search')){
			$search = $request->input('search');
			}
	//	$citiess = Cities::all();
		$citiess = Citieslists::all();
		$states = Citieslists::select('state')->groupBy('state')->get();
		return view('admin.citylist.citieslist',['allCities'=>$citiess,'search'=>$search,'states'=>$states]);
			}
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
		if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('add_city'))){
			return view('errors.unauthorised');
		}
		//echo "<pre>";print_r($_POST);die;
        $validator = Validator::make($request->all(), [
            'city' => 'required|unique:citylists,city|min:3|max:25',
            'state' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect("developer/cities")
                        ->withErrors($validator)
                        ->withInput();
        }
	 
		$city = new Citieslists;
		$city->city = $request->input('city');
		$city->state = $request->input('state');
		$city->latitude = $request->input('latitude');
		$city->longitude = $request->input('longitude');		 
		if($city->save()){
		$this->success_msg .= 'City added succesfully!';
		$request->session()->flash('success_msg', $this->success_msg);
		}
		return redirect("developer/cities");
    }

  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
       
		if($request->ajax()){
			if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('edit_city'))){
				return response()->json(['status'=>0,'msg'=>'Unauthorised access'],200);
			}
			$city = Citieslists::find($id);
			$checked = '';
			 
			$states = Citieslists::where('')->groupby('state')->get();
			$statesHTML = '';
			if(!empty($states)){
				foreach($states as $state){
					
					if($state->state == $city->state){
						$statesHTML .= '<option value="'.$state->state.'" selected>'.$state->state.'</option>';
					}else{
						$statesHTML .= '<option value="'.$state->state.'">'.$state->state.'</option>';
					}
				}
			}
			$html= '<input type="hidden" name="_token" value="'.csrf_token().'">			
			<input type="hidden" value="'.$city->id.'" name="id">
				 
				<label for="State">State:</label>	
				<select type="text" class="form-control" name="state" >
				<option value="">Select State</option> 
				 '.$statesHTML.'								
				</select>			
				<label>Enter the city name:</label>
				<input type="text" name="city" class="form-control" value="'.$city->city.'">			
				<label>Enter Latitude:</label>
				<input type="text" name="latitude" class="form-control" value="'.$city->latitude.'">
				<label>Enter longitude:</label>
				<input type="text" name="longitude" class="form-control" value="'.$city->longitude.'">';
			
			
			
			return response()->json(['status'=>1,'msg'=>$html]);
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
		if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('edit_city'))){
			return view('errors.unauthorised');
		}
	 
		 
			if($request->input('id') !=''){
			$validator = Validator::make($request->all(), [
			 
				'city' 	=> 'required|max:255|unique:citylists,city,'.$request->input('id').',id',	
				'state' => 'required'
			]);

			if ($validator->fails()) {
				return redirect("developer/cities")
							->withErrors($validator)
							->withInput();
			}			 
			if($request->input('id') !=''){
				$id= $request->input('id');
				$city = Citieslists::find($id);
				$city->city = $request->input('city');
				$city->state = $request->input('state');
				$city->latitude = $request->input('latitude');
				$city->longitude = $request->input('longitude');	
				if($city->save()){
				$this->success_msg .= 'City updated succesfully!';
				$request->session()->flash('success_msg', $this->success_msg);
				}
				return redirect("developer/cities");
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
		if(!($request->user()->current_user_can('administrator')|| $request->user()->current_user_can('delete_city'))){
				return response()->json(['status'=>0,'msg'=>'Unauthorised access'],200);
			}
			Citieslists::destroy($id);
			return response()->json(['status'=>1,'msg'=>'City deleted succesfully!!']);
		} 
    }
	
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAjaxCities(Request $request)
    {
        //
		header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
		if($request->wantsJson()){
			//return $request->input('q');
			if($request->has('q')){
				$cities = DB::table('citylists')->select('id','city')->where('city','LIKE','%'.$request->input('q').'%')->get();
				//$cities = Cities::select('id','city')->where('city','LIKE','%'.$request->input('q').'%')->get();
				
				if(!$cities){
				$cities = Zone::select('id','zone')->where('zone','LIKE','%'.$request->input('q').'%')->get();
				}
			}else{
				$cities = Citieslists::select('id','city')->get();
				
			//	$cities = Citieslists::select('id','city')->whereIn('city',  array('Noida', 'Delhi','Gurgaon','Faridabad','Ghaziabad','Mumbai','Ahmedabad','Bangalore','lucknow'))->get();
			}
			
			//echo "<pre>";print_r($cities);die;
			return response()->json(['status'=>1,'cities'=>$cities]);
		} 
    }
}
