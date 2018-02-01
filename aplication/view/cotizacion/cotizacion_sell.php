<link rel="stylesheet" type="text/css" href="<?php echo _css_ ?>bootstrap-multiselect.css">

<script type="text/javascript" language="javascript" src="<?php echo _js_ ?>bootstrap-multiselect.js"></script>

<div id="loader" hidden></div>

<div class="row">
  <div class="col-md-12">
    <div class="card card-wizard" id="wizardSellCotizacion">
      <form id="wizardFormSellCotizacion" method="post" novalidate="" enctype="multipart/form-data">
        <input type="hidden" name="action" id="action" value="sellCotizacion">
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
        <div class="card-content">
          <ul class="nav">
            <li><a href="#tab1" data-toggle="tab">Modificar Pasajeros</a></li>
            <li><a href="#tab2" data-toggle="tab">Forma de Pago</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane" id="tab1">
              <h5 class="text-center">Actualizar Pasajeros.</h5>
              <div class="container">
                <div class="row">
                  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php foreach ($list_pasajeros as $key => $pasajero): ?>
                      <div class="panel panel-default" style="">
                        <div class="panel-heading" style="" role="tab" id="heading<?php echo $key ?>">
                          <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $key ?>" aria-expanded="false" aria-controls="collapseOne" class="collapsed"></a>
                            <h4 class="card-title">
                              <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $key ?>" aria-expanded="false" aria-controls="collapseOne" class="collapsed"><?php echo $pasajero['nombres_pasajero'] ?></a>
                            </h4>
                          </h4>
                        </div>
                        <div id="collapse<?php echo $key ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1" aria-expanded="false" style="">
                          <div class="panel-body">
                            <div class="card card-1">
                              <div class="card-content">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Nacionalidad</label>
                                      <input class="form-control" type="text" disabled value="<?php echo ($pasajero['id_nacionalidad'] == 0) ? 'Nacional' : 'Extranjero' ?>" aria-required="true">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Nombre</label>
                                      <input class="form-control" type="text" required="" name="pasajeros[<?php echo $pasajero['id_pasajero'] ?>][nombre]" placeholder="Nombre" value="<?php echo $pasajero['nombres_pasajero'] ?>" aria-required="true">
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label">Documento</label>
                                      <input class="form-control" type="text" required="" name="pasajeros[<?php echo $pasajero['id_pasajero'] ?>][documento]" placeholder="Nro Documento" value="" aria-required="true">
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label">Whatsapp</label>
                                      <input class="form-control" type="text" required="" name="pasajeros[<?php echo $pasajero['id_pasajero'] ?>][whatsapp]" placeholder="Nro Whatsapp" value="" aria-required="true">
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label">Sexo</label>
                                      <select class="list_sexo" name="pasajeros[<?php echo $pasajero['id_pasajero'] ?>][sexo]">
                                        <option value="0">Masculino</option>
                                        <option value="1">Femenino</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab2">
              <h5 class="text-center">Datos de Pago.</h5>
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Forma de Pago</label>
                      <select id="list_forma_pago" name="id_tipo_pago">
                        <option value="0">Pago Efectivo</option>
                        <option value="1">Pago Tarjeta 5%</option>
                        <option value="2">Pago tarjeta 7%</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Precio</label>
                      <div class="input-group">
                        <div class="input-group-addon">$</div>
                        <input type="number" id="precio_venta" name="precio_venta" class="form-control" required value="<?php echo $pasajero['precio'] ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Inicial</label>
                      <div class="input-group">
                        <div class="input-group-addon">$</div>
                        <input type="number" id="precio" name="precio" class="form-control" required placeholder="0">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2 col-md-offset-10 text-right">
                    <label>
                      <input type="checkbox" id="check_pagar">Pagar todo
                    </label>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Observaciones</label>
                      <textarea style="max-width: 100%;" name="observacion" class="form-control" rows="5"></textarea>
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
