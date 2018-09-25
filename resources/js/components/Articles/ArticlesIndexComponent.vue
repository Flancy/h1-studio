<template>
	<div class="row justify-content-center">
		<div class="col-sm-6 col-md-4 mb-3 d-flex align-items-stretch" v-for="article in articles">
	        <div class="card">
	            <img :src="article.photo" :alt="article.title" class="card-img-top img-fluid">
	            <div class="card-body">
	                <h5 class="card-title">{{ article.title }}</h5>
	                <p class="card-text">{{ article.short_description }}</p>
	            </div>
	            <div class="card-footer text-muted">
	                <div class="text-left">
	                    <b-btn 
			                @click="getArticlesInfo(article.id)"
			                variant="outline-primary"
			                v-b-modal.modal-article>Подробнее</b-btn>
	                </div>
	                <div class="text-right">
	                    <p class="card-date">19.09.2018</p>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</template>

<script>
	export default {
		props: [
			"getArticlesInfo"
		],
		data () {
			return {
				articles: {},
				page: 1
			}
		},
		created () {
			this.init();
		},
        methods: {
        	init () {
        		let th = this
        			this.page = window.location.search;
        		axios.get('/articles/'+th.page)
        			.then(response => {
        				console.log(response);
        				th.articles = response.data.data;
        			})
        			.catch(error => {
        				console.log(error);
        			});
        	}
        },
    }
</script>