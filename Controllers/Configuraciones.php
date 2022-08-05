<?php
class Configuraciones extends Controllers{
    public function __construct(){
        session_start();
        if(empty($_SESSION['login'])){
            header('Location:'.base_url().'/login');
        }
        parent::__construct();
    }

    public function Configuraciones(){
        $data['page_tag'] = "Configuraciones";
        $data['page_title'] = "Configuraciones <small>Orientec</small>";
        $data['page_name'] = "configuraciones";
        $data['page_functions_js'] = "functions_configuraciones.js";
        $this->views->getView($this, "configuraciones", $data);
    }

    public function getConfiguracion(){
        $arrData = $this->model->selectConfiguracion();
        if(empty($arrData)){
            $arrResponse = array('success' => false, 'msg' => 'Datos no encontrados.');
        }else{
            $arrResponse = array('success' => true, 'data' => $arrData);
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

        die();
    }

    public function setConfiguracion(){
        if($_POST){
            if(empty($_POST['idConfiguracion'])){
               $arrResponse = array('success' => false, 'msg' => 'Datos incorrectos.');     
            }else{
               $idConfiguracion = intval($_POST['idConfiguracion']);
               $beneficiario = ucwords(strClean($_POST['txtBeneficiario'])); 
               $numero_cuenta = ucwords(strClean($_POST['txtNumeroCuenta']));
               $leyenda_pago = ucwords(strClean($_POST['txtLeyendaPago']));  
               $codigo_registro = ucwords(strClean($_POST['txtCodigoRegistro']));  
               $comision = doubleval($_POST['txtComision']);

               $request = $this->model->updateConfiguracion( $idConfiguracion, $beneficiario, $numero_cuenta, $leyenda_pago, $codigo_registro, $comision);
                
               if($request > 0){
                    $arrResponse = array('success' => true, 'msg' => 'Datos guardados correctamente.');
               }else{
                    $arrResponse = array('success' => false, 'msg' => 'No es posible almacenar los datos.');
               }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function setImagen(){

        if($_FILES){            
            if(empty($_FILES['txtImagen'])){
                $arrResponse = array('success' => false, 'msg' => 'Datos incorrectos.');
            }else{
                $tipo_imagen = intval($_POST['tipo_imagen']);
                $fecha = new DateTime();
                $nombreArchivo = $fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"];
                
                if($tipo_imagen == 1)
                    $urlArchivo = "ws/manualesapp/images/carrucel/".$nombreArchivo;                
                else     
                    $urlArchivo = "ws/manualesapp/images/banner/".$nombreArchivo;  

                $tmpFoto = $_FILES["txtImagen"]["tmp_name"];
                
                if($tipo_imagen == 1){
                    $request = $this->model->insertImagenCarrucel($nombreArchivo, $urlArchivo, $tmpFoto);
                }else{
                    $request = $this->model->insertImagenBanner($nombreArchivo, $urlArchivo, $tmpFoto);    
                }                

                if($request > 0){
                    $arrResponse = array('success' => true, 'msg' => 'Datos guardados correctamente');        
                }else{
                    $arrResponse = array('success' => false, 'msg' => 'No es posible almacenar los datos'.$request);    
                }                
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();

    }

    public function getImagenesCarrucel(){
        $arrData = $this->model->selectImagenesCarrucel();        

        for($i=0; $i < count($arrData); $i++){
            $btnDelete = '';

			if($arrData[$i]['status_imagen'] == 'A'){
				$arrData[$i]['status_imagen'] = '<span class="badge badge-success">Activo</span>';	
			}else{
				$arrData[$i]['status_imagen'] = '<span class="badge badge-danger">Inactivo</span>';	
			}

            $arrData[$i]['imagen'] = '<img src="ws/manualesapp/images/carrucel/'.$arrData[$i]['imagen_carrucel'].'" alt="" width="100px"/>';	

			$btnDelete = '<button class="btn btn-danger btn-sm btnDelImagenCarrucel" onClick="fntDelImagenCarrucel('.$arrData[$i]['id_carrucel'].')" title="Eliminar Imagen Carrucel"><i class="far fa-trash-alt"></i></button>';
			$arrData[$i]['options'] = '<div class="text-center">'.$btnDelete.'</div>';	
        }

        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
    }

    public function delImagenCarrucel(){
        if($_POST){
            $id_carrucel = intval($_POST['idCarrucel']);
			$requestDelete = $this->model->deleteImagenCarrucel($id_carrucel);
			if($requestDelete)
			{
				$arrResponse = array('success' => true, 'msg' => 'Imagen desactivada correctamente.');
			}else{
				$arrResponse = array('success' => false , 'msg' => 'Error al desactivar la imagen.');
			}
			
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);	

        }
        die();
    }

    public function getImagenesBanner(){
        $arrData = $this->model->selectImagenesBanner();        

        for($i=0; $i < count($arrData); $i++){
            $btnDelete = '';

			if($arrData[$i]['status_imagen'] == 'A'){
				$arrData[$i]['status_imagen'] = '<span class="badge badge-success">Activo</span>';	
			}else{
				$arrData[$i]['status_imagen'] = '<span class="badge badge-danger">Inactivo</span>';	
			}

            $arrData[$i]['imagen'] = '<img src="ws/manualesapp/images/banner/'.$arrData[$i]['imagen_banner'].'" alt="" width="100px"/>';	

			$btnDelete = '<button class="btn btn-danger btn-sm btnDelImagenBanner" onClick="fntDelImagenBanner('.$arrData[$i]['id_banner'].')" title="Eliminar Imagen Banner"><i class="far fa-trash-alt"></i></button>';
			$arrData[$i]['options'] = '<div class="text-center">'.$btnDelete.'</div>';	
        }

        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
    }

    public function delImagenBanner(){
        if($_POST){
            $id_banner = intval($_POST['idBanner']);
			$requestDelete = $this->model->deleteImagenBanner($id_banner);
			if($requestDelete)
			{
				$arrResponse = array('success' => true, 'msg' => 'Imagen desactivada correctamente.');
			}else{
				$arrResponse = array('success' => false , 'msg' => 'Error al desactivar la imagen.');
			}
			
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);	

        }
        die();
    }

}
?>