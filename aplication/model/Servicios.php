<?php
class Servicios{

	public function getServicios()
	{
		$sql   = "SELECT * FROM servicios s INNER JOIN tipos_servicios ts ON s.id_tipo_servicio = ts.id_tipo_servicio INNER JOIN empresas e ON s.id_empresa = e.id_empresa where s.bl_estado = 0 ORDER BY id_servicio ASC";
		$query = new Consulta($sql);
		$datos = array();

		while($row = $query->VerRegistro()){
		$datos[] = array(
		 'id' => $row['id_servicio'] ,
		 'tipo_servicio' => $row['nombre_tipo_servicio'],
		 'id_tipo_servicio' => $row['id_tipo_servicio'] ,
		 'id_empresa' => $row['id_empresa'] ,
		 'empresa' => $row['razon_social_empresa'] ,
		 'nombre' => $row['nombre_servicio'] ,
		 'precio_nacional' => $row['precio_nacional_servicio'] ,
		 'precio_extranjero' => $row['precio_extranjero_servicio'] ,
		 'alcance' => $row['alcance_servicio'] ,
		 'descipcion' => $row['descripcion_servicio'] ,
		 'contacto_nombre' => $row['contacto_nombre_servicio'] ,
		 'contacto_numero' => $row['contacto_numero_servicio'] , );
		}
		return $datos;
	}

	public function getServiciosxDepartamentos($departamentos)
	{
		//$sql   = "SELECT * FROM servicios_ubicaciones INNER JOIN servicios USING(id_servicio) WHERE id_departamento IN ($departamentos) GROUP BY id_servicio ORDER BY id_departamento asc";
		$sql = "SELECT * FROM servicios_ubicaciones INNER JOIN servicios s USING(id_servicio) INNER JOIN tipos_servicios USING(id_tipo_servicio) INNER JOIN departamentos d USING(id_departamento) INNER JOIN empresas e USING(id_empresa) WHERE s.bl_estado = 0 and id_departamento IN ($departamentos) ORDER BY id_departamento,s.precio_nacional_servicio asc";

		$query = new Consulta($sql);
		$datos = array();

		while($row = $query->VerRegistro()){
		$datos[] = array(
		 'id' => $row['id_servicio'] ,
		 'id_tipo_servicio' => $row['id_tipo_servicio'] ,
		 'id_empresa' => $row['id_empresa'] ,
		 'nombre' => $row['nombre_servicio'] ,
		 'nombre_tipo_servicio' => $row['nombre_tipo_servicio'] ,
		 'departamento' => $row['nombre_departamento'] ,
		 'precio_e' => $row['precio_extranjero_servicio'] ,
		 'precio_n' => $row['precio_nacional_servicio'] ,
		 'alcance' => $row['alcance_servicio'] ,
		 'descipcion' => $row['descripcion_servicio'] ,
		 'contacto_nombre' => $row['contacto_nombre_servicio'] ,
		 'contacto_numero' => $row['contacto_numero_servicio']);
		}
		return $datos;
	}

	public function getDepartamentos()
	{
		$sql = "SELECT * FROM departamentos where bl_estado = 0";
		$query = new Consulta($sql);
		$datos = array();

		while ($row = $query->VerRegistro()) {
			$datos[] = array(
			 'id' => $row['id_departamento'] ,
			 'nombre' => $row['nombre_departamento'] );
		}
		return $datos;
	}

}
?>
