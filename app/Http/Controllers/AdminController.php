<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Teacher;
use App\Models\TeacherDoc;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Book;
use App\Models\PearsonCourse;
use App\Models\PearsonIgcseVideo;
use App\Models\CaieCourse;
use App\Models\CaieOlevelVideo;

class AdminController extends Controller
{
    public function dashboard()
    {   
        $studentCount = Student::all()->count();
        $teacherCount = Teacher::all()->count();
        $pearson_courses = PearsonCourse::all()->count();

        return view('admin.dashboard', compact(
            'studentCount',
            'teacherCount',
            'pearson_courses'
        ));
    }

    public function student()
    {   
        $studentList = Student::all();

        return view('admin.student', compact('studentList'));
    }

    public function student_store(Request $request)
    {
        $validated = $request->validate([
            'studentName' => 'required|string|max:255',
            'studentPhoneNo' => 'required|string|max:15',
            'studentWhatsappNo' => 'nullable|string|max:15',
            'studentEmail' => 'required|email|unique:students,student_email',
            'studentCNIC' => 'required|string|max:20|unique:students,student_cnic',
        ]);

        Student::create([
            'student_name' => $validated['studentName'],
            'student_phone_no' => $validated['studentPhoneNo'],
            'student_whatsapp_no' => $validated['studentWhatsappNo'],
            'student_email' => $validated['studentEmail'],
            'student_cnic' => $validated['studentCNIC'],
        ]);

        return redirect()->back()->with('success', 'Student added successfully!');
    }
    public function student_user(Request $request)
    {
        $validated = $request->validate([
            'studentEmail' => 'required|string|max:255',
            'studentPassword' => 'required|string|max:15',
            'student_id' => 'required|exists:students,student_id',
        ]);

        $student = Student::findOrFail($request->student_id);
    
        $student->user_created = true;
        $student->save();

        $user = new User();
        $user->name = $student->student_name;
        $user->email = $validated['studentEmail'];
        $user->password = Hash::make($validated['studentPassword']); 
        $user->role = 'student'; 
        $user->student_id = $student->student_id; 
        $user->save();

        return redirect()->back()->with('success', 'Student added successfully!');
    }
    public function teacher()
    {
        $teacherList = Teacher::all();
        return view('admin.teacher',compact('teacherList'));
    }
    public function teacher_store(Request $request)
    {
        $validated = $request->validate([
            'teacherName' => 'required|string|max:255',
            'teacherPhoneNo' => 'required|string|max:15',
            'teacherWhatsappNo' => 'nullable|string|max:15',
            'teacherEmail' => 'required|email|unique:teachers,teacher_email',
            'teacherCNIC' => 'required|string|max:20|unique:teachers,teacher_cnic',
        ]);

        Teacher::create([
            'teacher_name' => $validated['teacherName'],
            'teacher_phone_no' => $validated['teacherPhoneNo'],
            'teacher_whatsapp_no' => $validated['teacherWhatsappNo'],
            'teacher_email' => $validated['teacherEmail'],
            'teacher_cnic' => $validated['teacherCNIC'],
        ]);

        return redirect()->back()->with('success', 'Teacher added successfully!');
    }

    public function teacher_show($id)
    {
        $teacher = Teacher::where('teacher_id', $id)->first();
        $subjectKeys = explode(',', $teacher->subjects);
        $subjects = Subject::whereIn('subject_key', $subjectKeys)->get();
        $docs = TeacherDoc::where('teacher_id', $id)->get();

        return view ('admin.teacher_details', compact('teacher','subjectKeys','subjects','docs'));
    }

    public function teacher_user(Request $request)
    {

        $validated = $request->validate([
            'teacherEmail' => 'required|string|max:255',
            'teacherPassword' => 'required|string|max:15',
            'teacher_id' => 'required|exists:teachers,teacher_id',
        ]);

        $teacher = Teacher::findOrFail($request->teacher_id);
    
        $teacher->user_created = true;
        $teacher->save();

        $user = new User();
        $user->name = $teacher->teacher_name;
        $user->email = $validated['teacherEmail'];
        $user->password = Hash::make($validated['teacherPassword']); 
        $user->role = 'teacher'; 
        $user->teacher_id = $teacher->teacher_id; 
        $user->save();

        return redirect()->back()->with('success', 'Teacher added successfully!');
    }

