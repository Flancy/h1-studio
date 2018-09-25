<template>
	<div class="card">
        <img :src="article.photo" :alt="article.title" class="card-img-top img-fluid">
        <div class="card-body">
            <h5 class="card-title">{{ article.title }}</h5>
            <p class="card-text">{{ article.description }}</p>
        </div>
        <div class="card-footer text-muted">
            <div class="text-right">
                <p class="card-date">19.09.2018</p>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
        props: [
        	"article",
        ],
    }
</script>