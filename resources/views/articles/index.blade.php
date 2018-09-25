@extends('layouts.app')
@section('content')
<div class="container articles">
    <article-index :get-articles-info="getArticlesInfo"></article-index>
    <div class="row justify-content-center">
        <?php echo $articles->render(); ?>
    </div>
</div>

@include('modals.modal-article-more');

@endsection