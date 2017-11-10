<?php
class Noticia{ 

private  $_id, $_titulo, $_descripcion, $_fecha, $_image, $_order;
public function __construct($id = 0, Idioma $idioma = Null){
    $this->_id = $id;
    $this->_idioma = $idioma;

    if($this->_id > 0){

        $sql = " SELECT * FROM noticias WHERE id_noticia = '".$this->_id."' "; 

        $query = new Consulta($sql);

        if($row = $query->VerRegistro()){ 
             $this->_id =  $row['id_noticia']; 
             $this->_titulo =  $row['titulo_noticia']; 
             $this->_descripcion =  $row['descripcion_noticia']; 
             $this->_fecha =  $row['fecha_noticia']; 
             $this->_image =  $row['image_noticia']; 
             $this->_order =  $row['order_noticia']; 
        }
    }
}
public function __get($attribute){
    return	$this->$attribute;
}
}
?>