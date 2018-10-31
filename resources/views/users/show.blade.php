@extends('layouts.app')
@section('content')
<div class="container orders">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <project-index></project-index>
            @if (Auth::user()->isAdmin())
            	<project-create></project-create>
            @endif
        </div>
        <div class="col-md-6">
            <user-show></user-show>
        </div>
    </div>
</div>

@endsection