<?php include("inc.aplication_top.php");

switch ($_GET['action']) {
    case 'edit':
        $template = 'servicio_edit.php';
        break;
    case 'add':
        $template = 'servicio_add.php';
        break;
    default:
        $template = 'servicio_list.php';
}
include(_includes_."admin/inc.header.php");

$objServicios = new Servicios();
$listadoServicios = $objServicios->getServicios();
$listadoDepartamentos = $objServicios->getDepartamentos();
$objTipoServicios = new TipoServicios();
$listadoTipoServicios = $objTipoServicios->getTipoServicios();
$objEmpresas = new Empresas();
$listadoEmpresas = $objEmpresas->getEmpresas();

if ($_GET['id']) {
   $objServicio = new Servicio($_GET['id']);
}

?>
<?php include 'menu.php'; ?>
    <?php include 'nav.php'; ?>
        <div class="content">
            <div class="container-fluid">
                
                <!-- PINTA EL TEMPLATE -->
                <?php include _view_servicio_.$template; ?>
                <!-- PINTA EL TEMPLATE -->  
                
            </div>
        </div>

    
        <!-- LLAMO AL JS DEL TEMPLATE CORRESPONDIENTE AL MODULO -->
        <script src="<?php echo _js_template_ ?>servicio.js" type="text/javascript"></script>
        <!-- LLAMO AL JS DEL TEMPLATE CORRESPONDIENTE AL MODULO -->

        <?php include 'footer.php'; ?> <!--EL FOOTER ES EL QUE CONTIENE LOS JS <--></-->
