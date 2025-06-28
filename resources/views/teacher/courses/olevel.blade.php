@extends('teacher.layout.app')
@section('title')
    CAIE | O Level
@endsection
@section('content')


<div class="container">
    <div class="card">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><strong>CAIE</strong></h3>
        </div>
        <div class="card-body">

        </div>
    </div>
</div>
        

@endsection