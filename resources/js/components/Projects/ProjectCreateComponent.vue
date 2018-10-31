<template>
	<div class="justify-content-center alerts-wrap">
		<div class="mt-2">
			<b-button 
				@click="modalShow = !modalShow"
				size="md" 
				variant="primary">
				<i class="fa fa-plus" aria-hidden="true"></i> Добавить проект
	        </b-button>

	        <b-modal size="md" centered class="modal-h1" title="Добавление проекта" v-model="modalShow">
	        	<div class="modal-body">
	        		<div class="alert alert-warning" role="alert" v-if="showError">
						<p v-for="error in errors">
							{{ error | errorFilter }}
						</p>
					</div>
					<div class="alert alert-success" role="alert" v-if="showSuccess">
						Проект успешно добавлен
					</div>
					<b-form @submit="onSubmit" @reset="onReset" v-if="show">
						<b-form-group id="title"
							label="Название проекта *:"
							label-for="title">
								<b-form-input id="title"
									type="text"
									v-model="form.title"
									:state="Boolean(form.title)"
									required
									placeholder="Введите название"></b-form-input>
						</b-form-group>
						<model-list-select 
								:list="options"
			                    option-value="value"
			                    option-text="text"
			                    v-model="form.service_name"
                                placeholder="Выберите услугу">
						</model-list-select>
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
	</div>
</template>

<script>
	import {eventBus} from '../../app.js';
    import {ModelListSelect} from 'vue-search-select';

	export default {
        data () {
        	return {
        		form: {
        			id: null,
        			title: null,
        			service_name: {
        				value: null,
	        			text: null
	        		},
        			description: null,
        		},
        		item: {
        			value: null,
        			text: null
        		},
        		options: [],
        		show: true,
        		modalShow: false,
				showError: false,
				showSuccess: false,
				errors: null,
        	}
        },
		created () {
			this.getServices();
		},
		filters: {
			errorFilter: function (value) {
				if (!value) return ''
				value = value.toString()
				return  value.replace(/\/r/g, '[]"');
			}
		},
        methods: {
        	getServices () {
        		let th = this;
				axios.get('/services')
		    		.then(response => {
		    			for (var i = response.data.length - 1; i >= 0; i--) {
		    				th.options.push({
		    					value: response.data[i].title,
		    					text: response.data[i].title
		    				});
		    			}
		    		})
		    		.catch(error => {
		    			console.log(error);
		    		});
        	},
        	onSubmit (evt) {
				evt.preventDefault();
				let th = this,
					pathArray = window.location.pathname.split( '/' );
                this.form.id = pathArray[2];
				this.form.service_name = this.form.service_name.value;
				axios.post('/projects', this.form)
		    		.then(response => {
		    			th.showSuccess = true;
		    			th.showError = false;
		    			eventBus.$emit("projectCreate", response.data);
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
				this.form.service_name = '';
				this.form.description = '';

				this.show = false;
				this.showSuccess = false;
				this.showError = false;
				this.$nextTick(() => { this.show = true });
			}
        },
		components: {
			ModelListSelect
		}
    }
</script>
