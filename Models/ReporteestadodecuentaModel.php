<?php
class ReporteestadodecuentaModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function selectUsuariosEstadoDeCuenta()
    {
        $sql = "SELECT id_usuario, CONCAT(nombre_usuario, ' ', paterno_usuario, ' ', materno_usuario) AS nombre_usuario FROM cat_usuarios WHERE tipo_usuario = 1";
            
        $request = $this->select_all($sql);

        return $request;

    }

    public function getEstadoDeCuenta($fechainicio, $fechafin, $id_usuario)
    {
        $sql = "SELECT fecha, concepto, CASE tipo WHEN 1 THEN 'Cargo' WHEN 2 THEN 'Abono' END AS tipo, cargo, abono, saldo FROM cat_usuarios_estadocuenta ue
        INNER JOIN cat_usuarios u ON u.id_usuario = ue.id_usuario
        WHERE (ue.fecha BETWEEN '$fechainicio' AND '$fechafin') AND ue.id_usuario = $id_usuario
        ORDER BY fecha ASC, id_usuario_estadocuenta ASC";

        $request = $this->select_all($sql);

        return $request;
    }
}


?>