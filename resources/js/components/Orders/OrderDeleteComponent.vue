<template>
	<b-form-select v-model="selected" :options="options" size="md" @change.native="deleteOrdersTrash" />
</template>

<script>
	export default {
        props: [
        	"deleteOrders",
        	"orders"
        ],
        data () {
			return {
				selected: null,
				options: [
					{ value: null, text: 'Выбрать' },
					{ value: 'Удалить', text: 'Удалить выбранное' }
				]
			}
		},
        methods: {
        	deleteOrdersTrash (evt) {
        		let th = this;
        		if(evt.target.value == 'Удалить') {
        			th.deleteOrders.forEach(function(item, i) {
						axios.delete('/orders/'+item.value)
							.then(response => {
								th.orders.splice(item, 1);
							})
							.catch(error => {
								console.log(error);
							});
					});
					th.deleteOrders.splice(0,th.deleteOrders.length);

					let delet = document.getElementsByClassName("order-checkbox");
					for(let i = 0; i < delet.length; i++){
					    delet[i].checked = false;
					}

					setTimeout(() => {
						th.selected = null;
					}, 100);
					
					this.$root.$emit('bv::show::modal','modal-order_delete-alert');
        		}
        	},
        }
    }
</script>