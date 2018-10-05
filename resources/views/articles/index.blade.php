@extends('layouts.app')
@section('content')
<div class="container articles">
    <article-index :get-articles-info="getArticlesInfo" :moment="moment">
    	@if (Auth::user()->isAdmin())
	    	<template slot-scope="props">
		    	<button type="button" class="close" title="Удалить новость" @click="props.deleteArticle(props.article, props.index)">
					<span aria-hidden="true">&times;</span>
				</button>
			</template>
    	@endif
    </article-index>
    <div class="row justify-content-center">
        <?php echo $articles->render(); ?>
    </div>
</div>

@include('modals.modal-article-more');

@endsection