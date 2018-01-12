<?php

 class Agencia{

 	private $_id,
 	$_razon,
 	$_ruc,
 	$_email,
 	$_telefono,
 	$_direccion,
 	$_contacto,
 	$_comision,
  $_sede;

	public function __construct($id = 0, Idioma $idioma = Null){
		$this->_id = $id;
		$this->_idioma = $idioma;

		if($this->_id > 0){

			$sql   = "SELECT * FROM agencias WHERE id_agencia = '".$this->_id."' ";
			$query = new Consulta($sql);
			if($row = $query->VerRegistro()){
				$this->_razon =  $row['razon_social_empresa'];
				$this->_ruc =  $row['ruc_empresa'];
				$this->_email =  $row['email_empresa'];
				$this->_telefono =  $row['telefono_empresa'];
				$this->_direccion =  $row['direccion_empresa'];
				$this->_contacto =  $row['contacto_empresa'];
        $this->_sede =  new Sede($row['id_sede']);
				$this->_comision =  $row['comision_empresa'];
			}

		}
	}

	public function __get($attribute){
		return $this->$attribute;
	}

 }
?>
