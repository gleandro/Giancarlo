<?php 

include("inc.aplication_top.php");

switch ($_GET['action']) {
    case 'edit':
        $template = 'empresa_edit.php';
        break;
    case 'add':
        $template = 'empresa_add.php';
        break;
    default:
        $template = 'empresa_list.php';
        break;
}

include(_includes_."admin/inc.header.php");

$objEmpresa = new Empresas();
$listadoEmpresas = $objEmpresa->getEmpresas();
$listaTipoEmpresa = $objEmpresa->getTiposEmpresa();

if($_GET['id']) {
  $objEmpresa=new Empresa($_GET['id']);
}

?>
<?php include 'menu.php'; ?>
	<?php include 'nav.php'; ?>
        <div class="content">
            <div class="container-fluid">

            <!-- PINTA EL TEMPLATE -->
            <?php include _view_empresa_.$template; ?>
            <!-- PINTA EL TEMPLATE -->       

            </div>
        </div>
        

        <!-- LLAMO AL JS DEL TEMPLATE CORRESPONDIENTE AL MODULO -->
        <script src="<?php echo _js_template_ ?>empresa.js" type="text/javascript"></script>
        <!-- LLAMO AL JS DEL TEMPLATE CORRESPONDIENTE AL MODULO -->
        
        <?php include 'footer.php'; ?> <!--EL FOOTER -->
        