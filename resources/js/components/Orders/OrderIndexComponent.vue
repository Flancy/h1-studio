<template>
	<table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th class="th-center">#</th>
                <th>E-mail</th>
                <th>Дата</th>
                <th>Статус</th>
                <th class="th-center">Выбрать</th>
                <th class="th-center">Подробнее</th>
            </tr>
        </thead>
		<tbody>
		    <tr v-for="(order, index) in orders.orders">
		        <th class="th-center">{{ getOrderIndex(index) }}</th>
		        <td>{{ order.email }}</td>
		        <td>{{ order.name }}</td>
		        <td>
		            <order-status :order-status="order.status" :order-id="order.id"></order-status>
		        </td>
		        <td>
		            <div class="input-group-text text">
		                <input type="checkbox" @click="saveDeleteOrder" :value="order.id" class="order-checkbox">
		            </div>
		        </td>
		        <td>
		            <b-btn 
		                @click="getOrderInfo(order.id)"
		                variant="outline-info"
		                v-b-modal.modal-order>Подробнее</b-btn>
		        </td>
		    </tr>
		</tbody>
		<tfoot>
			<td colspan="4"></td>
			<td>
				<order-delete 
					:delete-orders="orders.deleteOrders"
					:orders="orders.orders"></order-delete>
			</td>
			<td></td>
		</tfoot>
	</table>
</template>

<script>
	export default {
        props: [
        	"orders",
        	"getOrderInfo",
        	"saveDeleteOrder"
        ],
        methods: {
        	getOrderIndex(index) {
	            let i = this.orders.from;
	            i = this.orders.from+index;
	            return i;
	        },
        }
    }
</script>