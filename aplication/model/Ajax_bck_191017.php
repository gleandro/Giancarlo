<?php
class Ajax{

	private $_idioma;

	public function __construct(Idioma $idioma = NULL){
		$this->_idioma = $idioma ;
	}

	function getServicioAjax(){
		$objServicios = new Servicios();
		$listadoServicios = $objServicios->getServicios();
  ?>
	<!--
		<div class="contenedor-servicios-apend">
			<div class="row" id="ContentService2">
				<div class="col-md-12">
					<div class="form-group">
									<label class="control-label">Lista de servicios<star>*</star></label>
									<select class="selectpicker" name="servicio[]" data-style="btn btn-default btn-block" title=".::Lista de Servicios::." data-size="7">
										<?//php foreach ($listadoServicios as $Servicio) { ?>
												<option value="<?//php echo $Servicio['id'] ?>"><?//php echo $Servicio['nombre']; ?></option>
										<?//php } ?>
									</select>
							</div>
				</div>
			</div>
		</div>
-->

		<div class="contenedor-servicios-apend">
			  <div class="row" id="ContentService">
				    <div class="col-md-12">
				       <div class="form-group">
				           <label class="control-label">Lista de servicios<star>*</star></label>
				           <div class="btn-group bootstrap-select">
										 <button type="button" class="dropdown-toggle bs-placeholder btn btn-default btn-block" data-toggle="dropdown" role="button" title=".::Lista de Servicios::.">
											 <span class="filter-option pull-left">.::Lista de Servicios::.</span>&nbsp;
											 <span class="bs-caret"><span class="caret"></span></span>
									   </button>
										 <div class="dropdown-menu open" role="combobox" style="max-height: 280px; overflow: hidden;">
											 <ul class="dropdown-menu inner" role="listbox" aria-expanded="false" style="max-height: 280px; overflow-y: auto;">
												 <?php foreach ($listadoServicios as $key => $Servicio) { ?>
												 <li data-original-index="<?php echo $key+1 ?>">
													 <a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false">
														 <span class="text"><?php echo $Servicio['nombre']; ?></span>
														 <span class=" ti-check check-mark"></span>
													 </a>
												 </li>
												 <?php } ?>
											 </ul>
										 </div>
										 <select class="selectpicker" name="servicio[]" data-style="btn btn-default btn-block" title=".::Lista de Servicios::." data-size="7" tabindex="-98"><option class="bs-title-option" value="">.::Lista de Servicios::.</option>
											 <?php foreach ($listadoServicios as $Servicio) { ?>
 													<option value="<?php echo $Servicio['id'] ?>"><?php echo $Servicio['nombre']; ?></option>
 											<?php } ?>
            				 </select>
										</div>
					       </div>
				       </div>
				 </div>
		</div>
	<?
	}

