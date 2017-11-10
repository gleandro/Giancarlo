<?php include("inc.aplication_top.php");

switch ($_GET['action']) {
    case 'add':
        $template = 'tipo_servicio_add.php';
        break;
    default:
        $template = 'tipo_servicio_list.php';
        break;
}

include(_includes_."admin/inc.header.php");

$objTipoServicios = new TipoServicios();
$listadoTipoServicios = $objTipoServicios->getTipoServicios();

?>
<?php include 'menu.php'; ?>
	<?php include 'nav.php'; ?>
        <div class="content">
            <div class="container-fluid">
            
            <!-- PINTA EL TEMPLATE -->
            <?php include _view_tipo_servicio_.$template; ?>
            <!-- PINTA EL TEMPLATE -->  

            </div>
        </div>
        

        <!-- LLAMO AL JS DEL TEMPLATE CORRESPONDIENTE AL MODULO -->
        <script src="<?php echo _js_template_ ?>tipo_servicio.js" type="text/javascript"></script>
        <!-- LLAMO AL JS DEL TEMPLATE CORRESPONDIENTE AL MODULO -->
        

        <?php include 'footer.php'; ?> <!--EL FOOTER ES EL QUE CONTIENE LOS JS -->
