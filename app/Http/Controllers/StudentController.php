<?php

namespace App\Http\Controllers;

use App\Models\CaieCourse;
use App\Models\CaieOlevelVideo;
use App\Models\PearsonCourse;
use App\Models\PearsonIgcseVideo;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function dashboard()
    {   
        return view('student.dashboard');
    }

    public function caie_olevel()
    {   
        $courses = CaieCourse::all();
        return view('student.courses.caie_olevel', compact('courses'));
    }

    public function pearson_igcse()
    {   
        $courses = PearsonCourse::all();
        return view('student.courses.pearson_igcse', compact('courses'));
    }
}
