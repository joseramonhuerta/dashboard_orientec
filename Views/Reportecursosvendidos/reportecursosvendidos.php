<?php
    headerAdmin($data);    
?>

<main class="app-content">    
  <div class="app-title">
    <div>
        <h1><i class="fas fa fa-file-invoice-dollar"></i> <?= $data['page_title'] ?></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>/reportecursosvendidos"><?= $data['page_title'] ?></a></li>
    </ul>
  </div>
    <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableCursosVendidos">
                  <thead>
                    <tr>
                      <th>Nombre Curso</th>
                      <th>Usuario</th>
                      <th>Cantidad</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Curso</td>
                      <td>Usuario</td>
                      <td>1</td>                          
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
</main>




<?php
    footerAdmin($data);
?>

