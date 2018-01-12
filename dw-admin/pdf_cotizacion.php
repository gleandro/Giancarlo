<?php

include("inc.aplication_top.php");
require_once(_ruta_.'dompdf/autoload.inc.php');

// Introducimos HTML de prueba
$id = $_GET['id'];
$tipo= $_GET['tipo'];
$cotizacion = new Cotizacion($id);
$nombre_cotizacion = $cotizacion->__get('_nombre');
$imagen_cotizacion = $cotizacion->__get('_imagen');
$descripcion_cotizacion = $cotizacion->__get('_descripcion');
$itinerarios = $cotizacion->__get('_itinerario');
$cantidad_itinerario = count($cotizacion->__get('_itinerario'));

$cotizaciones = new Cotizaciones();

$array_inclusiones = $cotizaciones->getInclusiones($id,1);
$array_exclusiones = $cotizaciones->getInclusiones($id,2);
// $utilidad = $cotizacion->__get('_utilidad');

$hoteles = $cotizaciones->getHotelesxPasajeros($id);

$precios_servicios = $cotizaciones->getServiciosxCotizacion($id);
// print_r($itinerarios);

foreach ($hoteles as $key => $value) {
  $itinerario = $value['id_cotizacion_itinerario'];
  $nombre_hotel = $value['nombre_hotel'];
  $estrellas_hotel = $value['estrellas_hotel'];
  $id_habitacion = $value['id_habitacion'];
  $alcanse_habitacion = $value['cantidad_habitacion'];
  $cantidad_comprada = $value['cantidad'];
  $precio_habitacion = $value['precio'];
  $nombre_habitacion = $value['nombre_habitacion'];
  $nombres_pasajero = $value['nombres_pasajero'];
  $documento_pasajero = $value['documento_pasajero'];
  $hoteles_habitaciones_pasajeros[$itinerario]['nombre_hotel']=$nombre_hotel;
  $hoteles_habitaciones_pasajeros[$itinerario]['estrellas_hotel']=$estrellas_hotel;
  $hoteles_habitaciones_pasajeros[$itinerario]['habitacion'][$id_habitacion]['nombre_habitacion']=$nombre_habitacion;
  $hoteles_habitaciones_pasajeros[$itinerario]['habitacion'][$id_habitacion]['alcanse_habitacion']=$alcanse_habitacion;
  $hoteles_habitaciones_pasajeros[$itinerario]['habitacion'][$id_habitacion]['cantidad_comprada']=$cantidad_comprada;
  $hoteles_habitaciones_pasajeros[$itinerario]['habitacion'][$id_habitacion]['precio']=$precio_habitacion;
  $hoteles_habitaciones_pasajeros[$itinerario]['habitacion'][$id_habitacion]['pasajeros'][$key]['nombre']=$nombres_pasajero;
  $hoteles_habitaciones_pasajeros[$itinerario]['habitacion'][$id_habitacion]['pasajeros'][$key]['documento']=$documento_pasajero;
}
// echo "<pre>";
// print_r($hoteles_habitaciones_pasajeros);
// exit;
$contador = 0;

