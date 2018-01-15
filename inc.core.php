<?php
include("aplication/inc.config.php");
//		include($_SERVER['DOCUMENT_ROOT']."/inc.config.php");

	define("_ruta_",$_config["server"]["host"]);
	define("_includes_",$_config["server"]["host"]."aplication/includes/");

	define("_imgs_",$_config["server"]["url"]."aplication/webroot/imgs/");
	define("_vouchers_",$_config["server"]["url"]."aplication/webroot/voucher/");
	define("_catalogo_",$_config["server"]["url"]."aplication/webroot/imgs/catalogo/");
	define("_icons_",_imgs_."icons/");
	define("_admin_",_imgs_."admin/");
	define("_flash_",$_config["server"]["url"]."aplication/webroot/flash/");


	define("_model_",$_config["server"]["host"]."aplication/model/");
	define("_view_",$_config["server"]["host"]."aplication/view/");
	define("_util_",$_config["server"]["host"]."aplication/utilities/");


	define("_img_file_","aplication/utilities/img.php");
	define("_imagen_","aplication/utilities/imagen.php");
	define("_imgs_prod_","aplication/webroot/imgs/catalogo/");
	define("_language_",$_config["server"]["host"]."aplication/language/");


	define("_js_template_","../aplication/webroot/js/template/");
	define("_js_","../aplication/webroot/js/");
	define("_css_","../aplication/webroot/css/");

	define("_view_empresa_",$_config["server"]["host"]."aplication/view/empresa/");
	define("_view_hotel_",$_config["server"]["host"]."aplication/view/hotel/");
	define("_view_tipo_servicio_",$_config["server"]["host"]."aplication/view/tipo_servicio/");
	define("_view_servicio_",$_config["server"]["host"]."aplication/view/servicio/");
	define("_view_paquete_",$_config["server"]["host"]."aplication/view/paquete/");
	define("_view_departamento_",$_config["server"]["host"]."aplication/view/departamento/");
	define("_view_habitacion_",$_config["server"]["host"]."aplication/view/habitacion/");
	define("_view_cotizacion_",$_config["server"]["host"]."aplication/view/cotizacion/");
	define("_view_counter_",$_config["server"]["host"]."aplication/view/counter/");
	define("_view_agencia_",$_config["server"]["host"]."aplication/view/agencia/");
	define("_view_venta_",$_config["server"]["host"]."aplication/view/venta/");
	define("_view_reserva_",$_config["server"]["host"]."aplication/view/reserva/");

?>
