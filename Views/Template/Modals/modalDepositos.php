<!-- Modal -->
<div class="modal fade" id="modalFormDeposito" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Deposito</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div id="divLoading" >
              <div>
                <img src="<?= media(); ?>/images/loading.svg" alt="Loading">
              </div>
            </div>

            <form id="formDeposito" name="formDeposito" class="form-horizontal">
              <input type="hidden" id="idUsuario" name="idUsuario" value="">
              <p class="text-primary">Todos los campos son obligatorios.</p>

              <div class="form-row">
                <div class="form-group col-md-10">
                  <label for="txtNombreUsuario">Nombre Usuario</label>
                  <input type="text" class="form-control valid" id="txtNombreUsuario" name="txtNombreUsuario" required="">
                </div>                
              </div>

              <div class="form-row">
                <div class="form-group col-md-10">
                  <label for="txtSaldo">Saldo</label>
                  <input type="text" class="form-control valid" id="txtSaldo" name="txtSaldo" required="" readonly>
                </div>                
              </div>

              <div class="form-row">
                <div class="form-group col-md-10">
                  <label for="txtImporte">Importe</label>
                  <input type="text" class="form-control valid" id="txtImporte" name="txtImporte" required="" onkeypress="return validarPrecio(event);">
                </div>                
              </div>                      
              
             <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtNuevoSaldo">Nuevo Saldo</label>
                  <input type="text" class="form-control valid" id="txtNuevoSaldo" name="txtNuevoSaldo" required="" readonly>
                </div>                
              </div>

        

              <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
            </form>
      </div>
    </div>
  </div>
</div>