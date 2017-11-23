<?php
class Paquetes{

	public function getPaquetes()
	{
		$sql   = "SELECT * FROM paquetes";
		$query = new Consulta($sql);
		$datos = array();

		while($row = $query->VerRegistro()){
			$datos[] = array(
				'id' => $row['id_paquete'] ,
				'nombre' => $row['nombre_paquete'],
				'descripcion' => $row['descripcion_paquete']  );
			}
			return $datos;
		}

		static public function getTotalPaquetes()
		{
			$sql   = "SELECT count(*) as total FROM paquetes";
			$query = new Consulta($sql);
			$row = $query->VerRegistro();
			return $row['total'];
		}

		static public function getPaquetesItinerarioDetalle($id)
		{
			$sql   = "SELECT * FROM paquetes_itinerarios_detalles WHERE id_paquete_itinerario= '".$id."' ";
			$query = new Consulta($sql);
			$datos = array();

			while($row = $query->VerRegistro()){
				$datos[] = array(
					'id_servicio' => $row['id_servicio']);
				}
				return $datos;
			}

			public function getHotelesxItinerario($id){
				$sql = "SELECT * FROM paquetes_itinerarios_hoteles WHERE id_paquete_itinerario = '".$id."' " ;
				$query = new Consulta($sql);
				while($row = $query->VerRegistro()){
					$hoteles[] =  $row['id_hotel'];
				}
				return $hoteles;
			}

			public function getInclusiones($id,$tipo){
				$sql = "SELECT * FROM paquetes_inclusiones where id_paquete = '".$id."' and tipo_inclusion = '".$tipo."' " ;
				$query = new Consulta($sql);
				while ($row = $query->VerRegistro()) {
					$inclusiones[] =  $row['nombre_inclusion'];
				}
				return $inclusiones;
			}

			public function getHotelesxDepartamento_2($id){
				$sql = "SELECT ht.id_hotel,h.nombre_hotel,ha.id_habitacion,ROUND(ht.precio_nacional/ha.cantidad_habitacion,2) 'precio_nacional_persona',
				ROUND(ht.precio_extranjero/ha.cantidad_habitacion,2) 'precio_extranjero_persona',ha.nombre_habitacion
				FROM hoteles_tarifas ht inner join habitaciones ha using(id_habitacion) inner join hoteles h using(id_hotel)
				where id_habitacion IN (1,2,3) and id_hotel
				IN (select DISTINCT id_hotel from paquetes p
				inner join paquetes_itinerarios pit USING(id_paquete)
				inner join paquetes_itinerarios_hoteles pih USING(id_paquete_itinerario)
				inner join hoteles h USING(id_hotel)
				where p.id_paquete = ".$id." ) order by id_hotel,ha.id_habitacion;";
				$resultado = new Consulta($sql);
				while ($row = $resultado->VerRegistro()) {
					$datos[] = array(
						'id_hotel' => $row['id_hotel'],
						'nombre_hotel' => $row['nombre_hotel'],
						'id_habitacion' => $row['id_habitacion'],
						'precio_nacional_persona' => $row['precio_nacional_persona'],
						'precio_extranjero_persona' => $row['precio_extranjero_persona'],
						'nombre_habitacion' => $row['nombre_habitacion']
					);
				}
				return $datos;
			}

			public function getServiciosxPaquete($id){
				$sql = "SELECT s.* from paquetes_itinerarios pit
							inner join paquetes_itinerarios_detalles pid using(id_paquete_itinerario)
							inner join servicios s using(id_servicio)
							where pit.id_paquete = ".$id;
				$query = new Consulta($sql);
				$result['precio_nacional']=0;
				$result['precio_extranjero']=0;
				while ($row = $query->VerRegistro()) {
					$result['precio_nacional'] += (int)$row['precio_nacional_servicio'];
					$result['precio_extranjero'] += (int)$row['precio_extranjero_servicio'];
				}
				return $result;

			}

		}
	?>
