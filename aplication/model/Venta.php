<?php

 class Venta{

 	private $_id,
 	$_cotizacion,
  $_id_cliente,
 	$_fecha,
 	$_precio,
 	$_pasajeros,
 	$_nombre,
  $_itinerario,
  $_departamento,
 	$_descripcion,
 	$_observacion;

	public function __construct($id = 0, Idioma $idioma = Null){
		$this->_id = $id;
		$this->_idioma = $idioma;

		if($this->_id > 0){

			$sql   = "SELECT * FROM ventas WHERE id_venta = '".$this->_id."' ";
			$query = new Consulta($sql);
			if($row = $query->VerRegistro()){
				$this->_cotizacion =  $row['id_cotizacion'];
				$this->_id_cliente =  new Cliente($row['id_cliente']);
				$this->_fecha =  $row['fecha_venta'];
				$this->_precio =  $row['precio_venta'];
				$this->_pasajeros =  $row['pasajeros_venta'];
				$this->_nombre =  $row['nombre_venta'];
				$this->_descripcion =  $row['descripcion_venta'];
        $this->_observacion =  $row['observacion_venta'];
			}

      $sql_destinos = "SELECT * FROM cotizaciones_destinos WHERE id_cotizacion = '".$this->_cotizacion."' " ;
      $query_destinos = new Consulta($sql_destinos);
      while($row_destinos = $query_destinos->VerRegistro()){
        $this->_departamento[] =  $row_destinos['id_departamento'];
      }

      $sql_itinerario = "SELECT * FROM ventas_itinerarios WHERE id_venta = '".$this->_id."' " ;
      $query_itinerario = new Consulta($sql_itinerario);
      if($query_itinerario->NumeroRegistros() > 0){
        while($row_itinerario = $query_itinerario->VerRegistro()){
          $this->_itinerario[] = array(
              'id_itinerario' 		=> $row_itinerario['id_venta_itinerario'],
              'nombre' => $row_itinerario['nombre_venta_itinerario'],
              'descripcion' => $row_itinerario['descripcion_venta_itinerario']
          );
        }
      }

		}
	}

	public function __get($attribute){
		return $this->$attribute;
	}

 }
?>
