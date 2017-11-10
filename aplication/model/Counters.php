<?php
 class Counters{

 	public function getCounters(){

 		$sql = "SELECT * FROM usuarios INNER JOIN roles USING(id_rol)";
 		$query = new consulta($sql);

 		$datos = array();
 		while($row = $query->VerRegistro()){
    		$datos[] = array(
    		 'id' => $row['id_usuario'] ,
    		 'nombre_rol'=> $row['nombre_rol'],
    		 'nombre' => $row['nombre_usuario'],
    		 'apellido' => $row['apellidos_usuario'] ,
         'dni' => $row['dni_usuario'] ,
    		 'email' => $row['email_usuario'],
         'foto' => $row['foto_usuario'],
    		 'fecha' => $row['fecha_ingreso_usuario']
        );
		}
		return $datos;

 	}

 	public function getTipoCounter($value=''){
		$sql = "SELECT * FROM roles";
		$query = new Consulta($sql);
		while($row = $query->VerRegistro()){
		$datos[] = array(
			'id' => $row['id_rol'],
			'nombre' => $row['nombre_rol']
			);
		}
		return $datos;
	}

 }
?>
