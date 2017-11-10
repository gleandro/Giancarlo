<?php
class Fuentes{

    static public function getFuentes(){
        $sql   = " SELECT * FROM fuentes WHERE estado_fuente=1  ORDER BY order_fuente ASC";
        $query = new Consulta($sql);
        $datos = array();

        while($row = $query->VerRegistro()){
          $datos[] = array(
            'id'    => $row['id_fuente'],
            'nombre'=> $row['nombre_fuente']
          );
        }
        return $datos;
    }

}
