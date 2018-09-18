<b-modal id="modal-order" class="modal-h1" centered title="Заявка">
    <p class="modal-head">Заявка</p>

    <order-info :orders="orders"></order-info>
    <div slot="modal-footer">
	    <b-btn size="lg" variant="primary" @click="closeModalOrder">
	    	Закрыть
	    </b-btn>
	</div>
</b-modal>