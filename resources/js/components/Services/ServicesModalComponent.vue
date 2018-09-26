<template>
	<div>
		<b-form @submit="onSubmit" @reset="onReset" v-if="show">
			<b-form-group id="email"
				label="Ваш Email *:"
				label-for="email">
					<b-form-input id="email"
						type="email"
						v-model="form.email"
						:state="Boolean(form.email)"
						required
						placeholder="Введите email">i=</b-form-input>
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
			<b-form-group id="comment"
				label="Описание проекта *:"
				label-for="name">
					<b-form-textarea id="comment"
						type="text"
						v-model="form.comment"
						:state="Boolean(form.comment)"
						required
						placeholder="Введите описание проекта"></b-form-textarea>
			</b-form-group>
			<b-form-group id="comment"
				label="Файл:"
				label-for="name">
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
		'serviceId'
	],
	data () {
		return {
			form: {
				file: null,
				email: null,
				name: null,
				comment: null,
				service: null
			},
			show: true
		}
	},
	methods: {
		onSubmit (evt) {
			evt.preventDefault();
			this.form.service = this.serviceId;
			alert(JSON.stringify(this.form));
		},
		onReset (evt) {
			evt.preventDefault();

			this.form.email = '';
			this.form.name = '';
			this.form.comment = '';

			this.show = false;
			this.$nextTick(() => { this.show = true });
		}
	}
}
</script>