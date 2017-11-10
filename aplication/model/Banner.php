<?php
private  $_id, $_titulo, $_titulo_principal, $_titulo_secundario, $_final_titulo, $_imagen, $_thumb, $_order;
public function __construct($id = 0, Idioma $idioma = Null){
    $this->_id = $id;
    $this->_idioma = $idioma;

    if($this->_id > 0){

        $sql = " SELECT * FROM banners WHERE id_banner = '".$this->_id."' "; 

        $query = new Consulta($sql);

        if($row = $query->VerRegistro()){ 
             $this->_id =  $row['id_banner']; 
             $this->_titulo =  $row['titulo_banner']; 
             $this->_titulo_principal =  $row['titulo_principal_banner']; 
             $this->_titulo_secundario =  $row['titulo_secundario_banner']; 
             $this->_final_titulo =  $row['final_titulo_banner']; 
             $this->_imagen =  $row['imagen_banner']; 
             $this->_thumb =  $row['thumb_banner']; 
             $this->_order =  $row['order_banner']; 
        }
    }
}
public function __get($attribute){
    return	$this->$attribute;
}
}
?>