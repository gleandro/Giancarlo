<?php
class TipoServicios{

	public function getTipoServicios($value='')
	{
		$sql   = "SELECT * FROM tipos_servicios where bl_estado = 0";
		$query = new Consulta($sql);
		$datos = array();

		while($row = $query->VerRegistro()){
		$datos[] = array(
		 'id' => $row['id_tipo_servicio'] ,
		 'nombre' => $row['nombre_tipo_servicio'] );
		}
		return $datos;
	}

} ?>
