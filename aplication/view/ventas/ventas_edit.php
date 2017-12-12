<div class="row">
  <div class="col-md-12">
    <div class="card card-wizard" id="wizardEditarVentas">
      <form id="wizardFormEditarVentas" method="post" novalidate="" enctype="multipart/form-data">
        <div class="card-content">
          <ul class="nav">
            <li><a href="#tab1" data-toggle="tab">Datos de la Venta</a></li>
            <li><a href="#tab2" data-toggle="tab">Itinerario del Programa</a></li>
            <li><a href="#tab3" data-toggle="tab">Inclusiones del Programa</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane" id="tab1">
              <h5 class="text-center">Datos del Cliente.</h5>
              <div class="col-md-5 col-md-offset-1">
                <div class="form-group">
                  <a href="#" onclick="agregarCliente();"><i class="ti-user"></i></a>
                  <label class="control-label">
                    Cliente
                  </label>
                  <input value="<?php echo $cliente->__get('_nombres') ?>" disabled class="form-control" type="text" placeholder="Documento" required="required"/>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label class="control-label">
                    Fuente de Contacto
                  </label>
                  <input value="<?php echo $cliente->__get('_fuente')->__get("_nombre") ?>" disabled class="form-control" type="text" placeholder="Documento" required="required"/>
                </div>
              </div>
              <div class="col-md-5 col-md-offset-1">
                <div class="form-group">
                  <label class="control-label">
                    Documento (DNI/PASAPORTE)
                  </label>
                  <input value="<?php echo $cliente->__get('_documento') ?>" disabled class="form-control" type="number" placeholder="Documento" required="required"/>
                </div>
              </div>
              <div class="col-md-5 ">
                <div class="form-group">
                  <label class="control-label">
                    Teléfono
                  </label>
                  <input value="<?php echo $cliente->__get('_telefono') ?>" disabled class="form-control" type="number" placeholder="Teléfono" required="required"/>
                </div>
              </div>
              <div class="col-md-5 col-md-offset-1">
                <div class="form-group">
                  <label class="control-label">
                    Email
                  </label>
                  <input value="<?php echo $cliente->__get('_email') ?>" disabled class="form-control" type="email" placeholder="Email" required="required"/>
                </div>
              </div>
              <div class="row">
                <div class="col-md-10 col-md-offset-1">
                  <h5 class="text-center">Datos del Programa.</h5>
                  <div class="form-group">
                    <label class="control-label">
                      Nombre del Programa
                    </label>
                    <input class="form-control" disabled type="text" placeholder="Viaje" value="<?php echo $cotizacion->__get('_nombre') ?>"/>
                  </div>
                </div>
                <div class="col-md-10 col-md-offset-1">
                  <div class="form-group">
                    <label class="control-label">
                      Destinos incluidos en el programa
                    </label>
                    <?php foreach ($destinos as $key => $destino): ?>
                      <input class="form-control" disabled type="text" value="<?php echo $destino ?>"/>
                    <?php endforeach; ?>
                  </div>
                </div>
                <div class="col-md-10 col-md-offset-1">
                  <div class="form-group">
                    <label class="control-label">
                      Descripción del Programa
                    </label>
                    <textarea class="form-control"disabled><?php echo $cotizacion->__get('_descripcion') ?></textarea>
                  </div>
                </div>
                <div class="col-md-10 col-md-offset-1">
                  <div class="form-group">
                    <label class="control-label">
                      Nro de Pasajeros
                    </label>
                    <input class="form-control" disabled value="<?php echo $cotizacion->__get('_cantidad') ?>" type="text" placeholder="numero de pasajeros" required="required"/>
                  </div>
                </div>
                <div class="col-md-10 col-md-offset-1">
                  <div class="form-group">
                    <output id="list">
                      <?php if ($cotizacion->__get('_imagen')!=''): ?>
                        <img class="thumb" src="../aplication/webroot/imgs/<?php echo($cotizacion->__get('_imagen')) ?>" alt="">
                      <?php endif ?>
                    </output>
                  </div>
                </div>
              </div>
            </div>


            <div class="tab-pane" id="tab2">
              <div class="row">
                <div class="col-md-10 col-md-offset-1">
                  <div class="contenedor-card-apend-container">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                      <?php
                      foreach ($cotizacion->__get('_itinerario') as $key => $itinerario) {
                        // $id_itinerario = $cotizacion_itinerario[$key]['id_itinerario'];
                        $itinerario_hoteles = $objVentas->getHotelesxHabitacion($itinerario['id_itinerario']);
                        print($itinerario['id_itinerario']);
                        ?>
                        <div class="panel panel-default" style="border: 1px;border-color: #0003;border-style: solid;background-color:white">
                          <div class="panel-heading" style="background-color:white" role="tab" id="heading<?php echo (int)($key+1); ?>">
                            <h4 class="panel-title">
                              <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo (int)($key+1); ?>" aria-expanded="false" aria-controls="collapseOne">
                                <h4 class="card-title">Día <?php echo (int)($key+1);?></h4>
                              </a>
                            </h4>
                          </div>
                          <div id="collapse<?php echo (int)($key+1); ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?php echo (int)($key+1) ?>">
                            <div class="panel-body">
                              <div class="card card-<?php echo (int)($key+1) ?>">
                                <div class="card-content">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label class="control-label">
                                          Nombre
                                        </label>
                                        <input class="form-control" disabled type="text" placeholder="Nombre para Identificar el Día" value="<?php echo $itinerario['nombre'] ?>"/>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label class="control-label">
                                          Itinerario
                                        </label>
                                        <textarea class="form-control" disabled rows="5" cols="5"><?php echo $itinerario['descripcion'] ?></textarea>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="contenedor-hoteles-apend-container">
                                    <div class="contenedor-hotel-apend contenedor-servicios-apend-<?php echo (int)($key+1) ?>">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <label class="control-label">Hotel<star>*</star></label>
                                            <?php foreach ($itinerario_hoteles as $key => $hotel): ?>
                                              <?php echo $hotel ?>
                                              <?php if ($key == 0): ?>
                                                <input class="form-control" disabled type="text" value="<?php echo $hotel['nombre_hotel'] ?>"/>
                                              <?php endif; ?>
                                            <?php endforeach; ?>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <br>
                                  <?php //$servicios = Cotizaciones::getCotizacionesItinerarioDetalle($itinerario['id_itinerario']); ?>
                                  <div class="contenedor-servicios-apend-container">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <label class="control-label">Servicios<star>*</star></label>

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
