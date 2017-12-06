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
						$edithabitacion = $_GET['edithabitacion'];
						$editprecio = $_GET['editprecio'];
						$tipo = $_GET['tipo'];

						if ($tipo == 1) {
							$query = new Consulta("UPDATE hoteles_tarifas
								SET precio_nacional = ".$editprecio.",
								id_habitacion = ".$edithabitacion."
								WHERE id_hotel_tarifa = ".$idtarifa);
						}else {
							$query = new Consulta("UPDATE hoteles_tarifas
								SET precio_extranjero = ".$editprecio.",
								id_habitacion = ".$edithabitacion."
								WHERE id_hotel_tarifa = ".$idtarifa);
						}
					}
					function borrarHotelTarifaAjax()
					{
						$id = $_GET['id'];
						$query = new Consulta("DELETE FROM hoteles_tarifas WHERE id_hotel_tarifa = '".$id."'");
					}

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
										<label class="control-label">Hotel<star>*</star></label>
										<div class="form-group">
											<select id="list-hotel-<?php echo $dia ?>" name="hotel[<?php echo $dia_actual ?>]" onchange="addHabitaciones(<?php echo $dia ?>,1,this.value)">
												<option value="0"> - seleccione un hotel - </option>
												<?php foreach ($listadoHotelesxDepartamentos as $Hotel): ?>
													<option value="<?php echo $Hotel['id'] ?>"><?php echo $Hotel['departamento'].' ( '.$Hotel['estrellas'].' estrellas - $'.round($Hotel['precio'], 2).' ) : '.$Hotel['nombre'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="select-container-<?php echo $dia?>">
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
									<th class="text-center">Personas</th>
									<th class="text-center">Cantidad</th>
									<th class="text-center">Precio</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($habitaciones as $key => $habitacion) { ?>
									<tr>
										<td class="text-center">
											<input type="checkbox" class="checkbox" name="check_habitaciones[<?php echo (int)$_POST['dia']-1 ?>][<?php echo $habitacion['id_habitacion'] ?>]" value="<?php echo $habitacion['id_habitacion'] ?>"/>
											<input type="hidden" name="precios_habitaciones[<?php echo (int)$_POST['dia']-1 ?>][<?php echo $habitacion['id_habitacion'] ?>]" value="<?php echo $habitacion['precio_hotel_tarifa'] ?>"/>
										</td>
										<td class="text-left"><?php echo $habitacion['nombre_habitacion'] ?></td>
										<td class="text-center"><?php echo $habitacion['cantidad_habitacion'] ?></td>
										<td class="text-center"><input type="input" onchange="habitacion_update(this)" name="cantidad_habitaciones[<?php echo (int)$_POST['dia']-1 ?>][<?php echo $habitacion['id_habitacion'] ?>]" /></td>
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
						$id_itinerario = $_POST['id_itinerario'];
						$servicios;
						if ($id_itinerario != 'undefined') {
							$servicios = Paquetes::getPaquetesItinerarioDetalle($id_itinerario);
						}
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
									<label class="control-label">Servicios<star>*</star></label>
									<div class="form-group" style="overflow-y: auto;max-height: 345px;">
										<table id="table_s_<?php echo $dia_actual?>" class="display table_servicio" name="servicio[<?php echo $dia_actual ?>]" width="100%" cellspacing="0" data-page-length='5'>
											<thead>
												<th>Nombre</th>
												<th>Departamento</th>
												<th>Tipo Servicio</th>
												<th>Alcanse</th>
												<th>Precio Extranjero</th>
												<th hidden="">ID</th>
											</thead>
											<tbody>
												<?php
												$contador_table=0;
												foreach ($listadoServiciosxDepartamentos as $Servicio) {
													$estado = true;
													if ((is_array($servicios) || is_object($servicios)) && !empty($servicios)){
														foreach ($servicios as $llave => $value) {
															if ($Servicio['id']==$value['id_servicio']) {?>
													<tr class="selected">
														<td><?php echo $Servicio['nombre'] ?></td>
														<td><?php echo $Servicio['departamento']?></td>
														<td><?php echo $Servicio['nombre_tipo_servicio']?></td>
														<td><?php echo $Servicio['alcance']?></td>
														<td><?php echo "$".number_format($Servicio['precio_e'], 2, '.', ''); ?></td>
														<td class="id" hidden=""><?php echo $Servicio['id'] ?></td>
													</tr>
													<?php $estado = true; break; }else{$estado = false;}}
													if (!$estado) { ?>
														<tr>
															<td><?php echo $Servicio['nombre'] ?></td>
															<td><?php echo $Servicio['departamento']?></td>
															<td><?php echo $Servicio['nombre_tipo_servicio']?></td>
															<td><?php echo $Servicio['alcance']?></td>
															<td><?php echo "$".number_format($Servicio['precio_e'], 2, '.', ''); ?></td>
															<td class="id" hidden=""><?php echo $Servicio['id'] ?></td>
														</tr>
													<?php  }}else{?>
														<tr>
															<td><?php echo $Servicio['nombre'] ?></td>
															<td><?php echo $Servicio['departamento']?></td>
															<td><?php echo $Servicio['nombre_tipo_servicio']?></td>
															<td><?php echo $Servicio['alcance']?></td>
															<td><?php echo "$".number_format($Servicio['precio_e'], 2, '.', ''); ?></td>
															<td class="id" hidden=""><?php echo $Servicio['id'] ?></td>
														</tr>
													<?php } $contador_table++;} ?>
											</tbody>
										</table>
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
							if (count($departamentos)>0 && ($_POST['id']=='' || $_POST['id'] = 'undefined')) { //NUEVO
								foreach ($departamentos as $key => $value) {
									$ubicaciones_lista .= $value.',';
								}
							} else { //EDITAR
								$objCotizacion= new Cotizacion($_POST['id']);
								//INICIO CARGAR UBICACIONES DE LOS SERVICIOS
								foreach ($objCotizacion	->__get('_departamento') as $key => $value) {
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
										<input type="hidden" class="listahoteles-<?php echo $dia ?>" value="2"/>
										<div class="card-content">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label">
															Nombre
														</label>
														<input class="form-control" type="text" name="nombreDia[<?php echo $dia_actual ?>]" placeholder="Nombre para Identificar el Día"/>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label">
															Itinerario
														</label>
														<textarea class="form-control" name="descripcion[<?php echo $dia_actual ?>]" rows="5" cols="5"></textarea>
													</div>
												</div>
											</div>
											<div class="contenedor-hoteles-apend-container">
												<input type="hidden" class="listahoteles" value="<?php echo count($listadoHotelesxDepartamentos)+1 ?>"/>
												<div class="contenedor-hoteles-apend contenedor-hoteles-apend-1">
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label">Hotel<star>*</star></label>
																<select id="list-hotel-<?php echo $dia ?>" name="hotel[<?php echo $dia_actual ?>]" onchange="addHabitaciones(<?php echo $dia ?>,1,this.value)">
																	<option value="0"> - seleccione un hotel - </option>
																	<?php foreach ($listadoHotelesxDepartamentos as $Hotel): ?>
																		<option value="<?php echo $Hotel['id'] ?>"><?php echo $Hotel['departamento'].' ( '.$Hotel['estrellas'].' estrellas - $'.round($Hotel['precio'], 2).' ) : '.$Hotel['nombre'] ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
															<div class="select-container-<?php echo $dia ?>">
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="contenedor-servicios-apend-container">
												<div class="contenedor-servicios-apend contenedor-servicios-apend-1">
													<!--<input type="hidden" class="listaservicio-1" value="1"/>-->
													<div class="row" id="ContentService">
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label">Servicios<star>*</star></label>
																<div class="form-group" style="overflow-y: auto;height: 345px;">
																	<table id="table_edit_s_<?php echo $dia_actual?>" class="display table_servicio" width="100%" cellspacing="0" data-page-length='5'>
																		<thead>
																			<th>Nombre</th>
																			<th>Departamento</th>
																			<th>Tipo Servicio</th>
																			<th>Alcanse</th>
																			<th>Precio Extranjero</th>
																			<th hidden="">ID</th>
																		</thead>
																		<tbody>
																			<?php foreach ($listadoServiciosxDepartamentos as $Servicio) { ?>
																				<tr>
																					<td><?php echo $Servicio['nombre'] ?></td>
																					<td><?php echo $Servicio['departamento']?></td>
																					<td><?php echo $Servicio['nombre_tipo_servicio']?></td>
																					<td><?php echo $Servicio['alcance']?></td>
																					<td><?php echo "$".number_format($Servicio['precio_e'], 2, '.', ''); ?></td>
																					<td class="id" hidden=""><?php echo $Servicio['id'] ?></td>
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
						</div>
					<?php }

					function registrarCotizacionAjax(){
						// print_r($_POST);
						// exit;
						if(isset($_FILES['files']) && ($_FILES['files']['name'] != "")){

							$obj  = new Upload();
							$destino = "../aplication/webroot/imgs/";

							$name = strtolower(date("ymdhis").$_FILES['files']['name']);
							$temp = $_FILES['files']['tmp_name'];
							$type = $_FILES['files']['type'];
							$size = $_FILES['files']['size'];

							$obj->upload_imagen($name, $temp, $destino, $type, $size);
						}

						$query_cotizacion = new Consulta("INSERT INTO cotizaciones values('','".$_POST['id_cliente']."','".$_POST['numero_pasajeros']."','".$_POST['nombre_paquete']."','".$_POST['descripcion_paquete']."','".$name."','".date('Y-m-d')."')");
						$nuevoIdCotizacion = $query_cotizacion->nuevoid();

						$departamento = $_POST['departamento'];
						if ($_POST['departamento']) {
							foreach ($departamento as $depa) {
								$query_destinos =new Consulta( "INSERT INTO cotizaciones_destinos values('','".$nuevoIdCotizacion."','".$depa."')" );
							}
						}

						$servicio = $_POST['servicios'];
						$nombreDia = $_POST['nombreDia'];
						$hoteles = $_POST['hotel'];
						$descripcion = $_POST['descripcion'];


						$check_habitaciones = $_POST['check_habitaciones'];
						$precios_habitaciones = $_POST['precios_habitaciones'];
						$cantidad_habitaciones = $_POST['cantidad_habitaciones'];

						foreach ($nombreDia as $key => $nombre) {

							$query_itinerarios = new Consulta("INSERT INTO cotizaciones_itinerarios VALUES('','". $nuevoIdCotizacion ."',".$key.",'". $nombre ."','". $descripcion[$key] ."') ");
							$nuevoIdItinerarios = $query_itinerarios->nuevoid();
							$servicioarray = $servicio[$key];

							if (is_array($servicioarray) || is_object($servicioarray)) {
								foreach ($servicioarray as $llave => $value) {
									$query_itinerario_detalle = new Consulta("INSERT INTO cotizaciones_itinerarios_detalles VALUES('','". $nuevoIdItinerarios ."','". $value ."') ");
								}
							}

							$hotel = $hoteles[$key];  //Listo solo los de un dia a la vez

							$checkarray = $check_habitaciones[$key];
							$preciosarray = $precios_habitaciones[$key];
							$cantidadarray = $cantidad_habitaciones[$key];

							if (is_array($checkarray) || is_object($checkarray)) {
								foreach ($checkarray as $k => $value) {
										$preciosarray[$k];
										$cantidadarray[$k];
										$queryItinerariosHoteles = new Consulta("INSERT INTO cotizaciones_itinerarios_hoteles
											VALUES('','". $nuevoIdItinerarios ."','". $hotel ."','". $value ."','". $cantidadarray[$k] ."') ");
								}
							}
						}

						$incluye = $_POST['incluye'];
						$excluye = $_POST['excluye'];

						$query4 = new Consulta("DELETE FROM inclusiones where tipo_programa = 1 AND id_cotizacion = '".$nuevoid."'");
						if (is_array($incluye) || is_object($incluye)) {
							foreach ($incluye as $key => $value) {
								$query4 = new Consulta("INSERT INTO inclusiones values(null,null,".$nuevoIdCotizacion.",'".$value."',1,1)");
							}
						}
						if (is_array($excluye) || is_object($excluye)) {
							foreach ($excluye as $key => $value) {
								$query4 = new Consulta("INSERT INTO inclusiones values(null,null,".$nuevoIdCotizacion.",'".$value."',2,1)");
							}
						}

					}

					function actualizarCotizacionAjax(){

						// print_r($_POST);
						// exit;

						if(isset($_FILES['files']) && ($_FILES['files']['name'] != "")){

							$obj  = new Upload();
							$destino = "../aplication/webroot/imgs/";

							$name = strtolower(date("ymdhis").$_FILES['files']['name']);
							$temp = $_FILES['files']['tmp_name'];
							$type = $_FILES['files']['type'];
							$size = $_FILES['files']['size'];

							$obj->upload_imagen($name, $temp, $destino, $type, $size);
							$update="imagen_cotizacion = '".$name."',";
						}

						$id = $_POST['id'];

						$query_cotizacion = new Consulta("UPDATE  cotizaciones SET
							".$update."
							id_cliente = ".$_POST['id_cliente'].",
							numero_pasajeros = ".$_POST['numero_pasajeros'].",
							nombre_cotizacion = '".$_POST['nombre_paquete']."',
							descripcion_cotizacion = '".$_POST['descripcion_paquete']."'
							WHERE id_cotizacion =".$id);

						$query = new Consulta("DELETE FROM cotizaciones_destinos WHERE id_cotizacion = '".$id."' ");
						$departamento = $_POST['departamento'];
						if ($_POST['departamento']) {
							foreach ($departamento as $depa) {
								$query2 =new Consulta( "INSERT INTO cotizaciones_destinos values('','".$id."','".$depa."')" );
							}
						}

						$query_cotizaciones_itinerarios = new Consulta("SELECT id_cotizacion_itinerario FROM cotizaciones_itinerarios WHERE id_cotizacion = '".$id."' ");

						while($row = $query_cotizaciones_itinerarios->VerRegistro()) {
							$query = new Consulta("DELETE FROM cotizaciones_itinerarios_detalles WHERE id_cotizacion_itinerario = '".$row['id_cotizacion_itinerario']."' ");
							$query = new Consulta("DELETE FROM cotizaciones_itinerarios_hoteles WHERE id_cotizacion_itinerario = '".$row['id_cotizacion_itinerario']."' ");
						}

						$query = new Consulta("DELETE FROM cotizaciones_itinerarios WHERE id_cotizacion = '".$id."' ");

						$servicio = $_POST['servicios'];
						$nombreDia = $_POST['nombreDia'];
						$hoteles = $_POST['hotel'];
						$descripcion = $_POST['descripcion'];

						$check_habitaciones = $_POST['check_habitaciones'];
						$precios_habitaciones = $_POST['precios_habitaciones'];
						$cantidad_habitaciones = $_POST['cantidad_habitaciones'];

						foreach ($nombreDia as $key => $nombre) {

							$query_itinerarios = new Consulta("INSERT INTO cotizaciones_itinerarios VALUES('','". $id ."',".$key.",'". $nombre ."','". $descripcion[$key] ."') ");
							$nuevoIdItinerarios = $query_itinerarios->nuevoid();
							$servicioarray = $servicio[$key];

							if (is_array($servicioarray) || is_object($servicioarray)) {
								foreach ($servicioarray as $llave => $value) {
									$query_itinerario_detalle = new Consulta("INSERT INTO cotizaciones_itinerarios_detalles VALUES('','". $nuevoIdItinerarios ."','". $value ."') ");
								}
							}

							$hotel = $hoteles[$key];  //Listo solo los de un dia a la vez

							$checkarray = $check_habitaciones[$key];
							$preciosarray = $precios_habitaciones[$key];
							$cantidadarray = $cantidad_habitaciones[$key];

							if (is_array($checkarray) || is_object($checkarray)) {
								foreach ($checkarray as $k => $value) {
										$preciosarray[$k];
										$cantidadarray[$k];
										$queryItinerariosHoteles = new Consulta("INSERT INTO cotizaciones_itinerarios_hoteles
											VALUES('','". $nuevoIdItinerarios ."','". $hotel ."','". $value ."','". $cantidadarray[$k] ."') ");
								}
							}
						}
						$incluye = $_POST['incluye'];
						$excluye = $_POST['excluye'];

						$query4 = new Consulta("DELETE FROM inclusiones where tipo_programa = 1 AND id_cotizacion = '".$id."'");
						if (is_array($incluye) || is_object($incluye)) {
							foreach ($incluye as $key => $value) {
								$query4 = new Consulta("INSERT INTO inclusiones values(null,null,".$id.",'".$value."',1,1)");
							}
						}
						if (is_array($excluye) || is_object($excluye)) {
							foreach ($excluye as $key => $value) {
								$query4 = new Consulta("INSERT INTO inclusiones values(null,null,".$id.",'".$value."',2,1)");
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
							$query_cotizaciones_itinerarios = new Consulta("SELECT id_cotizacion_itinerario FROM cotizaciones_itinerarios WHERE id_cotizacion = '".$id."' ");

							while($row = $query_cotizaciones_itinerarios->VerRegistro()) {
								$query = new Consulta("DELETE FROM cotizaciones_itinerarios_detalles WHERE id_cotizacion_itinerario = '".$row['id_cotizacion_itinerario']."' ");
								$query = new Consulta("DELETE FROM cotizaciones_itinerarios_hoteles WHERE id_cotizacion_itinerario = '".$row['id_cotizacion_itinerario']."' ");
							}
							$query = new Consulta("DELETE FROM cotizaciones_itinerarios WHERE id_cotizacion = '".$id."' ");
							$query = new Consulta("DELETE FROM cotizaciones_destinos WHERE id_cotizacion = '".$id."' ");
							$query = new Consulta("DELETE FROM inclusiones WHERE tipo_programa = 1 AND id_cotizacion = '".$id."' ");
							$query = new Consulta("DELETE FROM cotizaciones WHERE id_cotizacion = '".$id."' ");

						}

						function deleteDiaCotizacionAjax(){
							$id = $_POST['id'];
							if ($id!='') {
								$query = new Consulta("DELETE FROM paquetes_itinerarios WHERE id_paquete_itinerario = '".$id."' ");
							}
						}

						function obtenerPaqueteCotizacionAjax(){
							$id = $_GET['id'];
							$query = new Consulta("SELECT * FROM paquetes where id_paquete = ".$id);
							$row = $query->VerRegistro();
							$paquete['nombre']=$row['nombre_paquete'];
							$paquete['descripcion']=$row['descripcion_paquete'];
							$paquete['imagen']=$row['imagen_paquete'];

							$departamentos_tmp = array();
							$query2 = new Consulta("SELECT * FROM paquetes_destinos where id_paquete = ".$id);
							while ($row = $query2->VerRegistro()) {
								$departamentos_tmp[]=$row["id_departamento"];
							}
							$paquete['departamentos'] = $departamentos_tmp;

							$query3 = new Consulta("SELECT * from paquetes_itinerarios where id_paquete = ".$id." order by dia_paquete ASC");
							$c = 0;
							while ($paquete_itinerario_row = $query3->VerRegistro()) {
								$paquete_itinerario[$c]['id'] = $paquete_itinerario_row["id_paquete_itinerario"];
								$paquete_itinerario[$c]['dia'] = $paquete_itinerario_row["dia_paquete"];
								$paquete_itinerario[$c]['nombre'] = $paquete_itinerario_row["nombre_paquete_itinerario"];
								$paquete_itinerario[$c]['descripcion'] = $paquete_itinerario_row["descripcion_paquete_itinerario"];
								$c++;
							}

							$query_inclusion = new Consulta("SELECT * from inclusiones where id_paquete = ".$id." and tipo_programa = 0 and tipo_inclusion = 1");
							while ($inclusiones_row = $query_inclusion->VerRegistro()) {
								$paquete['inclusiones'][] = $inclusiones_row['nombre_inclusion'];
							}

							$query_exclusion = new Consulta("SELECT * from inclusiones where id_paquete = ".$id." and tipo_programa = 0 and tipo_inclusion = 2");
							while ($exclusiones_row = $query_exclusion->VerRegistro()) {
								$paquete['exclusiones'][] = $exclusiones_row['nombre_inclusion'];
							}
							$paquete['itinerario'] = $paquete_itinerario;

							echo json_encode($paquete);
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
										<div class="form-group" style="overflow-y: auto;max-height: 345px;">
											<table id="table_s_<?php echo $dia_actual?>" class="display table_servicio" width="100%" cellspacing="0" data-page-length='5'>
												<thead>
													<th>Nombre</th>
													<th>Departamento</th>
													<th>Tipo Servicio</th>
													<th>Alcanse</th>
													<th>Precio Extranjero</th>
													<th hidden="">ID</th>
												</thead>
												<tbody>
													<?php foreach ($listadoServiciosxDepartamentos as $Servicio) { ?>
														<tr>
															<td><?php echo $Servicio['nombre'] ?></td>
															<td><?php echo $Servicio['departamento']?></td>
															<td><?php echo $Servicio['nombre_tipo_servicio']?></td>
															<td><?php echo $Servicio['alcance']?></td>
															<td><?php echo "$".number_format($Servicio['precio_e'], 2, '.', ''); ?></td>
															<td class="id" hidden=""><?php echo $Servicio['id'] ?></td>
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
							$count=0;
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
															<input class="form-control" type="text" required name="nombreDia[<?php echo $dia-1 ?>][]" placeholder="Nombre para Identificar el Día"/>
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
												<div class="contenedor-servicios-apend-container">
													<div class="contenedor-servicios-apend contenedor-servicios-apend-1">
														<!--<input type="hidden" class="listaservicio-1" value="1"/>-->
														<div class="row" id="ContentService">
															<div class="col-md-12">
																<label class="control-label">Servicios<star>*</star></label>
																<div class="form-group" style="overflow-y: auto;height: 345px;">
																	<table id="table_edit_s_<?php echo $dia-1?>" class="display table_servicio" width="100%" cellspacing="0" data-page-length='5'>
																		<thead>
																			<th>Nombre</th>
																			<th>Departamento</th>
																			<th>Tipo Servicio</th>
																			<th>Alcanse</th>
																			<th>Precio Extranjero</th>
																			<th hidden="">ID</th>
																		</thead>
																		<tbody>
																			<?php foreach ($listadoServiciosxDepartamentos as $Servicio) { ?>
																				<tr>
																					<td><?php echo $Servicio['nombre'] ?></td>
																					<td><?php echo $Servicio['departamento']?></td>
																					<td><?php echo $Servicio['nombre_tipo_servicio']?></td>
																					<td><?php echo $Servicio['alcance']?></td>
																					<td><?php echo "$".number_format($Servicio['precio_e'], 2, '.', ''); ?></td>
																					<td class="id" hidden=""><?php echo $Servicio['id'] ?></td>
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
							$opciones = $_POST['opciones_hoteles'];
							$dias = $_POST['dias'];

							foreach ($opciones as $key => $opcion) {
								$hoteles_opcion = explode(",",$opcion);
								foreach ($hoteles_opcion as $key2 => $opcion_h) {
									if ($opcion_h == 0) {
										$opcion_h="null";
									}
									$query3 = new Consulta("INSERT INTO paquetes_itinerarios_hoteles VALUES('','". $nuevoid ."',". $opcion_h .",'".$key."',".$key2.") ");
								}
							}

							foreach ($nombreDia as $key => $nombre) {
								$query2 = new Consulta("INSERT INTO paquetes_itinerarios VALUES('','". $nuevoid ."',".($key+1).",'". $nombre['0'] ."','". $descripcion[$key]['0'] ."') ");
								$nuevoid2 = $query2->nuevoid();

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

							$query4 = new Consulta("DELETE FROM inclusiones where tipo_programa = 0 AND id_paquete = '".$nuevoid."'");
							if (is_array($incluye) || is_object($incluye)) {
								foreach ($incluye as $key => $value) {
									$query4 = new Consulta("INSERT INTO inclusiones values(null,".$nuevoid.",null,'".$value."',1,0)");
								}
							}
							if (is_array($excluye) || is_object($excluye)) {
								foreach ($excluye as $key => $value) {
									$query4 = new Consulta("INSERT INTO inclusiones values(null,".$nuevoid.",null,'".$value."',2,0)");
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
									$query = new Consulta("DELETE FROM paquetes_itinerarios_hoteles WHERE id_paquete = '".$id_paquete."' ");
								}
								$query = new Consulta("DELETE FROM paquetes_itinerarios WHERE id_paquete = '".$id_paquete."' ");
								$servicio = $_POST['servicio'];
								$nombreDia = $_POST['nombreDia'];
								$opciones = $_POST['opciones_hoteles'];
								$descripcion = $_POST['descripcion'];
								$dias = $_POST['dias'];

								foreach ($opciones as $key => $opcion) {
									$hoteles_opcion = explode(",",$opcion);
									foreach ($hoteles_opcion as $key2 => $opcion_h) {
										if ($opcion_h == 0) {
											$opcion_h="null";
										}
										$query3 = new Consulta("INSERT INTO paquetes_itinerarios_hoteles VALUES('','". $id_paquete ."',". $opcion_h .",'".$key."',".$key2.") ");
									}
								}

								foreach ($nombreDia as $key => $nombre) {
									$query2 = new Consulta("INSERT INTO paquetes_itinerarios VALUES('','". $id_paquete ."',".($key+1).",'". $nombre['0'] ."','". $descripcion[$key]['0'] ."') ");
									$nuevoid2 = $query2->nuevoid();
									$servicios = $dias[$key][1];
									if (is_array($servicios) || is_object($servicios)){
										foreach ($servicios as $llave => $value) {
											$query3 = new Consulta("INSERT INTO paquetes_itinerarios_detalles VALUES('','". $nuevoid2 ."','". $value ."') ");
										}
									}
								}
								$incluye = $_POST['incluye'];
								$excluye = $_POST['excluye'];

								$query4 = new Consulta("DELETE FROM inclusiones where tipo_programa = 0 AND id_paquete = '".$id_paquete."'");
								if (is_array($incluye) || is_object($incluye)) {
									foreach ($incluye as $key => $value) {
										$query4 = new Consulta("INSERT INTO inclusiones values(null,".$id_paquete.",null,'".$value."',1,0)");
									}
								}
								if (is_array($excluye) || is_object($excluye)) {
									foreach ($excluye as $key => $value) {
										$query4 = new Consulta("INSERT INTO inclusiones values(null,".$id_paquete.",null,'".$value."',2,0)");
									}
								}
							}

							function borrarPaqueteAjax(){
								$id = $_GET['id'];

								$query_paquetes_itinerarios = new Consulta("SELECT id_paquete_itinerario FROM paquetes_itinerarios WHERE id_paquete = '".$id."' ");

								while($row = $query_paquetes_itinerarios->VerRegistro()) {
									$query = new Consulta("DELETE FROM paquetes_itinerarios_detalles WHERE id_paquete_itinerario = '".$row['id_paquete_itinerario']."' ");
									$query = new Consulta("DELETE FROM paquetes_itinerarios_hoteles WHERE id_paquete = '".$id."' ");
								}
								$query = new Consulta("DELETE FROM paquetes_destinos WHERE id_paquete = '".$id."' ");
								$query = new Consulta("DELETE FROM paquetes_itinerarios WHERE id_paquete = '".$id."' ");
								$query = new Consulta("DELETE FROM paquetes_destinos WHERE id_paquete = '".$id."' ");
								$query = new Consulta("DELETE FROM inclusiones WHERE tipo_programa = 0 AND id_paquete = '".$id."' ");
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
								function getHotelesOpcionesAjax(){
									$dias = $_POST['dias'];
									$departamentos = $_POST['departamento'];
									foreach ($departamentos as $key => $value) {
										$ubicaciones_lista .= $value.',';
									}
									$ubicaciones = substr($ubicaciones_lista, 0, -1);
									$hoteles = new Hoteles();

									$lista_hoteles = $hoteles->getHotelesxDepartamentos($ubicaciones);
									for ($i=0; $i <$dias ; $i++) {
									?>

									<div class="row">
									<div class="col-xs-2 col-sm-2 col-md-2">
										<h6>Dia <?php echo (int)$i+1; ?>:</h6>
									</div>
									<div class="col-xs-10 col-sm-10 col-md-10">
										<select class="select_hoteles">
											<option value="0"> - sin Hotel - </option>
											<?php foreach ($lista_hoteles as $key => $value): ?>
													<option value="<?php echo $value['id'] ?>"><?php echo $value['departamento']?> - <?php echo $value['estrellas'] ?> - <?php echo $value['nombre'] ?> - $<?php echo number_format($value['precio_e'], 2, '.', '') ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									</div>
								<?php
								}
							}
								/*AJAX PARA TABLA SERVICIOS */

								/*AJAX PARA CLIENTES */

								function obtenerDatosClienteAjax(){
									$id = $_GET['id'];
									$query = new Consulta("SELECT * FROM clientes WHERE id_cliente = ".$id);
									$row = $query->VerRegistro();
									$result['id_fuente'] = $row['id_fuente'];
									$result['nombres'] = $row['nombres_cliente'];
									$result['documento'] = $row['documento_cliente'];
									$result['telefono'] = $row['telefono_cliente'];
									$result['email'] = $row['email_cliente'];
									echo json_encode($result);
								}

								function sweelAgregarClienteAjax(){

									$query = new Consulta("INSERT INTO clientes VALUES(null,1,".$_POST['fuente'].",".$_POST['nacionalidad'].",'".$_POST['nombre']."',".$_POST['documento'].",".$_POST['telefono'].",'".$_POST['email']."')");
									$id = $query->nuevoid();

									$query2 = new Consulta("SELECT * FROM clientes WHERE id_cliente = ".$id);
									$row = $query2->VerRegistro();
									$result['id_cliente'] = $row['id_cliente'];
									$result['id_fuente'] = $row['id_fuente'];
									$result['nombres'] = $row['nombres_cliente'];
									$result['documento'] = $row['documento_cliente'];
									$result['telefono'] = $row['telefono_cliente'];
									$result['email'] = $row['email_cliente'];
									echo json_encode($result);
								}

								/*AJAX PARA CLIENTES */


							}
							?>
