<?php
class Paquete{

	private $_id,
	$_nombre,
	$_imagen,
	$_departamento,
	$_itinerario,
	$_descripcion;

	public function __construct($id = 0, Idioma $idioma = Null){
		$this->_id = $id;
		$this->_idioma = $idioma;

		if($this->_id > 0){

			$sql   = "SELECT * FROM paquetes WHERE id_paquete = '".$this->_id."' ";

			$query = new Consulta($sql);

			if($row = $query->VerRegistro()){
				$this->_tipo_servicio =  $row['id_paquete'];
				$this->_nombre =  $row['nombre_paquete'];
				$this->_descripcion =  $row['descripcion_paquete'];
				$this->_imagen =  $row['imagen_paquete'];
			}

			$sql2 = "SELECT * FROM paquetes_destinos WHERE id_paquete = '".$this->_id."' " ;
			$query2 = new Consulta($sql2);
			while($row2 = $query2->VerRegistro()){
				$this->_departamento[] =  $row2['id_departamento'];
			}

			$sql3 = "SELECT * FROM paquetes_itinerarios WHERE id_paquete = '".$this->_id."' " ;
			$query3 = new Consulta($sql3);
			if($query3->NumeroRegistros() > 0){
				while($row3 = $query3->VerRegistro()){
					$this->_itinerario[] = array(
							'id_hotel' 		=> $row3['id_hotel'],
							'id_paquete_itinerario' => $row3['id_paquete_itinerario'],
							'nombre' => $row3['nombre_paquete_itinerario'],
							'descripcion' => $row3['descripcion_paquete_itinerario']
					);
				}
			}

		}
	}



	public function __get($attribute){
		return	$this->$attribute;
	}

}
?>
