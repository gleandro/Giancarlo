<?php
//	Iniciador de seguridad
error_reporting(E_ALL ^ E_NOTICE);
include_once("inc.core.php");
function my_autoloader($class) {
	if(file_exists( _model_.$class.'.php'  )){
		include _model_.$class.'.php';
	}
}
spl_autoload_register('my_autoloader');

require_once(_util_."Libs.php");
require_once(_view_."Icatalogo.php");
require_once(_view_."Secciones.php");

$link = new Conexion($_config['bd']['server'],$_config['bd']['user'],$_config['bd']['password'],$_config['bd']['name']);
session_start();	

//msgbox
if(!(isset($_SESSION['msg']))){
	$msgbox = new Msgbox();
}else{
	$msgbox = $_SESSION['msg'];
}

//configuracion del sitio
$user = new Usuario();
$config_site = new Configuration($msgbox,$user);
$configs = $config_site->getData();

foreach($configs as $clave=>$valor){
	define($clave,$valor);
}

?>