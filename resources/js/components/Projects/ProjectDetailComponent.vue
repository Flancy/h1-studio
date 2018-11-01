<template>
    <div class="justify-content-left align-self-center">
        <div class="card card-detail flex-md-row mb-4 shadow-sm h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
                <h3 class="mb-4">{{ project.title }}</h3>
                <p class="card-text mb-4">{{ project.description }}</p>

                <p class="card-text mb-4"><strong>Тип услуги: {{ project.service_name }}</strong></p>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
        data () {
        	return {
        		project: {}
        	}
        },
		created () {
			this.getProjects();
		},
        methods: {
	        getProjects() {
	        	let th = this,
                    pathArray = window.location.pathname.split( '/' ),
                    secondLevelLocation = pathArray[2];
                console.log(secondLevelLocation);
        		axios.get('/projects/'+secondLevelLocation)
        			.then(response => {
        				th.project = response.data;
        			})
        			.catch(error => {
        				console.log(error);
        			});
	        }
        }
    }
</script>