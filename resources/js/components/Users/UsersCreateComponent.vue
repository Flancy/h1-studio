<template>
	<div class="row justify-content-center alerts-wrap">
		<div class="col-sm-3 mb-2">
			<b-button 
				@click="modalShow = !modalShow"
				size="md" 
				variant="primary">
				<i class="fa fa-plus" aria-hidden="true"></i> Добавить клиента
	        </b-button>

	        <b-modal size="md" centered class="modal-h1" title="Добавление клиента" v-model="modalShow">
	        	<div class="modal-body">
	        		<div class="alert alert-warning" role="alert" v-if="showError">
						<p v-for="error in errors">
							{{ error | errorFilter }}
						</p>
					</div>
					<div class="alert alert-success" role="alert" v-if="showSuccess">
						Клиент успешно добавлен
					</div>
					<b-form @submit="onSubmit" @reset="onReset" v-if="show">
						<b-form-group id="name"
							label="Логин *:"
							label-for="name">
								<b-form-input id="name"
									type="text"
									v-model="form.name"
									:state="Boolean(form.name)"
									required
									placeholder="Введите логин"></b-form-input>
						</b-form-group>
						<b-form-group id="password"
							label="Пароль *:"
							label-for="password">
								<b-form-input id="password"
									type="text"
									v-model="form.password"
									:state="Boolean(form.password)"
									required
									placeholder="Введите пароль"></b-form-input>
						</b-form-group>
						<b-form-group id="full_name"
							label="Имя *:"
							label-for="full_name">
								<b-form-input id="full_name"
									type="text"
									v-model="form.full_name"
									:state="Boolean(form.full_name)"
									required
									placeholder="Введите имя"></b-form-input>
						</b-form-group>
						<b-form-group id="email"
							label="E-mail *:"
							label-for="email">
								<b-form-input id="email"
									type="text"
									v-model="form.email"
									:state="Boolean(form.email)"
									required
									placeholder="Введите E-mail"></b-form-input>
						</b-form-group>
						<b-form-group id="phone"
							label="Телефон *:"
							label-for="phone">
								<b-form-input id="phone"
									type="text"
									v-model="form.phone"
									:state="Boolean(form.phone)"
									required
									placeholder="Введите телефон"></b-form-input>
						</b-form-group>
						<b-form-group id="company"
							label="Компания *:"
							label-for="company">
								<b-form-input id="company"
									type="text"
									v-model="form.company"
									:state="Boolean(form.company)"
									required
									placeholder="Введите компанию"></b-form-input>
						</b-form-group>
						<b-form-group id="description"
							label="Дополнительная информация *:"
							label-for="description">
								<b-form-textarea id="description"
									type="text"
									v-model="form.description"
									:state="Boolean(form.description)"
									required
									placeholder="Введите дополнительная информация"></b-form-textarea>
						</b-form-group>
						<div class="fz-0">
							<b-button type="submit" class="btn-modal" variant="primary">Добавить</b-button>
							<b-button type="reset" class="btn-modal" variant="danger">Сбросить</b-button>
						</div>
					</b-form>
	        	</div>
			    <div slot="modal-footer">
				    <b-btn size="lg" variant="primary" @click="modalShow = !modalShow">
				    	Закрыть
				    </b-btn>
				</div>
			</b-modal>
		</div>
		<div class="col-sm-5 mb-2">&nbsp;</div>
		<div class="col-sm-2 mb-2 text-center">
			<b-alert show variant="primary">Администраторы</b-alert>
		</div>
		<div class="col-sm-2 mb-2 text-center">
	    	<b-alert show variant="secondary">Клиенты</b-alert>
		</div>
	</div>
</template>

<script>
	import {eventBus} from '../../app.js'
	export default {
        data () {
        	return {
        		form: {
        			name: null,
        			full_name: null,
        			email: null,
        			phone: null,
        			company: null,
        			description: null,
        			password: null
        		},
        		show: true,
        		modalShow: false,
				showError: false,
				showSuccess: false,
				errors: null,
        	}
        },
		filters: {
			errorFilter: function (value) {
				if (!value) return ''
				value = value.toString()
				return  value.replace(/\/r/g, '[]"');
			}
		},
        methods: {
        	onSubmit (evt) {
				evt.preventDefault();
				let th = this;
				axios.post('/users', this.form)
		    		.then(response => {
		    			th.showSuccess = true;
		    			th.showError = false;
		    			eventBus.$emit("userCreate", response.data);
		    		})
		    		.catch(error => {
		    			console.log(error);
		    			th.errors = error.response.data;
		    			th.showError = true;
		    			th.showSuccess = false;
		    		});
			},
			onReset (evt) {
				evt.preventDefault();

				this.form.name = '';
				this.form.full_name = '';
				this.form.email = '';
				this.form.phone = '';
				this.form.company = '';
				this.form.description = '';
				this.form.password = '';

				this.show = false;
				this.showSuccess = false;
				this.showError = false;
				this.$nextTick(() => { this.show = true });
			}
        }
    }
</script>