<?php
private  $_id, $_nombre, $_imagen, $_fecha, $_order;
public function __construct($id = 0, Idioma $idioma = Null){
    $this->_id = $id;
    $this->_idioma = $idioma;

    if($this->_id > 0){

        $sql = " SELECT * FROM accesorios WHERE id_accesorio = '".$this->_id."' "; 

        $query = new Consulta($sql);

        if($row = $query->VerRegistro()){ 
             $this->_id =  $row['id_accesorio']; 
             $this->_nombre =  $row['nombre_accesorio']; 
             $this->_imagen =  $row['imagen_accesorio']; 
             $this->_fecha =  $row['fecha_accesorio']; 
             $this->_order =  $row['order_accesorio']; 
        }
    }
}
public function __get($attribute){
    return	$this->$attribute;
}
}
?>