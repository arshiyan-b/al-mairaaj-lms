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
        return view('student.dashboard', ['user' => auth()->user()]);
    }
    
    public function courses()
    {   
        return view('student.courses.index');
    }

    public function boards()
    {   
        return view('student.boards.index', ['user' => auth()->user()]);
    }

    public function subjects()
    {   
        return view('student.subjects.index');
    }

    public function books()
    {   
        return view('student.books.index');
    }

    public function past_papers()
    {   
        return view('student.past_papers.index');
    }

}
