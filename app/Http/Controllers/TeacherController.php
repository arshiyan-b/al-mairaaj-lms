<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function dashboard()
    {   
        $user = Auth::user();
        $teacher = Teacher::find($user->teacher_id);

        return view('teacher.dashboard', compact('teacher'));
    }
}
