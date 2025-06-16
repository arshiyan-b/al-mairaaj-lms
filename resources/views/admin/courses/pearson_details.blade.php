@extends('admin.layout.app')
@section('title')
    Pearson {{ $course->course_qualification }} {{ $course->course_title }}
@endsection
@section('content')
<style>
    .table {
        width: 75%;
        border-collapse: collapse;
    }
    th {
        width: 25%;
    }

    td {
        width: 75%;
    }
</style>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3><strong>Pearson - {{ $course->course_qualification }} - {{ $course->course_title }}</strong></h3>
        </div>
        <div class="card-body">
        <div class="table-responsive-wrapper" style="overflow-x: auto;">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Course ID</th>
                        <td>{{ $course->course_id }}</td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td>{{ $course->course_title }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $course->course_description }}</td>
                    </tr>
                    <tr>
                        <th>Subject</th>
                        <td>{{ $course->subject->subject_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Qualification</th>
                        <td>{{ $course->course_qualification }}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>{{ number_format($course->course_price) }}</td>
                    </tr>
                    <tr>
                        <th>Teacher Name</th>
                        <td>{{ $course->teacher->teacher_name ?? 'N/A' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>

@endsection