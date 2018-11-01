@extends('layouts.app')

@section('content')
<div class="container">
	<div class="justify-content-center">
	    @include('messenger.partials.flash')
	    <div class="row">
			@each('messenger.partials.thread', $threads, 'thread', 'messenger.partials.no-threads')
		</div>
	</div>
</div>
@stop
