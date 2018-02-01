<?php include("inc.aplication_top.php");

switch ($_GET['action']) {
	case 'add':
		$template = 'cliente_add.php';
		$titlecontent = "Nuevo Cliente";
		break;
	case 'edit':
		$template = 'cliente_edit.php';
		$titlecontent = "Editar Cliente";
		break;

	default:
		$template = 'cliente_list.php';
		$titlecontent = "Lista de Clientes";
		break;
}

include (_includes_."admin/inc.header.php");

$objClientes = new Clientes();
$listClientes = $objClientes->getClientes();

$objFuentes = new Fuentes();
$listFuentes = $objFuentes->getFuentes();

if ($_GET['id']) {
    $objCli= new Cliente($_GET['id']);
}

?>

<?php include 'menu.php'; ?>
    <?php include 'nav.php'; ?>
        <div class="content">
            <div class="container-fluid">

                <!-- PINTA EL TEMPLATE -->
                <?php include _view_cliente_.$template; ?>
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
        <script src="<?php echo _js_template_ ?>cliente.js" type="text/javascript"></script>
        <!-- LLAMO AL JS DEL TEMPLATE CORRESPONDIENTE AL MODULO -->

        <?php include 'footer.php'; ?> <!--EL FOOTER ES EL QUE CONTIENE LOS JS -->
