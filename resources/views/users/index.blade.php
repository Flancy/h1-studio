@extends('layouts.app')
@section('content')
<div class="container orders">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Клиенты</div>
                <div class="card-body">
                    <user-index></user-index>
                    <?php echo $users->render(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.modal-article-more');

@endsection