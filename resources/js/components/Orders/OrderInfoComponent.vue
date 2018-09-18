<template>
	<table class="table table-bordered">
	    <tbody>
			<tr><td><b>ID заявки:</b></td><td>{{ orders.orderInfo.id }}</td></tr>
			<tr><td><b>Статус заявки:</b></td><td>{{ orders.orderInfo.status }}</td></tr>
		    <tr><td><b>Тема заявки:</b></td><td>{{ orders.orderInfo.subject }}</td></tr>
		    <tr><td><b>Имя:</b></td><td>{{ orders.orderInfo.name }}</td></tr>
		    <tr><td><b>Email:</b></td><td>{{ orders.orderInfo.email }}</td></tr>
		    <tr><td><b>Телефон:</b></td><td>{{ orders.orderInfo.phone }}</td></tr>
		    <tr><td><b>Описание:</b></td><td>{{ orders.orderInfo.description }}</td></tr>
		    <tr><td><b>URL заявки:</b></td><td>{{ orders.orderInfo.url }}</td></tr>
		    <tr><td><b>UTM метки:</b></td><td>{{ orders.orderInfo.utm }}</td></tr>
		    <tr><td><b>Дата заявки:</b></td><td>{{ orders.orderInfo.date }}</td></tr>
		</tbody>
	</table>
</template>

<script>
	export default {
        props: [
        	"orders",
        ]
    }
</script>