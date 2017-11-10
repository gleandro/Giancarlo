<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <form id="formEditCounter" class="form-horizontal" method="post" novalidate="">
              <input type="hidden" name="action" id="action" value="modificarCounter">
                <div class="card-content">
                    <h4 class="card-title">Complete los datos para registrar al nuevo counter</h4>
                    <input type="hidden" name="id" value="<?php echo $objCounter->__get('_id'); ?>">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Nombres
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control"
                                       type="text"
                                       name="nombre"
                                       required="required"
                                       value="<?php echo $objCounter->__get('_nombre'); ?>"
                                />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Apellidos
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control"
                                       type="text"
                                       name="apellido"
                                       required="required"
                                       value="<?php echo $objCounter->__get('_apellido'); ?>"
                                />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                email
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control"
                                       type="text"
                                       name="email"
                                       email="true"
                                       value="<?php echo $objCounter->__get('_email'); ?>"
                                />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                DNI
                            </label>
                            <div class="col-sm-4">
                                <input class="form-control"
                                       type="text"
                                       name="dni"
                                       value="<?php echo $objCounter->__get('_dni'); ?>"
                                />
                            </div>
                            <label class="col-sm-1 control-label">Tipo</label>
                            <div class="col-sm-4">
                                <select class="selectpicker" name="rol" data-style="btn btn-default btn-block" title=".::Seleccione un Rol::." data-size="7" required="required">
                                    <?php foreach ($roles as $rol) { ?>
                                        <option value="<?php echo $rol['id'] ?>" <?php echo ($rol['id']==$objCounter->__get('_rol')) ? "selected":"";  ?>>
                                          <?php echo $rol['nombre']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Usuario
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control"
                                       type="text"
                                       name="usuario"
                                       required="required"
                                       value="<?php echo $objCounter->__get('_login'); ?>"
                                />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Contraseña
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control"
                                       type="text"
                                       name="password"
                                       value="<?php echo desencriptar($objCounter->__get('_password')); ?>"
                                />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                          <div class="form-group">
                              <label class="col-sm-3 control-label">
                                Subir imagen
                              </label>
                              <div class="col-sm-9">
                                <input class="form-control"
                                   type="file"
                                   name="files"
                                   id="files"
                                    />
                                    <br />
                                    <output id="list">
                                        <?php if ($objCounter->__get('_foto')!=''): ?>
                                          <img class="thumb" src="../aplication/webroot/imgs/<?php echo($objCounter->__get('_foto')) ?>" alt="">
                                        <?php endif ?>
                                    </output>
                              </div>
                          </div>
                    </fieldset>
                </div>
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-danger btn-fill" onclick="cancelarRegistro('counters')">Cancelar</button>
                    <button type="submit" class="btn btn-info btn-fill">Actualizar</button>
                </div>
            </form>
        </div>
    </div>

</div>
