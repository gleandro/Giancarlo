<?php
class Departamento{ 

	private $_id, 
	$_nombre,

	public function __construct($id = 0, Idioma $idioma = Null){
		$this->_id = $id;
		$this->_idioma = $idioma;

		if($this->_id > 0){

			$sql   = "SELECT * FROM paquetes WHERE id_paquete = '".$this->_id."' "; 

			$query = new Consulta($sql);

			if($row = $query->VerRegistro()){ 
				$this->_id =  $row['id_departamento']; 
				$this->_nombre =  $row['nombre_departamento']; 
			}

		}
	}

	

	public function __get($attribute){
		return	$this->$attribute;
	}

}
?>