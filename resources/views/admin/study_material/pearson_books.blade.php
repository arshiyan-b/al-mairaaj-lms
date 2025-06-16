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
    
    <div class="card">
            <div class="card-header">
                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addPearsonBook">Upload Book</button>
            </div>
            <div class="card-body">
                <h2>hello world</h2>
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
                            <option value="accounting">Accounting</option>
                            <option value="biology">Biology</option>
                            <option value="business">Business</option>
                            <option value="chemistry">Chemistry</option>
                            <option value="cs">Computer Science</option>
                            <option value="economics">Economics</option>
                            <option value="eng_lang_b">English Language B</option>
                            <option value="further_pure_math">Further Pure Mathematics</option>
                            <option value="gc">Global Citizenship</option>
                            <option value="humen_biology">Humen Biology</option>
                            <option value="ict">ICT</option>
                            <option value="isl_studies">Islamic Studies</option>
                            <option value="math_b">Mathematics B</option>
                            <option value="pst">Pakistan Studies</option>
                            <option value="physics">Physics</option>
                            <option value="urdu">Urdu</option>
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
                <button type="submit" class="btn btn-dark">Upload</button>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection