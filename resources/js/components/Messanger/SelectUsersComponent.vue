<template>
	<div class="checkbox">
		<model-list-select 
				:list="users"
	            option-value="value"
	            option-text="text"
	            v-model="recipients"
	            placeholder="Выберите пользователя">
		</model-list-select>
		<input type="checkbox" name="recipients[]" :value="recipients">
	</div>
</template>
<script>
	import {eventBus} from '../../app.js';
    import {ModelListSelect} from 'vue-search-select';

	export default {
        data () {
        	return {
        		users: [],
        		recipients: null
        	}
        },
		created () {
			this.getUsers();
		},
        methods: {
        	getUsers () {
        		let th = this;
				axios.get('/user_list')
		    		.then(response => {
		    			for (var i = response.data.length - 1; i >= 0; i--) {
		    				th.users.push({
		    					value: response.data[i].id,
		    					text: response.data[i].name
		    				});
		    			}
		    		})
		    		.catch(error => {
		    			console.log(error);
		    		});
        	},
        },
		components: {
			ModelListSelect
		}
    }
</script>
<style>
.checkbox {
	margin-bottom: 20px;
}
input[type="checkbox"] {
	display: none;
}
</style>