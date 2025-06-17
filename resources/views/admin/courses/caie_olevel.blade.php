@extends('admin.layout.app')
@section('title')
    Pearson IGCSE Courses
@endsection
@section('content')
<style>
    .btn-dark{
        margin-top: 8px;
        margin-bottom: 5px;
    }
</style>

<div class="container">
    <div class="card">
        <div class="card-header">
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addCourse">Create Course</button>
        </div>
        <div class="card-body">
            <div class="table-responsive-wrapper" style="overflow-x: auto;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Course ID</th>
                            <th>Subject</th>
                            <th>Paper</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Teacher</th>
                            <th>View Details</th>
                        </tr>
                    </thead>
                        <tbody>
                            @foreach ($courses as $course)
                            <tr>
                                <td>{{ $course-> course_id }}</td>
                                <td>{{ $course->subject->subject_name ?? 'N/A' }}</td>
                                <td>Paper - {{ $course->course_paper }}</td>
                                <td>{{ $course->course_title }}</td>
                                <td>{{ $course->course_description }}</td>
                                <td>{{ $course->teacher->teacher_name ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('admin.caie_course_details', ['id' => $course->course_id]) }}" class="btn btn-dark" target="_blank">
                                        View Details
                                    </a> 
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div> 
    </div>
</div>

<div class="modal fade" id="addCourse" tabindex="-1" aria-labelledby="addCourseLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addCourseLabel">Create a new Pearson IGCSE course</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('admin.caie_courses_store') }}" id="studentUserForm">
            @csrf
                <div class="mb-3 row">
                    <div class="col-md-7">
                        <label for="courseSubject" class="form-label">Subject</label>
                        <select name="courseSubject" class="form-control custom-input scroll-select" id="courseSubject" required>
                            <option disabled selected>-- Select Subject --</option>
                            <option value="accounting">Accounting</option>
                            <option value="biology">Biology</option>
                            <option value="business">Business</option>
                            <option value="chemistry">Chemistry</option>
                            <option value="cs">Computer Science</option>
                            <option value="economics">Economics</option>
                            <option value="eng_lang_b">English Language B</option>
                            <option value="further_pure_math">Further Pure Mathematics</option>
                            <option value="gc">Global Citizenship</option>
                            <option value="humen_biology">Humen Biology</option>
                            <option value="ict">ICT</option>
                            <option value="isl_studies">Islamic Studies</option>
                            <option value="math_b">Mathematics B</option>
                            <option value="pst">Pakistan Studies</option>
                            <option value="physics">Physics</option>
                            <option value="urdu">Urdu</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="coursePaper" class="form-label">Paper</label>
                        <select name="coursePaper" class="form-control custom-input scroll-select" id="coursePaper" required>
                            <option disabled selected>-- Select Paper --</option>
                            <option value="1">Papar 1</option>
                            <option value="2">Papar 2</option>
                            <option value="3">Papar 3</option>
                            <option value="4">Papar 4</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                <div class="col-md-11">
                    <label for="courseTeacher" class="form-label">Teacher</label>
                        <select name="courseTeacher" class="form-control custom-input scroll-select" id="courseTeacher" required>
                            <option disabled selected>-- Select Subject --</option>
                            @foreach ($teacherList as $teacher)
                                <option value="{{ $teacher->teacher_id }}">{{ $teacher->teacher_name }}</option>
                            @endforeach
                       </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-11">
                        <label for="courseTitle" class="form-label">Title</label>
                        <textarea name="courseTitle" class="form-control" id="courseTitle" placeholder="Enter Course Title"  rows="2" style="resize: vertical;"></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-11">
                        <label for="courseDescription" class="form-label">Description</label>
                        <textarea name="courseDescription" class="form-control" id="courseDescription" placeholder="Enter Course Description" rows="4" style="resize: vertical;"></textarea>
                    </div>
                </div>
                <input type="hidden" name="courseQualification" id="courseQualification" value="olevel">
                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
        </div>
    </div>
</div>
                
@endsection