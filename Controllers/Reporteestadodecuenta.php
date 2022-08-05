<?php
class Reporteestadodecuenta extends Controllers{
    public function __construct(){
        session_start();
        if(empty($_SESSION['login']))
        {
            header('Location: '.base_url().'/login');
        }
        parent::__construct();
    }

    public function Reporteestadodecuenta(){
        $data['page_tag'] = "Reporte Estado De Cuenta";
		$data['page_title'] = "Reporte Estado De Cuenta";
		$data['page_name'] = "reporteestadodecuenta";
		$data['page_functions_js'] = "functions_reporteestadodecuenta.js";		
		$this->views->getView($this, "reporteestadodecuenta",$data);
    }

    public function getUsuariosEstadoDeCuenta(){
        $arrData = $this->model->selectUsuariosEstadoDeCuenta();
        if(empty($arrData)){
            $arrResponse = array('success' => false, 'msg' => 'Datos no encontrados');
        }else{
            $arrResponse = array('success' => true, 'data' => $arrData);
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        
		die();
    }

    public function getReporteEstadoDeCuenta(){
        //dep($_POST);
        if($_POST) {
            $fechainicio = date_create_from_format('d/m/Y', $_POST['txtFechaInicio']);
            $fechainicio = date_format($fechainicio, 'Y-m-d');           
            $fechainicio.= ' 00:00:00';

            $fechafin = date_create_from_format('d/m/Y', $_POST['txtFechaFin']);
            $fechafin = date_format($fechafin, 'Y-m-d');     
            $fechafin.= ' 23:59:59';
            $id_usuario = intval($_POST['select_usuario']);
            //dep($fechainicio);
            $arrData = $this->model->getEstadoDeCuenta($fechainicio, $fechafin, $id_usuario);

            if(empty($arrData)){
				$arrResponse = array('success' => false, 'msg' => 'Datos no encontrados');
			}else{
				$arrResponse = array('success' => true, 'data' => $arrData);
			}	
            
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        
            
        }
        
        die();
    }
}

?>