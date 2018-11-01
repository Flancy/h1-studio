<template>
	<div class="row justify-content-center alerts-wrap">
		<div class="col-sm-3 mb-2">
			<b-button 
				@click="modalShow = !modalShow"
				size="md" 
				variant="primary">
				<i class="fa fa-plus" aria-hidden="true"></i> Добавить файл
	        </b-button>

	        <b-modal size="md" centered class="modal-h1" title="Добавление клиента" v-model="modalShow">
	        	<div class="modal-body">
	        		<div class="alert alert-warning" role="alert" v-if="showError">
						<p v-for="error in errors">
							{{ error | errorFilter }}
						</p>
					</div>
					<div class="alert alert-success" role="alert" v-if="showSuccess">
						Файл успешно добавлен
					</div>
					<b-form @submit="onSubmit" @reset="onReset" v-if="show">
						<b-form-group id="name"
							label="Название файла *:"
							label-for="name">
								<b-form-input id="name"
									type="text"
									v-model="form.name"
									:state="Boolean(form.title)"
									required
									placeholder="Введите название"></b-form-input>
						</b-form-group>
						<b-form-group id="file"
							label="Файл:"
							label-for="file">
								<b-form-file 
									accept="image/*"
									v-model="form.file" 
									placeholder="Выберите изображение..."
									:rows="3"
			                     	:max-rows="6"></b-form-file>
					  			<div class="mt-3">Выбранный файл: {{form.file && form.file.name}}</div>
				  		</b-form-group>
				  		<b-form-group>
					  		<model-list-select 
									:list="projects"
						            option-value="value"
						            option-text="text"
						            v-model="form.projects_id"
						            placeholder="Выберите проект">
							</model-list-select>
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
        			file: null,
        			name: null,
        			projects_id: null,
        		},
        		projects: [],
        		show: true,
        		modalShow: false,
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
        created () {
            this.getProjects();
        },
        methods: {
        	getProjects () {
        		let th = this;
                axios.get('/projects')
                    .then(response => {
                        for (var i = response.data.length - 1; i >= 0; i--) {
		    				th.projects.push({
		    					value: response.data[i].id,
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
				let th = this;
				this.formData = new FormData();
	      		this.formData.append('name', this.form.name);
	      		this.formData.append('projects_id', this.form.projects_id);
	      		this.formData.append('file', this.form.file);
				axios.post('/files', this.formData, {headers: {'Content-Type': 'multipart/form-data'}})
		    		.then(response => {
		    			th.showSuccess = true;
		    			th.showError = false;
		    			eventBus.$emit("fileCreate", response.data);
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

				this.form.file = '';
				this.form.name = '';
				this.form.projects_id = '';

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