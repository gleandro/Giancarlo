<?php
class Cotizaciones{

	public function getCotizaciones()
	{
		$sql   = "SELECT * FROM cotizaciones ORDER BY id_cotizacion DESC";
		$query = new Consulta($sql);
		$datos = array();

		while($row = $query->VerRegistro()){
		$datos[] = array(
		 'id' => $row['id_cotizacion'] ,
		 'nombre' => $row['nombre_cotizacion'],
		 'descripcion' => $row['descripcion_cotizacion'],
		 'cantidad' => $row['numero_pasajeros'],
		 'estado' => $row['estado_cotizacion'],
		 'fecha' => $row['fecha_cotizacion']  );
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

}
?>
