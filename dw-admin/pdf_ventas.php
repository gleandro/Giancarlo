<?php

include("inc.aplication_top.php");
require_once(_ruta_.'dompdf/autoload.inc.php');

date_default_timezone_set("America/Lima");

$fecha_actual = date('d \d\\e M Y');
$anio_actual = date('Y');

// Introducimos HTML de prueba
$id = $_GET['id'];
$id_agencia = $_GET['agencia'];

$venta = new Venta($id);

$nombre_venta = $venta->__get('_nombre');
$cantidad_pasajeros = $venta->__get('_cantidad_pasajeros');
$pasajeros = $venta->__get('_pasajeros');
$precio = $venta->__get('_precio');

$cliente = $venta->__get('_id_cliente');
$nombre_cliente = $cliente->__get('_nombres');
$documento = $cliente->__get('_documento');

$first = true;

$hoteles = Ventas::getHoteles($id);
$servicios = Ventas::getServicios($id);

// echo "<pre>";
// print_r($hoteles);
// echo "</pre>";

header("Content-Type: text/html;charset=utf-8");

$formato_header ='<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">

  <title>Rasgos del Perú</title>
  <style type="text/css">

  @page {
    margin: 0.5cm 1cm 3cm 1cm;
  }

  body {
    font-family: sans-serif;
    margin: 0.5cm 0;
    text-align: justify;
    padding-top: 2cm;
  }

  #header,
  #footer {
    position: fixed;
    left: 0;
    right: 0;
    color: #aaa;
    font-size: 0.9em;
  }

  #header {
    top: 0;
    color: #663300;
  }

  #footer {
    bottom: 0;
    border-top: 0.1pt solid #aaa;
  }

  #header table,
  #footer table {
    width: 100%;
    border-collapse: collapse;
    border: none;
  }

  #header td,
  #footer td{
    padding: 0;
    width: 50%;
  }

  .firma{
    text-align: center;
  }
  .page-number {
    text-align: center;
  }

  .page-number:before {
    content: "Página " counter(page);
  }

  hr {
    page-break-after: always;
    border: 0;
  }
  .container{
    align-items: center;
  }

  .star{
    width: 24px;
    margin-bottom: -1px;
  }

  .table-voucher th,.table-voucher td {
    border: 1px solid #333;
  }

  .table-voucher{
    width: 100%;
    font-size: 12px;
    color: #333;
  }
  .table-voucher .cabecera1{
    background-color: #8c5528;
    color: white;
  }
  .table-voucher .celda{
    background-color: white;
    color: black;
    font-weight: 600;
  }

  .table-voucher .dato{
    background-color: #d0beb4;
    color: black;
  }
  .center{
    text-align: center;
    vertical-align: middle;
    color: #c5937f;
  }

  .red{
    color:red !important;
  }

  .black{
    color:black !important;
  }

  .gray{
    color:gray !important;
  }

  .bg-yellow{
    background-color: yellow !important;
  }

  </style>

</head>

