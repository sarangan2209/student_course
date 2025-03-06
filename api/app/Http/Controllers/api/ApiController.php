<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
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

    public function login(Request $request)
    {

        $validateuser = validator::make(
            $request->all(),
            [
                'email' => 'required|email',
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


        if(!Auth::attempt(($request->only(['email','password'])))){
            return response()->json([
                'status' => false,
                'message' => 'something went wrong',
            ],401); 

        }    

        $user = User::where('email', $request->email)->first();

        return response()->json([
            'status' => true,
            'message' => 'successfully login',
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ],200);

    
    }

    public function profile(Request $request)
    {
        $userData = auth()->user();

        return response()->json([
            'status' => true,
            'message' => 'profile info',
            'data' => $userData,
            'id' => auth()->user()->id,

        ],200);

    }

    public function logout ()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'successfully logout',
            'data' => []
        ]);  

    }


}
