<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\StudentController;


Route::post('register', [ApiController::class, 'register']);
Route::post('login', [Apicontroller::class, 'login'] );

Route::group([
    "middleware" => ["auth:sanctum"]
], function(){
    Route::get('profile', [Apicontroller::class, 'profile'] );

    Route::get('logout', [Apicontroller::class, 'logout'] );

    Route::get('student', [StudentController::class,'index'] );
    Route::post('student', [StudentController::class,'store'] );
    Route::get('student/{id}', [StudentController::class,'show'] );
    Route::put('student/{id}', [StudentController::class,'update'] );
    Route::delete('student/{id}', [StudentController::class,'destroy'] );
});









