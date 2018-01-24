<?php include("inc.aplication_top.php");

switch ($_GET['action']) {
	case 'reserve':
	$template = 'venta_reserve.php';
	$titlecontent = "Reserva de Servicios";
	break;
	case 'pago':
	$template = 'venta_pago.php';
	$titlecontent = "Registro de Pago";
	break;
	default:
	$template = 'venta_list.php';
	$titlecontent = "Lista de Ventas";
	break;
}

include (_includes_."admin/inc.header.php");

$objVentas = new Ventas();
$listVentas = $objVentas->getVentas();

$estados = array('x Reservar', 'Confirmado', 'Cancelado', 'Cancelado con penalidad');

if ($_GET['id']) {
	if ($_GET['action'] == "reserve") {
		$list_hoteles = $objVentas->getReservaXTipo($_GET['id'],0);
		$list_servicios = $objVentas->getReservaXTipo($_GET['id'],1);
	}
	if ($_GET['action'] == "pago") {
		$precio_venta = $objVentas->getPrecio($_GET['id']);
		$list_pagos = $objVentas->getPagos($_GET['id']);
	}
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
