@extends('student.layout.app')
@section('title')
    Pearson IGCSE
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

<div class="container mt-2">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-4">Pearson IGCSE Courses</h2>        
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

@endsection