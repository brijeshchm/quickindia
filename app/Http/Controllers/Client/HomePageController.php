<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddLeadRequest;
use DB;
use Mail;
use Artisan;
use Validator;
//model
use App\Models\Keyword; 
 
use App\Models\Citieslists;
use App\Models\Lead;
 use App\Models\ChildCategory;
use App\Models\ParentCategory;
use App\Models\ClientCategory;
use App\Models\Client\Client;
use App\AssignedClientCategory;
use App\Models\Blogdetails;
use App\Models\Testimonialsdetail;
use App\Models\LeadFollowUp;
use App\Models\Status;
use App\Models\Client\Comment;
class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
		$menuArr = [];
		$parentCategories = ParentCategory::take(7)->whereIn('parent_slug', ['packers-movers','hospitals','computer-courses','study-abroad','spa-beauty','restaurants','schools--colleges','home-services','event-organizers'])->get();
		$clientCategories = DB::table('parent_category as cc')
			->leftJoin(DB::raw('(SELECT acc.client_category_id, COUNT(acc.client_category_id) as clients_count FROM assigned_client_categories acc INNER JOIN clients c ON c.id=acc.client_id  GROUP BY acc.client_category_id) AS cmt'),'cc.id','=','cmt.client_category_id')
			->select('cc.*','cmt.*')
			//->where('cc.pc_icon','!=','')
			->take(8)
			->get();
		
		$clients= Client::get();
		$cities= DB::table('citylists')->select('id','city')->orderby('city','desc')->get();
 
		if(!empty($parentCategories)){
			foreach($parentCategories as $parentCategory){
				$childCategories = ChildCategory::where('parent_category_id',$parentCategory->id)->get();
				$menuArr[$parentCategory->parent_category]['parent'][] = $parentCategory;
				foreach($childCategories as $childCategory){
					$menuArr[$parentCategory->parent_category]['child'][] = $childCategory;
				}
			}
		}
		
		$blogdetails = Blogdetails::where('status','1')->limit(3)->orderBy('id','DESC')->get();
		$testimonialsdetails = Testimonialsdetail::limit(3)->orderBy('id','DESC')->get();
		 
	 
		
		
		
		$part_id= ParentCategory::where('parent_slug','computer-courses')->first();	 
		
		$subcategory= DB::table('child_category')
			->join('parent_category','child_category.parent_category_id','=','parent_category.id')		
			->where('parent_category_id',$part_id->id)
			->select('parent_category.*','child_category.*')->limit(24)
			->get();
				
		$entrance_id= ParentCategory::where('parent_slug','entrance-exams-coaching')->first();	 
		
		$entranceExam= DB::table('child_category')
			->join('parent_category','child_category.parent_category_id','=','parent_category.id')		
			->where('parent_category_id',$entrance_id->id)
			->select('parent_category.*','child_category.*')->limit(24)
			->get();
			
		$studyAbroad_id= ParentCategory::where('parent_slug','study-abroad')->first();	 
		
		$studyAbroad= DB::table('child_category')
			->join('parent_category','child_category.parent_category_id','=','parent_category.id')		
			->where('parent_category_id',$studyAbroad_id->id)
			->select('parent_category.*','child_category.*')->limit(24)
			->get();
				
			//echo "<pre>";print_r($cities);die;
	 
			
		return view('client.index',['menuArr'=>$menuArr,'clientCategories'=>$clientCategories,'citiesList'=>$cities,'clients'=>$clients,'blogdetails'=>$blogdetails,'testimonialsdetails'=>$testimonialsdetails,'subcategory'=>$subcategory,'entranceExam'=>$entranceExam,'studyAbroad'=>$studyAbroad]);
    }
    
    public function saveEnquiry(Request $request){
 
		if($request->ajax()){
			 
			   $validator = Validator::make($request->all(),[							
				'name' 	=> 'required|regex:/^[\pL\s\-]+$/u|min:3|max:32',					
				'email' 	=> 'required|regex:/^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i',					
				'mobile' 	=> 'required|numeric',	
			 
				'kw_text'=>'required',				
			 
		 		
			]); 
			
			if($validator->fails()){
				$errorsBag = $validator->getMessageBag()->toArray();
				 
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}	  
				 
	 
	 
	 
	 
	 
		
		$lead = new Lead;		 
		$lead->name= $request->input('name');
		$lead->email= $request->input('email');
	
		$lead->lead_form = $request->input('lead_form');
        $cityname = ucwords(str_replace("-"," ",$request->input('city_id')));				 
        $city = Citieslists::where('city',ucwords(str_replace("-"," ",$request->input('city_id'))))->first(); 
        
        if(!empty($city->id)){
        $lead->city_id = $city->id;
        $lead->city_name = $city->city;
        }else{
            if($cityname){
            $lead->city_name = $cityname;
            }else{
                 $lead->city_name = 'none';
            }
        }
        if($request->has('b_end')){
        $lead->b_end = $request->input('b_end');
        } 

		$mobile= ltrim($request->input('mobile'), '0');	
		$mobile= trim($mobile);	
		$newmobile=  preg_replace('/\s+/', '', $mobile);
		$lead->mobile =$newmobile;
        $keyword = Keyword::where('keyword',$request->input('kw_text'))->first();	
      
        if(!empty($keyword)){
        $lead->kw_id = $keyword->id;
        $lead->kw_text = $keyword->keyword;
     
        } else{
        $lead->kw_id = 0;
        $lead->kw_text =$request->input('kw_text');
        }
        
        
        $lead->status_id = Status::where('name','LIKE','New Lead')->first()->id;
        $lead->status_name = Status::where('name','LIKE','New Lead')->first()->name;
        $lead->remark = $request->input('remark');
        $lead->created_by = 101;

 
		if($lead->save())
		{
			
				$followUp = new LeadFollowUp;
					$followUp->status = Status::where('name','LIKE','New Lead')->first()->id;				 
					$followUp->remark = $request->input('remark');
				//	$followUp->expected_date_time = date('Y-m-d H:i:s');
					$followUp->lead_id = $lead->id;
					//$followUp->remark_by =Auth::user()->id;
					$followUp->save();	
			 
			 
	
			 
			 
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: enquiry <leads@enquiry.co.in>';
		 
	    	$subject="Student Enquiry - ".$course_name;
	    	if(!empty($request->input('demo_date'))){
				$demo_date ='<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Date:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$request->input('demo_date').'</span><u></u><u></u></p>
			</td>
			</tr>';
				
			}else{
				
				$demo_date="";
			}
			
			if(!empty($request->input('experience'))){
				$experience ='<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Experience:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$request->input('experience').'</span><u></u><u></u></p>
			</td>
			</tr>';
				
			}else{
				
				$experience="";
			}
			
	    	
			$message=' <tr>
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
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Mobile:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">'.'+'.$request->input('code').'-'.ltrim($request->input('phone'), '0').'</span><u></u><u></u></p>
			</td>
			</tr>
			<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Course:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$course_name.'</span><u></u><u></u></p>
			</td>
			</tr>
			'.$demo_date.'
			'.$experience.'
			 
				<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Country and Code:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$geo_country.' ('.$geo_countryCode.')</span><u></u><u></u></p>
			</td>
			</tr>
				<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Type of Lead:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$type_lead.'</span><u></u><u></u></p>
			</td>
			</tr>
			<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">From Session:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$request->input('from_title').'</span><u></u><u></u></p>
			</td>
			</tr>
			<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">From Page:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$request->input('from').'</span><u></u><u></u></p>
			</td>
			</tr>';
			
			 $stdemail="";
			 $codemail="";
			 $coordinator="";
         
          
        
           //to = array( "quickindiawebsite@gmail.com");
          
         /* $to = array( "info@quickindia.co.in");
 		     Mail::send('mails.send_lead_inquiry', ['msg'=>$message], function ($m) use ($message,$request,$subject,$stdemail,$codemail,$to) {
				$m->from('leads@quickindia.co.in', $request->input('name'));
				$m->to($to, "")->subject($subject);	
			});   
      */
		/*	if(!empty($request->input('email'))){
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: quickindia <leads@quickindia.co.in>';
			$stdemail=$request->input('email');
	    	$std_message=$request->input('name');
			$subject_stud=$request->input('name') .": Thanks for your Enquiry";	
 		    Mail::send('mails.mailer', ['name'=>$std_message], function ($m) use ($std_message,$request,$subject_stud,$stdemail) {
				$m->from('leads@quickindia.co.in', 'Croma Campus');
				$m->to($stdemail, "")->subject($subject_stud);				
			});  
			}
		*/
			
			
			return response()->json([
				'statusCode'=>1,
				'response'=>[
					'responseCode'=>200,
					'payload'=>'',
					'message'=>'Follow Up created successfully'
				]
			],200);
				}else{					
				return response()->json([
				'statusCode'=>1,
				'response'=>[
					'responseCode'=>200,
					'payload'=>'',
					'message'=>'Some Error Follow up'
				]
			],200);	
					
				}
			 
			 
		 
		}	
		
	}
 

   public function saveEnquiryWithoutZone(Request $request){
	 
	 
		if($request->ajax()){
			 
			   $validator = Validator::make($request->all(),[							
				'name' 	=> 'required|regex:/^[\pL\s\-]+$/u|min:3|max:32',					
				'email' 	=> 'required|regex:/^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i',					
				'mobile' 	=> 'required|numeric',	
			//	'phone' 	=> 'required|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im',				
				'kw_text'=>'required',				
			 			
		 		
			]); 
			
			if($validator->fails()){
				$errorsBag = $validator->getMessageBag()->toArray();
			 
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}	  
				 
	 	$lead = new Lead;		 
		$lead->name= $request->input('name');
		$lead->email= $request->input('email');
	
		$lead->lead_form = $request->input('lead_form');
		
 
        $cityname = ucwords(str_replace("-"," ",$request->input('city_id')));		
        
        $city = Citieslists::where('city',ucwords(str_replace("-"," ",$request->input('city_id'))))->first(); 
        
        if(!empty($city->id)){
        $lead->city_id = $city->id;
        $lead->city_name = $city->city;
        }else{
            if($cityname){
            $lead->city_name = $cityname;
            }else{
                 $lead->city_name = 'none';
            }
        }
        if($request->has('b_end')){
        $lead->b_end = $request->input('b_end');
        } 

		$mobile= ltrim($request->input('mobile'), '0');	
		$mobile= trim($mobile);	
		$newmobile=  preg_replace('/\s+/', '', $mobile);
		$lead->mobile =$newmobile;
        $keyword = Keyword::where('keyword',$request->input('kw_text'))->first();	
      
        if(!empty($keyword)){
        $lead->kw_id = $keyword->id;
        $lead->kw_text = $keyword->keyword;
     $course_name = $keyword->keyword;
        } else{
        $lead->kw_id = 0;
        $lead->kw_text =$request->input('kw_text');
		$course_name = $request->input('kw_text');
        }
        
        
        $lead->status_id = Status::where('name','LIKE','New Lead')->first()->id;
        $lead->status_name = Status::where('name','LIKE','New Lead')->first()->name;
        $lead->remark = $request->input('remark');
        $lead->created_by = 101;
 
 
		if($lead->save())
		{
			
				$followUp = new LeadFollowUp;
					$followUp->status = Status::where('name','LIKE','New Lead')->first()->id;				 
					$followUp->remark = $request->input('remark');
			 
					$followUp->lead_id = $lead->id;
				 
					$followUp->save();	
		 
			 
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: enquiry <leads@enquiry.co.in>';
		 
	    	$subject="Student Enquiry - ".$course_name;
	    	if(!empty($request->input('demo_date'))){
				$demo_date ='<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Date:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$request->input('demo_date').'</span><u></u><u></u></p>
			</td>
			</tr>';
				
			}else{
				
				$demo_date="";
			}
			
			if(!empty($request->input('experience'))){
				$experience ='<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Experience:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$request->input('experience').'</span><u></u><u></u></p>
			</td>
			</tr>';
				
			}else{
				
				$experience="";
			}
			
	    	
			$message=' <tr>
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
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Mobile:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">'.'+'.$request->input('code').'-'.ltrim($request->input('phone'), '0').'</span><u></u><u></u></p>
			</td>
			</tr>
			<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Course:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$course_name.'</span><u></u><u></u></p>
			</td>
			</tr>
			'.$demo_date.'
			'.$experience.'
			 
				<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Country and Code:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">  </span><u></u><u></u></p>
			</td>
			</tr>
				<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Type of Lead:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> </span><u></u><u></u></p>
			</td>
			</tr>
			<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">From Session:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$request->input('from_title').'</span><u></u><u></u></p>
			</td>
			</tr>
			<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">From Page:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$request->input('from').'</span><u></u><u></u></p>
			</td>
			</tr>';
			
			 $stdemail="";
			 $codemail="";
			 $coordinator="";
         
          
        
            
         
			
			return response()->json([
				'statusCode'=>1,
				'response'=>[
					'responseCode'=>200,
					'payload'=>'',
					'message'=>'Follow Up created successfully'
				]
			],200);
				}else{					
				return response()->json([
				'statusCode'=>1,
				'response'=>[
					'responseCode'=>200,
					'payload'=>'',
					'message'=>'Some Error Follow up'
				]
			],200);	
					
				}
			 
			 
		 
		}	
		
	}
 


