<?php
class DepositosModel extends Mysql{
    public function __construct(){
        parent::__construct();
    }

    public function selectUsuariosDepositos(){
        $sql = "SELECT u.id_usuario,CONCAT(u.nombre_usuario,' ',u.paterno_usuario,' ',IFNULL(u.materno_usuario,'')) AS nombre_usuario, 
        IFNULL((SELECT  IFNULL(saldo,0) FROM cat_usuarios_estadocuenta
        WHERE id_usuario = u.id_usuario
        ORDER BY fecha DESC
        LIMIT 1),0) AS saldo
        FROM cat_usuarios u
        ORDER BY u.id_usuario";

        $request = $this->select_all($sql);

        return $request;
    }

    public function selectUsuarioDeposito($id){
		$this->id_usuario = $id;
		$sql = "SELECT u.id_usuario, CONCAT(u.nombre_usuario,' ',u.paterno_usuario,' ',IFNULL(u.materno_usuario,'')) AS nombre_usuario,IFNULL(ue.saldo,0) AS saldo
		FROM cat_usuarios_estadocuenta ue
        RIGHT JOIN cat_usuarios u on u.id_usuario = ue.id_usuario
        WHERE u.id_usuario = $this->id_usuario
        ORDER BY fecha DESC
        LIMIT 1";
		$request = $this->select($sql);
		return $request;

	}

    public function insertDeposito(int $idUsuario, float $importe, float $nuevoSaldo){
        $return = 0;
        $today = date('Y-m-d H:i:s');
        $query = "INSERT INTO cat_usuarios_estadocuenta(id_usuario, fecha, concepto, tipo, cargo, abono,saldo)
        VALUES(?,?,?,?,?,?,?)";
        $arrData = array($idUsuario, $today, 'Abono - Pago de comisiones',2,'0.00',$importe,$nuevoSaldo);
        $request = $this->insert($query, $arrData);
        $return = $request;

        return $return;
    }


}




?>