<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <form id="formEditCliente" class="form-horizontal" method="post" novalidate="">
              <input type="hidden" name="action" id="action" value="modificarCliente">
                <div class="card-content">
                    <h4 class="card-title">Complete los datos para registrar la nueva agencia</h4>
                    <fieldset>
                      <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $objCli->__get('_id'); ?>">
                      </div>
                    </fieldset>
                    <fieldset>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Nombre</label>
                        <div class="col-sm-9">
                          <input class="form-control" type="text" name="nombre" placeholder="Nombre" value="<?php echo $objCli->__get("_nombres");?>" required/>
                        </div>
                      </div>
                    </fieldset>
                    <fieldset>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Documento</label>
                        <div class="col-sm-9">
                          <input class="form-control" type="text" name="documento" placeholder="Nro Documento" value="<?php echo $objCli->__get("_documento");?>" required/>
                        </div>
                      </div>
                    </fieldset>
                    <fieldset>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Whatsapp</label>
                        <div class="col-sm-9">
                          <input class="form-control" type="text" name="telefono" placeholder="whatsapp" value="<?php echo $objCli->__get("_telefono");?>"/>
                        </div>
                      </div>
                    </fieldset>
                    <fieldset>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                          <input class="form-control" type="text" name="email" placeholder="Email" value="<?php echo $objCli->__get("_email");?>"/>
                        </div>
                      </div>
                    </fieldset>
                    <fieldset>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Sexo</label>
                        <div class="col-sm-9">
                          <select class="form-control" data-style="btn-info btn-fill btn-block" name="sexo" required>
                            <option value="0" <?php echo ($objCli->__get("_sexo") == 0) ? 'selected' : '' ?>>Masculino</option>
                            <option value="1" <?php echo ($objCli->__get("_sexo") == 1) ? 'selected' : '' ?>>Femenino</option>
                          </select>
                        </div>
                      </div>
                    </fieldset>
                    <fieldset>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Nacionalidad</label>
                        <div class="col-sm-9">
                          <select class="form-control" data-style="btn-info btn-fill btn-block" name="nacionalidad" required>
                            <option value="1" <?php echo ($objCli->__get("_id_nacionalidad") == 1) ? 'selected' : '' ?>>Nacional</option>
                            <option value="2" <?php echo ($objCli->__get("_id_nacionalidad") == 2) ? 'selected' : '' ?>>Extranjero</option>
                          </select>
                        </div>
                      </div>
                    </fieldset>
                    <fieldset>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Fuente de contacto</label>
                        <div class="col-sm-9">
                          <select class="form-control" data-style="btn-info btn-fill btn-block" name="fuente" required>
                            <?php foreach ($listFuentes as $key => $fuente): ?>
                              <option value="<?php echo $fuente['id'] ?>" <?php echo ($fuente['id'] == $objCli->__get("_fuente")->__get("_id")) ? 'selected' : '' ?>><?php echo $fuente['nombre'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </fieldset>

                </div>
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-danger btn-fill" onclick="cancelarRegistro('clientes')">Cancelar</button>
                    <button type="submit" class="btn btn-info btn-fill">Actualizar</button>
                </div>
            </form>
        </div>
    </div>

</div>
