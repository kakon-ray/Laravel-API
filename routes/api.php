<?php

use App\Http\Controllers\Api\User\UserAuthController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::post('user/login', [UserAuthController::class, 'userlogin']);
Route::post('user/registration', [UserAuthController::class, 'registration']);

Route::group( ['prefix' => 'user','middleware' => ['auth:user-api','scopes:user'] ],function(){
    // authenticated staff routes here 
    Route::get('details', [UserController::class, 'userdetails']);
 });





Route::post('admin/registration', [UserController::class, 'registration']);
Route::post('admin/login', [UserController::class, 'userlogin']);
Route::middleware(['auth:admin-api'])->group(function () {
    Route::get('admin/details', [UserController::class, 'userdetails']);
});