<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
class AuthController extends Controller
{
   public function login(Request $request)
    {

      
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
           // 'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Client::where('email', $request->email)->first();
 
        if (!$user->active_status) {
            return response()->json(['status' => false, 'message' => 'User account is inactive',], 403);
        }
        // if (!$user || !Hash::check($request->password, $user->password)) {
        //     return response()->json(['status' => false, 'message' => 'Invalid credentials'], 401);
        // }

 

        // Generate new Sanctum token
        $token = $user->createToken('browser-extension')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token,
            'token_type' => 'Bearer',
           // 'expires_in' => auth()->factory()->getTTL()*60,
            'name' => $user->name,
        ]);
    }

 

    // Logout API
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['status'=>true,'message' => 'Logout successful']);
    }
	

    /**
     * Refresh a token.
     */
    public function refresh()
    {  
        return $this->respondWithToken(auth()->refresh());
    }
	
}
