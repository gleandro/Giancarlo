<?php
class Cotizacion{

	private $_id,
	$_cliente,
	$_cantidad,
	$_cotizacion_paquete,
	$_departamento = array(),
	$_itinerario = array(),
	$_fecha;

	public function __construct($id = 0, Idioma $idioma = Null){
		$this->_id = $id;
		$this->_idioma = $idioma;

		if($this->_id > 0){

			$sql   = "SELECT * FROM cotizaciones WHERE id_cotizacion = '".$this->_id."' ";

			$query = new Consulta($sql);

			if($row = $query->VerRegistro()){
				$this->_cliente =  new Cliente ($row['id_cliente']);
				$this->_cantidad =  $row['numero_pasajeros'];
				$this->_nombre =  $row['nombre_cotizacion'];
				$this->_descripcion =  $row['descripcion_cotizacion'];
				$this->_imagen =  $row['imagen_cotizacion'];
				$this->_fecha =  $row['fecha_cotizacion'];
			}

			$sql_destinos = "SELECT * FROM cotizaciones_paquetes_destinos WHERE id_cotizacion = '".$this->_id."' " ;
			$query_destinos = new Consulta($sql_destinos);
			while($row_destinos = $query_destinos->VerRegistro()){
				$this->_departamento[] =  $row_destinos['id_departamento'];
			}

			$sql_itinerario = "SELECT * FROM cotizaciones_paquetes_itinerarios WHERE id_cotizacion = '".$this->_id."' " ;
			$query_itinerario = new Consulta($sql_itinerario);
			if($query_itinerario->NumeroRegistros() > 0){
				while($row_itinerario = $query_itinerario->VerRegistro()){
					$this->_itinerario[] = array(
							'id_itinerario' 		=> $row_itinerario['id_cotizacion_paquete_itinerario'],
							'nombre' => $row_itinerario['nombre_cotizacion_paquete_itinerario'],
							'descripcion' => $row_itinerario['descripcion_cotizacion_paquete_itinerario']
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
