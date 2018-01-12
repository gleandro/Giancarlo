<?php
class Cotizaciones{

	public function getCotizaciones()
	{
		$sql   = "SELECT * FROM cotizaciones WHERE bl_estado = 0 ORDER BY id_cotizacion DESC";
		$query = new Consulta($sql);
		$datos = array();

		while($row = $query->VerRegistro()){
		$datos[] = array(
		 'id' => $row['id_cotizacion'] ,
		 'nombre' => $row['nombre_cotizacion'],
		 'descripcion' => $row['descripcion_cotizacion'],
		 'cantidad' => $row['numero_pasajeros'],
		 'estado' => $row['estado_cotizacion'],
		 'fecha' => $row['fecha_cotizacion'],
		 'fecha_reserva' => $row['fecha_reserva'],
	   'precio' => $row['precio_cotizacion']  );
		}
		return $datos;
	}
	static public function getCotizacionesItinerarioDetalle($id)
	{
		$sql   = "SELECT * FROM cotizaciones_itinerarios_detalles WHERE id_cotizacion_itinerario= '".$id."' ";

		$query = new Consulta($sql);
		$datos = array();

		while($row = $query->VerRegistro()){
		$datos[] = array(
		 'id_servicio' => $row['id_servicio']);
		}
		return $datos;

	}

	static public function updatePrecioCotizacion($precio,$id_cotizacion){

		$query = new Consulta("UPDATE cotizaciones SET precio_cotizacion = $precio WHERE id_cotizacion = $id_cotizacion");

	}

	static public function GetListaPasajeros($lista_pasajeros){
		foreach ($lista_pasajeros as $key => $pasajero) {
			$nombre = $pasajero['Nombres'];
			$documento = $pasajero['Documento'];
			$whatsapp = $pasajero['WhatsApp'];
			$email = $pasajero['email'];
			$sql_pasajero = "INSERT INTO pasajeros(id_pasajero,nombres_pasajero,documento_pasajero,whatsapp_pasajero,email_pasajero)
											VALUES(null,'$nombre','$documento','$whatsapp','$email')";
			$query_pasajero = new Consulta($sql_pasajero);
			$nuevo_id_pasajero = $query_pasajero->nuevoid();
			$lista_pasajeros_salida[$key] = $nuevo_id_pasajero;
		}
		return $lista_pasajeros_salida;
	}

	static public function InsertInclusion($array,$id_cotizacion,$bl_tipo){
		if ($bl_tipo == 1) {
			if (is_array($array) || is_object($array)) {
				foreach ($array as $key => $value) {
					$query = new Consulta("INSERT INTO inclusiones values(null,null,".$id_cotizacion.",'".$value."',$bl_tipo,1)");
				}
			}
		}else {
			if (is_array($array) || is_object($array)) {
				foreach ($array as $key => $value) {
					$query = new Consulta("INSERT INTO inclusiones values(null,null,".$id_cotizacion.",'".$value."',$bl_tipo,1)");
				}
			}
		}
	}

	/*

	static public function getTotalPaquetes()
	{
		$sql   = "SELECT count(*) as total FROM paquetes";
		$query = new Consulta($sql);
		$row = $query->VerRegistro();
		return $row['total'];
	}



	static public function getCotizacionesItinerariosServicios($id)
	{
		$sql   = "SELECT * FROM cotizaciones_itinerarios_detalles WHERE id_paquete_itinerario= '".$id."' ";
		$query = new Consulta($sql);
		$datos = array();

		while($row = $query->VerRegistro()){
			$datos[] = array(
			 'id_servicio' => $row['id_servicio']
		  );
		}
		return $datos;
	}

	static public function getCotizacionesItinerariosServicios($id)
	{
		$sql   = "SELECT * FROM cotizaciones_itinerarios_detalles INNER JOIN servicios USING(id_servicio) WHERE id_paquete_itinerario= '".$id."' ";
		$query = new Consulta($sql);
		$datos = array();

		while($row = $query->VerRegistro()){
			$datos[] = array(
			 'id_servicio' => $row['id_servicio'],
			 'nombre' => $row['nombre_servicio'],
			 'descripcion' => $row['descripcion_servicio']
		  );
		}
		return $datos;
	}
*/
	public function getHotelesxItinerario($id){
			$sql = "SELECT * FROM cotizaciones_itinerarios_hoteles WHERE id_cotizacion_itinerario = '".$id."' " ;

			$query = new Consulta($sql);
			$hoteles = array();
			while($row = $query->VerRegistro()){
					$hoteles[] =  $row['id_hotel'];
			}
			return $hoteles;


	}

