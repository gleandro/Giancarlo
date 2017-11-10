<?php
class Contacto{ 

	private  $_id, $_nombre, $_apellido, $_telefono, $_email, $_tipo_contacto;

	public function __construct($id = 0, Idioma $idioma = Null){
		$this->_id = $id;
		$this->_idioma = $idioma;

		if($this->_id > 0){

			$sql = " SELECT * FROM contactos c INNER JOIN tipos_contactos tc ON c.id_tipo_contacto=tc.id_tipo_contacto WHERE c.id_contacto = '".$this->_id."' "; 

			$query = new Consulta($sql);

			if($row = $query->VerRegistro()){ 
				$this->_id =  $row['id_contacto']; 
				$this->_nombre =  $row['nombre_contacto']; 
				$this->_apellido =  $row['apellidos_contacto']; 
				$this->_telefono =  $row['telefono_contacto']; 
				$this->_email =  $row['email_contacto']; 
			}
		}
	}

	

	public function __get($attribute){
		return	$this->$attribute;
	}
}
?>