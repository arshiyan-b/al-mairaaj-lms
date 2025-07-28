@extends('admin.layout.app')
@section('title')
    Pearson Books
@endsection
@section('content')
<style>
    .col-md-6{
        margin-top: 8px;
    }
    .btn{
        margin-top: 8px;
    } 
</style>
<div class="container">
    @if (session('success'))
        <div class="alert alert-success mt-3 mx-3">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger mt-3 mx-3">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addPearsonBook">Upload Book</button>
        </div>
            <div class="card-body">
                <h2>hello world</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Book ID</th>
                            <th>Book Name</th>
                            <th>Category</th>
                            <th>Board</th>
                            <th>Grade</th>
                            <th>Subject ID</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Document</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{ $book->book_id }}</td>
                                <td>{{ $book->book_name }}</td>
                                <td>{{ $book->category }}</td>
                                <td>{{ $book->board }}</td>
                                <td>{{ $book->grade }}</td>
                                <td>{{ $book->subject_id }}</td>
                                <td>{{ $book->created_at }}</td>
                                <td>{{ $book->updated_at }}</td>
                                <td>
                                    @if($book->drive_id)
                                        <a href="https://drive.google.com/file/d/1PwzfHo5Lmh1HPItC9lEUBDrQvqlm2rHv/view"
                                        target="_blank"
                                        class="btn btn-sm btn-primary">
                                            View Document
                                        </a>
                                    @else
                                        <span class="text-muted">No File</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
    </div>
</div>

<div class="modal fade" id="addPearsonBook" tabindex="-1" aria-labelledby="addPearsonBookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPearsonBookModalLabel">Upload a Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <form method="POST" action="#" enctype="multipart/form-data">
            @csrf
                <div class="mb-3 row">
                    <div class="col-md-6">
                        <label for="subject" class="form-label">Subject</label>
                        <select name="subject" class="form-control custom-input scroll-select" id="subject" required>
                            <option disabled selected>-- Select Subject --</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->subject_id }}">{{ $subject->subject_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="qualification" class="form-label">Qualification</label>
                        <select name="qualification" class="form-control custom-input" id="qualification" required>
                            <option disabled selected>-- Select Qualification --</option>
                            <option value="igcse">IGCSE</option>
                            <option value="ial">International A Level</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-8">
                    <label for="category" class="form-label">Book Category (Pearson or Reference)</label>
                        <select name="category" class="form-control custom-input" id="category" required>
                            <option disabled selected>-- Select Book Category --</option>
                            <option value="prb">Pearson Resource Book</option>
                            <option value="rb">Reference Book</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-12">
                        <label for="pdfUpload" class="form-label">Upload PDF</label>
                        <input type="file" name="pdfUpload" class="form-control" id="pdfUpload" accept="application/pdf" required>
                    </div>
                </div>
                <input type="hidden" name="board" id="board" value="{{ $board }}">

                <button type="submit" class="btn btn-dark">Upload</button>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection