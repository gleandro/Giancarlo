<?php include("inc.aplication_top.php");

switch ($_GET['action']) {
    case 'edit':
        $template = 'hotel_edit.php';
        break;
    case 'add':
        $template = 'hotel_add.php';
        break;
    case 'rate':
        $template = 'hotel_rate.php';
        break;
    default:
        $template = 'hotel_list.php';
        break;
}

include(_includes_."admin/inc.header.php");

$objHoteles = new Hoteles();
$listadoHoteles = $objHoteles->getHoteles();
$listadoDepartamentos = $objHoteles->getDepartamentos();

$objEmpresa = new Empresas();
$listadoEmpresas = $objEmpresa->getEmpresas();

$listadoHabitaciones = $objHoteles->getHabitaciones();

if ($_GET['id']) {
    $objHotel= new Hotel($_GET['id']);
    $listadoTarifas = $objHotel->getTarifas($_GET['id']);
}

?>
<?php include 'menu.php'; ?>
    <?php include 'nav.php'; ?>
        <div class="content">
            <div class="container-fluid">
                
                <!-- PINTA EL TEMPLATE -->
                <?php include _view_hotel_.$template; ?>
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
        <script src="<?php echo _js_template_ ?>hotel.js" type="text/javascript"></script>
        <!-- LLAMO AL JS DEL TEMPLATE CORRESPONDIENTE AL MODULO -->

        <?php include 'footer.php'; ?> <!--EL FOOTER ES EL QUE CONTIENE LOS JS -->