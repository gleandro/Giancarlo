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
         'pagado' => $row['pagado_venta'],
         'cliente' => $row['nombres_cliente'],
         'documento' => $row['documento_cliente']
       );
		}
		return $datos;
 	}

  public function getVentasHoy(){

    date_default_timezone_set("America/Lima");

    $fecha = date("Y-m-d");

 		$sql = "SELECT v.id_venta,vi.id_venta_itinerario,c.nombres_cliente,c.documento_cliente,vi.fecha_itinerario,s.id_servicio,s.nombre_servicio FROM ventas v
        		INNER JOIN clientes c using(id_cliente)
        		INNER JOIN ventas_itinerarios vi USING(id_venta)
        		INNER JOIN ventas_itinerarios_detalles vid USING(id_venta_itinerario)
        		INNER JOIN servicios s USING(id_servicio)
        		WHERE vi.fecha_itinerario = '$fecha'
        		ORDER BY id_venta DESC";
 		$query = new consulta($sql);

 		$datos = array();
 		while($row = $query->VerRegistro()){
    		$datos[] = array(
    		 'id' => $row['id_venta'] ,
    		 'id_itinerario' => $row['id_venta_itinerario'],
         'fecha_reserva' => $row['fecha_itinerario'],
    		 'nombre' => $row['nombre_servicio'] ,
         'id_servicio' => $row['id_servicio'] ,
         'tipo' => 'Servicio',
         'cliente' => $row['nombres_cliente'],
         'documento' => $row['documento_cliente']
       );
		}

    $sql = "SELECT v.id_venta,vi.id_venta_itinerario,c.nombres_cliente,c.documento_cliente,vi.fecha_itinerario,h.id_hotel,h.nombre_hotel FROM ventas v
        		INNER JOIN clientes c using(id_cliente)
        		INNER JOIN ventas_itinerarios vi USING(id_venta)
        		INNER JOIN ventas_itinerarios_hoteles vih USING(id_venta_itinerario)
        		INNER JOIN hoteles h USING(id_hotel)
        		WHERE vi.fecha_itinerario = '$fecha'
        		ORDER BY id_venta DESC";
    $query = new consulta($sql);

    while($row = $query->VerRegistro()){
    		$datos[] = array(
    		 'id' => $row['id_venta'] ,
    		 'id_itinerario' => $row['id_venta_itinerario'],
         'fecha_reserva' => $row['fecha_itinerario'],
    		 'nombre' => $row['nombre_hotel'] ,
         'id_servicio' => $row['id_hotel'] ,
         'tipo' => 'Hotel',
         'cliente' => $row['nombres_cliente'],
         'documento' => $row['documento_cliente']
       );
		}

		return $datos;
 	}

  static public function getVentasTotal(){
    $sql = "SELECT SUM(v.precio_venta) 'precio_total' FROM ventas v
            INNER JOIN cotizaciones c USING(id_cotizacion)
            WHERE c.estado_cotizacion = 1 AND v.bl_estado_venta < 2";
    $query = new Consulta($sql);

    $row = $query->VerRegistro();

    return $row['precio_total'];
  }

  public function getPrecio($id){
    $query = new Consulta("SELECT precio_venta FROM ventas WHERE id_venta = $id");
    $row = $query->VerRegistro();

    return $row['precio_venta'];
  }

  public function getPagos($id){
    $sql = "SELECT * FROM pagos WHERE id_venta = $id ORDER BY orden_pago ASC";
    $query  = new Consulta($sql);
    $total = 0.00;

    while ($row = $query->VerRegistro()) {
      $result[] = array(
        'orden' => $row['orden_pago'],
        'fecha' => $row['fecha_pago'],
        'pago' => $row['forma_pago'],
        'observacion' => $row['observacion_pago'],
        'monto' => $row['monto_pago']
      );
      $total += $row['monto_pago'];
    }

    $result[] = array(
      'orden' => '',
      'fecha' => '',
      'pago' => '',
      'observacion' => 'Total',
      'monto' => $total
    );

    return $result;
  }

  public function getReservaXTipo($id,$tipo_reserva){
    if ($tipo_reserva) {
      $sql = "SELECT r.id_reserva,s.nombre_servicio 'nombre',r.codigo_reserva FROM reservas r
              INNER JOIN servicios s USING(id_servicio)
              where r.tipo_reserva = 1 and r.id_venta = $id";
    }else {
      $sql = "SELECT r.id_reserva,h.nombre_hotel 'nombre',r.codigo_reserva FROM reservas r
              INNER JOIN hoteles h USING(id_hotel)
              where r.tipo_reserva = 0 and r.id_venta = $id";
    }

    $query = new Consulta($sql);

    while ($row = $query->VerRegistro()) {
      $list_reserva[] = array(
        'id_reserva' => $row["id_reserva"],
        'nombre' => $row["nombre"],
        'codigo_reserva' => $row["codigo_reserva"]
      );
    }
    return $list_reserva;
  }

  public function getEstado($bl_estado,$array,$pagado){
    if ($bl_estado == 0) {
      $html =  '<span class="text-warning">'.$array[$bl_estado].'</span>';
    }
    else if ($bl_estado == 1) {
      $html = '<span class="text-success">'.$array[$bl_estado].'</span>';
    }
    else{
      $html = '<span class="text-danger">'.$array[$bl_estado].'</span>';
    }

    if ($pagado) {
      $html .= ' / <span class="text-success">Pagado</span>';
    }
    return $html;
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
