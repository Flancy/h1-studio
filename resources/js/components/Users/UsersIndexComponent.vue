<template>
	<table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th class="th-center">#</th>
                <th>Имя</th>
                <th>E-mail</th>
                <th>Телефон</th>
                <th>Название компании</th>
                <th>Подробнее</th>
                <th>Удалить</th>
            </tr>
        </thead>
		<tbody>
		    <tr v-for="(user, index) in users.data">
		        <th class="th-center">{{ getUserIndex(index) }}</th>
		        <td>
		        	<b-alert :show="user.name == 'h1-studio-admin'" variant="primary"><a :href="'users/'+user.id">{{ user.full_name }}</a></b-alert>
			    	<b-alert :show="user.name != 'h1-studio-admin'" variant="secondary"><a :href="'users/'+user.id">{{ user.full_name }}</a></b-alert>
		    	</td>
		        <td>{{ user.email }}</td>
		        <td>{{ user.phone }}</td>
		        <td>
		        	{{ user.company }}
		        </td>
		        <td>
		            <b-btn
		            	@click="getUsersInfo(user)"
		                variant="outline-info">Подробнее</b-btn>
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
		<div>
			<b-modal size="lg" centered class="modal-h1" title="Информация о клиенте" v-model="modalShowInfo">
			  	<table class="table table-bordered">
				    <tbody>
						<tr><td><b>Логин:</b></td><td>{{ userInfo.name }}</td></tr>
						<tr><td><b>Имя:</b></td><td>{{ userInfo.full_name }}</td></tr>
						<tr><td><b>E-mail:</b></td><td>{{ userInfo.email }}</td></tr>
						<tr><td><b>Телефон:</b></td><td>{{ userInfo.phone }}</td></tr>
						<tr><td><b>Компания:</b></td><td>{{ userInfo.company }}</td></tr>
						<tr><td><b>Дополнительная информация:</b></td><td>{{ userInfo.description }}</td></tr>
					</tbody>
				</table>
			    <div slot="modal-footer">
				    <b-btn size="lg" variant="primary" @click="modalShowInfo = !modalShowInfo">
				    	Закрыть
				    </b-btn>
				</div>
			</b-modal>
		</div>
	</table>
</template>

<script>
	import {eventBus} from '../../app.js'
	export default {
        data () {
        	return {
        		users: {},
        		userInfo: {},
        		page: null,
        		modalShow: false,
        		modalShowInfo: false
        	}
        },
		created () {
			this.getUsers();
			eventBus.$on("userCreate", (user) => {
				this.addUserInToTable(user);
		    });
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
        		axios.get('/users'+th.page)
        			.then(response => {
        				th.users = response.data;
        			})
        			.catch(error => {
        				console.log(error);
        			});
	        },
	        getUsersInfo(user) {
	        	this.userInfo = user;
	        	this.modalShowInfo = !this.modalShowInfo;
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
	        },
	        addUserInToTable(user) {
	        	this.users.data.unshift(user);
	        }
        }
    }
</script>