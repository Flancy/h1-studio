
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
//Bootstrap Vue
import BootstrapVue from 'bootstrap-vue';
Vue.use(BootstrapVue);
//Axios Vue
import axios from 'axios';
import VueAxios from 'vue-axios';
Vue.use(VueAxios, axios);
//Vue ScrollTo
var VueScrollTo = require('vue-scrollto');
Vue.use(VueScrollTo, {
    container: "body",
    duration: 500,
    easing: "ease",
    offset: -30,
    force: true,
    cancelable: true,
    onStart: false,
    onDone: false,
    onCancel: false,
    x: false,
    y: true
});
//Moment
var moment = require('moment');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
//Заявки
Vue.component('order-index', require('./components/Orders/OrderIndexComponent.vue'));
Vue.component('order-info', require('./components/Orders/OrderInfoComponent.vue'));
Vue.component('order-status', require('./components/Orders/OrderStatusComponent.vue'));
Vue.component('order-delete', require('./components/Orders/OrderDeleteComponent.vue'));
//Новости
Vue.component('article-index', require('./components/Articles/ArticlesIndexComponent.vue'));
Vue.component('article-create', require('./components/Articles/ArticlesCreateComponent.vue'));
Vue.component('article-info', require('./components/Articles/ArticlesInfoComponent.vue'));
//Услуги
Vue.component('service-index', require('./components/Services/ServicesIndexComponent.vue'));
Vue.component('service-detail', require('./components/Services/ServicesDetailComponent.vue'));
Vue.component('service-modal', require('./components/Services/ServicesModalComponent.vue'));
//Клиенты
Vue.component('user-index', require('./components/Users/UsersIndexComponent.vue'));
Vue.component('user-create', require('./components/Users/UsersCreateComponent.vue'));
Vue.component('user-show', require('./components/Users/UsersShowComponent.vue'));

export const eventBus = new Vue();

const app = new Vue({
    el: '#app',
    data () {
    	return {
            page: 1,
            orders: {
                deleteOrders: [],
                orders: [],
                from: null,
                orderInfo: {
                    "id": "",
                    "status": "",
                    "subject": "",
                    "name": "",
                    "email": "",
                    "phone": "",
                    "description": "",
                    "url": '',
                    "utm": '',
                    "date": '',
                },
            },
            article: {},
            services: {},
            serviceId: null,
            moment: moment,
    	}
    },
    created () {
        let th = this;
        if(window.location.pathname == '/orders' || window.location.pathname == '/orders/') {
            this.page = window.location.search;
            axios.get('/orders/'+this.page)
                .then(response => {
                    th.orders.orders = response.data.data;
                    th.orders.from = response.data.from;
                })
                .catch(error => {
                    console.log(error);
                });
        }
        //Услуги
        if(window.location.pathname == '/services' || window.location.pathname == '/services/') {
            axios.get('/services/')
                .then(response => {
                    th.services = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    methods: {
        //Заявки
    	getOrderInfo(id) {
    		let th = this;
    		axios.get('/orders/'+id)
	    		.then(response => {
                    th.orders.orderInfo.id = response.data.id;
	    			th.orders.orderInfo.status = response.data.status;
			    	th.orders.orderInfo.subject = response.data.subject;
			    	th.orders.orderInfo.name = response.data.name;
			    	th.orders.orderInfo.email = response.data.email;
			    	th.orders.orderInfo.phone = response.data.phone;
			    	th.orders.orderInfo.description = response.data.description;
			    	th.orders.orderInfo.url = response.data.url;
			    	th.orders.orderInfo.utm = response.data.utm;
			    	th.orders.orderInfo.date = response.data.date;
	    		});
    	},
        saveDeleteOrder (evt) {
            if(evt.target.checked === true) {
                this.orders.deleteOrders.push({ id: evt.target.attributes[1].value, value: evt.target.value });
            } else {
                this.orders.deleteOrders = this.orders.deleteOrders.filter(function(item) {
                    return item.value !== evt.target.value;
                });
                console.log(this.orders.deleteOrders);
            }
        },
        //Услуги
        modalService (id) {
            this.serviceId = id;
        },
        //Новости
        getArticlesInfo (id) {
            let th = this;
            axios.get('/articles/'+id)
                .then(response => {
                    th.article = response.data;
                });
        },
        //Модальные окна
        closeModalOrder() {
            this.$root.$emit('bv::hide::modal','modal-order');
        },
        closeModalOrderAlert() {
            this.$root.$emit('bv::hide::modal','modal-order-alert');
        },
        closeModalOrderDeleteAlert() {
            this.$root.$emit('bv::hide::modal','modal-order_delete-alert');
        },
        closeModalArticle() {
            this.$root.$emit('bv::hide::modal','modal-article');
        },
        closeModalService() {
            this.$root.$emit('bv::hide::modal','modal-service');
        }
    },
});
