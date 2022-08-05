<?php
class UsuariosModel extends Mysql
{
	private $id_usuario;
	private $nombre_usuario;
	private $paterno_usuario;
	private $materno_usuario;
	private $usuario;
	private $pass;
	private $status;
	
	public function __construct()
	{
			//session_start();
			//$this->db = $_SESSION['basedatos'];
			//$this->getConexion($this->db);
			parent::__construct();
	}
	
	public function selectUsuarios(){
		$sql = "SELECT id_usuario, nombre_usuario, paterno_usuario, materno_usuario, email_usuario, status AS status_usuario  FROM cat_usuarios";
		$request = $this->select_all($sql);
		
		return $request;
		
	}

	public function selectUsuario($id){
		$this->id_usuario = $id;
		$sql = "SELECT id_usuario, nombre_usuario, paterno_usuario, materno_usuario, email_usuario, status,CASE status WHEN 'A' THEN 'ACTIVO' ELSE 'INACTIVO' END AS status_usuario, from_base64(pass)  as pass
		FROM cat_usuarios WHERE id_usuario = $this->id_usuario";
		$request = $this->select($sql);
		return $request;

	}

	public function insertUsuario(string $nombre, string $materno, string $paterno, string $usuario, string $password, string $status){
		$this->nombre_usuario = $nombre;
		$this->paterno_usuario = $paterno;
		$this->materno_usuario = $materno;
		$this->usuario = $usuario;
		$this->pass = $password;
		$this->status = $status;
		
		$return = 0;
		
		$sql = "SELECT * FROM cat_usuarios WHERE 
				email_usuario = '{$this->usuario}' AND pass = to_base64('{$this->pass}') ";
		$request = $this->select_all($sql);

		//insertar el usuario en la bd del usuario
		if(empty($request))
		{
			$query_insert  = "INSERT INTO cat_usuarios(nombre_usuario,paterno_usuario, materno_usuario, email_usuario,pass,status) 
							  VALUES(?,?,?,?,to_base64(?),?)";
        	$arrData = array($this->nombre_usuario,
							$this->paterno_usuario,
							$this->materno_usuario,
    						$this->usuario,
    						$this->pass,
    						$this->status);
        	$request_insert = $this->insert($query_insert,$arrData);
        	
        	$sql = "SELECT LAST_INSERT_ID() AS id_usuario";
			$response = $this->select($sql);
			$this->id_usuario = $response['id_usuario'];
        	$return = $request_insert;
		}else{
			$return = "exist";
		}		

        return $return;
	}

	public function updateUsuario(int $idusuario, string $nombre, string $materno, string $paterno, string $usuario, string $password, string $status){

		$this->id_usuario = $idusuario;
		$this->nombre_usuario = $nombre;
		$this->paterno_usuario = $paterno;
		$this->materno_usuario = $materno;
		$this->usuario = $usuario;
		$this->pass = $password;
		$this->status = $status;		

		$return = 0;
		$return_master = 0;

		$sql = "SELECT * FROM cat_usuarios WHERE (email_usuario = '{$this->usuario}' AND id_usuario != $this->id_usuario)";
		$request = $this->select_all($sql);

		if(empty($request))
		{
		
			$sql = "UPDATE cat_usuarios SET nombre_usuario=?, paterno_usuario=?, materno_usuario=?, email_usuario=?, pass=to_base64(?), status=?
					WHERE id_usuario = $this->id_usuario ";
			$arrData = array($this->nombre_usuario,
							$this->paterno_usuario,
							$this->materno_usuario,
    						$this->usuario,
    						$this->pass,
    						$this->status);
			
			$return = $this->update($sql,$arrData);
			//dep($return);
			//die();
		}else{
			$return = "exist";
		}


		

		return $return;
	
	}


	public function deleteUsuario(int $idusuario)
	{
		$this->id_usuario = $idusuario;		
		$sql = "UPDATE cat_usuarios SET status = ? WHERE id_usuario = $this->id_usuario";
		$arrData = array(0);
		$request = $this->update($sql,$arrData);
		
		return $request;
	}	

}





?>