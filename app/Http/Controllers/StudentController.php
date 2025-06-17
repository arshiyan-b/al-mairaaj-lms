<?php

namespace App\Http\Controllers;

use App\Models\CaieCourse;
use App\Models\CaieOlevelVideo;

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
}
