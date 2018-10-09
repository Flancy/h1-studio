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
		            	@click="deleteUser(user, user.id)"
		                variant="danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Удалить</b-btn>
		        </td>
		    </tr>
		</tbody>
		<div>
			<b-modal centered class="modal-h1" title="Клиент успешно удален" v-model="modalShow">
			    <b-alert show variant="success">
			    	Клиент успешно удален
			  	</b-alert>
			    <div slot="modal-footer">
				    <b-btn size="lg" variant="primary" @click="modalShow = !modalShow">
				    	Закрыть
				    </b-btn>
				</div>
			</b-modal>
		</div>
	</table>
</template>

<script>
	export default {
        data () {
        	return {
        		users: {},
        		page: null,
        		modalShow: false
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
        				th.users = response.data;
        			})
        			.catch(error => {
        				console.log(error);
        			});
	        },
	        deleteUser(user, id) {
	        	let th = this;
	        	axios.delete('/users/'+id)
	        		.then(response => {
	        			th.users.data.splice(th.users.data.indexOf(user), 1);
	        			th.modalShow = !th.modalShow
	        		})
	        		.catch(error => {
	        			console.log(error);
	        		})
	        }
        }
    }
</script>