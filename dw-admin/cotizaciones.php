<?php include("inc.aplication_top.php");

switch ($_GET['action']) {
    case 'sell':
        $template = 'cotizacion_sell.php';
        $titlecontent = "Editar Cotización";
        break;
    case 'add':
        $template = 'cotizacion_add.php';
        $titlecontent = "Nueva Cotización";
        break;
    default:
        $template = 'cotizacion_list.php';
        $titlecontent = "Lista de Cotizaciones";
        break;
}

include(_includes_."admin/inc.header.php");

$objCotizaciones = new Cotizaciones();
$listadoCotizaciones = $objCotizaciones->getCotizaciones();

$objClientes = new Clientes();
$listadoClientes = $objClientes->getClientes();

$objPaquetes = new Paquetes();
$listaPaquetes = $objPaquetes->getPaquetes();

$objServicios = new Servicios();
$listadoDepartamentos = $objServicios->getDepartamentos();

$objHoteles = new Hoteles();
$listadoHoteles = $objHoteles->getHoteles();

$listadoServicios = $objServicios->getServicios();

$fuentes = Fuentes::getFuentes();
$nacionalidades = array(array('id' => '1','nombre' => 'Peruano'),array('id' => '2','nombre' => 'Extranjero'));

$objAgencias = new Agencias();
$listadoAgencias = $objAgencias->getAgencias();

if ($_GET['id']) {
  $list_pasajeros = Cotizaciones::getPasajeros($_GET['id']);
}
// print_r($cotizacion_itinerario);
// exit;
?>
<?php include 'menu.php'; ?>
    <?php include 'nav.php'; ?>
        <div class="content">
            <div class="container-fluid">

                <!-- PINTA EL TEMPLATE -->
                <?php include _view_cotizacion_.$template; ?>
                <!-- PINTA EL TEMPLATE -->

            </div>
        </div>

        <!-- HOTELES -->
        <style>
            .thumb{
                text-align: center;
                max-width: 100%;
                max-height: 200px;
                border: 1px solid #000;
                margin: 10px 5px 0 0;
            }
            output#list{
                text-align: center;
            }
        </style>
        <!-- HOTELES -->

        <!-- LLAMO AL JS DEL TEMPLATE CORRESPONDIENTE AL MODULO -->
        <script src="<?php echo _js_template_ ?>cotizacion.js" type="text/javascript"></script>
        <!-- LLAMO AL JS DEL TEMPLATE CORRESPONDIENTE AL MODULO -->

        <?php include 'footer.php'; ?> <!--EL FOOTER ES EL QUE CONTIENE LOS JS -->
