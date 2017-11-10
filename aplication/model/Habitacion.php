<?php
class Habitacion{

	private $_id,
	$_nombre,
	$_cantidad;

	public function __construct($id = 0){

		$this->_id = $id;

		if($this->_id > 0){
			$sql = "SELECT * FROM habitaciones WHERE id_habitacion = '".$this->_id."' ";
			$query = new Consulta($sql);
			if($row = $query->VerRegistro()){
				$this->_nombre =  $row['nombre_habitacion'];
				$this->_cantidad =  $row['cantidad_habitacion'];
			}
		}

	}

	public function __get($attribute){
		return	$this->$attribute;
	}

}
?>
