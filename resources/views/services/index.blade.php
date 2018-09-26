@extends('layouts.app')
@section('content')
<div class="container services">
    <div class="row justify-content-center">
    	<service-index :services="services"></service-index>
    	<service-detail :services="services" :modal-service="modalService"></service-detail>
    </div>
</div>

@include('modals.modal-service-form');

@endsection