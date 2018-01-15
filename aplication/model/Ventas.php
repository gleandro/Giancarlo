<?php
 class Ventas{

 	public function getVentas($reserva = 0){
    $sql_v = "";
    if ($reserva) {
      $sql_v = " WHERE bl_estado_venta =  0 ";
    }

 		$sql = "SELECT v.*,cot.fecha_reserva,c.nombres_cliente,c.documento_cliente FROM ventas v
            INNER JOIN clientes c using(id_cliente)
            INNER JOIN cotizaciones cot USING(id_cotizacion)
            $sql_v
            ORDER BY id_venta DESC";
 		$query = new consulta($sql);

 		$datos = array();
 		while($row = $query->VerRegistro()){
    		$datos[] = array(
    		 'id' => $row['id_venta'] ,
    		 'fecha' => $row['fecha_venta'],
         'fecha_reserva' => $row['fecha_reserva'],
    		 'precio' => $row['precio_venta'] ,
    		 'pasajeros' => $row['pasajeros_venta'],
    		 'nombre' => $row['nombre_venta'] ,
    		 'descripcion' => $row['descripcion_venta'],
    		 'observacion' => $row['observacion_venta'],
         'estado' => $row['bl_estado_venta'],
         'cliente' => $row['nombres_cliente'],
         'documento' => $row['documento_cliente']
       );
		}
		return $datos;
 	}

  public function getEstado($bl_estado,$array){
    if ($bl_estado == 0) {
      return '<span class="text-warning">'.$array[$bl_estado].'</span>';
    }
    else if ($bl_estado == 1) {
      return '<span class="text-info">'.$array[$bl_estado].'</span>';
    }
    else{
      return '<span class="text-danger">'.$array[$bl_estado].'</span>';
    }

  }

  public function getDestinos($departamentos){

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
