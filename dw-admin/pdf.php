<?php

include("inc.aplication_top.php");
require_once(_ruta_.'dompdf/autoload.inc.php');
header("Content-Type: text/html;charset=utf-8");

// Introducimos HTML de prueba
$id = $_GET['id'];

$paquete = new Paquete($id);
$nombre_paquete = $paquete->__get('_nombre');
$imagen_paquete = $paquete->__get('_imagen');
$descripcion_paquete = $paquete->__get('_descripcion');
$itinerarios = $paquete->__get('_itinerario');
$cantidad_itinerario = count($paquete->__get('_itinerario'));

$paquetes = new Paquetes();

$array_itinerario = array();

$array_inclusiones = $paquetes->getInclusiones($id,1);
$array_exclusiones = $paquetes->getInclusiones($id,2);

$hoteles = $paquetes->getHotelesxDepartamento_2($id);

$h1_n;
$h1_e;
$h2_n;
$h2_e;
$h3_n;
$h3_e;

$contador =1;


foreach ($hoteles as $key => $value) {
  if ($contador == 1) {
    $id = $value['id_hotel'];
  }
  if ($id !=$value['id_hotel']) {
    $id = $value['id_hotel'];
  }
  $detalle_hoteles[$id]['nombre_hotel']=$value['nombre_hotel'];
  if ($value['id_habitacion'] == 1) {
    $h1_n=$value['precio_nacional_persona'];
    $h1_e=$value['precio_extranjero_persona'];
    $detalle_hoteles[$id]['nacional'][1]=$h1_n;
    $detalle_hoteles[$id]['extranjero'][1]=$h1_e;
  }
  if ($value['id_habitacion'] == 2) {
    $h2_n=$value['precio_nacional_persona'];
    $h2_e=$value['precio_extranjero_persona'];
    $detalle_hoteles[$id]['nacional'][2]=$h2_n;
    $detalle_hoteles[$id]['extranjero'][2]=$h2_e;
  }
  if ($value['id_habitacion'] == 3) {
    $h3_n=$value['precio_nacional_persona'];
    $h3_e=$value['precio_extranjero_persona'];
    $detalle_hoteles[$id]['nacional'][3]=$h3_n;
    $detalle_hoteles[$id]['extranjero'][3]=$h3_e;
  }
  $contador++;
}
$formato='<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
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
  border-bottom: 0.1pt solid #aaa;
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
#footer td {
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