/**
     * Get matches trainers based on ajax.
     *
     * @param  string
     * @return JSON Object having matched course details
     */
    public function getCountryCode(Request $request)
    {
		if($request->ajax()){
			
			$len=strlen($request->input('id'));
			if(null==$request->input('id')){
					$countryies = Citieslists::whereIn('id',['278','596','961','428'])->get();
				 
			}else{
				$countryies = Citieslists::orderBy('city','asc');				
				$countryies = $countryies->where(function($query) use($request){
					$query->orWhere('city','LIKE','%'.$request->input('id').'%')			    	 
						  ->orWhere('state','LIKE','%'.$request->input('id').'%');
				});
				$countryies =$countryies->get();				
			}
			 
			if(count($countryies)>0){ 
			echo'<div class="resultCode" style="background: #f7fbff;padding: 10px;border: 1px solid #DCDCDC;margin-top: 0px;position: absolute;width: 228px;z-index: 9;margin-left: 0px;top: 100%;height: 205px;overflow-y: scroll;">	
			<ul>';
			foreach($countryies as $data){
				
			$pos=stripos($data->city, $request->input('id'));
			if($pos>=0){
			$str=substr($data->city, $pos, $len);
			$strong_str=$str;
			$final_str=str_replace($str, $strong_str, $data->city); ?>
		 
			<li  style="padding: 5px 5px;text-align:left;margin-left: 1px;font-size: 14px;" >
			<a style='width:100%; cursor:pointer;'><?php echo ucwords($final_str); ?></a>
			</li>
		 
			<?php }else{ ?>
			 
			<li  style="padding: 5px 20px;text-align:left;margin-left: 1px;font-size: 14px;" >
			<a style='width:100%; cursor:pointer;' ><?php echo ucwords($data->city); ?></a>
			</li>
			
			<?php 	} ?>
			<?php	
			}
			echo'</ul>
			</div>';
			} else { 
			echo'<div class="resultCourse" style="list-style-type: none; background: #fff; padding: 10px 20px; border: 1px solid #DCDCDC; margin-top: 68px;position: absolute;width: 228px;z-index: 999999;margin-left: 0px;" ><ul><li><p style="color:red;text-align: left;font-size: 13px;" >Sorry Does not found city !</p></li></ul></div>';
		
			} 				 
		} 	
	}


