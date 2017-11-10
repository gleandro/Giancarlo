<?php include("inc.aplication_top.php");

switch ($_GET['action']) {
    case 'edit':
        $template = 'cotizacion_edit.php';
        break;
    case 'add':
        $template = 'cotizacion_add.php';
        break;
    default:
        $template = 'cotizacion_list.php';
        break;
}

include(_includes_."admin/inc.header.php");

$objCotizaciones = new Cotizaciones();
$listadoCotizaciones = $objCotizaciones->getCotizaciones();

$objServicios = new Servicios();
$listadoDepartamentos = $objServicios->getDepartamentos();

$objHoteles = new Hoteles();
$listadoHoteles = $objHoteles->getHoteles();

$objServicios = new Servicios();
$listadoServicios = $objServicios->getServicios();

$fuentes = Fuentes::getFuentes();
$nacionalidades = array(array('id' => '1','nombre' => 'Peruano'),array('id' => '2','nombre' => 'Extranjero'));

if ($_GET['id']) {
    $objCotizacion= new Cotizacion($_GET['id']);

    //INICIO CARGAR UBICACIONES DE LOS SERVICIOS
    foreach ($objCotizacion->__get('_departamento') as $key => $value) {
       $ubicaciones_lista .= $value.',';
    }
    $ubicaciones = substr($ubicaciones_lista, 0, -1);
    $listadoServiciosxDepartamentos = $objServicios->getServiciosxDepartamentos($ubicaciones);

    $listadoHotelesxDepartamentos = $objHoteles->getHotelesxDepartamentos($ubicaciones);
}
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
