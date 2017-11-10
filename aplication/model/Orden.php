<?php
class Orden{ 

private  $_id, $_nombre, $_fecha, $_order;
public function __construct($id = 0, Idioma $idioma = Null){
$this->_id = $id;
$this->_idioma = $idioma;

if($this->_id > 0){

$sql = " SELECT * FROM ordenes WHERE id_orden = '".$this->_id."' "; 

$query = new Consulta($sql);

if($row = $query->VerRegistro()){ 
 $this->_id =  $row['id_orden']; 
 $this->_nombre =  $row['nombre_orden']; 
 $this->_fecha =  $row['fecha_orden']; 
 $this->_order =  $row['order_orden']; 
}
}
}
public function __get($attribute){
return	$this->$attribute;
}
}
?>