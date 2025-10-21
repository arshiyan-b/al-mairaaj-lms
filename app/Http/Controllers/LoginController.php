<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherDoc;
use App\Models\User;

class LoginController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('login'); // Return the login view
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            
            return match($user->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'teacher' => redirect()->route('teacher.dashboard'),
                'student' => redirect()->route('student.dashboard'),
            };
        }
    
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function teacher_register(Request $request)
    {
        $subjects = Subject::all();
        return view ('register_as_a_teacher', compact('subjects'));
    }

    public function teacher_register_store(Request $request)
    {
        $request->validate([
            'teacher_name' => 'required|string|max:50',
            'teacher_cnic' => 'required|string|max:15',
            'teacher_gender' => 'required|in:male,female,other',
            'teacher_phone_no' => 'required|string|max:15',
            'teacher_whatsapp_no' => 'required|string|max:15',
            'teacher_email' => 'required|email|max:60',
            'teacher_city' => 'required|string|max:50',
            'teacher_address' => 'required|string|max:120',
            'highest_degree' => 'required|string|max:45',
            'field_of_study' => 'required|string|max:65',
            'university' => 'required|string|max:75',
            'experience' => 'required|in:Less than 1 year,1-2 years,3-5 years,6-10 years,More than 10 years',
            'preferred_board' => 'required|array',
            'preferred_board.*' => 'string|max:120',
            'subjects' => 'required|array',
            'subjects.*' => 'string|max:255',
            'grades' => 'required|array',
            'grades.*' => 'string|max:100',
            'agree' => 'required|in:Yes,yes',
        ]);

        $teacher = Teacher::create([
            'name' => $request->teacher_name,
            'cnic' => $request->teacher_cnic,
            'gender' => $request->teacher_gender,
            'phone_number' => $request->teacher_phone_no,
            'whatsapp_number' => $request->teacher_whatsapp_no,
            'email' => $request->teacher_email,
            'city' => $request->teacher_city,
            'address' => $request->teacher_address,
            'degree' => $request->highest_degree,
            'field_of_study' => $request->field_of_study,
            'university' => $request->university,
            'experience' => $request->experience,
            'preferred_board' => implode(',', $request->preferred_board ?? []),
            'subjects' => implode(',', $request->subjects ?? []),
            'grades' => implode(',', $request->grades ?? []),
            'agree' => $request->agree,
            'user_created' => 0,
        ]);

        if ($request->hasFile('resume')) {
            $path = $request->file('resume')->store('teacher_docs/resumes', 'public');
            TeacherDoc::create([
                'teacher_id' => $teacher->teacher_id,
                'type' => 'resume',
                'file_path' => $path,
            ]);
        }

        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('teacher_docs/pictures', 'public');
            TeacherDoc::create([
                'teacher_id' => $teacher->teacher_id,
                'type' => 'picture',
                'file_path' => $path,
            ]);
        }

        return redirect('login.rwo')->with('success', 'Teacher registered successfully!');
    }

    public function login()
    {
        return view('student.login');
    }

    public function register_authenticate(Request $request)
    {
        dd($request);
    }
    public function register()
    {
        return view('student.register');
    }
    public function otp()
    {
        return view('student.otp');
    }
}
