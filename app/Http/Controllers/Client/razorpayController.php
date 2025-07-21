<?php

namespace App\Http\Controllers\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Session; 
use App\Models\Citieslists;
use App\State;
 
use App\Models\RazorpayHistory;
use App\Models\PaymentHistory;
use App\Models\Client\Client;
 
use Mail;

class razorpayController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
 
		//testing Key  brijeshchauhansit@gmail.com
		define('RAZOR_KEY_ID', 'rzp_test_W4vtkmMCBlCwIo');
		define('RAZOR_KEY_SECRET', 'sYeslbCFPinBjmHBRNpz806I');
	   
    }

	public function validation_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	
	public function dataEncodeJsonBase64($o){
	$o = json_encode($o);
	$o = base64_encode($o);
	return $o;
	}
	
	
    function dataDecodeJsonBase64($o){
    	$o = base64_decode($o);
    	$o = json_decode($o); 
    	 
    	return $o;
    }
	public function payDeposit(Request $request){
	//echo "<pre>";print_r($this->dataDecodeJsonBase64($_GET['o']));die;
		
		
	if(isset($_GET['status'],$_GET['o'])&& !empty($_GET['o'])){
	$o = base64_decode ( $_GET['o'], $strict=false );
	$data = json_decode($o);
	$status = $_GET['status'];
	}else{
		$data=array();
	}
//	echo "<pre>";print_r($data);die;
		return view('business.razorpay.pay-checkout',['data'=>$data]);
 
	}
	
 /**
     * Return the specified resource from storage.
     *
     * @param  obj  Request object
     * @param  int  $id
     * @return Json Response
     */
	public function saveProcessing(Request $request){	
	
		
	 
			if($request->isMethod('post') && $request->input('checkout')=="CheckOut")
			{
		 
			   $this->validate($request, [
				'name' 	=> 'required|string|regex:/^[\pL\s\-]+$/u|min:3|max:32', 
				'email' 	=> 'required|regex:/^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i',					
			//	'pincode' 	=> 'required|numeric',					
				'phone' 	=> 'required|numeric',					
				'amount' 	=> 'required|numeric',					
				'course' 	=> 'required|string|min:3|max:32',	
				'country' 	=> 'required|numeric',	
				'state' 	=> 'required|numeric',	
				'city' 	=> 'required',	
			//	'address' 	=> 'required',						 					
					]);  
				
					 

			$data['name'] = $this->validation_input($request->input('name'));
			$data['email'] = $this->validation_input($request->input('email'));
			$data['course'] = $this->validation_input($request->input('course'));
		//	$data['pincode'] = $this->validation_input($request->input('pincode'));
			$data['amt'] = $this->validation_input($request->input('amount'));
			$data['phone'] = $this->validation_input($request->input('phone'));
		//	$data['add'] = $this->validation_input($request->input('address'));		
		//	$cityname =City::where('city_id',$request->input('city'))->first()->city_name;
			$statename =State::where('state_id',$request->input('state'))->first()->state_name;
			$countryname =Country::where('country_id',$request->input('country'))->first()->country_name;
			
		    $data['city'] = $this->validation_input($request->input('city'));
			$data['state'] = $this->validation_input($statename);
			$data['country'] = $this->validation_input($countryname);	
			
			$d= time();
			$traisaction= "QI_".rand(10, 99).'_'.$d;
			if(!empty($data)){

			$s=1;	

			}else{
				$s=0;	
			}
			
			
			
			Session::put('buyerFirstName',$request->input('name'));
			Session::put('buyerEmail',$request->input('email'));
			Session::put('clientName',$request->input('course'));
			Session::put('amount',$request->input('amount'));
			Session::put('buyerPhone',$request->input('phone'));
			Session::put('buyerState',$statename);
			Session::put('buyerCountry',$countryname);
			Session::put('buyerCity',$request->input('city'));
			Session::put('buyerPinCode',$request->input('pincode'));
			Session::put('course',$request->input('course'));
	
	if($s==1){
		$inv = $this->dataEncodeJsonBase64($data);
		$inv = "&inv=".$inv;		
		$o =$this->dataEncodeJsonBase64($data);
	 
		return redirect('/pay-checkout?status=incompete&o='.$o.$inv);
		exit;	
				 
			}else{
				return redirect('/pay-deposit');
			}
			 
		 
			return view('business.razorpay.pay-deposit');
	}
	}
	
 
	
	
 /**
     * Return the specified resource from storage.
     *
     * @param  obj  Request object
     * @param  int  $id
     * @return Json Response
     */
	public function checkOut(Request $request){
		
	//ss	echo "<pre>";print_r($_GET);die;
		
		//echo "<pre>";print_r($_GET);die;
		$data =$this->dataDecodeJsonBase64($_GET['o']);
		//echo "<pre>";print_r($data);die;
		return view('business.razorpay.pay-checkout',['data'=>$data]);
		  
			
			}
			
			
			
			
			
		function get_curl_handle($payment_id, $data) {
		$url = 'https://api.razorpay.com/v1/payments/' . $payment_id . '/capture';
		$key_id = RAZOR_KEY_ID;
		$key_secret = RAZOR_KEY_SECRET;
		$params = http_build_query($data);
		//cURL Request
		$ch = curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERPWD, $key_id . ':' . $key_secret);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		return $ch;
		}
			
 public function razorPayCheckout(Request $request ){
	 
	  
	 //echo "<pre>";print_r($_POST);
	 
if (!empty($_POST['razorpay_payment_id']) && !empty($_POST['merchant_order_id'])) {

$json = array();
$razorpay_payment_id = $_POST['razorpay_payment_id'];
$merchant_order_id = $_POST['merchant_order_id'];
$currency_code = $_POST['currency_code_id'];

//$cityname =City::where('city_id',$_POST['city'])->first()->city_name;
//$countryname =Country::where('country_id',$_POST['billing_country'])->first()->country_name;
// store temprary data
$dataFlesh = array(
    'card_holder_name' => $_POST['card_holder_name_id'],
    'merchant_amount' => $_POST['merchant_amount'],
    'merchant_total' => $_POST['merchant_total'],
    'surl' => $_POST['merchant_surl_id'],
    'furl' => $_POST['merchant_furl_id'],
    'currency_code' => $currency_code,
    'order_id' => $_POST['merchant_order_id'],
    'razorpay_payment_id' => $_POST['razorpay_payment_id'],
    'pay_to' => $_POST['pay'],
    'coins' => $_POST['coins'],
    'gst_tax' => $_POST['gst_tax'],
    'client_id' => $_POST['client_id'],
    'username' => $_POST['username'],
    'paid_amount' => $_POST['paid_amount'],
 
    'email' => $_POST['email'],
    'phone' => $_POST['phone'],
   // 'address' => $_POST['address'],
    'city' => $_POST['city'],  
    'billing_country' => $_POST['billing_country'],
     'billing_state' => $_POST['billing_state'],
    'getpay' => 1,
);

$paymentInfo = $dataFlesh;
$order_info = array('order_status_id' => $_POST['merchant_order_id']);
$amount = $_POST['merchant_total'];
$currency_code = $_POST['currency_code_id'];
// bind amount and currecy code
$data = array(
    'amount' => $amount,
    'currency' => $currency_code,
);
$success = false;
$error = '';
try {
    $ch = $this->get_curl_handle($razorpay_payment_id, $data);
    //execute post
    $result = curl_exec($ch);
	
	 
    $data = json_decode($result);
   
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($result === false) {
        $success = false;
        $error = 'Curl error: ' . curl_error($ch);
    } else {
        $response_array = json_decode($result, true);
        //Check success response
        if ($http_status === 200 and isset($response_array['error']) === false) {
            $success = true;
        } else {
            $success = false;
            if (!empty($response_array['error']['code'])) {
                $error = $response_array['error']['code'] . ':' . $response_array['error']['description'];
            } else {
                $error = 'Invalid Response <br/>' . $result;
            }
        }
    }
    //close connection
    curl_close($ch);
} catch (Exception $e) {
    $success = false;
    $error = $e->getMessage();
}
if ($success === true) {
    if (!$order_info['order_status_id']) {
		
        $json['data'] = json_encode($paymentInfo);
        $json['redirectURL'] = $_POST['merchant_surl_id'];
    } else {
        
        $feesHisoty =New RazorpayHistory;		
		$feesHisoty->name= $paymentInfo['card_holder_name'];
		$feesHisoty->email= $paymentInfo['email'];
		$feesHisoty->phone= $paymentInfo['phone'];
		$feesHisoty->username= $paymentInfo['username'];
		$feesHisoty->coins= $paymentInfo['coins'];
		$feesHisoty->client_id= $paymentInfo['client_id'];
		$feesHisoty->merchant_amount= $paymentInfo['merchant_amount'];
		$feesHisoty->merchant_total= $paymentInfo['merchant_total'];
		$feesHisoty->currency_code= $paymentInfo['currency_code'];
		$feesHisoty->order_id= $paymentInfo['order_id'];
		$feesHisoty->razorpay_payment_id= $paymentInfo['razorpay_payment_id'];
		$feesHisoty->city= $paymentInfo['city'];
		$feesHisoty->billing_country= $paymentInfo['billing_country'];
		$feesHisoty->billing_state= $paymentInfo['billing_state'];
		$feesHisoty->pay_to= $paymentInfo['pay_to'];
		$feesHisoty->getpay= 1;
		$feesHisoty->message= $error;
		$feesHisoty->save();

 		$clientdeatails = Client::find($paymentInfo['client_id']);
	  	$paymenthistory = new PaymentHistory;
		$paymenthistory->client_id =$paymentInfo['client_id'];  	
		$paymenthistory->customer_name = $paymentInfo['card_holder_name'];
		$paymenthistory->business_name =  $clientdeatails->business_name;
		$paymenthistory->mobile = $paymentInfo['phone'];
		$paymenthistory->email = $paymentInfo['email'];
		$paymenthistory->package_name = $clientdeatails->client_type;			 
		$paymenthistory->coins_amt = $paymentInfo['coins']; 
		$paymenthistory->selectproofid = "";
		$paymenthistory->proofid = "";	 
		$paymenthistory->paid_amount = $paymentInfo['paid_amount'];	 
		$paymenthistory->tds_status = "No";	 
		$paymenthistory->tds_amount ="0";
		$paymenthistory->gst_tax = $paymentInfo['gst_tax'];		 
		$paymenthistory->gst_total_amount = $paymentInfo['merchant_amount'];	 
		$paymenthistory->gst_status = "Yes";	 
		$paymenthistory->total_amount = $paymentInfo['merchant_amount'];	
		$paymenthistory->transactionid = $paymentInfo['order_id'];			 
		$paymenthistory->paymentcollect = 0;			 
		$paymenthistory->payment_mode = "razorpay";
		$paymenthistory->payment_bank = ""; 
		$paymenthistory->save();
 
		$clientdeatails->coins_amt = $clientdeatails->coins_amt + $paymentInfo['coins'];
		if($clientdeatails->expired_on == '0000-00-00 00:00:00' || $clientdeatails->expired_on =='NULL'){
		
		$newDate = date('Y-m-d', strtotime(now(). ' +365 days'));
			
		}else if(strtotime($clientdeatails->expired_on) > strtotime(date('Y-m-d'))){
			$newDate = date('Y-m-d', strtotime($clientdeatails->expired_on . ' +365 days'));
						
		}else if(strtotime($clientdeatails->expired_on) < strtotime(date('Y-m-d'))){
			$newDate = date('Y-m-d', strtotime(now() . ' +365 days'));
						
		}else{
			$newDate = date('Y-m-d', strtotime(now() . ' +365 days'));
		}
		$clientdeatails->expired_on = $newDate;
		$clientdeatails->active_status = "1";
		$clientdeatails->paid_status = "1";
		$clientdeatails->save();

		 $json['data'] = json_encode($paymentInfo);
        $json['redirectURL'] = $_POST['merchant_surl_id'];
    }
} else {


	$json['data'] = json_encode($paymentInfo);
    $json['redirectURL'] = $_POST['merchant_furl_id'];
}
$json['msg'] = 'success';
} else {

$json['msg'] = 'An error occured. Contact site administrator, please!';
}
header('Content-Type: application/json');
echo json_encode($json);
	 
	 
	 
	 
 }
  
 
 public function success(Request $request){
	 
	 if(isset($_GET)){		 
		 $data =$_GET;		 
	 }else{
		 $data ="";
	 }
 //echo "<pre>";print_r($data);die;

	 return view('business.razorpay.success',['data'=>$data]);
 }
 
 public function failed(Request $request){
	 
	 return view('business.razorpay.failed');
 }
 
  public function getInvoicePrintPdf(Request $request) {

	if(isset($_POST['pid']))
	{			
	if($request->input('action') == 'getInvoicePrintPdf')
	{

	$order_id=$_POST['pid'];	
	$paydetails =RazorpayHistory::where('order_id',$order_id)->first();
//echo "<pre>";print_r($paydetails);die;
	return response()->view("site.feesrazorpay.getPayPrintSlipInvoiceRazorpay",['paydetails'=>$paydetails]);

	die;
	}
	}
	}
	
	
 
 
	
	
	
	
	public function feesPayGateway(Request $request){ 
	 
		
	if(isset($_GET['status'],$_GET['o'])&& !empty($_GET['o'])){
	$o = base64_decode ( $_GET['o'], $strict=false );
	$data = json_decode($o);
	$status = $_GET['status'];
	}else{
		$data=array();
	}	 
	$paymentMode = PaymentMode::where('status',1)->get();
	//echo "<pre>";print_r($paymentMode);die;
	 
	return view('business.razorpay.fees-pay-page-out',['paymentMode'=>$paymentMode,'id'=>$id,'data'=>$data]);		
	}
 
  
 
	public function feesPayGatewaySave(Request $request){			 
		 
	 
		if($request->ajax())
		{			if($request->input('order_id')){
					$data =$this->dataDecodeJsonBase64($_POST['o']); 		
			 
					$paymentHistory =New CcavenueHistory;	
					$paymentHistory->name= $data->name; 
					$paymentHistory->email= $data->email; 
					$paymentHistory->mobile= $data->phone; 
					$paymentHistory->course= $data->course;
					$paymentHistory->amount= $data->amt;
					$paymentHistory->billing_city= $data->city;
					$paymentHistory->country= $data->country;
					$paymentHistory->billing_state= $data->state;
					$paymentHistory->payment_mode= $request->input('mode');
					$paymentHistory->order_id= $request->input('order_id');
					 
					if($paymentHistory->save()){	


					 

						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
						//	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						// Additional headers
						//	$headers .= 'From: enquiry@quickindia.in' . "\r\n";
						$headers .= 'From: quickindia <enquiry@quickindia.in>';
					 
						$to="brijesh.chauhan@quickindia.in";
						$subject="Payment- ".$data->name." | ".$data->course." | ".$request->input('mode')." | ".$data->amt." Amount" ;

						$message =' <tr>
						<td style="padding:0in 0in 7.5pt 0in">
						<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Name:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
						'.$data->name.'</span><u></u><u></u></p>
						</td>
						</tr>
						<tr>
						<td style="padding:0in 0in 7.5pt 0in">
						<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Email:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
						'.$data->email.'</span><u></u><u></u></p>
						</td>
						</tr>
						<tr>
						<td style="padding:0in 0in 7.5pt 0in">
						<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Technology:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
						'.$data->course.' </span><u></u><u></u></p>
						</td>
						</tr>
						<tr>
						<td style="padding:0in 0in 7.5pt 0in">
						<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Mobile:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">'.$data->phone.'</span><u></u><u></u></p>
						</td>
						</tr>	<tr>
						<td style="padding:0in 0in 7.5pt 0in">
						<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Amount: </span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$data->amt.'</span><u></u><u></u></p>
						</td>
						</tr>		

						<tr>
						<td style="padding:0in 0in 7.5pt 0in">
						<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">City:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$data->city.'</span><u></u><u></u></p>
						</td>
						</tr>
						<tr>
						<td style="padding:0in 0in 7.5pt 0in">
						<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Country :</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$data->country.'</span><u></u><u></u></p>
						</td>
						</tr>
						<tr>
						<td style="padding:0in 0in 7.5pt 0in">
						<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Mode:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$request->input('mode').'</span><u></u><u></u></p>
						</td>
						</tr>
						 
						';
						//$to="quickindialeads@gmail.com";


						$stdemail="";
						$codemail="";
						$coordinator="";

						// echo "<pre>";print_r($_FILES);die;
					//	$to="accounts@quickindia.in";
						Mail::send('mails.send_payment_inquiry', ['msg'=>$message], function ($m) use ($message,$request,$subject,$stdemail,$codemail,$data) {
						$m->from('info@quickindia.in', $data->name);
						if($request->file('photoimg')){ 
						$m->attach($request->file('photoimg')->getRealPath(), [
						'as' => $request->file('photoimg')->getClientOriginalName(), 
						'mime' => $request->file('photoimg')->getMimeType()
						]);
						}
						$m->to('quickindia.ashish@gmail.com', "")->subject($subject)->cc($data->email);				
						});  

 

					
						$arr['status']= 1;
						$arr['msg']= "Successfully submit ";				
						$arr['oo']= $_POST['o'];				

							}else{ 
							$arr['status']= 0;
							$arr['msg']= "Not Successfully payment";
							 				

							}
		}else{
		$arr['status']= 1;
		$arr['msg']= "Not Update Photo Successfully ";

		}
							
	echo json_encode($arr);
									 
			
		}
	 
		 
		
	}
 
 
 
    public function airpay(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
        header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
        header( 'Cache-Control: no-store, no-cache, must-revalidate' );
        header( 'Cache-Control: post-check=0, pre-check=0', false );
        header( 'Pragma: no-cache' );
        

            $buyerEmail = "test@gmail.com";//trim($_POST['buyerEmail']);
        	$buyerPhone = '8457425742';//trim($_POST['buyerPhone']);
        	$buyerFirstName = "First Name";//trim($_POST['buyerFirstName']);
        	$buyerLastName = "last Name";//trim($_POST['buyerLastName']);
        	$buyerAddress = "Address";//trim($_POST['buyerAddress']);
        	$amount = "1.00";//trim($_POST['amount']);
        	$buyerCity = "Noida";//trim($_POST['buyerCity']);
        	$buyerState = "UP";//trim($_POST['buyerState']);
        	$buyerPinCode = 852574;//trim($_POST['buyerPinCode']);
        	$buyerCountry = "India";//trim($_POST['buyerCountry']);
        	$orderid = mt_rand(1000,9999); //trim($_POST['orderid']); //Your System Generated Order ID
        	// $hiddenmod = trim($_POST['directindexvar']);
        	$currency = 356;//trim($_POST['currency']);
        	$isocurrency = "INR";//trim($_POST['isocurrency']);
        	
        	//$this->config();
        	$username =  '9563650'; // Username
            $password =  'WeZ4CrwA'; // Password
            $secret =    'U6eQEwZ3b9FNtdj3'; // API key
            $mercid =    '274181'; //Merchant ID 
        	
        	$this->airpayvalidation($buyerEmail,$buyerPhone,$buyerFirstName,$buyerLastName,$buyerAddress,$amount,$buyerCity,$buyerState,$buyerPinCode,$buyerCountry,$orderid,$currency,$isocurrency);
            //include('site/feesrazorpay/config.php');
            //include('site/feesrazorpay/checksum.php');
            //include('site/feesrazorpay/validation.php');
        	
            
        	// $date = date('Y-m-d');
        	// $alldata   = $buyerEmail.$buyerFirstName.$buyerLastName.$buyerAddress.$buyerCity.$buyerState.$buyerCountry.$amount.$orderid.$hiddenmod;
        	// $privatekey = Checksum::encrypt($username.":|:".$password, $secret);
        	// $keySha256 = Checksum::encryptSha256($username."~:~".$password);
        	// $checksum = Checksum::calculateChecksum($alldata,$keySha256);
        
        	$alldata   = $buyerEmail.$buyerFirstName.$buyerLastName.$buyerAddress.$buyerCity.$buyerState.$buyerCountry.$amount.$orderid;
        // 	$privatekey = Checksum::encrypt($username.":|:".$password, $secret);
        //     $keySha256 = Checksum::encryptSha256($username."~:~".$password);
        //     $checksum = Checksum::calculateChecksumSha256($alldata.date('Y-m-d'),$keySha256);
        
        	$privatekey = $this->encrypt($username.":|:".$password, $secret);
            $keySha256 = $this->encryptSha256($username."~:~".$password);
            $checksum = $this->calculateChecksumSha256($alldata.date('Y-m-d'),$keySha256);
            
            // Session::put('alldata',$alldata);
            // Session::put('keySha256',$keySha256);
            Session::put('checksum',$checksum);
            
            
            $hiddenmod = "";
            $this->processform($checksum);
    }
    
    
    

    public function config()
    {
        $username =  '9563650'; // Username
        $password =  'WeZ4CrwA'; // Password
        $secret =    'U6eQEwZ3b9FNtdj3'; // API key
        $mercid = '274181'; //Merchant ID   
    }
    
    //for checksom
    public function calculateChecksum($data, $secret_key) {
		$checksum = md5($data.$secret_key);
		return $checksum;
	}

    public function encrypt($data, $salt) {
        // Build a 256-bit $key which is a SHA256 hash of $salt and $password.
        $key = hash('SHA256', $salt.'@'.$data);
        return $key;
    }	

	public function encryptSha256($data) {    
        $key = hash('SHA256', $data);
        return $key;
    }    
    public function calculateChecksumSha256($data, $salt) { 
        $checksum = hash('SHA256', $salt.'@'.$data);
        return $checksum;
    }
	
