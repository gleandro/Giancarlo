<?php
class Cotizacion{

	private $_id,
	$_cliente,
	$_pasajeros,
	$_cotizacion_paquete,
	$_departamento,
	$_itinerario,
	$_fecha_cotizacion,
	$_fecha_venta,
	$_precio,
	$_utilidad,
	$_fecha;

	public function __construct($id = 0, Idioma $idioma = Null){
		$this->_id = $id;
		$this->_idioma = $idioma;

		if($this->_id > 0){

			$sql   = "SELECT * FROM cotizaciones WHERE id_cotizacion = '".$this->_id."' ";

			$query = new Consulta($sql);

			if($row = $query->VerRegistro()){
				$this->_cliente =  new Cliente ($row['id_cliente']);
				$this->_pasajeros =  $row['numero_pasajeros'];
				$this->_fecha_cotizacion =  $row['fecha_cotizacion'];
				$this->_fecha_reserva =  $row['fecha_reserva'];
				$this->_precio =  $row['precio_cotizacion'];
				$this->_nombre =  $row['nombre_cotizacion'];
				$this->_descripcion =  $row['descripcion_cotizacion'];
				$this->_imagen =  $row['imagen_cotizacion'];
				$this->_fecha =  $row['fecha_cotizacion'];
				$this->_utilidad =  $row['utilidad_cotizacion'];
			}

			$sql_destinos = "SELECT * FROM cotizaciones_destinos WHERE id_cotizacion = '".$this->_id."' " ;
			$query_destinos = new Consulta($sql_destinos);
			while($row_destinos = $query_destinos->VerRegistro()){
				$this->_departamento[] =  $row_destinos['id_departamento'];
			}

			$sql_itinerario = "SELECT * FROM cotizaciones_itinerarios WHERE id_cotizacion = '".$this->_id."' " ;
			$query_itinerario = new Consulta($sql_itinerario);
			if($query_itinerario->NumeroRegistros() > 0){
				while($row_itinerario = $query_itinerario->VerRegistro()){
					$this->_itinerario[] = array(
							'id_itinerario' 		=> $row_itinerario['id_cotizacion_itinerario'],
							'nombre' => $row_itinerario['nombre_cotizacion_itinerario'],
							'descripcion' => $row_itinerario['descripcion_cotizacion_itinerario']
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
