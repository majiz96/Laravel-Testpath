<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\TeamsController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DocumentController;

Route::get('/posts',[PostController::class,'index']);
Route::get('/posts/{post}',[PostController::class,'show']);


Route::get('/teams',[TeamsController::class,'index']);
Route::get('/teams/{teams}',[TeamsController::class,'show']);

Route::middleware('auth:sanctum')->group(function(){

    Route::post('/posts',[PostController::class,'store']);
    Route::put('/posts/{post}',[PostController::class,'update']);
    Route::delete('/posts/{post}',[PostController::class,'destroy']);

    Route::post('/teams',[TeamsController::class,'store']);
    Route::put('/teams/{teams}',[TeamsController::class,'update']);
    Route::delete('/teams/{teams}',[TeamsController::class,'destroy']);

    Route::post('/logout',[AuthController::class,'logout'])->name('logout');

    Route::middleware('auth:sanctum')->get('/profile', function (Request $request) {
        return $request->user();
    });

    Route::put('documents/{document}',[DocumentController::class,'update']);

});


//Route::get('/Auth',[AuthController::class,'index'])->name('Auth.index');
Route::post('/register',[AuthController::class,'register'])->name('register');
Route::post('/login',[AuthController::class,'login'])->name('login');


