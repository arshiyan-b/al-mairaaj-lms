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
            @forelse($teacher->subjects_list as $subject)
                <span class="badge bg-success">{{ $subject->subject_name }}</span>
            @empty
                <span class="text-muted">No subjects assigned</span>
            @endforelse
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
        <hr>
        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createTeacherClass">Assign Classes</button>
    </div>
</div>

<div class="modal fade" id="createTeacherClass" tabindex="-1" aria-labelledby="createTeacherClassLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTeacherClassLabel">Create a new user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.teacher_assign_subjects',  $teacher->teacher_id) }}">
                @csrf
                    <input type="hidden" name="teacher_id" value="{{ $teacher->teacher_id }}">
                    <div class="mb-3">
                        <label for="teacherBoards" class="form-label">Boards</label>
                        <select name="teacherBoards" class="form-control" id="teacherBoards">
                            <option value="" selected disabled>Select a Board</option>
                            <option value="CAIE">CAIE</option>
                            <option value="Pearson">Pearson</option>
                            <option value="AKU - EB">AKU - EB</option>                                
                            <option value="Federal Board">Federal Board</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="teacherGrades" class="form-label w-100">Grades</label>
                        <select name="teacherGrades[]" class="form-control" id="teacherGrades" multiple>
                            <option value="SSC I">SSC I</option>
                            <option value="SSC II">SSC II</option>
                            <option value="HSSC I">HSSC I</option>
                            <option value="HSSC II">HSSC II</option>
                            <option value="O Level">O Level</option>
                            <option value="A Level (AS)">A Level (AS)</option>
                            <option value="A Level (A2)">A Level (A2)</option>
                            <option value="IGCSE">IGCSE</option>
                            <option value="International A Level (AS)">International A Level (AS)</option>
                            <option value="International A Level (A2)">International A Level (A2)</option>
                        </select>                                                
                    </div>
                    <div class="mb-3">
                        <label for="teacherSubjects" class="form-label">Subjects</label>
                        <select name="teacherSubjects[]" class="form-control" id="teacherSubjects" multiple>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->subject_id }}">{{ $subject->subject_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#createTeacherClass').on('shown.bs.modal', function () {
            $('#teacherSubjects').select2({
                dropdownParent: $('#createTeacherClass'),
                placeholder: "Select Subject(s)",
                allowClear: true,
                tags: true
            });
            $('#teacherGrades').select2({
                dropdownParent: $('#createTeacherClass'),
                placeholder: "Select Grades(s)",
                allowClear: true,
                tags: true
            });
        });
    });
</script>

@endsection

<!-- 
<div class="row">
                                                <div class="col-md-12">
                                                    <label for="teacherBoards" class="form-label">Boards</label>
                                                    <select name="teacherBoards[]" class="form-control w-100" id="teacherBoards" multiple>
                                                        <option value="CAIE">CAIE</option>
                                                        <option value="Pearson">Pearson</option>
                                                        <option value="AKU - EB">AKU - EB</option>
                                                        <option value="Federal Board">Federal Board</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="teacherGrades" class="form-label w-100">Grades</label>
                                                    <select name="teacherGrades[]" class="form-control" id="teacherGrades" multiple>
                                                        <option value="SSC I">SSC I</option>
                                                        <option value="SSC II">SSC II</option>
                                                        <option value="HSSC I">HSSC I</option>
                                                        <option value="HSSC II">HSSC II</option>
                                                        <option value="O Levels">O Levels</option>
                                                        <option value="IGCSE">IGCSE</option>
                                                        <option value="A Levels">A Levels</option>
                                                    </select>                                                
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="teacherSubjects" class="form-label w-100">Subjects</label>
                                                    <select name="teacherSubjects[]" class="form-control" id="teacherSubjects" multiple>
                                                        @foreach ($subjects as $subject)
                                                            <option value="{{ $subject->subject_id }}">{{ $subject->subject_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> -->