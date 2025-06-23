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

    public function register(Request $request)
    {
        $subjects = Subject::all();
        return view ('register', compact('subjects'));
    }

    public function teacher_register(Request $request)
    {
        $request->validate([
            'teacher_name' => 'required|string|max:50',
            'teacher_cnic' => 'required|string|max:15',
            'teacher_gender' => 'nullable|in:male,female,other',
            'teacher_phone_no' => 'required|string|max:15',
            'teacher_whatsapp_no' => 'nullable|string|max:15',
            'teacher_email' => 'nullable|email|max:60',
            'teacher_city' => 'nullable|string|max:50',
            'teacher_address' => 'nullable|string|max:120',
            'highest_degree' => 'nullable|string|max:45',
            'field_of_study' => 'nullable|string|max:65',
            'university' => 'nullable|string|max:75',
            'experience' => 'nullable|in:Less than 1 year,1-2 years,3-5 years,6-10 years,More than 10 years',
            'preferred_board' => 'nullable|array',
            'preferred_board.*' => 'string|max:120',
            'subjects' => 'nullable|array',
            'subjects.*' => 'string|max:255',
            'grades' => 'nullable|array',
            'grades.*' => 'string|max:100',
            'agree' => 'required|in:Yes,yes',
        ]);

        $teacher = Teacher::create([
            'teacher_name' => $request->teacher_name,
            'teacher_cnic' => $request->teacher_cnic,
            'teacher_gender' => $request->teacher_gender,
            'teacher_phone_no' => $request->teacher_phone_no,
            'teacher_whatsapp_no' => $request->teacher_whatsapp_no,
            'teacher_email' => $request->teacher_email,
            'teacher_city' => $request->teacher_city,
            'teacher_address' => $request->teacher_address,
            'highest_degree' => $request->highest_degree,
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


        return redirect('login')->with('success', 'Teacher registered successfully!');
    }
}
