<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LeadBusinessController;
use App\Http\Controllers\Api\ProfileController;
Route::get('/token', [AuthController::class, 'refresh']);
Route::post('/login', [AuthController::class, 'login']);
 

Route::middleware('auth:sanctum')->group(function () {
Route::get('/business/dashboard', [LeadBusinessController::class, 'dashboard']);
Route::get('/business/enquiry', [LeadBusinessController::class, 'enquiry']);
Route::get('/business/profileInfo', [ProfileController::class, 'profileInfo']);
Route::post('/business/saveProfile', [ProfileController::class, 'saveProfile']);
Route::get('/business/profile-logo', [ProfileController::class, 'profileLogo']);
Route::post('/business/saveProfileLogo',[ProfileController::class, 'saveProfileLogo']);
Route::post('/business/profileLogo/logoDel',[ProfileController::class, 'logoDel']);
Route::post('/business/profileLogo/profilePicDel',[ProfileController::class, 'profilePicDel']);
});

 