	public function getCotizacionesHotelesxItinerario($id){
			$sql = "SELECT * FROM cotizaciones_itinerarios_hoteles WHERE id_cotizacion_itinerario = '".$id."' " ;

			$query = new Consulta($sql);
			$datos = array();
			while($row = $query->VerRegistro()){
					$datos[] = array(
					 'id_hotel' => $row['id_hotel'],
					 'id_cotizacion_paquete_itinerario_hotel' => $row['id_cotizacion_paquete_itinerario_hotel']
					);
			}
			return $datos;
	}

	static public function getCotizacionesHotelesxHabitaciones($id){
			$sql = "SELECT * FROM cotizaciones_paquetes_itinerarios_hoteles_detalles WHERE id_cotizacion_itinerario_hotel = '".$id."' " ;

			$query = new Consulta($sql);
			while($row = $query->VerRegistro()){
				$habitaciones[$row['cantidad_paquete_itinerario_hotel']] =  $row['id_habitacion'];
			}
			return $habitaciones;
	}

	public function getInclusiones($id,$tipo){
		$sql = "SELECT * FROM inclusiones where tipo_programa = 1 AND id_cotizacion = '".$id."' and tipo_inclusion = '".$tipo."' " ;
		$query = new Consulta($sql);
		while ($row = $query->VerRegistro()) {
			$inclusiones[] =  $row['nombre_inclusion'];
		}
		return $inclusiones;
	}

	public function getServiciosxCotizacion($id){
		$sql = "SELECT s.* from cotizaciones_itinerarios ci
					inner join cotizaciones_itinerarios_detalles cid using(id_cotizacion_itinerario)
					inner join servicios s using(id_servicio)
					where ci.id_cotizacion =".$id;
		$query = new Consulta($sql);
		$result['precio_nacional']=0;
		$result['precio_extranjero']=0;
		while ($row = $query->VerRegistro()) {
			$result['precio_nacional'] += (int)$row['precio_nacional_servicio'];
			$result['precio_extranjero'] += (int)$row['precio_extranjero_servicio'];
		}
		return $result;

	}

	public function getHotelesxPasajeros($id){
		$sql = "SELECT ci.id_cotizacion_itinerario,h.nombre_hotel,ha.id_habitacion,ha.nombre_habitacion,ha.cantidad_habitacion,cih.cantidad,h.estrellas_hotel,cih.precio,ht.precio_extranjero,ht.precio_nacional,p.nombres_pasajero,p.documento_pasajero
					FROM cotizaciones_itinerarios ci
					INNER JOIN cotizaciones_itinerarios_hoteles cih USING(id_cotizacion_itinerario)
					INNER JOIN cotizaciones_itinerarios_hoteles_pasajeros cihp USING(id_cotizacion_itinerario_hotel)
					INNER JOIN pasajeros p USING(id_pasajero)
					INNER JOIN hoteles h USING(id_hotel)
					INNER JOIN habitaciones ha USING(id_habitacion)
					INNER JOIN hoteles_tarifas ht USING(id_hotel,id_habitacion)
 					WHERE id_cotizacion = $id
					ORDER BY ci.id_cotizacion_itinerario,cihp.id_cotizacion_itinerario_hotel_pasajero";
		$resultado = new Consulta($sql);
		while ($row = $resultado->VerRegistro()) {
			$datos[] = array(
				'id_cotizacion_itinerario' => $row['id_cotizacion_itinerario'],
				'nombre_hotel' => $row['nombre_hotel'],
				'id_habitacion' => $row['id_habitacion'],
				'nombre_habitacion' => $row['nombre_habitacion'],
				'cantidad' => $row['cantidad'],
				'cantidad_habitacion' => $row['cantidad_habitacion'],
				'estrellas_hotel' => $row['estrellas_hotel'],
				'precio' => $row['precio'],
				'nombres_pasajero' => $row['nombres_pasajero'],
				'documento_pasajero' => $row['documento_pasajero']
			);
		}
		return $datos;
	}

}
?>
