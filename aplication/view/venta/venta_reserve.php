<div class="row">
  <div class="col-md-12">
    <div class="card card-wizard" id="wizardEditarVentas">
      <form id="wizardFormReservarVentas" method="post" novalidate="" enctype="multipart/form-data">
        <input type="hidden" name="action" id="action" value="updateEstadoCotizacion">
        <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'] ?>">
        <input type="hidden" name="estado" id="estado" value="0">
        <div class="card-content">
          <ul class="nav">
            <li><a href="#tab1" data-toggle="tab">Reserva Hoteles</a></li>
            <li><a href="#tab2" data-toggle="tab">Reserva Servicios</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane" id="tab1">
              <h5 class="text-center">Lista de Hoteles incluidos en la venta</h5>
              <div class="row">
                <div class="col-md-5 col-md-offset-1">
                  <label class="control-label">
                    Hotel
                  </label>
                </div>
                <div class="col-md-4">
                  <label class="control-label">
                    Codigo Reserva
                  </label>
                </div>
                <div class="col-md-1">
                  <label class="control-label">

                  </label>
                </div>
              </div>
              <?php if (is_array($list_hoteles) || is_object($list_hoteles)): ?>
                <?php foreach ($list_hoteles as $key => $hotel): ?>
                  <div class="row">
                    <div class="col-md-5 col-md-offset-1">
                      <div class="form-group">
                        <input value="<?php echo $hotel['nombre']?>" disabled class="form-control" type="text" placeholder="Hotel" required="required"/>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <input  value="<?php echo $hotel['codigo_reserva']?>" <?php echo ($hotel['codigo_reserva']) ? 'disabled' : '' ?>  class="form-control codigo_reserva" type="text" placeholder="Codigo_Reserva"/>
                      </div>
                    </div>
                    <div class="col-md-1">
                      <div class="form-group has-success">
                        <?php if (!$hotel['codigo_reserva']): ?>
                          <button class="btn btn-success" onclick="reservar(this,<?php echo $hotel['id_reserva'] ?>)" type="button" name="button">RESERVAR</button>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                    <h5 class="bg-warning text-center text-danger">NO EXISTEN HOTELES ASOCIADOS A ESTA VENTA</h5>
                  </div>
                </div>
              <?php endif; ?>
            </div>
            <div class="tab-pane" id="tab2">
              <h5 class="text-center">Lista de Servicios incluidos en la venta</h5>
              <div class="row">
                <div class="col-md-5 col-md-offset-1">
                  <label class="control-label">
                    Servicio
                  </label>
                </div>
                <div class="col-md-4">
                  <label class="control-label">
                    Codigo Reserva
                  </label>
                </div>
                <div class="col-md-1">
                  <label class="control-label">

                  </label>
                </div>
              </div>
              <?php if (is_array($list_hoteles) || is_object($list_hoteles)): ?>
                <?php foreach ($list_servicios as $key => $servicio): ?>
                  <div class="row">
                    <div class="col-md-5 col-md-offset-1">
                      <div class="form-group">
                        <input value="<?php echo $servicio['nombre']?>" disabled class="form-control" type="text" placeholder="Hotel" required="required"/>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <input value="<?php echo $servicio['codigo_reserva']?>" <?php echo ($servicio['codigo_reserva']) ? 'disabled' : '' ?>  class="form-control codigo_reserva" type="text" placeholder="Codigo_Reserva"/>
                      </div>
                    </div>
                    <div class="col-md-1">
                      <div class="form-group">
                        <?php if (!$servicio['codigo_reserva']): ?>
                          <button class="btn btn-success" onclick="reservar(this,<?php echo $servicio['id_reserva'] ?>)" type="button" name="button">RESERVAR</button>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                    <h5 class="bg-warning text-center text-danger">NO EXISTEN SERVICIOS ASOCIADOS A ESTA VENTA</h5>
                  </div>
                </div>
              <?php endif; ?>
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
