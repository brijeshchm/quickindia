<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Models\Client\Client;
use DB;
use Log;
use Validator;
use function PHPUnit\Framework\isFalse;
class ProfileController extends Controller
{ 
    public function profileInfo(Request $request)
    {
        try {
 
                if (!Auth::guard('sanctum')->check()) {
                    return response()->json([
                    'status' => false,
                    'message' => 'Unauthenticated: Token is missing or invalid',
                    'error' => 'token_missing_or_invalid'
                    ], 401);
                }
                
                      // Check if user is active

	            $user = auth('sanctum')->user();
                if (!$user) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Unauthenticated: Token is missing or invalid',
                        'error' => 'token_missing_or_invalid'
                        ], 401);
                }

                if (!$user->active_status) {
                $user->tokens()->delete();
                return response()->json(['status' => false, 'message' => 'User account is inactive',], 403);
                }

                $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
                $times = ["24:00"=>"Open 24 Hrs","00:00"=>"00:00","00:30"=>"00:30","01:00"=>"01:00","01:30"=>"01:30","02:00"=>"02:00","02:30"=>"02:30","03:00"=>"03:00","03:30"=>"03:30","04:00"=>"04:00","04:30"=>"04:30","05:00"=>"05:00","05:30"=>"05:30","06:00"=>"06:00","06:30"=>"06:30","07:00"=>"07:00","07:30"=>"07:30","08:00"=>"08:00","08:30"=>"08:30","09:00"=>"09:00","09:30"=>"09:30","10:00"=>"10:00","10:30"=>"10:30","11:00"=>"11:00","11:30"=>"11:30","12:00"=>"12:00","12:30"=>"12:30","13:00"=>"13:00","13:30"=>"13:30","14:00"=>"14:00","14:30"=>"14:30","15:00"=>"15:00","15:30"=>"15:30","16:00"=>"16:00","16:30"=>"16:30","17:00"=>"17:00","17:30"=>"17:30","18:00"=>"18:00","18:30"=>"18:30","19:00"=>"19:00","19:30"=>"19:30","20:00"=>"20:00","20:30"=>"20:30","21:00"=>"21:00","21:30"=>"21:30","22:00"=>"22:00","22:30"=>"22:30","23:00"=>"23:00","23:30"=>"23:30",""=>"Closed"];
                if(!empty($user->time)){
                    $time = unserialize($user->time);
                }else{
                    $time = "null";
                }
                if(!empty($user->certifications)){
                    $certifications = unserialize($user->certifications);
                }else{
                    $certifications = "null";
                }
                if(!empty($user->profile_pic)){
                    $profile_pic = unserialize($user->profile_pic);
                }else{
                    $profile_pic = "null";
                }
                if(!empty($user->pictures)){
                    $pictures = unserialize($user->pictures);
                }else{
                    $pictures = "null";
                }

                $data['userDetails'] = array(		
                    'client_id' =>$user->id, 
                    'username' =>$user->username, 
                    'business_slug' =>$user->business_slug,
                    'business_name' =>$user->business_name,					
                    'business_intro' =>$user->business_intro,					  
                    'first_name' =>$user->first_name,					  
                    'last_name' =>$user->last_name,					  
                    'email' =>$user->email,					  
                    'mobile' =>$user->mobile,					  
                    'client_type' =>$user->client_type,					  
                    'balance_amt' =>$user->balance_amt,					
                    'coins_amt' =>$user->coins_amt,					
                    'leads_remaining' =>$user->leads_remaining,					
                    'expired_from' =>$user->expired_from,					
                    'expired_on' =>$user->expired_on,					
                    'certified_status' =>$user->certified_status,					
                    'city_id' =>$user->city_id,					
                    'city' =>$user->city,					
                    'address' =>$user->address,					
                    'landmark' =>$user->landmark,					
                    'state' =>$user->state,					
                    'country' =>$user->country,					
                    'time' =>$time,					
                    'days' =>$days,					
                    'times' =>$times,					
                    'certifications' =>$certifications,					
                    'year_of_estb' =>$user->year_of_estb,					
                    'profile_pic' =>$profile_pic,					
                    'pictures' =>$pictures,					
                    'active_status' =>$user->active_status,					
                    ); 
 
            return response()->json([
                'success' => true,
                'data' => $data,
            ], 200);

       } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve users: ' . $e->getMessage(),
            ], 500);
        }
    } 

    public function saveProfile(Request $request)
    { 
        try {
 
                if (!Auth::guard('sanctum')->check()) {
                    return response()->json([
                    'status' => false,
                    'message' => 'Unauthenticated: Token is missing or invalid',
                    'error' => 'token_missing_or_invalid'
                    ], 401);
                }
  
	            $user = auth('sanctum')->user();
                if (!$user) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Unauthenticated: Token is missing or invalid',
                        'error' => 'token_missing_or_invalid'
                        ], 401);
                }

              $validator = Validator::make($request->all(),[	
			    'email' 	=> 'required|max:255|unique:clients,email,'.$user->id.',id',			
			    'year_of_estb' 	=> 'required',			
					 
					
			]);
			
			if($validator->fails()){
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}	

	        $user = Client::find($user->id);		 
			$user->display_hofo = $request->input('display_hofo');
			$user->business_intro = $request->input('business_intro');
			//$user->time = (null!==$request->input('time'))?serialize($request->input('time')):"";
		 
			$user->year_of_estb = $request->input('year_of_estb');
			$user->certifications = (!empty($request->input('certifications')))?serialize(explode(',',$request->input('certifications'))):"";
				 
		 
			if($user->save()){
				 
                $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
                $times = ["24:00"=>"Open 24 Hrs","00:00"=>"00:00","00:30"=>"00:30","01:00"=>"01:00","01:30"=>"01:30","02:00"=>"02:00","02:30"=>"02:30","03:00"=>"03:00","03:30"=>"03:30","04:00"=>"04:00","04:30"=>"04:30","05:00"=>"05:00","05:30"=>"05:30","06:00"=>"06:00","06:30"=>"06:30","07:00"=>"07:00","07:30"=>"07:30","08:00"=>"08:00","08:30"=>"08:30","09:00"=>"09:00","09:30"=>"09:30","10:00"=>"10:00","10:30"=>"10:30","11:00"=>"11:00","11:30"=>"11:30","12:00"=>"12:00","12:30"=>"12:30","13:00"=>"13:00","13:30"=>"13:30","14:00"=>"14:00","14:30"=>"14:30","15:00"=>"15:00","15:30"=>"15:30","16:00"=>"16:00","16:30"=>"16:30","17:00"=>"17:00","17:30"=>"17:30","18:00"=>"18:00","18:30"=>"18:30","19:00"=>"19:00","19:30"=>"19:30","20:00"=>"20:00","20:30"=>"20:30","21:00"=>"21:00","21:30"=>"21:30","22:00"=>"22:00","22:30"=>"22:30","23:00"=>"23:00","23:30"=>"23:30",""=>"Closed"];
                if(!empty($user->time)){
                    $time = unserialize($user->time);
                }else{
                    $time = "null";
                }
                if(!empty($user->certifications)){
                    $certifications = unserialize($user->certifications);
                }else{
                    $certifications = "null";
                }
                if(!empty($user->profile_pic)){
                    $profile_pic = unserialize($user->profile_pic);
                }else{
                    $profile_pic = "null";
                }
                if(!empty($user->pictures)){
                    $pictures = unserialize($user->pictures);
                }else{
                    $pictures = "null";
                }
                $data['userDetails'] = array(
                    'client_id' =>$user->id, 
                    'username' =>$user->username, 
                    'business_slug' =>$user->business_slug,
                    'business_name' =>$user->business_name,					
                    'business_intro' =>$user->business_intro,					  
                    'first_name' =>$user->first_name,					  
                    'last_name' =>$user->last_name,					  
                    'email' =>$user->email,					  
                    'mobile' =>$user->mobile,					  
                    'client_type' =>$user->client_type,					  
                    'balance_amt' =>$user->balance_amt,					
                    'coins_amt' =>$user->coins_amt,					
                    'leads_remaining' =>$user->leads_remaining,					
                    'expired_from' =>$user->expired_from,					
                    'expired_on' =>$user->expired_on,					
                    'certified_status' =>$user->certified_status,					
                    'city_id' =>$user->city_id,					
                    'city' =>$user->city,					
                    'address' =>$user->address,					
                    'landmark' =>$user->landmark,					
                    'state' =>$user->state,					
                    'country' =>$user->country,					
                    'time' =>$time,					
                    'days' =>$days,					
                    'times' =>$times,					
                    'certifications' =>$certifications,					
                    'year_of_estb' =>$user->year_of_estb,					
                    'profile_pic' =>$profile_pic,					
                    'pictures' =>$pictures,
                    'active_status' =>$user->active_status,
                    ); 
 
				$msg = "Profile updated successfully!";
				return response()->json(['status'=>true,'data'=>$data,'message'=>$msg],200);
			}
			
			else{
				return response()->json(['status'=>0,'data'=>'','message'=>'Profile not successfully update'],400);
			}


                 

       } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve users: ' . $e->getMessage(),
            ], 500);
        }
    } 
    public function profileLogo(Request $request)
    {
        try {
 
                if (!Auth::guard('sanctum')->check()) {
                    return response()->json([
                    'status' => false,
                    'message' => 'Unauthenticated: Token is missing or invalid',
                    'error' => 'token_missing_or_invalid'
                    ], 401);
                }
                
                      // Check if user is active

	            $user = auth('sanctum')->user();
                if (!$user) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Unauthenticated: Token is missing or invalid',
                        'error' => 'token_missing_or_invalid'
                        ], 401);
                }

                if (!$user->active_status) {
                $user->tokens()->delete();
                return response()->json(['status' => false, 'message' => 'User account is inactive',], 403);
                }

                  
                if(!empty($user->profile_pic)){
                    $profile_pic = unserialize($user->profile_pic);
                }else{
                    $profile_pic = "null";
                }
                if(!empty($user->logo)){
                    $logo = unserialize($user->logo);
                }else{
                    $logo = "null";
                }

                $data['userDetails'] = array(		
                    'client_id' =>$user->id, 
                    'username' =>$user->username, 
                    'business_slug' =>$user->business_slug,                    				
                    'profile_pic' =>$profile_pic,					
                    'logo' =>$logo,					
                    'active_status' =>$user->active_status,					
                    ); 
 
            return response()->json([
                'success' => true,
                'data' => $data,
            ], 200);

       } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve users: ' . $e->getMessage(),
            ], 500);
        }
    } 

    public function saveProfileLogo(Request $request)
    { 
        try {
 
                if (!Auth::guard('sanctum')->check()) {
                    return response()->json([
                    'status' => false,
                    'message' => 'Unauthenticated: Token is missing or invalid',
                    'error' => 'token_missing_or_invalid'
                    ], 401);
                }
  
	            $user = auth('sanctum')->user();
                if (!$user) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Unauthenticated: Token is missing or invalid',
                        'error' => 'token_missing_or_invalid'
                        ], 401);
                }

              $validator = Validator::make($request->all(),[	
			    'logo' => 'mimes:jpeg,jpg,png|max:2048',
			    'profile_pic' => 'mimes:jpeg,jpg,png|max:2048|dimensions:min_width=1137,min_height=319'
					 
					
			]);
			
			if($validator->fails()){
				$errorsBag = $validator->getMessageBag()->toArray();
				return response()->json(['status'=>1,'errors'=>$errorsBag],400);
			}	

	        $user = Client::find($user->id);
			if ($request->file('logo')) {
				$image = [];
				$filePath = getFolderStructure();
				$file =  $request->file('logo');
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
				$user->logo = serialize($image);
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
				 
			 
				$user->profile_pic = serialize($image);
			}
	 
		 
			if($user->save()){
                
                if(!empty($user->profile_pic)){
                    $profile_pic = unserialize($user->profile_pic);
                }else{
                    $profile_pic = "null";
                }
                if(!empty($user->logo)){
                    $logo = unserialize($user->logo);
                }else{
                    $logo = "null";
                }
                $data['userDetails'] = array(
                    'client_id' =>$user->id, 
                    'username' =>$user->username, 
                    'business_slug' =>$user->business_slug,
                    'business_name' =>$user->business_name,	             					
                    'profile_pic' =>$profile_pic,					
                    'logo' =>$logo,
                    'active_status' =>$user->active_status,
                    ); 
 
				$msg = "Profile logo successfully!";
				return response()->json(['status'=>true,'data'=>$data,'message'=>$msg],200);
			}
			
			else{
				return response()->json(['status'=>0,'data'=>'','message'=>'Profile not successfully update'],400);
			}


                 

       } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve users: ' . $e->getMessage(),
            ], 500);
        }
    } 
    public function logoDel(Request $request)
    {
        try {
 
                if (!Auth::guard('sanctum')->check()) {
                    return response()->json([
                    'status' => false,
                    'message' => 'Unauthenticated: Token is missing or invalid',
                    'error' => 'token_missing_or_invalid'
                    ], 401);
                }
                
                      // Check if user is active

	            $user = auth('sanctum')->user();
                if (!$user) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Unauthenticated: Token is missing or invalid',
                        'error' => 'token_missing_or_invalid'
                        ], 401);
                }

                if (!$user->active_status) {
                $user->tokens()->delete();
                return response()->json(['status' => false, 'message' => 'User account is inactive',], 403);
                }
 

         $delet_data = Client::findOrFail($user->id); 
		 
    	 
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
		$del = Client::where('id',$user->id)->update($edit_data);	
        $user = Client::find($user->id);
        if(!empty($user->profile_pic)){
            $profile_pic = unserialize($user->profile_pic);
        }else{
            $profile_pic = "null";
        }
        if(!empty($user->logo)){
            $logo = unserialize($user->logo);
        }else{
            $logo = "null";
        }

        $data['userDetails'] = array(		
            'client_id' =>$user->id, 
            'username' =>$user->username, 
            'business_slug' =>$user->business_slug,                    			 
            'profile_pic' =>$profile_pic,
            'logo' =>$logo,
            'active_status' =>$user->active_status,
            ); 
 
            return response()->json([
                'success' => true,
                'data' => $data,
            ], 200);

       } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve users: ' . $e->getMessage(),
            ], 500);
        }
    } 
    public function profilePicDel(Request $request)
    {
        try {
 
                if (!Auth::guard('sanctum')->check()) {
                    return response()->json([
                    'status' => false,
                    'message' => 'Unauthenticated: Token is missing or invalid',
                    'error' => 'token_missing_or_invalid'
                    ], 401);
                }
                
                      // Check if user is active

	            $user = auth('sanctum')->user();
                if (!$user) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Unauthenticated: Token is missing or invalid',
                        'error' => 'token_missing_or_invalid'
                        ], 401);
                }

                if (!$user->active_status) {
                $user->tokens()->delete();
                return response()->json(['status' => false, 'message' => 'User account is inactive',], 403);
                }
 

         $delet_data = Client::findOrFail($user->id); 
		 
    	 
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
 
		$edit_data = array('profile_pic'  =>"",);
		$del = Client::where('id',$user->id)->update($edit_data);	
        $user = Client::find($user->id);
        if(!empty($user->profile_pic)){
            $profile_pic = unserialize($user->profile_pic);
        }else{
            $profile_pic = "null";
        }
        if(!empty($user->logo)){
            $logo = unserialize($user->logo);
        }else{
            $logo = "null";
        }

        $data['userDetails'] = array(		
            'client_id' =>$user->id, 
            'username' =>$user->username, 
            'business_slug' =>$user->business_slug,                    				 
            'profile_pic' =>$profile_pic,
            'logo' =>$logo,
            'active_status' =>$user->active_status,
            ); 
 
            return response()->json([
                'success' => true,
                'data' => $data,
            ], 200);

       } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve users: ' . $e->getMessage(),
            ], 500);
        }
    } 



}
