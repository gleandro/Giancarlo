<?php

 class Venta{

 	private $_id,
 	$_cotizacion,
  $_id_cliente,
  $_id_agencia,
 	$_fecha_venta,
  $_fecha_reserva,
 	$_precio,
 	$_pasajeros,
 	$_nombre,
  $_itinerario,
  $_departamento,
 	$_descripcion,
  $_cantidad_pasajeros,
  $_pagado;

	public function __construct($id = 0, Idioma $idioma = Null){
		$this->_id = $id;
		$this->_idioma = $idioma;

		if($this->_id > 0){

			$sql   = "SELECT * FROM ventas WHERE id_venta = '".$this->_id."' ";
			$query = new Consulta($sql);
			if($row = $query->VerRegistro()){
				$this->_cotizacion =  $row['id_cotizacion'];
				$this->_id_cliente =  new Cliente($row['id_cliente']);
				$this->_fecha_venta =  $row['fecha_venta'];
        $this->_fecha_reserva =  $row['fecha_reserva'];
				$this->_precio =  $row['precio_venta'];
				$this->_cantidad_pasajeros =  $row['pasajeros_venta'];
				$this->_nombre =  $row['nombre_venta'];
				$this->_descripcion =  $row['descripcion_venta'];
        $this->_pagado =  $row['pagado_venta'];
			}

      $sql_destinos = "SELECT * FROM ventas_destinos WHERE id_venta = '".$this->_id."' " ;
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
              'dia' => $row_itinerario['dia'],
              'fecha' => $row_itinerario['fecha_itinerario'],
              'descripcion' => $row_itinerario['descripcion_venta_itinerario']
          );
        }
      }
      $sql_pasajero = "SELECT * FROM pasajeros WHERE id_venta = ".$this->_id;
      $query_pasajeros = new Consulta($sql_pasajero);
      while ($row_pasajero = $query_pasajeros->VerRegistro()) {
        $this->_pasajeros[] = array(
          'nombre' => $row_pasajero['nombres_pasajero'],
          'documento' => $row_pasajero['documento_pasajero'],
          'whatsapp' => $row_pasajero['whatsapp_pasajero'],
          'nacionalidad' => $row_pasajero['id_nacionalidad'],
          'sexo' => $row_pasajero['sexo']
        );
      }
		}
	}

	public function __get($attribute){
		return $this->$attribute;
	}

 }
?>
