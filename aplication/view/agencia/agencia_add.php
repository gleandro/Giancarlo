<link rel="stylesheet" type="text/css" href="<?php echo _css_ ?>bootstrap-multiselect.css">

<script type="text/javascript" language="javascript" src="<?php echo _js_ ?>bootstrap-multiselect.js"></script>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <form id="formAddAgencia" class="form-horizontal" method="post" novalidate="">
              <input type="hidden" name="action" id="action" value="registrarAgencia">
                <div class="card-content">
                    <h4 class="card-title">Complete los datos para registrar la nueva agencia</h4>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Razon Social
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="razonsocial" required="required" />
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                RUC
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="number" name="ruc" required="required" />
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Correo Electrónico
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="email" email="true" required="required" />
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Teléfono
                            </label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="telefono" required="required" />
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Dirección
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="direccion" required="required" />
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Contacto
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="contacto" required="required" />
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Sede
                            </label>

                            <?php if ($_SESSION['sede']->__get('_id') == 0): ?>
                              <div class="col-sm-9">
                                <select id="list_sedes" name="id_sede">
                                  <option value="0"> - seleccione una sede - </option>
                                  <?php foreach ($listsedes as $key => $sede): ?>
                                    <option value="<?php echo $sede['id'] ?>"><?php echo $sede['nombre'] ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                            <?php else: ?>
                              <div class="col-sm-9">
                                  <input class="form-control" type="text" value="<?php echo $_SESSION['sede']->__get('_nombre') ?>" disabled />
                              </div>
                            <?php endif; ?>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Comision
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="number" name="comision" required="required" />
                            </div>
                        </div>
                    </fieldset>

                </div>
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-danger btn-fill" onclick="cancelarRegistro('agencias')">Cancelar</button>
                    <button type="submit" class="btn btn-info btn-fill">Registrar</button>
                </div>
            </form>
        </div>
    </div>

</div>
