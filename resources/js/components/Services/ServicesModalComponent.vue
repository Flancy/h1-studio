<template>
	<div>
		<div class="alert alert-warning" role="alert" v-if="showError">
			<p v-for="error in errors">
				{{ error | errorFilter }}
			</p>
		</div>
		<div class="alert alert-success" role="alert" v-if="showSuccess">
			Новость успешно добавлена
		</div>
		<b-form @submit="onSubmit" @reset="onReset" v-if="show">
			<b-form-group id="email"
				label="Ваш Email *:"
				label-for="email">
					<b-form-input id="email"
						type="email"
						v-model="form.email"
						:state="Boolean(form.email)"
						required
						placeholder="Введите email"></b-form-input>
			</b-form-group>
			<b-form-group id="name"
				label="Ваше Имя *:"
				label-for="name">
					<b-form-input id="name"
						type="text"
						v-model="form.name"
						:state="Boolean(form.name)"
						required
						placeholder="Введите имя"></b-form-input>
			</b-form-group>
			<b-form-group id="name_service"
				label="Услуга:"
				label-for="name_service">
					<b-form-input id="name_service"
						type="text"
						:value="serviceTitle"
						disabled
						required
						:placeholder="serviceTitle"></b-form-input>
			</b-form-group>
			<b-form-group id="description"
				label="Описание проекта *:"
				label-for="name">
					<b-form-textarea id="description"
						type="text"
						v-model="form.description"
						:state="Boolean(form.description)"
						required
						placeholder="Введите описание проекта"></b-form-textarea>
			</b-form-group>
			<b-form-group id="file"
				label="Файл:"
				label-for="file">
					<b-form-file 
						v-model="form.file" 
						placeholder="Выберите файл..."
						:rows="3"
                     	:max-rows="6"></b-form-file>
		  			<div class="mt-3">Выбранный файл: {{form.file && form.file.name}}</div>
	  		</b-form-group>
			<b-button type="submit" variant="primary">Отправить</b-button>
			<b-button type="reset" variant="danger">Сбросить</b-button>
		</b-form>
	</div>
</template>

<script>
export default {
	props: [
		'serviceId',
		'serviceTitle'
	],
	data () {
		return {
			form: {
				file: null,
				email: null,
				name: null,
				description: null,
			},
			show: true,
			showError: false,
			showSuccess: false,
			errors: null,
			formData: {},
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
			this.formData = new FormData();
      		this.formData.append('email', this.form.email);
      		this.formData.append('name', this.form.name);
      		this.formData.append('name_service', this.serviceTitle);
      		this.formData.append('description', this.form.description);
      		if(this.form.file !== null) {
				this.formData.append('file', this.form.photo);
      		}
      		axios.post('/services-storage', this.formData, {headers: {'Content-Type': 'multipart/form-data'}})
	    		.then(response => {
	    			th.showSuccess = true;
	    			th.showError = false;
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

			this.form.email = '';
			this.form.name = '';
			this.form.name_service = '';
			this.form.description = '';
			this.form.file = '';

			this.show = false;
			this.showSuccess = false;
			this.showError = false;
			this.$nextTick(() => { this.show = true });
		}
	}
}
</script>