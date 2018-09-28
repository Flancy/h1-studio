@extends('layouts.app')
@section('content')
<div class="container orders">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Заявки</div>
                <div class="card-body">
                    <order-index 
                        :orders="orders"
                        :get-order-info="getOrderInfo"
                        :save-delete-order="saveDeleteOrder"></order-index>
                    <?php echo $orders->render(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.modal-order-more');
@include('modals.modal-order-alert');
@include('modals.modal-order_delete-alert');

@endsection