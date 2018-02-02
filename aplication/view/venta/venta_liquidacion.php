<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo _css_ ?>bootstrap-multiselect.css">

<script type="text/javascript" language="javascript" src="<?php echo _js_ ?>bootstrap-multiselect.js"></script>

<div class="row">
  <div class="col-md-12">
    <div class="card card-wizard" id="wizardEditarVentas">
      <form id="wizardFormLiquidacionVentas" method="post" novalidate="" enctype="multipart/form-data">
        <input type="hidden" name="action" id="action" value="actualizarLiquidacionVentas">
        <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'] ?>">
        <div class="card-content">
          <ul class="nav">
            <li><a href="#tab1" data-toggle="tab">Ingresos</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane" id="tab1">
              <h5 class="text-center">Detalle de datos para la liquidación</h5>
              <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center-last">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Precio Venta</label>
                        <div class="input-group">
                          <div class="input-group-addon">$</div>
                          <input type="number" id="precio_venta" class="form-control" required disabled value="<?php echo $precio_venta ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Pasajeros</label>
                        <div class="input-group">
                          <div class="input-group-addon">$</div>
                          <input type="number" id="pasajeros" class="form-control" required disabled value="<?php echo $objVenta->__get('_cantidad_pasajeros') ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Incentivo total</label>
                        <div class="input-group">
                          <div class="input-group-addon">$</div>
                          <input type="number" id="incentivo_total" readonly class="form-control" required value="0">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Comision total</label>
                        <div class="input-group">
                          <div class="input-group-addon">$</div>
                          <input type="number" id="comision_total" readonly class="form-control" required value="0">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-10 col-md-offset-1 text-center-last">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Fecha limite pago</label>
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="2018-01-13" id="fecha_pago" name="fecha_pago" value="<?php echo $liquidacion['fecha'] ?>"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Incentivo</label>
                        <div class="input-group">
                          <div class="input-group-addon">$</div>
                          <input type="number" id="incentivo" name="incentivo" class="form-control formula" required value="<?php echo $liquidacion['incentivo'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Comision</label>
                        <div class="input-group">
                          <div class="input-group-addon">%</div>
                          <input type="number" id="comision" name="comision" class="form-control formula" required value="<?php echo $liquidacion['comision'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Total</label>
                        <div class="input-group">
                          <div class="input-group-addon">$</div>
                          <?php $restante = (float)$precio_venta-(float)$pago['monto']; ?>
                          <input type="number" id="total" name="total" class="form-control" readonly required value="<?php echo $liquidacion['total'] ?>">
                        </div>
                      </div>
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
