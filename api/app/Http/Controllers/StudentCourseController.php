<?php

namespace App\Http\Controllers;


use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;


class StudentCourseController extends Controller
{
    public function enroll(Request $request){
        $validated = $request->validate([
            'student_id'=>'required|exists:students,id',
            'course_id'=>'required|exists:courses,id',  
        ]);  

        $student = Student::findorfail($validated['student_id']);
        $student->courses()->attach($validated['course_id']);
        
        return response()->json([
            'message'=> 'student enrolled successfully'
        ]);
    }

    public function studentcourses($student_id){
        $student = Student::with('courses')->find($student_id);

        if(!$student){
            return response()->json([
                'message'=>'student not found' 
            ],404);
        }

        return response()->json($student->courses);
    }

    public function courseStudents($course_id){
        $course = Course::with('students')->find($course_id);
        
        if(!$course){
            return response()->json([
                'message' => 'course not found'
            ],404);
        }
        return response()->json([
            'course'=>$course->name,
            'students'=>$course->students 
        ]);  
    }
    
}
