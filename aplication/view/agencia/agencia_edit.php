<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <form id="formEditAgencia" class="form-horizontal" method="post" novalidate="">
              <input type="hidden" name="action" id="action" value="modificarAgencia">
                <div class="card-content">
                    <h4 class="card-title">Complete los datos para registrar la nueva agencia</h4>
                    <fieldset>
                      <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $objAgen->__get('_id'); ?>">
                      </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Razon Social
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="razon" required="required" value="<?php echo $objAgen->__get('_razon'); ?>" />
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                RUC
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="number" name="ruc" required="required" value="<?php echo $objAgen->__get('_ruc'); ?>" />
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Correo Electrónico
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="email" email="true" value="<?php echo $objAgen->__get('_email'); ?>" required="required" />
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Teléfono
                            </label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="telefono" value="<?php echo $objAgen->__get('_telefono'); ?>" required="required" />
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Dirección
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="direccion" required="required" value="<?php echo $objAgen->__get('_direccion'); ?>" />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Contacto
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="contacto" value="<?php echo $objAgen->__get('_contacto'); ?>" required="required" />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Sede
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" value="<?php echo $objAgen->__get('_sede')->__get('_nombre'); ?>" disabled />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Comision
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="comision" value="<?php echo $objAgen->__get('_comision'); ?>" /> </div>
                        </div>
                    </fieldset>

                </div>
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-danger btn-fill" onclick="cancelarRegistro('agencias')">Cancelar</button>
                    <button type="submit" class="btn btn-info btn-fill">Actualizar</button>
                </div>
            </form>
        </div>
    </div>

</div>
