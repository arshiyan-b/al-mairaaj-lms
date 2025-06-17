@extends('student.layout.app')
@section('title')
    CAIE O-Level
@endsection
@section('content')

<div class="container mt-2">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-4">CAIE O-Level Courses</h2>        
        </div>

        <div class="card-body">
            <div class="row">
                @foreach($courses as $course)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <!-- Square Image -->
                        <div class="ratio ratio-1x1" style="width: 85px; height: 85px;">
                            <img src="{{ asset('build/assets/Almairaaj_logo.png') }}" class="card-img-top" alt="Course Image" style="object-fit: cover;">
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">{{ $course->course_title }}</h5>
                            <p class="card-text">{{ Str::limit($course->course_description, 100) }}</p>
                        </div>

                        <div class="card-footer text-muted small">
                            <strong>Subject:</strong> {{ $course->course_subject }}<br>
                            <strong>Paper:</strong> {{ $course->course_paper }}<br>
                            <strong>Qualification:</strong> {{ $course->course_qualification }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection