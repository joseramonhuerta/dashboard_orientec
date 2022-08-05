<?php headerAdmin($data); ?>

<main class="app-content">
  <div class="app-title">
    <div>
      <h1>
        <i class="fas fa-chart-pie"></i><?= $data['page_title']; ?>
      </h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>/cursos"><?= $data['page_title']; ?></a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="card">
            <div class="card-header">
              Cursos Vendidos
            </div>
            <div class="card-body">
            <div id="divLoading" >
              <div>
                <img src="<?= media(); ?>/images/loading.svg" alt="Loading">
              </div>
            </div>
            <form id="formReporteGraficas">
              <div class="row">
                
                <div class="col-lg-5">
                  <label for="">Mes</label>
                  <select name="select_mes" id="select_mes" class="form-control"></select>
                </div>
                <div class="col-lg-5">
                  <label for="">Año</label>
                  <select name="select_anio" id="select_anio" class="form-control"></select>
                </div>
                <div class="col-lg-2">
                  <label for="">&nbsp;</label><br> 
                  <button id="btnBuscar" type="submit" class="btn btn-danger">BUSCAR</button>
                </div>

                <div class="col-lg-12">
                  
                </div>
            
                <div class="col-lg-5">
                <canvas id="myChart" width="100" height="100"></canvas>
                </div>
                <div class="col-lg-1">
                  
                </div>
                <div class="col-lg-5">
                <canvas id="myChartIngreso" width="100" height="100"></canvas>
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

<?php footerAdmin($data); ?>