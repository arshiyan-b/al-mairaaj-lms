@extends('admin.layout.app')
@section('title')
    Teacher
@endsection
@section('content')
<style>
    .col-md-6 {
        margin-top: 12px;
    }
    .col-md-10 {
        margin-top: 12px;
    }
    .btn-dark{
        margin-top: 8px;
        margin-bottom: 5px;
    }
</style>
<div class="container">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addTeacherModal">Add Teacher</button>
            </div>
            <div class="card-body">
                <h2>Welcome to Admin Dashboard - Teacher Page</h2>
                <div class="table-responsive-wrapper" style="overflow-x: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>Teacher ID</th>
                            <th>Name</th>
                            <th>Phone number</th>
                            <th>Email</th>
                            <th>CNIC number</th>
                            <th>Create User</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($teacherList as $teacher)
                        <tr>
                            <td>{{ $teacher-> teacher_id }}</td>
                            <td>{{ $teacher-> teacher_name }}</td>
                            <td>{{ $teacher-> teacher_phone_no }}</td>
                            <td>{{ $teacher-> teacher_email }}</td>
                            <td>{{ $teacher-> teacher_cnic }}</td>
                            <td>
                            @if ($teacher-> user_created == false)
                                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createTeacherUser" data-teacher-id="{{ $teacher->teacher_id }}">Create</button>
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
<div class="modal fade" id="addTeacherModal" tabindex="-1" aria-labelledby="addTeacherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addTeacherModalLabel">Add New Teacher</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('admin.teacher_store') }}">
            @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label for="teacherName" class="form-label">Teacher Name</label>
                        <input type="text" name="teacherName" class="form-control" id="teacherName" placeholder="Enter name">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="teacherPhoneNo" class="form-label">Phone Number</label>
                        <input type="text" name="teacherPhoneNo" class="form-control" id="teacherPhoneNo" placeholder="Enter phone no.">
                    </div>
                    <div class="col-md-6">
                        <label for="teacherWhatsappNo" class="form-label">Whatsapp Number</label>
                        <input type="text" name="teacherWhatsappNo" class="form-control" id="teacherWhatsappNo" placeholder="Enter whatsapp no.">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="teacherEmail" class="form-label">Teacher Email</label>
                        <input type="email" name="teacherEmail" class="form-control" id="teacherEmail" placeholder="Enter email">
                    </div>
                    <div class="col-md-6">
                        <label for="teacherCNIC" class="form-label">Teacher CNIC</label>
                        <input type="text" name="teacherCNIC" class="form-control" id="teacherCNIC" placeholder="Enter CNIC no.">
                    </div>
                </div>
                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createTeacherUser" tabindex="-1" aria-labelledby="addcreateTeacherUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addcreateTeacherUser">Create a new user</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{ route('admin.teacher_user') }}" id="teacherUserForm">
            @csrf
            <input type="hidden" name="teacher_id" id="modalTeacherId">
            <div class="row">
                <div class="col-md-10">
                    <label for="modalTeacherEmail" class="form-label">Teacher Email</label>
                    <input type="email" name="teacherEmail" class="form-control" id="modalTeacherEmail" placeholder="Enter email">
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <label for="modalTeacherPassword" class="form-label">Teacher Password</label>
                    <input type="text" name="teacherPassword" class="form-control" id="modalTeacherPassword" placeholder="Enter password">
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
    // When modal opens
    document.getElementById('createTeacherUser').addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const teacherId = button.getAttribute('data-teacher-id');
        
        // Set the hidden input value
        document.getElementById('modalTeacherId').value = teacherId;
        
        // Debug output
        console.log('Teacher ID set to:', teacherId);
        console.log('Hidden input value is now:', document.getElementById('modalTeacherId').value);
    });

    // When form submits
    document.getElementById('teacherUserForm').addEventListener('submit', function(e) {
        // Debug output
        console.log('Submitting form with teacher_id:', document.getElementById('modalTeacherId').value);
    });
});
</script>

@endsection