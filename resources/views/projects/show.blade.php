@extends('layouts.app')
@section('content')
<div class="container orders">
    <div class="row justify-content-center">
    	<div class="col-md-12">
    		<project-detail></project-detail>
    	</div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <project-show_new></project-show_new>
        </div>
        <div class="col-md-4">
        	<project-show_inwork></project-show_inwork>
        </div>
        <div class="col-md-4">
        	<project-show_success></project-show_success>
        </div>
    </div>
</div>

@endsection