<?php include("inc.aplication_top.php");

switch ($_GET['action']) {
	case 'add':
		$template = 'venta_add.php';
    $titlecontent = "Nueva Venta";
		break;
	default:
		$template = 'venta_list.php';
    $titlecontent = "Lista de Ventas";
		break;
}

include (_includes_."admin/inc.header.php");

$objVentas = new Ventas();
$listVentas = $objVentas->getVentas();

$estados = array('En espera de Reserva', 'Reservado', 'Cancelado', 'Cancelado con penalidad');

if ($_GET['id']) {
    $objVent= new Venta($_GET['id']);

		$cotizacion = $objVent->__get("_cotizacion");
		$cliente = $objVent->__get("_cliente");
		$ventas_itinerario = $objVent->__get("_itinerario");

		$departamentos = $objVent->__get('_departamento');
		$destinos = $objVentas->getDestinos($departamentos);
}

?>
<?php include 'menu.php'; ?>
    <?php include 'nav.php'; ?>
        <div class="content">
            <div class="container-fluid">

                <!-- PINTA EL TEMPLATE -->
                <?php include _view_venta_.$template; ?>
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
        <script src="<?php echo _js_template_ ?>ventas.js" type="text/javascript"></script>
        <!-- LLAMO AL JS DEL TEMPLATE CORRESPONDIENTE AL MODULO -->

        <?php include 'footer.php'; ?> <!--EL FOOTER ES EL QUE CONTIENE LOS JS -->
