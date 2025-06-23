@extends('admin.layout.app')
@section('title')
    Teacher Details - {{ $teacher->teacher_name }}
@endsection
@section('content')

<div class="container">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Teacher Details</h4>
        </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Name</dt>
            <dd class="col-sm-9">{{ $teacher->teacher_name }}</dd>

            <dt class="col-sm-3">CNIC</dt>
            <dd class="col-sm-9">{{ $teacher->teacher_cnic }}</dd>

            <dt class="col-sm-3">Gender</dt>
            <dd class="col-sm-9">{{ ucfirst($teacher->teacher_gender) }}</dd>

            <dt class="col-sm-3">Phone</dt>
            <dd class="col-sm-9">{{ $teacher->teacher_phone_no }}</dd>

            <dt class="col-sm-3">WhatsApp</dt>
            <dd class="col-sm-9">{{ $teacher->teacher_whatsapp_no }}</dd>

            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9">{{ $teacher->teacher_email }}</dd>

            <dt class="col-sm-3">City</dt>
            <dd class="col-sm-9">{{ $teacher->teacher_city }}</dd>

            <dt class="col-sm-3">Address</dt>
            <dd class="col-sm-9">{{ $teacher->teacher_address }}</dd>

            <dt class="col-sm-3">Highest Degree</dt>
            <dd class="col-sm-9">{{ $teacher->highest_degree }}</dd>

            <dt class="col-sm-3">Field of Study</dt>
            <dd class="col-sm-9">{{ $teacher->field_of_study }}</dd>

            <dt class="col-sm-3">University</dt>
            <dd class="col-sm-9">{{ $teacher->university }}</dd>

            <dt class="col-sm-3">Experience</dt>
            <dd class="col-sm-9">{{ $teacher->experience }}</dd>

            <dt class="col-sm-3">Preferred Boards</dt>
            <dd class="col-sm-9">
            @foreach(explode(',', $teacher->preferred_board) as $board)
                <span class="badge bg-primary">{{ trim($board) }}</span>
            @endforeach
            </dd>

            <dt class="col-sm-3">Subjects</dt>
            <dd class="col-sm-9">
            @foreach($subjects as $subject)
                <span class="badge bg-success">{{ $subject->subject_name }}</span>
            @endforeach
            </dd>

            <dt class="col-sm-3">Grades</dt>
            <dd class="col-sm-9">
            @foreach(explode(',', $teacher->grades) as $grade)
                <span class="badge bg-secondary">{{ trim($grade) }}</span>
            @endforeach
            </dd>

            <dt class="col-sm-3">Documents</dt>
            <dd class="col-sm-9">
                @forelse($docs as $doc)
                    <span class="badge bg-info">{{ ucfirst($doc->type) }}</span>
                    <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">View</a><br>
                @empty
                    <span class="text-muted">No documents uploaded</span>
                @endforelse
            </dd>

            <dt class="col-sm-3">Agreed to Terms</dt>
            <dd class="col-sm-9">{{ ucfirst($teacher->agree) }}</dd>
        </dl>
    </div>
</div>

@endsection