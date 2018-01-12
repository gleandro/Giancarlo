<?php
 class Agencias{

 	public function getAgencias(){

 		$sql = "SELECT * FROM agencias WHERE bl_estado = 0 ORDER BY razon_social_empresa ASC";
 		$query = new consulta($sql);

 		$datos = array();
 		while($row = $query->VerRegistro()){
    		$datos[] = array(
    		 'id' => $row['id_agencia'] ,
    		 'razonsocial' => $row['razon_social_empresa'],
    		 'ruc' => $row['ruc_empresa'] ,
    		 'email' => $row['email_empresa'],
    		 'telefono' => $row['telefono_empresa'] ,
    		 'direccion' => $row['direccion_empresa'],
    		 'contacto' => $row['contacto_empresa'] ,
    		 'comision' => $row['comision_empresa'],
       );
		}
		return $datos;
 	}

 }
?>
