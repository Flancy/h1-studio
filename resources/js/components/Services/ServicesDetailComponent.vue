<template>
	<div class="row justify-content-center align-self-center">
		<div class="card card-detail flex-md-row mb-4 shadow-sm h-md-250" v-for="service in services" :id="'service'+service.id">
			<img class="card-img-right d-flex services-img" :src="service.photo" :alt="service.title">
			<div class="card-body d-flex flex-column align-items-start">
				<h3 class="mb-0">{{ service.title }}</h3>
				<p class="card-text mb-auto">{{ service.description }}</p>
				<b-btn
					@click="modalService(service.id, service.title)"
	                variant="primary"
	                v-b-modal.modal-service>Обсудить проект</b-btn>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: [
			'services',
			'modalService'
		]
    }
</script>