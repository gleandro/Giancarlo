<?php
class Hotel{

	private $_id,
	$_departamento,
	$_empresa,
	$_nombre,
	$_estrellas,
	$_imagen,
	$_nombre_contacto,
	$_numero_contacto;

	public function __construct($id = 0, Idioma $idioma = Null){
		$this->_id = $id;
		$this->_idioma = $idioma;

		if($this->_id > 0){

			$sql   = "SELECT * FROM hoteles h INNER JOIN departamentos d ON h.id_departamento=d.id_departamento INNER JOIN empresas e ON h.id_empresa=e.id_empresa WHERE h.id_hotel = '".$this->_id."' ";

			$query = new Consulta($sql);

			if($row = $query->VerRegistro()){
				$this->_departamento =  $row['id_departamento'];
				$this->_departamento_nombre = $row['nombre_departamento'];
				$this->_empresa =  $row['id_empresa'];
				$this->_empresa_nombre = $row['razon_social_empresa'];
				$this->_nombre =  $row['nombre_hotel'];
				$this->_estrellas =  $row['estrellas_hotel'];
				$this->_imagen =  $row['imagen_hotel'];
				$this->_nombre_contacto =  $row['nombre_contacto_hotel'];
				$this->_numero_contacto =  $row['numero_contacto_hotel'];
			}
		}
	}



	public function __get($attribute){
		return	$this->$attribute;
	}

	public function getTarifas($id)
	{
		$sql   = "SELECT ht.id_hotel_tarifa,ht.precio_extranjero,ht.id_habitacion,ht.id_hotel,h.nombre_habitacion,ht.precio_nacional FROM hoteles_tarifas ht INNER JOIN habitaciones h ON ht.id_habitacion = h.id_habitacion WHERE id_hotel = ".$id."";
		$query = new Consulta($sql);
		$datos = array();

		while($row = $query->VerRegistro()){
		$datos[] = array(
		 'id' => $row['id_hotel_tarifa'] ,
		 'precio_extranjero' => $row['precio_extranjero'] ,
		 'precio_nacional' => $row['precio_nacional'],
		 'id_habitacion' => $row['id_habitacion'] ,
		 'habitacion' => $row['nombre_habitacion']);
		}
		return $datos;
	}
}
?>
