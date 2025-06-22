@extends('student.layout.app')
@section('title')
    Pearson IGCSE
@endsection
@section('content')
<style>
    .container {
        max-width: 1300px;
        margin-left: 40px;    
        padding: 0 15px;   
    }

    .custom-card {
        margin: 10px auto;
    }

    .custom-image-container {
        width: 100%;
        height: 180px;
        overflow: hidden;
        margin: 0 auto;
    }

    .custom-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card-body {
        padding: 8px; 
    }

    .card-footer {
        padding: 6px; 
        font-size: 0.9rem;
    }
</style>

<div class="container mt-2">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-4">Pearson IGCSE Courses</h2>        
        </div>

        <div class="card-body">
            <div class="row g-2">
                @foreach($courses as $course)
                <div class="col-md-2 col-sm-4 col-6 mb-2    ">
                    <div class="card shadow-sm custom-card">
                        <div class="custom-image-container">
                            <img src="{{ asset('build/assets/book_logo.png') }}" class="card-img-top" alt="Course Image">
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
@endsection
