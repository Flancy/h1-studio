<b-modal id="modal-service" class="modal-h1" centered title="Услуга">
    <service-modal :service-id="serviceId" :service-title="serviceTitle"></service-modal>
    <div slot="modal-footer">
	    <b-btn size="lg" variant="primary" @click="closeModalService">
	    	Закрыть
	    </b-btn>
	</div>
</b-modal>