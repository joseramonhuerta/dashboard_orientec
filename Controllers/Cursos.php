<?php
class Cursos extends Controllers{
    public function __construct(){
        session_start();
		if(empty($_SESSION['login']))
		{
			header('Location: '.base_url().'/login');
			die();
		}
		parent::__construct();
    }

    public function Cursos(){
        $data['page_tag'] = "Cursos";
		$data['page_title'] = "Cursos <small>Orientec</small>";
		$data['page_name'] = "cursos";
		$data['page_functions_js'] = "functions_cursos.js";		
		$this->views->getView($this, "cursos",$data);
    }

    public function getCursos(){
        $arrData = $this->model->selectCursos();        

        for($i=0; $i < count($arrData); $i++){
            $btnView = '';
			$btnEdit = '';
			$btnDelete = '';

			if($arrData[$i]['status_manual'] == 'A')
			{
				$arrData[$i]['status_manual'] = '<span class="badge badge-success">Activo</span>';	
			}else{
				$arrData[$i]['status_manual'] = '<span class="badge badge-danger">Inactivo</span>';	
			}

			$btnView = '<button class="btn btn-info btn-sm btnViewManual" onClick="fntViewManual('.$arrData[$i]['id_manual'].')" title="Ver manual"><i class="far fa-eye"></i></button>';
			$btnEdit = '<button class="btn btn-primary  btn-sm btnEditManual" onClick="fntEditManual(this,'.$arrData[$i]['id_manual'].')" title="Editar manual"><i class="fas fa-pencil-alt"></i></button>';
			$btnDelete = '<button class="btn btn-danger btn-sm btnDelManual" onClick="fntDelManual('.$arrData[$i]['id_manual'].')" title="Eliminar manual"><i class="far fa-trash-alt"></i></button>';
			$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';	
        }

        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();

    }

	public function getReporteCursosVendidos()
	{
		if($_POST){			
			$intMes  =  intval($_POST['select_mes']);
			$intYear =  intval($_POST['select_anio']);
			$arrData = $this->model->selectCursosVendidos($intMes, $intYear);
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