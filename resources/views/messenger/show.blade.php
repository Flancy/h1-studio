@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header primary">Беседа: {{ $thread->subject }}</h5>
                <div class="card-body">
                	<h3>Сообщения:</h3>
			        @each('messenger.partials.messages', $thread->messages, 'message')

			        @include('messenger.partials.form-message')
		       </div>
		    </div>
		</div>
    </div>
</div>
@stop
