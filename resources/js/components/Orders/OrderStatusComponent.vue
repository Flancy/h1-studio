<template>
  <div>
    <b-form-select v-model="orderStatusOptionSelected" :options="orderStatusOption" @change.native="changeStatus">
    </b-form-select>
  </div>
</template>

<script>
export default {
	props: [
		"orderStatus",
		"orderId"
	],
	data () {
		return {
			orderStatusOptionSelected: 'Новая заявка',
			orderStatusOption: [
				{ value: 'Новая заявка', text: 'Новая заявка' },
				{ value: 'В обработке', text: 'В обработке' },
				{ value: 'Не корректная', text: 'Не корректная' }
			]
		}
	},
	created () {
		this.init()
	},
	methods: {
		init(){
			this.orderStatusOptionSelected = this.orderStatus;
		},
		changeStatus(evt, orderId) {
            const th = this, 
            	id = this.orderId,
            	status = evt.target.value;
            axios.put('/orders/'+id, {
            		id: id,
            		status: status
            	})
                .then(response => {
                	this.$root.$emit('bv::show::modal','modal-order-alert')
                })
                .catch(error => {
					console.log(error);
				});
        },
	}, 
}
</script>