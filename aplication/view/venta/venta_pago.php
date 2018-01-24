<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo _css_ ?>bootstrap-multiselect.css">

<script type="text/javascript" language="javascript" src="<?php echo _js_ ?>bootstrap-multiselect.js"></script>

<div class="row">
  <div class="col-md-12">
    <div class="card card-wizard" id="wizardEditarVentas">
      <form id="wizardFormPagosVentas" method="post" novalidate="" enctype="multipart/form-data">
        <input type="hidden" name="action" id="action" value="registrarGastoCotizacion">
        <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'] ?>">
        <input type="hidden" name="key_pago" id="key_pago" value="0">
        <div class="card-content">
          <ul class="nav">
            <li><a href="#tab1" data-toggle="tab">Ingresos</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane" id="tab1">
              <h5 class="text-center">Lista de Ingresos realizados en esta venta</h5>
              <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center-last">
                  <table id="lista_pagos" class="display" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Orden</th>
                        <th>Fecha de Ingreso</th>
                        <th>Forma de Pago</th>
                        <th>Observacion</th>
                        <th>Monto</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if (is_array($list_pagos) || is_object($list_pagos)) {
                        foreach ($list_pagos as $key => $pago): ?>
                        <tr>
                          <td><?php echo $pago['orden']; ?></td>
                          <td><?php echo $pago['fecha']; ?></td>
                          <td><?php echo ($pago['pago'] == '') ? '' : (($pago['pago'] == 0) ? 'Efectivo' : 'Tarjeta') ?></td>
                          <td><?php echo $pago['observacion']; ?></td>
                          <td class="text-success"><?php echo "$".$pago['monto']; ?></td>
                        </tr>
                      <?php endforeach; } ?>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-3 col-md-offset-1">
                  <div class="form-group">
                    <label class="control-label">Precio total</label>
                    <div class="input-group">
                      <div class="input-group-addon">$</div>
                      <input type="number" class="form-control" required disabled value="<?php echo $precio_venta ?>">
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">Pagado</label>
                    <div class="input-group">
                      <div class="input-group-addon">$</div>
                      <input type="number" class="form-control" required disabled value="<?php echo (float)$pago['monto'] ?>">
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">Restante</label>
                    <div class="input-group">
                      <div class="input-group-addon">$</div>
                      <?php $restante = (float)$precio_venta-(float)$pago['monto']; ?>
                      <input type="number" id="precio_restante" class="form-control" required disabled value="<?php echo $restante ?>">
                    </div>
                  </div>
                </div>
                <?php if ($restante != 0): ?>
                  <div class="col-md-5 col-md-offset-1">
                    <label class="control-label">Forma de Pago</label>
                    <select id="list_forma_pago" name="id_tipo_pago">
                      <option value="0">Pago Efectivo</option>
                      <option value="1">Pago Tarjeta 5%</option>
                      <option value="2">Pago tarjeta 7%</option>
                    </select>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label class="control-label">Monto</label>
                      <div class="input-group">
                        <div class="input-group-addon">$</div>
                        <input type="number" id="monto_pago" name="precio" class="form-control" required placeholder="0">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10 col-md-offset-1">
                    <div class="form-group">
                      <label class="control-label">Observaciones</label>
                      <textarea style="max-width: 100%;" name="observacion" class="form-control" rows="5"></textarea>
                    </div>
                  </div>
                  <input type="text" hidden id="text_swal" value="Se realizó el pago con exito.">
                <?php endif; ?>
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
