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
		$sql   = "SELECT * FROM paquetes_itinerario_detalle WHERE id_paquete_itinerario= '".$id."' ";
		$query = new Consulta($sql);
		$datos = array();

		while($row = $query->VerRegistro()){
		$datos[] = array(
		 'id_servicio' => $row['id_servicio']);
		}
		return $datos;
	}

	public function getHotelesxItinerario($id){
			$sql = "SELECT * FROM paquetes_itinerario_hoteles WHERE id_paquete_itinerario = '".$id."' " ;
			$query = new Consulta($sql);
			while($row = $query->VerRegistro()){
					$hoteles[] =  $row['id_hotel'];
			}
			return $hoteles;
	}

}
?>
