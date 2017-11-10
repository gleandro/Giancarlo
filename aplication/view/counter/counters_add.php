    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <form id="formAddCounter" class="form-horizontal" method="post" novalidate="">
              <input type="hidden" name="action" id="action" value="registrarCounter">
                <div class="card-content">
                    <h4 class="card-title">Complete los datos para registrar a un nuevo conter</h4>
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
                                />
                            </div>
                            <label class="col-sm-1 control-label">Tipo</label>
                            <div class="col-sm-4">
                                <select class="selectpicker" name="rol" data-style="btn btn-default btn-block" title=".::Seleccione un Rol::." data-size="7" required="required">
                                    <?php foreach ($roles as $rol) { ?>
                                        <option value="<?php echo $rol['id'] ?>"><?php echo $rol['nombre']; ?></option>
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
                                       type="password"
                                       name="password"
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
                                <output id="list"></output>
                              </div>
                          </div>
                    </fieldset>

                </div>
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-danger btn-fill" onclick="cancelarRegistro('counters')">Cancelar</button>
                    <button type="submit" class="btn btn-info btn-fill">Registrar</button>
                </div>
            </form>
        </div>
    </div>

</div>
