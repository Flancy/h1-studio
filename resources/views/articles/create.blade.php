@extends('layouts.app')
@section('content')
<div class="container articles">
	<div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
            	<div class="card-header">Добавление новости</div>
            	<div class="card-body">
					<article-create></article-create>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection