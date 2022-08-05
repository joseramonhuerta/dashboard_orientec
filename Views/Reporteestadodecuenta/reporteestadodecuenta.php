<?php
    headerAdmin($data);
?>

<main class="app-content">    
  <div class="app-title">
    <div>
        <h1><i class="fas fa fa-chart-line"></i> <?= $data['page_title'] ?></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>/reporteestadodecuenta"><?= $data['page_title'] ?></a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="card">
            <div class="card-header">
              Reporte Estado De Cuenta
            </div>
            <div class="card-body">
            <div id="divLoading" >
              <div>
                <img src="<?= media(); ?>/images/loading.svg" alt="Loading">
              </div>
            </div>
            <form id="formReporteEstadoDeCuenta">
              <div class="row">
                
                <div class="col-lg-2">
                  <label for="">Fecha Inicio</label>
                  <input type="text"  class="form-control valid validText" id="txtFechaInicio" name="txtFechaInicio" readonly="">
                </div>
                <div class="col-lg-2">
                  <label for="">Fecha Fin</label>
                  <input type="text"  class="form-control valid validText" id="txtFechaFin" name="txtFechaFin" readonly="">
                </div>

                <div class="col-lg-6">
                  <label for="">Usuario</label>
                  <select name="select_usuario" id="select_usuario" class="form-control"></select>
                </div>

                <div class="col-lg-2">
                  <label for="">&nbsp;</label><br> 
                  <button id="btnBuscar" type="submit" class="btn btn-danger">BUSCAR</button>
                </div>

                <div class="col-lg-12">
                &nbsp;
                </div>
            
                <div class="col-md-12">
                  <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableReporteEstadoDeCuenta">
                          <thead>
                            <tr>
                              <th>Fecha</th>
                              <th>Concepto</th>
                              <th>Tipo</th>
                              <th>Cargo</th>
                              <th>Abono</th>
                              <th>Saldo</th>  
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                                                 
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    
                </div>
              </div>
              </form>  
            </div>  
          </div>           
        </div>
      </div>
    </div>
  </div>
   
</main>

<?php
    footerAdmin($data);
?>