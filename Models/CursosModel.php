<?php
class CursosModel extends Mysql{
    public function __construct(){
        parent::__construct();
    }


    public function selectCursos()
    {
        $sql = "SELECT m.id_manual, m.nombre_manual, m.descripcion_manual, m.paginas, m.precio, m.esgratuito,
        CASE m.tipo WHEN 1 THEN 'Manual' WHEN 2 THEN 'Video' WHEN 3 THEN 'Asesoria' END AS descripcion_tipo, c.nombre_categoria AS descripcion_categoria,
        m.status AS status_manual
        FROM cat_manuales m
        INNER JOIN cat_categorias c ON c.id_categoria = m.id_categoria";        
        $request = $this->select_all($sql);
        //var_dump($request);
        return $request; 
    }

    public function selectCursosVendidos($month, $year)
    {
        //dep($_POST);
        if($month > 0){
            $where = " WHERE autorizado = 1 AND MONTH(fecha) = $month AND YEAR(fecha) = $year ";                
        }else{
            $where = " WHERE autorizado = 1 AND YEAR(fecha) = $year ";
        }

        $sql = "SELECT MONTH(fecha) AS color,CASE MONTH(fecha) 
        WHEN 1 THEN 'ENERO' 
        WHEN 2 THEN 'FEBRERO'
        WHEN 3 THEN 'MARZO' 
        WHEN 4 THEN 'ABRIL' 
        WHEN 5 THEN 'MAYO' 
        WHEN 6 THEN 'JUNIO' 
        WHEN 7 THEN 'JULIO' 
        WHEN 8 THEN 'AGOSTO' 
        WHEN 9 THEN 'SEPTIEMBRE' 
        WHEN 10 THEN 'OCTUBRE' 
        WHEN 11 THEN 'NOVIEMBRE' 
        WHEN 12 THEN 'DICIEMBRE' END AS mes, COUNT(id_usuario_manual) AS cantidad, SUM(importe) AS importe FROM cat_usuarios_manuales";
        $sql .= $where;
        $sql .= " GROUP BY MONTH(fecha)";
        //var_dump($sql);
        $request = $this->select_all($sql);
        return $request;
    }

}


