@extends('teacher.layout.app')
@section('title')
    Course Videos
@endsection
@section('content')

<style>
    .btn-dark{
        margin-top: 8px;
        margin-bottom: 5px;
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
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addVideo">Add Video</button>
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
                            <th>Paper</th>
                            <td>Paper - {{ $course->course_paper }}</td>
                        </tr>
                        <tr>
                            <th>Qualification</th>
                            <td>{{ strtoupper($course->course_qualification) }}</td>
                        </tr>
                        <tr>
                            <th>Teacher Name</th>
                            <td>{{ $course->teacher->teacher_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Number of Videos</th>
                            <td>
                                @if( $course->videos->count() !== 0 )
                                    {{ $course->videos->count() }}
                                @else
                                    <span class="text-muted">No videos found.</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @if( $videos->count() !== 0 )
            <hr>
            <h2>List of Videos</h2>
            <br>
                <ul class="list-unstyled">
                    @foreach($videos as $video)
                        <li>
                            <div 
                                class="col-md-8 p-2 mb-2 border rounded bg-light cursor-pointer" 
                                role="button"
                                data-bs-toggle="modal" 
                                data-bs-target="#videoModal" 
                                data-video="{{ $video->video_link }}">
                                <strong>{{ $video->video_order }}. </strong>{{ $video->video_title }}
                            </div>
                        </li>

                        <!-- Video Modal -->
                        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="videoModalLabel">Video</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="ratio ratio-16x9">
                                            <iframe id="videoFrame" src="" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>


<div class="modal fade" id="addVideo" tabindex="-1" aria-labelledby="addVideoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addVideoLabel">Create a new Pearson {{ $course->course_qualification }} Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('teacher.video_store', ['board' => 'caie', 'grade' => 'olevel', 'id' => $course->course_id]) }}" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3 row">
                        <div class="col-md-11">
                            <label for="videoTitle" class="form-label">Title</label>
                            <textarea name="videoTitle" class="form-control" id="videoTitle" placeholder="Enter Course Title"  rows="1" style="resize: vertical;"></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-11">
                            <label for="videoDescription" class="form-label">Description</label>
                            <textarea name="videoDescription" class="form-control" id="videoDescription" placeholder="Enter Course Description" rows="3" style="resize: vertical;"></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="videoLanguage" class="form-label">Language</label>
                            <select name="videoLanguage" class="form-control custom-input scroll-select" id="videoLanguage" required>
                                <option disabled selected>-- Select Language --</option>
                                <option value="English">English</option>
                                <option value="Urdu">Urdu</option>
                                <option value="Blingual">Bilingual</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="videoOrder" class="form-label">Order</label>
                            <input type="number" name="videoOrder" id="videoOrder" class="form-control" value="{{ $highestOrder + 1 }}" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="videoDuration" class="form-label">Duration</label>
                            <input type="number" name="videoDuration" id="videoDuration" class="form-control" min="1" placeholder="Enter duration in minutes">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-11">
                            <label for="videoFile" class="form-label">Upload Video</label>
                            <input type="file" name="videoFile" id="videoFile" class="form-control" requiredaccept="video/mp4,video/x-m4v,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/webm">
                        </div>
                    </div>
                    <input type="hidden" name="videoSubject" id="videoSubject" value="{{ $course->subject->subject_name }}">

                    <button type="submit" class="btn btn-dark">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var videoModal = document.getElementById('videoModal');
        var videoFrame = document.getElementById('videoFrame');

        videoModal.addEventListener('show.bs.modal', function (event) {
            var link = event.relatedTarget;
            var videoUrl = link.getAttribute('data-video');
            videoFrame.src = videoUrl;
        });

        videoModal.addEventListener('hidden.bs.modal', function () {
            videoFrame.src = ''; // stop video on close
        });
    });
</script>

@endsection