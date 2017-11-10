<?php include("inc.aplication_top.php");

$obj = new Ajax($idioma);
if($_GET['action']){

	$accion = $_GET['action']."Ajax";
	$obj->$accion();

}?>
