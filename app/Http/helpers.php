<?php
/**
 * CONTAINS HELPER FUNCTIONS
 */
 
  
// SENDING SMS AND IT'S CONFIGURATION
// **********************************
function sendSMS($sendto, $message,$tempid=null){
	$username = 't1quickindiasms';
	$password = '42308595';
	$sender = 'CCAMPS';
	$sendto = $sendto;
	//	$tempid = $tempid;
	$tempid = '1707161786775524106';
	$message = str_replace(' ', '%20', $message);
//	$url = 'http://nimbusit.co.in/api/swsendSingle.asp';
	$url = 'http://nimbusit.co.in/api/swsend.asp';
//	$data = "username=$username&password=$password&sender=$sender&sendto=$sendto&message=$message&entityID=1701160344973814570";
 
		$data = "username=$username&password=$password&sender=$sender&sendto=$sendto&entityID=1701160344973814570&templateID=$tempid&message=$message";
 

	$objURL = curl_init($url);
	curl_setopt($objURL, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($objURL, CURLOPT_POST, 1);
	curl_setopt($objURL, CURLOPT_POSTFIELDS, $data);
	$retval = trim(curl_exec($objURL));
	curl_close($objURL);
	return $retval;
}
 
// SENDING SMS AND IT'S CONFIGURATION
// **********************************
function sendSMSoldd($sendto, $message){
	$username = 't1quickindiasms';
	$password = '42308595';
	$sender = 'LEADEG';
	$sendto = $sendto;
	$message = str_replace(' ', '%20', $message);
	//$url = 'http://nimbusit.co.in/api/swsendSingle.asp';
	 $url = 'http://nimbusit.co.in/api/swsend.asp';

	$data = "username=$username&password=$password&sender=$sender&sendto=$sendto&message=$message";

	$objURL = curl_init($url);
	curl_setopt($objURL, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($objURL, CURLOPT_POST, 1);
	curl_setopt($objURL, CURLOPT_POSTFIELDS, $data);
	$retval = trim(curl_exec($objURL));
	curl_close($objURL);
}

// SLUG GENERATOR FOR CLIENTS
// **************************
function generate_slug($slug=null){
	if(is_null($slug)){
		return null;
	}
	$slug = explode(" ",$slug);
	$slug = array_map('trim',$slug);
	$slug = array_map('remove_splchars',$slug);
	$slug = array_map('strtolower',$slug);
	$slug = implode("-",$slug);
	return $slug;
}

// INVERSE SLUG GENERATOR FOR CLIENTS
// **********************************
function inverse_generate_slug($slug=null){
	if(is_null($slug)){
		return null;
	}
	$slug = preg_replace('/--/','-&-',$slug);
	$slug = preg_replace('/-/',' ',$slug);
	return $slug;
}




function getCity(){
   return $cities = App\Models\City::get();
}


function get_time($time) {
 
        $start_date = date('Y-m-d H:i:s');
     
        $diff = abs(strtotime($start_date) - $time);
        
        $totalyear = floor($diff / (365*60*60*24));
        $totalmonths = floor(($diff - $totalyear * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $totalyear * 365*60*60*24 - $totalmonths*30*60*60*24)/ (60*60*24));
        
        
        
    $create_time = $time;
    $current_time = time();
    $dtCurrent = DateTime::createFromFormat('U', $current_time);
    $dtCreate = DateTime::createFromFormat('U', $create_time);
    $diff = $dtCurrent->diff($dtCreate);
     
    if($days <1 && $totalmonths==0){
         $interval = $diff->format("%h hrs %i minutes");
        $interval = preg_replace('/(^0| 0) (hrs|minutes)/', '', $interval);
        
    }else if($days>0 && $totalmonths==0){
        $interval = $diff->format("%d days %h hrs");
        $interval = preg_replace('/(^0| 0) (days|hrs)/', '', $interval);
    }else if($totalmonths>0 && $days>1 && $totalyear =='0' ){
        
         $interval = $diff->format("%m months %d days");
         $interval = preg_replace('/(^0| 0) (months|days)/', '', $interval);
         
       }else if($totalmonths >=12 && $totalyear>0){
         $interval = $diff->format("%y years %m months");
         $interval = preg_replace('/(^0| 0) (years|months)/', '', $interval);
       }else{
          
          $interval = $diff->format("%h hours %i minutes");
        $interval = preg_replace('/(^0| 0) (hours|minutes)/', '', $interval);
    }
   
    echo $interval;
        
        
        
}
// SPECIAL CHARACTERS REMOVER
// **************************
function remove_splchars($str){
	return preg_replace("/[^a-zA-Z0-9-.]/", "", $str);
}

// FOLDER STRUCTURE GENERATOR
// **************************
function getFolderBlogStructure(){
	try{
		$partial_str = '';
		$day = date('j');
		$week = '';
		if($day<11){
			$week = 'week_1';
		}
		else if($day>=11&&$day<21){
			$week = 'week_2';
		}
		else if($day>=21){
			$week = 'week_3';
		}
		$partial_str = 'uploads/images/'.date('Y').'/'.date('m').'/'.$week;
		$structure = public_path($partial_str);
		if(file_exists($structure)){
			return $partial_str;
		}else{
			if(mkdir($structure, 0755, true)){
				return $partial_str;
			}else{
				throw new Exception("Folder structure not found.\nUnable to create folder structure.");
			}
		}
	}catch(Exception $e){
		return $e->getMessage();
	}
}


function getFolderCourseStructure(){
	try{
		$partial_str = '';
		$day = date('j');
		$week = '';
		if($day<11){
			$week = 'week_1';
		}
		else if($day>=11&&$day<21){
			$week = 'week_2';
		}
		else if($day>=21){
			$week = 'week_3';
		}
		$partial_str = 'upload/crs/'.date('Y').'/'.date('m').'/'.$week;
		$structure = public_path($partial_str);
		if(file_exists($structure)){
			return $partial_str;
		}else{
			if(mkdir($structure, 0755, true)){
				return $partial_str;
			}else{
				throw new Exception("Folder structure not found.\nUnable to create folder structure.");
			}
		}
	}catch(Exception $e){
		return $e->getMessage();
	}
}


function getFolderCategoryStructure(){
	try{
		$partial_str = '';
		$day = date('j');
		$week = '';
		if($day<11){
			$week = 'week_1';
		}
		else if($day>=11&&$day<21){
			$week = 'week_2';
		}
		else if($day>=21){
			$week = 'week_3';
		}
		$partial_str = 'uploads/category/'.date('Y').'/'.date('m').'/'.$week;
		$structure = public_path($partial_str);
		if(file_exists($structure)){
			return $partial_str;
		}else{
			if(mkdir($structure, 0755, true)){
				return $partial_str;
			}else{
				throw new Exception("Folder structure not found.\nUnable to create folder structure.");
			}
		}
	}catch(Exception $e){
		return $e->getMessage();
	}
}

function getFolderStructure(){
	try{
		$partial_str = '';
		$day = date('j');
		$week = '';
		if($day<11){
			$week = 'week_1';
		}
		else if($day>=11&&$day<21){
			$week = 'week_2';
		}
		else if($day>=21){
			$week = 'week_3';
		}
		$partial_str = 'uploads/images/'.date('Y').'/'.date('m').'/'.$week;
		$structure = public_path($partial_str);
		if(file_exists($structure)){
			return $partial_str;
		}else{
			if(mkdir($structure, 0755, true)){
				return $partial_str;
			}else{
				throw new Exception("Folder structure not found.\nUnable to create folder structure.");
			}
		}
	}catch(Exception $e){
		return $e->getMessage();
	}
}




// SUBSTRING GETTER
// ****************
function getAddress($arr,$len){
	$response = [];
	$response['fullstr'] = $response['substr'] = '';
	$response['isfullstr'] = $response['issubstr'] = 0;
	$response['ispositiveresponse'] = 0;
	$str = '';
	if(!empty($arr)){
		$str = implode(", ",$arr);
		$response['ispositiveresponse'] = 1;
		if(strlen($str)>$len){
			$response['fullstr'] = $str;
			$response['isfullstr'] = 1;
			$response['substr'] = substr($str,0,($len-1))."...";
			$response['issubstr'] = 1;
		}else{
			$response['fullstr'] = $str;
			$response['isfullstr'] = 1;
		}
	}
	// returning response object not an array
	return json_decode(json_encode($response), FALSE);
}

// STAR CODED STRING GETTER
// ************************
function getStarCodedStr($str,$type=NULL){
	if(empty($str))
		return NULL;
	if($type=='number'){
		$strArr = str_split($str,1);
		$strLen = count($strArr);
		$strToReturn = [];
		for($i=0;$i<$strLen;++$i){
			if($i<2){
				$strToReturn[] = $strArr[$i];
			}
			else if($i>=2 && $i<=($strLen-3)){
				$strToReturn[] = '*';
			}
			else if($i>($strLen-3)){
				$strToReturn[] = $strArr[$i];
			}
		}
		$strToReturn = implode($strToReturn);
	}
	else if($type=='email'){
		$strExpl = explode('@',$str);
		$strArr = str_split($strExpl[0],1);
		$strLen = count($strArr);
		$strToReturn = [];
		for($i=0;$i<$strLen;++$i){
			if($i<1){
				$strToReturn[] = $strArr[$i];
			}
			else if($i>=1 && $i<=($strLen-2)){
				$strToReturn[] = '*';
			}
			else if($i>($strLen-2)){
				$strToReturn[] = $strArr[$i];
			}
		}
		$strToReturn = implode($strToReturn);
		if(preg_match("/@/", $str)){
			$strToReturn .= "@".$strExpl[1];	
		}
	}
	return $strToReturn;
}

// RETURN STATE/UNION TERROTERIES LIST
// ***********************************
function getStates(){
	return ['-- Select State --','Andhra Pradesh','Arunachal Pradesh','Assam','Andaman and Nicobar Islands','Bihar','Chandigarh','Chhattisgarh','Dadra and Nagar Haveli','Daman and Diu','Delhi','Goa','Gujarat','Haryana','Himachal Pradesh','Jammu & Kashmir','Jharkhand','Karnataka','Kerala','Lakshadweep','Madhya Pradesh','Maharashtra','Manipur','Meghalaya','Mizoram','Nagaland','Orissa','Pondicherry','Punjab','Rajasthan','Sikkim','Tamil Nadu','Telangana','Tripura','Uttar Pradesh','Uttarakhand','West Bengal'];
}

// RETURN CLIENTS TYPE
// *******************
/* function getClientsType(){
	return [
		'general'=>'General',
		'lead_based'=>'Lead Based',
		'yearly_subscription'=>'Yearly Subscription',
		'free_subscription'=>'Free Subscription (2 Month)',
		'count_based_subscription'=>'Count Based Subscription'
	];
} */


function getClientsType(){
	return [
		''=>'Select Package Name',
		'Gold'=>'Gold',
		'Diamond'=>'Diamond',
		'Platinum'=>'Platinum'
		 
	];
}

function getClientsList(){	 
	$getClientsList = App\Models\Client\Client::where('paid_status',1)->select('id','business_name')->orderby('business_name', 'asc')->get();
	return  $getClientsList;
}



function getUserList(){	 
	$getUserList = App\Models\User::select('id','first_name','last_name')->orderby('first_name','asc')->get();
	return  $getUserList;
}

function getClientsConversionList(){	 
	$getClientsConversionList = App\Models\client\Client::where('conversion_status',1)->select('id','business_name')->orderby('business_name', 'asc')->get();
	return  $getClientsConversionList;
}


 

function leadFilterstatus(){	 
	$leadFilterstatus = App\Models\Status::where('lead_filter',1)->orderby('name', 'asc')->get();
	return  $leadFilterstatus;
}

function leadFollowStatus(){	 
	$leadFollowStatus = App\Models\Status::where('lead_follow_up',1)->orderby('name', 'asc')->get();
	return  $leadFollowStatus;
}

function clientFollowStatus(){	 
	$clientFollowStatus = App\Models\Status::where('client_follow_up',1)->orderby('name', 'asc')->get();
	return  $clientFollowStatus;
}

// RETURN PROPER WEBSITE URL
// *************************
function buildWebsiteURL($link=null){
	if(null==$link)
		return null;
	
    if (!preg_match("~^(?:f|ht)tps?://~i", $link)) {
        $link = "http://".$link;
    }
	return $link;
}

/**
 * Limit the number of characters in a string.
 *
 * @param  string  $value
 * @param  int     $limit
 * @param  string  $end
 * @return string
 */
function str_limit_custom($value, $limit = 100, $end = '...', $more = 'More', $target = 'myModal')
{
	if (mb_strlen($value) <= $limit) return $value;
	return rtrim(mb_substr($value, 0, $limit, 'UTF-8')).$end." <a href='#' data-toggle='modal' data-target='#".$target."'>".$more."</a>";
}



 
  