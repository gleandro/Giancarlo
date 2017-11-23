<?php
class Hoteles{

	public function getHoteles($value='')
	{
		$sql   = "SELECT * FROM hoteles h INNER JOIN departamentos d ON h.id_departamento=d.id_departamento INNER JOIN empresas e ON h.id_empresa=e.id_empresa ORDER BY id_hotel ASC";
		$query = new Consulta($sql);
		$datos = array();

		while($row = $query->VerRegistro()){
		$datos[] = array(
		 'id' => $row['id_hotel'] ,
		 'id_departamento' => $row['id_departamento'] ,
		 'departamento' => $row['nombre_departamento'] ,
		 'empresa' => $row['razon_social_empresa'] ,
		 'nombre' => $row['nombre_hotel'] ,
		 'estrellas' => $row['estrellas_hotel'] ,
		 'imagen' => $row['imagen_hotel'] ,
		 'contacto_nombre' => $row['nombre_contacto_hotel'] ,
		 'contacto_numero' => $row['numero_contacto_hotel'] );
		}
		return $datos;
	}

	static public function getHabitacionesHoteles($id)
	{
		$sql   = "SELECT * FROM hoteles_tarifas INNER JOIN habitaciones USING (id_habitacion) WHERE id_hotel = '".$id."' AND tipo_hotel_tarifa='1' ORDER BY precio_hotel_tarifa ASC";

		$query = new Consulta($sql);
		$datos = array();

		while($row = $query->VerRegistro()){
			$datos[] = array(
			 'id_habitacion' => $row['id_habitacion'] ,
			 'id_hotel_tarifa' => $row['id_hotel_tarifa'] ,
			 'id_hotel' => $row['id_hotel'] ,
			 'precio_hotel_tarifa' => $row['precio_hotel_tarifa'] ,
			 'nombre_habitacion' => $row['nombre_habitacion']
			 );
		}
		return $datos;
	}
	/*
	static public function getCotizacionesHabitacionesHoteles($id_hotel,$id_itinerario)
	{
	    $sql   = "SELECT *,
				(SELECT cpihd.cantidad_paquete_itinerario_hotel FROM cotizaciones_paquetes_itinerarios_hoteles_detalles cpihd WHERE cpihd.id_cotizacion_paquete_itinerario_hotel='".$id_itinerario."' AND cpihd.id_habitacion=ht.id_habitacion)AS cantidad
				FROM hoteles_tarifas ht
				INNER JOIN habitaciones h USING (id_habitacion)
				WHERE ht.id_hotel = '".$id_hotel."' AND ht.tipo_hotel_tarifa='1'
				ORDER BY ht.precio_hotel_tarifa ASC";
		$query = new Consulta($sql);
		$datos = array();

		while($row = $query->VerRegistro()){
			$datos[] = array(
			 'id_habitacion' => $row['id_habitacion'] ,
			 'id_hotel_tarifa' => $row['id_hotel_tarifa'] ,
			 'id_hotel' => $row['id_hotel'] ,
			 'precio_hotel_tarifa' => $row['precio_hotel_tarifa'] ,
			 'nombre_habitacion' => $row['nombre_habitacion'],
			 'cantidad' => $row['cantidad']
			 );
		}
		return $datos;
	}
	*/

	static public function getTotalHoteles()
	{
		$sql   = "SELECT count(*) as total from hoteles";
		$query = new Consulta($sql);
		$row = $query->VerRegistro();
		return $row['total'];
	}

	public function getHotelesxDepartamentos($departamentos)
	{
		//$sql   = "SELECT * FROM hoteles INNER JOIN departamentos USING(id_departamento) INNER JOIN empresas USING(id_empresa) WHERE id_departamento IN ($departamentos) GROUP BY id_hotel ORDER BY id_hotel asc";
		$sql   = "SELECT *,
							(SELECT min(precio_extranjero) FROM hoteles_tarifas ht WHERE ht.id_hotel=h.id_hotel) as precio
							FROM hoteles h
							INNER JOIN departamentos d USING(id_departamento)
							INNER JOIN empresas e USING(id_empresa)
							WHERE h.id_departamento IN ($departamentos)
							ORDER BY h.id_departamento,precio asc";

		$query = new Consulta($sql);
		$datos = array();

		while($row = $query->VerRegistro()){
		$datos[] = array(
		 'id' => $row['id_hotel'] ,
		 'id_departamento' => $row['id_departamento'] ,
		 'departamento' => $row['nombre_departamento'] ,
		 'empresa' => $row['razon_social_empresa'] ,
		 'precio_e' => $row['precio'] ,
		 'nombre' => $row['nombre_hotel'] ,
		 'estrellas' => $row['estrellas_hotel'] ,
		 'imagen' => $row['imagen_hotel'] ,
		 'contacto_nombre' => $row['nombre_contacto_hotel'] ,
		 'contacto_numero' => $row['numero_contacto_hotel'] );
		}
		return $datos;
	}

	public function getDepartamentos($value='')
	{
		$sql   = "SELECT * FROM departamentos";
		$query = new Consulta($sql);
		$datos = array();

		while($row = $query->VerRegistro()){
		$datos[] = array(
		 'id' => $row['id_departamento'] ,
		 'departamento' => $row['nombre_departamento'] );
		}
		return $datos;
	}

	public function getHabitaciones()
	{
		$sql   = "SELECT * FROM habitaciones";
		$query = new Consulta($sql);
		$datos = array();

		while($row = $query->VerRegistro()){
		$datos[] = array(
		 'id' => $row['id_habitacion'] ,
		 'habitacion' => $row['nombre_habitacion'] );
		}
		return $datos;
	}

} ?>
