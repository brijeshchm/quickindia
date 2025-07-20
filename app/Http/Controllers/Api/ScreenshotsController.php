<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\Screenshot;
use App\Models\WorkingSession;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\PopupCode;
use App\Models\Client;
use App\Mail\ResponseCodeMail; 
use DB;
use Mail;
class ScreenshotsController extends Controller
{
    public function uploadScreenshotView(Request $request)
    {       
        /*
        form-data 
        1.key:email, value:emailid
        1.key:image, value:type file        
        */
        try{
            $user = $request->user();       
            if (!$user->is_active) {
                $user->tokens()->delete();
                return response()->json(['status' => 'error', 'message' => 'User account is inactive',], 403);
            }
    
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'image' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $projects = $user->projects()
            ->where('projects.is_active', true)
            ->whereHas('client', function ($query) use ($user) {
                $query->where('is_active', true)
                    ->where('company_id', $user->company_id);
            })
            ->with(['client' => function ($query) {
                $query->select('id', 'name');
            }])
            ->select('projects.id', 'projects.name', 'projects.client_id')
            ->first();
      
            $image ="";
            if ($request->hasFile('image')) {
                $employeeName = Str::slug($user->name);
                $employeeId = $user->id;
                $folder = "documents/company/{$employeeName}_{$employeeId}/project/{$employeeName}";
                $image = Helper::uploadImage($folder, $request->file('image'));
            }
    
            $screenshot =   Screenshot::create([
                'user_id' => $user->id,
                'company_id' => $user->company_id,
                'project_id' => $projects->id,
                'client_id' => $projects->client_id,
                'path' => $image,
                'taken_at'=>now()
                
            ]);
          
            return response()->json([
                'success' => true,
                'message' => 'Documents updated successfully.',
                'data' => $screenshot
            ]);
        
        }  catch (\Exception $e) {
                Log::error('Error updating documents: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' =>$e->getMessage(),
                ]);
        }
    }
    public function startTracker(Request $request)
    {       
        try{
                /*
                form-data 
                1.key:email, value:email-id                  
                */
                $user = $request->user();       
                if (!$user->is_active) {
                    $user->tokens()->delete();
                    return response()->json(['status' => 'error', 'message' => 'User account is inactive',], 403);
                }
        
                $validator = Validator::make($request->all(), [
                    'email' => 'required',                    
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
 
                $projects = $user->projects()
            ->where('projects.is_active', true)
            ->whereHas('client', function ($query) use ($user) {
                $query->where('is_active', true)
                    ->where('company_id', $user->company_id);
            })
            ->with(['client' => function ($query) {
                $query->select('id', 'name');
            }])
            ->select('projects.id', 'projects.name', 'projects.client_id')
            ->first();
 
                $workingSession =  WorkingSession::where('user_id',$user->id)->where('company_id',$user->company_id)->where('client_id',$projects->client_id)->whereDate('start_time', today())->whereNull('stop_time')->first();
               
                if (!$workingSession) {
                    $screenshot =   WorkingSession::create([
                        'user_id' => $user->id,
                        'company_id' => $user->company_id,
                        'project_id' => $projects->id,
                        'client_id' => $projects->client_id,
                        'start_time'=>now(),                    
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Tracker has been start.',
                        'data' => $screenshot
                    ]);
                }else{
                    return response()->json([
                    'success' => true,
                    'message' => 'Already start tracker.',
                    'data' => null
                    ]);
                }
          
           
        
        }  catch (\Exception $e) {
                Log::error('Error updating documents: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' =>$e->getMessage(),
                ]);
            }
    }
    public function stopTracker(Request $request)
    {       
        try{
            /*
            form-data 
            1.key:email, value:email-id                  
            */
                $user = $request->user();       
                if (!$user->is_active) {
                    $user->tokens()->delete();
                    return response()->json(['status' => 'error', 'message' => 'User account is inactive',], 403);
                }
        
                $validator = Validator::make($request->all(), [
                    'email' => 'required',                    
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
 
                $projects = $user->projects()
            ->where('projects.is_active', true)
            ->whereHas('client', function ($query) use ($user) {
                $query->where('is_active', true)
                    ->where('company_id', $user->company_id);
            })
            ->with(['client' => function ($query) {
                $query->select('id', 'name');
            }])
            ->select('projects.id', 'projects.name', 'projects.client_id')
            ->first();
 
                $workingSession =  WorkingSession::where('user_id',$user->id)->where('company_id',$user->company_id)->where('client_id',$projects->client_id)->whereDate('start_time', today())->whereNull('stop_time')->first();
               
                if($workingSession){
                $start = Carbon::parse($workingSession->start_time);
                $end = Carbon::parse(now());
                $diff = $start->diff($end);
                $hours = $diff->h;
                $minutes = $diff->i;
                $duration = $hours.'.'.$minutes;

     
                $screenshot =   WorkingSession::findOrFail($workingSession->id);
 
                    $screenshot->user_id = $user->id;
                    $screenshot->company_id = $user->company_id;
                    $screenshot->project_id = $projects->id;
                    $screenshot->client_id = $projects->client_id;
                    $screenshot->stop_time =now();                  
                    $screenshot->duration =   $duration;            
                    $screenshot->save();

                return response()->json([
                'success' => true,
                'message' => 'Your tracker has been stop.',
                'data' => $screenshot
            ]);
                }else{

                return response()->json([
                'success' => true,
                'message' => 'Already stop tracker.',
                'data' => null
            ]);
                }
          
           
        
        }  catch (\Exception $e) {
                Log::error('Error updating documents: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' =>$e->getMessage(),
                ]);
            }
    }

    public function submitCode(Request $request)
    {
        try{
                /*
                form-data 
                1.key:email, value:email-id
                */
                $user = $request->user();
                if (!$user->is_active) {
                    $user->tokens()->delete();
                    return response()->json(['status' => 'error', 'message' => 'User account is inactive',], 403);
                }
        
                $validator = Validator::make($request->all(), [
                    'email' => 'required',
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
 
                $projects = $user->projects()
            ->where('projects.is_active', true)
            ->whereHas('client', function ($query) use ($user) {
                $query->where('is_active', true)
                    ->where('company_id', $user->company_id);
            })
            ->with(['client' => function ($query) {
                $query->select('id', 'name');
            }])
            ->select('projects.id', 'projects.name', 'projects.client_id')
            ->first();
   
                $popupCode =  PopupCode::where('user_id',$user->id)->where('company_id',$user->company_id)->where('client_id',$projects->client_id)->whereDate('shown_at', today())->whereNull('submitted_at')->first();
               
                if(!$popupCode){
                $popupCode =   PopupCode::create([
                    'user_id' => $user->id,
                    'company_id' => $user->company_id,
                    'project_id' => $projects->id,
                    'client_id' => $projects->client_id,
                    'shown_at'=>now(),
                ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'submit code.',
                        'data' => $popupCode
                    ]);
                }else{

                    return response()->json([
                        'success' => true,
                        'message' => 'Already send code popup.',
                        'data' => null
                    ]);
                }
          
           
        
        }  catch (\Exception $e) {
                Log::error('Error updating documents: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' =>$e->getMessage(),
                ]);
            }
    }

    public function responseSubmitCode(Request $request)
    {
        try{
            /*
            form-data 
            1.key:email, value:email-id
            */
                $user = $request->user();
                if (!$user->is_active) {
                    $user->tokens()->delete();
                    return response()->json(['status' => 'error', 'message' => 'User account is inactive',], 403);
                }
        
                $validator = Validator::make($request->all(), [
                    'email' => 'required',
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
 
                $projects = $user->projects()
                ->where('projects.is_active', true)
                ->whereHas('client', function ($query) use ($user) {
                $query->where('is_active', true)
                ->where('company_id', $user->company_id);
                })
                ->with(['client' => function ($query) {
                $query->select('id', 'name','email');
                }])
                ->select('projects.id', 'projects.name', 'projects.client_id')
                ->first();
              
                $popupCode =  PopupCode::where('user_id',$user->id)->where('company_id',$user->company_id)->where('client_id',$projects->client_id)->whereDate('shown_at', today())->whereNull('submitted_at')->first();
               
               $client = Client::where('id',$projects->client_id)->first();
                if ($popupCode) {
                    $start = Carbon::parse($popupCode->shown_at);
                    $end = Carbon::parse(now());
                    $diff = $start->diff($end);
                    $hours = $diff->h;
                    $minutes = $diff->i;
                    $duration = $hours.'.'.$minutes;

     
                    $popup =   PopupCode::findOrFail($popupCode->id);
                    $popup->user_id = $user->id;
                    $popup->company_id = $user->company_id;
                    $popup->project_id = $projects->id;
                    $popup->client_id = $projects->client_id;
                    $popup->submitted_at =now();
                    $popup->response_time =   $duration;
                    $popup->save();
                
                     Mail::to($user->email)->send(new ResponseCodeMail($user->name, $duration));
                     Mail::to($client->email)->send(new ResponseCodeMail($user->name, $duration));


                    return response()->json([
                        'success' => true,
                        'message' => 'Your response has been submit.',
                        'data' => $popup
                    ]);
                }else{

                    return response()->json([
                    'success' => true,
                    'message' => 'Already response has been submit.',
                    'data' => null
                    ]);
                }
          
           
        
        }  catch (\Exception $e) {
                Log::error('Error updating documents: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' =>$e->getMessage(),
                ]);
            }
    }
    public function updateStatus(Request $request)
    {
        try{
                /*
                form-data 
                1.key:email, value:email-id                  
                */
                $user = $request->user();       
                if (!$user->is_active) {
                    $user->tokens()->delete();
                    return response()->json(['status' => 'error', 'message' => 'User account is inactive',], 403);
                }
        
                $validator = Validator::make($request->all(), [
                    'email' => 'required',                    
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
 
                $projects = $user->projects()
            ->where('projects.is_active', true)
            ->whereHas('client', function ($query) use ($user) {
                $query->where('is_active', true)
                    ->where('company_id', $user->company_id);
            })
            ->with(['client' => function ($query) {
                $query->select('id', 'name');
            }])
            ->select('projects.id', 'projects.name', 'projects.client_id')
            ->first();
 
 
      
                $image ="";
                if ($request->hasFile('image')) {
                    $employeeName = Str::slug($user->name);
                    $employeeId = $user->id;
                    $folder = "documents/company/{$employeeName}_{$employeeId}/project/{$employeeName}";
                    $image = Helper::uploadImage($folder, $request->file('image'));
                }
                $workingSession =  WorkingSession::where('user_id',$user->id)->where('company_id',$user->company_id)->where('client_id',$projects->client_id)->whereDate('start_time', today())->whereNull('stop_time')->first();
               
                if(!$workingSession){
                $screenshot =   WorkingSession::create([
                    'user_id' => $user->id,
                    'company_id' => $user->company_id,
                    'project_id' => $projects->id,
                    'client_id' => $projects->client_id,
                    'start_time'=>now(),                    
                ]);

                return response()->json([
                'success' => true,
                'message' => 'Documents updated successfully.',
                'data' => $screenshot
            ]);
                }else{

                return response()->json([
                'success' => true,
                'message' => 'Already start tracker.',
                'data' => ''
            ]);
                }
          
           
        
        }  catch (\Exception $e) {
                Log::error('Error updating documents: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' =>$e->getMessage(),
                ]);
            }
    }

    public function totalWorkingHours(Request $request)
    {       
        try{
                /*
                form-data 
                1.key:email, value:email-id                  
                */
                $user = $request->user();       
                if (!$user->is_active) {
                    $user->tokens()->delete();
                    return response()->json(['status' => 'error', 'message' => 'User account is inactive',], 403);
                }
        
                $validator = Validator::make($request->all(), [
                    'email' => 'required',                    
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
                $employee = User::role('employee')
                ->where('id', $user->id)
                ->with('userProfile')
                ->with('rates')
                ->firstOrFail();
                $projects = $user->projects()               
                ->where('projects.is_active', true)
                ->whereHas('client', function ($query) use ($user) {
                $query->where('is_active', true)
                ->where('company_id', $user->company_id);
                })
                ->with(['client' => function ($query) {
                $query->select('id', 'name');
                }])
                ->select('projects.id', 'projects.name', 'projects.client_id')
                ->first();
               //  dd($employee->rates->hourly_rate);

                $userId = $user->id;
                $projectId = $projects->id;
                $companyId = $user->company_id;
                $clientId = $projects->client_id;  

                $today = Carbon::today();
                $startOfMonth = Carbon::now()->startOfMonth();
                $startOfYear = Carbon::now()->startOfYear();

                $result = WorkingSession::select(
                    'project_id',
                    DB::raw('SUM(CASE WHEN DATE(start_time) = CURDATE() THEN duration ELSE 0 END) AS total_hours_today'),
                    DB::raw('SUM(CASE WHEN start_time >= "' . $startOfMonth . '" THEN duration ELSE 0 END) AS total_hours_month'),
                    DB::raw('SUM(CASE WHEN start_time >= "' . $startOfYear . '" THEN duration ELSE 0 END) AS total_hours_year'),
                    DB::raw('SUM(duration) AS total_hours_ever'),
                    DB::raw('MIN(start_time) as first_session'),
                    DB::raw('MAX(stop_time) as last_session')
                )
                ->where('user_id', $userId)
                ->where('company_id', $companyId)
                ->whereNotNull('stop_time')
                ->when($projectId, function ($query) use ($projectId) {
                    $query->where('project_id', $projectId);
                })
                ->groupBy('project_id')
                ->first(); 

                $result_list = array(
                'hourly_rate' => $employee->rates->hourly_rate,
                'total_hours_today' => $result->total_hours_today,
                'total_hours_month' => $result->total_hours_month,
                'total_hours_year' => $result->total_hours_year,
                'total_hours_ever' => $result->total_hours_ever,
                );
                return response()->json([
                'success' => true,
                'message' => 'Hourly work.',
                'data' => $result_list
            ]);
                
          
           
        
        }  catch (\Exception $e) {
                Log::error('Error updating documents: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' =>$e->getMessage(),
                ]);
            }
    }
   
    public function sendMail(Request $request)
    {       
        try{
                /*
                form-data 
                1.key:email, value:email-id                  
                */
                $user = $request->user();       
                if (!$user->is_active) {
                    $user->tokens()->delete();
                    return response()->json(['status' => 'error', 'message' => 'User account is inactive',], 403);
                }
        
                $validator = Validator::make($request->all(), [
                    'email' => 'required',                    
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }             
           
            // Mail::to($user->email)->send(new ResponseCodeMail($user->name, $user->email));

            
        }  catch (\Exception $e) {
                Log::error('Error updating documents: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' =>$e->getMessage(),
                ]);
            }
    }
   
    public function settings(Request $request)
    {       
         $authHeader = $request->header('Authorization');
     dd($authHeader);
        $authHeader = $request->header('Authorization');
        if (!$authHeader || !preg_match('/^Bearer\s+\S+$/', $authHeader)) {            
      
        return response()->json([
                    'success' => false,
                    'message' =>'The Bearer token is required',
                ]);
            
        }
        try{
                /*
                form-data 
                1.key:email, value:email-id                  
                */
                $user = $request->user();       
                if (!$user->is_active) {
                    $user->tokens()->delete();
                    return response()->json(['status' => 'error', 'message' => 'User account is inactive',], 403);
                }
        
                $validator = Validator::make($request->all(), [
                    'email' => 'required',                    
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }             
           
            // Mail::to($user->email)->send(new ResponseCodeMail($user->name, $user->email));
            return response()->json([
                    'success' => false,
                    'message' =>'hello setting',
                ]);

        }  catch (\Exception $e) {
                Log::error('Error updating documents: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' =>$e->getMessage(),
                ]);
            }
    }

    
}
