<?php

 class Counter{

 	private $_id,
 	$_rol,
 	$_nombre,
 	$_apellido,
 	$_dni,
 	$_email,
  $_foto,
 	$_login,
 	$_password,
 	$_fecha;

	public function __construct($id = 0, Idioma $idioma = Null){

		$this->_id = $id;
		$this->_idioma = $idioma;

		if($this->_id > 0){
			$sql   = "SELECT * FROM usuarios INNER JOIN roles USING(id_rol) WHERE id_usuario='".$this->_id."' ";
			$query = new Consulta($sql);

			if($row = $query->VerRegistro()){
				$this->_rol = $row['id_rol'];
				$this->_nombre =  $row['nombre_usuario'];
				$this->_apellido =  $row['apellidos_usuario'];
				$this->_dni =  $row['dni_usuario'];
				$this->_email =  $row['email_usuario'];
				$this->_foto =  $row['foto_usuario'];
				$this->_login =  $row['login_usuario'];
        $this->_password =  $row['password_usuario'];
				$this->_fecha =  $row['fecha_ingreso_usuario'];
			}

		}
	}

	public function __get($attribute){
		return $this->$attribute;
	}

 }
?>
