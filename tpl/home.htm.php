<div class="container" id="cont-photo">
	<div class="row">
		<div class="col-sm-6 p-0 p-sm-4">
			<img src="<?php echo $Img_URL; ?>" class="img-fluid" id="instagram-image">
		</div>
		<div class="col-sm-6 p-4 text-center">
			<h3 class="d-sm-block">Se vedessi questa immagine su Instagram, prenderesti in giro chi l'ha postata?</h3>
			<form method="post" action="?action=submit" id="photo-form">
				<div class="btn btn-danger btn-lg btn-disabled" id="btn-si">Sì</div>
				<div class="btn btn-info btn-lg btn-disabled" id="btn-no" data-confirmed="false">No</div>
				<input type="hidden" id="ret-value" name="value" value="0" />
				<input type="hidden" id="ret-comment" name="comment" value="" />
				<input type="hidden" name="id" value="<?php echo $Img_id; ?>" />
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Inserisci testo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <p>Perché prenderesti in giro questo utente?</p>
          <div id="radio-value">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="s-value" id="radio-1" value="-1" checked>
              <label class="form-check-label" for="radio-1">
                [Selezionare]
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="s-value" id="radio1" value="1">
              <label class="form-check-label" for="radio1">
                Forma fisica
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="s-value" id="radio2" value="2">
              <label class="form-check-label" for="radio2">
                Abbigliamento
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="s-value" id="radio3" value="3">
              <label class="form-check-label" for="radio3">
                Posa
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="s-value" id="radio4" value="4">
              <label class="form-check-label" for="radio4">
                Espressione
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="s-value" id="radio5" value="5">
              <label class="form-check-label" for="radio5">
                Location
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="s-value" id="radio6" value="6">
              <label class="form-check-label" for="radio6">
                Attività
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="s-value" id="radio100" value="100">
              <label class="form-check-label" for="radio100">
                Altro
              </label>
            </div>
          </div>

<!--           <div class="form-group">
            <label for="select-value" class="col-form-label">Tipologia:</label>
    		    <select class="form-control" id="select-value">
    		      <option selected="selected" value="-1">[Selezionare]</option>
              <option value="1">Forma fisica</option>
              <option value="2">Abbigliamento</option>
              <option value="3">Posa</option>
              <option value="4">Espressione</option>
              <option value="5">Location</option>
              <option value="6">Attività</option>
              <option value="100">Altro</option>
    		    </select>
    		  </div>
 -->          
          <div class="form-group">
            <label for="message-text" class="col-form-label">Cosa scriveresti?</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
        <button type="button" class="btn btn-primary" data-confirmed="false" id="btn-confirm">Conferma</button>
      </div>
    </div>
  </div>
</div>
