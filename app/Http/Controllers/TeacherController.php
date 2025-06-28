<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\AllowedClass;
use App\Models\CaieCourse;
use App\Models\PearsonCourse;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    protected $teacher;
    protected $classes;
    protected $subjects;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();

            $this->teacher = Teacher::find($user->teacher_id);
            $this->classes = AllowedClass::where('teacher_id', $this->teacher->teacher_id)->get();
            $this->subjects = Subject::all()->keyBy('subject_id');
            return $next($request);
        });
    }

    protected function getSubjectsForBoardAndGrade($board, $grade)
    {
        $classes = $this->classes->filter(function ($class) use ($board, $grade) {
            return $class->board === $board &&
                in_array($grade, $class->grades);
        })->values();

        $subjectIds = $classes->pluck('subjects')->flatten()->unique();

        return $subjectIds->map(function ($id) {
            return $this->subjects->get($id);
        })->filter()->values();
    }

    public function dashboard()
    {   
        return view('teacher.dashboard', [
            'teacher' => $this->teacher,
            'classes' => $this->classes,
        ]);

    }
    public function caie_olevel_index()
    {
        $subjects = $this->getSubjectsForBoardAndGrade('CAIE', 'O Level');
                
        $courses = CaieCourse::where('course_teacher_id', $this->teacher->teacher_id)->where('course_qualification', 'olevel')->get();

        return view('teacher.courses.caie.olevel', [
            'teacher'   => $this->teacher,
            'subjects'  => $subjects,
            'courses'   => $courses,
        ]);
    }
    public function caie_alevel_as_index()
    {
        $subjects = $this->getSubjectsForBoardAndGrade('CAIE', 'A Level (AS)');
                
        $courses = CaieCourse::where('course_teacher_id', $this->teacher->teacher_id)->where('course_qualification', 'alevel_as')->get();

        return view('teacher.courses.caie.alevel_as', [
            'teacher'   => $this->teacher,
            'subjects'  => $subjects,
            'courses'   => $courses,
        ]);
    }
    public function pearson_igcse_index()
    {
        $subjects = $this->getSubjectsForBoardAndGrade('Pearson', 'IGCSE');
                
        $courses = PearsonCourse::where('course_teacher_id', $this->teacher->teacher_id)->where('course_qualification', 'igcse')->get();

        return view('teacher.courses.pearson.igcse', [
            'teacher'   => $this->teacher,
            'subjects'  => $subjects,
            'courses'   => $courses,
        ]);
    }
    public function course_store(Request $request)
    {
        if ( $request->courseBoard === "caie"){
            
            $validated = $request->validate([
                'courseSubject' => 'required',
                'coursePaper' => 'required',
                'courseTitle' => 'required',
                'courseDescription' => 'required',
                'courseQualification' => 'required',
            ]);

            CaieCourse::create([
                'course_subject' => $validated['courseSubject'],
                'course_paper' => $validated['coursePaper'],
                'course_teacher_id' => $this->teacher->teacher_id,
                'course_title' => $validated['courseTitle'],
                'course_description' => $validated['courseDescription'],
                'course_qualification' => $validated['courseQualification'],
            ]);
        }   
        elseif($request->courseBoard === "pearson")
        {
            $validated = $request->validate([
                'courseSubject' => 'required',
                'coursePaper' => 'required',
                'courseTitle' => 'required',
                'courseDescription' => 'required',
                'courseQualification' => 'required',
            ]);

            PearsonCourse::create([
                'course_subject' => $validated['courseSubject'],
                'course_paper' => $validated['coursePaper'],
                'course_teacher_id' => $this->teacher->teacher_id,
                'course_title' => $validated['courseTitle'],
                'course_description' => $validated['courseDescription'],
                'course_qualification' => $validated['courseQualification'],
            ]);
        }
        
        return redirect()->back()->with('success', 'Course has been uploaded Created!');
    }
}
