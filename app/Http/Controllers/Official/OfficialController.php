<?php

namespace App\Http\Controllers\Official;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
use App\LeadEnquery;
use App\EnquiryFollowUp;
use App\Subscribe;
use App\Blogdetails;
 
 
class OfficialController extends Controller
{
	
	 public function __construct()
    {
         
    }
      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        return view('official.index');
    } 
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {    
        return view('official.about-us');
    } 
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function news()
    {   
        return view('official.news');
    } 
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function rss()
    { 	
		$blogrecents = Blogdetails::limit(8)->orderBy('id','DESC')->get();
		return view('official.rss',['blogrecents'=>$blogrecents]);
    } 
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function features()
    {   
        return view('official.features');
    } 
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function faq()
    {   
        return view('official.faq');
    } 
	
	public function contact()
    {  
        return view('official.contact-us');
    }

	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function careers()
    {  
        return view('official.careers');
    } 
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pricing()
    {  
        return view('official.pricing');
    } /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function media()
    {  
        return view('official.index');
    } /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function advertise()
    {  
        return view('official.advertise');
    }   
	
	public function blog()
    {  
		$blogrecents = Blogdetails::limit(8)->orderBy('id','DESC')->get();
		$bloglist = Blogdetails::orderBy('id','DESC')->paginate(2);
		 
        return view('official.blog',['bloglist'=>$bloglist,'blogrecents'=>$blogrecents]);
    } 
	public function blogdetails(Request $request, $slug)
    {  
	
	$bloglist = Blogdetails::where('status','1')->limit(8)->orderBy('id','DESC')->get();
	$blogdetails = Blogdetails::where('slug',$slug)->first();
 
        return view('official.blog-details',['bloglist'=>$bloglist,'blogdetails'=>$blogdetails]);
    } 
	
	public function testimonials()
    {  
		$testimonialsdetails = Testimonialsdetail::orderBy('id','DESC')->get();
        return view('official.testimonials',['testimonialsdetails'=>$testimonialsdetails]);
    }  
	public function termsconditions()
    {  
	
	
        return view('official.terms-conditions');
    }

	public function privacypolicy()
    {  
        return view('official.privacy-policy');
    }  
	public function copyrightpolicy()
    {  
        return view('official.copyright-policy');
    }  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function enquerystore(Request $request)
    {	
	 
		$lead = new LeadEnquery;		 
		 $lead->business= $request->input('business');
		 $lead->name= $request->input('name');
		 $lead->mobile= $request->input('mobile');
		 $lead->email= $request->input('email');
		 $lead->city= $request->input('city');
		 
		 if($lead->save()){
			 $followUp = new EnquiryFollowUp;				 
				$followUp->remark = $request->input('message');
				$followUp->enquiry_id = $lead->id;
				 
				if($followUp->save()){	
				    $headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				// Additional headers
			
				$headers .= 'From: quickindia <care@quickindia.in>'. "\r\n";
			$to="care@quickindia.in". "\r\n";
			//	$to="care@quickindia.in". "\r\n";
				$subject="New Enquiry". "\r\n";
			//	$message=view('site.send_enquiry_mail_thanks');
				
				$message='<html>
<body>
<table class="m_-3031551356041827469MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%">
    <tbody>
        <tr>
            <td style="padding:0in 0in 0in 0in">
                <div align="center">
                    <table class="m_-3031551356041827469MsoNormalTable" border="1" cellspacing="0" cellpadding="0" width="630" style="width:472.5pt;background:white;border:solid #cccccc 1.0pt">
                        <tbody>
                            <tr>
                                <td colspan="3" style="border:none;padding:0in 0in 0in 0in">
                                    <div align="center">
                                        <table class="m_-3031551356041827469MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%">
                                            <tbody>
                                                <tr style="height:3.75pt">
                                                    <td style="background:#06A2E3;padding:0in 0in 0in 0in;height:3.75pt"></td>
                                                    <td style="background:#B12642;padding:0in 0in 0in 0in;height:3.75pt"></td>
                                                    <td style="background:#06A2E3;padding:0in 0in 0in 0in;height:3.75pt"></td>
                                                    <td style="background:#B12642;padding:0in 0in 0in 0in;height:3.75pt"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height:60.0pt">
                                <td width="55%" style="width:55.0%;border:none;padding:0in 7.5pt 0in 7.5pt;height:60.0pt">
                                    <p class="MsoNormal" style="line-height:0%"><span style="font-size:1.0pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"><a href="http://quickindia.in/" title="quickindia" target="_blank"><span style="text-decoration:none"><img border="0" id="m_-3031551356041827469_x0000_i1025" src="http://quickindia.in/assets/images/logo.png" alt="quickindia" class="CToWUd" width="100px"></span></a>
                                        </span><u></u><u></u></p>
                                </td>
                                <td width="45%" style="border:none;padding:0in 7.5pt 0in 0in;height:60.0pt">
                                    <p class="MsoNormal" align="right" style="text-align:right;line-height:0%"><span style="font-size:1.0pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"><a href="http://quickindia.in/" title="quickindia" target="_blank"><span style="text-decoration:none"><img border="0" width="56%" height="auto" id="m_-3031551356041827469_x0000_i1026" src="http://quickindia.in/assets/images/ISO_9001_Logo.png" alt="ISO" class="CToWUd"></span></a>
                                        </span><u></u><u></u></p>
                                </td>
                                <td style="border:none;padding:0in 0in 0in 0in;height:60.0pt"></td>
                            </tr>
                            <tr style="height:.75pt">
                                <td colspan="3" style="border:none;background:#e5e5e5;padding:0in 7.5pt 0in 7.5pt;height:.75pt"></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="border:none;padding:0in 0in 0in 0in">
                                    <table class="m_-3031551356041827469MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%">
                                        <tbody>
                                            <tr>
                                                <td style="background:#232222;padding:12.5pt 6.0pt 12.5pt 6.0pt">
                                                    <p class="MsoNormal" align="center" style="text-align:center"><span style="font-size:14.0pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:white">Enquiry From quickindia.</span><u></u><u></u></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding:22.5pt 15.0pt 22.5pt 15.0pt">
                                                    <div>
                                                        <p class="MsoNormal"><b><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Hi Team,</span></b><u></u><u></u></p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding:0in 15.0pt 0in 15.0pt;border-radius:10px">
                                                    <table class="m_-3031551356041827469MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%">
                                                        <tbody>
                                                            <tr>
                                                                <td style="border:solid #cccccc 1.0pt;padding:11.25pt 11.25pt 11.25pt 11.25pt">
                                                                    <table class="m_-3031551356041827469MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="padding:0in 0in 15.0pt 0in">
                                                                                    <p class="MsoNormal"><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">You have received an enquiry from our client. Here are the details:</span><u></u><u></u></p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding:0in 0in 7.5pt 0in">
                                                                                    <p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Campany Name:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
																					'.$request->input('business').'</span><u></u><u></u></p>
                                                                                </td>
                                                                            </tr>
																			
																			<tr>
                                                                                <td style="padding:0in 0in 7.5pt 0in">
                                                                                    <p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Name:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
																					'.$request->input('name').'</span><u></u><u></u></p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding:0in 0in 7.5pt 0in">
                                                                                    <p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Email:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
																					'.$request->input('email').'</span><u></u><u></u></p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding:0in 0in 7.5pt 0in">
                                                                                    <p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Mobile:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$request->input('mobile').'</span><u></u><u></u></p>
                                                                                </td>
                                                                            </tr>
                                                                            
                                                                           
																			<tr>
                                                                                <td style="padding:0in 0in 7.5pt 0in">
                                                                                    <p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">City:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$request->input('city').'</span><u></u><u></u></p>
                                                                                </td>
                                                                            </tr>
																			<tr>
                                                                                <td style="padding:0in 0in 7.5pt 0in">
                                                                                    <p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Message:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$request->input('message').'</span><u></u><u></u></p>
                                                                                </td>
                                                                            </tr>
                                                                       
																			<tr><td style="padding:18pt 0in 0in 0in;"></td></tr>
																			<tr>
                                                                                <td style="padding:0in 0in 7.5pt 0in">
                                                                                    <p class="MsoNormal" style="text-decoration:underline"><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Note:</span><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> This is a system generated email. Please do not reply.</span><u></u><u></u></p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="border:none;border-bottom:dashed #cccccc 1.0pt;padding:0in 0in 5.0pt 0in"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding:11.25pt 0in 11.25pt 0in">
                                                                                    <p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Contact Details of quickindia:</span></strong><u></u><u></u></p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding:0in 0in 0in 0in">
                                                                                    <p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Address :</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
          G-21,Third Floor, Noida India</span><u></u><u></u></p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding:0in 0in 0in 0in">
                                                                                    <p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Email ID :</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
          info@quickindia.in</span><u></u><u></u></p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding:0in 0in 0in 0in">
                                                                                    <p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Mobile number:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
          +91-9058100001</span><u></u><u></u></p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding:0in 0in 0in 0in">
                                                                                    <p class="MsoNormal">&nbsp;<u></u><u></u></p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding:0in 0in 0in 0in">
                                                                                    <p class="MsoNormal"><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Contact us on the above details for any confussion or clarification. </span><u></u><u></u></p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding:22.5pt 15.0pt 22.5pt 15.0pt">
                                                    <div>
                                                        <p class="MsoNormal" style="line-height:18.75pt"><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Regards,<br>
      quickindia (P) Ltd. </span><u></u><u></u></p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    </tbody>
</table>
</body>
</html>';
				
		//	$message=file_get_contents($message);
		    	/*$message=preg_replace('NA',$request->input('name'),$message);
			$message=preg_replace('EM',$request->input('email'),$message);
				$message=preg_replace('MB',$request->input('mobile'),$message);
				$message=preg_replace('CI',$request->input('city'),$message);
				$message=preg_replace('ME',$request->input('message'),$message);*/
				 
				mail($to,$subject,$message,$headers);	
			
			
			if($lead->email){
					
					$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
				// Additional headers
				//	$headers .= 'From: enquiry@quickindia.in' . "\r\n";
				$headers .= 'From: quickindia <care@quickindia.in>';
				//$headers .= "CC: info@gmail.com\r\n";
				$to=$lead->email;
				$subject="Thanks for quickindia Enquiry";
					$message ='<html>
<body>
<table class="m_-3031551356041827469MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%">
    <tbody>
        <tr>
            <td style="padding:0in 0in 0in 0in">
                <div align="center">
                    <table class="m_-3031551356041827469MsoNormalTable" border="1" cellspacing="0" cellpadding="0" width="630" style="width:472.5pt;background:white;border:solid #cccccc 1.0pt">
                        <tbody>
                            <tr>
                                <td colspan="3" style="border:none;padding:0in 0in 0in 0in">
                                    <div align="center">
                                        <table class="m_-3031551356041827469MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%">
                                            <tbody>
                                                <tr style="height:3.75pt">
                                                    <td style="background:#06A2E3;padding:0in 0in 0in 0in;height:3.75pt"></td>
                                                    <td style="background:#B12642;padding:0in 0in 0in 0in;height:3.75pt"></td>
                                                    <td style="background:#06A2E3;padding:0in 0in 0in 0in;height:3.75pt"></td>
                                                    <td style="background:#B12642;padding:0in 0in 0in 0in;height:3.75pt"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height:60.0pt">
                                <td width="55%" style="width:55.0%;border:none;padding:0in 7.5pt 0in 7.5pt;height:60.0pt">
                                    <p class="MsoNormal" style="line-height:0%"><span style="font-size:1.0pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"><a href="http://quickindia.in/" title="quickindia" target="_blank"><span style="text-decoration:none"><img border="0" id="m_-3031551356041827469_x0000_i1025" src="http://quickindia.in/assets/images/logo.png" alt="quickindia" class="CToWUd" width="100px"></span></a>
                                        </span><u></u><u></u></p>
                                </td>
                                <td width="45%" style="border:none;padding:0in 7.5pt 0in 0in;height:60.0pt">
                                    <p class="MsoNormal" align="right" style="text-align:right;line-height:0%"><span style="font-size:1.0pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"><a href="http://quickindia.in/" title="quickindia" target="_blank"><span style="text-decoration:none"><img border="0" width="56%" height="auto" id="m_-3031551356041827469_x0000_i1026" src="http://quickindia.in/assets/images/ISO_9001_Logo.png" alt="ISO" class="CToWUd" width="100px"></span></a>
                                        </span><u></u><u></u></p>
                                </td>
                                <td style="border:none;padding:0in 0in 0in 0in;height:60.0pt"></td>
                            </tr>
                            <tr style="height:.75pt">
                                <td colspan="3" style="border:none;background:#e5e5e5;padding:0in 7.5pt 0in 7.5pt;height:.75pt"></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="border:none;padding:0in 0in 0in 0in">
                                    <table class="m_-3031551356041827469MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%">
                                        <tbody>
                                            <tr>
                                                <td style="background:#232222;padding:12.5pt 6.0pt 12.5pt 6.0pt;height: 160px;">
                                                    <p class="MsoNormal" align="center" style="text-align:center"><span style="font-size:20.0pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:white">Thank You !!</span><u></u><u></u></p> 

													<p class="MsoNormal" align="center" style="text-align:center"><span style="font-size:20.0pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:white">Your Enquiry has been received.</span><u></u><u></u></p>
													
											<p class="MsoNormal" align="center" style="text-align:center"><span style="font-size:10.0pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:white">We will get back to you soon.</span><u></u><u></u></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding:22.5pt 15.0pt 22.5pt 15.0pt">
                                                    <div>
                                                        <p class="MsoNormal"><b><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"></span></b><u></u><u></u></p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding:0in 15.0pt 0in 15.0pt;border-radius:10px">
                                                    <table class="m_-3031551356041827469MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%">
                                                        <tbody>
                                                            <tr>
                                                                <td style="border:solid #cccccc 1.0pt;padding:11.25pt 11.25pt 11.25pt 11.25pt">
                                                                    <table class="m_-3031551356041827469MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%">
                                                                        <tbody>
                                                                       
																			 
																			<tr><td class="m_8854432245175541298sectionTitle" style="font-family:sans-serif;color:#313a42;border-collapse:collapse;text-align:center;font-size:26px;padding:0px 10px 10px 10px">Helpline No.</td></tr>

																			<tr><td class="m_-5925867924380956427sectionTitle" style="font-family:sans-serif;color:#313a42;border-collapse:collapse;text-align:center;font-size:26px;padding:0px 10px 10px 10px"><strong>+91-9058-100-001</strong></td></tr>																 <tr><td class="m_-5925867924380956427button" style="font-family:sans-serif;color:#313a42;border-collapse:collapse;padding:10px 5px 10px 5px;text-align:center;background-color:#ff6b6b;border-radius:4px"><a href="http://quickindia.in/" title="quickindia" style="color:#ffffff;text-decoration:none;display:block;text-transform:uppercase" target="_blank" data-saferedirecturl="">Visit Us</a></td></tr>
																			   
																			<tr><td style="padding:18pt 0in 0in 0in;"></td></tr>
																			
																		 
                                                                            <tr>
                                                                                <td style="border:none;border-bottom:dashed #cccccc 1.0pt;padding:0in 0in 5.0pt 0in"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding:11.25pt 0in 11.25pt 0in">
                                                                                    <p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Contact Details of quickindia:</span></strong><u></u><u></u></p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding:0in 0in 0in 0in">
                                                                                    <p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Address :</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
       G-21,Third Floor, Noida India </span><u></u><u></u></p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding:0in 0in 0in 0in">
                                                                                    <p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Email ID :</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
          info@quickindia.in</span><u></u><u></u></p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding:0in 0in 0in 0in">
                                                                                    <p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Mobile number:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
          +91-9058100001</span><u></u><u></u></p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding:0in 0in 0in 0in">
                                                                                    <p class="MsoNormal">&nbsp;<u></u><u></u></p>
                                                                                </td>
                                                                            </tr>
                                                                         
																			
																			<tr>
                                                                                <td style="padding:0in 0in 0in 0in">
                                                                                    <p class="MsoNormal"><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Contact us on the above details for any confussion or clarification. </span><u></u><u></u></p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding:22.5pt 15.0pt 22.5pt 15.0pt">
                                                    <div>
                                                        <p class="MsoNormal" style="line-height:18.75pt"><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Regards,<br>
      quickindia (P) Ltd. </span><u></u><u></u></p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    </tbody>
</table>
</body>
</html>';
					mail($to,$subject,$message,$headers);	
				}

					return response()->json(['status'=>1],200);
			 
			 }else{
					 
					return response()->json(['status'=>0,'errors'=>'Enquiry not added'],400);
				}
		 }else{
			return response()->json(['status'=>0],200);
			 
		 }
		 
		  
    }
  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contactform(Request $request)
    {	
		 
		$lead = new LeadEnquery;		 
		 $lead->business= $request->input('subject');
		 $lead->name= $request->input('name');
		 $lead->mobile= $request->input('mobile');
		 $lead->email= $request->input('email');
		 $lead->city= $request->input('city');
		 
		 if($lead->save()){
		      $followUp = new EnquiryFollowUp;				 
				$followUp->remark = $request->input('message');
				$followUp->enquiry_id = $lead->id;				 
				$followUp->save();
			 return response()->json(['status'=>1],200);
		 }else{
			return response()->json(['status'=>0],200);
			 
		 }
		 
		  
    }
 
 
 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request)
    {	
		 
		$subscribe = new Subscribe;		 
		 $subscribe->email= $request->input('email');		 
		 if($subscribe->save()){
			 return response()->json(['status'=>1],200);
		 }else{
			return response()->json(['status'=>0],200);
			 
		 }
		 
		  
    }
	 
}
