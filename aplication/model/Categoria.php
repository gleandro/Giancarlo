<?php
class Categoria{
	
	private $_id, $_nombre, $_imagen;
	
	public function __construct($id = 0){
		$this->_id = $id;
		
		if($this->_id > 0){
			 
			$sql = " SELECT * FROM categorias WHERE  id_categoria  = '".$this->_id."'";
			
			$query = new Consulta($sql);
			
			if($row = $query->VerRegistro()){ 
				$this->_nombre 	   = $row['nombre_categoria'];
				$this->_imagen 	   = $row['imagen_categoria'];
				$this->_thumb 	   = $row['thumb_categoria'];
				$this->_imgdetalle = $row['imgdetalle_categoria'];
				$this->_parent	   = $row['id_parent'];
			}
		}					
	}
	
	public function __get($attribute){
		return	$this->$attribute;
	}
} ?>