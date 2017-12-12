<?php
class Habitaciones{

	public function getHabitaciones()
	{
		$sql   = "SELECT * FROM habitaciones where bl_estado = 0 ORDER BY id_habitacion ASC";
		$query = new Consulta($sql);

		$datos = array();
		while($row = $query->VerRegistro()){
				$datos[] = array(
				 'id' => $row['id_habitacion'] ,
				 'nombre' => $row['nombre_habitacion'],
			   'cantidad' => $row['cantidad_habitacion']
			  );
		}
		return $datos;
	}

}
?>
