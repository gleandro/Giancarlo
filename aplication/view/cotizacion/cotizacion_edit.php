<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.3/css/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo _css_ ?>bootstrap-multiselect.css">

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.2.3/js/dataTables.select.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo _js_ ?>bootstrap-multiselect.js"></script>

<div class="row">
  <div class="col-md-12">
    <div class="card card-wizard" id="wizardEditarCotizacion">
      <form id="wizardFormEditarCotizacion" method="post" novalidate="" enctype="multipart/form-data">
        <input type="hidden" name="action" id="action" value="actualizarCotizacion">
        <input type="hidden" value="<?php echo $objCotizacion->__get('_id') ?>" name="id">
        <div class="card-header text-center">
          <h4 class="card-title">Modificar Programa de Viaje</h4>
          <p class="category">Complete el formulario para continuar.</p>
        </div>
        <div class="card-content">
          <ul class="nav">
            <li><a href="#tab1" data-toggle="tab">Datos del Programa</a></li>
            <li><a href="#tab2" data-toggle="tab">Itinerario del Programa</a></li>
            <li><a href="#tab3" data-toggle="tab">Inclusiones del Programa</a></li>
            <li><a href="#tab4" data-toggle="tab">Configuración de Hoteles</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane" id="tab1">
              <h5 class="text-center">Datos del Cliente.</h5>
              <div class="row">
                <div class="col-md-10 col-md-offset-1">
                  <div class="form-group">
                    <select id="list_paquetes">
                      <option value="0"> - sin Hotel - </option>
                      <?php foreach ($listaPaquetes as $key => $value): ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-10 col-md-offset-1">
                  <div class="form-group">
                    <label class="control-label">
                      Nombres
                    </label>
                    <input class="form-control" type="text" name="nombres_cliente" placeholder="Nombres" required="required" value="<?php echo $objCotizacion->__get('_cliente')->__get('_nombres') ?>"/>
                  </div>
                </div>
                <div class="col-md-10 col-md-offset-1">
                  <div class="form-group">
                    <label class="control-label">
                      Fuente de Contacto
                    </label>
                    <select title=".:: Seleccione una Fuente ::." class="selectpicker" data-style="btn-info btn-fill btn-block" data-size="7" name="fuente_cliente" required="required">
                      <?php foreach ($fuentes as $fuente) { ?>
                        <option value="<?php echo $fuente['id'] ?>"
                          <?php echo ($fuente['id']==$objCotizacion->__get('_cliente')->__get('_fuente')->__get('_id')) ? "selected":"";  ?>  >
                          <?php echo $fuente['nombre'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                    <div class="col-md-10 col-md-offset-1">
                      <div class="form-group">
                        <label class="control-label">
                          Documento (DNI/PASAPORTE)
                        </label>
                        <input class="form-control" type="number" name="documento_cliente" placeholder="Documento" required="required" value="<?php echo $objCotizacion->__get('_cliente')->__get('_documento') ?>"/>
                      </div>
                    </div>
                    <div class="col-md-10 col-md-offset-1">
                      <div class="form-group">
                        <label class="control-label">
                          Teléfono
                        </label>
                        <input class="form-control" type="number" name="telefono_cliente" placeholder="Teléfono" required="required" value="<?php echo $objCotizacion->__get('_cliente')->__get('_telefono') ?>"/>
                      </div>
                    </div>
                    <div class="col-md-10 col-md-offset-1">
                      <div class="form-group">
                        <label class="control-label">
                          Email
                        </label>
                        <input class="form-control" type="email" name="email_cliente" placeholder="Email" required="required" value="<?php echo $objCotizacion->__get('_cliente')->__get('_email') ?>"/>
                      </div>
                    </div>
                  </div>
                  <h5 class="text-center">Datos del Programa.</h5>
                  <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                      <div class="form-group">
                        <label class="control-label">
                          Nombre del Programa
                        </label>
                        <input id="nombre_programa" class="form-control" type="text" name="nombre_paquete" placeholder="Viaje" value="<?php echo $objCotizacion->__get('_nombre') ?>"/>
                      </div>
                    </div>
                    <div class="col-md-10 col-md-offset-1">
                      <div class="form-group">
                        <label class="control-label">
                          Seleccione los destinos incluidos en el programa
                        </label>
                        <select multiple title="Multiple Select" class="selectpicker" data-style="btn-info btn-fill btn-block" data-size="7" name="departamento[]">
                          <?php foreach ($listadoDepartamentos as $departamento) { ?>
                            <option value="<?php echo $departamento['id'] ?>"
                              <?php echo (in_array($departamento['id'],$objCotizacion->__get('_departamento'))) ? "selected":""; ?>   >
                              <?php echo $departamento['nombre']; ?>
                            </option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-10 col-md-offset-1">
                      <div class="form-group">
                        <label class="control-label">
                          Descripción del Programa
                        </label>
                        <textarea class="form-control" name="descripcion_paquete" id=""><?php echo $objCotizacion->__get('_descripcion') ?></textarea>
                      </div>
                    </div>
                    <div class="col-md-10 col-md-offset-1">
                      <div class="form-group">
                        <label class="control-label">
                          Nro de Pasajeros
                        </label>
                        <select title=".:: Seleccione una cantidad ::." class="selectpicker" data-style="btn-info btn-fill btn-block" data-size="7" name="numero_pasajeros" required="required">
                          <?php for ($i=1; $i < 11 ; $i++) { ?>
                            <option value="<?php echo $i ?>"
                              <?php echo ($i== $objCotizacion->__get('_cantidad')) ? "selected":"";  ?>  >
                              <?php echo $i; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-10 col-md-offset-1">
                        <div class="form-group">
                          <label class="control-label">
                            Subir imagen
                          </label>
                          <input class="form-control" type="file" name="files" id="files"/>
                          <br />
                          <output id="list">
                            <?php if ($objCotizacion->__get('_imagen')!=''): ?>
                              <img class="thumb" src="../aplication/webroot/imgs/<?php echo($objCotizacion->__get('_imagen')) ?>" alt="">
                            <?php endif ?>
                          </output>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="tab2">
                    <div class="row">
                      <div class="col-md-10 col-md-offset-1 text-right" style="padding-top:2%">
                        <a class="btn btn-info btn-fill" style="cursor: pointer;" onclick="addOneMoreDayEdit(<?php echo $_GET['id'] ?>)">&nbsp;&nbsp;&nbsp;&nbsp;Agregar dia&nbsp;&nbsp;&nbsp;&nbsp;</a>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-10 col-md-offset-1">
                        <input type="hidden" class="card-dia" value="<?php echo count($objCotizacion->__get('_itinerario')) ?>"/>
                        <div class="contenedor-card-apend-container">
                          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <?php
                            foreach ($objCotizacion->__get('_itinerario') as $key => $itinerario) {
                              $itinerario_hoteles = $objCotizaciones->getCotizacionesHotelesxItinerario($itinerario['id_itinerario']);
                              ?>
                              <div class="panel panel-default" style="border: 1px;border-color: #0003;border-style: solid;background-color:white">
                                <div class="panel-heading" style="background-color:white" role="tab" id="heading<?php echo (int)($key+1); ?>">
                                  <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo (int)($key+1); ?>" aria-expanded="false" aria-controls="collapseOne">
                                      <h4 class="card-title">Día <?php echo (int)($key+1);?><span> <a class="text-danger" onclick="eliminarPaquete(<?php echo (int)($key+1) ?>,<?php echo $itinerario['id_paquete_itinerario'] ?>);"><i class="fa fa-trash-o"></i></a></span></h4>
                                    </a>
                                  </h4>
                                </div>
                                <div id="collapse<?php echo (int)($key+1); ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?php echo (int)($key+1) ?>">
                                  <div class="panel-body">
                                    <div class="card card-<?php echo (int)($key+1) ?>">
                                      <input type="hidden" class="listahoteles-<?php echo (int)($key+1) ?>" value="<?php echo count($itinerario_hoteles)+1 ?>"/>
                                      <div class="card-content">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label class="control-label">
                                                Nombre
                                              </label>
                                              <input class="form-control" type="text" name="nombreDia[<?php echo $key ?>][]" placeholder="Nombre para Identificar el Día" value="<?php echo $itinerario['nombre'] ?>"/>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label class="control-label">
                                                Itinerario
                                              </label>
                                              <textarea class="form-control" name="descripcion[<?php echo $key ?>][]" rows="5" cols="5"><?php echo $itinerario['descripcion'] ?></textarea>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="contenedor-hoteles-apend-container">
                                          <input type="hidden" class="listahotel-<?php echo (int)($key+1) ?>" value="<?php echo count($itinerario_hoteles) ?>"/>
                                          <?php foreach ($itinerario_hoteles as $llave => $valor) { ?>
                                            <div class="contenedor-hotel-apend contenedor-servicios-apend-<?php echo $llave+1 ?>">
                                              <div class="row">
                                                <div class="col-md-12">
                                                  <div class="form-group">
                                                    <label class="control-label">Hotel<star>*</star></label>
                                                    <select title=".::Seleccione Hotel::." class="selectpicker" data-style="btn-info btn-fill btn-block" data-size="7" name="hotel[<?php echo $key ?>][<?php echo $llave+1 ?>][]">
                                                      <?php foreach ($listadoHotelesxDepartamentos as $Hotel) { ?>
                                                        <option value="<?php echo $Hotel['id'] ?>"
                                                          <?php echo ($Hotel['id']==$valor['id_hotel']) ? "selected":""; ?>   >
                                                          <?php echo $Hotel['departamento'].' ( '.$Hotel['estrellas'].' estrellas - $'.round($Hotel['precio'], 2).' ) : '.$Hotel['nombre'] ?>
                                                        </option>
                                                      <?php } ?>
                                                    </select>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <?php
                                            // $hoteles_habitaciones = Cotizaciones::getCotizacionesHotelesxHabitaciones($valor['id_cotizacion_paquete_itinerario_hotel']);
                                            $habitaciones = Hoteles::getHabitacionesHoteles($valor['id_hotel']);
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
                                                <?php foreach ($habitaciones as $keyh => $habitacion) { ?>
                                                  <tr>
                                                    <td class="text-center">
                                                      <input type="checkbox" name="check_habitaciones[<?php echo (int)($key) ?>][<?php echo $llave+1 ?>][<?php echo $habitacion['id_habitacion'] ?>]" value="<?php echo $habitacion['id_habitacion'] ?>"
                                                      <?php //echo (array_search($habitacion['id_habitacion'], $hoteles_habitaciones)) ? "checked":"";  ?>
                                                      />
                                                      <input type="hidden" name="precios_habitaciones[<?php echo (int)($key)?>][<?php echo $llave+1 ?>][<?php echo $habitacion['id_habitacion'] ?>]" value="<?php echo $habitacion['precio_hotel_tarifa'] ?>"/>
                                                    </td>
                                                    <td class="text-left"><?php echo $habitacion['nombre_habitacion'] ?></td>
                                                    <td class="text-center">
                                                      <input type="input" name="cantidad_habitaciones[<?php echo (int)($key) ?>][<?php echo $llave+1 ?>][<?php echo $habitacion['id_habitacion'] ?>]" value="<?php //echo array_search($habitacion['id_habitacion'], $hoteles_habitaciones) ?>"/>
                                                    </td>
                                                    <td class="text-right"><?php echo $habitacion['precio_hotel_tarifa'] ?></td>
                                                  </tr>
                                                <?php } ?>
                                              </tbody>
                                            </table>
                                          <?php } ?>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-12">
                                            <a class="text-success" style="cursor: pointer;" onclick="addOneMoreHotel(<?php echo (int)($key+1) ?>,<?php echo $_GET['id'] ?>)">Añadir un hotel más al día <i class="fa fa-plus-circle"></i></a>
                                          </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                          <div class="col-md-12">
                                            <p class="category">Servicios incluidos en el día.</p>
                                          </div>
                                        </div>
                                        <?php $servicios = Cotizaciones::getCotizacionesItinerarioDetalle($itinerario['id_itinerario']); ?>
                                        <div class="contenedor-servicios-apend-container">
                                          <div class="row">
                                            <div class="col-md-12">
                                              <label class="control-label">Servicios<star>*</star></label>
                                              <div class="form-group" style="overflow-y: auto;height: 345px;">
                                                <table id="table_s_<?php echo $key?>" class="display table_servicio" width="100%" cellspacing="0" data-page-length='5'>
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
                                                    foreach ($listadoServiciosxDepartamentos as $servicio) {
                                                      $estado = true;
                                                      if ((is_array($servicios) || is_object($servicios)) && !empty($servicios)){
                                                        foreach ($servicios as $llave => $value) {
                                                          if ($servicio['id']==$value['id_servicio']) {?>
                                                            <tr class="selected">
                                                              <td><?php echo $servicio['nombre'] ?></td>
                                                              <td><?php echo $servicio['departamento']?></td>
                                                              <td><?php echo $servicio['nombre_tipo_servicio']?></td>
                                                              <td><?php echo $servicio['alcance']?></td>
                                                              <td><?php echo "$".number_format($Servicio['precio_e'], 2, '.', ''); ?></td>
                                                              <td class="id" hidden=""><?php echo $servicio['id'] ?></td>
                                                            </tr>
                                                            <?php $estado = true; break; }else{$estado = false;}}
                                                            if (!$estado) { ?>
                                                              <tr>
                                                                <td><?php echo $servicio['nombre'] ?></td>
                                                                <td><?php echo $servicio['departamento']?></td>
                                                                <td><?php echo $servicio['nombre_tipo_servicio']?></td>
                                                                <td><?php echo $servicio['alcance']?></td>
                                                                <td><?php echo "$".number_format($Servicio['precio_e'], 2, '.', ''); ?></td>
                                                                <td class="id" hidden=""><?php echo $servicio['id'] ?></td>
                                                              </tr>
                                                            <?php  }}else{?>
                                                              <tr>
                                                                <td><?php echo $servicio['nombre'] ?></td>
                                                                <td><?php echo $servicio['departamento']?></td>
                                                                <td><?php echo $servicio['nombre_tipo_servicio']?></td>
                                                                <td><?php echo $servicio['alcance']?></td>
                                                                <td><?php echo "$".number_format($Servicio['precio_e'], 2, '.', ''); ?></td>
                                                                <td class="id" hidden=""><?php echo $servicio['id'] ?></td>
                                                              </tr>
                                                            <?php } $contador_table++;} ?>
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
                                    <?php } ?>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="tab-pane" id="tab3">
                            <h5 class="text-center">Ingrese las Inclusiones y exclusiones del Programa.</h5>
                            <div class="row">
                              <div class="col-sm-12 col-md-5 col-md-offset-1">
                                <div class="form-group">
                                  <input class="form-control" type="text" id="nombre_inclusion" placeholder="descripcion de inclusion " value=""/>
                                </div>
                              </div>
                              <div class="col-sm-9 col-md-4">
                                <div class="form-group">
                                  <select class="selectpicker" Title=".::.Seleccione Tipo de inclusion.::." id="inclusiones">
                                    <option value="1">Incluye</option>
                                    <option value="2">No Incluye</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-sm-3 col-md-1">
                                <div class="form-group text-right">
                                  <button type="button" class="btn btn-info" id="add_inclusion">Ingresar inclusion</button>
                                </div>
                              </div>
                              <div class="col-sm-12 col-md-10 col-md-offset-1">
                                <div class="row">
                                  <div class="col-md-6 text-center">
                                    <h3>Incluye</h3>
                                    <ul class="list-group" id="incluye">
                                      <?php if (is_array($array_incluye) || is_object($array_incluye)) {
                                        foreach ($array_incluye as $key => $value){?>
                                          <li class="list-group-item list-group-item-success"><?php echo $value; ?><input type="hidden" name="incluye[]" value="<?php echo $value; ?>"> <button type="button" class="close" onclick="javascript:eliminar_inclusiones(this)" aria-label="Close"><span aria-hidden="true">&times;</span></button></li>
                                        <?php }}else { ?>
                                          <li id="vacio" class="list-group-item list-group-item-success"><p>No se ingresaron</p><p>Inclusiones</p></li>
                                        <?php }?>
                                      </ul>
                                    </div>
                                    <div class="col-md-6 text-center">
                                      <h3>No Incluye</h3>
                                      <ul class="list-group" id="excluye">
                                        <?php if (is_array($array_excluye) || is_object($array_excluye)) {
                                          foreach ($array_excluye as $key => $value){ ?>
                                            <li class="list-group-item list-group-item-danger"><?php echo $value; ?><input type="hidden" name="excluye[]" value="<?php echo $value; ?>"><button type="button" class="close" onclick="javascript:eliminar_inclusiones(this)" aria-label="Close"><span aria-hidden="true">&times;</span></button></li>
                                          <?php }}else { ?>
                                            <li id="vacio" class="list-group-item list-group-item-danger"><p>No se ingresaron</p><p>Exclusiones</p></li>
                                          <?php }?>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="card-footer">
                              <button type="button" class="btn btn-default btn-fill btn-wd btn-back pull-left">Back</button>
                              <button type="button" class="btn btn-info btn-fill btn-wd btn-next pull-right">Next</button>
                              <button type="submit" class="btn btn-info btn-fill btn-wd btn-finish pull-right">Finalizar</button>
                              <!--<button type="button" class="btn btn-info btn-fill btn-wd btn-finish pull-right" onclick="onFinishWizardPaquetes()">Finish click</button>-->

                              <div class="clearfix"></div>
                            </div>

                          </form>
                        </div>

                      </div>
                    </div>