public function saveTwoEnquiry(Request $request){
	 
		if($request->ajax()){
			 
			   $validator = Validator::make($request->all(),[							
				'name' 	=> 'required|regex:/^[\pL\s\-]+$/u|min:3|max:32',
				'mobile' 	=> 'required|numeric',	
				'kw_text'=>'required',				
			 			
		 		
			]); 
			
			if($validator->fails()){
				$errorsBag = $validator->getMessageBag()->toArray();
			 
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}	  
				 
	 	$lead = new Lead;		 
		$lead->name= $request->input('name');
		$lead->email= $request->input('email');
	
		$lead->lead_form = $request->input('lead_form');
        $cityname = ucwords(str_replace("-"," ",$request->input('city_id')));				 
        $city = Citieslists::where('city',ucwords(str_replace("-"," ",$request->input('city_id'))))->first(); 
        
        if(!empty($city->id)){
        $lead->city_id = $city->id;
        $lead->city_name = $city->city;
        }else{
            if($cityname){
            $lead->city_name = $cityname;
            }else{
            $lead->city_name = 'none';
            }
        }
        if($request->has('b_end')){
        $lead->b_end = $request->input('b_end');
        } 

		$mobile= ltrim($request->input('mobile'), '0');	
		$mobile= trim($mobile);	
		$newmobile=  preg_replace('/\s+/', '', $mobile);
		$lead->mobile =$newmobile;
        $keyword = Keyword::where('keyword',$request->input('kw_text'))->first();	
      
        if(!empty($keyword)){
        $lead->kw_id = $keyword->id;
        $lead->kw_text = $keyword->keyword;
     
        } else{
        $lead->kw_id = 0;
        $lead->kw_text =$request->input('kw_text');
        }
        
        
        $lead->status_id = Status::where('name','LIKE','New Lead')->first()->id;
        $lead->status_name = Status::where('name','LIKE','New Lead')->first()->name;
        $lead->remark = $request->input('remark');
        $lead->created_by = 101;

 
		if($lead->save())
		{
			
				$followUp = new LeadFollowUp;
					$followUp->status = Status::where('name','LIKE','New Lead')->first()->id;				 
					$followUp->remark = $request->input('remark');
			 
					$followUp->lead_id = $lead->id;
				 
					$followUp->save();	
		 
			 
// 			$headers  = 'MIME-Version: 1.0' . "\r\n";
// 			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// 			$headers .= 'From: enquiry <leads@enquiry.co.in>';
		 
// 	    	$subject="Student Enquiry - ".$request->input('name');
// 	    	if(!empty($request->input('demo_date'))){
// 				$demo_date ='<tr>
// 			<td style="padding:0in 0in 7.5pt 0in">
// 			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Date:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$request->input('demo_date').'</span><u></u><u></u></p>
// 			</td>
// 			</tr>';
				
// 			}else{
				
// 				$demo_date="";
// 			}
			
// 			if(!empty($request->input('experience'))){
// 				$experience ='<tr>
// 			<td style="padding:0in 0in 7.5pt 0in">
// 			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Experience:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$request->input('experience').'</span><u></u><u></u></p>
// 			</td>
// 			</tr>';
				
// 			}else{
				
// 				$experience="";
// 			}
			
	    	
// 			$message=' <tr>
// 			<td style="padding:0in 0in 7.5pt 0in">
// 			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Name:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
// 			'.$request->input('name').'</span><u></u><u></u></p>
// 			</td>
// 			</tr>
// 			<tr>
// 			<td style="padding:0in 0in 7.5pt 0in">
// 			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Email:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
// 			'.$request->input('email').'</span><u></u><u></u></p>
// 			</td>
// 			</tr>
// 			<tr>
// 			<td style="padding:0in 0in 7.5pt 0in">
// 			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Mobile:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">'.'+'.$request->input('code').'-'.ltrim($request->input('phone'), '0').'</span><u></u><u></u></p>
// 			</td>
// 			</tr>
// 			<tr>
// 			<td style="padding:0in 0in 7.5pt 0in">
// 			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Course:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$course_name.'</span><u></u><u></u></p>
// 			</td>
// 			</tr>
// 			'.$demo_date.'
// 			'.$experience.'
			 
// 				<tr>
// 			<td style="padding:0in 0in 7.5pt 0in">
// 			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Country and Code:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$geo_country.' ('.$geo_countryCode.')</span><u></u><u></u></p>
// 			</td>
// 			</tr>
// 				<tr>
// 			<td style="padding:0in 0in 7.5pt 0in">
// 			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Type of Lead:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$type_lead.'</span><u></u><u></u></p>
// 			</td>
// 			</tr>
// 			<tr>
// 			<td style="padding:0in 0in 7.5pt 0in">
// 			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">From Session:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$request->input('from_title').'</span><u></u><u></u></p>
// 			</td>
// 			</tr>
// 			<tr>
// 			<td style="padding:0in 0in 7.5pt 0in">
// 			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">From Page:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> '.$request->input('from').'</span><u></u><u></u></p>
// 			</td>
// 			</tr>';
			
			 $stdemail="";
			 $codemail="";
			 $coordinator="";
         
          
        
            
         
			
			return response()->json([
				'statusCode'=>1,
				'response'=>[
					'responseCode'=>200,
					'payload'=>'',
					'message'=>'Follow Up created successfully'
				]
			],200);
				}else{					
				return response()->json([
				'statusCode'=>1,
				'response'=>[
					'responseCode'=>200,
					'payload'=>'',
					'message'=>'Some Error Follow up'
				]
			],200);	
					
				}
			 
			 
		 
		}	
		
	}
 
   
   
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function autoFormSave(Request $request)
    {
		 
		if($request->ajax()){    			 
				$cityname = ucwords(str_replace("-"," ",$request->input('city_id')));				 
				$city = Citieslists::where('city','LIKE',ucwords(str_replace("-"," ",$request->input('city_id'))))->first(); 
				$lead = new Lead;
				if(!empty($city->id)){
				$lead->city_id = $city->id;
				$lead->city_name = $city->city;
				}else{
                    if($cityname){
                    $lead->city_name = $cityname;
                    }else{
                    $lead->city_name = 'none';
                    }
				}
				
				$lead->name = $request->input('name');				
				if($request->input('email') !=''){
					
					$lead->email = $request->input('email');
				}
				$lead->mobile = $request->input('mobile');
				$lead->lead_form = $request->input('lead_form');			 
				$keyword = Keyword::where('keyword','LIKE',$request->input('kw_text'))->get();								 
				if(!empty($keyword)){
					$lead->kw_id = $keyword[0]->id;
					$lead->kw_text = $keyword[0]->keyword;
					$bucketIndex = $keyword[0]->bucket;
				}else{
					return response()->json(['status'=>1,'msg'=>'Keyword not found'],404);
				}
				if($request->has('b_end')){
				$lead->b_end = $request->input('b_end');
				}  
				$lead->status_id = Status::where('name','LIKE','New Lead')->first()->id;
				$lead->status_name = Status::where('name','LIKE','New Lead')->first()->name;
				$lead->remark = $request->input('remark');
				$lead->created_by = 109;
			 
				if($lead->save()){				
					$followUp = new LeadFollowUp;
					$followUp->status = Status::where('name','LIKE','New Lead')->first()->id;				 
					$followUp->remark = $request->input('remark');
				//	$followUp->expected_date_time = date('Y-m-d H:i:s');
					$followUp->lead_id = $lead->id;
					//$followUp->remark_by =Auth::user()->id;
					$followUp->save();		
				 //Cookie::queue("showPopup", "yes", "60");
					return response()->json(['status'=>1,'msg'=>'Lead added successfully'],200);
				}
			 
		}
    }
	
 
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		 
		if($request->ajax()){    			 
				$cityname = ucwords(str_replace("-"," ",$request->input('city_id')));				 
				$city = Citieslists::where('city','LIKE',ucwords(str_replace("-"," ",$request->input('city_id'))))->first(); 
				$lead = new Lead;
				if(!empty($city->id)){
				$lead->city_id = $city->id;
				$lead->city_name = $city->city;
				}else{
                    if($cityname){
                    $lead->city_name = $cityname;
                    }else{
                    $lead->city_name = 'none';
                    }
				}
				
				$lead->name = $request->input('name');				
				if($request->input('email') !=''){
					
					$lead->email = $request->input('email');
				}
				$lead->mobile = $request->input('mobile');
				$lead->lead_form = $request->input('lead_form');			 
				$keyword = Keyword::where('keyword','LIKE',$request->input('kw_text'))->get();								 
				if(!empty($keyword)){
					$lead->kw_id = $keyword[0]->id;
					$lead->kw_text = $keyword[0]->keyword;
					$bucketIndex = $keyword[0]->bucket;
				}else{
					return response()->json(['status'=>1,'msg'=>'Keyword not found'],404);
				}
				if($request->has('b_end')){
				$lead->b_end = $request->input('b_end');
				}  
				$lead->status_id = Status::where('name','LIKE','New Lead')->first()->id;
				$lead->status_name = Status::where('name','LIKE','New Lead')->first()->name;
				$lead->remark = $request->input('remark');
				$lead->created_by = 109;
			 
				if($lead->save()){				
					$followUp = new LeadFollowUp;
					$followUp->status = Status::where('name','LIKE','New Lead')->first()->id;				 
					$followUp->remark = $request->input('remark');
				//	$followUp->expected_date_time = date('Y-m-d H:i:s');
					$followUp->lead_id = $lead->id;
					//$followUp->remark_by =Auth::user()->id;
					$followUp->save();		
				 //Cookie::queue("showPopup", "yes", "60");
				/*$template = 'emails.sendlead';	 
				$client="Institute";
			 $check=  Mail::send($template, ['client'=>$client,'lead'=>$lead,'city'=>$city,'cityname'=>$cityname], function ($m) use ($client,$lead) {    
         
            $m->from('info@quickindia.in', 'quickindia');             
            //$client->email
            $m->to('info@quickindia.in', $lead->name)->subject('quickindia Lead: '.$lead->kw_text)->cc('quickindia1@gmail.com');
        });	  */
										 
				 	
					
					return response()->json(['status'=>1,'msg'=>'Lead added successfully'],200);
				}
			 
		}
    }
	
 

	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchUser(Request $request)
    {
        //
		header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
		if($request->wantsJson()){
			$query = DB::table('users');
			$query = $query->select('users.id','users.first_name','users.last_name');
			$str = '';
			if($request->input('q')!=""){
				$str = trim($request->input('q'));
				$query = $query->orWhere('users.first_name','LIKE','%'.$str.'%');
				$query = $query->orWhere('users.last_name','LIKE','%'.$str.'%');
			}
			$query = $query->get();
			return response()->json(['status'=>1,'users'=>$query]);			
		}
	}
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchKWcc(Request $request)
    {
       
		header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
		if($request->wantsJson()){
			$query = DB::table('keyword')
				->select('keyword.keyword','keyword.id');
			$str = '';
			if($request->input('q')!=""){
				$str = trim($request->input('q'));
				$query = $query->orWhere('keyword.keyword','LIKE','%'.$str.'%');
				$query = $query->orderBy(DB::raw("CASE WHEN keyword.keyword LIKE '".$str."%' THEN 1 ELSE 2 END"));
				 
				$query = $query->distinct()->get();

 
			}
			return response()->json(['status'=>1,'areas'=>$query]);			
		}
	}
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchKW(Request $request)
    { 
		 
		$query = DB::table('keyword')			 
			->select('keyword.keyword','keyword.id');
		$str = '';
		if($request->input('search_kw')!=""){
			$str = trim($request->input('search_kw'));
			$query = $query->orWhere('keyword.keyword','LIKE','%'.$str.'%');
			$query = $query->orderBy(DB::raw("CASE WHEN keyword.keyword LIKE '".$str."%' THEN 1 ELSE 2 END"));
		 
			$query = $query->distinct()->get();
 
		}
		$html = "";
		foreach($query as $q){
		 
			$html .= "<li><a href='#'><i class='fa fa-search'></i>".$q->keyword."</a></li>";
		}
		$query = DB::table('clients')
			->select('clients.business_name');
		$str = '';
		if($request->input('search_kw')!=""){
			$str = trim($request->input('search_kw'));
			$query = $query->orWhere('clients.business_name','LIKE','%'.$str.'%');
			$query = $query->orderBy(DB::raw("CASE WHEN clients.business_name LIKE '".$str."%' THEN 1 ELSE 2 END"),'DESC');
			if($request->has('city')&&$request->input('city')!=''){
				$query = $query->where('clients.city','LIKE','%'.$request->input('city').'%');
			}
			$query = $query->distinct()->get();
		}
		foreach($query as $q){
			 
			$html .= "<li><a href='#'><i class='fa fa-search'></i> ".$q->business_name."</a></li>";
		}
		return response()->json(['status'=>1,'message'=>$html]);
    }
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getKWList(Request $request)
    {
        $kwdsList = Keyword::where('child_category_id',$request->input('child_cat_id'))
			   ->where('parent_category_id',$request->input('parent_cat_id'))
			   ->select('keyword')
			   ->distinct()
			   ->get();
			   
			   
		return response()->json(['status'=>1,'message'=>$kwdsList]);
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCityKWList(Request $request)
    {
	/* 	$kwdsList = DB::table('keyword')
		          //    ->join('cities','keyword.city_id','=','cities.id')
					  //->select('cities.city')
					  ->where('child_category_id',$request->input('child_cat_id'))
					  ->where('parent_category_id',$request->input('parent_cat_id'))
					  ->where('keyword','LIKE',$request->input('kw'))
					  ->distinct()
					  ->get(); */
					  
			$citiesList = DB::table('assigned_kwds')
			->join('citylists','assigned_kwds.city_id','=','citylists.id')			
			->select('citylists.city')	
			->distinct()			
			->get();
      
		return response()->json(['status'=>1,'message'=>$citiesList]);
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function callHtml($html)
    {
		if (view()->exists('client.html.'.$html)) {
			return view('client.html.'.$html);
		}else{
			return view('404');
		}
    }
	
    /**
     * Display a listing of the client categories resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clientCategories(Request $request)
    {
		$clientCategories = ClientCategory::all();
		return view('client.client_categories',['clientCategories'=>$clientCategories]);
    }
	
	
	 /**
     * Display a listing of the client categories resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cityCategories(Request $request, $city,$part_slug)
    {
		  
		$part_id= ParentCategory::where('parent_slug',$part_slug)->first();	 
		
// 		$subcategory= DB::table('child_category')
// 			->join('parent_category','child_category.parent_category_id','=','parent_category.id')		
// 			->where('parent_category_id',$part_id->id)
// 			->select('parent_category.*','child_category.*')->limit(24)
// 			->get();
		
	 
	      $subcategory = DB::table('keyword')
 
        ->select('keyword.*','keyword.id as key_id','keyword.faqq1','keyword.faqa1','keyword.faqq2','keyword.faqa2','keyword.faqq3','keyword.faqa3','keyword.faqq4','keyword.faqa4','keyword.faqq5','keyword.faqa5','keyword.meta_title','keyword.meta_description','keyword.meta_keywords','keyword.top_description','keyword.bottom_description','keyword.ratingvalue','keyword.ratingcount')
        	
        ->where('keyword.parent_category_id',$part_id->id)->get();
	 
	//	echo "<pre>";print_r($subcategory);die;
	 
			$cateoryClient = DB::table('clients')
			->join('assigned_kwds','clients.id','=','assigned_kwds.client_id')
			->join('keyword','assigned_kwds.kw_id','=','keyword.id')
			->join('citylists','assigned_kwds.city_id','=','citylists.id')
			->leftJoin(DB::raw('(SELECT SUM(rating) AS rating,comment_client_ID,COUNT(comment_ID) AS comment_count FROM comments GROUP BY comment_client_ID) c'),'c.comment_client_ID','=','clients.id')			
			->select('clients.*','citylists.city','assigned_kwds.sold_on_position','c.rating','c.comment_count')
			->where('citylists.city','LIKE',$city)
			->where('clients.active_status','1')
			->where('assigned_kwds.parent_cat_id',$part_id->id)	
			//->where('assigned_kwds.sold_on_position','!=','king')
			->orderby(DB::raw('(CASE `assigned_kwds`.`sold_on_position` WHEN \'platinum\' THEN 1 WHEN \'diamond\' THEN 2 WHEN \'FreeListing\' THEN 3 END)'),'asc')
			->groupBy('client_id')			
			//->orderby(DB::raw('(CASE `clients`.`certified_status` WHEN \'1\' THEN 1 END)'),'DESC')		
			->get();
	 
		
 
		$clientCategories = ClientCategory::all();
		return view('client.courseprogram_client',['cateoryClient'=>$cateoryClient,'subcategory'=>$subcategory,'part_id'=>$part_id,'city'=>$city]);
    }
	 /**
     * Display a listing of the client categories resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subcategories(Request $request, $city,$part_slug,$child_slug)
    {
		
	 
		$part_id= ParentCategory::where('parent_slug',$part_slug)->first();	 
		$child_id= ChildCategory::where('child_slug',$child_slug)->first();	 
	 
		$subcategory= DB::table('child_category')
			->join('parent_category','child_category.parent_category_id','=','parent_category.id')		
			->where('parent_category_id',$part_id->id)
			->select('parent_category.*','child_category.*')->limit(24)
			->get();
			
	 
	  $kwdsList = Keyword::where('child_category_id',$child_id->id)
			   ->where('parent_category_id',$part_id->id)
			   ->select('keyword')
			   ->distinct()
			   ->get();
		 
		
		$subCateoryClient = DB::table('clients')
			->join('assigned_kwds','clients.id','=','assigned_kwds.client_id')
				->join('citylists','assigned_kwds.city_id','=','citylists.id')
				->rightJoin(DB::raw('(SELECT SUM(rating) AS rating,comment_client_ID,COUNT(comment_ID) AS comment_count,comment_content  FROM comments GROUP BY comment_client_ID) c'),'c.comment_client_ID','=','clients.id')
			//->join('parent_category','assigned_kwds.parent_cat_id','=','parent_category.id')	
			
			->select('clients.id','clients.business_name','clients.business_slug','clients.website','clients.city','clients.logo','assigned_kwds.*','c.rating','c.comment_count','c.comment_content')		 
			->where('assigned_kwds.parent_cat_id',$part_id->id)	
			->where('citylists.city','LIKE',$city)		
			->where('assigned_kwds.child_cat_id',$child_id->id)
			->groupBy('client_id')			
			->get();
			
			
			$subCateoryClient = DB::table('clients')
			->join('assigned_kwds','clients.id','=','assigned_kwds.client_id')
			->join('keyword','assigned_kwds.kw_id','=','keyword.id')
			->join('citylists','assigned_kwds.city_id','=','citylists.id')
			->leftJoin(DB::raw('(SELECT SUM(rating) AS rating,comment_client_ID,COUNT(comment_ID) AS comment_count FROM comments GROUP BY comment_client_ID) c'),'c.comment_client_ID','=','clients.id')			
			->select('clients.*','citylists.city','assigned_kwds.sold_on_position','c.rating','c.comment_count')
			->where('citylists.city','LIKE',$city)
			->where('clients.active_status','1')
			->where('assigned_kwds.child_cat_id',$child_id->id)	
			//->where('assigned_kwds.sold_on_position','!=','king')
			->orderby(DB::raw('(CASE `assigned_kwds`.`sold_on_position` WHEN \'platinum\' THEN 1 WHEN \'diamond\' THEN 2 WHEN \'FreeListing\' THEN 3 END)'),'asc')
			->groupBy('client_id')			
			//->orderby(DB::raw('(CASE `clients`.`certified_status` WHEN \'1\' THEN 1 END)'),'DESC')		
			->get();
		 
		
		 
		$clientCategories = ClientCategory::all();
		return view('client.subcourseprogram_client',['subCateoryClient'=>$subCateoryClient,'subcategory'=>$subcategory,'part_id'=>$part_id,'child_id'=>$child_id,'kwdsList'=>$kwdsList,'city'=>$city]);
    }
	
    /**
     * Display a listing of the clients of categories resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clients(Request $request, $slug=null)
    {
		try{
			if(empty($slug)){
				throw new Exception("Slug can't be null");
			}
		}catch(\Exception $e){
			return $e->getMessage();
		}
		$clientCategory = ClientCategory::select('id','name')->where('name','LIKE',inverse_generate_slug($slug))->first();
		
		if(empty($clientCategory)){
			return redirect('/clients');
		}
		
	 
		$clients = DB::table('clients')
			->join('assigned_client_categories','assigned_client_categories.client_id','=','clients.id')
			->join(DB::raw('(SELECT comment_client_ID, COUNT(comment_ID) as comments_count, SUM(rating) as ratings_sum FROM comments GROUP BY comment_client_ID) as cmts'),'cmts.comment_client_ID','=','clients.id')
			->select('clients.*','assigned_client_categories.client_id','assigned_client_categories.client_category_id','cmts.*')
			->where('assigned_client_categories.client_category_id','=',$clientCategory->id)
			->whereNull('clients.deleted_at')
			->get();
				
		 
		
		return view('client.clients',['clients'=>$clients,'slug'=>$slug,'clientCategory'=>$clientCategory]);
    } 
	
	/**
     * Display a listing of the clients of categories resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function city(Request $request, $city=null)
    {		   
  
		try{
			 
		$clientLists =  Client::where('logo','<>','')->where('business_intro','<>','')->limit(12)->get();	
		$checkcity = Client::where('logo','<>','')->where('city',$city)->get();
	 
		if(!empty($checkcity) && count($checkcity)>0){		
  
			$cityclients = $checkcity;
			return view('client.cityclients',['cityclients'=>$cityclients]);
		
		}else{
				 
	  	$clientskeyword = DB::table('clients')
			->join('assigned_kwds','clients.id','=','assigned_kwds.client_id')
			->join('keyword','assigned_kwds.kw_id','=','keyword.id')
			->join('citylists','assigned_kwds.city_id','=','citylists.id')
			->leftJoin(DB::raw('(SELECT SUM(rating) AS rating,comment_client_ID,COUNT(comment_ID) AS comment_count FROM comments GROUP BY comment_client_ID) c'),'c.comment_client_ID','=','clients.id')			
			->select('clients.*','citylists.city','assigned_kwds.sold_on_position','c.rating','c.comment_count','keyword.*')
	
			->where('keyword.keyword','LIKE',ucwords(str_replace("-"," ",$city)))
		 
			->orderby(DB::raw('(CASE `assigned_kwds`.`sold_on_position` WHEN \'platinum\' THEN 1 WHEN \'diamond\' THEN 2 WHEN \'FreeListing\' THEN 3 END)'),'asc')
		//	->orderby(DB::raw('(CASE `assigned_kwds`.`sold_on_position` WHEN \'platinum\' THEN 1 WHEN \'diamond\' THEN 2 END)'),'asc')
			//->orderby(DB::raw('(CASE `assigned_kwds`.`sold_on_position` WHEN \'premium\' THEN 1 WHEN \'platinum\' THEN 2 WHEN \'royal\' THEN 3 WHEN \'preferred\' THEN 4 END)'),'asc')
			->groupBy('client_id')			
			//->orderby(DB::raw('(CASE `clients`.`certified_status` WHEN \'1\' THEN 1 END)'),'DESC')		
			->get();
			
		 $reviewsClientsList = DB::table('clients')
			->join('assigned_kwds','clients.id','=','assigned_kwds.client_id')
			->join('keyword','assigned_kwds.kw_id','=','keyword.id')
			->join('citylists','assigned_kwds.city_id','=','citylists.id')
			->rightJoin(DB::raw('(SELECT SUM(rating) AS rating,comment_client_ID,COUNT(comment_ID) AS comment_count,comment_content  FROM comments GROUP BY comment_client_ID) c'),'c.comment_client_ID','=','clients.id')
			->select('clients.*','citylists.city','assigned_kwds.sold_on_position','c.rating','c.comment_count','c.comment_content')		 
			->where('keyword.keyword','LIKE',ucwords(str_replace("-"," ",$city)))	
			->groupBy('client_id')				
			->get();
			
 
        $parentCategories = DB::table('keyword')
        ->join('parent_category','keyword.parent_category_id','=','parent_category.id')
        ->join('child_category','keyword.child_category_id','=','child_category.id')
        ->select('keyword.*','parent_category.*','child_category.*','parent_category.id as key_id','parent_category.faqq1','parent_category.faqa1','parent_category.faqq2','parent_category.faqa2','parent_category.faqq3','parent_category.faqa3','parent_category.faqq4','parent_category.faqa4','parent_category.faqq5','parent_category.faqa5','parent_category.meta_title','parent_category.meta_description','parent_category.meta_keywords','parent_category.top_description','parent_category.bottom_description','parent_category.ratingvalue','parent_category.ratingcount')
        ->groupBy('child_category.child_slug')	
        ->where('parent_category.parent_slug',$city)->first();
       
          
           $keywordlist = DB::table('keyword')
        ->join('parent_category','keyword.parent_category_id','=','parent_category.id')
        ->join('child_category','keyword.child_category_id','=','child_category.id')
        ->select('keyword.*','parent_category.*','child_category.*','keyword.id as key_id','keyword.faqq1','keyword.faqa1','keyword.faqq2','keyword.faqa2','keyword.faqq3','keyword.faqa3','keyword.faqq4','keyword.faqa4','keyword.faqq5','keyword.faqa5','keyword.meta_title','keyword.meta_description','keyword.meta_keywords','keyword.top_description','keyword.bottom_description','keyword.ratingvalue','keyword.ratingcount')
        ->groupBy('child_category.child_slug')	
        ->where('parent_category.parent_slug',$city)->get();
        
		  if(!empty($parentCategories)){
		     
		     
		     $clientskeyword = DB::table('clients')
			->join('assigned_kwds','clients.id','=','assigned_kwds.client_id')
			->join('keyword','assigned_kwds.kw_id','=','keyword.id')
			->join('citylists','assigned_kwds.city_id','=','citylists.id')
			->join('parent_category','keyword.parent_category_id','=','parent_category.id')
			->leftJoin(DB::raw('(SELECT SUM(rating) AS rating,comment_client_ID,COUNT(comment_ID) AS comment_count FROM comments GROUP BY comment_client_ID) c'),'c.comment_client_ID','=','clients.id')			
			->select('clients.*','citylists.city','assigned_kwds.sold_on_position','c.rating','c.comment_count','keyword.*')
	
	 
		    ->where('parent_category.parent_slug',$city)
			->orderby(DB::raw('(CASE `assigned_kwds`.`sold_on_position` WHEN \'platinum\' THEN 1 WHEN \'diamond\' THEN 2 WHEN \'FreeListing\' THEN 3 END)'),'asc')
		//	->orderby(DB::raw('(CASE `assigned_kwds`.`sold_on_position` WHEN \'platinum\' THEN 1 WHEN \'diamond\' THEN 2 END)'),'asc')
			//->orderby(DB::raw('(CASE `assigned_kwds`.`sold_on_position` WHEN \'premium\' THEN 1 WHEN \'platinum\' THEN 2 WHEN \'royal\' THEN 3 WHEN \'preferred\' THEN 4 END)'),'asc')
			->groupBy('client_id')			
			//->orderby(DB::raw('(CASE `clients`.`certified_status` WHEN \'1\' THEN 1 END)'),'DESC')		
			->get();
	 
		      	return view('client.parentKeyword',['clientskeyword'=>$clientskeyword,'keyword'=>$parentCategories,'reviewsClientsList'=>$reviewsClientsList,'clientLists'=>$clientLists,'city'=>$city,'keywordlist'=>$keywordlist]);	
	
		      
		  }else{
		         $childCategories = DB::table('keyword')
        ->join('parent_category','keyword.parent_category_id','=','parent_category.id')
        ->join('child_category','keyword.child_category_id','=','child_category.id')
        ->select('keyword.*','parent_category.*','child_category.*','child_category.id as key_id','child_category.faqq1','child_category.faqa1','child_category.faqq2','child_category.faqa2','child_category.faqq3','child_category.faqa3','child_category.faqq4','child_category.faqa4','parent_category.faqq5','child_category.faqa5','child_category.meta_title','child_category.meta_description','child_category.meta_keywords','child_category.top_description','parent_category.bottom_description','child_category.ratingvalue','child_category.ratingcount')
        ->where('child_category.child_slug',$city)->first();
		       
		       if(!empty($childCategories)){
		           
		        
    		  $clientskeyword = DB::table('clients')
    			->join('assigned_kwds','clients.id','=','assigned_kwds.client_id')
    			->join('keyword','assigned_kwds.kw_id','=','keyword.id')
    			->join('citylists','assigned_kwds.city_id','=','citylists.id')
    		  ->join('child_category','keyword.child_category_id','=','child_category.id')
    			->leftJoin(DB::raw('(SELECT SUM(rating) AS rating,comment_client_ID,COUNT(comment_ID) AS comment_count FROM comments GROUP BY comment_client_ID) c'),'c.comment_client_ID','=','clients.id')			
    			->select('clients.*','citylists.city','assigned_kwds.sold_on_position','c.rating','c.comment_count','keyword.*')
    	
    	 
    		    ->where('child_category.child_slug',$city)
    			->orderby(DB::raw('(CASE `assigned_kwds`.`sold_on_position` WHEN \'platinum\' THEN 1 WHEN \'diamond\' THEN 2 WHEN \'FreeListing\' THEN 3 END)'),'asc')
    		//	->orderby(DB::raw('(CASE `assigned_kwds`.`sold_on_position` WHEN \'platinum\' THEN 1 WHEN \'diamond\' THEN 2 END)'),'asc')
    			//->orderby(DB::raw('(CASE `assigned_kwds`.`sold_on_position` WHEN \'premium\' THEN 1 WHEN \'platinum\' THEN 2 WHEN \'royal\' THEN 3 WHEN \'preferred\' THEN 4 END)'),'asc')
    			->groupBy('client_id')			
    			//->orderby(DB::raw('(CASE `clients`.`certified_status` WHEN \'1\' THEN 1 END)'),'DESC')		
    			->get();
			
		          	return view('client.childKeyword',['clientskeyword'=>$clientskeyword,'keyword'=>$childCategories,'reviewsClientsList'=>$reviewsClientsList,'city'=>$city,'keywordlist'=>$keywordlist]);	
		           
		       }else{
		      	   
                    $keyword = DB::table('keyword')
                    ->join('parent_category','keyword.parent_category_id','=','parent_category.id')
                    ->join('child_category','keyword.child_category_id','=','child_category.id')
                    ->select('keyword.*','parent_category.*','child_category.*','keyword.id as key_id','keyword.faqq1','keyword.faqa1','keyword.faqq2','keyword.faqa2','keyword.faqq3','keyword.faqa3','keyword.faqq4','keyword.faqa4','keyword.faqq5','keyword.faqa5','keyword.meta_title','keyword.meta_description','keyword.meta_keywords','keyword.top_description','keyword.bottom_description','keyword.ratingvalue','keyword.ratingcount')
                    ->where('keyword','LIKE',ucwords(str_replace("-"," ",$city)))->first();
                    if(!empty($keyword)){
                    $keyword = $keyword;
                    }else{
                    
                   
                    $keyword = DB::table('child_category')
                    ->select('child_category.*')
                      ->where('child_category.child_category','LIKE',ucwords(str_replace("-"," ",$city)))->first();
                    if(!empty($keyword) && count($keyword)>0  ){
                        $keyword = $keyword;
                    }else{
                        
                                 	    
            $clients = Client::where('business_slug',$city)->where('logo','<>','')->get();
            $cities = Citieslists::select('id','city')->get();
            
            $clientLists =  Client::where('logo','<>','')->where('business_intro','<>','')->where('city','noida')->where('paid_status','1')->limit(12)->get();		
            if(count($clients)>0){
                foreach($clients as $c){
                $client = $c;
                break;
                }
            
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
            
            if(!empty($clients) && count($clients)>0 ){
            return view('client.client-detail',['client'=>$client,'cities'=>$cities,'comments'=>$comments,'count'=>$count,'sum'=>$sum,'avgRating'=>number_format($avgRating, 1, '.', ''),'graphQuery'=>$graphQuery,'barGraphQuery'=>$barGraphQuery,'assignedKwds'=>$assignedKwds,'clientLists'=>$clientLists,'clients'=>$clients,'assignedCity'=>$assignedCity]);
            
            }else{
                            
                    $parentCategories = ParentCategory::get();
                    $childCategories = ChildCategory::get();
                    $businessServices= DB::table('parent_category')
                    ->join('child_category','child_category.parent_category_id','=','parent_category.id')
                    ->select('parent_category.*','child_category.*')
                    ->get();
                        
                         return view('client.businessServices',['businessServices'=>$businessServices,'parentCategories'=>$parentCategories,'childCategories'=>$childCategories]);
                           
                           
                   
            
            
            }
                        
                        
                        

		            }
		            
                    }
                        
                    }
                    
                    }
            
		       }
		      	 
		  }
	
 
//echo "<pre>";print_r($keyword);die;
        
		return view('client.searchkeyword',['clientskeyword'=>$clientskeyword,'keyword'=>$keyword,'reviewsClientsList'=>$reviewsClientsList,'clientLists'=>$clientLists,'city'=>$city]);	
		}catch(\Exception $e){
			return view('client.errorpage');
		} 
	 
    }
	
	
    /**
     * Subscribe to our newsletter
     *
     */
    public function newsletter(Request $request)
    {
		try{
			if(null == $request->input('email')){
				throw new Exception("Enter valid email address");
			}
		}catch(\Exception $e){
			return response()->json(['status'=>0,'message'=>$e->getMessage()]);
		}
		$email = $request->input('email');
        Mail::send('emails.newsletter', ['email'=>$email], function ($m) use($email) {
            $m->from('newsletter@quickindia.in', 'quickindia');
            $m->to('care@quickindia.in', 'quickindia')->subject('Newsletter Subscription');
        });
		
		return response()->json(['status'=>1,'message'=>'Successfully subscribed to our newsletter']);
    }	
	
	
	 public function addLadsss(Request $request)
    {
        header("Access-Control-Allow-Origin: *");
       header('Access-Control-Allow-Credentials: true');
       	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
         
        
    }
    
    public function businessServices(Request $request)
    {
        $businessServices = DB::table('keyword')->get();
        $parentCategories = ParentCategory::get();
        $childCategories = ChildCategory::get();
        
        
        $businessServices= DB::table('parent_category')
        ->join('child_category','child_category.parent_category_id','=','parent_category.id')
        ->select('parent_category.*','child_category.*')
        ->get();
       
        
        
        return view('client.businessServices',['businessServices'=>$businessServices,'parentCategories'=>$parentCategories,'childCategories'=>$childCategories]);
    }
    
    
    
    public function category(Request $request)
    {
       
        $parentCategories = ParentCategory::get();
        $childCategories = ChildCategory::get();
        
        
        $businessServices= DB::table('parent_category')
        ->join('child_category','child_category.parent_category_id','=','parent_category.id')
        ->select('parent_category.*','child_category.*')
        ->groupBy('child_slug')
        ->get();
        
        
       
        
        
        return view('client.businessServices',['businessServices'=>$businessServices,'parentCategories'=>$parentCategories,'childCategories'=>$childCategories]);
    }
    
    public function categories(Request $request,$slug)
    {
       
        $parentCategories = ParentCategory::get();
        $childCategories = ChildCategory::get();
        
        
        $businessServices= DB::table('parent_category')
        ->join('child_category','child_category.parent_category_id','=','parent_category.id')
        ->select('parent_category.*','child_category.*')
        ->where('parent_slug',$slug)
        ->groupBy('child_slug')
        ->get();
         $part_id= DB::table('parent_category')->where('parent_slug',$slug)->first();
   
   if($part_id->id){
        $keyword = DB::table('keyword')
             
            ->select('keyword.*','keyword.faqq1','keyword.faqa1','keyword.faqq2','keyword.faqa2','keyword.faqq3','keyword.faqa3','keyword.faqq4','keyword.faqa4','keyword.faqq5','keyword.faqa5','keyword.meta_title','keyword.meta_description','keyword.meta_keywords','keyword.top_description','keyword.bottom_description','keyword.ratingvalue','keyword.ratingcount')
            
            ->where('keyword.parent_category_id',$part_id->id)->get();
   }else{
       $keyword ="";
       
   }
     
        	$clientsList = DB::table('clients')
			->join('assigned_kwds','clients.id','=','assigned_kwds.client_id')
			->join('keyword','assigned_kwds.kw_id','=','keyword.id')
			->join('citylists','assigned_kwds.city_id','=','citylists.id')
			->leftJoin(DB::raw('(SELECT SUM(rating) AS rating,comment_client_ID,COUNT(comment_ID) AS comment_count FROM comments GROUP BY comment_client_ID) c'),'c.comment_client_ID','=','clients.id')			
			->select('clients.*','citylists.city','assigned_kwds.sold_on_position','c.rating','c.comment_count')
		//	->where('citylists.city','LIKE',"noida")
			//->where('clients.active_status','1')
			->where('assigned_kwds.parent_cat_id','=',$part_id->id)
			//->where('assigned_kwds.sold_on_position','!=','king')
			->orderby(DB::raw('(CASE `assigned_kwds`.`sold_on_position` WHEN \'platinum\' THEN 1 WHEN \'diamond\' THEN 2 WHEN \'FreeListing\' THEN 3 END)'),'asc')
		//	->orderby(DB::raw('(CASE `assigned_kwds`.`sold_on_position` WHEN \'platinum\' THEN 1 WHEN \'diamond\' THEN 2 END)'),'asc')
			//->orderby(DB::raw('(CASE `assigned_kwds`.`sold_on_position` WHEN \'premium\' THEN 1 WHEN \'platinum\' THEN 2 WHEN \'royal\' THEN 3 WHEN \'preferred\' THEN 4 END)'),'asc')
			->groupBy('client_id')			
			//->orderby(DB::raw('(CASE `clients`.`certified_status` WHEN \'1\' THEN 1 END)'),'DESC')		
			->get();
			
        
        
    //echo "<pre>";print_r($part_id);die;
        
        
        return view('client.category',['businessServices'=>$businessServices,'parentCategories'=>$parentCategories,'childCategories'=>$childCategories,'part_id'=>$part_id,'clientsList'=>$clientsList]);
    }
    
    
    
    public function child(Request $request,$child_slug)
    {
		
	 
		 
		$child_id= ChildCategory::where('child_slug',$child_slug)->first();
		$part_id= DB::table('parent_category')->where('id',$child_id->parent_category_id)->first();
        $childCategory= DB::table('child_category')
        ->join('keyword','keyword.child_category_id','=','child_category.id')
        ->select('child_category.*','keyword.*')
        ->where('child_slug',$child_slug)
        ->groupBy('keyword')
        ->get();
        
 
	 
		return view('client.child',['childCategory'=>$childCategory,'part_id'=>$part_id]);
    }
	
}
