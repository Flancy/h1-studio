<template>
	<table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th class="th-center">#</th>
                <th>Имя</th>
                <th>E-mail</th>
                <th>Телефон</th>
                <th>Название компании</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
		<tbody>
		    <tr v-for="(user, index) in users.data">
		        <th class="th-center">{{ getUserIndex(index) }}</th>
		        <td>{{ user.full_name }}</td>
		        <td>{{ user.email }}</td>
		        <td>{{ user.phone }}</td>
		        <td>
		        	{{ user.company }}
		        </td>
		        <td>
		            <b-btn
		                variant="danger"><i class="fa fa-trash-o" aria-hidden="true"></i></b-btn>
		        </td>
		        <td>
		            <b-btn
		                variant="danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Удалить</b-btn>
		        </td>
		    </tr>
		</tbody>
	</table>
</template>

<script>
	export default {
        data () {
        	return {
        		users: {},
        		page: null
        	}
        },
		created () {
			this.getUsers();
		},
        methods: {
        	getUserIndex(index) {
	            let i = this.users.from;
	            i = this.users.from+index;
	            return i;
	        },
	        getUsers() {
	        	let th = this
        			this.page = window.location.search;
        		axios.get('/users/'+th.page)
        			.then(response => {
        				console.log(response);
        				th.users = response.data;
        			})
        			.catch(error => {
        				console.log(error);
        			});
	        }
        }
    }
</script>