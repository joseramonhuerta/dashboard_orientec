<?php
class ConfiguracionesModel extends Mysql{
    public function __construct(){
        parent::__construct();
    }

    public function selectConfiguracion(){
        $sql = "SELECT id_configuracion, beneficiario, numero_cuenta, leyenda_pago_oxxo, codigo_registro, comision FROM cat_configuraciones_app WHERE status = 'A' LIMIT 1";
        $request = $this->select($sql);
        return $request;    
    }

    public function updateConfiguracion(int $id_configuracion, string $beneficiario, string $numero_cuenta, string $leyenda_pago_oxxo, string $codigo_registro, float $comision){
        $return = 0;
        $sql = "UPDATE cat_configuraciones_app 
                SET beneficiario = ?, numero_cuenta = ?, leyenda_pago_oxxo = ?, codigo_registro = ?, comision = ?
				WHERE id_configuracion = $id_configuracion ";
        $arrData = array($beneficiario, $numero_cuenta, $leyenda_pago_oxxo, $codigo_registro, $comision);
        
        $request = $this->update($sql, $arrData); 
        
        return $request;
    }

    public function insertImagenCarrucel(string $nombreArchivo, string $urlArchivo, string $tmpFoto){
        $return = 0;     
        
        if($tmpFoto != ""){
            move_uploaded_file($tmpFoto, $urlArchivo);

            $sql = "INSERT INTO carrucel(descripcion_carrucel, imagen_carrucel, url_carrucel, orden, status)
            VALUES(?,?,?,?,?)";

            $arrData = array($nombreArchivo,$nombreArchivo,$nombreArchivo, '1', 'A');

            $request_insert = $this->insert($sql, $arrData);

            $return = $request_insert;
        }       

        return $return;   
        
    }

    public function selectImagenesCarrucel()
    {
        $sql = "SELECT id_carrucel, descripcion_carrucel, imagen_carrucel, url_carrucel, orden, status AS status_imagen
        FROM carrucel
        WHERE status = 'A'
        ORDER BY orden";        
        $request = $this->select_all($sql);
        //var_dump($request);
        return $request; 
    }

    public function deleteImagenCarrucel(int $idcarrucel)
	{
		$sql = "UPDATE carrucel SET status = ? WHERE id_carrucel = $idcarrucel";
		$arrData = array('I');
		$request = $this->update($sql,$arrData);
		
		return $request;
	}	

    public function insertImagenBanner(string $nombreArchivo, string $urlArchivo, string $tmpFoto){
        $return = 0;     
        
        if($tmpFoto != ""){
            move_uploaded_file($tmpFoto, $urlArchivo);

            $sql = "INSERT INTO banner(descripcion_banner, imagen_banner, url_banner, status)
            VALUES(?,?,?,?)";

            $arrData = array($nombreArchivo,$nombreArchivo,$nombreArchivo, 'A');

            $request_insert = $this->insert($sql, $arrData);

            $return = $request_insert;
        }       

        return $return;   
        
    }

    public function selectImagenesBanner()
    {
        $sql = "SELECT id_banner, descripcion_banner, imagen_banner, url_banner, status AS status_imagen
        FROM banner
        WHERE status = 'A'
        ORDER BY id_banner";        
        $request = $this->select_all($sql);
        //var_dump($request);
        return $request; 
    }

    public function deleteImagenBanner(int $idbanner)
	{
		$sql = "UPDATE banner SET status = ? WHERE id_banner = $idbanner";
		$arrData = array('I');
		$request = $this->update($sql,$arrData);
		
		return $request;
	}	
}

