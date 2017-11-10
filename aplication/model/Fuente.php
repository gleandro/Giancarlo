<?php
class Fuente{

  private  $_id, $_nombre, $_order, $_estado;

  public function __construct($id = 0, Idioma $idioma = Null){
    $this->_id = $id;
    $this->_idioma = $idioma;

    if($this->_id > 0){
        $sql = " SELECT * FROM fuentes WHERE id_fuente = '".$this->_id."' ";
        $query = new Consulta($sql);
        if($row = $query->VerRegistro()){
           $this->_nombre =  $row['nombre_fuente'];
           $this->_order =  $row['order_fuente'];
           $this->_estado =  $row['estado_fuente'];
        }
    }
  }

  public function __get($attribute){
    return	$this->$attribute;
  }
}
?>
