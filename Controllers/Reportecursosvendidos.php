<?php
class Reportecursosvendidos extends Controllers{
    public function __construct(){
        session_start();
        if(empty($_SESSION['login']))
        {
            header('Location: '.base_url().'/login');
        }
        parent::__construct();
    }

    public function Reportecursosvendidos(){
        $data['page_tag'] = "Reporte Cursos Vendidos";
        $data['page_title'] = "Reporte Cursos Vendidos";
        $data['page_name'] = "reportecursosvendidos";
        $data['page_functions_js'] = "functions_reportecursosvendidos.js";
        $this->views->getView($this, "reportecursosvendidos", $data);
    }

    public function getReporteCursosVendidos(){
        $arrData = $this->model->selectCursosVendidos();
        
        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
    }
    
}