/*  public static function getAllParams() {
		//ksort($_POST);
		$all = '';
        $except_list=array('checksum','privatekey','mercid','message');
		foreach($_POST as $key => $value)	{
			if(!in_array($key,$except_list)) {
				$all .= "'";
					$_POST[key] = Checksum::sanitizedParam($value);
			}
		}
	}
*/
    public function outputForm($checksum) {
		//ksort($_POST);
		
		foreach($_POST as $key => $value) {
				echo '<input type="hidden" name="'.$key.'" value="'.$value.'" />'."\n";
		}
		echo '<input type="hidden" name="checksum" value="'.$checksum.'" />'."\n";
	}

    public function verifyChecksum($checksum, $all, $secret) {
		$cal_checksum = Checksum::calculateChecksum($secret, $all);
		$bool = 0;
		if($checksum == $cal_checksum)	{
			$bool = 1;
		}

		return $bool;
	}
	
	
	
	
	
	
	
	
	//for validation
	public function createsendBack($sendBack,$err='', $id, $value, $action){
    	echo '<!DOCTYPE HTML>';
    	echo '<html lang="en">';
    	echo '<head>';
    	echo '<meta charset="utf-8" />';
    	echo '</head>';
    	echo '<body onLoad="javascript:document.errorform.submit();">';
    	echo '<form name="errorform" id="errorform" method="post" action="'.$action.'">';
    	echo '<input type="hidden" id="bac" name="bac" value="'.htmlspecialchars($sendBack).'">';
    	echo '<input type="hidden" id="status" name="status" value="'.$err.'">';
    	echo '<input type="hidden" id="statusmsg" name="statusmsg" value="'.$statusmsg.'">';
    	echo '<input type="hidden" id="'.$id.'" name="'.$id.'" value="'.$value.'">';
    	echo '</form>';
    	echo '</body>';
    	echo '</html>';
    	exit();
    }

	public function airpayvalidation($buyerEmail,$buyerPhone,$buyerFirstName,$buyerLastName,$buyerAddress,$amount,$buyerCity,$buyerState,$buyerPinCode,$buyerCountry,$orderid,$currency,$isocurrency)
	{
	    // if($buyerEmail=='' && $buyerPhone =='' && $buyerFirstName =='' && $buyerLastName == '' && $amount == '')
    	// {
    	// 	createsendBack($sendBack='',$error='ALL', $id,$value,'error.php');
    	// }
    	if($buyerFirstName =='' && $buyerLastName == '' && $amount == '')
    	{
    		$this->createsendBack($sendBack='',$error='ALL', $id,$value,'error.php');
    	}
    	if($buyerEmail=='')
    	{
    		//createsendBack($sendBack='',$error='E', $id,$value,'error.php');
    	}
    	else
    	{	
    		if (!filter_var($buyerEmail, FILTER_VALIDATE_EMAIL) ||  (strlen($buyerEmail) > 50) ){
    			$this->createsendBack($sendBack='',$error='VE', $id,$value,'error.php');	
    		}
    	}
    	if($buyerPhone=='')
    	{
    		//createsendBack($sendBack='',$error='BP', $id,$value,'error.php');	
    	}
    	else
    	{
    		$regex = '/^[0-9- ]{8,15}$/i'; 
    		if(!preg_match($regex,$buyerPhone)) {
    			$this->createsendBack($sendBack='',$error='VBP', $id,$value,'error.php');	
    		}
    	}
    	if($buyerEmail=='' && $buyerPhone== '')
    	{ 
           $this->createsendBack($sendBack='',$error='EP', $id,$value,'error.php');
    	}
    	if($buyerFirstName=='')
    	{
    		$this->createsendBack($sendBack='',$error='FN', $id,$value,'error.php');	
    	}
    	else
    	{
    		$regex = '/^[a-z \d]{1,50}$/i'; 
    		if(!preg_match($regex,$buyerFirstName)) {
    			$this->createsendBack($sendBack='',$error='VFN', $id,$value,'error.php');	
    		}
    	}
    	if($buyerLastName=='')
    	{
    		$this->createsendBack($sendBack='',$error='LN', $id,$value,'error.php');	
    	}
    	else
    	{
    		$regex = '/^[a-z \d]{1,50}$/i'; 
    		if(!preg_match($regex,$buyerLastName)) {
    			$this->createsendBack($sendBack='',$error='VLN', $id,$value,'error.php');	
    		}
    	}
    	
    	if($buyerAddress!='')
    	{
    		$regex =  '/^[a-z ,;.#$\/( )-_\d]{4,255}$/i';
    		if(!preg_match($regex,$buyerAddress)) {
    			$this->createsendBack($sendBack='',$error='VADD', $id,$value,'error.php?a='.$buyerAddress);	
    		}
    	}
    	if($buyerCity!='')
    	{
    		$regex =  '/^[a-z \d]{2,50}$/i';
    		if(!preg_match($regex,$buyerCity)) {
    			$this->createsendBack($sendBack='',$error='VCIT', $id,$value,'error.php');	
    		}
    	}
    	if($buyerState!='')
    	{
    		$regex =  '/^[a-z \d]{2,50}$/i';
    		if(!preg_match($regex,$buyerState)) {
    			$this->createsendBack($sendBack='',$error='VSTA', $id,$value,'error.php');	
    		}
    	}
    	if($buyerCountry!='')
    	{
    		$regex =  '/^[a-z \d]{2,50}$/i';
    		if(!preg_match($regex,$buyerCountry)) {
    			$this->createsendBack($sendBack='',$error='VCON', $id,$value,'error.php');	
    		}
    	}
    
    	if($buyerPinCode!='')
    	{
    		$regex = '/^[a-z\d]{4,8}$/i';
    		if(!preg_match($regex,$buyerPinCode)) {
    			$this->createsendBack($sendBack='',$error='VPIN', $id,$value,'error.php');	
    		}
    	}
    	
    	if($amount=='')
    	{
    		$this->createsendBack($sendBack='',$error='A', $id,$value,'error.php');	
    	}
    	else
    	{
    	    
    		$regex = '/^[0-9]{1,6}\.[0-9]{2,2}$/';
    		if(!preg_match($regex,$amount)) {
    			$this->createsendBack($sendBack='',$error='VA', $id,$value,'error.php');	
    		}
    	}
	}
	
	
	
	
	
	public function processform($checksum)
	{
	    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
        echo '<html xmlns="http://www.w3./org/1999/xhtml">';
        echo '<head>';
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        echo '<title>Airpay</title>';
        echo '<script type="text/javascript">
        function submitForm(){
        			var form = document.forms[0];
        			form.submit();
        		}
        </script>';
        echo '</head>';
        echo '<body onload="javascript:submitForm()">';
        echo '<center>';
        echo '<table width="500px;" >';
        echo '<tr>';
        echo '<td align="center" valign="middle">Do Not Refresh or Press Back <br/> Redirecting to Airpay</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td align="center" valign="middle">';
        echo '<form action="https://payments.airpay.co.in/pay/index.php" method="post">';
        echo '<input type="hidden" name="privatekey" value="U6eQEwZ3b9FNtdj3">';
        echo '<input type="hidden" name="mercid" value="274181">';
        echo '<input type="hidden" name="orderid" value="6757567">';
        echo '<input type="hidden" name="currency" value="356">';
        echo '<input type="hidden" name="isocurrency" value="INR">';
        echo '<input type="hidden" name="buyerPhone" value="8785874258">';
        echo '<input type="hidden" name="buyerEmail" value="ankita@gmail.com">';
        echo '<input type="hidden" name="amount" value="1.00">';
        echo '<input type="hidden" name="buyerFirstName" value="Ankita">';
        echo '<input type="hidden" name="buyerLastName" value="kumari">';
        echo '<input type="hidden" name="chmod" value="">';
        echo $this->outputForm($checksum);
        
        echo '</form>';
        echo '</td>';
        echo '</tr>';
        
        echo '</table>';
        
        echo '</center>';
        echo '</body>';
        echo '</html>';
	}
	
 
}
