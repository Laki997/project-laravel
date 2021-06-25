<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login',[AuthController::class,'login'])->middleware('guest:api');
Route::post('register',[AuthController::class,'register'])->middleware('guest:api');
Route::post('logout',[AuthController::class,'logout'])->middleware('auth:api');
Route::get('me',[AuthController::class,'me'])->middleware('auth:api');

Route::get('/galleries',[GalleryController::class,'index']);
Route::post('/galleries',[GalleryController::class,'store']);
Route::get('/galleries/{id}',[GalleryController::class,'show']);
Route::put('/galleries/{id}',[GalleryController::class,'update'])->middleware('auth:api');
Route::delete('/galleries/{id}',[GalleryController::class,'destroy'])->middleware('auth:api');

Route::get('/users/{id}',[UserController::class,'show'])->middleware('auth:api');

Route::post('/comments',[CommentsController::class,'store'])->middleware('auth:api');
Route::get('/galleries/{id}/comments',[CommentsController::class,'index']);
Route::delete('/comments/{id}',[CommentsController::class,'destroy'])->middleware('auth:api');
