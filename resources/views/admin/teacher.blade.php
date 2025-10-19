@extends('admin.layout.app')
@section('title')
    Teacher
@endsection
@section('content')

<div class="container">
    @if (session('success'))
        <div class="alert alert-success mt-3 mx-3">
            {{ session('success') }}
        </div>
    @endif
        <div class="card">
            <div class="card-header">
                <h2>Teacher Page</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive-wrapper" style="overflow-x: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Teacher ID</th>
                                <th>Name</th>
                                <th>Phone number</th>
                                <th>Email</th>
                                <th>CNIC number</th>
                                <th>View Details</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($teacherList as $teacher)
                        <tr>
                            <td>{{ $teacher->id }}</td>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->phone_no }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td>{{ $teacher->cnic }}</td>
                            <td>
                                <a href="{{ route('admin.teachers_show', $teacher->id) }}" class="btn btn-sm btn-dark">
                                    View Details
                                </a>
                            </td>
                            <td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>    
            </div>
        </div>
</div>


@endsection