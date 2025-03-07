<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'tutorname' => 'required|string|max:50', 
        ]);

        $course = Course::create($validated);
        return response()->json($course,201); 

    } 

    public function index(){
        return response()->json(Course::all(),200); 
    }

    public function show($id){
        $course = Course::find($id);

        if(!$course){
            return response()->json([
                'message'=> 'course not found'
            ],404);
        }
        return response()->json($course,200);
    }

    public function update(Request $request, $id){
        $course = Course::find($id);

        if(!$course){
            return response()->json([
                'message'=> 'course not found'
            ],404); 
        }

        $validated = $request->validate([
            'name'=> 'required|string|max:50',
            'tutorname' => 'required|string|max:50',
        ]);

        $course->update($validated);

        return response()->json($course,200); 
    }

    public function destroy($id){
        $course = Course::find($id);

        if(!$course){
            return response()->json([
                'message' => 'course not found'
            ],404); 
        }

        $course->delete();
        return response()->json([
            'message' => 'course deleted successfully'
        ],200); 
    }
}
