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

	static public function getNacional($array_codigo_pasajero,$list_pasajeros){

		$salida = 0;
		// print_r($array_codigo_pasajero);
		// print_r($list_pasajeros);
		foreach ($array_codigo_pasajero as $key => $codigo) {
			if ($list_pasajeros[$codigo]['nacionalidad'] == 0) {
				$salida = 1;
			}
		}
		return $salida;
	}

	static public function GetListaPasajeros($lista_pasajeros){
		foreach ($lista_pasajeros as $key => $pasajero) {
			$nombre = $pasajero['Nombres'];
			$documento = $pasajero['Documento'];
			$whatsapp = $pasajero['WhatsApp'];
			$email = $pasajero['email'];
			$id_nacionalidad = $pasajero['nacionalidad'];
			$sql_pasajero = "INSERT INTO pasajeros(id_pasajero,nombres_pasajero,documento_pasajero,whatsapp_pasajero,email_pasajero,id_nacionalidad)
											VALUES(null,'$nombre','$documento','$whatsapp','$email','$id_nacionalidad')";
			$query_pasajero = new Consulta($sql_pasajero);
			$nuevo_id_pasajero = $query_pasajero->nuevoid();
			$lista_pasajeros_salida[$key]['id'] = $nuevo_id_pasajero;
			$lista_pasajeros_salida[$key]['nacionalidad'] = $id_nacionalidad;
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
		$sql = "SELECT ci.id_cotizacion_itinerario,cid.id_cotizacion_itinerario_detalle,cid.id_servicio,cidp.id_pasajero,cidp.precio FROM cotizaciones c
						INNER JOIN cotizaciones_itinerarios ci USING(id_cotizacion)
						INNER JOIN cotizaciones_itinerarios_detalles cid USING(id_cotizacion_itinerario)
						INNER JOIN cotizaciones_itinerarios_detalles_pasajeros cidp USING(id_cotizacion_itinerario_detalle)
						WHERE ci.id_cotizacion = $id";
		$query = new Consulta($sql);

		while ($row = $query->VerRegistro()) {
			$datos[] = array(
				'id_cotizacion_itinerario' => $row['id_cotizacion_itinerario'],
				'id_cotizacion_itinerario_detalle' => $row['id_cotizacion_itinerario_detalle'],
				'id_servicio' => $row['id_servicio'],
				'id_pasajero' => $row['id_pasajero'],
				'precio' => $row['precio']
			);
		}
		return $datos;

	}

	public function getHotelesxPasajeros($id){
		$sql = "SELECT ci.id_cotizacion_itinerario,h.nombre_hotel,ha.id_habitacion,ha.nombre_habitacion,ha.cantidad_habitacion,cih.cantidad,cihp.precio_hotel,h.estrellas_hotel,ht.precio_extranjero,ht.precio_nacional,p.id_pasajero,p.nombres_pasajero,p.documento_pasajero
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
				'precio' => $row['precio_hotel'],
				'id_pasajero' => $row['id_pasajero'],
				'nombres_pasajero' => $row['nombres_pasajero'],
				'documento_pasajero' => $row['documento_pasajero']
			);
		}
		return $datos;
	}

}
?>
