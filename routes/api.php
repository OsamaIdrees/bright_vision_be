<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImportantNews;
use App\Http\Controllers\UserRightController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login',[LoginController::class,'login']);
Route::get('get-staff-user',[LoginController::class,'getStaffUser']);
Route::post('add-news',[ImportantNews::class,'ImportantNews']);
Route::get('get-news',[ImportantNews::class,'GetImportantNews']);
Route::post('delete-news',[ImportantNews::class,'DeleteNews']);
Route::post('update-news',[ImportantNews::class,'UpdateNews']);
Route::post('particular-news',[ImportantNews::class,'getParticularNews']);
Route::post('set-news-number',[ImportantNews::class,'setNewsNumber']);
Route::get('get-news-number',[ImportantNews::class,'getNewsNumber']);
Route::post('user-right',[UserRightController::class,'UserRight']);
Route::post('get-all-info',[UserRightController::class,'getAllRequiredStaffInfo']);
Route::post('set-right',[UserRightController::class,'RightControl']);
