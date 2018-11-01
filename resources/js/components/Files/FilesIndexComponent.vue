<template>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th class="th-center">#</th>
                <th class="th-center">Имя файла</th>
                <th class="th-center">Тип файла</th>
                <th class="th-center">Ссылка проект</th>
                <th class="th-center">Удалить</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(file, index) in files.data">
                <th class="th-center">{{ getFileIndex(index) }}</th>
                <td class="th-center">{{ file.name }}</td>
                <td class="th-center">{{ file.type }}</td>
                <td class="th-center">
                    <b-alert show variant="primary">
                        <a :href="'projects/'+file.projects_id">Перейти</a>
                    </b-alert>
                </td>
                <td class="th-center">
                    <b-btn
                        @click="deleteFiles(file, file.id)"
                        variant="danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Удалить</b-btn>
                </td>
            </tr>
        </tbody>
        <div>
            <b-modal centered class="modal-h1" title="Файл удален" v-model="modalShow">
                <b-alert show variant="success">
                    Файл успешно удален
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
    import {eventBus} from '../../app.js'
    export default {
        data () {
            return {
                files: {},
                page: null,
                modalShow: false
            }
        },
        created () {
            this.getFiles();
            eventBus.$on("fileCreate", (file) => {
                this.addFileInToTable(file);
            });
        },
        methods: {
            getProject(file) {
                axios.get('/files/'+file.id)
                    .then(response => {
                        console.log(response.data);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            getFileIndex(index) {
                let i = this.files.from;
                i = this.files.from+index;
                return i;
            },
            getFiles() {
                let th = this
                    this.page = window.location.search;
                axios.get('/files'+th.page)
                    .then(response => {
                        th.files = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            deleteFiles(file, id) {
                let th = this;
                axios.delete('/files/'+id)
                    .then(response => {
                        th.files.data.splice(th.files.data.indexOf(file), 1);
                        th.modalShow = !th.modalShow
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            addFileInToTable(files) {
                this.files.data.unshift(files);
            }
        }
    }
</script>