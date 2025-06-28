@extends('teacher.layout.app')
@section('title')
    CAIE | A Level (AS)
@endsection
@section('content')
<style>
    .custom-card {
        width: 250px; 
        margin: 10px;

    }
    .custom-image-container {
        width: 200px;
        height: 230px;
        overflow: hidden;
        margin: 0 auto;
    }

    .custom-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
<div class="container">
    <div class="card">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><strong>CAIE | A Level (AS)</strong></h3>
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addCourse">Create Course</button>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($courses as $course)
                <div class="col-md-3 mb-2">
                    <div class="card h-100 shadow-sm custom-card">
                        <!-- Image with fixed dimensions -->
                        <div class="custom-image-container">
                            <img src="{{ asset('build/assets/book_logo.png') }}" 
                                    class="card-img-top" 
                                    alt="Course Image">
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">{{ $course->course_title }}</h5>
                        </div>

                        <div class="card-footer">
                            <strong>Subject:</strong> {{ $course->course_subject }}<br>
                            <strong>Paper:</strong> {{ $course->course_paper }}<br>
                        </div>
                    </div>
                </div>
                @endforeach
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
            <form method="POST" action="{{ route('teacher.course_store') }}" id="studentUserForm">
            @csrf
                <div class="mb-3 row">
                    <div class="col-md-7">
                        <label for="courseSubject" class="form-label">Subject</label>
                        <select name="courseSubject" class="form-control custom-input scroll-select" id="courseSubject" required>
                            <option disabled selected>-- Select Subject --</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->subject_key }}">{{ $subject->subject_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
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
                <input type="hidden" name="courseBoard" id="courseBoard" value="caie">
                <input type="hidden" name="courseQualification" id="courseQualification" value="alevel_as">
                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
        </div>
    </div>
</div>
        

@endsection