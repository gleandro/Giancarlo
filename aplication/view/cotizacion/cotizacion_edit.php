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
        <div class="card-content">
          <ul class="nav">
            <li><a href="#tab1" data-toggle="tab">Datos</a></li>
            <li><a href="#tab2" data-toggle="tab">Pasajeros</a></li>
            <li><a href="#tab3" data-toggle="tab">Itinerario</a></li>
            <li><a href="#tab4" data-toggle="tab">Inclusiones</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane" id="tab1">
              <h5 class="text-center">Datos del Cliente.</h5>
              <div class="row">
                <div class="col-md-5 col-md-offset-1">
                  <div class="form-group">
                    <label class="control-label">
                      Paquete
                    </label>
                    <select id="list_paquetes">
                      <option value="0"> - seleccione un paquete - </option>
                      <?php foreach ($listaPaquetes as $key => $value): ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <a href="#" onclick="agregarCliente();"><i class="ti-user"></i></a>
                    <label class="control-label">
                      Cliente
                    </label>
                    <select id="list_clientes" name="id_cliente">
                      <option value="0"> - seleccione un cliente - </option>
                      <?php foreach ($listadoClientes as $key => $cliente):?>
                          <option
                          <?php echo ($cotizacion_cliente->__get('_id')==$cliente['id']) ? "selected":"" ?>
                          value="<?php echo $cliente['id'] ?>"><?php echo $cliente['nombre'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-5 col-md-offset-1">
                  <div class="form-group">
                    <label class="control-label">
                      Fuente de Contacto
                    </label>
                    <select disabled id="list_fuentes" name="fuente_cliente">
                      <option value="0"> - Seleccione una fuente de contacto - </option>
                      <?php foreach ($fuentes as $fuente):?>
                          <option <?php echo ($cotizacion_cliente->__get('_fuente')->__get('_id')==$fuente['id']) ? "selected":"" ?>
                            value="<?php echo $fuente['id'] ?>">
                            <?php echo $fuente['nombre']; ?></option>
                      <?php  endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label class="control-label">
                      Documento (DNI/PASAPORTE)
                    </label>
                    <input value="<?php echo $cotizacion_cliente->__get('_documento') ?>" disabled class="form-control" type="number" placeholder="Documento" required="required" id="ajax_Documento"/>
                  </div>
                </div>
                <div class="col-md-5 col-md-offset-1">
                  <div class="form-group">
                    <label class="control-label">
                      Teléfono
                    </label>
                    <input value="<?php echo $cotizacion_cliente->__get('_telefono') ?>" disabled class="form-control" type="number" placeholder="Teléfono" required="required" id="ajax_Telefono"/>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label class="control-label">
                      Email
                    </label>
                    <input value="<?php echo $cotizacion_cliente->__get('_email') ?>" disabled class="form-control" type="email" placeholder="Email" required="required" id="ajax_Email"/>
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
                    <input class="form-control" value="<?php echo $objCotizacion->__get('_cantidad') ?>" type="number" name="numero_pasajeros" placeholder="numero de pasajeros" required="required"/>
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


                </div>
              </div>
              <div class="tab-pane" id="tab3">
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
                          $id_itinerario = $cotizacion_itinerario[$key]['id_itinerario'];
                          $arreglo_hoteles = $objHoteles->getHoteles_Habitacion($id_itinerario);
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
                                          <input class="form-control" type="text" name="nombreDia[<?php echo $key ?>]" placeholder="Nombre para Identificar el Día" value="<?php echo $itinerario['nombre'] ?>"/>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label class="control-label">
                                            Itinerario
                                          </label>
                                          <textarea class="form-control" name="descripcion[<?php echo $key ?>]" rows="5" cols="5"><?php echo $itinerario['descripcion'] ?></textarea>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="contenedor-hoteles-apend-container">
                                      <input type="hidden" class="listahotel-<?php echo (int)($key+1) ?>" value="<?php echo count($itinerario_hoteles) ?>"/>
                                        <div class="contenedor-hotel-apend contenedor-servicios-apend-<?php echo (int)($key+1) ?>">
                                          <div class="row">
                                            <div class="col-md-12">
                                              <div class="form-group">
                                                <label class="control-label">Hotel<star>*</star></label>
                                                  <select id="list-hotel-<?php echo (int)($key+1) ?>" name="hotel[<?php echo $key ?>]" onchange="addHabitaciones(<?php echo (int)($key+1) ?>,1,this.value)">
                                                    <option value="0"> - seleccione un hotel - </option>
                                                  <?php foreach ($listadoHotelesxDepartamentos as $Hotel) { ?>
                                                    <option value="<?php echo $Hotel['id'] ?>"
                                                    <?php echo ($Hotel['id']== $arreglo_hoteles[0]['id_hotel']) ? "selected":""; ?>>
                                                      <?php echo $Hotel['departamento'].' ( '.$Hotel['estrellas'].' estrellas - $'.round($Hotel['precio'], 2).' ) : '.$Hotel['nombre'] ?></option>
                                                  <?php } ?>
                                                </select>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <?php

                                        $habitaciones = Hoteles::getHabitacionesHoteles($itinerario_hoteles[0]['id_hotel']);
                                        $hoteles_habitaciones = array();
                                        foreach ($arreglo_hoteles as $key_3 => $hotel_array) {
                                          array_push($hoteles_habitaciones,$hotel_array['id_habitacion']);
                                        }
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
                                            <?php foreach ($habitaciones as $keyh => $habitacion) {?>
                                              <tr>
                                                <td class="text-center">
                                                  <input type="checkbox" name="check_habitaciones[<?php echo (int)($key) ?>][<?php echo $habitacion['id_habitacion'] ?>]" value="<?php echo $habitacion['id_habitacion'] ?>"
                                                  <?php echo (in_array($habitacion['id_habitacion'], $hoteles_habitaciones)) ? "checked":"";  ?>
                                                  />
                                                  <input type="hidden" name="precios_habitaciones[<?php echo (int)($key)?>][<?php echo $habitacion['id_habitacion'] ?>]" value="<?php echo $habitacion['precio_hotel_tarifa'] ?>"/>
                                                </td>
                                                <td class="text-left"><?php echo $habitacion['nombre_habitacion'] ?></td>
                                                <td class="text-center"><?php echo $habitacion['cantidad_habitacion'] ?></td>
                                                <td class="text-center">
                                                  <?php $dato = array_search($habitacion['id_habitacion'], $hoteles_habitaciones);?>
                                                  <input type="input" name="cantidad_habitaciones[<?php echo (int)($key) ?>][<?php echo $habitacion['id_habitacion'] ?>]" value="<?php echo (is_numeric($dato)) ? $arreglo_hoteles[$dato]['cantidad'] : '' ?>"/>
                                                </td>
                                                <td class="text-right"><?php echo $habitacion['precio_hotel_tarifa'] ?></td>
                                              </tr>
                                            <?php } ?>
                                          </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    <?php $servicios = Cotizaciones::getCotizacionesItinerarioDetalle($itinerario['id_itinerario']); ?>
                                    <div class="contenedor-servicios-apend-container">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <label class="control-label">Servicios<star>*</star></label>
                                          <div class="form-group" style="overflow-y: auto;height: 345px;">
                                            <table id="table_s_<?php echo $key?>" name="servicio[<?php echo $key ?>]" class="display table_servicio" width="100%" cellspacing="0" data-page-length='5'>
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
                                                          <td><?php echo "$".number_format($servicio['precio_e'], 2, '.', ''); ?></td>
                                                          <td class="id" hidden=""><?php echo $servicio['id'] ?></td>
                                                        </tr>
                                                        <?php $estado = true; break; }else{$estado = false;}}
                                                        if (!$estado) { ?>
                                                          <tr>
                                                            <td><?php echo $servicio['nombre'] ?></td>
                                                            <td><?php echo $servicio['departamento']?></td>
                                                            <td><?php echo $servicio['nombre_tipo_servicio']?></td>
                                                            <td><?php echo $servicio['alcance']?></td>
                                                            <td><?php echo "$".number_format($servicio['precio_e'], 2, '.', ''); ?></td>
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
                      <div class="tab-pane" id="tab4">
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
