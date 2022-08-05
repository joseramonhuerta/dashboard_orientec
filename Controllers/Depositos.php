<?php
class Depositos extends Controllers{
    public function __construct(){
        session_start();
        if(empty($_SESSION['login'])){
            header('Location: '.base_url().'/login');
        }
        parent::__construct();
    }

    public function Depositos(){
        $data['page_tag'] = "Depositos";
		$data['page_title'] = "Depositos <small>Orientec</small>";
		$data['page_name'] = "depositos";
		$data['page_functions_js'] = "functions_depositos.js";		
		$this->views->getView($this, "depositos",$data);
    }

    public function getUsuariosDepositos(){        

        $arrData = $this->model->selectUsuariosDepositos();        

        for($i=0; $i < count($arrData); $i++){
            $btnView = '';			

			$btnView = '<button class="btn btn-info btn-sm btnDepositar" onClick="fntDepositar('.$arrData[$i]['id_usuario'].')" title="Depositar">Depositar</button>';
			
			$arrData[$i]['options'] = '<div class="text-center">'.$btnView.'</div>';	
        }

        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
    }

    public function getUsuarioDeposito($id){
        $id_usuario = $id;
		if($id_usuario > 0){
			$arrData = $this->model->selectUsuarioDeposito($id_usuario);
			if(empty($arrData)){
				$arrResponse = array('success' => false, 'msg' => 'Datos no encontrados');
			}else{
				$arrResponse = array('success' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
    }

    public function setDeposito(){
        if($_POST){
            if(empty($_POST['idUsuario']) || empty($_POST['txtImporte'])){
                $arrResponse = array("success" => false, "msg" => 'Datos incorrectos.');	
            }else{
                $idUsuario = intval($_POST['idUsuario']);    
                $importe = doubleval($_POST['txtImporte']);
                $nuevoSaldo = doubleval($_POST['txtNuevoSaldo']);

                $request = $this->model->insertDeposito($idUsuario,$importe,$nuevoSaldo);

                if($request > 0){
                    $arrResponse = array("success" => true, "msg" => 'Datos guardados correctamente.');
                }else{
                    $arrResponse = array("success" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }

            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}


?>