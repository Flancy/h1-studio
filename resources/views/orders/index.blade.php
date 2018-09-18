@extends('layouts.app')
@section('content')
<div class="container orders">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Заявки</div>
                <div class="card-body">
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
                            @foreach ($orders as $order)
                                <tr>
                                    <th class="th-center"><a href="/orders/{{ $order->id }}">{{ $loop->iteration }}</a></th>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>
                                        <order-status :order-id="{{ $order->id }}"></order-status>
                                    </td>
                                    <td>
                                        <div class="input-group-text text">
                                            <input type="checkbox" aria-label="Выбрать" class="order-checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <b-btn 
                                            @click="getOrderInfo({{ $order->id }})"
                                            variant="outline-info"
                                            v-b-modal.modal-order>Подробнее</b-btn>
                                        <!--<button type="button" class="btn btn-outline-info btn-sm" @click="showModal">Подробнее</button>-->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <?php echo $orders->render(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.modal-order-more');

@endsection