<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Client\Client; //model
use Validator;
use Illuminate\Support\Facades\Input;
use Image;
use DB;
use Mail;
use Excel;
use session;
use App\Http\Controllers\SitemapsController as SMC;
use App\Models\PaymentHistory;  
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\Zone;
use App\Models\Lead;
use App\Models\User;
use App\Models\Keyword;
use App\Models\LeadFollowUp;
use App\Models\Status;
use App\Models\AssignedLead;
class BusinessController extends Controller
{
	protected $danger_msg = '';
	protected $success_msg = '';
	protected $warning_msg = '';
	protected $info_msg = '';
    protected $redirectTo = '/business-owners';
	
	 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
		    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
		return view('client.business-owners');
    }


 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
	 
    	$clientID = auth()->guard('clients')->user()->id;	 
        $clientDetails = 	DB::table('clients')->where('id',$clientID)->first();
		$leads = DB::table('leads')
				   ->join('assigned_leads','leads.id','=','assigned_leads.lead_id')		 
				  ->leftjoin('citylists','leads.city_id','=','citylists.id')		 
				   ->leftjoin('areas','leads.area_id','=','areas.id')		 
				   ->leftjoin('zones','leads.zone_id','=','zones.id')		 
				   ->select('leads.*','assigned_leads.client_id','assigned_leads.lead_id','assigned_leads.created_at as created','areas.area','zones.zone')				 
				   
				   ->orderBy('assigned_leads.created_at','desc')
				     ->where('assigned_leads.readLead','0')
				   ->where('assigned_leads.client_id',$clientID)->limit('200')->get();
		//	echo "<pre>";print_r($clientDetails);	   die;
	 
		return view('business.dashboard',['leads'=>$leads,'clientDetails'=>$clientDetails]);
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
			$client = new Client;
			$messages = ['mobile.regex' => 'Mobile number cannot start with 0.'];
			$validator = Validator::make($request->all(), [
				'business_name' => 'required|regex:/[A-Za-z0-9 ]+/',
				'mobile' => 'required|numeric|digits:10|regex:/^[1-9]+/|unique:clients,mobile,NULL,id',
				'city' => 'required|max:50',
				'email' => 'required|email'
			],$messages);
			if ($validator->fails()) {
				return redirect("/business-owners")
							->withErrors($validator)
							->withInput();
			}else{
				// GENERATING SLUG
				// ***************
				$business_slug = NULL;
				$business_slug = generate_slug($request->input('business_name'));
				if(is_null($business_slug)){
					return redirect("/business-owners")
								->withErrors($validator)
								->withInput();					
				}
				$slugExists = DB::table('clients')
					->select(DB::raw('business_slug'))
					->where('business_slug', 'like', '%'.$business_slug.'%')
					->orderBy('id','desc')
					->get();
				if(count($slugExists)>0){
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
			$client->mobile = $request->input('mobile');
			$client->email = $request->input('email');
			$client->max_kw = 30;
			
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
			 
				$smsMessage = "Thanks for registering with Quickind.
				%0D%0ALogin %26 Update your profile to get more leads to grow your business.
				%0D%0A%0D%0ABusiness Name:".$client->business_name."
				%0D%0AURL:www.quickind.com
				%0D%0AUID:".$client->username."
				%0D%0APassword:".$pass."
				%0D%0A--
				%0D%0ARegards
				%0D%0AQuickind Team";
			 
				sendSMS($client->mobile,$smsMessage);
				$this->success_msg .= 'Business registered successfully!';
				$request->session()->flash('success_msg', $this->success_msg);
		 
				return redirect("/business/dashboard");
			}else{
				$this->danger_msg .= 'Business not registered!';
				$request->session()->flash('danger_msg', $this->danger_msg);
				return redirect("/business-owners");
			}			
		}
		 
    }

     
    /**
     * Send client registration mail to client containing user name password.
     *
     * @param  object  $client
     */
    public function sendUandP($client,$usr,$pass)
    {
        Mail::send('emails.register', ['client'=>$client,'usr'=>$usr,'pass'=>$pass], function ($m) use ($client) {
            $m->from('care@quickindia.in', 'quickindia');
            $m->to($client->email, $client->first_name." ".$client->last_name)->subject('quickindia Login Credentials')->cc('clients@quickindia.in');
        });
    }

	/**
	 * Return Paginated Assigned Keywords
	 *
	 * @param $request - Request class instance
	 * @param $id - ClientID
	 * @return JSON object containing payload
	 */
	 public function getPaginatedAssignedKeywords(Request $request)
	 {
		if($request->ajax()){
			$clientID = auth()->guard('clients')->user()->id;
			$leads = DB::table('assigned_kwds')
						->join('citylists','assigned_kwds.city_id','=','citylists.id')
						->join('parent_category','assigned_kwds.parent_cat_id','=','parent_category.id')
						->join('child_category','assigned_kwds.child_cat_id','=','child_category.id')
						->join('keyword','assigned_kwds.kw_id','=','keyword.id')
						->select('assigned_kwds.*','citylists.city','parent_category.parent_category','child_category.child_category','keyword.keyword')
						->orderBy('assigned_kwds.created_at','desc')
						->where('assigned_kwds.client_id',$clientID)
						->paginate($request->input('length'));
					   
			$returnLeads = $data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $leads->total();
			$returnLeads['recordsFiltered'] = $leads->total();
	 
			foreach($leads as $lead){
			    
			    $zone=  Zone::where('id',$lead->zone_id)->first();
				if(!empty($zone)){
					$zonename= $zone->zone;
				}else{
					$zonename="";
					
				}
				$data[] = [
					$lead->keyword,
					$lead->parent_category,
					$lead->child_category,
					$lead->city,
		 
				 
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
    public function getPaginatedPaymentHistory(Request $request)
    {
			$clientID = auth()->guard('clients')->user()->id;
			$payments = DB::table('payment_histories')
					   ->where('client_id',$clientID)
					   ->orderBy('created_at','desc')
					   ->paginate($request->input('length'));
					   
			$returnLeads = $data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $payments->total();
			$returnLeads['recordsFiltered'] = $payments->total();
			foreach($payments as $payment){
				$action = '';
				$separator = '';
				 $action .= $separator.'<a href="javascript:void(0)" data-toggle="popover" title="Invoice PDF" id="paymentPrint" data-trigger="hover" data-placement="left" data-sid="'.$payment->id.'"><i aria-hidden="true" class="fa fa-file-pdf-o"></i></a>';
    						 
				$data[] = [
					date_format(date_create($payment->created_at),'d M Y'),
					$payment->paid_amount,
					$payment->gst_tax,
					$payment->total_amount,
					$payment->payment_mode,
				];
			}
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
		 
    }
	
		
	public function profileInfo(Request $request)
    { 
		$clientID = auth()->guard('clients')->user()->id;	 
        $client = Client::find($clientID);
        return view('business.profile',['client'=>$client]);
    }
		
	public function personalDetails(Request $request)
    { 
		$clientID = auth()->guard('clients')->user()->id;	 
        $client = Client::find($clientID);
        return view('business.personal-details',['client'=>$client]);
    }
    
    public function saveProfile(Request $request)
    {        
        if($request->has('saveProfile-form')){
			
			$client = Client::find($request->input('business_id'));
			$id = $request->input('business_id');
			$client->display_hofo = $request->input('display_hofo');
			$client->business_intro = $request->input('business_intro');
			$client->time = (null!==$request->input('time'))?serialize($request->input('time')):"";
		 
			$client->year_of_estb = $request->input('year_of_estb');
			$client->certifications = (!empty($request->input('certifications')))?serialize(explode(',',$request->input('certifications'))):"";
			
			 
			 
		 
			if($client->save()){
			 
				$client = Client::find($id);	
				$resulsu = "Profile updated successfully!";
				return response()->json(['status'=>1,'result'=>$resulsu]);
			}	
			
			else{
				return response()->json(['status'=>0,'result'=>'Profile not successfully update']);
			}			
		}
        
    }
    
	public function help(Request $request)
    { 
        	$clientID = auth()->guard('clients')->user()->id;
        	$client = Client::find($clientID);
         
      
        return view('business.help',['client'=>$client]);
    }
	
	public function profileLogo(Request $request)
    { 
        	$clientID = auth()->guard('clients')->user()->id;
        	$client = Client::find($clientID);
         
      
        return view('business.profileLogo',['client'=>$client]);
    }
    
    public function saveProfileLogo(Request $request)
    { 
        
        if($request->has('profile_logo')){
			$client = Client::find($request->input('business_id'));
			$id = $request->input('business_id');
			$validator = Validator::make($request->all(), [
				'image' => 'mimes:jpeg,jpg,png|max:2048',
				'profile_pic' => 'mimes:jpeg,jpg,png|max:2048|dimensions:min_width=1137,min_height=319'
			],[
				'profile_pic.dimensions' => 'Please upload profile pic of given size -> [Minimum Height:319px] &amp; [Minimum Width:1137px].'
			]);
			if ($validator->fails()) {
				$request->session()->flash('registration_status', 1);
				$request->session()->flash('show_third_form', 1);
				return redirect("/business/profile-logo")
							->withErrors($validator)
							->withInput();
			}			
	 
			
			//$file = $request->file('logo');
			// LOGO Pictures
			// *************
			if ($request->hasFile('image')) {
				$image = [];
				$filePath = getFolderStructure();
				$file =  $request->file('image');
				$filename =str_replace(' ', '_', $file->getClientOriginalName()); // $file->getClientOriginalName();
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
					$oldImages = unserialize($client->logo);
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
			}
	 
		 
			if($client->save()){
				 
				$client = Client::find($id);
				$this->success_msg = 'Profile gallary Pic successfully!';
			$request->session()->flash('success_msg', $this->success_msg);
	 
			}else{
				 
			}
		}
        
    }
    
 
	
	public function logoDel($id)
    {
       	 
		$delet_data = Client::findOrFail($id); 
		$clientID = auth()->guard('clients')->user()->id;
    	$client = Client::find($clientID);
	 
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
		$del = Client::where('id',$id)->update($edit_data);			 		
		return redirect('business/profile-logo');
			
    }
 
	
	public function profilePicDel($id)
    {
       	 
		$delet_data = Client::findOrFail($id); 
		$clientID = auth()->guard('clients')->user()->id;
    	$client = Client::find($clientID);
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
		$del = Client::where('id',$id)->update($edit_data);			 		
		return redirect('business/profile-logo');
			
    }
 
	
 	public function locationInformation(Request $request)
    { 
    	$clientID = auth()->guard('clients')->user()->id;
    	$client = Client::find($clientID);
     
        $search = [];
		if($request->has('search')){
			$search = $request->input('search');
		}
        return view('business.locationInformation',['search'=>$search,'client'=>$client]);
    }
	
	public function saveLocationInformation(Request $request)
    {   
    	if($request->has('location_form_submit')){		
    	  
			$client = Client::find($request->input('business_id'));
			$id = $request->input('business_id');
			$messages = ['mobile.regex' => 'Mobile number cannot start with 0.'];
			$validator = Validator::make($request->all(),[				 
			'business_name' => 'required|unique:clients,business_name,'.$id.',id,city,'.$request->input('city'),
				'landmark' => 'regex:/[a-zA-z ]$/',
				'city' => 'required|regex:/[a-zA-z ]+$/',
				'state' => 'required|regex:/[a-zA-z ()]+$/',
				'country' => 'required|regex:/[a-zA-z ]+$/',
				 
			]);
			if($validator->fails()){
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}
			
			$client->business_name = $request->input('business_name');
			$client->address = $request->input('address');
			$client->landmark = $request->input('landmark');
			$client->city = $request->input('city');
			$client->state = $request->input('state');
			$client->country = $request->input('country');
		 
			if($client->save()){
				$client = Client::find($id);
		 
				$resulsu = "Location Information Updated Successfully";
				return response()->json(['status'=>1,'result'=>$resulsu]);
			}else{
				 
				return response()->json(['status'=>0,'result'=>'Location Information not assigned']);
			}			
		}
    }
	
	
	public function coinsHistory(Request $request)
    { 
        $clientID = auth()->guard('clients')->user()->id;
    	$client = Client::find($clientID);
		//$coinsLeads= AssignedLead::where('client_id',$client->id)->get();
		$coinsLeads = DB::table('assigned_leads')
		->join('leads','leads.id','=','assigned_leads.lead_id')		 
		->leftjoin('citylists','leads.city_id','=','citylists.id')		 
		->leftjoin('keyword','assigned_leads.kw_id','=','keyword.id')	 
		 	 
		->select('leads.*','assigned_leads.client_id','assigned_leads.lead_id','assigned_leads.created_at as created','assigned_leads.coins','assigned_leads.scrapLead')

		->orderBy('assigned_leads.created_at','desc')
	 
		->where('assigned_leads.client_id',$clientID)->limit('200')->get();

		//echo "<pre>";print_r($coinsLeads);die;
        $search = [];
		if($request->has('search')){
			$search = $request->input('search');
		}
        return view('business.coins-history',['search'=>$search,'client'=>$client,'coinsLeads'=>$coinsLeads]);
    }
    
    
	public function uploadPictures(Request $request)
    { 
        $clientID = auth()->guard('clients')->user()->id;
    	$client = Client::find($clientID);
        $search = [];
		if($request->has('search')){
			$search = $request->input('search');
		}
        return view('business.uploadPictures',['search'=>$search,'client'=>$client]);
    }
	
	public function saveGallary(Request $request)
    { 
        
        if($request->has('fourth_form_submit')){
			$client = Client::find($request->input('business_id'));
			$id = $request->input('business_id');			 
			$image = [];
			if(!empty($client->pictures)){
				$oldImages = unserialize($client->pictures);
			}
			$filePath = getFolderStructure();
 
			for($i=0;$i<12;$i++){
				if ($request->hasFile('image'.($i+1))) {
					 
					$file =  $request->file('image'.($i+1));
					if($file->getClientSize() != null){
							$filename =str_replace(' ', '_', $file->getClientOriginalName());
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
			if(count($image)>0){
				$client->pictures = serialize($image);
			}else{
				$client->pictures = '';
			}
	 
			if($client->save()){
				if(isset($oldImages)){
					foreach($oldImages as $oldImage){
						try{
							if(!unlink(public_path($oldImage['large']['src'])))
								throw new Exception("Old files not deleted...");
							if(!unlink(public_path($oldImage['thumbnail']['src'])))
								throw new Exception("Old files not deleted...");
						}catch(Exception $e){
							echo $e->getMessage();
						}
					}
				}
				$client = Client::find($id);
		 
				
			$this->success_msg = 'Profile gallary Pic successfully!';
			$request->session()->flash('success_msg', $this->success_msg);
			return redirect("/business/gallery-pictures");
			}else{
				return redirect("/business/gallery-pictures");
			}
		}
        
    }
	
		
	
	public function package(Request $request)
    { 
        	$clientID = auth()->guard('clients')->user()->id;
        	$client = Client::find($clientID);
        $search = [];
		if($request->has('search')){
			$search = $request->input('search');
		}
        return view('business.package',['search'=>$search,'client'=>$client]);
    }
    
		
	
	public function accountSettings(Request $request)
    { 
        	$clientID = auth()->guard('clients')->user()->id;
        	$client = Client::find($clientID);
        $search = [];
		if($request->has('search')){
			$search = $request->input('search');
		}
        return view('business.account-settings',['search'=>$search,'client'=>$client]);
    }
    
	
	public function businessLocation(Request $request)
    { 
        	$clientID = auth()->guard('clients')->user()->id;
        	$client = Client::find($clientID);
        $search = [];
		if($request->has('search')){
			$search = $request->input('search');
		}
        return view('business.business-location',['search'=>$search,'client'=>$client]);
    }
    
    
    public function buyPackage(Request $request)
    { 
        	$clientID = auth()->guard('clients')->user()->id;
        	$client = Client::find($clientID);
        $search = [];
		if($request->has('search')){
			$search = $request->input('search');
		}
        return view('business.buyPackage',['search'=>$search,'client'=>$client]);
    }
    	
	
	public function billingHistory(Request $request)
    { 
        $search = [];
		if($request->has('search')){
			$search = $request->input('search');
		}
        return view('business.billingHistory',['search'=>$search]);
    }
    
    
    
	 /**
     * Get paginated leads.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getBillingHistory(Request $request)
    {
		 
		if($request->ajax()){
			$clientID = auth()->guard('clients')->user()->id;
			$payments = DB::table('payment_histories')
					   ->where('client_id',$clientID)
					   ->orderBy('created_at','desc')
					   ->paginate($request->input('length'));
				 
			$returnLeads = $data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $payments->total();
			$returnLeads['recordsFiltered'] = $payments->total();
			foreach($payments as $payment){
				$action = '';
				$separator = '';
				 if($payment->invoice_status == 1){
				$action .= $separator.'<a href="javascript:void(0)" data-toggle="popover" title="Invoice PDF" id="invoiceBillingPdf" data-trigger="hover" data-placement="left" data-sid="'.$payment->id.'"><i aria-hidden="true" class="bi bi-file-earmark-pdf"></i></a>'; 
				}
    						 
				$data[] = [
					date_format(date_create($payment->created_at),'d M Y'),
					$payment->paid_amount,
					$payment->gst_tax,
					$payment->total_amount,
				 	$action,
					
				];
			}
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
		}
    }
	
	
	public function getinvoiceBillingPrintPdf(Request $request) {
		if(isset($_GET['pid']))
			{
			
			if($request->input('action') == 'getinvoicePrintPdf')
			{
			$paymnetid = $_GET['pid'];		
			$paymentprint = PaymentHistory::find($paymnetid);
			$client = Client::withTrashed()->where('id',$paymentprint->client_id)->first();	  							
			return response()->view("business.getInvoicePrintPdfSlip",['paymentprint'=>$paymentprint,'client'=>$client]);
			
			die;
			}
		}


	}
    
	public function enquiry(Request $request)
    { 
        $search = [];
		if($request->has('search')){
			$search = $request->input('search');
		}
        return view('business.leadlist',['search'=>$search]);
    }
	

	
	public function newEnquiry(Request $request)
    { 
        $search = [];
		if($request->has('search')){
			$search = $request->input('search');
		}

		$clientID = auth()->guard('clients')->user()->id;


		$leads = DB::table('leads')
				   ->join('assigned_leads','leads.id','=','assigned_leads.lead_id')		 
				  ->leftjoin('citylists','leads.city_id','=','citylists.id')		 
				   ->leftjoin('areas','leads.area_id','=','areas.id')		 
				   ->leftjoin('zones','leads.zone_id','=','zones.id')		 
				   ->select('leads.*','assigned_leads.*','assigned_leads.client_id as clientId','assigned_leads.lead_id','assigned_leads.id as assignId','assigned_leads.created_at as created','areas.area','zones.zone')				 
				   
				   ->orderBy('assigned_leads.created_at','desc')
				   ->where('assigned_leads.readLead','0')
				   ->where('assigned_leads.client_id',$clientID)->limit('20')->get();
				   
					
        return view('business.new-enquiry',['leads'=>$leads]);
    }
	
	public function myLead(Request $request)
    { 
       
		$clientID = auth()->guard('clients')->user()->id;
		$leads = DB::table('leads')
				   ->join('assigned_leads','leads.id','=','assigned_leads.lead_id')		 
				  ->leftjoin('citylists','leads.city_id','=','citylists.id')		 
				   ->leftjoin('areas','leads.area_id','=','areas.id')		 
				   ->leftjoin('zones','leads.zone_id','=','zones.id')		 
				   ->select('leads.*','assigned_leads.*','assigned_leads.client_id as clientId','assigned_leads.lead_id','assigned_leads.id as assignId','assigned_leads.created_at as created','areas.area','zones.zone')				 
				   
				   ->orderBy('assigned_leads.created_at','desc')
				   ->where('assigned_leads.favoriteLead','!=', '1')
				 
				   ->where('assigned_leads.client_id',$clientID)->limit('200')->get();
		
        return view('business.myLead',['leads'=>$leads]);
    }
	
	public function favoriteEnquiry(Request $request)
    {
		$clientID = auth()->guard('clients')->user()->id;
		$leads = DB::table('leads')
				   ->join('assigned_leads','leads.id','=','assigned_leads.lead_id')		 
				  ->leftjoin('citylists','leads.city_id','=','citylists.id')		 
				   ->leftjoin('areas','leads.area_id','=','areas.id')		 
				   ->leftjoin('zones','leads.zone_id','=','zones.id')		 
				   ->select('leads.*','assigned_leads.*','assigned_leads.client_id as clientId','assigned_leads.lead_id','assigned_leads.id as assignId','assigned_leads.created_at as created','areas.area','zones.zone')				 
				   
				   ->orderBy('assigned_leads.created_at','desc')
				     ->where('assigned_leads.favoriteLead','1')
				   ->where('assigned_leads.client_id',$clientID)->limit('200')->get();
				
        return view('business.favorite-enquiry',['leads'=>$leads]);
    }
	
	
	public function scrapEnquiry(Request $request)
    {
		$clientID = auth()->guard('clients')->user()->id;
		$leads = DB::table('leads')
				   ->join('assigned_leads','leads.id','=','assigned_leads.lead_id')		 
				  ->leftjoin('citylists','leads.city_id','=','citylists.id')		 
				   ->leftjoin('areas','leads.area_id','=','areas.id')		 
				   ->leftjoin('zones','leads.zone_id','=','zones.id')		 
				   ->select('leads.*','assigned_leads.*','assigned_leads.client_id as clientId','assigned_leads.lead_id','assigned_leads.id as assignId','assigned_leads.created_at as created','areas.area','zones.zone')				 
				   
				   ->orderBy('assigned_leads.created_at','desc')
				     ->where('assigned_leads.favoriteLead','1')
				   ->where('assigned_leads.client_id',$clientID)->limit('200')->get();
				
        return view('business.scrap-enquiry',['leads'=>$leads]);
    }
	
	public function manageEnquiry(Request $request)
    {
		$clientID = auth()->guard('clients')->user()->id;
		$leads = DB::table('leads')
				   ->join('assigned_leads','leads.id','=','assigned_leads.lead_id')		 
				  ->leftjoin('citylists','leads.city_id','=','citylists.id')		 
				   ->leftjoin('areas','leads.area_id','=','areas.id')		 
				   ->leftjoin('zones','leads.zone_id','=','zones.id')		 
				   ->select('leads.*','assigned_leads.*','assigned_leads.client_id as clientId','assigned_leads.lead_id','assigned_leads.id as assignId','assigned_leads.created_at as created','areas.area','zones.zone')				 
				   
				   ->orderBy('assigned_leads.created_at','desc')
				   ->where('assigned_leads.client_id',$clientID)->limit('20')->get();
				
        return view('business.manage-enquiry',['leads'=>$leads]);
    }
	
    /**
     * Return paginated resources.
     *
     * @return JSON Payload.
     */
    public function getEnquiry(Request $request){
         
       
		if($request->ajax()){
			
			$clientID = auth()->guard('clients')->user()->id;
			
			
			$leads = DB::table('leads')
					   ->join('assigned_leads','leads.id','=','assigned_leads.lead_id')
					   ->select('leads.*','assigned_leads.client_id','assigned_leads.lead_id','assigned_leads.created_at as created')
					   ->orderBy('assigned_leads.created_at','desc')
					   ->where('assigned_leads.client_id',$clientID);
					   
					   
					   
		  if($request->input('search.leaddf')!=''){
				$leads = $leads->whereDate('assigned_leads.created_at','>=',date_format(date_create($request->input('search.leaddf')),'Y-m-d'));
			}
			if($request->input('search.leaddt')!=''){
				$leads = $leads->whereDate('assigned_leads.created_at','<=',date_format(date_create($request->input('search.leaddt')),'Y-m-d'));
			}
			
			
			
				$leads = $leads->paginate($request->input('length'));
					   
			$returnLeads = [];
			$data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $leads->total();
			$returnLeads['recordsFiltered'] = $leads->total();
			$returnLeads['recordCollection'] = [];
			foreach($leads as $lead){
			    
			    $action = '';
				$separator = '';
			    
			    $action .= $separator.'<a href="javascript:enquiryController.getfollowUps('.$lead->id.')" title="followUp"><i class="bi bi-eye" aria-hidden="true"></i></a>';
    						$separator = ' | ';
				$data[] = [
					$lead->name,
					$lead->mobile,
					$lead->email,			 
					$lead->kw_text,
					$lead->city_name,
					date_format(date_create($lead->created),'d M, Y H:i'),
					$action
				];
				$returnLeads['recordCollection'][] = $lead->id;	
			}
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
		
		}
    }
	
	
	
		
	public function keywords(Request $request)
    { 
        $search = [];
		if($request->has('search')){
			$search = $request->input('search');
		}
        return view('business.keywords',['search'=>$search]);
    }
	
    /**
     * Return paginated resources.
     *
     * @return JSON Payload.
     */
    public function getDiscussion(Request $request){
		if($request->ajax()){
			 
			$clientID = auth()->guard('clients')->user()->id;
			$discussion = DB::table('client_discussion')			 
					   ->orderBy('id','desc')					  
					   ->where('client_id',$clientID)
					   ->paginate($request->input('length'));
					   
			$returnLeads = [];
			$data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $discussion->total();
			$returnLeads['recordsFiltered'] = $discussion->total();
			 
			foreach($discussion as $lead){
				$data[] = [								 
					date_format(date_create($lead->createdate),'d-m-Y H:i:s'),
					$lead->discussion,	
				];
			}
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
			//return $leads->links();
		}
    }

    /**
     * Export assigned leads.
     */
    public function getLeadsExcel(Request $request){
		$clientID = auth()->guard('clients')->user()->id;
		
		$assignedKWDS = DB::table('leads')
				   ->join('assigned_leads','leads.id','=','assigned_leads.lead_id')
				   ->join('cities','leads.city_id','=','cities.id')
				   ->select('leads.*','assigned_leads.client_id','assigned_leads.lead_id','cities.city')
				   ->orderBy('leads.created_at','desc')
				   ->where('assigned_leads.client_id',$clientID)
				   ->get();
				   
		$arr = [];
		foreach($assignedKWDS as $assKWDS){
			$arr[] = [
				'Name'=>$assKWDS->name,
				'Mobile'=>$assKWDS->mobile,
				'Email'=>$assKWDS->email,
				'Course'=>$assKWDS->kw_text,
				'City'=>$assKWDS->city,
				'Date'=>date_format(date_create($assKWDS->created_at),'d M, Y H:i:s'),
			];
		}
		$excel = \App::make('excel');
		Excel::create('assigned_leads', function($excel) use($arr) {
			$excel->sheet('Sheet 1', function($sheet) use($arr) {
				$sheet->fromArray($arr);
			});
		})->export('xls');
	}	
	
	
	/**
     * Handling client remark
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function discussion(Request $request)
    {    
			 
			if($request->input('discussion_form_submit') == 'Submit'){
	
			$admin_id = $request->input('admin-id');
			$client_id = $request->input('client-id');
			$discussion = $request->input('clientremark');
			$add_data = array(
			'client_id'=>$client_id,
			'admin_id'=>$admin_id,
			'name'=>auth()->guard('clients')->user()->business_name,
			'discussion'=>$discussion,
			); 
			$add  = DB::table('client_discussion')->insert($add_data);
		if($add){
			
			$resulsu = "Discussion Information Successfully";
			return response()->json(['status'=>1,'result'=>$resulsu]);
			}else{
				 
				return response()->json(['status'=>0,'result'=>'discussion Information not assigned']);
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
    public function followUp(Request $request, $id)
    {  
		if($request->ajax()){
	 
			$clientID = auth()->guard('clients')->user()->id;
            $lead = DB::table('leads')
            ->join('assigned_leads','leads.id','=','assigned_leads.lead_id')
            ->select('leads.*','assigned_leads.client_id','assigned_leads.lead_id','assigned_leads.created_at as created')
            ->orderBy('assigned_leads.created_at','desc')
            ->where('assigned_leads.client_id',$clientID)->where('leads.id',$id)->first();
            
					   
					   
		

			
			 
			$leadLastFollowUp = DB::table('lead_follow_ups as lead_follow_ups')
							->where('lead_follow_ups.lead_id','=',$id)
							->where('lead_follow_ups.client_id','=',$clientID)
							->select('lead_follow_ups.*')
							->orderBy('lead_follow_ups.id','desc')
							->first();
		 
			
		 
		 
			
		  
            $statuses = DB::table('status')->where('lead_follow_up',1)->get();
                
                
			 //  dd($leadLastFollowUp);
			   
			$statusHtml = '';
			$disabled = '';
			$dateValue = '';
			if(count($statuses)>0){
				foreach($statuses as $status){
					if(strcasecmp($status->name,'new lead')){
						$selected = '';
						if(isset($leadLastFollowUp->status) && $leadLastFollowUp->status == $status->id){
							$selected = 'selected';
						 
								if($leadLastFollowUp->expected_date_time!=NULL){
									$dateValue = date_format(date_create($leadLastFollowUp->expected_date_time),'d-F-Y g:i A');
								}
							 
						}
						$statusHtml .= '<option data-value="'.$status->show_exp_date.'" value="'.$status->id.'" '.$selected.'>'.$status->name.'</option>';
					}
				}
			}
			
			
			
	 
			
	 
			 
			$html = '<div class="row">
						<div class="x_content" style="padding:0">';
			 
				  
						$number=$lead->mobile;
				 
					
				 
					$html.= '<form class="form-label-left" method="post" onsubmit="return enquiryController.storeFollowUp('.$id.',this)">
				 
					 
				    <div class="row">
                        <div class="col-md-4" style="display:flex;">
                        <label for=" " class="col-md-3 col-lg-3 col-form-label">Name :</label>
                        
                        <p name="name" type="text" class="form-control-static" > '.$lead->name.'</p>
                        </div>
                        	
                        <div class="col-md-4" style="display:flex;">
                        <label for="" class="col-md-3 col-lg-3 col-form-label">Email :</label>
                         	 <p name="email" type="text" class="form-control-static" > '.$lead->email.'</p>
                        </div>
                        
                         <div class="col-md-4" style="display:flex;">
                         <label for=" " class="col-md-3 col-lg-3 col-form-label">Mobile :</label>
                         <p name="mobile" type="text" class="form-control-static" > '.$lead->mobile.'</p>
                        </div>
                        
                    </div>
				 					 
				     <div class="row">
                           <div class="col-md-4" style="display:flex;">
                         <label for="" class="col-md-3 col-lg-3 col-form-label">City :</label>
                         	 <p name="city name" type="text" class="form-control-static" > '.$lead->city_name.'</p>
                        </div>
                       
                        <div class="col-md-4" style="display:flex;">
                         <label for="" class="col-md-3 col-lg-4 col-form-label">Keyword :</label>
                         	 <p name="keyword" type="text" class="form-control-static" > '.$lead->kw_text.'</p>
                        </div>
                        
                         <div class="col-md-4" style="display:flex;">
                         <label for="" class="col-md-3 col-lg-3 col-form-label">Date :</label>
                         	 <p name="date" type="text" class="form-control-static" > '.date('d M Y',strtotime($lead->created_at)).'</p>
                        </div>
                        
                           
                    
                    </div>
				 
				
								 
                <div class="row mb-3">
                
                <div class="col-md-4">
                <label for="" class="">Status :</label>
                <select class="select2_single form-control" name="status" tabindex="-1">
                <option value="">-- SELECT STATUS --</option> 
                '.$statusHtml.'
                </select>
                
                </div>
                
                <div class="col-md-4">
                <label for="expected_date_time">Expected Date &amp; Time <span class="required">*</span></label>
                <input type="text" id="expected_date_time" name="expected_date_time" class="form-control" value="'.$dateValue.'" placeholder="Expected Date &amp; Time" '.$disabled.' autocomplete="off">
                </div>
                
                <div class="col-md-4">
                <label for="remark">Counsellor Remark <span class="required">*</span></label>
                <textarea name="remark" rows="1" class="form-control col-md-7 col-xs-12"></textarea>
                </div>
                </div>
                <div class="form-group" style="float:right;">
                <div class="col-md-11" style="float:right;">
                	<label style="visibility:hidden">Submit</label>
                	<button type="submit" class="btn btn-success btn-block" name="submit" value="Submit">Submit</button>
                </div>
                </div>
							</form>';
				 
			$html.=	'</div>
					</div> 
					<p style="margin-top:10px;margin-bottom:3px;"><strong>Follow Up Status</strong>  <select onchange="javascript:enquiryController.getAllFollowUps()" class="follow-up-count"><option value="5">Last 5</option><option value="all">All</option></select></p>
					<div class="" style="overflow-x: none;">
						<table id="datatable-enquiry-followups" class="table table-bordered table-striped table-hover">
							<thead>
								<tr>
									<th>Date</th>
									<th>Counsellor Remark</th>
									<th>Status</th>
									<th>Expected Date</th>
								</tr>
							</thead>
						</table>
					</div>';
			
			return response()->json(['status'=>1,'html'=>$html],200);
		}
    }
	
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeFollowUp(Request $request, $id)
    {  
        
         
        	
        	
        
		if($request->ajax()){
			$validator = Validator::make($request->all(),[
			
				'status'=>'required',			 
				'remark'=>'required',
				 
			]);
			if($validator->fails()){
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}
			
			// check now expected date and time if status is not - not interested/location issue
			$statusModel = Status::find($request->input('status'));
			//if($statusModel->name!='Not Interested' && $statusModel->name!='Location Issue'){
			if($statusModel->show_exp_date){
				$validator = Validator::make($request->all(),[
					'expected_date_time'=>'required',
				]);
				if($validator->fails()){
					$errorsBag = $validator->getMessageBag()->toArray();
					return response()->json(['status'=>1,'errors'=>$errorsBag],400);
				}				
			}
			
			$lead = Lead::find($id);
		    if (!empty($lead)) {
				$leadFollowUp = new LeadFollowUp;
				$status = Status::findorFail($request->input('status'));
				if(!strcasecmp($status->name,'npup')){
					$npupCount = LeadFollowUp::where('lead_id',$id)->where('status',$status->id)->count();
					if($npupCount>=15){
						$status = Status::where('name','LIKE','Not Interested')->first();
						$leadFollowUp->status = $status->id;
					}else{
						$leadFollowUp->status = $request->input('status');
					}
				}else{
					$leadFollowUp->status = $request->input('status');
				}
				
			 
				$leadFollowUp->remark = trim($request->input('remark'));
				$leadFollowUp->lead_id = $id;
				$leadFollowUp->client_id  = auth()->guard('clients')->user()->id;
				$leadFollowUp->expected_date_time = NULL;
				if($request->input('expected_date_time')!=''){
					$leadFollowUp->expected_date_time = date('Y-m-d H:i:s',strtotime($request->input('expected_date_time')));
				}
				if($leadFollowUp->save()){
					return response()->json(['status'=>1],200);
				}
		 }else{
		     
		     return response()->json(['status'=>0, ''=>"Enquiry not found"],200);
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
    public function getFollowUps(Request $request, $id)
    {   
		if($request->ajax()){
			
			$leads = DB::table('lead_follow_ups as lead_follow_ups')
							->join('status as status','status.id','=','lead_follow_ups.status')
							->where('lead_follow_ups.lead_id','=',$id)
							->where('lead_follow_ups.client_id','=',auth()->guard('clients')->user()->id)
							->select('lead_follow_ups.*','status.name as status_name')
							->orderBy('lead_follow_ups.id','desc');
			if($request->input('count')!='all'){
				$leads = $leads->take($request->input('count'));
			}else{
				$leads = $leads->take(100);
			}
			$leads = $leads->paginate($request->input('length'));
							//->take(5)
							//->paginate($request->input('length'));
							
			$returnLeads = [];
			$data = [];
			$returnLeads['draw'] = $request->input('draw');
			$returnLeads['recordsTotal'] = $leads->total();
			$returnLeads['recordsFiltered'] = $leads->total();
			foreach($leads as $lead){
				$data[] = [
					(date('d-m-y h:i:s',strtotime($lead->created_at))),
					$lead->remark,
					$lead->status_name,
					(isset($lead->expected_date_time)? date('d-m-y h:i A',strtotime($lead->expected_date_time)):"")
				];
			}
			$returnLeads['data'] = $data;
			return response()->json($returnLeads);
		}		
	}
	

	public function pauseLead(Request $request){
 
		$client = Client::find($request->client_id);
 
        if (!$client) {
            return response()->json(['status' => false, 'message' => 'Client not found'], 404);
        }
		 
		if($request->pauseLead == 'true'){
		 
				$client->pauseLead = 1;
		}else{
		 
			$client->pauseLead = 0;
		}
        if ($client->save()){
 				return response()->json(['status' => true, 'message' => 'Pause lead updated']);
		}else{
			return response()->json(['status' => false, 'message' => 'Pause lead updated']);
	

		}

       
	}

	public function scrapLead(Request $request){

	 
		$assignedLead = AssignedLead::find($request->lead_id);
 
        if (!$assignedLead) {
            return response()->json(['status' => false, 'message' => 'not found'], 404);
        }
		 
		if($request->isChecked == 'true'){
			$assignedLead->scrapLead = $request->val;
		} 
 
	 
 




        if ($assignedLead->save()){

		$counts = DB::table('assigned_leads')
		->select('lead_id')
		->selectRaw('COUNT(client_id) as client_count')
		->selectRaw('COUNT(lead_id) as lead_count')
		->selectRaw('COUNT(scraplead) as scraplead_count')
		->where('lead_id', $assignedLead->lead_id)
		->first();

		if(($counts->lead_count == $counts->client_count ) && ($counts->lead_count<=   $counts->scraplead_count)){
			$assignleads  = DB::table('assigned_leads')->where('lead_id',$counts->lead_id)->whereNotNull('scrapLead')->get();
			if(!empty($assignleads)){
				foreach($assignleads as $assignlead){
				$client = Client::find($assignlead->client_id );
				$client->coins_amt = $client->coins_amt + $assignlead->coins;
				$client->scrapApprove = '1';    
				//$client->save();
				}
			}		
		}
 		return response()->json(['status' => true, 'message' => 'Scrap lead updated']);

		}else{
			return response()->json(['status' => false, 'message' => 'Scrap lead updated']);
	

		}

       
	}

	public function readLead(Request $request){
  	 
		$assignedLead = AssignedLead::find($request->assingId);
 
        if (!$assignedLead) {
            return response()->json(['status' => false, 'message' => 'assignedLead not found'], 404);
        }
		
		$assignedLead->readLead = '1';
        if ($assignedLead->save()){
 				return response()->json(['status' => true, 'message' => 'Pause lead updated']);
		}else{
			return response()->json(['status' => false, 'message' => 'Pause lead updated']);
		}     
	}

	public function favoritleads(Request $request){
  	 
		$assignedLead = AssignedLead::find($request->assingId);
 
        if (!$assignedLead) {
            return response()->json(['status' => false, 'message' => 'assignedLead not found'], 404);
        }
		
		$assignedLead->favoriteLead = '1';
        if ($assignedLead->save()){
 				return response()->json(['status' => true, 'message' => 'Pause lead updated']);
		}else{
			return response()->json(['status' => false, 'message' => 'Pause lead updated']);
		}     
	}
	
	
	
}
