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
			<b-form-group id="title"
				label="Заголовок новости *:"
				label-for="title">
					<b-form-input id="title"
						type="text"
						v-model="form.title"
						:state="Boolean(form.title)"
						required
						placeholder="Введите заголовок"></b-form-input>
			</b-form-group>
			<b-form-group id="url"
				label="Уникальный url *:"
				label-for="url">
					<b-form-input id="url"
						type="text"
						v-model="form.url"
						:state="Boolean(form.url)"
						required
						placeholder="Введите url"></b-form-input>
			</b-form-group>
			<b-form-group id="short_description"
				label="Короткое описание *:"
				label-for="short_description">
					<b-form-textarea id="short_description"
						type="text"
						v-model="form.short_description"
						:state="Boolean(form.short_description)"
						required
						placeholder="Введите короткое описание"></b-form-textarea>
			</b-form-group>
			<b-form-group id="description"
				label="Описание *:"
				label-for="description">
					<b-form-textarea id="description"
						type="text"
						v-model="form.description"
						:state="Boolean(form.description)"
						required
						placeholder="Введите описание"></b-form-textarea>
			</b-form-group>
			<b-form-group id="photo"
				label="Изображение статьи:"
				label-for="photo">
					<b-form-file 
						accept="image/*"
						v-model="form.photo" 
						placeholder="Выберите изображение..."
						:rows="3"
                     	:max-rows="6"></b-form-file>
		  			<div class="mt-3">Выбранный файл: {{form.photo && form.photo.name}}</div>
	  		</b-form-group>
			<b-button type="submit" variant="primary">Добавить</b-button>
			<b-button type="reset" variant="danger">Сбросить</b-button>
		</b-form>
	</div>
</template>

<script>
export default {
	props: [
		'serviceId'
	],
	data () {
		return {
			form: {
				title: null,
				url: null,
				short_description: null,
				description: null,
				photo: null
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
      		this.formData.append('title', this.form.title);
      		this.formData.append('url', this.form.url);
      		this.formData.append('short_description', this.form.short_description);
      		this.formData.append('description', this.form.description);
      		if(this.form.photo !== null) {
				this.formData.append('photo', this.form.photo);
      		}
			axios.post('/articles', this.formData, {headers: {'Content-Type': 'multipart/form-data'}})
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

			this.form.title = '';
			this.form.url = '';
			this.form.short_description = '';
			this.form.description = '';
			this.form.photo = '';

			this.show = false;
			this.showSuccess = false;
			this.showError = false;
			this.$nextTick(() => { this.show = true });
		}
	}
}
</script>