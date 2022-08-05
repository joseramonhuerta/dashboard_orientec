<?php
headerAdmin($data);
getModal('modalImagenes',$data);
?>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>
        <i class="fa fa-gears"></i> <?= $data['page_title'] ?>
      </h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>/cursos"><?= $data['page_title'] ?></a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
    <div class="card">
      <h5 class="card-header">Configuraciones Generales</h5>
        <div class="card-body">
          <div id="divLoading">
            <div>
              <img src="<?= media(); ?>/images/loading.svg" alt="Loading">
            </div>
          </div>
          <form id="formConfiguracion" name="formConfiguracion" class="form-horizontal">
            <input type="hidden" id="idConfiguracion" name="idConfiguracion" value="">
            <p class="text-primary">Todos los campos son obligatorios.</p>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="txtBeneficiario">Beneficiario</label>
                <input type="text" class="form-control valid" id="txtBeneficiario" name="txtBeneficiario" required="">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="txtNumeroCuenta">Cuenta Bancaria</label>
                <input type="text" class="form-control valid" id="txtNumeroCuenta" name="txtNumeroCuenta" required="">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="txtLeyendaPago">Leyenda Pago</label>
                <textarea class="form-control valid" id="txtLeyendaPago" rows="3" name="txtLeyendaPago" required=""></textarea>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="txtCodigoRegistro">Código Registro</label>
                <input type="text" class="form-control valid" id="txtCodigoRegistro" name="txtCodigoRegistro" required="">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="txtComision">Comisión</label>
                <input type="text" class="form-control valid" id="txtComision" name="txtComision" required="">
              </div>
            </div>

            <div class="tile-footer">
              <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
  
  <br />
  <div class="row">
    <div class="col-md-12">
      <div class="card">
      <h5 class="card-header">Imagenes Carrucel</h5>
        <div class="card-body">
          
        <button class="btn btn-primary" type="button" onclick="openModalImagenes(1);" ><i class="fas fa-plus-circle"></i> Nueva imagen</button>     
        <br />
        <br />
        <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableCarrucel">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Imagen</th>
                      <th>Nombre imagen</th>
                      <th>Estatus</th>
                      <th>Acciones</th>  
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Imagen</td>
                      <td>Nombre de la imagen</td>
                      <td>Activo</td>
                      <td></td>                          
                    </tr>
                  </tbody>
                </table>
              </div>
        </div>
      </div>
    </div>
  </div>

  <br />
  <div class="row">
    <div class="col-md-12">
      <div class="card">
      <h5 class="card-header">Imagenes Banner</h5>
        <div class="card-body">
          
        <button class="btn btn-primary" type="button" onclick="openModalImagenes(2);" ><i class="fas fa-plus-circle"></i> Nueva imagen</button>     
        <br />
        <br />
        <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableBanner">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Imagen</th>
                      <th>Nombre imagen</th>
                      <th>Estatus</th>
                      <th>Acciones</th>  
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Imagen</td>
                      <td>Nombre de la imagen</td>
                      <td>Activo</td>
                      <td></td>                          
                    </tr>
                  </tbody>
                </table>
              </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php footerAdmin($data); ?>