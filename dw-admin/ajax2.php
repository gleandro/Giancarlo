<?php 
include("inc.aplication_top.php");

$obj = new Ajax($idioma);
if($_POST['action']){

	$accion = $_POST['action']."Ajax";	
	$obj->$accion();

}?>	