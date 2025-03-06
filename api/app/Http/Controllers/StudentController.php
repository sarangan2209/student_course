<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{

    public function store(Request $request){
        $request->validate([
            'firstname' => 'required|string|max:25',
            'lastname' => 'required|string|max:15',
            'dob' => 'required|date',
        ]); 
        $student = Student::create($request->all()); 
        return response()->json($student,201); 

    }

    public function index(){
        return response()->json(Student::all());
    }

    public function show($id){
        $student = Student::find($id);
        if(!$student){
            return response()->json([
                'message'=>'student not found'  
            ],404);
        }
        return response()->json($student,); 
    }

    public function update(Request $request, $id){
        $student = Student::find($id);
        if(!$student){
            return response()->json([
                'message'=>'student not found'  
            ],404);
        }
        $validated = $request->validate([
            'firstname' => 'sometimes|string|max:50',
            'lastname' => 'sometimes|string|max:50',
            'dob' => 'sometimes|date',
        ]);  
        $student->update($validated);
        return response()->json($student); 

    

    }

    public function destroy($id){
        $student = Student::find($id);
        if(!$student){
            return response()->json([
                'message'=> 'student not found'
            ],404);     
        }
        $student->delete();
        return response()->json([
            'message'=> 'student deleted successfully'
        ],200);   
    }
}