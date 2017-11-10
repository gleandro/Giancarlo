<?php 
class Departamentos{

	public function getDepartamentos()
	{
		$sql   = "SELECT * FROM departamentos";
		$query = new Consulta($sql);
		$datos = array();

		while($row = $query->VerRegistro()){
		$datos[] = array(
		 'id' => $row['id_departamento'] ,
		 'nombre' => $row['nombre_departamento']  );
		}
		return $datos;
	}

	static public function getNombrexIdDepartamento($id)
	{
		$sql   = "SELECT * FROM departamentos WHERE id_departamento = '".$id."'  ";
		$query = new Consulta($sql);
		$row = $query->VerRegistro();
		$nombre = $row['nombre_departamento'];

		return $nombre;
	}

} 
?>