<?php
class ReportecursosvendidosModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function selectCursosVendidos()
    {
        $sql = " SELECT m.nombre_manual, u.nombre_usuario, COUNT(um.id_usuario_manual) AS cantidad
                FROM cat_usuarios_manuales um 
                INNER JOIN cat_manuales m ON um.id_manual = m.id_manual
                INNER JOIN cat_usuarios u ON u.id_usuario = m.id_usuario_creador
                WHERE um.autorizado = 1
                GROUP BY m.nombre_manual, u.nombre_usuario";

        $request = $this->select_all($sql);

        return $request;
    }
    

}