.titulo-paquete{
  text-align: right;
}
.titulo-paquete h2{
    color: #663300;
    line-height: 30px;
    margin-bottom: 5px;
    font-size: 35px;
}
.titulo-paquete h3{
    color: #ff9901;
    line-height: 20px;
    font-size: 22px;
    margin-top: 5px;
    margin-bottom: 5px;
}
.descripcion-paquete .titulo{
    color: #663300;
    font-size: 12px;
    font-weight: 600;
}
.descripcion-paquete .titulo-center{
    color: #663300;
    font-size: 12px;
    font-weight: 600;
    text-align: center;
}
.descripcion-paquete .titulo-underline{
    color: #663300;
    font-size: 12px;
    font-weight: 600;
    text-decoration: underline;
}
.descripcion-paquete .parrafo{
    color: #333;
    font-size: 12px;
    font-weight: 400;
}
.descripcion-paquete .lista li{
    color: #333;
    font-size: 12px;
    font-weight: 400;
}
.table-precios{
  width: 100%;
  font-size: 12px;
  color: #333;
}
.table-precios .cabecera1{
  background-color: #ffc000;
  border: 1px solid #333;
  color: #974706
}
.table-precios .cabecera2{
  background-color: #974706;
  border: 1px solid #333;
  color: #ffc000;
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
        <td style="text-align: center;">
          <p> <span style="font-weight: 600">CENTRAL TELEFÓNICA </span> <br>
             4478100
             EXT. 101-105-106 <br>
             <span style="font-weight: 600">RPM: (#) 94320-2320 (#) 95745-5253 (#) 96452-7499 </span>
          </p>
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

<div class="titulo-paquete">
    <h2>'.$nombre_paquete.'</h2>
    <h3>'.$descripcion_paquete.'</h3>
</div>
<div class="descripcion-paquete">
  <p class="titulo">
    ITINERARIO:
  </p>';
  foreach ($itinerarios as $key => $value) {
    $formato .='<div>
    <p class="titulo">
      Día '.($key+1).': '.$value["nombre"].'
    </p>
    <p class="parrafo">
      '.$value["descripcion"].'
    </p>
    </div>';
  }
  $formato .=
  '<p class="titulo-center">
    Fin de los servicios
  </p>
  <p class="titulo-underline">
    INCLUYE:
  </p>
  <ul class="lista">
  ';
  foreach ($array_inclusiones as $key => $value) {
    $formato .='<li>'.$value.'</li>';
  }
  $formato .=
  '</ul>
  <p class="titulo-underline">
    NO INCLUYE:
  </p>
  <ul class="lista">';
  foreach ($array_exclusiones as $key => $value) {
    $formato .='<li>'.$value.'</li>';
  }
  $formato .=
  '</ul>
</div>

<hr>
<br><br>
<table class="table-precios">
    <tr>
        <td class="cabecera1">
          TARIFA EN DOLARES AMERICANOS
        </td>
        <td rowspan="2" class="cabecera2">

        </td>
        <td colspan="3" class="cabecera2">
          EXTRANJEROS
        </td>
        <td colspan="3" class="cabecera2">
          NACIONALES
        </td>
    </tr>
    <tr>
      <td class="cabecera1">
        HOTEL
      </td>

      <td class="cabecera2">SWB</td>
      <td class="cabecera2">DWB</td>
      <td class="cabecera2">TWB</td>

      <td class="cabecera2">SWB</td>
      <td class="cabecera2">DWB</td>
      <td class="cabecera2">TWB</td>
    </tr>';
    foreach ($detalle_hoteles as $key => $hotel) {
      $html="<tr>";
      $html.="<td>".$hotel['nombre_hotel']."</td>";
      $html.="<td>Expedition</td>";

      //variables nacionales
      $v_n1="-";
      $v_n2="-";
      $v_n3="-";
      //variables extranjeras
      $v_e1="-";
      $v_e2="-";
      $v_e3="-";

      foreach ($hotel['nacional'] as $key => $value) {
        if ($key == 1) {
          $v_n1="$".$value;
        }
        if ($key == 2) {
          $v_n2="$".$value;
        }
        if ($key == 3) {
          $v_n3="$".$value;
        }
      }
      foreach ($hotel['extranjero'] as $key => $value) {
        if ($key == 1) {
          $v_e1="$".$value;
        }
        if ($key == 2) {
          $v_e2="$".$value;
        }
        if ($key == 3) {
          $v_e3="$".$value;
        }
      }
      $html.="<td>".$v_e1."</td>";
      $html.="<td>".$v_e2."</td>";
      $html.="<td>".$v_e3."</td>";
      $html.="<td>".$v_n1."</td>";
      $html.="<td>".$v_n2."</td>";
      $html.="<td>".$v_n3."</td>";
      $html.="</tr>";
      $formato.=$html;
    }

  $formato .=
  '</table>
</body>
</html>';
use Dompdf\Dompdf;
// Instanciamos un objeto de la clase DOMPDF.
$pdf = new DOMPDF();

// Cargamos el contenido HTML.
$pdf->load_html($formato);

// Definimos el tamaño y orientación del papel que queremos.
$pdf->set_paper("A4", "portrait");


// Renderizamos el documento PDF.
$pdf->render();

// Enviamos el fichero PDF al navegador.
$pdf->stream();


?>
