<!-- Modal -->
<div class="modal fade" id="modalFormImagenes" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Subir Imagen</h5>
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
            <form action="" id="formImagenes" name="formImagenes" class="form-horizontal" enctype="multipart/form-data" method="post">
              <input type="hidden" id="tipo_imagen" name="tipo_imagen" value="">
              
              <div class="form-row">
                <div class="form-group col-md-10">
                  <label for="txtImagen">Seleccione imagen</label>
                  <input type="file" class="form-control valid" id="txtImagen" name="txtImagen" required="" accept="image/jpg, image/jpeg, image/png">
                </div>                
              </div>
              

              <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-primary" type="submit" ><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
            </form>
      </div>
    </div>
  </div>
</div>