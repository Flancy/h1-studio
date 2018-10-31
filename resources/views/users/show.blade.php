@extends('layouts.app')
@section('content')
<div class="container orders">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <project-index></project-index>
            <project-create></project-create>
        </div>
        <div class="col-md-6">
            <user-show></user-show>
        </div>
    </div>
</div>

@endsection