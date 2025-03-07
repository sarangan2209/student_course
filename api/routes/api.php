<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentCourseController;


Route::post('register', [ApiController::class, 'register']);
Route::post('login', [Apicontroller::class, 'login'] );

Route::group([
    "middleware" => ["auth:sanctum"]
], function(){
    Route::get('profile', [Apicontroller::class, 'profile'] );

    Route::get('logout', [Apicontroller::class, 'logout'] );

    Route::get('students', [StudentController::class,'index'] );
    Route::post('students', [StudentController::class,'store'] );
    Route::get('students/{id}', [StudentController::class,'show'] );
    Route::put('students/{id}', [StudentController::class,'update'] );
    Route::delete('students/{id}', [StudentController::class,'destroy'] );

    
    Route::get('courses',[CourseController::class,'index']);
    Route::post('courses',[CourseController::class,'store']);
    Route::get('courses/{id}',[CourseController::class,'show']);
    Route::put('courses/{id}',[CourseController::class,'update']);
    Route::delete('courses/{id}',[CourseController::class,'destroy']);  
    
    Route::post('enroll',[StudentCourseController::class,'enroll']);
    Route::get('students/{id}/courses',[StudentCourseController::class,'studentCourses']);
    Route::get('courses/{id}/students',[StudentCourseController::class,'courseStudents']);

});




    





