<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'tutorname'
    ];

    public function students(){
        return $this->belongsToMany(Student::class, 'student_course');  
    }
}
