<?php include("inc.aplication_top.php");

switch ($_GET['action']) {
    case 'edit':
        $template = 'paquete_edit.php';
        break;
    case 'add':
        $template = 'paquete_add.php';
        break;
    default:
        $template = 'paquete_list.php';
        break;
}

include(_includes_."admin/inc.header.php");

$objPaquetes = new Paquetes();
$listadoPaquetes = $objPaquetes->getPaquetes();

$objServicios = new Servicios();
$listadoDepartamentos = $objServicios->getDepartamentos();

$objHoteles = new Hoteles();
$listadoHoteles = $objHoteles->getHoteles();

$objServicios = new Servicios();
$listadoServicios = $objServicios->getServicios();

if ($_GET['id']) {
    $objPaquete= new Paquete($_GET['id']);

    //INICIO CARGAR UBICACIONES DE LOS SERVICIOS
    foreach ($objPaquete->__get('_departamento') as $key => $value) {
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
                <?php include _view_paquete_.$template; ?>
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
        <script src="<?php echo _js_template_ ?>paquete.js" type="text/javascript"></script>
        <!-- LLAMO AL JS DEL TEMPLATE CORRESPONDIENTE AL MODULO -->

        <?php include 'footer.php'; ?> <!--EL FOOTER ES EL QUE CONTIENE LOS JS -->
