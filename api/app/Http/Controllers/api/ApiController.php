<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    //
    public function register(Request $request)
    {
        $validateuser = validator::make(
            $request->all(),
            [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ]
        ); 

        if($validateuser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateuser->errors()
            ],401);

        }

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => $request->password,   

        ]);


        return response()->json([
            'status' => true, 
            'message' => 'User has created successfully',
            'token' => $user->createToken('API TOKEN')->plainTextToken   
     ],200); 
    }
}
