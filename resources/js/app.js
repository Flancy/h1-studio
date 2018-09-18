
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
    	}
    },
    created () {
        let th = this;
        this.page = window.location.search;
        axios.get('/orders/'+this.page)
            .then(response => {
                th.orders.orders = response.data.data;
                th.orders.from = response.data.from;
            })
            .catch(error => {
                console.log(error);
            })
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
                this.orders.deleteOrders.push(evt.target.value);
            } else {
                this.orders.deleteOrders.remove(evt.target.value);
            }
        },
        //Модальные окна
        closeModalOrder() {
            this.$root.$emit('bv::hide::modal','modal-order');
        },
        closeModalOrderAlert() {
            this.$root.$emit('bv::hide::modal','modal-order-alert');
        },
    },
});