<body marginwidth="0" marginheight="0">

  <div id="header">
    <table>
      <tbody>
        <tr>
          <td>
            <img src="logo.jpg" alt="">
          </td>
          <td class="center">
            <h1>VOUCHERS '.$anio_actual.'-'.$id.'</h1>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="footer">
    <div class="firma">
      <p style="font-size: 11px; color: #333">Dirección: Av. Larco 345 Of. 20 Miraflores <br>
        Urb. Mariscal Gamarra H-12 (Costado del Colegio Comercio 41) CUSCO <br>
        <span style="text-decoration: underline;">WWW.RASGOSDELPERU.COM</span> </p>
    </div>
    <div class="page-number"></div>
  </div>
  ';

  // INICIO CUERPO DE PDF HOTEL

  foreach ($hoteles as $key_h => $hotel) {
    $itinerarios = $hotel['itinerario'];
    $estrellas = $hotel['estrellas'];

    $formato_hotel .='
    <div class="container">
    <table class="table-voucher center">
      <tr>
        <td class="cabecera1 center" colspan ="4">
          <h2>HOTEL : '.$hotel['nombre_hotel'];
          for ($i=0; $i < $estrellas; $i++) { $formato_hotel.='<img class="star" src="star.png" alt="">'; }
          $formato_hotel .= '</h2>
        </td>
      </tr>
      <tr>
        <td class="celda">Nombre Cliente</td><td class="dato" colspan="3">'.$nombre_cliente.'</td>
      </tr>
      <tr>
        <td class="celda">Cantidad PAX</td><td class="dato">'.$cantidad_pasajeros.'</td>
        <td class="celda">Codigo Reserva</td><td class="dato">'.$hotel['codigo_reserva'].'</td>
      </tr>
      <tr>
        <td class="cabecera1" colspan="4"><h3>Lista de Pasajeros<h3></td>
      </tr>
      <tr>
        <td class="cabecera1 center">Nombre</td>
        <td class="cabecera1 center">Documento</td>
        <td class="cabecera1 center">Nacionalidad</td>
        <td class="cabecera1 center">Sexo</td>
      </tr>';
      foreach ($pasajeros as $key_p => $pasajero) {
        $nacionalidad = ($pasajero['nacionalidad']) ? 'Extranjero' : 'Nacional';
        $sexo = ($pasajero['sexo']) ? 'Femenino' : 'Masculino';
        $formato_hotel .='<tr>
            <td class="dato center">'.$pasajero['nombre'].'</td>
            <td class="dato center">'.$pasajero['documento'].'</td>
            <td class="dato center">'.$nacionalidad.'</td>
            <td class="dato center">'.$sexo.'</td>
            </tr>';
      }
      $formato_hotel .= '
      <tr>
        <td class="cabecera1" colspan="4"><h3>Detalle Itinerario<h3></td>
      </tr>
      <tr>
        <td class="cabecera1 center">Ingreso</td>
        <td class="cabecera1 center">Salida</td>
        <td class="cabecera1 center">Ciudad</td>
        <td class="cabecera1 center">Tipo Habitación</td>
      </tr>';

      foreach ($itinerarios as $key_i => $itinerario) {
        $habitaciones = $itinerario['habitaciones'];
        $fecha_get = date_create($itinerario['fecha_itinerario']);
        $fecha_ingreso = date_format($fecha_get,'d \d\\e M Y');
        $fecha_salida = date_add($fecha_get,date_interval_create_from_date_string('1 days'));
        $fecha_salida = date_format($fecha_salida,'d \d\\e M Y');

        $formato_hotel .= '
        <tr>
          <td class="dato center">'.$fecha_ingreso.'</td>
          <td class="dato center">'.$fecha_salida.'</td>
          <td class="dato center">'.$hotel['nombre_departamento'].'</td>
          <td class="dato center">';
          foreach ($habitaciones as $key_ha => $habitacion) {
            $cantidad = sprintf("%02d",$habitacion['cantidad']);
            $formato_hotel .= '<span>'.$cantidad.' - '.$habitacion['nombre_habitacion'].'</span><br>';
          }

          if ($first) {
            $fecha_inicio = $fecha_ingreso;
            $first = false;
          }

        $formato_hotel .=
        '</td>
        </tr>';

      }

$formato_hotel .= '
      <tr>
        <td class="cabecera1 center" colspan ="4">
        <h3>Contacto Hotel</h3>
        </td>
      </tr>
      <tr>
        <td class="celda center">Nombre Contacto</td><td class="dato center">'.$hotel['nombre_contacto'].'</td>
        <td class="celda center">Numero Contacto</td><td class="dato center">'.$hotel['numero_contacto'].'</td>
      </tr>
    </table>
  </div> <hr>';
  }

// FIN CUERPO DE PDF HOTEL

