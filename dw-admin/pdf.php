<?php

include("inc.aplication_top.php");
require_once(_ruta_.'dompdf/autoload.inc.php');
header("Content-Type: text/html;charset=utf-8");
use Dompdf\Dompdf;
// Introducimos HTML de prueba
$id = $_GET['id'];

$paquete = new Paquete($id);
$nombre_paquete = $paquete->__get('_nombre');
$imagen_paquete = $paquete->__get('_imagen');
$descripcion_paquete = $paquete->__get('_descripcion');
$itinerario_paquete = $paquete->__get('_itinerario');


//creacion de html

$html = '<!doctype html>
<html lang="en">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title>PDF Paquete</title>
  <link href="../aplication/webroot/css/bootstrap.min.css" rel="stylesheet" />
  <script src="../aplication/webroot/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body style="margin:0">';
$html .= '<div class="container">
          <div class="row">
          <img class="img-responsive" src="../aplication/webroot/imgs/pdf/rasgos_logo.jpg"/>
          </div>
          <div class="row">
            <h2 style="text-align:center">Nuestro compromiso</h2>
            <div class="col-md-12">
              <h3>'.htmlentities("Atención personalizada").'</h3>
              <span>'.htmlentities("Cada viajero o  grupo de viajeros a su llegada a Cusco será recibido por uno de nuestros representantes bilingüe, quién será el encargado
      de brindarle información útil de cada ciudad y destino turístico  que visitará durante su periplo por nuestro país").'.</span>
            </div>
            <div class="col-md-12">
              <h3>'.htmlentities("Compromiso Social").'</h3>
              <span>'.htmlentities("Traducida en  generación de empleo. Cada vez que usted toma nuestros servicios está generando más fuentes de empleo para pers onas
      menos favorecidas económicamente, así mismo cooperamos con las comunidades campesinas y asilos a través de comedores populares,
      visitas sociales y campañas de salud").'.</span>
            </div>
            <div class="col-md-12">
              <h3>'.htmlentities("Ética Empresarial").'</h3>
              <span>'.htmlentities("Somos  respetuosos  de  los  acuerdos  entre  su  agencia  y  nosotros.  Trabajamos  profesionalmente  cuidando  cada  detalle  en  el  servicio,
      porque sabemos que la satisfacción total de nuestros clientes es nuestra mejor garantía así como una recomendación para ustedes y
      nosotros. Cuando nuestro personal atiende a sus viajeros asume que es parte del staff de su agencia y se identifica como tal").'.</span>
            </div>
            <div class="col-md-12">
              <h3>'.htmlentities("Tarifas Competitivas").'</h3>
              <span>'.htmlentities("Nos encargamos de atender directamente a sus clientes; razón por la cual nuestras tarifas son bastante competitivas Estas, son el fruto
      de un análisis de costos más el justo beneficio por nuestro trabajo").'.</span>
            </div>
            <div class="col-md-12">
              <h3>'.htmlentities("Compromiso con el Medio Ambiente").'</h3>
              <span>'.htmlentities("Capacitamos a nuestro personal para proteger el medio ambiente y al mismo tiempo en la calidad de atención al cliente, para h acer que
      cada turista sea un promotor de nuestros servicios, nuestra cultura y nuestra riqueza naturaleza.
      Finalmente desarrollamos una comunicación estrecha con las comunidades nativas e indígenas, entrenándolos y creando una cultu ra de
      protección y conservación del medio ambiente").'.</span>
            </div>
            <div class="col-md-12">
              <h3>NUESTROS NUMEROS DE CUENTA EN DOLARES Y SOLES</h3>
              <span>'.htmlentities("Banco de Crédito").'</span><br>
              <span>RASGOS CUSCO TOURS OPERADOR EIRL</span><br>
              <span>'.htmlentities("Cuenta corriente N°: 192-2291073-1-60  en dólares americanos").'</span><br>
              <span>'.htmlentities("Cuenta corriente N°: 192-2299257-0-16 en nuevos soles").'</span>
            </div>
            <div style="text-align:center" class="col-md-12">
              <span>'.htmlentities("Dirección: Av. Larco 345 Of. 20 Miraflores").'</span><br>
              <span>Urb. Mariscal Gamarra H-12 (Costado del Colegio Comercio 41) CUSCO</span><br>
              <span>WWW.RASGOSDELPERU.COM</span><br>
            </div>
          </div>
          </div>';

// $html .= '<div><h1> Paquete - '.htmlentities($nombre_paquete).'</h1>';
// $html .= '<h1>'.$imagen_paquete.'</h1>';
// $html .= '<h1>'.htmlentities($descripcion_paquete).'</h1>';
// foreach ($itinerario_paquete as $key => $itinerario) {
//   $html .= '<h1>1-'.$key.'='.$itinerario.'</h1>';
//     $html .= '<h1>2-'.$itinerario['id_paquete_itinerario'].'</h1>';
//     $html .= '<h1>2-'.$itinerario['nombre'].'</h1>';
//     $html .= '<h1>2-'.$itinerario['descripcion'].'</h1>';
//
// }
$html .= '</body>
</html>';
// Instanciamos un objeto de la clase DOMPDF.
$pdf = new DOMPDF();

// Definimos el tamaño y orientación del papel que queremos.
$pdf->set_paper("A4", "portrait");

// Cargamos el contenido HTML.
$pdf->load_html(utf8_decode($html));

// Renderizamos el documento PDF.
$pdf->render();

// Enviamos el fichero PDF al navegador.
$pdf->stream('FicheroEjemplo.pdf');


?>
