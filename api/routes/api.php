<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ApiController;

Route::post('register', [ApiController::class, 'register']);
Route::post('login', [Apicontroller::class, 'login'] );

Route::group([
    "middleware" => ["auth:sanctum"]
], function(){
    Route::get('profile', [Apicontroller::class, 'profile'] );

    Route::get('logout', [Apicontroller::class, 'logout'] );
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
