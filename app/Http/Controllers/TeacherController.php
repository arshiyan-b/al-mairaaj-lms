<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use App\Models\AllowedClass;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function dashboard()
    {   
        $user = Auth::user();
        $teacher = Teacher::find($user->teacher_id);
        $classes = AllowedClass::where('teacher_id', $teacher->id)->get();

        return view('teacher.dashboard', compact('teacher', 'classes'));
    }
    public function olevel_index()
    {
        $teacher = Teacher::find(Auth::user()->teacher_id);
        $classes = AllowedClass::where('teacher_id', $teacher->teacher_id)->get();

        return view('teacher.courses.olevel');
    }
}