	function ordenarCatProdAjax(){
		foreach($_GET['list_item'] as $position => $item){
			$type_val = explode("|",$item);

			if($type_val[1] == 'cat'){
				$objc  = new Categoria($type_val[0]);
				$query = new Consulta("UPDATE  categorias SET orden_categoria = $position
											WHERE id_categoria = $type_val[0] AND id_parent = '".$objc->__get("_parent")."'");

			}else{
				$obju  = new Producto($type_val[0]);
				$query = new Consulta("UPDATE  productos SET orden_producto = $position
											WHERE id_producto = $type_val[0]
											AND id_categoria = '".$obju->__get("_categoria")->__get("_id")."'");

			}
		}
	}

	function ordenarBannerAjax(){
		foreach($_GET['list_item'] as $position => $item){
			$query = new Consulta("UPDATE banners SET order_banner = $position WHERE id_banner = $item");
		}
	}

        function ordenarNuestroCatalogoAjax(){
		foreach($_GET['list_item'] as $position => $item){
			$query = new Consulta("UPDATE nuestros_catalogos SET order_nuestro_catalogo = $position WHERE id_nuestro_catalogo = $item");
		}
	}

        function ordenarSolucionAjax(){
		foreach($_GET['list_item'] as $position => $item){
			$query = new Consulta("UPDATE soluciones_ti SET order_soluciones_ti = $position WHERE id_soluciones_ti = $item");
		}
	}

        function ordenarImagenNuestrosSociosAjax(){
                foreach($_GET['list_item'] as $position => $item){
			$query = new Consulta("UPDATE nuestros_socios SET order_nuestro_socio = $position WHERE id_nuestro_socio = $item");
		}
        }

        function ordenarClienteAjax(){
		foreach($_GET['list_item'] as $position => $item){
			$query = new Consulta("UPDATE clientes SET order_cliente = $position WHERE id_cliente = $item");
		}
	}

        function ordenarImagenSociosAjax(){
		foreach($_GET['list_item'] as $position => $item){
			$query = new Consulta("UPDATE imagenes_socios_impresion SET order_imagen_socio_impresion = $position WHERE id_imagen_socio_impresion = $item");
		}
	}

        function ordenarImagenSociosPoliticaAjax(){
		foreach($_GET['list_item'] as $position => $item){
			$query = new Consulta("UPDATE imagenes_socios_politicas_medioambientales SET order_imagen_socio_politica_medioambiental = $position WHERE id_imagen_socio_politica_medioambiental = $item");
		}
	}

        function ordenarCertificadoAjax(){
		foreach($_GET['list_item'] as $position => $item){
			$query = new Consulta("UPDATE certificados SET order_certificado = $position WHERE id_certificado = $item");
		}
	}

	function autocompleteCategoriasAjax(){
		$obj_cat = new Categorias();
		$data =  $obj_cat->getCategoriaXCriterio($_GET['term']);
		if(count($data) != 0){
			echo encode_json($data);
		}else{
			echo "[ ]";
		}
	}

	function viewUserAjax()
	{
		if($_GET['id']){
			$obj = new Usuario($_GET['id']);
		?>

       	<ul id="datos_usuario">
       		 <li><label>Nombre:</label> <div class="value_field"><?php echo $obj->getNombre(); ?></div></li>
             <li><label>Apellidos:</label> <div class="value_field"><?php echo $obj->getApellidos(); ?></div></li>
             <li><label>Cargo:</label> <div class="value_field"><?php echo $obj->getRol()->getNombre(); ?></div></li>
             <li><label>Email:</label> <div class="value_field"><?php echo $obj->getEmail(); ?></div></li>
             <li><label>Login:</label> <div class="value_field"><?php echo $obj->getLogin(); ?></div></li>
       	</ul>
		<?php
		}
	}
	/* AJAX PARA TABLA EMPRESAS RASGOS */
	function registrarEmpresaAjax()
	{
		$razon = $_GET['razon'];
		$ruc = $_GET['ruc'];
		$email = $_GET['email'];
		$web = $_GET['web'];
		$telefono = $_GET['telefono'];
		$direccion = $_GET['direccion'];
		$contacto = $_GET['contacto'];
		$tipo = $_GET['tipo'];
		$contacto_nombre = $_GET['contactoNombre'];
		$contacto_numero = $_GET['contactoNumero'];

		$query = new Consulta("INSERT INTO empresas values ('','1','$tipo','$razon','$ruc','$email','$telefono','$web','$direccion','$contacto_nombre','$contacto_numero')");
		/*ESTE ECO ES PARA MOSTRAR EL RUC DE LA EMPRESA REGISTRADA*/
		echo $razon;
	}

	function modificarEmpresaAjax()
	{
		$id = $_GET['id'];
		$razon = $_GET['razon'];
		$ruc = $_GET['ruc'];
		$email = $_GET['email'];
		$web = $_GET['web'];
		$telefono = $_GET['telefono'];
		$direccion = $_GET['direccion'];
		$contacto = $_GET['contacto'];
		$tipo = $_GET['tipo'];
		$contacto_nombre = $_GET['contactoNombre'];
		$contacto_numero = $_GET['contactoNumero'];

		$query = new Consulta("UPDATE empresas SET
		id_contacto = '1',
		id_tipo_empresa = '".$tipo."',
		razon_social_empresa = '".$razon."',
		ruc_empresa = '".$ruc."',
		email_empresa = '".$email."',
		telefono_empresa = '".$telefono."',
		pagina_web_empresa = '".$web."',
		direccion_empresa = '".$direccion."',
		contacto_nombre_empresa = '".$contacto_nombre."',
		contacto_telefono_empresa = '".$contacto_numero."'
		WHERE id_empresa = '".$id."' ");

	}

	function borrarEmpresaAjax()
	{
		$id = $_GET['id'];

		$query = new Consulta("DELETE FROM empresas WHERE id_empresa = '".$id."'");
	}
	/* AJAX PARA TABLA EMPRESAS RASGOS */

	/* AJAX PARA TABLA TIPO DE SERVICIO */
	function registrarTipoServicioAjax()
	{
		$nombre = $_GET['nombre'];

		$query = new Consulta("INSERT INTO tipos_servicios values ('','".$nombre."')");

		echo $razon;
	}

	function borrarTipoServicioAjax()
	{
		$id = $_GET['id'];

		$query = new Consulta("DELETE FROM tipos_servicios WHERE id_tipo_servicio = '".$id."'");
	}

	function cambiarTipoServicioAjax()
	{
		$id = $_GET['id'];
		$nombre = $_GET['nombre'];

		echo var_dump($_GET);

		$query = new Consulta("UPDATE tipos_servicios SET nombre_tipo_servicio = '".$nombre."' WHERE id_tipo_servicio = '".$id."' ");
	}
	/* AJAX PARA TABLA TIPO DE SERVICIO */
	/* AJAX PARA TABLA DEPARTAMENTOS */
	function registrarDepartamentoAjax()
	{
		$nombre = $_GET['nombre'];

		$query = new Consulta("INSERT INTO departamentos values ('','".$nombre."')");

		echo $nombre;
	}

	function borrarDepartamentoAjax()
	{
		$id = $_GET['id'];

		$query = new Consulta("DELETE FROM departamentos WHERE id_departamento = '".$id."'");
	}

	function cambiarDepartamentoAjax()
	{
		$id = $_GET['id'];
		$nombre = $_GET['nombre'];

		echo var_dump($_GET);

		$query = new Consulta("UPDATE departamentos SET nombre_departamento = '".$nombre."' WHERE id_departamento = '".$id."' ");
	}
	/* AJAX PARA TABLA DEPARTAMENTOS */
	/* AJAX PARA TABLA HABITACIONES */
	function registrarHabitacionAjax()
	{
		$nombre = $_GET['nombre'];

		$query = new Consulta("INSERT INTO habitaciones values ('','".$nombre."')");

		echo $nombre;
	}

	function borrarHabitacionAjax()
	{
		$id = $_GET['id'];

		$query = new Consulta("DELETE FROM habitaciones WHERE id_habitacion = '".$id."'");
	}

	function cambiarHabitacionAjax()
	{
		$id = $_GET['id'];
		$nombre = $_GET['nombre'];

		echo var_dump($_GET);

		$query = new Consulta("UPDATE habitaciones SET nombre_habitacion = '".$nombre."' WHERE id_habitacion = '".$id."' ");
	}
	/* AJAX PARA TABLA HABITACIONES */
	/* AJAX PARA TABLA HOTELES */
	function registrarHotelAjax()
	{
		$id = $_POST['id'];
		$nombre = $_POST['nombre'];
		$departamento = $_POST['departamento'];
		$empresa = $_POST['empresa'];
		$estrellas = $_POST['estrellas'];
		$nombre_contacto = $_POST['nombreContacto'];
		$numero_contacto = $_POST['numeroContacto'];

		if(isset($_FILES['files']) && ($_FILES['files']['name'] != "")){

			$obj  = new Upload();
			$destino = "../aplication/webroot/imgs/";

			$name = strtolower(date("ymdhis").$_FILES['files']['name']);
			$temp = $_FILES['files']['tmp_name'];
			$type = $_FILES['files']['type'];
			$size = $_FILES['files']['size'];

			$obj->upload_imagen($name, $temp, $destino, $type, $size);
		}

		/*echo var_dump($_FILES);*/

		$query = new Consulta("INSERT INTO hoteles values ('','".$departamento."','".$empresa."','".$nombre."','".$estrellas."','".$name."','".$nombre_contacto."','".$numero_contacto."')");
	}

	function borrarHotelAjax()
	{
		$id = $_GET['id'];

		$query = new Consulta("DELETE FROM hoteles WHERE id_hotel = '".$id."'");
	}

	function modificarHotelAjax($value='')
	{
		$id = $_POST['id'];
		$nombre = $_POST['nombre'];
		$departamento = $_POST['departamento'];
		$empresa = $_POST['empresa'];
		$estrellas = $_POST['estrellas'];
		$nombre_contacto = $_POST['nombreContacto'];
		$numero_contacto = $_POST['numeroContacto'];

		if(isset($_FILES['files']) && ($_FILES['files']['name'] != "")){

			$obj  = new Upload();
			$destino = "../aplication/webroot/imgs/";

			$name = strtolower(date("ymdhis").$_FILES['files']['name']);
			$temp = $_FILES['files']['tmp_name'];
			$type = $_FILES['files']['type'];
			$size = $_FILES['files']['size'];

			$obj->upload_imagen($name, $temp, $destino, $type, $size);

			$sentencia="imagen_hotel = '".$name."',";
		}

		$query = new Consulta("UPDATE hoteles SET
		".$sentencia."
		id_departamento = '".$departamento."',
		id_empresa = '".$empresa."',
		nombre_hotel = '".$nombre."',
		estrellas_hotel = '".$estrellas."',
		nombre_contacto_hotel = '".$nombre_contacto."',
		numero_contacto_hotel = '".$numero_contacto."'
		WHERE id_hotel = '".$id."' ");
	}

	function registrarHotelTarifaAjax()
	{
		$hotel = $_GET['hotel'];
		$tipo = $_GET['tipo'];
		$precio = $_GET['precio'];
		$habitacion = $_GET['habitacion'];

		$query = new Consulta("INSERT INTO hoteles_tarifas values ('','".$hotel."','".$habitacion."','".$tipo."','".$precio."')");


	}
	function cambiarHotelTarifaAjax()
	{

		$idtarifa = $_GET['edittarifa'];
		$edittipo = $_GET['edittipo'];
		$edithabitacion = $_GET['edithabitacion'];
		$editprecio = $_GET['editprecio'];

		/*echo var_dump($_GET);*/

		$query = new Consulta("UPDATE hoteles_tarifas SET tipo_hotel_tarifa = '".$edittipo."', precio_hotel_tarifa = '".$editprecio."', id_habitacion = '".$edithabitacion."' WHERE id_hotel_tarifa = '".$idtarifa."' ");
	}
	function borrarHotelTarifaAjax()
	{
		$id = $_GET['id'];
		$query = new Consulta("DELETE FROM hoteles_tarifas WHERE id_hotel_tarifa = '".$id."'");
	}
	/* AJAX PARA TABLA HOTELES */

	// INICIO PAQUETES
	function agregarServicioPaqueteAjax(){

		$objServicios = new Servicios();
		$listadoServicios = $objServicios->getServicios();
		$departamentos = $_POST['departamento'];
		if (count($departamentos)>0 || $_POST['id']!='') {
				if (count($departamentos)>0 && $_POST['id']=='') {
						foreach ($departamentos as $key => $value) {
							 $ubicaciones_lista .= $value.',';
						}
				} else {
						$objPaquete= new Paquete($_POST['id']);
				    //INICIO CARGAR UBICACIONES DE LOS SERVICIOS
				    foreach ($objPaquete->__get('_departamento') as $key => $value) {
				       $ubicaciones_lista .= $value.',';
				    }
				}
		    $ubicaciones = substr($ubicaciones_lista, 0, -1);
		    $listadoServiciosxDepartamentos = $objServicios->getServiciosxDepartamentos($ubicaciones);
		}
		$dia =  $_POST['dia'];
		$dia_actual = (int)($dia-1);

	?>
		<div class="contenedor-servicios-apend contenedor-servicios-apend-1">
			<input type="hidden" class="listaservicio-1" value="1"/>
			<div class="row" id="ContentService">
				<div class="col-md-12">
					<div class="form-group">
									<label class="control-label">Lista de servicios<star>*</star></label>
									<select class="selectpicker form-control" name="servicio[<?php echo $dia_actual ?>][]" style="display:block !important;border-radius: 20px;box-sizing: border-box;border-width: 2px;background-color: transparent;font-size: 14px;font-weight: 600;padding: 7px 18px;border-color: #66615B;color: #66615B;-webkit-transition: all 150ms linear;-moz-transition: all 150ms linear;-o-transition: all 150ms linear;-ms-transition: all 150ms linear;transition: all 150ms linear;" data-style="btn btn-default btn-block" title=".::Lista de Servicios::." data-size="7">
										<option value="">.::Lista de Servicios::.</option>
										<?php foreach ($listadoServiciosxDepartamentos as $Servicio) { ?>
												<option value="<?php echo $Servicio['id'] ?>"><?php echo $Servicio['nombre']; ?></option>
										<?php } ?>
									</select>
					</div>
				</div>
			</div>
		</div>
	<?php }

	function agregarDiaPaqueteAjax($dia){

		$objHoteles = new Hoteles();
		$listadoHoteles = $objHoteles->getHoteles();
		$objServicios = new Servicios();
		$listadoServicios = $objServicios->getServicios();
		$dia =  $_POST['dia'];

		$dia_actual = (int)($dia-1);

		$departamentos = $_POST['departamento'];

		if (count($departamentos)>0 || $_POST['id']!='') {
				if (count($departamentos)>0 && $_POST['id']=='') {
						foreach ($departamentos as $key => $value) {
							 $ubicaciones_lista .= $value.',';
						}
				} else {
						$objPaquete= new Paquete($_POST['id']);
				    //INICIO CARGAR UBICACIONES DE LOS SERVICIOS
				    foreach ($objPaquete->__get('_departamento') as $key => $value) {
				       $ubicaciones_lista .= $value.',';
				    }
				}
		    $ubicaciones = substr($ubicaciones_lista, 0, -1);
		    $listadoServiciosxDepartamentos = $objServicios->getServiciosxDepartamentos($ubicaciones);
		}
		$id_paquete = ($_POST['id']!='')?$_POST['id']:"''";
	?>
	<div class="card card-<?php echo $dia ?>">
		<input type="hidden" class="listaservicio-<?php echo $dia ?>" value="1"/>
		<div class="card-header">
				<h4 class="card-title">Día <?php echo $dia ?> <span> <a class="text-danger" onclick="eliminarPaquete(<?php echo $dia ?>,'');"><i class="fa fa-trash-o"></i></a></span></h4>
				<p class="category">Detalle del Día</p>
		</div>
		<div class="card-content">
			<div class="row">
						<div class="col-md-12">
							<div class="form-group">
											<label class="control-label">
												Nombre
											</label>
											<input class="form-control"
														 type="text"
														 name="nombreDia[<?php echo $dia-1 ?>][]"
														 placeholder="Nombre para Identificar el Día"
								/>
							</div>
						</div>
			</div>
			<div class="row">
						<div class="col-md-12">
							<div class="form-group">
									<label class="control-label">Hotel<star>*</star></label>
									<select class="selectpicker form-control" name="hotel[]" title=".::Seleccione un Hotel::." data-size="7" style="display:block !important;border-radius: 20px;box-sizing: border-box;border-width: 2px;background-color: transparent;font-size: 14px;font-weight: 600;padding: 7px 18px;border-color: #66615B;color: #66615B;-webkit-transition: all 150ms linear;-moz-transition: all 150ms linear;-o-transition: all 150ms linear;-ms-transition: all 150ms linear;transition: all 150ms linear;">
										<?php foreach ($listadoHoteles as $Hotel) { ?>
												<option value="<?php echo $Hotel['id'] ?>"><?php echo $Hotel['nombre']; ?></option>
										<?php } ?>
									</select>
							</div>
						</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<p class="category">Servicios incluidos en el día.</p>
				</div>
			</div>

			<div class="contenedor-servicios-apend-container">
				<div class="contenedor-servicios-apend contenedor-servicios-apend-1">
					<!--<input type="hidden" class="listaservicio-1" value="1"/>-->
					<div class="row" id="ContentService">
						<div class="col-md-12">
							<div class="form-group">
											<label class="control-label">Lista de servicios<star>*</star></label>
											<select class="selectpicker form-control" name="servicio[<?php echo $dia_actual ?>][]" style="display:block !important;border-radius: 20px;box-sizing: border-box;border-width: 2px;background-color: transparent;font-size: 14px;font-weight: 600;padding: 7px 18px;border-color: #66615B;color: #66615B;-webkit-transition: all 150ms linear;-moz-transition: all 150ms linear;-o-transition: all 150ms linear;-ms-transition: all 150ms linear;transition: all 150ms linear;" data-style="btn btn-default btn-block" title=".::Lista de Servicios::." data-size="7">
												<option value="">.::Lista de Servicios::.</option>
												<?php foreach ($listadoServiciosxDepartamentos as $Servicio) { ?>
														<option value="<?php echo $Servicio['id'] ?>"><?php echo $Servicio['nombre']; ?></option>
												<?php } ?>
											</select>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<a class="text-success" style="cursor: pointer;" onclick="addOneMoreService(<?php echo $dia ?>,<?php echo $id_paquete ?>)">Añadir un servicio más al día <i class="fa fa-plus-circle"></i></a>
				</div>
			</div>
		</div>
	</div>
	<?php }

	function registrarPaqueteAjax(){

		$nombre = $_POST['nombre_paquete'];
		$descripcion = $_POST['descripcion_paquete'];

		if(isset($_FILES['files']) && ($_FILES['files']['name'] != "")){

			$obj  = new Upload();
			$destino = "../aplication/webroot/imgs/";

			$name = strtolower(date("ymdhis").$_FILES['files']['name']);
			$temp = $_FILES['files']['tmp_name'];
			$type = $_FILES['files']['type'];
			$size = $_FILES['files']['size'];

			$obj->upload_imagen($name, $temp, $destino, $type, $size);
		}

		$query = new Consulta("INSERT INTO paquetes values('','".$nombre."','".$descripcion."','".$name."')");
		$nuevoid = $query->nuevoid();

		$departamento = $_POST['departamento'];
		if ($_POST['departamento']) {
			foreach ($departamento as $depa) {
				$query2 =new Consulta( "INSERT INTO paquetes_destinos values('','".$nuevoid."','".$depa."')" );
			}
		}

		$servicio = $_POST['servicio'];
		$nombreDia = $_POST['nombreDia'];
		foreach ($nombreDia as $key => $nombre) {
			$query2 = new Consulta("INSERT INTO paquetes_itinerario VALUES('','". $nuevoid ."','41','". $nombre['0'] ."') ");
			$nuevoid2 = $query2->nuevoid();
			$servicioarray = $servicio[$key];
			foreach ($servicioarray as $llave => $value) {
				$query3 = new Consulta("INSERT INTO paquetes_itinerario_detalle VALUES('','". $nuevoid2 ."','". $value ."') ");
			}
		}
	}


	function actualizarPaqueteAjax(){

		if(isset($_FILES['files']) && ($_FILES['files']['name'] != "")){

			$obj  = new Upload();
			$destino = "../aplication/webroot/imgs/";

			$name = strtolower(date("ymdhis").$_FILES['files']['name']);
			$temp = $_FILES['files']['tmp_name'];
			$type = $_FILES['files']['type'];
			$size = $_FILES['files']['size'];

			$obj->upload_imagen($name, $temp, $destino, $type, $size);
			$update="imagen_paquete = '".$name."',";

		}

		$id_paquete = $_POST['id_paquete'];
		$query = new Consulta("UPDATE paquetes SET
								".$update."
								nombre_paquete = '".$_POST['nombre_paquete']."',
								descripcion_paquete = '".$_POST['descripcion_paquete']."'
								WHERE id_paquete = '".$id_paquete."' ");

		$query = new Consulta("DELETE FROM paquetes_destinos WHERE id_paquete = '".$id_paquete."' ");
		$departamento = $_POST['departamento'];
		if ($_POST['departamento']) {
			foreach ($departamento as $depa) {
				$query2 =new Consulta( "INSERT INTO paquetes_destinos values('','".$id_paquete."','".$depa."')" );
			}
		}

		$id_paquete = $_POST['id_paquete'];
		$query = new Consulta("DELETE FROM paquetes_itinerario WHERE id_paquete = '".$id_paquete."' ");

		$servicio = $_POST['servicio'];
		$nombreDia = $_POST['nombreDia'];
		foreach ($nombreDia as $key => $nombre) {
			$query2 = new Consulta("INSERT INTO paquetes_itinerario VALUES('','". $id_paquete ."','41','". $nombre['0'] ."') ");
			$nuevoid2 = $query2->nuevoid();
			$servicioarray = $servicio[$key];
			foreach ($servicioarray as $llave => $value) {
				$query3 = new Consulta("INSERT INTO paquetes_itinerario_detalle VALUES('','". $nuevoid2 ."','". $value ."') ");
			}
		}

	}

	function actualizarPaqueteAjax__original(){

		if(isset($_FILES['files']) && ($_FILES['files']['name'] != "")){

			$obj  = new Upload();
			$destino = "../aplication/webroot/imgs/";

			$name = strtolower(date("ymdhis").$_FILES['files']['name']);
			$temp = $_FILES['files']['tmp_name'];
			$type = $_FILES['files']['type'];
			$size = $_FILES['files']['size'];

			$obj->upload_imagen($name, $temp, $destino, $type, $size);
			$update="imagen_paquete = '".$name."',";

		}

		$id_paquete = $_POST['id_paquete'];
		$query = new Consulta("UPDATE paquetes SET
								".$update."
								nombre_paquete = '".$_POST['nombre_paquete']."',
								descripcion_paquete = '".$_POST['descripcion_paquete']."'
								WHERE id_paquete = '".$id_paquete."' ");

		$query = new Consulta("DELETE FROM paquetes_destinos WHERE id_paquete = '".$id_paquete."' ");
		$departamento = $_POST['departamento'];
		if ($_POST['departamento']) {
			foreach ($departamento as $depa) {
				$query2 =new Consulta( "INSERT INTO paquetes_destinos values('','".$id_paquete."','".$depa."')" );
			}
		}

		$id_paquete = $_POST['id_paquete'];
		$query = new Consulta("DELETE FROM paquetes_itinerario WHERE id_paquete = '".$id_paquete."' ");

		$servicio = $_POST['servicio'];
		$nombreDia = $_POST['nombreDia'];
		for($i=0;$i<count($nombreDia);$i++){
			if ($nombreDia[$i]!='') {
						$query2 = new Consulta("INSERT INTO paquetes_itinerario VALUES('','". $id_paquete ."','". $_POST['hotel'][$i] ."','". $_POST['nombreDia'][$i] ."') ");

						$nuevoid2 = $query2->nuevoid();
						for($j=0;$j<count($servicio);$j++){
							if ($servicio[$i][$j]!='') {
								$query3 = new Consulta("INSERT INTO paquetes_itinerario_detalle VALUES('','". $nuevoid2 ."','". $servicio[$i][$j] ."') ");
							}
						}

			}
		}

	}

	function borrarPaqueteAjax(){
		$id = $_GET['id'];
		$query = new Consulta("DELETE FROM paquetes WHERE id_paquete = '".$id."' ");
	}

	function deleteDiaPaqueteAjax(){
		$id = $_POST['id'];
		if ($id!='') {
			$query = new Consulta("DELETE FROM paquetes_itinerario WHERE id_paquete_itinerario = '".$id."' ");
		}
	}
	//FIN PAQUETES

	/*AJAX PARA TABLA SERVICIOS */
	function registrarSevicioAjax()
	{
		$tipo = $_GET['tipo'];
		$empresa = $_GET['empresa'];
		$nombre = $_GET['nombre'];
		$precio = $_GET['precio'];
		$alcance = $_GET['alcance'];
		$descripcion = $_GET['descripcion'];
		$contacto_nombre = $_GET['contacto_nombre'];
		$contacto_numero = $_GET['contacto_numero'];

		$query = new Consulta("INSERT INTO servicios values('','".$tipo."','".$empresa."','".$nombre."','".$precio."','".$alcance."','".$descripcion."','".$contacto_nombre."','".$contacto_numero."')");
		$nuevoid = $query->nuevoid();

		$departamento = $_GET['departamento'];
		if ($_GET['departamento']) {
			foreach ($departamento as $depa) {
				$query2 =new Consulta( "INSERT INTO servicios_ubicacion values('','".$nuevoid."','".$depa."')" );
			}
		}

	}
	function borrarServicioAjax()
	{
		$id = $_GET['id'];
		$query = new Consulta("DELETE FROM servicios_ubicacion WHERE id_servicio = '".$id."' ");

		$query2 = new Consulta("DELETE FROM servicios WHERE id_servicio = '".$id."' ");
	}
	function cambiarServicioAjax()
	{
		$id_servicio = $_GET['idservicio'];
		$tipo = $_GET['tipo'];
		$empresa = $_GET['empresa'];
		$nombre = $_GET['nombre'];
		$precio = $_GET['precio'];
		$alcance = $_GET['alcance'];
		$descripcion = $_GET['descripcion'];
		$contacto_nombre = $_GET['contacto_nombre'];
		$contacto_numero = $_GET['contacto_numero'];

		$query = new Consulta("UPDATE servicios SET
			id_tipo_servicio = '".$tipo."',
			id_empresa = '".$empresa."',
			nombre_servicio = '".$nombre."',
			precio_servicio = '".$precio."',
			alcance_servicio ='".$alcance."',
			descripcion_servicio ='".$descripcion."',
			contacto_nombre_servicio = '".$contacto_nombre."',
			contacto_numero_servicio = '".$contacto_numero."'
			WHERE id_servicio = '".$id_servicio."' ");

		$departamento = $_GET['departamento'];
		/*LIMPIAMOS LOS DEPARTAMENTOS*/
		$query2 = new Consulta("DELETE FROM servicios_ubicacion WHERE id_servicio = '".$id_servicio."' ");
		if ($_GET['departamento']) {
			foreach ($departamento as $depa) {
				$query3 =new Consulta( "INSERT INTO servicios_ubicacion values('','".$id_servicio."','".$depa."')" );
			}
		}
	}
	/*AJAX PARA TABLA SERVICIOS */
}
?>