// INICIO CUERPO DE PDF SERVICIO

  $formato_servicio .='
  <div class="container">
  <table class="table-voucher center">
    <tr>
      <td class="cabecera1 center" colspan ="4">
        <h3>Datos del cliente</h3>
      </td>
    </tr>
    <tr>
      <td class="celda">Nombre Cliente</td><td class="dato" colspan="3">'.$nombre_cliente.'</td>
    </tr>
    <tr>
      <td class="celda">Cantidad PAX</td><td class="dato">'.$cantidad_pasajeros.'</td>

    </tr>
    <tr>
      <td class="cabecera1" colspan="4"><h3>Lista de Pasajeros<h3></td>
    </tr>
    <tr>
      <td class="cabecera1 center">Nombre</td>
      <td class="cabecera1 center">Documento</td>
      <td class="cabecera1 center">Nacionalidad</td>
      <td class="cabecera1 center">Sexo</td>
    </tr>';
    foreach ($pasajeros as $key_p => $pasajero) {
      $nacionalidad = ($pasajero['nacionalidad']) ? 'Extranjero' : 'Nacional';
      $sexo = ($pasajero['sexo']) ? 'Femenino' : 'Masculino';
      $formato_servicio .='<tr>
          <td class="dato center">'.$pasajero['nombre'].'</td>
          <td class="dato center">'.$pasajero['documento'].'</td>
          <td class="dato center">'.$nacionalidad.'</td>
          <td class="dato center">'.$sexo.'</td>
          </tr>';
    }
    $formato_servicio .= '
    <tr>
      <td class="cabecera1" colspan="4"><h3>Detalle Itinerario<h3></td>
    </tr>
    <tr>
      <td class="cabecera1 center">Ingreso</td>
      <td class="cabecera1 center">Ciudad</td>
      <td class="cabecera1 center">Nombre Servicio</td>
      <td class="cabecera1 center">Codigo Reserva</td>
    </tr>';

    foreach ($servicios as $key_s => $servicio) {
      $fecha_get = date_create($servicio['fecha_itinerario']);
      $fecha_ingreso = date_format($fecha_get,'d \d\\e M Y');


      $formato_servicio .= '
      <tr>
        <td class="dato center">'.$fecha_ingreso.'</td>
        <td class="dato center">'.$servicio['nombre_departamento'].'</td>
        <td class="dato center">'.$servicio['nombre_servicio'].'</td>
        <td class="dato center">'.$servicio['codigo_reserva'].'</td>
      </tr>';

    }

$formato_servicio .= '
    <tr>
      <td class="cabecera1 center" colspan ="4">
      <h3>Contacto Servicio</h3>
      </td>
    </tr>
    <tr>
      <td class="celda center">Nombre Contacto</td><td class="dato center">'.$hotel['nombre_contacto'].'</td>
      <td class="celda center">Numero Contacto</td><td class="dato center">'.$hotel['numero_contacto'].'</td>
    </tr>
  </table>
</div>';


// FIN CUERPO DE PDF SERVICIO

// INICIO CUERPO LIQUIDACION

