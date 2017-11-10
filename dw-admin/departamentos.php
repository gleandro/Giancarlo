<?php include("inc.aplication_top.php");

switch ($_GET['action']) {
    case 'add':
        $template = 'departamento_add.php';
        break;
    default:
        $template = 'departamento_list.php';
        break;
}

include(_includes_."admin/inc.header.php");

$objDepartamentos = new Departamentos();
$listadoDepartamentos = $objDepartamentos->getDepartamentos();

?>
<?php include 'menu.php'; ?>
	<?php include 'nav.php'; ?>
        <div class="content">
            <div class="container-fluid">
            
            <!-- PINTA EL TEMPLATE -->
            <?php include _view_departamento_.$template; ?>
            <!-- PINTA EL TEMPLATE -->  

            </div>
        </div>
        

        <!-- LLAMO AL JS DEL TEMPLATE CORRESPONDIENTE AL MODULO -->
        <script src="<?php echo _js_template_ ?>departamento.js" type="text/javascript"></script>
        <!-- LLAMO AL JS DEL TEMPLATE CORRESPONDIENTE AL MODULO -->
        

        <?php include 'footer.php'; ?> <!--EL FOOTER ES EL QUE CONTIENE LOS JS -->
