<?php
 class Ventas{

 	public function getVentas(){

 		$sql = "SELECT v.*,c.nombres_cliente FROM ventas v INNER JOIN clientes c using(id_cliente) ORDER BY id_venta DESC";
 		$query = new consulta($sql);

 		$datos = array();
 		while($row = $query->VerRegistro()){
    		$datos[] = array(
    		 'id' => $row['id_venta'] ,
    		 'fecha' => $row['fecha_venta'],
    		 'precio' => $row['precio_venta'] ,
    		 'pasajeros' => $row['pasajeros_venta'],
    		 'nombre' => $row['nombre_venta'] ,
    		 'descripcion' => $row['descripcion_venta'],
    		 'observacion' => $row['observacion_venta'],
         'cliente' => $row['nombres_cliente']
       );
		}
		return $datos;
 	}

  function getDestinos($departamentos){

    foreach ($departamentos as $key => $value) {
      if ($key == 0) {
        $dep += $value;
      }else {
        $dep += ",".$value;
      }
    }
    $query = new consulta("SELECT * FROM departamentos where id_departamento in (".$dep.") ");
    while ($row = $query->VerRegistro()) {
      $result['nombre'] = $row['nombre_departamento'];
    }
    return $result;
  }

  public function getHotelesxHabitacion($id){
      $sql = "SELECT h.nombre_hotel,ha.nombre_habitacion,vit.cantidad,vit.precio_habitacion FROM ventas_itinerarios_hoteles vit
        inner join hoteles h using(id_hotel)
        inner join habitaciones ha using(id_habitacion)
        WHERE id_venta_itinerario = ".$id ;

      $query = new Consulta($sql);
      while($row = $query->VerRegistro()){
        $datos[] = array(
    		 'nombre_hotel' => $row['nombre_hotel'] ,
    		 'nombre_habitacion' => $row['nombre_habitacion'],
    		 'cantidad' => $row['cantidad'] ,
    		 'pasajeros' => $row['pasajeros_venta'],
    		 'precio_habitacion' => $row['precio_habitacion']
       );
      }
      return $datos;
  }

 }
?>
