<b-modal size="lg" id="modal-article" class="modal-h1" centered title="Новости">
    <article-info :article="article"></article-info>
    <div slot="modal-footer">
	    <b-btn size="lg" variant="primary" @click="closeModalArticle">
	    	Закрыть
	    </b-btn>
	</div>
</b-modal>