<?php include("inc.aplication_top.php");

switch ($_GET['action']) {
	case 'add':
		$template = 'venta_add.php';
    $titlecontent = "Nueva Venta";
		break;
	default:
		$template = 'reserva_list.php';
    $titlecontent = "Lista de Ventas pendientes de Reserva";
		break;
}

include (_includes_."admin/inc.header.php");

$objVentas = new Ventas();
$listVentas = $objVentas->getVentas(1);

if ($_GET['id']) {

}

?>
<?php include 'menu.php'; ?>
    <?php include 'nav.php'; ?>
        <div class="content">
            <div class="container-fluid">

                <!-- PINTA EL TEMPLATE -->
                <?php include _view_reserva_.$template; ?>
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
        <script src="<?php echo _js_template_ ?>reservas.js" type="text/javascript"></script>
        <!-- LLAMO AL JS DEL TEMPLATE CORRESPONDIENTE AL MODULO -->

        <?php include 'footer.php'; ?> <!--EL FOOTER ES EL QUE CONTIENE LOS JS -->
