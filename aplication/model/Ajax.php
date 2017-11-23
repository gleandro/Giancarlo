<?php
class Ajax{

	private $_idioma;

	public function __construct(Idioma $idioma = NULL){
		$this->_idioma = $idioma ;
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

				function registrarHabitacionAjax(){

					$query = new Consulta("INSERT INTO habitaciones values ('','".$_POST['nombre_habitacion']."','".$_POST['cantidad_habitacion']."') ");

				}
				function modificarHabitacionAjax()
				{
					$query = new Consulta("UPDATE habitaciones SET nombre_habitacion = '".$_POST['nombre_habitacion']."',cantidad_habitacion ='".$_POST['cantidad_habitacion']."' WHERE id_habitacion = '".$_POST['id']."' ");

				}
				function borrarHabitacionAjax()
				{
					$query = new Consulta("DELETE FROM habitaciones WHERE id_habitacion = '".$_GET['id']."'");
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
						$precio_nacional = $_GET['precio_nacional'];
						$precio_extranjero = $_GET['precio_extranjero'];
						$habitacion = $_GET['habitacion'];

						$query = new Consulta("INSERT INTO hoteles_tarifas values ('','".$hotel."','".$habitacion."','".$precio_nacional."','".$precio_extranjero."')");

					}
					function cambiarHotelTarifaAjax()
					{
						$idtarifa = $_GET['edittarifa'];
						$edittipo = $_GET['edittipo'];
						$edithabitacion = $_GET['edithabitacion'];
						$editprecio = $_GET['editprecio'];

						if ($edittipo == 1) {
							$query = new Consulta("UPDATE hoteles_tarifas SET precio_nacional = ".$editprecio."	WHERE id_hotel_tarifa = ".$idtarifa);
						}else {
							$query = new Consulta("UPDATE hoteles_tarifas SET precio_extranjero = ".$editprecio." WHERE id_hotel_tarifa = ".$idtarifa);
						}
					}
					function borrarHotelTarifaAjax()
					{
						$id = $_GET['id'];
						$query = new Consulta("DELETE FROM hoteles_tarifas WHERE id_hotel_tarifa = '".$id."'");
					}
					/* AJAX PARA TABLA HOTELES */

					function agregarHotelPaqueteAjax(){

						$objHoteles = new Hoteles();
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
							$listadoHotelesxDepartamentos = $objHoteles->getHotelesxDepartamentos($ubicaciones);
						}


						$objPaquete= new Paquete($_POST['id']);
						//INICIO CARGAR UBICACIONES DE LOS SERVICIOS
						if (is_array($objPaquete->__get('_departamento')) || is_object($objPaquete->__get('_departamento'))){
							foreach ($objPaquete->__get('_departamento') as $key => $value) {
								$ubicaciones_lista .= $value.',';
							}
						}
						$ubicaciones = substr($ubicaciones_lista, 0, -1);
						$listadoHotelesxDepartamentos = $objHoteles->getHotelesxDepartamentos($ubicaciones);

						$dia =  $_POST['dia'];
						$dia_actual = (int)($dia-1);

						?>
						<div class="contenedor-hotel-apend contenedor-servicios-apend-1">
							<input type="hidden" class="listahotel-1" value="1"/>
							<div class="row" id="ContentService">
								<div class="col-md-12">
									<label class="control-label">Hoteles<star>*</star></label>
									<div class="form-group" style="overflow-y: auto;height: 300px;">
										<table id="table-hoteles" class="table bootstrap-table-edit table-hoteles" >
											<thead>
												<th data-field="state" data-checkbox="true"></th>
												<th data-field="nombre" data-sortable="true">Nombre</th>
												<th data-field="departamento" data-sortable="true">Departamento</th>
												<th data-field="estrellas" data-sortable="true">Estrellas</th>
												<th data-field="empresa" data-sortable="true">Empresa</th>
												<th data-field="precio" data-sortable="true">Precio Extranjero</th>
												<th data-field="id" data-sortable="true">Id</th>
											</thead>
											<tbody>
												<?php foreach ($listadoHotelesxDepartamentos as $Hotel) { ?>
													<tr>
														<td></td>
														<td><?php echo $Hotel['nombre']?></td>
														<td><?php echo $Hotel['departamento'] ?></td>
														<td><?php echo $Hotel['estrellas'] ?></td>
														<td><?php echo $Hotel['empresa'] ?></td>
														<td><?php echo number_format($Hotel['precio_e'], 2, '.', ''); ?></td>
														<td class="id"><?php echo $Hotel['id'] ?></td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					<?php }

					//INICIO AGENCIA

					function registrarAgenciaAjax(){

						$query = new Consulta("INSERT INTO agencias values ('','".$_POST['razonsocial']."','".$_POST['ruc']."','".$_POST['email']."','".$_POST['telefono']."','".$_POST['direccion']."','".$_POST['contacto']."','".$_POST['comision']."')");

					}
					function modificarAgenciaAjax()
					{
						$query = new Consulta("UPDATE agencias SET razon_social_empresa = '".$_POST['razon']."',ruc_empresa ='".$_POST['ruc']."',email_empresa='".$_POST['email']."',telefono_empresa = '".$_POST['telefono']."',direccion_empresa='".$_POST['direccion']."',contacto_empresa = '".$_POST['contacto']."',comision_empresa = '".$_POST['comision']."' WHERE id_agencia = '".$_POST['id']."' ");

					}
					function borrarAgenciaAjax()
					{
						$query = new Consulta("DELETE FROM agencias WHERE id_agencia = '".$_GET['id']."'");
					}
					//FIN AGENCIA

					//INICIO COUNTER
					function registrarCounterAjax(){

						if(isset($_FILES['files']) && ($_FILES['files']['name'] != "")){

							$obj  = new Upload();
							$destino = "../aplication/webroot/imgs/";

							$name = strtolower(date("ymdhis").$_FILES['files']['name']);
							$temp = $_FILES['files']['tmp_name'];
							$type = $_FILES['files']['type'];
							$size = $_FILES['files']['size'];

							$obj->upload_imagen($name, $temp, $destino, $type, $size);
						}

						$query = new Consulta("INSERT INTO usuarios values ('','".$_POST['rol']."','".$_POST['nombre']."','".$_POST['apellido']."','".$_POST['dni']."','".$_POST['email']."','".$name."','".$_POST['usuario']."','".encriptar($_POST['password'])."','".date('Y-m-d')."')");

					}

					function modificarCounterAjax()
					{
						if(isset($_FILES['files']) && ($_FILES['files']['name'] != "")){

							$obj  = new Upload();
							$destino = "../aplication/webroot/imgs/";

							$name = strtolower(date("ymdhis").$_FILES['files']['name']);
							$temp = $_FILES['files']['tmp_name'];
							$type = $_FILES['files']['type'];
							$size = $_FILES['files']['size'];

							$obj->upload_imagen($name, $temp, $destino, $type, $size);
							$update="foto_usuario = '".$name."',";

						}

						$query = new Consulta("UPDATE usuarios SET ".$update." id_rol = '".$_POST['rol']."',nombre_usuario ='".$_POST['nombre']."',apellidos_usuario='".$_POST['apellido']."',email_usuario = '".$_POST['email']."',login_usuario='".$_POST['usuario']."',password_usuario = '".encriptar($_POST['password'])."',dni_usuario = '".$_POST['dni']."' WHERE id_usuario = '".$_POST['id']."' ");
					}

					function borrarCounterAjax()
					{
						$query = new Consulta("DELETE FROM usuarios WHERE id_usuario = '".$_GET['id']."'");
					}
					//FIN COUNTER

					// INICIO COTIZACIONES
					function agregarHotelCotizacionAjax(){

						$objHoteles = new Hoteles();
						$departamentos = $_POST['departamento'];
						if (count($departamentos)>0 || $_POST['id']!='') {
							if (count($departamentos)>0 && $_POST['id']=='') {
								foreach ($departamentos as $key => $value) {
									$ubicaciones_lista .= $value.',';
								}
							} else {
								$objCotizacion= new Cotizacion($_POST['id']);
								//INICIO CARGAR UBICACIONES DE LOS SERVICIOS
								foreach ($objCotizacion->__get('_departamento') as $key => $value) {
									$ubicaciones_lista .= $value.',';
								}
							}
							$ubicaciones = substr($ubicaciones_lista, 0, -1);
							$listadoHotelesxDepartamentos = $objHoteles->getHotelesxDepartamentos($ubicaciones);
						}

						$dia =  $_POST['dia'];
						$dia_actual = (int)($dia-1);

						$itemhotel = $_POST['itemhotel'];
						?>
						<div class="contenedor-hotel-apend contenedor-servicios-apend-1">
							<input type="hidden" class="listaservicio-1" value="1"/>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">Hoteles<star>*</star></label>
										<select class="selectpicker form-control" onchange="addHabitaciones(<?php echo $dia_actual ?>,<?php echo $itemhotel ?>,this.value)" data-style="btn-info btn-fill btn-block" data-size="7" name="hotel[<?php echo $dia_actual ?>][<?php echo $itemhotel ?>][]" style="color: #FFFFFF;background-color: #68B3C8;display: block !important;border-radius: 20px;box-sizing: border-box;border-width: 2px;font-size: 14px;font-weight: 600;padding: 7px 18px;border-color: #68B3C8;width: 100%;">
											<option value="">.::Seleccione Hotel::.</option>
											<?php foreach ($listadoHotelesxDepartamentos as $Hotel) { ?>
												<option value="<?php echo $Hotel['id'] ?>">
													<?php echo $Hotel['departamento'].' ( '.$Hotel['estrellas'].' estrellas - $'.round($Hotel['precio'], 2).' ) : '.$Hotel['nombre'] ?>
												</option>
											<?php } ?>
										</select>
									</div>
									<div class="select-container-<?php echo $dia_actual ?>-<?php echo $itemhotel ?>">
									</div>
								</div>
							</div>
						</div>
					<?php }

					function agregarHabitacionesAjax(){
						$habitaciones = Hoteles::getHabitacionesHoteles($_POST['id']);
						?>
						<table class="table table-striped table-hover">
							<thead>
								<tr class="tabla__titulo">
									<th class="text-center">Check</th>
									<th class="text-center">Habitación</th>
									<th class="text-center">Cantidad</th>
									<th class="text-center">Precio</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($habitaciones as $key => $habitacion) { ?>
									<tr>
										<td class="text-center">
											<input type="checkbox" name="check_habitaciones[<?php echo $_POST['dia'] ?>][<?php echo $_POST['item'] ?>][<?php echo $habitacion['id_habitacion'] ?>]" value="<?php echo $habitacion['id_habitacion'] ?>"/>
											<input type="hidden" name="precios_habitaciones[<?php echo $_POST['dia'] ?>][<?php echo $_POST['item'] ?>][<?php echo $habitacion['id_habitacion'] ?>]" value="<?php echo $habitacion['precio_hotel_tarifa'] ?>"/>
										</td>
										<td class="text-left"><?php echo $habitacion['nombre_habitacion'] ?></td>
										<td class="text-center"><input type="input" name="cantidad_habitaciones[<?php echo $_POST['dia'] ?>][<?php echo $_POST['item'] ?>][<?php echo $habitacion['id_habitacion'] ?>]" /></td>
										<td class="text-right"><?php echo $habitacion['precio_hotel_tarifa'] ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

					<?php }

					function agregarServicioCotizacionAjax(){

						$objServicios = new Servicios();
						$listadoServicios = $objServicios->getServicios();
						$departamentos = $_POST['departamento'];
						if (count($departamentos)>0 || $_POST['id']!='') {
							if (count($departamentos)>0 && $_POST['id']=='') {
								foreach ($departamentos as $key => $value) {
									$ubicaciones_lista .= $value.',';
								}
							} else {
								$objCotizacion= new Cotizacion($_POST['id']);
								//INICIO CARGAR UBICACIONES DE LOS SERVICIOS
								foreach ($objCotizacion->__get('_departamento') as $key => $value) {
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
										<label class="control-label">Servicios<star>*</star></label>
										<select class="selectpicker form-control" name="servicio[<?php echo $dia_actual ?>][]" style="display:block !important;border-radius: 20px;box-sizing: border-box;border-width: 2px;background-color: transparent;font-size: 14px;font-weight: 600;padding: 7px 18px;border-color: #66615B;color: #66615B;-webkit-transition: all 150ms linear;-moz-transition: all 150ms linear;-o-transition: all 150ms linear;-ms-transition: all 150ms linear;transition: all 150ms linear;" data-style="btn btn-default btn-block" title=".::Lista de Servicios::." data-size="7">
											<option value="">.::Lista de Servicios::.</option>
											<?php foreach ($listadoServiciosxDepartamentos as $Servicio) { ?>
												<option value="<?php echo $Servicio['id'].'-'.$Servicio['precio'] ?>">
													<?php echo $Servicio['departamento'].' ( '.$Servicio['nombre_tipo_servicio'].' '.$Servicio['alcance'].' personas - $'.round($Servicio['precio'], 2).' ) : '.$Servicio['nombre'] ?>
												</option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
						</div>
					<?php }

					function agregarDiaCotizacionAjax(){

						$objHoteles = new Hoteles();
						$listadoHoteles = $objHoteles->getHoteles();
						$objServicios = new Servicios();
						$listadoServicios = $objServicios->getServicios();
						$dia =  $_POST['dia'];

						$dia_actual = (int)($dia-1);

						$departamentos = $_POST['departamento'];

						if (count($departamentos)>0 || $_POST['id']!='') {
							if (count($departamentos)>0 && $_POST['id']=='') { //NUEVO
								foreach ($departamentos as $key => $value) {
									$ubicaciones_lista .= $value.',';
								}
							} else { //EDITAR
								$objCotizacion= new Cotizacion($_POST['id']);
								//INICIO CARGAR UBICACIONES DE LOS SERVICIOS
								foreach ($objCotizacion->__get('_departamento') as $key => $value) {
									$ubicaciones_lista .= $value.',';
								}
							}
							$ubicaciones = substr($ubicaciones_lista, 0, -1);
							$listadoServiciosxDepartamentos = $objServicios->getServiciosxDepartamentos($ubicaciones);
							$listadoHotelesxDepartamentos = $objHoteles->getHotelesxDepartamentos($ubicaciones);

						}
						$id_paquete = ($_POST['id']!='')?$_POST['id']:"''";
						?>
						<div class="card card-<?php echo $dia ?>">
							<input type="hidden" class="listaservicio-<?php echo $dia ?>" value="1"/>
							<input type="hidden" class="listahoteles-<?php echo $dia ?>" value="2"/>
							<div class="card-header">
								<h4 class="card-title">Día <?php echo $dia ?><span> <a class="text-danger" onclick="eliminarPaquete(<?php echo $dia ?>,'');"><i class="fa fa-trash-o"></i></a></span></h4>
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
											<label class="control-label">
												Itinerario
											</label>
											<textarea class="form-control" name="descripcion[<?php echo $dia-1 ?>][]" rows="5" cols="5"></textarea>
										</div>
									</div>
								</div>

								<div class="contenedor-hoteles-apend-container">
									<div class="contenedor-hoteles-apend contenedor-hoteles-apend-1">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label class="control-label">Hoteles<star>*</star></label>
													<select class="selectpicker form-control" onchange="addHabitaciones(<?php echo $dia_actual ?>,1,this.value)" data-style="btn-info btn-fill btn-block" data-size="7" name="hotel[<?php echo $dia_actual ?>][1][]" style="color: #FFFFFF;background-color: #68B3C8;display: block !important;border-radius: 20px;box-sizing: border-box;border-width: 2px;font-size: 14px;font-weight: 600;padding: 7px 18px;border-color: #68B3C8;width: 100%;">
														<option value="">.::Seleccione un Hotel::.</option>
														<?php foreach ($listadoHotelesxDepartamentos as $Hotel) { ?>
															<option value="<?php echo $Hotel['id'] ?>">
																<?php echo $Hotel['departamento'].' ( '.$Hotel['estrellas'].' estrellas - $'.round($Hotel['precio'], 2).' ) : '.$Hotel['nombre'] ?>
															</option>
														<?php } ?>
													</select>
													<div class="select-container-<?php echo $dia_actual ?>-1">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<a class="text-success" style="cursor: pointer;" onclick="addOneMoreHotel(<?php echo $dia ?>,<?php echo $id_paquete ?>)">Añadir un hotel más al día <i class="fa fa-plus-circle"></i></a>
									</div>
								</div>
								<br>
								<div class="contenedor-servicios-apend-container">
									<div class="contenedor-servicios-apend contenedor-servicios-apend-1">
										<!--<input type="hidden" class="listaservicio-1" value="1"/>-->
										<div class="row" id="ContentService">
											<div class="col-md-12">
												<div class="form-group">
													<label class="control-label">Servicios<star>*</star></label>
													<select class="selectpicker form-control" name="servicio[<?php echo $dia_actual ?>][]" style="display:block !important;border-radius: 20px;box-sizing: border-box;border-width: 2px;background-color: transparent;font-size: 14px;font-weight: 600;padding: 7px 18px;border-color: #66615B;color: #66615B;-webkit-transition: all 150ms linear;-moz-transition: all 150ms linear;-o-transition: all 150ms linear;-ms-transition: all 150ms linear;transition: all 150ms linear;" data-style="btn btn-default btn-block" title=".::Lista de Servicios::." data-size="7">
														<option value="">.::Lista de Servicios::.</option>
														<?php foreach ($listadoServiciosxDepartamentos as $Servicio) { ?>
															<option value="<?php echo $Servicio['id'].'-'.$Servicio['precio'] ?>">
																<?php echo $Servicio['departamento'].' ( '.$Servicio['nombre_tipo_servicio'].' '.$Servicio['alcance'].' personas - $'.round($Servicio['precio'], 2).' ) : '.$Servicio['nombre'] ?>
															</option>
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

					function registrarCotizacionAjax(){

						if(isset($_FILES['files']) && ($_FILES['files']['name'] != "")){

							$obj  = new Upload();
							$destino = "../aplication/webroot/imgs/";

							$name = strtolower(date("ymdhis").$_FILES['files']['name']);
							$temp = $_FILES['files']['tmp_name'];
							$type = $_FILES['files']['type'];
							$size = $_FILES['files']['size'];

							$obj->upload_imagen($name, $temp, $destino, $type, $size);
						}

						$query_cliente = new Consulta("INSERT INTO clientes values('','1','".$_POST['fuente_cliente']."','".$_POST['nacionalidad_cliente']."','".$_POST['nombres_cliente']."','".$_POST['documento_cliente']."','".$_POST['telefono_cliente']."','".$_POST['email_cliente']."')");
						$nuevoIdCliente = $query_cliente->nuevoid();

						$query_cotizacion = new Consulta("INSERT INTO cotizaciones values('','".$nuevoIdCliente."','".$_POST['numero_pasajeros']."','".$_POST['nombre_paquete']."','".$_POST['descripcion_paquete']."','".$name."','".date('Y-m-d')."')");
						$nuevoIdCotizacion = $query_cotizacion->nuevoid();

						$departamento = $_POST['departamento'];
						if ($_POST['departamento']) {
							foreach ($departamento as $depa) {
								$query_destinos =new Consulta( "INSERT INTO cotizaciones_paquetes_destinos values('','".$nuevoIdCotizacion."','".$depa."')" );
							}
						}

						$servicio = $_POST['servicio'];
						$nombreDia = $_POST['nombreDia'];
						$hoteles = $_POST['hotel'];
						$descripcion = $_POST['descripcion'];


						$check_habitaciones = $_POST['check_habitaciones'];
						$precios_habitaciones = $_POST['precios_habitaciones'];
						$cantidad_habitaciones = $_POST['cantidad_habitaciones'];

						foreach ($nombreDia as $key => $nombre) {

							$query_itinerarios = new Consulta("INSERT INTO cotizaciones_paquetes_itinerarios VALUES('','". $nuevoIdCotizacion ."','". $nombre['0'] ."','". $descripcion[$key]['0'] ."') ");
							$nuevoIdItinerarios = $query_itinerarios->nuevoid();
							$servicioarray = $servicio[$key];

							foreach ($servicioarray as $llave => $value) {
								$servicio_array = explode("-", $value);
								$query_itinerario_detalle = new Consulta("INSERT INTO cotizaciones_paquetes_itinerarios_detalles VALUES('','". $nuevoIdItinerarios ."','". $servicio_array['0'] ."','". $servicio_array['1'] ."') ");
							}

							$hotelarray = $hoteles[$key];  //Listo solo los de un dia a la vez

							foreach ($hotelarray as $llave => $hotel) {
								$queryItinerariosHoteles = new Consulta("INSERT INTO cotizaciones_paquetes_itinerarios_hoteles VALUES('','". $nuevoIdItinerarios ."','". $hotel['0'] ."') ");
								$nuevoIdItinerarioHotel = $queryItinerariosHoteles->nuevoid();

								$checkarray = $check_habitaciones[$key][$llave];
								$preciosarray = $precios_habitaciones[$key][$llave];
								$cantidadarray = $cantidad_habitaciones[$key][$llave];

								foreach ($checkarray as $keys => $check) {
									$query_itinerario_detalle = new Consulta("INSERT INTO cotizaciones_paquetes_itinerarios_hoteles_detalles VALUES('','". $nuevoIdItinerarioHotel ."','". $check ."','". $cantidadarray[$keys] ."','". $preciosarray[$keys] ."') ");
								}

							}

						}

					}

					function actualizarCotizacionAjax(){

						if(isset($_FILES['files']) && ($_FILES['files']['name'] != "")){

							$obj  = new Upload();
							$destino = "../aplication/webroot/imgs/";

							$name = strtolower(date("ymdhis").$_FILES['files']['name']);
							$temp = $_FILES['files']['tmp_name'];
							$type = $_FILES['files']['type'];
							$size = $_FILES['files']['size'];

							$obj->upload_imagen($name, $temp, $destino, $type, $size);
						}

						$query_cliente = new Consulta("INSERT INTO clientes values('','1','".$_POST['fuente_cliente']."','".$_POST['nacionalidad_cliente']."','".$_POST['nombres_cliente']."','".$_POST['documento_cliente']."','".$_POST['telefono_cliente']."','".$_POST['email_cliente']."')");
						$nuevoIdCliente = $query_cliente->nuevoid();

						$query_cotizacion = new Consulta("INSERT INTO cotizaciones values('','".$nuevoIdCliente."','".$_POST['numero_pasajeros']."','".$_POST['nombre_paquete']."','".$_POST['descripcion_paquete']."','".$name."','".date('Y-m-d')."')");
						$nuevoIdCotizacion = $query_cotizacion->nuevoid();

						$departamento = $_POST['departamento'];
						if ($_POST['departamento']) {
							foreach ($departamento as $depa) {
								$query_destinos =new Consulta( "INSERT INTO cotizaciones_paquetes_destinos values('','".$nuevoIdCotizacion."','".$depa."')" );
							}
						}

						$servicio = $_POST['servicio'];
						$nombreDia = $_POST['nombreDia'];
						$hoteles = $_POST['hotel'];
						$descripcion = $_POST['descripcion'];


						$check_habitaciones = $_POST['check_habitaciones'];
						$precios_habitaciones = $_POST['precios_habitaciones'];
						$cantidad_habitaciones = $_POST['cantidad_habitaciones'];

						foreach ($nombreDia as $key => $nombre) {

							$query_itinerarios = new Consulta("INSERT INTO cotizaciones_paquetes_itinerarios VALUES('','". $nuevoIdCotizacion ."','". $nombre['0'] ."','". $descripcion[$key]['0'] ."') ");
							$nuevoIdItinerarios = $query_itinerarios->nuevoid();
							$servicioarray = $servicio[$key];

							foreach ($servicioarray as $llave => $value) {
								$servicio_array = explode("-", $value);
								$query_itinerario_detalle = new Consulta("INSERT INTO cotizaciones_paquetes_itinerarios_detalles VALUES('','". $nuevoIdItinerarios ."','". $servicio_array['0'] ."','". $servicio_array['1'] ."') ");
							}

							$hotelarray = $hoteles[$key];  //Listo solo los de un dia a la vez

							foreach ($hotelarray as $llave => $hotel) {
								$queryItinerariosHoteles = new Consulta("INSERT INTO cotizaciones_paquetes_itinerarios_hoteles VALUES('','". $nuevoIdItinerarios ."','". $hotel['0'] ."') ");
								$nuevoIdItinerarioHotel = $queryItinerariosHoteles->nuevoid();

								$checkarray = $check_habitaciones[$key][$llave];   //check_habitaciones[0][1][]   check_habitaciones[0][2][]
								$preciosarray = $precios_habitaciones[$key][$llave];
								$cantidadarray = $cantidad_habitaciones[$key][$llave];  //cantidad_habitaciones[0][2][]
								echo '<pre>';
								echo var_dump($checkarray);
								echo '</pre>';
								foreach ($checkarray as $keys => $check) {
									echo $keys;
									$query_itinerario_detalle = new Consulta("INSERT INTO cotizaciones_paquetes_itinerarios_hoteles_detalles VALUES('','". $nuevoIdItinerarioHotel ."','". $check ."','". $cantidadarray[$keys] ."','". $preciosarray[$keys] ."') ");
								}

							}

						}

					}

					function actualizarCotizacionAjax____(){

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

						$id_paquete = $_POST['id'];
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

							$id_paquete = $_POST['id'];
							$query = new Consulta("DELETE FROM paquetes_itinerarios WHERE id_paquete = '".$id_paquete."' ");

							$servicio = $_POST['servicio'];
							$nombreDia = $_POST['nombreDia'];
							$hoteles = $_POST['hotel'];
							$descripcion = $_POST['descripcion'];
							foreach ($nombreDia as $key => $nombre) {
								$query2 = new Consulta("INSERT INTO paquetes_itinerarios VALUES('','". $id_paquete ."','41','". $nombre['0'] ."','". $descripcion[$key]['0'] ."') ");
								$nuevoid2 = $query2->nuevoid();
								$servicioarray = $servicio[$key];
								foreach ($servicioarray as $llave => $value) {
									$query3 = new Consulta("INSERT INTO paquetes_itinerarios_detalles VALUES('','". $nuevoid2 ."','". $value ."') ");
								}
								$hotelarray = $hoteles[$key];
								foreach ($hotelarray as $llave => $hotel) {
									$query3 = new Consulta("INSERT INTO paquetes_itinerario_hoteles VALUES('','". $nuevoid2 ."','". $hotel ."') ");
								}
							}


						}

						function borrarCotizacionAjax(){
							$id = $_GET['id'];
							$query = new Consulta("DELETE FROM cotizaciones WHERE id_cotizacion = '".$id."' ");
						}

						function deleteDiaCotizacionAjax(){
							$id = $_POST['id'];
							if ($id!='') {
								$query = new Consulta("DELETE FROM paquetes_itinerarios WHERE id_paquete_itinerario = '".$id."' ");
							}
						}
						//FIN COTIZACIONES


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
										<label class="control-label">Servicios<star>*</star></label>
										<div class="form-group" style="overflow-y: auto;height: 300px;">
											<table id="table-servicios" class="table bootstrap-table-edit table-servicios">
												<thead>
													<th data-field="state" data-checkbox="true"></th>
													<th data-field="nombre" data-sortable="true">Nombre</th>
													<th data-field="departamento" data-sortable="true">Departamento</th>
													<th data-field="estrellas" data-sortable="true">Tipo Servicio</th>
													<th data-field="precio_e" data-sortable="true">Precio Extranjero</th>
													<th data-field="alcanse" data-sortable="true">Alcanse</th>
													<th data-field="id" class="text-center">ID</th>
												</thead>
												<tbody>
													<?php foreach ($listadoServiciosxDepartamentos as $Servicio) { ?>
														<tr>
															<td></td>
															<td><?php echo $Servicio['nombre'] ?></td>
															<td><?php echo $Servicio['departamento']?></td>
															<td><?php echo $Servicio['nombre_tipo_servicio']?></td>
															<td><?php echo number_format($Servicio['precio_e'], 2, '.', ''); ?></td>
															<td><?php echo $Servicio['alcance']?></td>
															<td class="id"><?php echo $Servicio['id'] ?></td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						<?php }

						function agregarDiaPaqueteAjax(){

							$objHoteles = new Hoteles();
							$listadoHoteles = $objHoteles->getHoteles();
							$objServicios = new Servicios();
							$listadoServicios = $objServicios->getServicios();
							$dia =  $_POST['dia'];

							$dia_actual = (int)($dia-1);
							$departamentos = $_POST['departamento'];

							if (count($departamentos)>0 || $_POST['id']!='') {
								if (count($departamentos)>0 && $_POST['id']=='') { //NUEVO
									foreach ($departamentos as $key => $value) {
										$ubicaciones_lista .= $value.',';
									}
								} else { //EDITAR
									$objPaquete= new Paquete($_POST['id']);
									//INICIO CARGAR UBICACIONES DE LOS SERVICIOS
									foreach ($objPaquete->__get('_departamento') as $key => $value) {
										$ubicaciones_lista .= $value.',';
									}
								}
								$ubicaciones = substr($ubicaciones_lista, 0, -1);
								$listadoServiciosxDepartamentos = $objServicios->getServiciosxDepartamentos($ubicaciones);
								$listadoHotelesxDepartamentos = $objHoteles->getHotelesxDepartamentos($ubicaciones);

							}
							$id_paquete = ($_POST['id']!='')?$_POST['id']:"''";
							?>
							<div class="panel panel-default" style="border: 1px;border-color: #0003;border-style: solid;background-color:white">
								<div class="panel-heading" style="background-color:white" role="tab" id="heading<?php echo $dia ?>">
									<h4 class="panel-title">
										<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $dia ?>" aria-expanded="true" aria-controls="collapseOne">
											<h4 class="card-title">Día <?php echo $dia ?><span> <a class="text-danger" onclick="eliminarPaquete(<?php echo $dia ?>,'');"><i class="fa fa-trash-o"></i></a></span></h4>
										</a>
									</h4>
								</div>
								<div id="collapse<?php echo $dia ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?php echo $dia ?>">
									<div class="panel-body">
										<div class="card card-<?php echo $dia ?>">
											<input type="hidden" class="listaservicio-<?php echo $dia ?>" value="1"/>
											<div class="card-content">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label class="control-label">
																Nombre
															</label>
															<input class="form-control" type="text" name="nombreDia[<?php echo $dia-1 ?>][]" placeholder="Nombre para Identificar el Día"/>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label class="control-label">
																Itinerario
															</label>
															<textarea class="form-control" name="descripcion[<?php echo $dia-1 ?>][]" rows="5" cols="5"></textarea>
														</div>
													</div>
												</div>
												<div class="contenedor-hoteles-apend-container">
													<div class="contenedor-hoteles-apend contenedor-hoteles-apend-1">
														<div class="row">
															<div class="col-md-12">
																<label class="control-label">Hoteles<star>*</star></label>
																<div class="form-group" style="overflow-y: auto;height: 300px;">
																	<table id="table-hoteles" class="table bootstrap-table-edit new_table table-hoteles">
																		<thead>
																			<th data-field="state" data-checkbox="true"></th>
																			<th data-field="nombre" data-sortable="true">Nombre</th>
																			<th data-field="departamento" data-sortable="true">Departamento</th>
																			<th data-field="estrellas" data-sortable="true">Estrellas</th>
																			<th data-field="empresa" data-sortable="true">Empresa</th>
																			<th data-field="contacto" data-sortable="true">Id</th>
																		</thead>
																		<tbody>
																			<?php foreach ($listadoHotelesxDepartamentos as $Hotel) { ?>
																				<tr>
																					<td></td>
																					<td><?php echo $Hotel['nombre']?></td>
																					<td><?php echo $Hotel['departamento'] ?></td>
																					<td><?php echo $Hotel['estrellas'] ?></td>
																					<td><?php echo $Hotel['empresa'] ?></td>
																					<td class="id"><?php echo $Hotel['id'] ?></td>
																				</tr>
																			<?php } ?>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="contenedor-servicios-apend-container">
													<div class="contenedor-servicios-apend contenedor-servicios-apend-1">
														<!--<input type="hidden" class="listaservicio-1" value="1"/>-->
														<div class="row" id="ContentService">
															<div class="col-md-12">
																<label class="control-label">Servicios<star>*</star></label>
																<div class="form-group" style="overflow-y: auto;height: 300px;">
																	<table id="table-servicios" class="table bootstrap-table-edit new_table table-servicios">
																		<thead>
																			<th data-field="state" data-checkbox="true"></th>
																			<th data-field="nombre" data-sortable="true">Nombre</th>
																			<th data-field="departamento" data-sortable="true">Departamento</th>
																			<th data-field="estrellas" data-sortable="true">Tipo Servicio</th>
																			<th data-field="empresa" data-sortable="true">Alcanse</th>
																			<th data-field="id" class="text-center">ID</th>
																		</thead>
																		<tbody>
																			<?php foreach ($listadoServiciosxDepartamentos as $Servicio) { ?>
																				<tr>
																					<td></td>
																					<td><?php echo $Servicio['nombre'] ?></td>
																					<td><?php echo $Servicio['departamento']?></td>
																					<td><?php echo $Servicio['nombre_tipo_servicio']?></td>
																					<td><?php echo $Servicio['alcance']?></td>
																					<td class="id"><?php echo $Servicio['id'] ?></td>
																				</tr>
																			<?php } ?>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php }

						function registrarPaqueteAjax(){

							if(isset($_FILES['files']) && ($_FILES['files']['name'] != "")){
								$obj  = new Upload();
								$destino = "../aplication/webroot/imgs/";

								$name = strtolower(date("ymdhis").$_FILES['files']['name']);
								$temp = $_FILES['files']['tmp_name'];
								$type = $_FILES['files']['type'];
								$size = $_FILES['files']['size'];

								$obj->upload_imagen($name, $temp, $destino, $type, $size);
							}

							$query = new Consulta("INSERT INTO paquetes values('','".$_POST['nombre_paquete']."','".$_POST['descripcion_paquete']."','".$name."','','".$_POST['utilidad_paquete']."')");
							$nuevoid = $query->nuevoid();

							$departamento = $_POST['departamento'];
							if ($_POST['departamento']) {
								foreach ($departamento as $depa) {
									$query2 =new Consulta( "INSERT INTO paquetes_destinos values('','".$nuevoid."','".$depa."')" );
								}
							}

							$servicio = $_POST['servicio'];
							$nombreDia = $_POST['nombreDia'];
							$descripcion = $_POST['descripcion'];
							$dias = $_POST['dias'];

							foreach ($nombreDia as $key => $nombre) {
								$query2 = new Consulta("INSERT INTO paquetes_itinerarios VALUES('','". $nuevoid ."','41','". $nombre['0'] ."','". $descripcion[$key]['0'] ."') ");
								$nuevoid2 = $query2->nuevoid();

								$hoteles = $dias[$key][0];
								if (is_array($hoteles) || is_object($hoteles)) {
									foreach ($hoteles as $llave => $hotel) {
										if (!empty($hotel) && !is_null($hotel) && $hotel != '') {
											$query3 = new Consulta("INSERT INTO paquetes_itinerarios_hoteles VALUES('','". $nuevoid2 ."','". $hotel ."') ");
										}
									}
								}
								$servicios = $dias[$key][1];
								if (is_array($servicios) || is_object($servicios)) {
									foreach ($servicios as $llave => $value) {
										if (!empty($value) && !is_null($value) && $value != '') {
											$query3 = new Consulta("INSERT INTO paquetes_itinerarios_detalles VALUES('','". $nuevoid2 ."','". $value ."') ");
										}
									}
								}
							}

							$incluye = $_POST['incluye'];
							$excluye = $_POST['excluye'];

							$query4 = new Consulta("DELETE FROM paquetes_inclusiones where id_paquete = '".$nuevoid."'");
							if (is_array($incluye) || is_object($incluye)) {
								foreach ($incluye as $key => $value) {
									$query4 = new Consulta("INSERT INTO paquetes_inclusiones values(null,".$nuevoid.",'".$value."',1)");
								}
							}
							if (is_array($excluye) || is_object($excluye)) {
								foreach ($excluye as $key => $value) {
									$query4 = new Consulta("INSERT INTO paquetes_inclusiones values(null,".$nuevoid.",'".$value."',2)");
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

							$id_paquete = $_POST['id'];
							$query = new Consulta("UPDATE paquetes SET
								".$update."
								nombre_paquete = '".$_POST['nombre_paquete']."',
								utilidad_paquete = '".$_POST['utilidad_paquete']."',
								descripcion_paquete = '".$_POST['descripcion_paquete']."'
								WHERE id_paquete = '".$id_paquete."' ");

								$query = new Consulta("DELETE FROM paquetes_destinos WHERE id_paquete = '".$id_paquete."' ");
								$departamento = $_POST['departamento'];
								if ($_POST['departamento']) {
									foreach ($departamento as $depa) {
										$query2 =new Consulta( "INSERT INTO paquetes_destinos values('','".$id_paquete."','".$depa."')" );
									}
								}

								$query_paquetes_itinerarios = new Consulta("SELECT id_paquete_itinerario FROM paquetes_itinerarios WHERE id_paquete = '".$id_paquete."' ");

								while($row = $query_paquetes_itinerarios->VerRegistro()) {
									$query = new Consulta("DELETE FROM paquetes_itinerarios_detalles WHERE id_paquete_itinerario = '".$row['id_paquete_itinerario']."' ");
									$query = new Consulta("DELETE FROM paquetes_itinerarios_hoteles WHERE id_paquete_itinerario = '".$row['id_paquete_itinerario']."' ");
								}
								$query = new Consulta("DELETE FROM paquetes_itinerarios WHERE id_paquete = '".$id_paquete."' ");
								$servicio = $_POST['servicio'];
								$nombreDia = $_POST['nombreDia'];
								$hoteles = $_POST['hotel'];
								$descripcion = $_POST['descripcion'];
								$dias = $_POST['dias'];
								foreach ($nombreDia as $key => $nombre) {
									$query2 = new Consulta("INSERT INTO paquetes_itinerarios VALUES('','". $id_paquete ."','41','". $nombre['0'] ."','". $descripcion[$key]['0'] ."') ");
									$nuevoid2 = $query2->nuevoid();

									$hoteles = $dias[$key][0];
									if (is_array($hoteles) || is_object($hoteles)){
										foreach ($hoteles as $llave => $hotel) {
											$query3 = new Consulta("INSERT INTO paquetes_itinerarios_hoteles VALUES('','". $nuevoid2 ."','". $hotel ."') ");
										}
									}
									$servicios = $dias[$key][1];
									if (is_array($servicios) || is_object($servicios)){
										foreach ($servicios as $llave => $value) {
											$query3 = new Consulta("INSERT INTO paquetes_itinerarios_detalles VALUES('','". $nuevoid2 ."','". $value ."') ");
										}
									}

								}
								$incluye = $_POST['incluye'];
								$excluye = $_POST['excluye'];

								$query4 = new Consulta("DELETE FROM paquetes_inclusiones where id_paquete = '".$id_paquete."'");
								if (is_array($incluye) || is_object($incluye)) {
									foreach ($incluye as $key => $value) {
										$query4 = new Consulta("INSERT INTO paquetes_inclusiones values(null,".$id_paquete.",'".$value."',1)");
									}
								}
								if (is_array($excluye) || is_object($excluye)) {
									foreach ($excluye as $key => $value) {
										$query4 = new Consulta("INSERT INTO paquetes_inclusiones values(null,".$id_paquete.",'".$value."',2)");
									}
								}
							}

							function borrarPaqueteAjax(){
								$id = $_GET['id'];

								$query_paquetes_itinerarios = new Consulta("SELECT id_paquete_itinerario FROM paquetes_itinerarios WHERE id_paquete = '".$id."' ");

								while($row = $query_paquetes_itinerarios->VerRegistro()) {
									$query = new Consulta("DELETE FROM paquetes_itinerarios_detalles WHERE id_paquete_itinerario = '".$row['id_paquete_itinerario']."' ");
									$query = new Consulta("DELETE FROM paquetes_itinerarios_hoteles WHERE id_paquete_itinerario = '".$row['id_paquete_itinerario']."' ");
								}
								$query = new Consulta("DELETE FROM paquetes_itinerarios WHERE id_paquete = '".$id."' ");
								$query = new Consulta("DELETE FROM paquetes_destinos WHERE id_paquete = '".$id."' ");
								$query = new Consulta("DELETE FROM paquetes_inclusiones WHERE id_paquete = '".$id."' ");
								$query = new Consulta("DELETE FROM paquetes WHERE id_paquete = '".$id."' ");

							}

							function deleteDiaPaqueteAjax(){
								$id = $_POST['id'];
								if ($id!='') {
									$query = new Consulta("DELETE FROM paquetes_itinerarios WHERE id_paquete_itinerario = '".$id."' ");
								}
							}
							//FIN PAQUETES

							/*AJAX PARA TABLA SERVICIOS */
							function registrarSevicioAjax()
							{
								$tipo = $_GET['tipo'];
								$empresa = $_GET['empresa'];
								$nombre = $_GET['nombre'];
								$precio_nacional = $_GET['precio_nacional'];
								$precio_extranjero = $_GET['precio_extranjero'];
								$alcance = $_GET['alcance'];
								$descripcion = $_GET['descripcion'];
								$contacto_nombre = $_GET['contacto_nombre'];
								$contacto_numero = $_GET['contacto_numero'];

								$query = new Consulta("INSERT INTO servicios values('','".$tipo."','".$empresa."','".$nombre."','".$precio_nacional."','".$precio_extranjero."','".$alcance."','".$descripcion."','".$contacto_nombre."','".$contacto_numero."')");
								$nuevoid = $query->nuevoid();

								$departamento = $_GET['departamento'];
								if ($_GET['departamento']) {
									foreach ($departamento as $depa) {
										$query2 =new Consulta( "INSERT INTO servicios_ubicaciones values('','".$nuevoid."','".$depa."')" );
									}
								}

							}
							function borrarServicioAjax()
							{
								$id = $_GET['id'];
								$query = new Consulta("DELETE FROM servicios_ubicaciones WHERE id_servicio = '".$id."' ");

								$query2 = new Consulta("DELETE FROM servicios WHERE id_servicio = '".$id."' ");
							}
							function cambiarServicioAjax()
							{
								$id_servicio = $_GET['idservicio'];
								$tipo = $_GET['tipo'];
								$empresa = $_GET['empresa'];
								$nombre = $_GET['nombre'];
								$precio_nacional = $_GET['precio_nacional'];
								$precio_extranjero = $_GET['precio_extranjero'];
								$alcance = $_GET['alcance'];
								$descripcion = $_GET['descripcion'];
								$contacto_nombre = $_GET['contacto_nombre'];
								$contacto_numero = $_GET['contacto_numero'];

								$query = new Consulta("UPDATE servicios SET
									id_tipo_servicio = '".$tipo."',
									id_empresa = '".$empresa."',
									nombre_servicio = '".$nombre."',
									precio_nacional_servicio = '".$precio_nacional."',
									precio_extranjero_servicio = '".$precio_extranjero."',
									alcance_servicio ='".$alcance."',
									descripcion_servicio ='".$descripcion."',
									contacto_nombre_servicio = '".$contacto_nombre."',
									contacto_numero_servicio = '".$contacto_numero."'
									WHERE id_servicio = '".$id_servicio."' ");

									$departamento = $_GET['departamento'];
									/*LIMPIAMOS LOS DEPARTAMENTOS*/
									$query2 = new Consulta("DELETE FROM servicios_ubicaciones WHERE id_servicio = '".$id_servicio."' ");
									if ($_GET['departamento']) {
										foreach ($departamento as $depa) {
											$query3 =new Consulta( "INSERT INTO servicios_ubicaciones values('','".$id_servicio."','".$depa."')" );
										}
									}
								}
								/*AJAX PARA TABLA SERVICIOS */
							}
							?>
