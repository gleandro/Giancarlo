<?php
class Empresa{

	private  $_id,
	$_contacto,
	$_tipo,
	$_razon,
	$_ruc,
	$_email,
	$_telefono,
	$_pagina_web,
	$_direccion,
	$_nombre_contacto,
	$_numero_cuenta,
	$_numero_contacto;

	public function __construct($id = 0, Idioma $idioma = Null){
		$this->_id = $id;
		$this->_idioma = $idioma;

		if($this->_id > 0){

			$sql   = "SELECT * FROM empresas e INNER JOIN tipos_empresas te ON e.id_tipo_empresa=te.id_tipo_empresa WHERE e.id_empresa = '".$this->_id."' ";

			$query = new Consulta($sql);

			if($row = $query->VerRegistro()){
				$this->_contacto =  $row['nombre_contacto'];
				$this->_tipo =  $row['nombre_tipo_empresa'];
				$this->_razon =  $row['razon_social_empresa'];
				$this->_ruc =  $row['ruc_empresa'];
				$this->_email =  $row['email_empresa'];
				$this->_telefono =  $row['telefono_empresa'];
				$this->_pagina_web =  $row['pagina_web_empresa'];
				$this->_direccion =  $row['direccion_empresa'];
				$this->_nombre_contacto =  $row['contacto_nombre_empresa'];
				$this->_numero_cuenta =  $row['numero_cuenta_empresa'];
				$this->_numero_contacto =  $row['contacto_telefono_empresa'];
			}
		}
	}



	public function __get($attribute){
		return	$this->$attribute;
	}
}
?>
