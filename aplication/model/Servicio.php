<?php
class Servicio{ 

	private $_id, 
	$_tipo_servicio, 
	$_empresa, 
	$_nombre, 
	$_precio, 
	$_alcance,
	$_descripcion,
	$_departamento,
	$_contacto_nombre,
	$_contacto_numero;

	public function __construct($id = 0, Idioma $idioma = Null){
		$this->_id = $id;
		$this->_idioma = $idioma;

		if($this->_id > 0){

			$sql   = "SELECT * FROM servicios s INNER JOIN tipos_servicios ts ON s.id_tipo_servicio = ts.id_tipo_servicio INNER JOIN empresas e ON s.id_empresa = e.id_empresa WHERE s.id_servicio = '".$this->_id."' "; 

			$query = new Consulta($sql);

			if($row = $query->VerRegistro()){ 
				$this->_tipo_servicio =  $row['id_tipo_servicio']; 
				$this->_empresa = $row['id_empresa']; 
				$this->_nombre =  $row['nombre_servicio']; 
				$this->_precio = $row['precio_servicio'];
				$this->_alcance =  $row['alcance_servicio']; 
				$this->_descripcion =  $row['descripcion_servicio'];
				$this->_contacto_nombre =  $row['contacto_nombre_servicio'];
				$this->_contacto_numero =  $row['contacto_numero_servicio'];
			}

			$sql2 = "SELECT * FROM servicios_ubicaciones WHERE id_servicio = '".$this->_id."' " ;

			$query2 = new Consulta($sql2);

			while($row2 = $query2->VerRegistro()){
				$this->_departamento[] =  $row2['id_departamento'];
			}

		}
	}

	

	public function __get($attribute){
		return	$this->$attribute;
	}

}
?>