    public function pearson_books()
    {
        return view('admin.study_material.pearson_books');
    }
    public function pearson_books_store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'pdfUpload' => 'required|mimes:pdf', 
            'pdfUpload' => 'required|mimes:pdf|max:100000',
        ]);

        if ($request->hasFile('pdfUpload')) {
            $file = $request->file('pdfUpload');
            $filePath = $file->store('pearson_books', 'public'); 
        }

        // Store the form data in the database
        Books::create([
            'book_subject' => $request->subject,
            'book_category' => $request->category,
            'book_qualification' => $request->qualification,
            'book_board' => 'pearson',
            'book_file_path' => $filePath, 
        ]);

        return redirect()->back()->with('success', 'Book has been uploaded successfully!');
    }
    public function pearson_igcse_courses(Request $request)
    {
        $teacherList = Teacher::all();
        $courses = PearsonCourse::where('course_qualification', 'igcse')->get();
        $subjects = Subject::all();

        return view('admin.courses.pearson_igcse', compact('teacherList','courses'));
    }
    public function pearson_courses_store(Request $request)
    {
        
        $validated = $request->validate([
            'courseSubject' => 'required',
            'coursePaper' => 'required',
            'courseTeacher' => 'required',
            'courseTitle' => 'required',
            'courseDescription' => 'required',
            'courseQualification' => 'required',
        ]);

        PearsonCourse::create([
            'course_subject' => $validated['courseSubject'],
            'course_paper' => $validated['coursePaper'],
            'course_teacher_id' => $validated['courseTeacher'],
            'course_title' => $validated['courseTitle'],
            'course_description' => $validated['courseDescription'],
            'course_qualification' => $validated['courseQualification'],
        ]);

        return redirect()->back()->with('success', 'Course has been uploaded Successfully!');
    }
    public function pearson_courses_show($id)
    {
        $course = PearsonCourse::where('course_id', $id)->get()->first();

        $highestOrder = PearsonIgcseVideo::where('video_course_id',$course->course_id)->max('video_order');

        if ($course->course_qualification == 'igcse'){
            $videos = PearsonIgcseVideo::where('video_course_id',$course->course_id)->orderBy('video_order', 'asc')->get();
        }

        return view('admin.courses.pearson_details', compact('course','videos','highestOrder'));
    }

    public function pearson_igcse_video_store(Request $request)
    {
        $validated = $request->validate([
            'videoTitle' => 'required',
            'videoDescription' => 'required',
            'videoLink' => 'required',
            'videoLanguage' => 'required',
            'videoOrder' => 'required',
            'videoPrice' => 'required',
            'videoDuration' => 'required',
            'videoSubject' => 'required',
            'videoCourseID' => 'required',
        ]);

        PearsonIgcseVideo::create([
            'video_title' => $validated['videoTitle'],
            'video_description' => $validated['videoDescription'],
            'video_link' => $validated['videoLink'],
            'video_lang' => $validated['videoLanguage'],
            'video_order' => $validated['videoOrder'],
            'video_price' => $validated['videoPrice'],
            'video_duration' => $validated['videoDuration'],
            'video_subject' => $validated['videoSubject'],
            'video_course_id' => $validated['videoCourseID'],
        ]);

        return redirect()->back()->with('success', 'Video has been uploaded Successfully!');
    }
    public function caie_olevel_courses(Request $request)
    {
        $teacherList = Teacher::all();
        $courses = CaieCourse::where('course_qualification', 'olevel')->get();
        $subjects = Subject::all();

        return view('admin.courses.caie_olevel', compact('teacherList','courses','subjects'));
    }
    public function caie_courses_store(Request $request)
    {
        $validated = $request->validate([
            'courseSubject' => 'required',
            'coursePaper' => 'required',
            'courseTeacher' => 'required',
            'courseTitle' => 'required',
            'courseDescription' => 'required',
            'courseQualification' => 'required',
        ]);

        CaieCourse::create([
            'course_subject' => $validated['courseSubject'],
            'course_paper' => $validated['coursePaper'],
            'course_teacher_id' => $validated['courseTeacher'],
            'course_title' => $validated['courseTitle'],
            'course_description' => $validated['courseDescription'],
            'course_qualification' => $validated['courseQualification'],
        ]);

        return redirect()->back()->with('success', 'Course has been uploaded Created!');
    }
    
    public function caie_courses_show($id)
    {
        $course = CaieCourse::where('course_id', $id)->get()->first();

        $highestOrder = CaieOlevelVideo::where('video_course_id',$course->course_id)->max('video_order');

        if ($course->course_qualification == 'olevel'){
            $videos = CaieOlevelVideo::where('video_course_id',$course->course_id)->orderBy('video_order', 'asc')->get();
        }
        return view('admin.courses.caie_details', compact('course','videos','highestOrder'));
    }
    public function caie_olevel_video_store(Request $request)
    {
        $validated = $request->validate([
            'videoTitle' => 'required',
            'videoDescription' => 'required',
            'videoLink' => 'required',
            'videoLanguage' => 'required',
            'videoOrder' => 'required',
            'videoPrice' => 'required',
            'videoDuration' => 'required',
            'videoSubject' => 'required',
            'videoCourseID' => 'required',
        ]);

        CaieOlevelVideo::create([
            'video_title' => $validated['videoTitle'],
            'video_description' => $validated['videoDescription'],
            'video_link' => $validated['videoLink'],
            'video_lang' => $validated['videoLanguage'],
            'video_order' => $validated['videoOrder'],
            'video_price' => $validated['videoPrice'],
            'video_duration' => $validated['videoDuration'],
            'video_subject' => $validated['videoSubject'],
            'video_course_id' => $validated['videoCourseID'],
        ]);

        return redirect()->back()->with('success', 'Video has been uploaded Successfully!');
    }

    public function demo()
    {   
        $videoId = 123;
        return view('admin.demo', compact('videoId'));
    }

    public function trackWatchTime(Request $request)
    {
        $data = $request->validate([
            'video_id' => 'required|string',
            'user_id' => 'required|integer|exists:users,id',
            'watch_time' => 'required|numeric|min:0|max:15',
            'is_completed' => 'sometimes|boolean'
        ]);
        
        // For now, just dump the data - you'll want to store this in your database
        dd($data);
        
        // Later implementation might look like:
        // VideoView::create($data);
        // return response()->json(['success' => true]);
    }
}
