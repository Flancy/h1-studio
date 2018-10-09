<template>
	<div class="card">
        <div class="card-header">{{ user.full_name }}</div>
        <div class="card-body">
			<table class="table table-bordered">
			    <tbody>
					<tr><td><b>Логин:</b></td><td>{{ user.name }}</td></tr>
					<tr><td><b>Имя:</b></td><td>{{ user.full_name }}</td></tr>
					<tr><td><b>E-mail:</b></td><td>{{ user.email }}</td></tr>
					<tr><td><b>Телефон:</b></td><td>{{ user.phone }}</td></tr>
					<tr><td><b>Компания:</b></td><td>{{ user.company }}</td></tr>
					<tr><td><b>Дополнительная информация:</b></td><td>{{ user.description }}</td></tr>
					<tr><td><b>Дата создания:</b></td><td>{{ user.created_at }}</td></tr>
				</tbody>
			</table>
		</div>
    </div>
</template>
<script>
	export default {
        data () {
        	return {
        		user: {},
        	}
        },
		created () {
			this.getUser();
		},
        methods: {
        	getUser() {
        		let th = this,
        			path = window.location.pathname;
        		axios.get(path)
        			.then(response => {
        				th.user = response.data;
        			})
        			.catch(error => {
        				console.log(error);
        			});
        	}
        }
    }
</script>