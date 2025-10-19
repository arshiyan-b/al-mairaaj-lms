@extends('admin.layout.app')
@section('title')
    Student
@endsection
@section('content')
<style>
    .col-md-6 {
        margin-top: 12px;
    }
    .col-md-10 {
        margin-top: 12px;
    }
    .btn-dark {
        margin-top: 8px;
        margin-bottom: 8px;
    } 
</style>
    <div class="container">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <h2>Welcome to Admin Dashboard - Student Page</h2>
                <div class="table-responsive-wrapper" style="overflow-x: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Phone number</th>
                                <th>Email</th>
                                <th>CNIC number</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($studentList as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->phone_number }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->cnic }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>    
            </div>
        </div>
    </div>


@endsection