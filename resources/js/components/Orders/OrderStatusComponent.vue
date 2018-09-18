<template>
  <div>
    <b-form-select v-model="orderStatusOptionSelected" :options="orderStatusOption" @change.native="changeStatus">
    </b-form-select>
  </div>
</template>

<script>
export default {
	props: [
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
	mounted () {
		this.init()
	},
	methods: {
		init(){
			const th = this;
			axios.get('/orders/'+th.orderId)
                .then(function(response) {
                    th.orderStatusOptionSelected = response.data.status;
                })
                .catch(function(error) {
					console.log(error);
				});
		},
		changeStatus(evt, orderId) {
            const th = this, 
            	id = this.orderId,
            	status = evt.target.value;
            axios.put('/orders/'+id, {
            		id: id,
            		status: status
            	})
                .then(function(response) {
                	
                })
                .catch(function(error) {
					console.log(error);
				});
        },
	}, 
}
</script>