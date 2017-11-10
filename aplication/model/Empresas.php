<?php 
class Empresas{

	public function getEmpresas($value='')
	{
		$sql   = "SELECT * FROM empresas e INNER JOIN tipos_empresas te ON e.id_tipo_empresa=te.id_tipo_empresa";
		$query = new Consulta($sql);
		$datos = array();

		while($row = $query->VerRegistro()){
		$datos[] = array(
		 'id' => $row['id_empresa'] ,
		 'razon' => $row['razon_social_empresa'] ,
		 'ruc' => $row['ruc_empresa'] ,
		 'email' => $row['email_empresa'] ,
		 'telefono' => $row['telefono_empresa'] ,
		 'pagina' => $row['pagina_web_empresa'] ,
		 'direccion' => $row['direccion_empresa'],
		 'tipo' => $row['nombre_tipo_empresa'],
		 'nombre_contacto' => $row['contacto_nombre_empresa'],
		 'numero_contacto' => $row['contacto_telefono_empresa'] );
		}
		return $datos;
	}

	public function getTiposEmpresa($value='')
	{
		$sql = "SELECT * FROM tipos_empresas";
		$query = new Consulta($sql);
		while($row = $query->VerRegistro()){
		$datos[] = array(
			'id' => $row['id_tipo_empresa'],
			'nombre' => $row['nombre_tipo_empresa']
			);
		}
		return $datos;
	}



} ?>