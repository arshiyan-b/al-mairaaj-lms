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
                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add Student</button>
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
                            <th>Create User</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($studentList as $student)
                        <tr>
                            <td>{{ $student-> student_id }}</td>
                            <td>{{ $student-> student_name }}</td>
                            <td>{{ $student-> student_phone_no }}</td>
                            <td>{{ $student-> student_email }}</td>
                            <td>{{ $student-> student_cnic }}</td>
                            <td>
                            @if ($student-> user_created == false)
                                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createStudentUser" data-student-id="{{ $student->student_id }}" data-student-name="{{ $student->student_name }}">Create</button>
                            @else
                                User is already created
                            @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>    
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addStudentModalLabel">Add New Student</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('admin.student_store') }}">
            @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label for="studentName" class="form-label">Student Name</label>
                        <input type="text" name="studentName" class="form-control" id="studentName" placeholder="Enter name">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="studentPhoneNo" class="form-label">Phone Number</label>
                        <input type="text" name="studentPhoneNo" class="form-control" id="studenPhoneNo" placeholder="Enter phone no.">
                    </div>
                    <div class="col-md-6">
                        <label for="studentWhatsappNo" class="form-label">Whatsapp Number</label>
                        <input type="text" name="studentWhatsappNo" class="form-control" id="studentWhatsappNo" placeholder="Enter whatsapp no.">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="studentEmail" class="form-label">Student Email</label>
                        <input type="email" name="studentEmail" class="form-control" id="studentEmail" placeholder="Enter email">
                    </div>
                    <div class="col-md-6">
                        <label for="studentCNIC" class="form-label">Student CNIC</label>
                        <input type="text" name="studentCNIC" class="form-control" id="studentCNIC" placeholder="Enter CNIC no.">
                    </div>
                </div>
                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createStudentUser" tabindex="-1" aria-labelledby="addcreateStudentUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addcreateStudentUser">Create a new user</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('admin.student_user') }}" id="studentUserForm">
            @csrf
            <input type="hidden" name="student_id" id="modalStudentId">
            <input type="hidden" name="student_name" id="modalStudentName">

                <div class="mb-3 row">
                    <div class="col-md-10">
                        <label for="studentEmail" class="form-label">Student Email</label>
                        <input type="text" name="studentEmail" class="form-control" id="studentEmail" placeholder="Enter email">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-10">
                        <label for="studentPassword" class="form-label">Student Password</label>
                        <input type="text" name="studentPassword" class="form-control" id="studentPassword" placeholder="Enter password">
                    </div>
                </div>

                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    document.getElementById('createStudentUser').addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        const teacherId = button.getAttribute('data-student-id');
        const studentName = button.getAttribute('data-student-name');
        
        document.getElementById('modalStudentName').value = studentName;
        document.getElementById('modalStudentId').value = teacherId;
        
        // Debug output
        console.log('Teacher ID set to:', teacherId);
        console.log('Hidden input value is now:', document.getElementById('modalStudentId').value);
    });

    // When form submits
    document.getElementById('studentUserForm').addEventListener('submit', function(e) {
        // Debug output
        console.log('Submitting form with student_id:', document.getElementById('modalStudentId').value);
    });
});
</script>

@endsection