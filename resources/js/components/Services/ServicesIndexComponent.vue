<template>
	<div class="row justify-content-center">
		<div class="col-sm-3 col-md-3 mb-4 d-flex align-items-stretch" v-for="service in services">
	        <div class="card">
	            <img :src="service.photo" :alt="service.title" class="services-img">
	            <div class="card-body text-center">
                	<h5 class="card-title">{{ service.title }}</h5>
                	<a href="#" class="card-tooltip" v-b-tooltip.html :title="service.description">?</a>
                	<b-btn 
	                 	@click="scrollToService(service.id)"
		                variant="outline-primary">Подробнее</b-btn>
	            </div>
	        </div>
	    </div>
	</div>
</template>

<script>
	export default {
		props: [
			"services"
		],
		methods: {
			scrollToService(id) {
				this.$scrollTo('#service'+id);
			}
		}
    }
</script>