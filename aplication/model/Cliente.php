<?php
class Cliente{

  private  $_id, $_pais, $_fuente, $_id_nacionalidad, $_nombres, $_documento, $_telefono, $_email, $_sexo;

  public function __construct($id = 0, Idioma $idioma = Null){
    $this->_id = $id;
    $this->_idioma = $idioma;

    if($this->_id > 0){

      $sql = " SELECT * FROM clientes WHERE id_cliente = '".$this->_id."' ";
      $query = new Consulta($sql);
      if($row = $query->VerRegistro()){
         $this->_id =  $row['id_cliente'];
         $this->_pais =  new Fuente ($row['id_pais']);
         $this->_fuente =  new Fuente ($row['id_fuente']);
         $this->_id_nacionalidad =  $row['id_nacionalidad'];
         $this->_nombres =  $row['nombres_cliente'];
         $this->_documento =  $row['documento_cliente'];
         $this->_telefono =  $row['telefono_cliente'];
         $this->_email =  $row['email_cliente'];
         $this->_sexo =  $row['sexo_cliente'];
      }
    }
  }

  public function __get($attribute){
    return	$this->$attribute;
  }
}
?>