if ($id_agencia) {
  $incentivo = (float)$_GET['incentivo'];
  $comision = (float)$_GET['comision'];
  $fecha_v = date_create($_GET['fecha']);
  $fecha_limite = date_format($fecha_v,'d \d\\e M Y');
  $incentito_pasajero = (float)($incentivo*$cantidad_pasajeros);
  $precio_p = (float)($precio-$incentito_pasajero);
  $comision_final = (float)(($precio_p/100)*$comision);
  $total_pagar = ceil($precio-$incentito_pasajero-$comision_final);

  // ventas::addLiquidacion();

  $formato_agencia .= '<div class="container">
    <table class="table-voucher center">
    <tr>
      <td class="cabecera1" colspan="2"><h3>CONFIRMACION DE PROGRAMA Y ORDEN DE PAGO</h3></td>
    </tr>
    <tr>
      <td class="celda" >Fecha</td>
      <td class="dato">'.$fecha_actual.'</td>
    </tr>
    <tr>
      <td class="celda">Cliente</td>
      <td class="dato">'.$nombre_cliente.'</td>
    </tr>
    <tr>
      <td class="celda">Pasajeros</td>
      <td class="dato">'.$cantidad_pasajeros.'</td>
    </tr>
    <tr>
      <td class="celda">Operador</td>
      <td class="dato">Rasgos del Perú</td>
    </tr>
    <tr>
      <td class="celda">Check in</td>
      <td class="dato">'.$fecha_inicio.'</td>
    </tr>
    <tr>
      <td class="celda">Check out</td>
      <td class="dato">'.$fecha_ingreso.'</td>
    </tr>
    <tr>
      <td class="cabecera1"><h3>Detalle del Servicio</h3></td>
      <td class="cabecera1"><h3>Total</h3></td>
    </tr>
    <tr>
      <td class="celda">'.$nombre_venta.'</td>
      <td class="celda">$'.$precio.'</td>
    </tr>
    <tr>
      <td class="celda">$'.$incentivo.' de incentivo</td>
      <td class="celda">$'.$incentito_pasajero.'</td>
    </tr>
    <tr>
      <td class="celda red">'.$comision.'% de comision</td>
      <td class="celda">$'.$comision_final.'</td>
    </tr>
    <tr>
      <td class="celda red bg-yellow">Total a pagar</td>
      <td class="celda red bg-yellow">$'.$total_pagar.' USD</td>
    </tr>
    <tr>
      <td colspan="2" class="black">(*) Precio expresado en dólares americanos</td>
    </tr>
    <tr>
      <td colspan="2" class="gray">Favor de pagar por los servicios hasta el <span class="black"><b>'.$fecha_limite.'</b></span> al siguiente numero de cuenta  Cta Corriente en dólares Banco de Crédito del Perú <span class="black"><b>N°194-2332556-1-80 </b></span> a favor de GRUPO RASGOS DEL PERU</td>
    </tr>
    </table>
  </div>';




}

// FIN CUERPO LIQUIDACION

  $formato_footer .= '
</body>
</html>';

  $formato_hotel = $formato_header.$formato_hotel.$formato_footer;
  $formato_servicio = $formato_header.$formato_servicio.$formato_footer;
  if ($id_agencia) {
    $formato_agencia = $formato_header.$formato_agencia.$formato_footer;
  }

  // exit;

  use Dompdf\Dompdf;
  // Instanciamos un objeto de la clase DOMPDF.
  $pdf_hotel = new DOMPDF();
  // Cargamos el contenido HTML.
  $pdf_hotel->load_html($formato_hotel);
  // Definimos el tamaño y orientación del papel que queremos.
  $pdf_hotel->set_paper("A4", "portrait");
  // Renderizamos el documento PDF.
  $pdf_hotel->render();

  $ruta_h = _pdf_ventas_.$documento."_hotel.pdf";
  file_put_contents($ruta_h, $pdf_hotel->output());


  $pdf_servicio = new DOMPDF();
  $pdf_servicio->load_html($formato_servicio);
  $pdf_servicio->set_paper("A4", "portrait");
  $pdf_servicio->render();

  $ruta_s = _pdf_ventas_.$documento."_servicio.pdf";
  file_put_contents($ruta_s, $pdf_servicio->output());

  if ($id_agencia) {
    $pdf_agencia = new DOMPDF();
    $pdf_agencia->load_html($formato_agencia);
    $pdf_agencia->set_paper("A4", "portrait");
    $pdf_agencia->render();

    $ruta_a = _pdf_ventas_.$documento."_liquidacion.pdf";
    file_put_contents($ruta_a, $pdf_agencia->output());
  }

  $result['url'] = _pdf_url_ventas_.$documento;
  $result['documento'] = $documento;

  echo json_encode($result);
