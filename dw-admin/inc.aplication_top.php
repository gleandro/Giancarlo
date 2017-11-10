<?php
error_reporting(E_ALL ^ E_NOTICE);

include_once("../inc.core.php");

function my_autoloader($class) {
	if(file_exists( _model_.$class.'.php'  )){
		include_once _model_.$class.'.php';
	}
}
spl_autoload_register('my_autoloader');

//include_once _model_.'Accesorios.php';

require_once(_util_."ThumbnailBlob.php");
require_once(_util_."Libs.php");
require_once(_util_."Upload.php");

ini_set('post_max_size','100M');
ini_set('upload_max_filesize','100M');
ini_set('max_execution_time','1000');
ini_set('max_input_time','1000');

$link = new Conexion($_config['bd']['server'],$_config['bd']['user'],$_config['bd']['password'],$_config['bd']['name']);
session_start();

$sesion = new Sesion();
if(isset($_POST['login']) && isset($_POST['password']) && !empty($_POST['login']) &&!empty($_POST['password'])){
	$sesion->validaAcceso($_POST['login'], $_POST['password']);
}
if($_GET['action']=="logout"){ $sesion->logout(); }

//msgbox
if(!(isset($_SESSION['msg']))){
	$msgbox = new Msgbox();
}else{
	$msgbox = $_SESSION['msg'];
}

$config_site = new Configuration($msgbox, $sesion->getUsuario());

$configs = $config_site->getData();

foreach($configs as $clave=>$valor){
	define($clave,$valor);
}
if(strstr($_SERVER['PHP_SELF'],"login.php")){$flag=0;} else {$flag=1;}
if(!is_object($sesion->getUsuario()->getRol()))	if($flag){header("location:login.php");}
if($sesion->getUsuario()->getLogeado()==FALSE)  if($flag){header("location:login.php");}
?>
