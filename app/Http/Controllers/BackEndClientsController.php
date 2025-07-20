<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Validator;
use Illuminate\Support\Facades\Input; 
use Image;
//use Intervention\Image\ImageManagerStatic as Image;
use Excel;
use Mail;
use Auth;
use Response;
use App\Models\Client\Client; //model
use App\Models\Keyword; //model
use App\Models\Client\AssignedKWDS; //model
use App\Models\KeywordSellCount; //model
use App\Models\City; //model
use App\Models\Citieslists; //model
use App\Models\ClientCategory; //model
use App\Models\AssignedClientCategory; //model
//use App\AssignedClientCity; //model
use App\Models\AssignedLead; //model
use App\Models\AssignedArea; //model
use App\Models\AssignedZone; //model
use App\Models\AssigneddArea; //model
use App\Models\Meeting; //model
use App\Models\Transaction; //model
use Carbon\Carbon; //model
use App\Models\ParentCategory; //Model
use App\Models\ChildCategory; //Model
use App\Models\PaymentHistory; //Model
use App\Models\Modesdetails; //Model
use App\Models\Banksdetails; //Model
use App\Models\Zone; //Model
use Exception;

class BackEndClientsController extends Controller
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
    public function index(Request $request,$id=null)
    {
		
		//echo "<pre>";print_r($_GET);echo "index";die;
		 
		if(!is_null($id)){
			$clients = Client::where('username',$id)->get();
			return view('admin.client_detail',['clients'=>$clients,'request'=>$request]);
		}
		if($request->has('filter')){
			$query = '';
			$query .= "SELECT * FROM `clients` WHERE 1=1";
			if(null!==$request->input('uid')&&!empty($request->input('uid'))){
				$query .= " AND `username`='".$request->input('uid')."'";
			}
			if(null!==$request->input('b_name')&&!empty($request->input('b_name'))){
				$query .= " AND `business_name` LIKE '%".$request->input('b_name')."%'";
			}
			if(null!==$request->input('email')&&!empty($request->input('email'))){
				$query .= " AND `email`='".$request->input('email')."'";
			}
			if(null!==$request->input('mobile')&&!empty($request->input('mobile'))){
				$query .= " AND `mobile`='".$request->input('mobile')."'";
			}
			$query .= " AND `deleted_at` IS NULL ORDER BY `id` DESC";
			//return $clients = Client::select(DB::raw($query))->toSql();
			//return $clients = DB::raw($query);
			$clients = DB::select($query);
		}else{
			$clients = Client::all();
			$citylist = Citieslists::all();
			$clientCategories = ParentCategory::all();
		}
		
		
		$search = [];
		if($request->has('search')){
			$search = $request->input('search');
		}
        return view('admin.clients_list',['clients'=>$clients,'request'=>$request,'citylist'=>$citylist,'clientCategories'=>$clientCategories,'search'=>$search]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletedClients(Request $request,$id=null)
    {
		
		 
		if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('client_delete'))){
			return view('errors.unauthorised');
		}
		if(!is_null($id)){
			$clients = Client::withTrashed()->where('username',$id)->get();
			return view('admin.client_detail',['clients'=>$clients,'request'=>$request]);
		}
		if($request->has('filter')){
			$query = '';
			$query .= "SELECT * FROM `clients` WHERE 1=1";
			if(null!==$request->input('uid')&&!empty($request->input('uid'))){
				$query .= " AND `username`='".$request->input('uid')."'";
			}
			if(null!==$request->input('b_name')&&!empty($request->input('b_name'))){
				$query .= " AND `business_name` LIKE '%".$request->input('b_name')."%'";
			}
			if(null!==$request->input('email')&&!empty($request->input('email'))){
				$query .= " AND `email`='".$request->input('email')."'";
			}
			if(null!==$request->input('mobile')&&!empty($request->input('mobile'))){
				$query .= " AND `mobile`='".$request->input('mobile')."'";
			}
			$query .= " AND `deleted_at` IS NOT NULL ORDER BY `id` DESC";
			//return $clients = Client::select(DB::raw($query))->toSql();
			//return $clients = DB::raw($query);
			$clients = DB::select($query);
		}else{
			$clients = Client::onlyTrashed()->get();
		}
        return view('admin.deleted_clients',['clients'=>$clients,'request'=>$request]);
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.client_register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		if($request->has('initial_form_submit')){
		 
			
			//echo "<pre>";print_r($_POST);die;
			$client = new Client;
			$messages = ['mobile.regex' => 'Mobile number cannot start with 0.'];
			$validator = Validator::make($request->all(), [
				//'business_name' => 'required|regex:/[A-Za-z0-9 ]+/|unique:clients,business_name,NULL,id,mobile,'.$request->input('mobile').',city,'.$request->input('city'),
				'business_name' => 'required|regex:/[A-Za-z0-9 ]+/',
				'mobile' => 'required|numeric|digits:10|regex:/^[1-9]+/|unique:clients,mobile,NULL,id',
				'city' => 'required|max:50',
				'email' => 'required|email'
			],$messages);
			if ($validator->fails()) {
				return redirect("/developer/clients/register")
							->withErrors($validator)
							->withInput();
			}else{
				// GENERATING SLUG
				// ***************
				$business_slug = NULL;
				$business_slug = generate_slug($request->input('business_name'));
				if(is_null($business_slug)){
					return redirect("/developer/clients/register")
								->withErrors($validator)
								->withInput();					
				}
				$slugExists = DB::table('clients')
					->select(DB::raw('business_slug'))
					->where('business_slug', 'like', '%'.$business_slug.'%')
					->orderBy('id','desc')
					->get();
				if(!empty($slugExists)){
					$business_slug = $slugExists[0]->business_slug;
					$business_slug = explode("-",$business_slug);
					$end = end($business_slug);
					reset($business_slug);
					if(!is_numeric($end)){
						$business_slug[] = 1;
					}else{
						++$end;
						$business_slug[count($business_slug)-1] = $end;
					}
					$business_slug = implode("-",$business_slug);
				}
			}
			
			$client->business_name = $request->input('business_name');
			$client->business_slug = $business_slug;
	 
			$pass = rand(000001,999999);
			$client->password = bcrypt($pass);
			$client->first_name = $request->input('first_name');
			$client->last_name = $request->input('last_name');
			$client->city = $request->input('city');
			$cityId = Citieslists::where('city',$request->input('city'))->first();
			if(!empty($cityId)){
				$client->city_id = $cityId->id;
			}
			$client->mobile = $request->input('mobile');
			$client->email = $request->input('email');
			$client->max_kw = 999;
			
	 
			$client->created_by = $request->user()->id;
			 
			
			if($client->save()){
				$client = Client::find($client->id);
				$cityname = $request->input('city');
				$clientIDToAppend = $clientID = $client->id;
				if(strlen((string)$clientID)<4){
					$clientIDToAppend = str_pad($clientIDToAppend, 4, '0', STR_PAD_LEFT);
				}
				$client->username = $usr = strtoupper(substr($cityname,0,2)).$clientIDToAppend;
				$client->save(); 
				$client = Client::find($clientID);
				//$this->sendUandP($client,$usr,$pass);
				$smsMessage = "Thanks for registering with quickindia.
				%0D%0ALogin %26 Update your profile to get more leads to grow your business.
				%0D%0A%0D%0ABusiness Name:".$client->business_name."
				%0D%0AURL:www.quickindia.in
				%0D%0AUID:".$client->username."
				%0D%0APassword:".$pass."
				%0D%0A--
				%0D%0ARegards
				%0D%0Aquickindia Team";
			//	sendSMS($client->mobile,$smsMessage);
				$this->success_msg .= 'Business registered successfully!';
				$request->session()->flash('success_msg', $this->success_msg);
				$request->session()->flash('registration_status', 1);
				$request->session()->flash('show_first_form', 1);
				$request->session()->flash('clientData', $client);
				return redirect("/developer/clients/update/".$client->username);
			}else{
				$this->danger_msg .= 'Business not registered!';
				$request->session()->flash('danger_msg', $this->danger_msg);
				return redirect("/developer/clients/register");
			}			
		}
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		
		if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('client_update') )){
				return view('errors.unauthorised');
			} 
		if(!is_null($id)){
			 
		    $clients = Client::withTrashed()->where('username',$id)->get();
			if(!empty($clients)){
				foreach($clients as $c){
					$client = $c;
					break;
				}
			}

				// SAVE CLIENT ACTIVE STATUS
			// *************************
			if($request->has('submit_active_status')){
				$client = Client::withTrashed()->where('username',$id)->first();
				$client->active_status = $request->input('active_status');
				if($client->save()){
					return response()->json(['status'=>1,'message'=>'Client status updated successfully !!']);
				}else{
					return response()->json(['status'=>0,'message'=>'Client not updated !!']);
				}
			}
			

				// SAVE CLIENT PAID STATUS
			// ***********************
			if($request->has('submit_paid_status')){
				$client = Client::withTrashed()->where('username',$id)->first();
				$client->paid_status = $request->input('paid_status');
				if($client->save()){
					return response()->json(['status'=>1,'message'=>'Client paid status updated successfully !!']);
				}else{
					return response()->json(['status'=>0,'message'=>'Client not updated !!']);
				}
			}


			// SAVE CLIENT Certified STATUS
			// ***********************
			if($request->has('submit_certified_status')){
				$client = Client::withTrashed()->where('username',$id)->first();
				$client->certified_status = $request->input('certified_status');
				if($client->save()){
					return response()->json(['status'=>1,'message'=>'Client Certified status updated successfully !!']);
				}else{
					return response()->json(['status'=>0,'message'=>'Client not updated !!']);
				}
			}

			// SAVE CLIENT TYPE
			// ****************
			if($request->has('submit_client_type')){
				 
				if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('package_name') )){
					return repsonse()->json(['status'=>0,'message'=>'You don`t have permission'],200);
				}
				$client = Client::withTrashed()->where('username',$id)->first();
				$client->client_type = $request->input('client_type');
				if($client->save()){
					return response()->json(['status'=>1,'message'=>'Client type updated successfully']);
				}else{
					return response()->json(['status'=>0,'message'=>'Client not updated successfully']);
				}
			}

			// SAVE YEARLY SUBS DATE
			// *********************
			if($request->has('submit_yrly_subs_starting_date')){
				$client = Client::withTrashed()->where('username',$id)->first();
				if(!$request->user()->current_user_can('administrator')){
					return response()->json(['status'=>0,'message'=>'Unauthorised to update subscription date.'],200);
				}				 
				
				$client->expired_from = $request->input('expired_from');
				$client->expired_on = $request->input('expired_on');
				if($client->save()){
					return response()->json(['status'=>1,'message'=>'Date updated successfully']);
				}else{
					return response()->json(['status'=>0,'message'=>'Date update failed']);
				}
			}

			// SAVE MAX KWDS
			// *************
			if($request->has('submit_max_kw')){
				$client = Client::withTrashed()->where('username',$id)->first();
				if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('manager') )){
					return response()->json(['status'=>0,'message'=>'Unauthorised to update max. kw field']);
				}
				$client->max_kw = $request->input('max_kw');
				if($client->save()){
					return response()->json(['status'=>1,'message'=>'Maximum Keywords field updated successfully']);
				}else{
					return response()->json(['status'=>0,'message'=>'Maximum Keywords field not updated successfully']);
				}
			}
			// SAVE ASSIGNED KEYWORDS
			// **********************
			if($request->has('kw-submit')){
				$client = Client::withTrashed()->where('username',$id)->first();
				
				
				$validator = Validator::make($request->all(),[
				 
				'city'=>'required',
				//'zone_id'=>'required',
				'parent'=>'required',
				'child'=>'required',
				'kw'=>'required',
				'position'=>'required',
				 
				 
			]);
			if($validator->fails()){
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}
			 
				if($client->client_type=="free_subscription" || $client->client_type=="general"){
					$kwds = DB::table('assigned_kwds')
								->join('citylists','assigned_kwds.city_id','=','citylists.id')
								->join('parent_category','assigned_kwds.parent_cat_id','=','parent_category.id')
								->join('child_category','assigned_kwds.child_cat_id','=','child_category.id')
								->join('keyword','assigned_kwds.kw_id','=','keyword.id')
								->select('assigned_kwds.*','citylists.city','parent_category.parent_category','child_category.child_category','keyword.keyword')
								->where('assigned_kwds.client_id',$client->id)
								->get();
					if(count($kwds)>=$client->max_kw){
						return response()->json(['status'=>0,'message'=>'You can\'t add more than '.$client->max_kw.' keywords']);
					}
				}
		 
				 
				  $validator = Validator::make($request->all(), [
					'kw' => 'required|unique:assigned_kwds,kw_id,NULL,id,child_cat_id,'.$request->input('child').',parent_cat_id,'.$request->input('parent').',city_id,'.$request->input('city').',client_id,'.$client->id.',kw_id,'.$request->input('kw'),
					
				]);
				 
				if ($validator->fails()) {
					return response()->json(['status'=>0,'message'=>'Assigned keyword must be unique']);
				 
				}
				$data=[];						
				
				$keyw = $request->input('kw');
			 
				if(!empty($keyw)){					
								
			 
					$assignvalidation = AssignedKWDS::where('city_id',$request->input('city'))->where('parent_cat_id',$request->input('parent'))->where('child_cat_id',$request->input('child'))->where('kw_id',$keyw)->where('zone_id',$request->input('zone_id'))->where('client_id',$client->id)->get()->count();
			
				 if($assignvalidation==0){
				$assignedKWDS = new AssignedKWDS;
				$assignedKWDS->client_id = $client->id;
				$assignedKWDS->city_id = $request->input('city');
				$assignedKWDS->zone_id = $request->input('zone_id');
				$assignedKWDS->parent_cat_id = $request->input('parent');
				$assignedKWDS->child_cat_id = $request->input('child');		
				$assignedKWDS->kw_id = $keyw;
				$assignedKWDS->sold_on_position = $request->input('position');	
				$keyword = Keyword::find($keyw);				
				$keywordSellCount = KeywordSellCount::where('slug',$request->input('position'))->first();		
			if(!empty($keywordSellCount)){
				if($keyword->category==='Category 1'){
					$assignedKWDS->sold_on_price = $keywordSellCount->cat1_price;
				}
				else if($keyword->category==='Category 2'){
					$assignedKWDS->sold_on_price = $keywordSellCount->cat2_price;
				}
				else if($keyword->category==='Category 3'){
					$assignedKWDS->sold_on_price = $keywordSellCount->cat3_price;
				}
				
				  else if($keyword->category==='Category X'){
					switch($request->input('position')){
						case 'diamond':
							$assignedKWDS->sold_on_price = $keyword->premium_price;
						break;
						case 'platinum':
							$assignedKWDS->sold_on_price = $keyword->platinum_price;
						break;
						 
					}
				}  
}
				
				if($assignedKWDS->save()){
					
					switch($request->input('position')){
						case 'diamond':
							$keyword->diamond_pos_sold = $keyword->diamond_pos_sold + 1;
						break;
						case 'platinum':
							$keyword->platinum_pos_sold = $keyword->platinum_pos_sold + 1;
						break;
						 
					}
					$keyword->save();
					  
					$assignedKWDSre = DB::table('assigned_kwds')
								->join('citylists','assigned_kwds.city_id','=','citylists.id')
								->join('parent_category','assigned_kwds.parent_cat_id','=','parent_category.id')
								->join('child_category','assigned_kwds.child_cat_id','=','child_category.id')
								->join('keyword','assigned_kwds.kw_id','=','keyword.id')
								->select('assigned_kwds.*','citylists.city','parent_category.parent_category','child_category.child_category','keyword.keyword')
								->where('assigned_kwds.id',$assignedKWDS->id)
								->get();
				 
					
					
					
					
					
				}
				
					
					}
					
					
				
					$resulsu = "add";
					
					
					
			}
				
				
	 
				return response()->json(['status'=>1,'result'=>$resulsu]);
				
			 
			}

			// EXPORT LEADS LIST
			// *****************
			if($request->has('lead-export')){
				$client = Client::withTrashed()->where('username',$id)->first();
				$clientID = $client->id;			 
				$assignedKWDS = DB::table('leads')
						   ->join('assigned_leads','leads.id','=','assigned_leads.lead_id')
						 //  ->join('cities','leads.city_id','=','cities.id')
						  // ->select('leads.*','assigned_leads.client_id','assigned_leads.lead_id','cities.city')
						     ->select('leads.*','assigned_leads.client_id','assigned_leads.lead_id','assigned_leads.id as s_id','assigned_leads.created_at as assigncreate')
						   ->where('assigned_leads.client_id',$clientID)
						    ->orderBy('leads.created_at','desc')
						   ->get();
						   
			 
				foreach($assignedKWDS as $assKWDS){
					$arr[] = [
						'Name'=>$assKWDS->name,
						'Mobile'=>$assKWDS->mobile,
						'Email'=>$assKWDS->email,
						'Course'=>$assKWDS->kw_text,
						'City'=>$assKWDS->city_name,
						'Date'=>date_format(date_create($assKWDS->assigncreate),'d-m-Y H:i:s'),
					];
				}
				$excel = \App::make('excel');
				Excel::create('assigned_leads_'.date('Y-m-d_H:i'), function($excel) use($arr) {
					$excel->sheet('Sheet 1', function($sheet) use($arr) {
						$sheet->fromArray($arr);
					});
				})->export('xls');
			}


		 
			$kwds = DB::table('assigned_kwds')
						->join('citylists','assigned_kwds.city_id','=','citylists.id')
						->join('parent_category','assigned_kwds.parent_cat_id','=','parent_category.id')
						->join('child_category','assigned_kwds.child_cat_id','=','child_category.id')
						->join('keyword','assigned_kwds.kw_id','=','keyword.id')
						->select('assigned_kwds.*','citylists.city','parent_category.parent_category','child_category.child_category','keyword.keyword')
						->where('assigned_kwds.client_id',$client->id)
						->get();
			
			$distinctCities = DB::table('keyword')
						->join('citylists','keyword.city_id','=','citylists.id')
						->select('citylists.*','keyword.city_id')
						->distinct()
						->get();
						
			$citylist = Citieslists::get();						 
			$clientCategories = ClientCategory::all();
			$parentCategory = ParentCategory::all();
			
			$assignedClientCategories = AssignedClientCategory::select('client_category_id')->where('client_id',$client->id)->get();
			$accs = [];
			foreach($assignedClientCategories as $acc){
				$accs[]=$acc->client_category_id;
			}
			$assignedClientCategories=$accs;
		
		 
			 $moderesults =Modesdetails::get();
			 $banksdetails = Banksdetails::all();
			 
			 
			return view('admin.client_update',['client'=>$client,'kwds'=>$kwds,'request'=>$request,'distinctCities'=>$distinctCities,'clientCategories'=>$clientCategories,'assignedClientCategories'=>$assignedClientCategories,'citylist'=>$citylist,'parentCategory'=>$parentCategory,'moderesults'=>$moderesults]);
		}
         
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editSaveClientLocation(Request $request, $id)
    {
		if($request->ajax()){ 
		try{
 
			if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('client_update') )){
				 $status = false;
				 $msg = 'Unauthorised Permission';
				 $code = 400;
			} 
			if (!is_null($id)) {
		 
				if($request->has('location_info')){
	
				$validator = Validator::make($request->all(),[					
					'business_name' => 'required',
					'city' => 'required|regex:/[a-zA-z ]+$/',
					'state' => 'required|regex:/[a-zA-z ()]+$/',
					'country' => 'required|regex:/[a-zA-z ]+$/',				 	
				
				]);
				
			
				if ($validator->fails()) {
						$errorsBag = $validator->getMessageBag()->toArray();
						return response()->json(['status'=>1,'errors'=>$errorsBag],400);
				}
					$client = Client::withTrashed()->where('username',$id)->first();

					if ($request->user()->current_user_can('administrator')) {	 
						$client->business_name = $request->input('business_name');
						$business_slug = generate_slug($request->input('business_name'));
					
						$slugExists = DB::table('clients')
						->select(DB::raw('business_slug'))
						->where('business_slug', 'like', '%'.$business_slug.'%')
						->orderBy('id','desc')
						->get();
					if (!empty($slugExists)){
						$business_slug = $slugExists[0]->business_slug;
						$business_slug = explode("-",$business_slug);
						$end = end($business_slug);
						reset($business_slug);
						if(!is_numeric($end)){
							$business_slug[] = 1;
						}else{
							++$end;
							$business_slug[count($business_slug)-1] = $end;
						}
						$business_slug = implode("-",$business_slug);
					}
						
						$client->business_slug = $business_slug;
					}
					$client->address = $request->input('address');
					$client->landmark = $request->input('landmark');
					$client->city = $request->input('city');
					$client->state = $request->input('state');
					$client->country = $request->input('country');
					
					if($client->save()){						
						$status= true;
						$msg = 'Location Information Updated Successfully';
						$code = 200;						
					}else{
						$status= false;
						$msg = 'Location Information Not Updated';
						$code = 400;					
					}					
				}   
			 
		}
			}catch(Exception $e){
				$status= false;
				$msg = $e->getMessage();
				$code = 400;
			}
			return response()->json(['status'=>$status,'msg'=>$msg],$code); 	
		}
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ediSaveContactInfo(Request $request, $id)
    {
		if($request->ajax()){ 
		try{
			if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('client_update') )){
				 $status = false;
				 $msg = 'Unauthorised Permission';
				 $code = 400;
			} 
			if(!is_null($id)){
				
				
				// UPDATE CONTACT INFORMATION
				// **************************
				if($request->has('contact_info')){
					$client = Client::withTrashed()->where('username',$id)->first();
					 
					$validator = Validator::make($request->all(),[					
					'contact_person' => 'regex:/^[a-zA-Z ]*$/',
						'mobile' => 'required|numeric|digits:10|regex:/^[1-9]+/',				 
						'email' => 'required|email',
						'website' => ['regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],				 	
				
				]);
				
			
				if ($validator->fails()) {
						$errorsBag = $validator->getMessageBag()->toArray();
						return response()->json(['status'=>1,'errors'=>$errorsBag],400);
				}
									
					$name = '';
				 
						 
					$client->first_name =  $request->input('first_name');
					$client->last_name =  $request->input('last_name');
				 
					$client->mobile = $request->input('mobile');
					$client->sec_mobile = $request->input('sec_mobile');
				 
					$client->landline = $request->input('landline');
				 
					$client->fax = $request->input('fax');
					$client->tollfree = $request->input('tollfree');
					$client->email = $request->input('email');
					$client->website = $request->input('website');
					
					if($client->save()){
						$status= true;
						$msg = 'Contact Information Updated Successfully';
						$code = 200;
					}else{
						$status= false;
						$msg = 'Contact Information Not Updated';
						$code = 400;	
					}
				}       
			}
		}catch(Exception $e){
				$status= false;
				$msg = $e->getMessage();
				$code = 400;
			}
			return response()->json(['status'=>$status,'msg'=>$msg],$code); 	
		}
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clientConversionStatus(Request $request, $id)
    {
		if($request->ajax()){ 
		try{
			if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('client_update') )){
				 $status = false;
				 $msg = 'Unauthorised Permission';
				 $code = 400;
			} 
			if(!is_null($id)){
			 
				$client = Client::withTrashed()->where('username',$id)->first();
			 
				$client->conversion_status = $request->input('conversion_status');
			 			
					if($client->save()){
						$status= true;
						$msg = 'Conversion Updated Successfully';
						$code = 200;
					}else{
						$status= false;
						$msg = 'Conversion Information Not Updated';
						$code = 400;
					}
			}
		 
		}catch(Exception $e){
				$status= false;
				$msg = $e->getMessage();
				$code = 400;
			}
			return response()->json(['status'=>$status,'msg'=>$msg],$code); 	
		}
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editSaveClientProfileLogo(Request $request, $id)
    {
		
		if($request->ajax()){ 
			try{
				if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('client_update') )){
					$status = false;
					$msg = 'Unauthorised Permission';
					$code = 400;
				} 
			 			
		 
			 
					$client = Client::withTrashed()->where('username',$id)->first();					 
					$validator = Validator::make($request->all(),[					
						'year_of_estb' => 'required',
						'image' => 'mimes:jpeg,jpg,png|max:2048',
						'profile_pic' => 'mimes:jpeg,jpg,png|max:2048|dimensions:min_width=1137,min_height=319'							
				 
					]);
				if ($validator->fails()) {
						$errorsBag = $validator->getMessageBag()->toArray();
						return response()->json(['status'=>1,'errors'=>$errorsBag],400);
				}
									
					 
				 
				$client->business_intro = $request->input('business_intro');				 
				$client->year_of_estb = $request->input('year_of_estb');
				$client->certifications = (!empty($request->input('certifications')))?serialize(explode(',',$request->input('certifications'))):"";
				
				//$file = $request->file('logo');
				// LOGO Pictures
				// *************
				if ($request->hasFile('image')) {
					$image = [];
					$filePath = getFolderStructure();
					$file =  $request->file('image');
					$filename = $file->getClientOriginalName();
					$destinationPath = public_path($filePath);
					$nameArr = explode('.',$filename);
					$ext = array_pop($nameArr);
					$name = implode('_',$nameArr);
					if(file_exists($destinationPath.'/'.$filename)){
						$filename = $name."_".time().'.'.$ext;
					}
					$file->move($destinationPath,$filename);
				 
				 
					$image['large'] = array(
						'name'=>$filename,
						'alt'=>$filename,
						'width'=>'',
						'height'=>'',
						'src'=>$filePath."/".$filename
					);
					 
					if(!empty($client->logo)){
						$oldLogoImages = unserialize($client->logo);
					}
					$client->logo = serialize($image);
				}
				
				// PROFILE PICTURE
				// ***************
				if ($request->hasFile('profile_pic')) {
					$image = [];
					$filePath = getFolderStructure();
					$file =  $request->file('profile_pic');
					$filename =str_replace(' ', '_', $file->getClientOriginalName());
				///	$filename = $file->getClientOriginalName();
					$destinationPath = public_path($filePath);
					$nameArr = explode('.',$filename);
					$ext = array_pop($nameArr);
					$name = implode('_',$nameArr);
					if(file_exists($destinationPath.'/'.$filename)){
						$filename = $name."_".time().'.'.$ext;
					}
					$file->move($destinationPath,$filename);
					 
					$image['large'] = array(
						'name'=>$filename,
						'alt'=>$filename,
						'width'=>'',
						'height'=>'',
						'src'=>$filePath."/".$filename
					);
					 
					if(!empty($client->profile_pic)){
						$oldProfileImages = unserialize($client->profile_pic);
					}
					$client->profile_pic = serialize($image);
					if($client->save()){
						$status= true;
						$msg = 'Contact Information Updated Successfully';
						$code = 200;
					}else{
						$status= false;
						$msg = 'Contact Information Not Updated';
						$code = 400;	
					}
				}
			
		
			}catch(Exception $e){
				$status= false;
				$msg = $e->getMessage();
				$code = 400;
			}
			return response()->json(['status'=>$status,'msg'=>$msg],$code); 	
		} 	
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadClientGalleryPics(Request $request, $id)
    {
		
		if($request->ajax()){ 
			try{
					if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('client_update') )){
						$status = false;
						$msg = 'Unauthorised Permission';
						$code = 400;
					} 
		 
				if($request->has('upload_pics')){
					$client = Client::withTrashed()->where('username',$id)->first();				 		
				
			 
				$image = [];
				if(!empty($client->pictures)){
					$oldImages = unserialize($client->pictures);
				}
					 
				$filePath = getFolderStructure();
	 
				for($i=0;$i<12;$i++){
					if ($request->hasFile('image'.($i+1))) {	
					 
						$file =  $request->file('image'.($i+1));
					 
							$filename = $file->getClientOriginalName();
							$destinationPath = public_path($filePath);
							$nameArr = explode('.',$filename);
							$ext = array_pop($nameArr);
							$name = implode('_',$nameArr);
							if(file_exists($destinationPath.'/'.$filename)){
								$filename = $name."_".time().'.'.$ext;
							}
							$file->move($destinationPath,$filename);
						 
							 
							$image[$i]['large'] = array(
								'name'=>$filename,
								'alt'=>$filename,
								'width'=>'',
								'height'=>'',
								'src'=>$filePath."/".$filename
							);
							 
					 
						 
					}
					else if(isset($_FILES['image'.($i+1)]) && $_FILES['image'.($i+1)]['size'] == 0){
					}
					else{
						if(isset($oldImages)){
							if(array_key_exists($i,$oldImages)){
								$image[$i] = $oldImages[$i];	
							}
							unset($oldImages[$i]);
						}
					}
				}
				if(!empty($image)){
					$client->pictures = serialize($image);
				}else{
					$client->pictures = '';
				}
				 
				 					 
					if($client->save()){
						$status= true;
						$msg = 'Gallery Image Updated Successfully';
						$code = 200;
					}else{
						$status= false;
						$msg = 'Gallery Image Not Updated';
						$code = 400;	
					}
				}else{

					$status= false;
					$msg = 'Please Select Image';
					$code = 400;	
				}      
			
		
			}catch(Exception $e){
				$status= false;
				$msg = $e->getMessage();
				$code = 400;
			}
			return response()->json(['status'=>$status,'msg'=>$msg],$code); 	
		} 	
        
    }

 
 

 
  

 


 /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assignClientToEmployee(Request $request, $id)
    {
		
		if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('client_update') )){
				return view('errors.unauthorised');
			} 
  
			if($request->has('submit_assign_client')){
			 
				$client = Client::withTrashed()->where('username',$id)->first();
				$client->created_by = $request->input('assign_client');
				if($client->save()){
					return response()->json(['status'=>1,'message'=>'Created by client updated successfully !!']);
				}else{
					return response()->json(['status'=>0,'message'=>'Client not updated !!']);
				}
			}
			 
			 
	 
         
    }



 /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function conversionClientStatus(Request $request, $id)
    {
		
		if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('client_update') )){
				return view('errors.unauthorised');
			} 
		if(!is_null($id)){
			  			
		 
			// SAVE CLIENT submit_conversion_client client 
			// *************************
			if($request->has('submit_conversion_client')){
				//echo "<pre>";print_r($_POST);echo $id; die;
				$client = Client::withTrashed()->where('username',$id)->first();
				$client->conversion_status = $request->input('conversion_status');
				if($client->save()){
					return response()->json(['status'=>1,'message'=>'Conversion client updated successfully !!']);
				}else{
					return response()->json(['status'=>0,'message'=>'Conversion Client not updated !!']);
				}
			}
			 		 
		}
       
    }




 /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clientPaidStatus(Request $request, $id)
    {
		
		if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('client_update') )){
				return view('errors.unauthorised');
			} 
		if(!is_null($id)){
			  			
		 
			
			// SAVE CLIENT PAID STATUS
			// ***********************
			if($request->has('submit_paid_status')){
				$client = Client::withTrashed()->where('username',$id)->first();
				$client->paid_status = $request->input('paid_status');
				if($client->save()){
					return response()->json(['status'=>1,'message'=>'Client paid status updated successfully !!']);
				}else{
					return response()->json(['status'=>0,'message'=>'Client not updated !!']);
				}
			}
			
		  }
         
    }



 /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clientCertifiedStatus(Request $request, $id)
    {
		
		if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('client_update') )){
				return view('errors.unauthorised');
			} 
		if(!is_null($id)){
			  			  
			
			// SAVE CLIENT Certified STATUS
			// ***********************
			if($request->has('submit_certified_status')){
				$client = Client::withTrashed()->where('username',$id)->first();
				$client->certified_status = $request->input('certified_status');
				if($client->save()){
					return response()->json(['status'=>1,'message'=>'Client Certified status updated successfully !!']);
				}else{
					return response()->json(['status'=>0,'message'=>'Client not updated !!']);
				}
			}
		  
		}
         
    }



 /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clientPackegeStatus(Request $request, $id)
    {
		
		if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('client_update') )){
				return view('errors.unauthorised');
			} 
		if(!is_null($id)){
			  			  
			 
			// SAVE CLIENT PACKEGE STATUS
			// ***********************
			if($request->has('submit_packege_status')){
				$client = Client::withTrashed()->where('username',$id)->first();				 	
				$client->client_type = $request->input('package_status');			 
				if($client->save()){
					return response()->json(['status'=>1,'message'=>'Client Package status updated successfully !!']);
				}else{
					return response()->json(['status'=>0,'message'=>'Client not updated !!']);
				}
			}
			 
		}
         
    }



 


 /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clientLeadsCount(Request $request, $id)
    {
		if($request->ajax()){ 
			try{ 
				if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('client_update') )){
						return view('errors.unauthorised');
					} 
				if(!is_null($id)){							
			 		
			 
					if($request->has('submit_leads_count')){
						$client = Client::withTrashed()->where('username',$id)->first();
						if((!$request->user()->current_user_can('administrator') )){
							return response()->json([
								'statusCode'=>0
								,'data'=>[
									'responseCode'=>200
									,'payload'=>''
									,'message'=>'Unauthorised to update leads count and cost/lead'
								]
								
							]);
						}				
						$leads_count_diff = $request->input('leads_count')-$client->leads_count;
						/* if($leads_count_diff<0){
							return response()->json(['status'=>0,'message'=>'Leads Count field cannot be updated because leads quota limits are reached']);
						} */
						$client->leads_count = $request->input('leads_count');
						$client->leads_remaining = $client->leads_remaining+$leads_count_diff;
						$client->cost_per_lead = $request->input('cost_per_lead');
						if($client->save()){
							return response()->json(['status'=>true,'msg'=>'Leads count field updated successfully'],200);
							 
						}else{							 
							return response()->json(['status'=>false,'msg'=>'Leads Count field not updated successfully'],200);
						
						}
					}		 
				}
			}catch(\Exception $e){
				$status = 0;
				$msg = $e->getMessage();
			}

 			return response()->json(['status'=>$status,'msg'=>$msg],200); 
	}
        
    }



 /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clientBalanceAmount(Request $request, $id)
    {
		
		if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('client_update') )){
				return view('errors.unauthorised');
			} 
		if(!is_null($id)){			  			  
			 			
		 		
			// SAVE BALANCE AMOUNT
			// *******************
			if($request->has('submit_balance_amt')){
				$client = Client::withTrashed()->where('username',$id)->first();
				if($client->client_type=='general'){
					return response()->json(['status'=>0,'message'=>'Balance amount cannot be updated for general client.']); 
				}
				/* if(($client->client_type=='lead_based' or $client->client_type=='yearly_subscription' or $client->client_type=='free_subscription' or $client->client_type=='count_based_subscription') and !$request->user()->current_user_can('administrator')){
					return response()->json(['status'=>0,'message'=>'Unauthorised to update amount.'],200);
				} */
				$client->balance_amt = $request->input('balance_amt');
				if($client->balance_amt>0){
					$client->paid_status = 1;
				}
				if($client->save()){
					//$transaction = new Transaction;
					//$transaction->client_id = $client->id;
					//$transaction->key = 'balance_amt';
					//$transaction->value = $request->input('balance_amt');
					//$transaction->save();
					return response()->json(['status'=>1,'message'=>'Balance amount updated successfully, please reload the page.']);
				}else{
					return response()->json(['status'=>0,'message'=>'Balance amount update failed']);
				}
			}
			
			// SAVE YEARLY SUBS DATE
			// *********************
			if($request->has('submit_yrly_subs_starting_date')){
				$client = Client::withTrashed()->where('username',$id)->first();
				if(!$request->user()->current_user_can('administrator')){
					return response()->json(['status'=>0,'message'=>'Unauthorised to update subscription date.'],200);
				}				 
				
				$client->expired_from = $request->input('expired_from');
				$client->expired_on = $request->input('expired_on');
				if($client->save()){
					return response()->json(['status'=>1,'message'=>'Date updated successfully']);
				}else{
					return response()->json(['status'=>0,'message'=>'Date update failed']);
				}
			}
			
			$clients = Client::withTrashed()->where('username',$id)->get();
			if(count($clients)>0){
				foreach($clients as $c){
					$client = $c;
					break;
				}
			}
			
			//$kwds = AssignedKWDS::where('client_id',$client->username)->get();
			$kwds = DB::table('assigned_kwds')
						->join('citylists','assigned_kwds.city_id','=','citylists.id')
						->join('parent_category','assigned_kwds.parent_cat_id','=','parent_category.id')
						->join('child_category','assigned_kwds.child_cat_id','=','child_category.id')
						->join('keyword','assigned_kwds.kw_id','=','keyword.id')
						->select('assigned_kwds.*','citylists.city','parent_category.parent_category','child_category.child_category','keyword.keyword')
						->where('assigned_kwds.client_id',$client->id)
						->get();
			
			$distinctCities = DB::table('keyword')
						->join('citylists','keyword.city_id','=','citylists.id')
						->select('citylists.*','keyword.city_id')
						->distinct()
						->get();
						
			$citylist = Citieslists::all();						 
			$clientCategories = ClientCategory::all();
			$parentCategory = ParentCategory::all();
			
			$assignedClientCategories = AssignedClientCategory::select('client_category_id')->where('client_id',$client->id)->get();
			$accs = [];
			foreach($assignedClientCategories as $acc){
				$accs[]=$acc->client_category_id;
			}
			$assignedClientCategories=$accs;	 
			 $moderesults =Modesdetails::get();
			 $banksdetails = Banksdetails::all();		 
			return view('admin.client_update',['client'=>$client,'kwds'=>$kwds,'request'=>$request,'distinctCities'=>$distinctCities,'clientCategories'=>$clientCategories,'assignedClientCategories'=>$assignedClientCategories,'citylist'=>$citylist,'parentCategory'=>$parentCategory,'moderesults'=>$moderesults]);
		}
    
    }





 /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clientYrlySubsStartingSate(Request $request, $id)
    {

		
		if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('client_update') )){
				return view('errors.unauthorised');
			} 
		if(!is_null($id)){			  			  
			 			
	 		
			// SAVE YEARLY SUBS DATE
			// *********************
			if($request->has('submit_yrly_subs_starting_date')){
				$client = Client::withTrashed()->where('username',$id)->first();
				if(!$request->user()->current_user_can('administrator')){
					return response()->json(['status'=>0,'message'=>'Unauthorised to update subscription date.'],200);
				}				 
				
				$client->expired_from = $request->input('expired_from');
				$client->expired_on = $request->input('expired_on');
				if($client->save()){
					return response()->json(['status'=>1,'message'=>'Date updated successfully']);
				}else{
					return response()->json(['status'=>0,'message'=>'Date update failed']);
				}
			}
			
			 
		}
         
    }






	/**
	 * Return Paginated Assigned Keywords
	 *
	 * @param $request - Request class instance
	 * @param $id - ClientID
	 * @return JSON object containing payload
	 */
	 public function getPaginatedAssignedKeywords(Request $request, $id=null){
		if($request->ajax()){			 
			if(null!==$id){
				$client = Client::where('username',$id)->first();
				$clientID = $client->id;
			}
			$leads = DB::table('assigned_kwds as assigned_kwds')
						->join('citylists','assigned_kwds.city_id','=','citylists.id')
						//->join('zones','assigned_kwds.zone_id','=','zones.id')
						->join('parent_category','assigned_kwds.parent_cat_id','=','parent_category.id')
						->join('child_category','assigned_kwds.child_cat_id','=','child_category.id')
						->join('keyword','assigned_kwds.kw_id','=','keyword.id')
						->select('assigned_kwds.*','citylists.city','parent_category.parent_category','child_category.child_category','keyword.keyword')
						->orderBy('assigned_kwds.created_at','desc')
						->where('assigned_kwds.client_id',$clientID);
						
						
				if($request->input('search.value')!='')
				{				
			 
				$leads=$leads->where('keyword.keyword','LIKE','%'.$request->input('search.value').'%');		
				} 
				 
				$leads=$leads->paginate($request->input('length'));
					   
			$returnLeads = $data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $leads->total();
			$returnLeads['recordsFiltered'] = $leads->total();
			$returnLeads['recordCollection'] = [];
			//echo "<pre>";print_r($leads);die;
			foreach($leads as $lead){
				$zone=  Zone::where('id',$lead->zone_id)->first();
				if(!empty($zone)){
					$zonename= $zone->zone;					
				}else{
					$zonename="";
					
				}
				$action = '';
				$separator = '';
					if($request->user()->current_user_can('administrator') || $request->user()->current_user_can('edit_assign_keyword')  ){
					$action .= $separator."<a href='javascript:void(0)' onclick='javascript:keyword.editAssignedKeyword({$lead->id},this,\"show_assigned_keyword_update_form\")'><i class='fa fa-pencil fa-fw' aria-hidden='true'></i></a>";
					$separator = ' | ';
				}
				if($request->user()->current_user_can('administrator') || $request->user()->current_user_can('assign_keyword_delete')){
					$action .= $separator."<a href='javascript:void(0)' onclick='javascript:deleteAssignedKW({$lead->id},this,\"del_ass_kw\")'><i class='fa fa-trash fa-fw' aria-hidden='true'></i></a>";
					$separator = ' | ';
				}
				$data[] = [
					"<th class='text-center'><input type='checkbox' class='check-box' value='$lead->id'></th>",					 
					$lead->keyword,
					$lead->child_category,
					$lead->parent_category,
					$lead->city,
					$zonename,
					ucfirst($lead->sold_on_position),
				//	$lead->sold_on_price,
					$action
				];
				$returnLeads['recordCollection'][] = $lead->id;
			}
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
			//return $leads->links();
		}
	 }
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function deleteSelectedAssignedKwds(Request $request){
		$ids = $request->input('ids');
		foreach($ids as $id){
			$lead = AssignedKWDS::findorFail($id);
			if($lead){
				$lead->delete();
			}
		}
		return response()->json([
			'statusCode'=>1,
			'data'=>[
				'responseCode'=>200,
				'payload'=>'',
				'message'=>'Selected deleted successfully !!'
			]
		],200);
	}
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function updatePriceAssignedKwds(Request $request, $id=null){
		if($request->ajax()){
			if(null!==$id){
				$client = Client::where('username',$id)->first();
				$clientID = $client->id;
			}
			$assignedKwds = AssignedKWDS::where('client_id',$clientID)->get();
			foreach($assignedKwds as $assignedKwd){
				$singleAssignedKwd = AssignedKWDS::findOrFail($assignedKwd->id);
				$kwdSellCount = KeywordSellCount::where('slug',$singleAssignedKwd->sold_on_position)->first();
				$kwd = Keyword::findOrFail($singleAssignedKwd->kw_id);
				$price = $singleAssignedKwd->sold_on_price;
				switch($kwd->category){
					case 'Category 1':
						$price = $kwdSellCount->cat1_price;
					break;
					case 'Category 2':
						$price = $kwdSellCount->cat2_price;
					break;
					case 'Category 3':
						$price = $kwdSellCount->cat3_price;
					break;
				}
				$singleAssignedKwd->sold_on_price = $price;
				$singleAssignedKwd->save();
			}
			return response()->json([
				'statusCode'=>1,
				'data'=>[
					'responseCode'=>200,
					'payload'=>'',
					'message'=>'Updated price successfully !!'
				]
			],200);
		}
	}
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $delete, $id)
    {
		if($request->ajax()){
			if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('delete_client') )){
				return view('errors.unauthorised');
			}
			if("sdelete"===$delete){
				Client::find($id)->delete();
				return response()->json(['status'=>1,'msg'=>'Client deleted successfully!!']);				
			}
			if("hdelete"===$delete){				
				Client::withTrashed()->where('id',$id)->forceDelete();
				$lead = DB::table('assigned_leads')->where('client_id',$id)->delete();	
				$assigned_kwds= DB::table('assigned_kwds')->where('client_id',$id)->delete();	
				$assigned_client_categories= DB::table('assigned_client_categories')->where('client_id',$id)->delete();	
				return response()->json(['status'=>1,'msg'=>'Client deleted permanently!!']);
			}
		} 
    }
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id=null)
    {
		if($request->ajax()&&!is_null($id)){
			Client::withTrashed()->where('id',$id)->restore();
			return response()->json(['status'=>1,'msg'=>'Client restored successfully!!']);
		} 
    }
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchForm(Request $request)
    {
		return view('admin.client_search');
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getField(Request $request,$what,$id=null)
    {
		if($request->ajax()){
			
			if("city"===$what){				 
				$city_id=  $request->input('city'); 
				$zone = DB::table('zones')
							->join('citylists','zones.city_id','=','citylists.id')
							->select('citylists.id','citylists.city','zones.*')						 
							->where('zones.city_id',$request->input('city'))						 
							->get();
							
							 
					return response()->json(['status'=>1,'result'=>$zone]);							
			}
			if("zone"===$what){				 
				 $zoneID = $request->input('zone');
					return response()->json(['status'=>1,'result'=>$zoneID]);				
			}
			if("parent_cat"===$what){
				
			 
				  $child_cat = DB::table('keyword')
							->join('child_category','keyword.child_category_id','=','child_category.id')
							->select('child_category.id','child_category.child_category','keyword.city_id','keyword.parent_category_id','keyword.child_category_id')
							//->where('keyword.city_id',$request->input('city'))
							->where('keyword.parent_category_id',$request->input('parent_cat'))
							->groupBy('child_category_id')
						//	->distinct()
							->get();  
							
							//echo "<pre>";print_r($child_cat);die;
					return response()->json(['status'=>1,'result'=>$child_cat]);				
			}
			
			
			if("child_cat"===$what){
 
				$child_cat = DB::table('keyword')
						//	->where('city_id',$request->input('city'))
							->where('parent_category_id',$request->input('parent_cat'))
							->where('child_category_id',$request->input('child_cat'))						 
							->get();
 
					return response()->json(['status'=>1,'result'=>$child_cat]);				
			}
			if("kw"===$what){
				
		 
				$city_id=  $request->input('city'); 
				$zone=  $request->input('zone'); 
					$result = [];
				if(!empty($zone)){
				$keyword = Keyword::find($request->input('kw'));
				$assKWDSC = AssignedKWDS::where('city_id',$request->input('city'))->where('kw_id',$request->input('kw'))->where('zone_id',$request->input('zone'))->where('sold_on_position','platinum')->get()->count();
					 //echo $assKWDSC;die;
				$keywordSellCount = KeywordSellCount::all();
			
				foreach($keywordSellCount as $ksc){
					switch($ksc->slug){
						case 'platinum':					 
							if( $assKWDSC <= 2 && ((($keyword->platinum_pos_sold + $ksc->count) -$assKWDSC > 0 )))
								$result['platinum'] = 'Platinum';	
						 
						break;
						case 'diamond':
							if($ksc->count - $keyword->diamond_pos_sold > 0)
								$result['diamond'] = 'Diamond';
								 
						break; 
						case 'Gold':
							if($ksc->count - $keyword->diamond_pos_sold > 0)
								$result['Gold'] = 'Gold';
								 
						break; 
						case 'Silver':
							if($ksc->count - $keyword->diamond_pos_sold > 0)
								$result['Silver'] = 'Silver';
						break; 
					}
				}
				}
				
					return response()->json(['status'=>1,'result'=>$result]);				
			}
			if("position"===$what){
				$result = [];
				$keyword = Keyword::find($request->input('kw'));
				$keywordSellCount = KeywordSellCount::where('slug',$request->input('position'))->first();			
				if($keyword->category=='Category 1'){
					$result['price'] = $keywordSellCount->cat1_price;
				}
				else if($keyword->category=='Category 2'){
					$result['price'] = $keywordSellCount->cat2_price;
				}
				else if($keyword->category=='Category 3'){
					$result['price'] = $keywordSellCount->cat3_price;
				}
				else if($keyword->category=='Category X'){
					switch($request->input('position')){
						case 'diamond':
							$result['price'] = $keyword->diamond_price;
						break;
						case 'platinum':
							$result['price'] = $keyword->platinum_price;
						break;
						 
					}
				}
					return response()->json(['status'=>1,'result'=>$result]);				
			}
		}
    }

	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delKW(Request $request,$id)
    {
		if($request->ajax()){
			$assignedKW = AssignedKWDS::find($id);
			$kw = Keyword::find($assignedKW->kw_id);
			switch($assignedKW->sold_on_position){
				case 'diamond':
					$kw->diamond_pos_sold = $kw->diamond_pos_sold -1;
				break;
				case 'platinum':
					$kw->platinum_pos_sold = $kw->platinum_pos_sold -1;
				break;
				 
			}
			$kw->save();
			$assignedKW->delete();
			return response()->json(['status'=>1,'result'=>'Assigned keyword deleted successfully']);
		}else{
			return response()->json(['status'=>0,'result'=>'Not deleted']);
		}
    }
	
    /**
     * Send client registration mail to client containing user name password.
     *
     * @param  object  $client
     */
    public function sendUandP($client,$usr,$pass)
    {
		$mailStatus = 1;
		try{
			Mail::send('emails.register', ['client'=>$client,'usr'=>$usr,'pass'=>$pass], function ($m) use ($client) {
				$m->from('info@quickindia.in', 'Quickindia');
				$m->to($client->email, $client->first_name." ".$client->last_name)->subject('Quickindia Login Credentials')->cc('help@quickindia.in');
			});
		}catch(\Exception $e){
			$mailStatus = 0;
		}
		return $mailStatus;
    }

    /**
     * Get paginated leads.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPaginatedTransactions(Request $request, $id=null)
    {
		//if($request->ajax()){
			//$leads = Lead::orderBy('id','desc')->paginate($request->input('length'));
			if(null!==$id){
				$client = Client::where('username',$id)->first();
				$clientID = $client->id;
			}
			$leads = DB::table('payment_histories')
					   ->where('client_id',$clientID)
					   ->orderBy('created_at','desc')
					   ->paginate($request->input('length'));
					   
			$returnLeads = $data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $leads->total();
			$returnLeads['recordsFiltered'] = $leads->total();
			foreach($leads as $lead){
				 
				$data[] = [
					$lead->total_amount,
					$lead->leads_count,
					date_format(date_create($lead->created_at),'d-m-Y H:i:s'),
					
					
				];
			}
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
		//}
    }
	
	
    /**
     * Get paginated leads.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPaginatedLeads(Request $request, $id=null)
    {
		if($request->ajax()){
			//$leads = Lead::orderBy('id','desc')->paginate($request->input('length'));
			if(null!==$id){
				$client = Client::where('username',$id)->first();
				$clientID = $client->id;
			}
			$leads = DB::table('leads')
					   ->join('assigned_leads','leads.id','=','assigned_leads.lead_id')
					//   ->join('cities','leads.city_id','=','cities.id')
					   //->join('keyword','leads.kw_id','=','keyword.id')
					   ->select('leads.*','assigned_leads.client_id','assigned_leads.lead_id','assigned_leads.id as s_id','assigned_leads.created_at as created')
					   ->orderBy('leads.created_at','desc')
					   //->orderBy('leads.id','desc')
					   //->whereNull('leads.deleted_at')
					   
					   ->where('assigned_leads.client_id',$clientID);
					   
				if($request->input('search.value')!=''){
				$leads = $leads->where(function($query) use($request){
				$query->orWhere('leads.name','LIKE','%'.$request->input('search.value').'%')
				->orWhere('leads.mobile','LIKE','%'.$request->input('search.value').'%')
				->orWhere('leads.kw_text','LIKE','%'.$request->input('search.value').'%')
				->orWhere('leads.email','LIKE','%'.$request->input('search.value').'%');
				});
				}
				
			$leads = $leads->paginate($request->input('length'));
					   
			$returnLeads = [];
			$data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $leads->total();
			$returnLeads['recordsFiltered'] = $leads->total();
			
			//echo "<pre>";print_r($leads);die;
			foreach($leads as $lead){ 		

					$action = '';
					$separator = ''; 
					$action .= $separator.'<a data-lead_id_follow="'.$lead->id.'" href="javascript:pushLeadController.getLeadFollowupForm('.$lead->lead_id.')"  title="Follow Up Leads"><i class="fa fa-comments fa-fw"></i></a>';
					$separator = ' | ';	 			 
					$action .= $separator.'<a href="javascript:pushLeadController.clientAssignleaddelete('.$lead->s_id.')" title="lead Delete"><i class="fa fa-fw fa-trash"></i></a>';
					$separator = ' | ';	

					
				$data[] = [
					$lead->name,
					$lead->mobile,
					$lead->email,					 
					$lead->kw_text,
					$lead->city_name,
					date_format(date_create($lead->created),'d-m-Y H:i:s'),
				
				$action
				];
			}
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
			 
		}
    } 

	/**
     * Get paginated leads.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDescussion(Request $request, $id=null)
    { 
		if($request->ajax()){
			//$leads = Lead::orderBy('id','desc')->paginate($request->input('length'));
			if(null!==$id){
				$client = Client::where('username',$id)->first();
				$clientID = $client->id;
			}
			echo $clientID;die;
			$leads = DB::table('client_discussion')					  
					   ->where('client_id',$clientID)
					   ->paginate($request->input('length'));
					   
			$returnLeads = [];
			$data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $leads->total();
			$returnLeads['recordsFiltered'] = $leads->total();
			foreach($leads as $lead){
				/* $sources = $lead->source()->where('id',$lead->source)->get();
				foreach($sources as $source){
					$src = $source;
				}
				$courses = $lead->course()->where('id',$lead->course)->get();
				foreach($courses as $course){
					$crs = $course;
				}
				$statuses = $lead->status()->where('id',$lead->status)->get();
				foreach($statuses as $status){
					$sts = $status;
				} */
				$data[] = [
					$lead->createdate.''.$lead->discussion,
					 
				];
			}
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
			//return $leads->links();
		}
    }
	
    /**
     * Generate New Password
     *
     * @param  int  $id
     * @return JSON Response
     */
    public function generateNewPass(Request $request, $id=null)
    {
		if($request->ajax()){
			if(null!==$id){
				$client = Client::where('username',$id)->first();
				$clientID = $client->id;
			}
			$pass = rand(000001,999999);
			$client->password = bcrypt($pass);
			if($client->save()){
				$smsMessage = "Thanks for registering with Quickindia.
				%0D%0ALogin %26 Update your profile to get more leads to grow your business.
				%0D%0A%0D%0ABusiness Name:".$client->business_name."
				%0D%0AURL:www.quickindia.in
				%0D%0AUID:".$client->username."
				%0D%0APassword:".$pass."
				%0D%0A--
				%0D%0ARegards
				%0D%0AQuickindia Team";			 
				sendSMS($client->mobile,$smsMessage);
				$mailStatus = $this->sendUandP($client,$id,$pass);
				return response()->json(['status'=>1,'username'=>$client->username,'password'=>$pass,'mailStatus'=>$mailStatus]);
			}
		}
    }
	
    /**
     * Get paginated clients.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPaginatedClients(Request $request)
    {	
		 
		if($request->ajax()){
				 
			$leads = DB::table('clients');
			$select = 'clients.*';
			
			 
				
			if($request->input('search.keyword')!='')
				{					 
					$leads = $leads->join('assigned_kwds','clients.id','=','assigned_kwds.client_id');
					$leads = $leads->join('keyword','assigned_kwds.kw_id','=','keyword.id');
					$leads = $leads->where('keyword.keyword','LIKE','%'.$request->input('search.keyword').'%');					 
					$leads = $leads->groupBy('assigned_kwds.client_id');					 
					$select = 'keyword.keyword';
					 
				}
			 
			if($request->input('search.client_category')!=''){
				$leads = $leads->join('assigned_client_categories','clients.id','=','assigned_client_categories.client_id');
				$select = 'assigned_client_categories.client_category_id';
			}
			$leads = $leads->select('clients.*',$select);
			 
			 
			$leads = $leads->orderBy('clients.id','desc');
			$leads = $leads->whereNull('clients.deleted_at');
			if($request->input('search.value')!=''){
				$leads = $leads->where(function($query) use($request){
					$query->orWhere('clients.username','LIKE','%'.$request->input('search.value').'%')
					      ->orWhere('clients.business_name','LIKE','%'.$request->input('search.value').'%')
					        ->orWhere('clients.business_slug','LIKE','%'.$request->input('search.value').'%')
						  ->orWhere('clients.mobile','LIKE','%'.$request->input('search.value').'%')
						  ->orWhere('clients.email','LIKE','%'.$request->input('search.value').'%');
						  
				});
			}
			/* if($request->input('search.paid_status')!=''){
				if($request->input('search.paid_status')=='1'){
					$leads = $leads->where('clients.paid_status','1');
				}else{
					$leads = $leads->where('clients.paid_status','0');
				}
			}
			 */
			if($request->input('search.paid_status')!=''){				 
					$leads = $leads->where('clients.paid_status',$request->input('search.paid_status'));
				 
			}
			if($request->input('search.client_type')!=''){
				$leads = $leads->where('clients.client_type','LIKE',$request->input('search.client_type'));
			}
			if($request->input('search.city')!=''){
				$cityss = $request->input('search.city');
				 
				if(!empty($cityss)){
				foreach($cityss as $city){
					$cityList[] = $city;
				}
				$leads = $leads->whereIn('clients.city',$cityList);
				}
			}
			if($request->input('search.datef')!=''){
				$leads = $leads->whereDate('clients.created_at','>=',date_format(date_create($request->input('search.datef')),'Y-m-d'));
			}
			if($request->input('search.datet')!=''){
				$leads = $leads->whereDate('clients.created_at','<=',date_format(date_create($request->input('search.datet')),'Y-m-d'));
			}
			
			
			if($request->input('search.client_category')!=''){
				 
				$leads = $leads->where('assigned_client_categories.client_category_id',$request->input('search.client_category'));
			}
			
			
			if(!$request->user()->current_user_can('administrator') && !$request->user()->current_user_can('lead_show_all')){	
				
			if($request->user()->current_user_can('manager')){		    
				 
 				$leads = $leads->where('clients.created_by',$request->user()->id);

				if($request->input('search.user')!=''){
				$leads = $leads->where('clients.created_by','=',$request->input('search.user'));
				}
								
				
			}else{
				 
				$leads = $leads->where('clients.created_by','=',$request->user()->id);
				}
				
				
			} else{
			
				if($request->input('search.user')!=''){
					$leads = $leads->where('clients.created_by','=',$request->input('search.user'));
				}
			}
				
			
			
			
			$leads = $leads->paginate($request->input('length'));
		 
			$returnLeads = [];
			$data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $leads->total();
			$returnLeads['recordsFiltered'] = $leads->total();
			 
			foreach($leads as $lead){
				
				$type="";
				switch($lead->client_type){
					case 'Gold':
						$type = 'G';
						break;
					case 'Diamond':
						$type = 'D';
						break;
					case 'Platinum':
						$type = 'P';
						break;
					 
				}
				if(!empty($type)){
					$type='<strong style="color:red" >['.$type.']</strong>';
				}else{
					$type="";
				}
				
				
				$assignedLeadsCount = 0;
				$assignedLeadsCount = AssignedLead::where('client_id','=',$lead->id)->count();
				
				$meetingPopover = $popover = '';
				if(null!=$lead->remark){
					$popover = explode("|",$lead->remark);
					$popover = end($popover);
					$popover = explode("-",$popover);
					$popover = "[".date('d-m-Y',$popover[0])."] ".$popover[1];
					$popover = "data-toggle='popover' data-trigger='hover' data-placement='left' data-content='$popover'";
				}
				// Getting meetingPopover
					$meeting = Meeting::where('client_id',$lead->id)->orderBy('created_at','desc')->first();
					if($meeting){
						$meetingPopover = "[".(new Carbon($meeting->date_time))->format('d-m-Y')."] ".$meeting->remark;
						$meetingPopover = "data-toggle='popover' data-trigger='hover' data-placement='left' data-content='$meetingPopover'";
					}
				// Getting meetingPopover				
				$username = '';				
				if(!empty($lead->paid_status)){
					$username = "<a href='/developer/clients/update/{$lead->username}' title='Paid client'>{$lead->username}</a>";
				}else{
					$username = "<a href='/developer/clients/update/{$lead->username}' style='color:red' title='Not Paid client'>{$lead->username}</a>";
				}
				
				$action = $separator =''; 
				$action = '<a title="edit" href="/developer/clients/update/'.$lead->username.'"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>'.' | '.'<a title="view details" href="/developer/clients/list/'.$lead->username.'"><i class="fa fa-eye fa-fw" aria-hidden="true"></i></a>'.' | '.'<a title="Follow Up" data-client_id_meeting="'.$lead->username.'" href="javascript:client.getClientMeetingForm(\''.$lead->username.'\')" '.$meetingPopover.'><i class="fa fa-comments fa-fw" aria-hidden="true"></i></a>';
		 
				if($request->user()->current_user_can('administrator') || $request->user()->current_user_can('delete_client') ){
					$action .= $separator.' | <a title="delete" href="javascript:void(0)" onclick="javascript:deleteClient('.$lead->id.',this,\'delete\')"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></a>';
					$separator = ' | ';
				}
				
				if(!is_null($lead->created_by)){
					$user = DB::table('users')->where('id',$lead->created_by)->first();
				}
				$categories = DB::table('assigned_client_categories')->where('client_id',$lead->id)->get();
				$paidOrNot = "";
				if(!empty($categories)){
					$paidOrNot = "<a style='color:blue' href='#' title='Assign Client Category'>*</a>";
				}else{
					
					$paidOrNot = "<a style='color:red' href='#' title='Not Assign Client Category'>*</a>";
				}
				
				$data[] = [
					$username." ".$paidOrNot,
					$lead->business_name.''.$type,
					$lead->first_name.' '.$lead->last_name,
					$lead->city,
					$lead->email,
					$lead->mobile,
					//(isset($lead->keyword)?$lead->keyword:""),
					$assignedLeadsCount,
					(new Carbon($lead->created_at))->format('d-m-Y'),
					((isset($user)&&$user)?$user->first_name." ".$user->last_name:""),
					$action
				];
				unset($user);
			}
			$returnLeads['data'] = $data;
		//echo "<pre>";print_r($returnLeads['data']);die;
			return response()->json($returnLeads);
			//return $leads->links();
		}
    }
	
    /**
     * Get paginated clients.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getClientsExcel(Request $request)
    {
		//if($request->ajax()){
			$leads = DB::table('clients');
			$select = 'clients.*';
			if($request->input('search.client_category')!=''){
				$leads = $leads->join('assigned_client_categories','clients.id','=','assigned_client_categories.client_id');
				$select = 'assigned_client_categories.client_category_id';
			}
			$leads = $leads->select('clients.*',$select);
			$leads = $leads->orderBy('clients.id','desc');
			$leads = $leads->whereNull('clients.deleted_at');
			if($request->input('search.value')!=''){
				$leads = $leads->where(function($query) use($request){
					$query->orWhere('clients.username','LIKE','%'.$request->input('search.value').'%')
					      ->orWhere('clients.business_name','LIKE','%'.$request->input('search.value').'%')
						  ->orWhere('clients.mobile','LIKE','%'.$request->input('search.value').'%')
						  ->orWhere('clients.email','LIKE','%'.$request->input('search.value').'%');
				});
			}
			if($request->input('search.client_type')!=''){
				$leads = $leads->where('clients.client_type','LIKE',$request->input('search.client_type'));
			}
			
			if($request->input('search.user')!=''){
				$leads = $leads->where('clients.created_by','=',$request->input('search.user'));
			}
			if($request->input('search.paid_status')!=''){
				$leads = $leads->where('clients.paid_status','LIKE',$request->input('search.paid_status'));
			}  
			
			if($request->input('search.city')!=''){
				$cityss = $request->input('search.city');			 
				$cityarr = explode(',', $cityss); 		
				if(!empty($cityarr)){
				foreach($cityarr as $city){
					$cityList[] = $city;
				}				 
				$leads = $leads->whereIn('clients.city',$cityList);
				}
			}
			if($request->input('search.datef')!=''){
				$leads = $leads->whereDate('clients.created_at','>=',date_format(date_create($request->input('search.datef')),'Y-m-d'));
			}
			if($request->input('search.datet')!=''){
				$leads = $leads->whereDate('clients.created_at','<=',date_format(date_create($request->input('search.datet')),'Y-m-d'));
			}
			if($request->input('search.client_category')!=''){
				$leads = $leads->where('assigned_client_categories.client_category_id',$request->input('search.client_category'));
			}
			$leads = $leads->get();
			
			$returnLeads = [];
			$data = [];
			//$returnLeads['draw'] = $request->input('draw');
			//$returnLeads['recordsTotal'] = $leads->total();
			//$returnLeads['recordsFiltered'] = $leads->total();
			foreach($leads as $lead){				
				$assignedClientCategories = DB::table('assigned_client_categories')->where('client_id',$lead->id)->get();
				$clientCategories = DB::table('client_categories')->get();
				$acs = '';
				foreach($assignedClientCategories as $assignedClientCategory){
					foreach($clientCategories as $clientCategory){
						if($clientCategory->id==$assignedClientCategory->client_category_id){
							$acs .= $clientCategory->name.",";
						}
					}
				}
				$acs = trim(implode(",",explode(",",$acs)),' ,');
				
				$assignedLeadsCount = 0;
				$assignedLeadsCount = AssignedLead::where('client_id','=',$lead->id)->count();
				
				$type = 'General';
				switch($lead->client_type){
					case 'lead_based':
						$type = 'Lead Based';
						break;
					case 'yearly_subscription':
						$type = 'Yearly Subscription';
						break;
					case 'free_subscription':
						$type = 'Free Subscription';
						break;
				}
				
				$arr[] = [
					"Reg_Date" => date_format(date_create($lead->created_at),'d-F-Y'), 
					"UID" => $lead->username,
					"Business Name" => $lead->business_name,
					"Client Type" => $type,
					"Client Category" => (null==$acs?"":$acs),
					"Name" => $lead->first_name.' '.$lead->last_name,
					"City" => $lead->city,
					"Email" => $lead->email,
					"Mobile" => $lead->mobile,
					"Leads" => "$assignedLeadsCount",
					"Exp Date" => (($lead->yrly_subs_end_date!=NULL)?date_format(date_create($lead->yrly_subs_end_date),'d-F-Y'):"NULL"),
					"Remaining Amt" => (($lead->balance_amt==0||$lead->balance_amt==NULL)?"0":$lead->balance_amt),
					"Address" => $lead->address.', '.$lead->landmark.', '.$lead->city.', '.$lead->state.', '.$lead->country
				];
			}

			$excel = \App::make('excel');
			Excel::create('clients', function($excel) use($arr) {
				$excel->sheet('Sheet 1', function($sheet) use($arr) {
					$sheet->fromArray($arr);
				});
			})->export('xls');
		//}
    }
	
    /**
     * Handling client remark
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remark(Request $request, $id=null)
    { 
		if(null==$id){
			return response()-json(['msg'=>'Client Not Found'],400);
		}
		
		if($request->has('action') && $request->input('action') == 'getClientRF'){
			$html = '';
			$client = Client::where('username','LIKE',$id)->first();
			$remark = '';
			if(null!=$client->remark){
				$remarks = explode("|",$client->remark);
				$remarks = array_slice($remarks, -10, 10, true);
				//return $remarks;
				
				foreach($remarks as $remrk){
					if(!empty($remrk)){
						$remrk = explode("-",$remrk);
						$remrk = "[".date('d-m-Y H:i:s',$remrk[0])."] ".$remrk[1];
						$remark .= $remrk."<br>";						
					}
				}
			}
			 
			$warningDiv = '<div class="alert alert-warning">{{remark}}</div>';
			if(!empty($remark)){
				$warningDiv = preg_replace('/{{remark}}/',$remark,$warningDiv);
			}else{
				$remark .= '<strong>No Remark Available !!</strong><br>';
				$warningDiv = preg_replace('/{{remark}}/',$remark,$warningDiv);
			}
			$html .= '<div class="modal fade" id="client-remark-modal" role="dialog">
				<div class="modal-dialog">
					<form onsubmit="return client.submitClientRF(this)">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title"><i class="fa fa-fw fa-comments"></i> Enter remark to your client</h4>
							</div>
							<div class="modal-body">
								'.$warningDiv.'
								<div class="form-group">
									<label>Remark</label>
									<input type="hidden" name="client-id" value="'.$client->username.'" />
									<textarea name="client-remark" rows="5" class="form-control"></textarea>
								</div>
								<div class="has-error">
									<span class="help-block">
										<strong>Note:</strong>
										<strong>Use of | and - not allowed in remark</strong><br>
										<strong>Remark field cannot be blank</strong><br>
									</span>
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-default">Submit</button>
								<button type="button" class="btn btn-default" onclick="javascript:client.closeClientRF()">Close</button>
							</div>
						</div>
					</form>
				</div>
			</div>';
			return response()->json([$html],200);
		}
		
		if($request->has('action') && $request->input('action') == 'submitClientRF'){
			$client = Client::where('username','LIKE',$id)->first();
			$time = time();
			$html = "[".date('d-m-Y H:i:s',$time)."] ".$request->input('clientRemark');
			if(null==$client->remark){
				$client->remark = $time."-".$request->input('clientRemark');
			}else{
				$client->remark .= "|".$time."-".$request->input('clientRemark');
			}
			if($client->save()){
				return response()->json([$html],200);
			}
		}
	} 
	
	
	/**
     * Handling client remark
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remarkDiscussion(Request $request, $id=null)
    { 
		if(null==$id){
			return response()-json(['msg'=>'Client Not Found'],400);
		}
	 		   
			  $admin_id	= $request->user()->id; 
			
			if($request->input('action') == 'submitClientDiscussion'){
			$client = Client::where('username','LIKE',$id)->first();
			$discussion = $request->input('clientRemark');
			$add_data = array(
			'client_id'=>$client->id,
			'admin_id'=>$admin_id,
			'name'=>$request->user()->first_name,
			'discussion'=>$discussion,
			);

			$add  = DB::table('client_discussion')->insert($add_data);
				$client = Client::where('username',$id)->first();
				$discussion = DB::table('client_discussion')->where('client_id',$client->id)->where('admin_id',$admin_id)->get();
			 
			}
			$time = time();
			$html = "[".date('d-m-Y H:i:s',$time)."] ".$request->input('clientRemark');
			return response()->json([$html],200);
	}
	
	
	/**
     * Handling client remark
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function paymentClient(Request $request)
    { 
	
	 
	if($request->ajax()){
		
		//echo "<pre>";print_r($_POST);die;
	$id= $request->input('client-id');
		if(null==$id){
			return response()->json(['msg'=>'Client Not Found'],400);
		} 
	 		 $validator = Validator::make($request->all(),[
				 
				'business_name'=>'required',
				'package_name'=>'required',			 
				'paid_amount'=>'required',
				'gst_status'=>'required',
				'gst_total_amount'=>'required',
				'tds_status'=>'required',
				'total_amount'=>'required',
				// 'paid_amt_in_words'=>'required',
				'stud-payment_mode'=>'required',
				//'pay_mode_details'=>'required',
			//	'expired_from'=>'required',
			//	'expired_on'=>'required',
				'coins_amt'=>'required',
				// 'leads_count'=>'required',
				 
			]);
			if($validator->fails()){
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}


			 
			  	 
			if($request->input('pay-submit') == 'savepay' && !empty($request->input('paid_amount'))){			
				//echo "<pre>";print_r($_POST);die;
				$client = Client::withTrashed()->where('username',$id)->first();	
				// $updateClient = Client::findOrFail($client->id);
				// $updateClient->coins_amt = $updateClient->coins_amt + $request->input('coins_amt');
				// $updateClient->save();
				
				$paymenthistory = new PaymentHistory;
				$paymenthistory->client_id = $client->id;  	
				$paymenthistory->customer_name = $client->first_name.' '.$client->last_name;
				$paymenthistory->business_name = $request->input('business_name');
				$paymenthistory->mobile = $client->mobile;
				$paymenthistory->email = $client->email;
				$paymenthistory->package_name = $request->input('package_name');
				// $paymenthistory->leads_count = $request->input('leads_count');
				// $paymenthistory->cost_per_lead = $request->input('coins_lead');
				$paymenthistory->coins_amt = $request->input('coins_amt');
			//	$paymenthistory->expired_from = $request->input('expired_from');
			//	$paymenthistory->expired_on = $request->input('expired_on');
				$paymenthistory->selectproofid = $request->input('selectproofid');
				$paymenthistory->proofid = $request->input('proofid');
				$paid_amount= $request->input('paid_amount');
				$paymenthistory->paid_amount = $paid_amount;
				$tds_status = $request->input('tds_status');
				$paymenthistory->tds_status = $request->input('tds_status');
				$gst_tax = $request->input('gst_tax');
				$paymenthistory->gst_tax =$gst_tax;
				$gst_total_amount = $request->input('gst_total_amount');
				$paymenthistory->gst_total_amount = $gst_total_amount;	
				$gst_status = $request->input('gst_status');
				$paymenthistory->gst_status = $request->input('gst_status');
				$tds_amount = $request->input('tds_amount');
				$paymenthistory->tds_amount =$tds_amount;
				$total_amount = $request->input('total_amount');
				$paymenthistory->total_amount = $total_amount;				
				// $paid_amt_in_words=$request->input('paid_amt_in_words');
				// $paymenthistory->paid_amt_in_words = $paid_amt_in_words;
				//$pay_mode_details=$request->input('pay_mode_details');
				//$paymenthistory->pay_mode_details = $pay_mode_details;
				$transactionid=$request->input('transactionid');
				$paymenthistory->transactionid = $transactionid;			 
				$paymenthistory->paymentcollect = $request->user()->id;
			
				// payment mode
			if( !empty($request->input('stud-payment_mode')) ) {
				$stud_payment_mode = $request->input('stud-payment_mode');
				if( "cash" == $request->input('stud-payment_mode') ){					
					$stud_payment_bank = "cash";					
				}
				else if( "bank" == $stud_payment_mode ){
					if( !empty($request->input('stud-bank')) ){
						$stud_payment_bank = $request->input('stud-bank');
						$stud_card_no = $request->input('stud-card_no');
						$paymenthistory->bank_card_no = $stud_card_no;
						
					}
					 
					 		
				}
				else if( "cheque" == $stud_payment_mode ){
					if( !empty($request->input('stud-chq_no')) ){
						$stud_card_chq_no = $request->input('stud-chq_no');
						$paymenthistory->chq_card_no = $stud_card_chq_no;
						
					}
					 	$stud_payment_bank="cheque";		
				}

				else if( "paytm" == $stud_payment_mode ){
					if( !empty($request->input('stud-paytm')) ){
						$stud_paytm = $request->input('stud-paytm');
						$paymenthistory->pay_paytm = $stud_paytm;
						$stud_payment_bank="paytm";
					}
					 			
				}
				else if( "neft" == $stud_payment_mode ){
					if( !empty($request->input('stud-neft')) ){
						$stud_neft = $request->input('stud-neft');
						$paymenthistory->pay_neft = $stud_neft;
						$stud_payment_bank="neft";
					}
					 			
				}

			else if( "googlepay" == $stud_payment_mode ){
					if( !empty($request->input('stud-googlepay')) ){
						$pay_googlepay = $request->input('stud-googlepay');
						$paymenthistory->pay_googlePay = $pay_googlepay;
						$stud_payment_bank="googlepay";
					}
					 			
				}
				
				else{
					if( !empty($request->input('stud-'.$stud_payment_mode)) ){
						$stud_payment_bank = $request->input('stud-'.$stud_payment_mode);
					}
					 					
				}
				 
			}
				$paymenthistory->payment_mode = $stud_payment_mode;
				$paymenthistory->payment_bank = $stud_payment_bank; 						
	 
				if($paymenthistory->save()){					
					$paymentupdate = PaymentHistory::find($paymenthistory->id);
					$cityname = $request->input('business_name');
					$clientIDToAppend = $clientID=$client->id;
					/* if(strlen((string)$clientID)<4){
					$clientIDToAppend = str_pad($clientIDToAppend, 4, '0', STR_PAD_LEFT);
					} */					
					$order_number= strtoupper(substr($cityname,0,2)).$clientIDToAppend.$paymenthistory->id;					
					$paymentupdate->order_number = $order_number;
					$paymentupdate->save(); 					
					
					/* $assignKeyword = DB::table('assigned_kwds')
								->join('cities','assigned_kwds.city_id','=','cities.id')
								->join('parent_category','assigned_kwds.parent_cat_id','=','parent_category.id')
								->join('child_category','assigned_kwds.child_cat_id','=','child_category.id')
								->join('keyword','assigned_kwds.kw_id','=','keyword.id')
								->select('assigned_kwds.*','cities.city','parent_category.parent_category','child_category.child_category','keyword.keyword')
								->where('assigned_kwds.client_id',$client->id)
								->get();
								 								
					Mail::send('emails.send_client-orderform',['client'=>$client,'order_number'=>$order_number,'total_amount'=>$total_amount,'paid_amount'=>$paid_amount,'gst_tax'=>$gst_tax,'tds_amount'=>$tds_amount,'payment_mode'=>$stud_payment_mode,'assignKeyword'=>$assignKeyword,'paid_amt_in_words'=>$paid_amt_in_words,'pay_mode_details'=>$pay_mode_details,'transactionid'=>$transactionid,'paymentupdate'=>$paymentupdate], function ($m) use ($client) {
				$m->from('info@quickindia.in', 'Quickindia');
				$email = "info@quickindia.in";
				$m->to("info@quickindia.in", $client->first_name." ".$client->last_name)->subject('Quickindia Order Details')->cc('help@quickindia.in');
			}); */
					
					
					
					return response()->json(['status'=>1,'success'=>'Client Order payment successfully !!']);
				}else{
					return response()->json(['status'=>0,'failed'=>'Client not updated !!']);
				}
				  
			
			
	}
	
	}
	}
	
	 /**
     * Get paginated leads.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPaginatedPaymentHistory(Request $request, $id=null)
    {
		 
		//if($request->ajax()){
			//$leads = Lead::orderBy('id','desc')->paginate($request->input('length'));
			if(null!==$id){
				$client = Client::where('username',$id)->first();
				$clientID = $client->id;
			}
			$payments = DB::table('payment_histories')
					   ->where('client_id',$clientID)
					   ->orderBy('created_at','desc')
					   ->paginate($request->input('length'));
					   
			$returnLeads = $data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $payments->total();
			$returnLeads['recordsFiltered'] = $payments->total();
			foreach($payments as $payment){
				$orderpdf = '';
				$invoicepdf = '';
				$action = '';
				$separator = '';
				$proforma = '';
				 $orderpdf .= $separator.'<a href="javascript:void(0)" data-toggle="popover" title="Oder PDF" id="paymentPrint" data-trigger="hover" data-placement="left" data-sid="'.$payment->id.'"><i aria-hidden="true" class="fa fa-file-pdf-o"></i></a> ';			 
				$proforma .= $separator.'<a href="javascript:void(0)" data-toggle="popover" title="Proforma Invoice PDF" id="proformaPrintPdf" data-trigger="hover" data-placement="left" data-sid="'.$payment->id.'"><i aria-hidden="true" class="fa fa-file-pdf-o"></i></a>'; 	
				if($payment->invoice_status ==1){
				$invoicepdf .= $separator.'<a href="javascript:void(0)" data-toggle="popover" title="Invoice PDF" id="invoicePrintPdf" data-trigger="hover" data-placement="left" data-sid="'.$payment->id.'"><i aria-hidden="true" class="fa fa-file-pdf-o"></i></a>'; 
				}else{					
					if(Auth::user()->current_user_can('administrator') || Auth::user()->current_user_can('client_invoice_approved')){
				$invoicepdf .= $separator.'<a href="javascript:client.clientOrderHistoryStatus('.$payment->id.')" data-toggle="popover" title="Invoice Status Pending" ><i aria-hidden="true" class="fa fa-thumbs-up"></i></a>'; 
					}
				}

				 $action .= $separator.'<a href="/developer/order-history/update/'.base64_encode($payment->id).'" class="btn btn-info btn-sm"><i class="fa fa-refresh fa-fw" aria-hidden="true"></i></a>';
					if($request->user()->current_user_can('administrator')){
					$action .= $separator.' <a href="javascript:client.clientOrderHistoryDelete('.$payment->id.')" title="clientOrderhistory Delete"><i class="fa fa-fw fa-trash"></i></a>';
					}	    					

						
				$data[] = [
					date_format(date_create($payment->created_at),'d M Y'),
					$payment->paid_amount,
					$payment->gst_tax,
					$payment->total_amount,
					ucfirst($payment->payment_mode),
					$orderpdf,
					$proforma,
					$invoicepdf,
					$action,
					
				];
			}
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
		//}
    }
	
	
	
	
	
	public function getpaymentPrintfile(Request $request) { 
	 
	return view('admin.getPaymentPrintSlip');
	}




	public function getpaymentPrint(Request $request) {
		if(isset($_POST['pid']))
			{
			
			if($request->input('action') == 'getPaymentPrint')
			{
			$paymnetid = $_POST['pid'];
		
			$paymentuprint = PaymentHistory::find($paymnetid);
			$client = Client::withTrashed()->where('id',$paymentuprint->client_id)->first();
			$assignKeyword = DB::table('assigned_kwds')
								->join('citylists','assigned_kwds.city_id','=','citylists.id')
								->join('parent_category','assigned_kwds.parent_cat_id','=','parent_category.id')
								->join('child_category','assigned_kwds.child_cat_id','=','child_category.id')
								->join('keyword','assigned_kwds.kw_id','=','keyword.id')
								->select('assigned_kwds.*','citylists.city','parent_category.parent_category','child_category.child_category','keyword.keyword')
								->where('assigned_kwds.client_id',$client->id)
								->get();
			 
			return response()->view("admin.getPaymentPrintSlip",['paymentuprint'=>$paymentuprint,'client'=>$client,'assignKeyword'=>$assignKeyword]);die;
			}
		}


	}
		
		
	public function getinvoicePrintPdf(Request $request) {
		if(isset($_POST['pid']))
			{
			
			if($request->input('action') == 'getinvoicePrintPdf')
			{
			$paymnetid = $_POST['pid'];		
			$paymentprint = PaymentHistory::find($paymnetid);
			$client = Client::withTrashed()->where('id',$paymentprint->client_id)->first();	  							
			return response()->view("admin.getInvoicePrintPdfSlip",['paymentprint'=>$paymentprint,'client'=>$client]);
			
			die;
			}
		}


	}
	
	public function getproformaPrintPdf(Request $request) {
		if(isset($_POST['pid']))
		{			
			if($request->input('action') == 'getproformaPrintPdf')
			{
			$paymnetid = $_POST['pid'];		
			$paymentprint = PaymentHistory::find($paymnetid);
			$client = Client::withTrashed()->where('id',$paymentprint->client_id)->first();	  							
			return response()->view("admin.getproformaPrintPdf",['paymentprint'=>$paymentprint,'client'=>$client]);
			
			die;
			}
		}


	}
		
		
	/**
	 * Show resource update form.
	 *
	 * @param client id
	 * @param target id
	 * @param Request
	 * @return resource update form
	 */
	public function editAssignedKeyword(Request $request, $id, $target_id){
		 
		$assignedKwd = AssignedKWDS::findOrFail($target_id);
		 
		$citylist = Citieslists::all();				
					
		$cityOptions = "<option value=\"\">Select City</option>";
		if(count($citylist)>0){
			foreach($citylist as $distinctCity){
				$selected = "";
				if($distinctCity->id == $assignedKwd->city_id)
					$selected = "selected";
				$cityOptions .= "<option value=\"{$distinctCity->id}\" {$selected}>{$distinctCity->city}</option>";
			}
		}
		 
		
		$zonelist = DB::table('zones')							 
		->select('zones.*')						 
		->where('zones.city_id',$assignedKwd->city_id)						 
		->get();

		$zoneOptions = "<option value=\"\">Select Zone</option>";
		if(count($zonelist)>0){
		foreach($zonelist as $zone){
		$selected = "";
		if($zone->id == $assignedKwd->zone_id)
		$selected = "selected";
		$zoneOptions .= "<option value=\"{$zone->id}\" {$selected}>{$zone->zone}</option>";
		}
		}
	 
		$parentCategory = ParentCategory::all();		
			 
									
		$parentCatOptions = "<option value=''>Select Parent</option>";
		if(count($parentCategory)>0){
			foreach($parentCategory as $parent_cat){
				$selected = "";
				if($parent_cat->id == $assignedKwd->parent_cat_id)
					$selected = "selected";
				$parentCatOptions .= "<option value=\"{$parent_cat->id}\" {$selected}>{$parent_cat->parent_category}</option>";
			}
		}
		  $child_cats = DB::table('keyword')
					->join('child_category','keyword.child_category_id','=','child_category.id')
					->select('child_category.id','child_category.child_category','keyword.parent_category_id','keyword.child_category_id')
					//->where('keyword.city_id',$assignedKwd->city_id)
					->where('keyword.parent_category_id',$assignedKwd->parent_cat_id)
					->groupBy('child_category_id')
					//->distinct()
					->get();  
				 
					
					
	//	$child_cats = ChildCategory::where('parent_category_id',$assignedKwd->parent_cat_id)->get();
					//echo "<pre>";print_r($child_cats);
					//echo $assignedKwd->child_cat_id;die;
		$childCatOptions = "<option value=''>Select Child</option>";
		if(count($child_cats)>0){
			foreach($child_cats as $child_cat){
				$selected = "";
				if($child_cat->id == $assignedKwd->child_cat_id)
					$selected = "selected";
				$childCatOptions .= "<option value=\"{$child_cat->id}\" {$selected}>{$child_cat->child_category}</option>";
			}
		}
		$child_cats = DB::table('keyword')
					//->where('city_id',$assignedKwd->city_id)
					->where('parent_category_id',$assignedKwd->parent_cat_id)
					->where('child_category_id',$assignedKwd->child_cat_id)
					->get();
		$keywordOptions = "<option value=''>Select Keyword</option>";
		//$keywordOptions = "";
		if(count($child_cats)>0){
			foreach($child_cats as $child_cat){
				$selected = "";
				if($child_cat->id == $assignedKwd->kw_id)
					$selected = "selected";
				$keywordOptions .= "<option value=\"{$child_cat->id}\" {$selected}>{$child_cat->keyword}</option>";
			}
		}
		$keyword = Keyword::find($assignedKwd->kw_id);
		$keywordSellCount = KeywordSellCount::all();
		
			$assKWDSC = AssignedKWDS::where('city_id',$assignedKwd->city_id)->where('kw_id',$assignedKwd->kw_id)->where('sold_on_position','platinum')->where('id','!=',$target_id)->get()->count();
		//	$assKWDSC = AssignedKWDS::where('city_id',$assignedKwd->city_id)->where('kw_id',$assignedKwd->kw_id)->where('sold_on_position','platinum')->get()->count();
			 
		$result = [];
		foreach($keywordSellCount as $ksc){		
			 
			switch($ksc->slug){
				case 'platinum':
				if( ($assKWDSC <= 2) && (((($ksc->count)+3) -$assKWDSC - $keyword->platinum_pos_sold) > 0) )					
						$result['platinum'] = 'Platinum';
				break;
				case 'diamond':
					if($ksc->count - $keyword->diamond_pos_sold > 0)
						$result['diamond'] = 'Diamond';
				break;
				 
			}
		}
		  
		 
		$positionOptions = "<option value=''>Select Position</option>";
		if(count($result)>0){	 
		if(!array_key_exists($assignedKwd->sold_on_position,$result))
			 $result[$assignedKwd->sold_on_position] = ucwords($assignedKwd->sold_on_position);
			foreach($result as $key=>$value){
				$selected = "";
				if($key == $assignedKwd->sold_on_position){
					$selected = "selected";
				$positionOptions .= "<option value=\"{$key}\" {$selected}>{$value}</option>";
				}else{
					$positionOptions .= "<option value=\"{$key}\" >{$value}</option>";
					
				}
			}
			 
		}
		
		$price = '';
			$resultPrice = [];
		//$price = "";
		$keyword = Keyword::find($assignedKwd->kw_id);
		$keywordSellCount = KeywordSellCount::where('slug',$assignedKwd->sold_on_position)->first();	
		 		
		if(!empty($keywordSellCount)){

		if($keyword->category=='Category 1'){
			$resultPrice['price'] = $keywordSellCount->cat1_price;
		}
		else if($keyword->category=='Category 2'){
			$resultPrice['price'] = $keywordSellCount->cat2_price;
		}
		else if($keyword->category=='Category 3'){
			$resultPrice['price'] = $keywordSellCount->cat3_price;
		}
		else if($keyword->category=='Category X'){
			switch($assignedKwd->sold_on_position){
				case 'diamond':
					$resultPrice['price'] = $keyword->premium_price;
				break;
				case 'platinum':
					$resultPrice['price'] = $keyword->platinum_price;
				break;
				 
			}
		}
		}

 
		$html = "
				<div class=\"modal-body\">
					<form class=\"form-horizontal\" enctype=\"multipart/form-data\" action=\"".url('developer/clients/update/'.$id.'/update-assigned-keyword/'.$target_id)."\" method=\"POST\" id=\"update-assigned-keyword\">
						<div class=\"form-group\">
							<label class=\"control-label col-sm-2\">City:</label>
							<div class=\"col-sm-10\">
								<select class=\"select2-single city form-control\" name=\"city\">
								{$cityOptions}
								</select>
							</div>
						</div>
						
						<div class=\"form-group\">
							<label class=\"control-label col-sm-2\">Zone:</label>
							<div class=\"col-sm-10\">
								<select class=\"form-control zone\" name=\"zone_id\">
								{$zoneOptions}
								</select>
							</div>
						</div>
						
						<div class=\"form-group\">
							<label class=\"control-label col-sm-2\">Parent:</label>
							<div class=\"col-sm-10\">
								<select class=\"select2-single parent form-control\" name=\"parent\">
								{$parentCatOptions}
								</select>
							</div>
						</div>
						<div class=\"form-group\">
							<label class=\"control-label col-sm-2\">Child:</label>
							<div class=\"col-sm-10\">
								<select class=\"select2-single child form-control\" name=\"child\">
								{$childCatOptions}
								</select>
							</div>
						</div>
						<div class=\"form-group\">
							<label class=\"control-label col-sm-2\">Keyword:</label>
							<div class=\"col-sm-10\">
								<select class=\"form-control kw\" name=\"kw\">
								{$keywordOptions}
								</select>
							</div>
						</div>
						<div class=\"form-group\">
							<label class=\"control-label col-sm-2\">Position:</label>
							<div class=\"col-sm-10\">
								<select class=\"select2-single position form-control\" name=\"position\">
								{$positionOptions}
								</select>
							</div>
						</div>
						<div class=\"form-group\">
							<label class=\"control-label col-sm-2\">Price:</label>
							<div class=\"col-sm-10\">
								<input type=\"text\" class=\"form-control price\" value=\"{$resultPrice['price']}\" name=\"price\">
							</div>
						</div>
						<div class=\"form-group\">
							<div class=\"col-sm-offset-2 col-sm-10\">
								<button type=\"submit\" class=\"btn btn-default\">Submit</button>
								<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
							</div>
						</div>
					</form>
				</div>";
		return response()->json(['html'=>$html],200);
	}
	
	/**
	 * Update resource specified.
	 *
	 * @param Request
	 * @param client id
	 * @param target id
	 */
	public function updateAssignedKeyword(Request $request, $id, $target_id){
		if($request->ajax()){
			$client = Client::withTrashed()->where('username',$id)->first();
			//echo "<pre>";print_r($_POST);die;
			/* if($client->client_type=="free_subscription" || $client->client_type=="general"){
				$kwds = DB::table('assigned_kwds')
							->join('citylists','assigned_kwds.city_id','=','citylists.id')
							->join('parent_category','assigned_kwds.parent_cat_id','=','parent_category.id')
							->join('child_category','assigned_kwds.child_cat_id','=','child_category.id')
							->join('keyword','assigned_kwds.kw_id','=','keyword.id')
							->select('assigned_kwds.*','citylists.city','parent_category.parent_category','child_category.child_category','keyword.keyword')
							->where('assigned_kwds.client_id',$client->id)
							->get();
				if(count($kwds)>=$client->max_kw){
					return response()->json(['status'=>0,'message'=>'You can\'t add more than '.$client->max_kw.' keywords']);
				}
			} */
		//	echo "<pre>";print_r($_POST);die;
			
			$validator = Validator::make($request->all(),[
				 
				'city'=>'required',
				'zone_id'=>'required',
				'parent'=>'required',			 
				'child'=>'required',
				'kw'=>'required',
				'position'=>'required',
				 
				 
			]);
			if($validator->fails()){
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}
			
			$validator = Validator::make($request->all(), [
				'kw' => 'required|unique:assigned_kwds,kw_id,'.$target_id.',id,child_cat_id,'.$request->input('child').',parent_cat_id,'.$request->input('parent').',city_id,'.$request->input('city').',client_id,'.$client->id,
			]);
			if ($validator->fails()) {
				return response()->json(['status'=>0,'message'=>'Assigned keyword must be unique']);
			}
			
			$assignedKWDS = AssignedKWDS::findOrFail($target_id);
			//$assignedKWDS->client_id = $client->id;
			// backing up old sold_on_position
				$old_sold_on_position = $assignedKWDS->sold_on_position;
			// backing up old sold_on_position
			$assignedKWDS->city_id = $request->input('city');
			$assignedKWDS->zone_id = $request->input('zone_id');
			$assignedKWDS->parent_cat_id = $request->input('parent');
			$assignedKWDS->child_cat_id = $request->input('child');
			$assignedKWDS->kw_id = $request->input('kw');
			$assignedKWDS->sold_on_position = $request->input('position');
			$assignedKWDS->sold_on_price = $request->input('price');
			
			$keyword = Keyword::find($request->input('kw'));
			$keywordSellCount = KeywordSellCount::where('slug',$request->input('position'))->first();			
			if($keyword->category==='Category 1'){
				$assignedKWDS->sold_on_price = $keywordSellCount->cat1_price;
			}
			else if($keyword->category==='Category 2'){
				$assignedKWDS->sold_on_price = $keywordSellCount->cat2_price;
			}
			else if($keyword->category==='Category 3'){
				$assignedKWDS->sold_on_price = $keywordSellCount->cat3_price;
			}
			else if($keyword->category==='Category X'){
				switch($request->input('position')){
					case 'diamond':
						$assignedKWDS->sold_on_price = $keyword->diamond_price;
					break;
					case 'platinum':
						$assignedKWDS->sold_on_price = $keyword->platinum_price;
					break;
					 
				}
			} 
			
			if($assignedKWDS->save()){
				switch($request->input('position')){
					case 'diamond':
						$keyword->diamond_pos_sold = $keyword->diamond_pos_sold + 1;
					break;
					case 'platinum':
						$keyword->platinum_pos_sold = $keyword->platinum_pos_sold + 1;
					break;
					 
				}
				switch($old_sold_on_position){
					case 'diamond':
						$keyword->diamond_pos_sold = $keyword->diamond_pos_sold - 1;
					break;
					case 'platinum':
						$keyword->platinum_pos_sold = $keyword->platinum_pos_sold - 1;
					break;
					 
				}
				$keyword->save();
				return response()->json(['status'=>1,'result'=>'Assigned keyword updated successfully']);
			}else{
				return response()->json(['status'=>0,'result'=>'Assigned keyword not updated successfully']);
			}
		}
	}

	/**
	 *
	 *
	 *
	 */
	public function getAssignedZones(Request $request, $id){
		$client_username = $id;
		if($request->ajax()){
			$client = Client::where('username',$client_username)->first();
			
			$assignedZones = DB::table(DB::raw("(SELECT * FROM assigned_zones WHERE client_id={$client->id} ) as aa"));
			$assignedZones = $assignedZones->join('zones','zones.id','=',DB::raw('`aa`.`zone_id`'));
			$assignedZones = $assignedZones->join('citylists','citylists.id','=','zones.city_id');
			$assignedZones = $assignedZones->select('aa.id','aa.client_id','aa.zone_id','zones.zone','zones.city_id','citylists.city');
			// $assignedAreas = $assignedAreas->toSql();
			// dd($assignedAreas);
			$assignedZones = $assignedZones->orderBy('aa.id','desc');
			$assignedZones = $assignedZones->paginate($request->input('length'));
			$returnassignedzones = $data = [];
			$returnassignedzones['draw'] = $request->input('draw');
			$returnassignedzones['recordsTotal'] = $assignedZones->total();
			$returnassignedzones['recordsFiltered'] = $assignedZones->total();
			foreach($assignedZones as $assignedzone){
				$data[] = [
					//$assignedzone->area,
					$assignedzone->zone,
					$assignedzone->city,
					'<a href="javascript:void(0)" onclick="assignedAreaController.editZoneClient('.$assignedzone->id.')" title="Zone Edit"><i class="fa fa-refresh" aria-hidden="true"></i></a> | <a href="javascript:assignedZoneController.delete('.$assignedzone->id.')"><i class="fa fa-trash" aria-hidden="true"></i></a>'
					
					// <a href="javascript:void(0)" onclick="assignedAreaController.update('.$assignedzone->id.')" title="Update assigned zone"><i class="fa fa-eye" aria-hidden="true"></i></a>
				];
			}
			$returnassignedzones['data'] = $data;
			return response()->json($returnassignedzones);
		}
	}
	
	/**
	 *
	 *
	 *
	 */
	public function getAssignedAreas(Request $request, $id){
		$client_username = $id;
		if($request->ajax()){
			$client = Client::where('username',$client_username)->first();
			
			$assignedAreas = DB::table(DB::raw("(SELECT * FROM assigned_areas WHERE client_id={$client->id} ) as aa"));
			$assignedAreas = $assignedAreas->join('areas','areas.id','=',DB::raw('`aa`.`area_id`'));
			$assignedAreas = $assignedAreas->join('zones','zones.id','=','areas.zone_id');
			$assignedAreas = $assignedAreas->join('citylists','citylists.id','=','zones.city_id');
			$assignedAreas = $assignedAreas->select('aa.id','aa.client_id','aa.area_id','areas.area','areas.zone_id','zones.zone','zones.city_id','citylists.city');
			// $assignedAreas = $assignedAreas->toSql();
			// dd($assignedAreas);
			$assignedAreas = $assignedAreas->orderBy('aa.id','desc');
			$assignedAreas = $assignedAreas->paginate($request->input('length'));
			$returnassignedareas = $data = [];
			$returnassignedareas['draw'] = $request->input('draw');
			$returnassignedareas['recordsTotal'] = $assignedAreas->total();
			$returnassignedareas['recordsFiltered'] = $assignedAreas->total();
			foreach($assignedAreas as $assignedarea){
				$data[] = [
					$assignedarea->area,
					$assignedarea->zone,
					$assignedarea->city,
					'<a href="/developer/area/update/'.$assignedarea->id.'"><i class="fa fa-refresh" aria-hidden="true"></i></a> | <a href="javascript:assignedAreaController.delete('.$assignedarea->id.')"><i class="fa fa-trash" aria-hidden="true"></i></a>'
				];
			}
			$returnassignedareas['data'] = $data;
			return response()->json($returnassignedareas);
		}
	}
	
	/**
	 * We are considering area as zone for now
	 *
	 */
	public function addAreaToClient(Request $request, $id){
		$client_username = $id;
		$client = Client::where('username',$client_username)->first();
		
		$validator = Validator::make($request->all(),[
			'area_id'=>'required|unique:assigned_areas,area_id,NULL,id,client_id,'.$client->id,
			'zone_id'=>'required'
			//'city_id'=>'required',
		]);
		
		if($validator->fails()){
			$errorsBag = $validator->getMessageBag()->toArray();
			$errors = [];
			foreach($errorsBag as $error){
				$errors[] = implode("<br/>",$error);
			}
			$errors = implode("<br/>",$errors);
			return response()->json([
				"statusCode"=>0,
				"data"=>[
					"responseCode"=>200,
					"payload"=>"",
					"message"=>$errors
				]
			],200);
		}
		
		$assignedArea = new AssignedArea;
		$assignedArea->area_id = $request->input('area_id');
		$assignedArea->client_id = $client->id;
		if($assignedArea->save()){
			return response()->json([
				"statusCode"=>1,
				"data"=>[
					"responseCode"=>200,
					"payload"=>"",
					"message"=>"Area assgined successfully !!"
				]
			],200);
		}else{
			return response()->json([
				"statusCode"=>0,
				"data"=>[
					"responseCode"=>400,
					"payload"=>"",
					"message"=>"area not assigned !!"
				]
			],200);
		}
	}
	
	/**
	 * We are considering area as zone for now
	 *
	 */
	public function addZoneToClient(Request $request, $id){
		
		if($request->ajax()){ 
		try{
			if(!($request->user()->current_user_can('administrator') || $request->user()->current_user_can('client_update') )){
				 $status = false;
				 $msg = 'Unauthorised Permission';
				 $code = 400;
			} 
		$client_username = $id;
		$client = Client::where('username',$client_username)->first();
		 

		$validator = Validator::make($request->all(),[					
			'zone_id'=>'required|unique:assigned_zones,zone_id,NULL,id,client_id,'.$client->id,		 
			'city_id'=>'required',			 	

		]);


		if ($validator->fails()) {
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
		} 

 
 
		
		
		$assignedZone = new AssignedZone;
		$assignedZone->zone_id = $request->input('zone_id');
		$city = Citieslists::where('city',$request->input('city_id'))->first();
		 
		$assignedZone->city_id = $city->id;
		$assignedZone->client_id = $client->id;
		if($assignedZone->save()){
			$areas = DB::table('areas');
			$areas = $areas->where('areas.zone_id','=',$assignedZone->zone_id);
			$areas = $areas->select('areas.id','areas.area');
			$areas = $areas->get();
			if(count($areas)>0){
				foreach($areas as $area){
					$assigneddArea = new AssigneddArea;
					$assigneddArea->assigned_zone_id = $assignedZone->id;
					$assigneddArea->area_id = $area->id;
					$assigneddArea->save();
				}
			}
			 
			$status= true;
			$msg = 'Zone assgined successfully ';
			$code = 200;
		}else{
			 
			$status= false;
			$msg = 'Zone not assigned';
			$code = 400;
		}

		}catch(Exception $e){
				$status= false;
				$msg = $e->getMessage();
				$code = 400;
			}
			return response()->json(['status'=>$status,'msg'=>$msg],$code); 	
		
		}
	}
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAreaFromClient(Request $request, $id, $assigned_area_id)
    {
		try{
			$assginedArea = AssignedArea::findorFail($assigned_area_id);
			if($assginedArea->delete()){
				return response()->json([
					"statusCode"=>1,
					"data"=>[
						"responseCode"=>200,
						"payload"=>"",
						"message"=>"Assigned area deleted successfully !!"
					]
				],200);
			}else{
				return response()->json([
					"statusCode"=>0,
					"data"=>[
						"responseCode"=>400,
						"payload"=>"",
						"message"=>"Assigned area not deleted !!"
					]
				],200);
			}
		}catch(\Exception $e){
			return response()->json([
				"statusCode"=>0,
				"data"=>[
					"responseCode"=>404,
					"payload"=>"",
					"message"=>"Assigned area not found !!"
				]
			],200);
		}
    }
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyZoneFromClient(Request $request, $id, $assigned_zone_id)
    {
		try{
			$assginedArea = AssignedZone::findorFail($assigned_zone_id);
			if($assginedArea->delete()){
				return response()->json([
					"statusCode"=>1,
					"data"=>[
						"responseCode"=>200,
						"payload"=>"",
						"message"=>"Assigned zone deleted successfully !!"
					]
				],200);
			}else{
				return response()->json([
					"statusCode"=>0,
					"data"=>[
						"responseCode"=>400,
						"payload"=>"",
						"message"=>"Assigned zone not deleted !!"
					]
				],200);
			}
		}catch(\Exception $e){
			return response()->json([
				"statusCode"=>0,
				"data"=>[
					"responseCode"=>404,
					"payload"=>"",
					"message"=>"Assigned zone not found !!"
				]
			],200);
		}
    }
	
	/**
	 * Show the form for editing the specified resource assigned to client.
	 *
	 * @param $request,$id,form.
	 * @return JSON.
	 */
	public function editAssignedZone(Request $request, $id, $assigned_zone_id){
		$client_username = $id;
		try{
			$client = Client::where('username',$client_username)->first();
			if($client){
				$assignedZone = DB::table(DB::raw("(SELECT * FROM assigned_zones WHERE id={$assigned_zone_id} ) as aa"));
				$assignedZone = $assignedZone->join('zones','zones.id','=',DB::raw('`aa`.`zone_id`'));
				$assignedZone = $assignedZone->join('citylists','citylists.id','=','zones.city_id');
				$assignedZone = $assignedZone->select('aa.id','aa.client_id','aa.zone_id','zones.zone','zones.city_id','citylists.city');
				$assignedZone = $assignedZone->first();
				
				$areas = DB::table('areas');
				$areas = $areas->where('areas.zone_id','=',$assignedZone->zone_id);
				$areas = $areas->select('areas.id','areas.area');
				$areas = $areas->get();
				
				$assignedAreas = DB::table('assignedd_areas');
				$assignedAreas = $assignedAreas->where('assigned_zone_id',$assignedZone->id);
				$assignedAreas = $assignedAreas->select('assignedd_areas.area_id')->get();
				
				$tmp = [];
				foreach($assignedAreas as $assignedArea){
					$tmp[] = $assignedArea->area_id;
				}
				$assignedArea = $tmp;
				
				$allAreasHtml = '';
				foreach($areas as $area){
					$checked = '';
					if(count($assignedArea)>0 && in_array($area->id,$assignedArea)){
						$checked = 'checked';
					}
					$allAreasHtml .= '
						<div class="col-md-4">
							<div class="checkbox">
								<label><input type="checkbox" name="assigned_areas[]" value="'.$area->id.'" '.$checked.'> '.$area->area.'</label>
							</div>
						</div>
					';
				}
				
				$html = '
					<div id="editAssignedZone" class="modal fade" role="dialog">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<form id="assignedZoneAreas" role="form" action="" method="POST">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">'.$assignedZone->city.' -> '.$assignedZone->zone.'</h4>
										'.csrf_field().'
										<input type="hidden" name="assigned-zone-record-id" value="'.$assignedZone->id.'" />
									</div>
									<div class="modal-body">
										<div class="alert alert-danger hide"></div>
										<div class="alert alert-success hide"></div>
										<div class="container col-md-12">
											<div class="row">
											'.$allAreasHtml.'
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="modal-footer">
										<button type="button" class="pull-left btn btn-default" onclick="checkAll(\'editAssignedZone\')">Check All</button>
										<button type="button" class="pull-left btn btn-default" onclick="unCheckAll(\'editAssignedZone\')">Uncheck All</button>
										<button type="submit" class="btn btn-default">Submit</button>
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				';
				return response()->json([
					'statusCode'=>1,
					'data'=>[
						'responseCode'=>200,
						'payload'=>$html,
						'message'=>''
					]
				],200);
			}else{
				throw new Exception('No client found having id: '.$client_username);
			}
		}catch(\Exception $e){
			return response()->json([
				'statusCode'=>0,
				'data'=>[
					'responseCode'=>404,
					'payload'=>'',
					'message'=>$e->getMessage()
				]
			],200);
		}
	}
	
	/**
	 * Show the form for editing the specified resource assigned to client.
	 *
	 * @param $request,$id,form.
	 * @return JSON.
	 */
	public function editAssignedZoneClient(Request $request, $id, $assigned_zone_id){
		$client_username = $id;
		
		//echo $assigned_zone_id;die;
		try{
			$client = Client::where('username',$client_username)->first();
			if($client){
				
				
				$assignedZone = AssignedZone:: findOrFail($assigned_zone_id);
				//echo "<pre>";print_r($assignedZone);die;
				DB::table(DB::raw("(SELECT * FROM assigned_zones WHERE id={$assigned_zone_id} ) as aa"));
				$assignedZone = DB::table(DB::raw("(SELECT * FROM assigned_zones WHERE id={$assigned_zone_id} ) as aa"));
				$assignedZone = $assignedZone->join('zones','zones.id','=',DB::raw('`aa`.`zone_id`'));
				$assignedZone = $assignedZone->join('citylists','citylists.id','=','zones.city_id');
				$assignedZone = $assignedZone->select('aa.id','aa.client_id','aa.zone_id','zones.zone','zones.city_id','citylists.city');
				$assignedZone = $assignedZone->first();
				
				$areas = DB::table('areas');
				$areas = $areas->where('areas.zone_id','=',$assignedZone->zone_id);
				$areas = $areas->select('areas.id','areas.area');
				$areas = $areas->get();
				
				$assignedAreas = DB::table('assignedd_areas');
				$assignedAreas = $assignedAreas->where('assigned_zone_id',$assignedZone->id);
				$assignedAreas = $assignedAreas->select('assignedd_areas.area_id')->get();
				
				$tmp = [];
				foreach($assignedAreas as $assignedArea){
					$tmp[] = $assignedArea->area_id;
				}
				$assignedArea = $tmp;
				
				$allAreasHtml = '';
				 $citieslists = Citieslists::orderBy('city','ASC')->get();
				$cityHtml = '';
				if(!empty($citieslists)){
				foreach($citieslists as $city){
				if($city->city == $assignedZone->city_id){
				$cityHtml .= '<option value="'.$city->city.'" selected>'.$city->city.'</option>';
				}else{
				$cityHtml .= '<option value="'.$city->city.'">'.$city->city.'</option>';
				}
				}
				}
				
				$html = '
					<div id="editAssignedZone" class="modal fade" role="dialog">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<form id="assignedZoneAreas" role="form" action="" method="POST">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Zone Edit</h4>										 
										<input type="hidden" name="assigned-zone-record-id" value="'.$assignedZone->id.'" />
									</div>
									<div class="modal-body">
									
										<div class="alert alert-danger hide"></div>
										<div class="alert alert-success hide"></div>
										<div class="container col-md-12">
											 
											
												<div class="row">
											<div class="col-md-4 text-right">	
									<div class="form-group">
										<div class="row">
										
										<label for="">City:</label>
										<select class="form-control location city select2-single" name="city_id">
															<option value="">-- SELECT CITY --</option>
																'.$cityHtml.'
														</select>
										</div>
									</div>
									</div>
									
									<div class="col-md-4 text-right">
									<div class="form-group">
										<label for="">Zone:</label>
										<select name="zone_id" class="form-control"></select>
										<button type="reset" class="btn btn-primary" style="margin-top:10px;">Reset</button>
										<input type="submit" class="btn btn-info" value="Submit" style="margin-top:10px;">
									</div>
									</div>
											</div>
											
											
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="modal-footer">
										<button type="button" class="pull-left btn btn-default" onclick="checkAll(\'editAssignedZone\')">Check All</button>
										<button type="button" class="pull-left btn btn-default" onclick="unCheckAll(\'editAssignedZone\')">Uncheck All</button>
										<button type="submit" class="btn btn-default">Submit</button>
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				';
				return response()->json([
					'statusCode'=>1,
					'data'=>[
						'responseCode'=>200,
						'payload'=>$html,
						'message'=>''
					]
				],200);
			}else{
				throw new Exception('No client found having id: '.$client_username);
			}
		}catch(\Exception $e){
			return response()->json([
				'statusCode'=>0,
				'data'=>[
					'responseCode'=>404,
					'payload'=>'',
					'message'=>$e->getMessage()
				]
			],200);
		}
	}
	
	/**
	 * Show the form for editing the specified resource assigned to client.
	 *
	 * @param $request,$id,form.
	 * @return JSON.
	 */
	public function updateAssignedZoneAreas(Request $request, $id){
		// $a = $request->input('assigned_areas');
		// if(in_array('283',$a)){
			// dd($a[0]);
		// }
		$client_username = $id;
		$assigned_zone_id = $request->input('assigned-zone-record-id');
		//submitted areas
		$requestAssignedAreas = $request->input('assigned_areas');
		$tmp = [];
		if(count($requestAssignedAreas)>0){
			foreach($requestAssignedAreas as $requestAssignedArea){
				$tmp[] = $requestAssignedArea;
			}
		}
		$requestAssignedAreas = $tmp;
		try{
			$client = Client::where('username',$client_username)->first();
			if($client){
				$assignedZone = DB::table(DB::raw("(SELECT * FROM assigned_zones WHERE id={$assigned_zone_id} ) as aa"));
				$assignedZone = $assignedZone->join('zones','zones.id','=',DB::raw('`aa`.`zone_id`'));
				$assignedZone = $assignedZone->join('citylists','citylists.id','=','zones.city_id');
				$assignedZone = $assignedZone->select('aa.id','aa.client_id','aa.zone_id','zones.zone','zones.city_id','citylists.city');
				$assignedZone = $assignedZone->first();
				
				//all areas
				$areas = DB::table('areas');
				$areas = $areas->where('areas.zone_id','=',$assignedZone->zone_id);
				$areas = $areas->select('areas.id','areas.area');
				$areas = $areas->get();
				
				//assigned areas
				$assignedAreas = DB::table('assignedd_areas');
				$assignedAreas = $assignedAreas->where('assigned_zone_id',$assignedZone->id);
				$assignedAreas = $assignedAreas->select('assignedd_areas.area_id')->get();
				
				$tmp = [];
				foreach($assignedAreas as $assignedArea){
					$tmp[] = $assignedArea->area_id;
				}
				$assignedArea = $tmp;
				
				foreach($areas as $area){
					if(in_array($area->id,$requestAssignedAreas) && !in_array($area->id,$assignedArea)){
						$assigneddArea = new AssigneddArea;
						$assigneddArea->assigned_zone_id = $assignedZone->id;
						$assigneddArea->area_id = $area->id;
						$assigneddArea->save();						
					}
					else if(!in_array($area->id,$requestAssignedAreas) && in_array($area->id,$assignedArea)){
						AssigneddArea::where('assigned_zone_id',$assignedZone->id)->where('area_id',$area->id)->delete();
						//$deleted = DB::delete('delete from assignedd_areas where assigned_zone_id=\''.$assignedZone->id.'\' && area_id=\''.$area->id.'\'');
					}
				}
				return response()->json([
					'statusCode'=>1,
					'data'=>[
						'responseCode'=>200,
						'payload'=>[],
						'message'=>'Areas assigned updated successfully'
					]
				],200);
			}else{
				throw new Exception('No client found having id: '.$client_username);
			}
		}catch(\Exception $e){
			return response()->json([
				'statusCode'=>0,
				'data'=>[
					'responseCode'=>404,
					'payload'=>'',
					'message'=>$e->getMessage()
				]
			],200);
		}
	}
	
	/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function geteditpayment(Request $request, $id)
    {
        //
		if($request->ajax()){
			if(!$request->user()->current_user_can('administrator|admin|gb_associate')){
				return response()->json(['status'=>0,'message'=>'Unauthorised access'],200);
			}
			$paymentHistory = PaymentHistory::find($id);		 
			$request->session()->put('keywordToUpdate', $paymentHistory->id);
			 //echo "<pre>";print_r($paymentHistory);die;
			return response()->json(['status'=>1,'paymentHistory'=>$paymentHistory]);
		}		
    }
	
	
	/**
     * Delete transaction amuunt client .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clientTransactionDelete($id)
    {			 
		try{
			 
			$transactiondelete = Transaction::findorFail($id);	 			 
			if($transactiondelete->delete()){
				return response()->json([
					"statusCode"=>1,
					"data"=>[
						"responseCode"=>200,
						"payload"=>"",
						"message"=>"Transaction deleted successfully !!"
					]
				],200);
			}else{
				return response()->json([
					"statusCode"=>0,
					"data"=>[
						"responseCode"=>400,
						"payload"=>"",
						"message"=>"Transaction  not deleted !!"
					]
				],200);
			}
		}catch(\Exception $e){
			return response()->json([
				"statusCode"=>0,
				"data"=>[
					"responseCode"=>404,
					"payload"=>"",
					"message"=>"Transaction not found !!"
				]
			],200);
		}
    }
	
	public function logoDel($id)
    {
       	 
		$delet_data = Client::withTrashed()->where('username',$id)->first();
		  
		if($delet_data->logo!='')
		{	
			$image = unserialize($delet_data->logo);
			 
			$large = ''.$image['large']['src'];
			if(!empty($image['thumbnail']['src'])){
    			$thumbnail = ''.$image['thumbnail']['src'];
    			if (file_exists($thumbnail))
    			{
    			    unlink($thumbnail);
    			}  
			}
			if (file_exists($large))
			{
			    unlink($large);
			} 
		}
 
		$edit_data = array('logo'  =>"",);	 
		$del = Client::where('username',$id)->update($edit_data);			 		
		return redirect("/developer/clients/update/".$id."#other_info");
			
    }
 
	
	public function profilePicDel($id)
    {
    	$delet_data = Client::withTrashed()->where('username',$id)->first();
		if($delet_data->profile_pic!='')
		{	
			$image = unserialize($delet_data->profile_pic);
			$large = ''.$image['large']['src'];
			if(!empty($image['thumbnail']['src'])){
    			$thumbnail = ''.$image['thumbnail']['src'];
    			if (file_exists($thumbnail))
    			{
    			    unlink($thumbnail);
    			}  
			}
			if (file_exists($large))
			{
			    unlink($large);
			} 
		}
		$edit_data = array('profile_pic'=>"",);	 
		$del = Client::where('username',$id)->update($edit_data);			 		
		 
		return redirect("/developer/clients/update/".$id."#other_info");
			
    }
 
	
	
	
}
