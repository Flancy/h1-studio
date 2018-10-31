<template>
	<table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th class="th-center">#</th>
                <th>Название проекта</th>
                <th>Подробнее</th>
            </tr>
        </thead>
		<tbody>
		    <tr v-for="(project, index) in projects">
                <td class="th-center">
                    {{ index }}
                </td>
		        <td>
			    	{{ project.title }}
		    	</td>
		        <td class="th-center">
		            <b-btn variant="outline-info" :href="'../projects/'+project.id">Подробнее</b-btn>
		        </td>
		    </tr>
		</tbody>
	</table>
</template>

<script>
	import {eventBus} from '../../app.js';

	export default {
        data () {
        	return {
        		projects: {}
        	}
        },
		created () {
			this.getProjects();
            eventBus.$on("projectCreate", (project) => {
                this.addProjectInToTable(project);
            });
		},
        methods: {
	        getProjects() {
	        	let th = this,
                    pathArray = window.location.pathname.split( '/' ),
                    secondLevelLocation = pathArray[2];
                console.log(secondLevelLocation);
        		axios.get('/project/'+secondLevelLocation)
        			.then(response => {
        				th.projects = response.data;
        			})
        			.catch(error => {
        				console.log(error);
        			});
	        },
            addProjectInToTable(project) {
                this.projects.unshift(project);
            }
        }
    }
</script>