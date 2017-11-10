<?php include("inc.aplication_top.php");

switch ($_GET['action']) {
    case 'add':
      $template = 'habitacion_add.php';
      break;
    case 'edit':
      $template = 'habitacion_edit.php';
      break;
    default:
      $template = 'habitacion_list.php';
      break;
}

include(_includes_."admin/inc.header.php");

$objHabitaciones = new Habitaciones();
$listadoHabitaciones = $objHabitaciones->getHabitaciones();

if ($_GET['id']) {
   $objHabitacion= new Habitacion($_GET['id']);
}
?>
<?php include 'menu.php'; ?>
	<?php include 'nav.php'; ?>
        <div class="content">
            <div class="container-fluid">

            <!-- PINTA EL TEMPLATE -->
            <?php include _view_habitacion_.$template; ?>
            <!-- PINTA EL TEMPLATE -->

            </div>
        </div>


        <!-- LLAMO AL JS DEL TEMPLATE CORRESPONDIENTE AL MODULO -->
        <script src="<?php echo _js_template_ ?>habitacion.js" type="text/javascript"></script>
        <!-- LLAMO AL JS DEL TEMPLATE CORRESPONDIENTE AL MODULO -->


        <?php include 'footer.php'; ?> <!--EL FOOTER ES EL QUE CONTIENE LOS JS -->