//
// $h1_n;
// $h1_e;
// $h2_n;
// $h2_e;
// $h3_n;
// $h3_e;
// $contador =1;
// foreach ($hoteles as $key => $value) {
//   if ($contador == 1) {
//     $id = $value['id_hotel'];
//   }
//   if ($id !=$value['id_hotel']) {
//     $id = $value['id_hotel'];
//   }
//   $detalle_hoteles[$value['opcion']][$value['dia']][$id]['nombre_hotel']=$value['nombre_hotel'];
//   $detalle_hoteles[$value['opcion']][$value['dia']][$id]['estrellas_hotel']=$value['estrellas_hotel'];
//   if ($value['id_habitacion'] == 1) {
//     $h1_n=$value['precio_nacional_persona'];
//     $h1_e=$value['precio_extranjero_persona'];
//     if ($h1_n != 0) {
//       $precio_hotel_servicio_n = $h1_n;
//     }else {
//       $precio_hotel_servicio_n = 0;
//     }
//     if ($h1_e != 0) {
//       $precio_hotel_servicio_e = $h1_e;
//     }else {
//       $precio_hotel_servicio_e = 0;
//     }
//     $detalle_hoteles[$value['opcion']][$value['dia']][$id]['nacional'][1]=$precio_hotel_servicio_n;
//     $detalle_hoteles[$value['opcion']][$value['dia']][$id]['extranjero'][1]=$precio_hotel_servicio_e;
//   }
//   if ($value['id_habitacion'] == 2) {
//     $h2_n=$value['precio_nacional_persona'];
//     $h2_e=$value['precio_extranjero_persona'];
//     if ($h2_n != 0) {
//       $precio_hotel_servicio_n = $h2_n;
//     }else {
//       $precio_hotel_servicio_n = 0;
//     }
//     if ($h2_e != 0) {
//       $precio_hotel_servicio_e = $h2_e;
//     }else {
//       $precio_hotel_servicio_e = 0;
//     }
//     $detalle_hoteles[$value['opcion']][$value['dia']][$id]['nacional'][2]=$precio_hotel_servicio_n;
//     $detalle_hoteles[$value['opcion']][$value['dia']][$id]['extranjero'][2]=$precio_hotel_servicio_e;
//   }
//   if ($value['id_habitacion'] == 3) {
//     $h3_n=$value['precio_nacional_persona'];
//     $h3_e=$value['precio_extranjero_persona'];
//     if ($h3_n != 0) {
//       $precio_hotel_servicio_n = $h3_n;
//     }else {
//       $precio_hotel_servicio_n = 0;
//     }
//     if ($h3_e != 0) {
//       $precio_hotel_servicio_e = $h3_e;
//     }else {
//       $precio_hotel_servicio_e = 0;
//     }
//     $detalle_hoteles[$value['opcion']][$value['dia']][$id]['nacional'][3]=$precio_hotel_servicio_n;
//
//     $detalle_hoteles[$value['opcion']][$value['dia']][$id]['extranjero'][3]=$precio_hotel_servicio_e;
//   }
//   $contador++;
// }
header("Content-Type: text/html;charset=utf-8");
if ($tipo == 1) {
  header("Content-type: application/vnd.ms-word");
  header("Content-Disposition: attachment;Filename=".$nombre_cotizacion.".doc");
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
.table-precios .cabecera3{
  background-color: #b3b3bebf;
  border: 1px solid #333;
  color: #000000;
}

</style>

</head>

<body marginwidth="0" marginheight="0">

<div id="header">
  <table>
    <tbody>
      <tr>
        <td>
          <img src="'.$_config['server']['host'].'dw-admin/logo.jpg" alt="">
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
    <h2>'.$nombre_cotizacion.'</h2>
    <h3>'.$descripcion_cotizacion.'</h3>
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
  if (is_array($array_inclusiones) || is_object($array_inclusiones)) {
    foreach ($array_inclusiones as $key => $value) {
      $formato .='<li>'.$value.'</li>';
    }
  }else {
    $formato .='<li>No existen Inclusiones</li>';
  }
  $formato .=
  '</ul>
  <p class="titulo-underline">
    NO INCLUYE:
  </p>
  <ul class="lista">';
  if (is_array($array_inclusiones) || is_object($array_inclusiones)) {
    foreach ($array_exclusiones as $key => $value) {
      $formato .='<li>'.$value.'</li>';
    }
  }else {
    $formato .='<li>No existen Exclusiones</li>';
  }
  $formato .=
  '</ul>
</div>

<hr>
<br><br>
<table class="table-precios">
    <tr>
        <td class="cabecera1" colspan ="3">
          TARIFA EN DOLARES AMERICANOS
        </td>
        <td colspan="6" rowspan="2" class="cabecera2 firma">
          PRECIO
        </td>
    </tr>
    <tr>
      <td class="cabecera2" colspan="2">Nombre</td>
      <td class="cabecera2">Documento</td>
    </tr>';
    foreach ($hoteles_habitaciones_pasajeros as $key => $dias) {
      $habitaciones = $dias['habitacion'];
      $contador ++;
      $contador_h = 1;
      $html .= '
        <tr>
          <td class="cabecera1" colspan="10">Dia '.$contador.'</td>
        </tr>
        <tr>
          <td class="cabecera1" colspan="10">Hotel : '.$dias['nombre_hotel'].' - '.$dias['estrellas_hotel'].' estrellas</td>
        </tr>';
        foreach ($habitaciones as $key => $value) {
          $pasajeros = $value['pasajeros'];
          $cantidad_comp = (float)$value['cantidad_comprada'];
          $cantidad_pasajero = (float)count($pasajeros);
          $divisor_precio = $cantidad_pasajero / $cantidad_comp ;

          if ($value['alcanse_habitacion'] < count($pasajeros)) {

            $alcanse_hab = $value['alcanse_habitacion'];
            $contador_c =1;

            foreach ($pasajeros as $key => $pasajero) {

              if ($alcanse_hab == 1) {
                $html .='
                <tr>
                  <td class="cabecera3" colspan="10">Habitacion '.$contador_h.' - '.$value['nombre_habitacion'].'</td>
                </tr>';
              }else {
                if ($contador_c == 1) {
                  $html .='
                  <tr>
                    <td class="cabecera3" colspan="10">Habitacion '.$contador_h.' - '.$value['nombre_habitacion'].'</td>
                  </tr>';
                }else {
                  $contador_h--;
                }
                if ($alcanse_hab == $contador_c) {
                  $contador_c =0 ;
                }
              }
              $precio = ceil($value['precio']/$divisor_precio);
              $html .= '
                <tr>
                  <td colspan="2">'.$pasajero['nombre'].'</td>
                  <td>'.$pasajero['documento'].'</td>
                  <td colspan="7" style="text-align:center">$'.$precio.'</td>
                </tr>';
              $contador_c++;
              $contador_h++;
              // print_r($pasajero);
              // echo "<br>";
            }
          }else{
            $html .='
            <tr>
              <td class="cabecera3" colspan="10">Habitacion '.$contador_h.' - '.$value['nombre_habitacion'].'</td>
            </tr>';
            foreach ($pasajeros as $key => $pasajero) {
              $precio = ceil($value['precio']/$divisor_precio);
              $html .='
                <tr>
                  <td colspan="2">'.$pasajero['nombre'].'</td>
                  <td>'.$pasajero['documento'].'</td>
                  <td colspan="7" style="text-align:center">$'.$precio.'</td>
                </tr>';
            }
            $contador_h++;
          }

        }

      $html .= '</tr>';
    }
    // foreach ($detalle_hoteles as $key => $opcion) {
    //   //variables totales nacionales
    //   $vt_n1=0.00;
    //   $vt_n2=0.00;
    //   $vt_n3=0.00;
    //   //variables totales extranjeras
    //   $vt_e1=0.00;
    //   $vt_e2=0.00;
    //   $vt_e3=0.00;
    //   $html ='
    //   <tr>
    //   <td class="cabecera1" colspan="10">Opcion'.($key+1).'</td>
    //   </tr>';
    //
    //   foreach ($opcion as $key2 => $dia) {
    //     $html .='<tr style="text-align:left">
    //               <td></td>';
    //   foreach ($dia as $key3 => $hotel) {
    //     if ($hotel["nombre_hotel"]=='') {
    //       $hotel["nombre_hotel"] = "";
    //     }
    //     $html.='<td colspan="2" style="text-align:left">'.$hotel["nombre_hotel"].'</td>';
    //     //variables nacionales
    //     $v_n1=0.00;
    //     $v_n2=0.00;
    //     $v_n3=0.00;
    //     //variables extranjeras
    //     $v_e1=0.00;
    //     $v_e2=0.00;
    //     $v_e3=0.00;
    //
    //     if (is_array($hotel["nacional"]) || is_object($hotel["nacional"]))
    //     {
    //       foreach ($hotel["nacional"] as $key => $value) {
    //         if ($key == 1) {
    //           $v_n1=$value;
    //         }
    //         if ($key == 2) {
    //           $v_n2=$value;
    //         }
    //         if ($key == 3) {
    //           $v_n3=$value;
    //         }
    //       }
    //     }
    //     if (is_array($hotel["extranjero"]) || is_object($hotel["extranjero"]))
    //     {
    //       foreach ($hotel["extranjero"] as $key => $value) {
    //         if ($key == 1) {
    //           $v_e1=$value;
    //         }
    //         if ($key == 2) {
    //           $v_e2=$value;
    //         }
    //         if ($key == 3) {
    //           $v_e3=$value;
    //         }
    //       }
    //     }
    //     //variables nacionales
    //     $vt_n1+=$v_n1;
    //     $vt_n2+=$v_n2;
    //     $vt_n3+=$v_n3;
    //     //variables extranjeras
    //     $vt_e1+=$v_e1;
    //     $vt_e2+=$v_e2;
    //     $vt_e3+=$v_e3;
    //
    //
    //     $html.='<td>'.$hotel["estrellas_hotel"].'</td>';
    //     // $html.='<td>$'.number_format($v_e1, 2, '.', '').'</td>';
    //     // $html.='<td>$'.number_format($v_e2, 2, '.', '').'</td>';
    //     // $html.='<td>$'.number_format($v_e3, 2, '.', '').'</td>';
    //     // $html.='<td>$'.number_format($v_n1, 2, '.', '').'</td>';
    //     // $html.='<td>$'.number_format($v_n2, 2, '.', '').'</td>';
    //     // $html.='<td>$'.number_format($v_n3, 2, '.', '').'</td>';
    //     $html.='<td></td>';
    //     $html.='<td></td>';
    //     $html.='<td></td>';
    //     $html.='<td></td>';
    //     $html.='<td></td>';
    //     $html.='<td></td>';
    //
    //   }
    //       $html .='</tr>';
    //   }
    //   $html .='<tr style="text-align:right">
    //   <td colspan="3" style="color:red">Total</td>
    //   <td></td>
    //   <td style="text-align:center">$'.ceil(($vt_e1+$precios_servicios['precio_extranjero'])*(($utilidad/100)+1)).'</td>
    //   <td style="text-align:center">$'.ceil(($vt_e2+$precios_servicios['precio_extranjero'])*(($utilidad/100)+1)).'</td>
    //   <td style="text-align:center">$'.ceil(($vt_e3+$precios_servicios['precio_extranjero'])*(($utilidad/100)+1)).'</td>
    //   <td style="text-align:center">$'.ceil(($vt_n1+$precios_servicios['precio_nacional'])*(($utilidad/100)+1)).'</td>
    //   <td style="text-align:center">$'.ceil(($vt_n2+$precios_servicios['precio_nacional'])*(($utilidad/100)+1)).'</td>
    //   <td style="text-align:center">$'.ceil(($vt_n3+$precios_servicios['precio_nacional'])*(($utilidad/100)+1)).'</td>
    //   </tr>';
    //
      $formato .=$html;
    // }

  $formato .=
  '</table>
</body>
</html>';
// echo $formato;
// exit;
if ($tipo == 1) {
  echo $formato;
}

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
$pdf->stream($nombre_cotizacion);
// echo $formato;
?>
