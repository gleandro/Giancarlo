<?php include("inc.aplication_top.php");

switch ($_GET['action']) {
	default:
	$template = 'reporte_list.php';
	$titlecontent = "Lista de Reportes";
	break;
}

include (_includes_."admin/inc.header.php");

$objVentas = new Ventas();

$listVentas = $objVentas->getVentasHoy();

?>
<?php include 'menu.php'; ?>
<?php include 'nav.php'; ?>
<div class="content">
	<div class="container-fluid">

		<!-- PINTA EL TEMPLATE -->
		<?php include _view_reporte_.$template; ?>
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
<script src="<?php echo _js_template_ ?>reportes.js" type="text/javascript"></script>
<!-- LLAMO AL JS DEL TEMPLATE CORRESPONDIENTE AL MODULO -->

<?php include 'footer.php'; ?> <!--EL FOOTER ES EL QUE CONTIENE LOS JS -->
