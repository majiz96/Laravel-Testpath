<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\TeamsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/hello',function(){
//    return 'Hello World'; WRONG

//    [return 'Hello World!']; WRONG

    return ['Hello World!'];
});

Route::get('/test',function(){
    return [
        'name' => 'Test',
        'age' => 27,
        'city' => 'somewhere'
    ];
});

Route::get('/posts',[PostController::class,'index']);
Route::get('/posts/{post}',[PostController::class,'show']);
Route::post('/posts',[PostController::class,'store']);
Route::put('/posts/{post}',[PostController::class,'update']);
Route::delete('/posts/{post}',[PostController::class,'destroy']);

Route::get('/teams',[TeamsController::class,'index']);
Route::get('/teams/{teams}',[TeamsController::class,'show']);
Route::post('/teams',[TeamsController::class,'store']);
Route::put('/teams/{teams}',[TeamsController::class,'update']);
Route::delete('/teams/{teams}',[TeamsController::class,'destroy']);
