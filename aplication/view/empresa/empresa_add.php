<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <form id="formAddEmpresa" class="form-horizontal" action="" method="post" novalidate="">
                <div class="card-content">
                    <h4 class="card-title">Complete los datos para registrar la nueva empresa</h4>
                    <!--<h6>(Por el momento la sección contacto se encuentra deshabilitada)</h6>-->
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Razon Social
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="razon" required="required"/>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                RUC
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="ruc" required="required"/>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Correo Electrónico
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="email" email="true"/>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Pagina Web
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="web" url="true" placeholder="http:\\www.google.com" />
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Teléfono
                            </label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="telefono"/>
                            </div>
                            <label class="col-sm-1 control-label">
                                Tipo
                            </label>
                            <div class="col-sm-4">
                                <select class="selectpicker" name="tipo" data-style="btn btn-default btn-block" title="Tipo Empresa" data-size="7" required="required">
                                    <?php foreach ($listaTipoEmpresa as $tipo) { ?>
                                        <option value="<?php echo $tipo['id'] ?>"><?php echo $tipo['nombre']; ?></option>
                                    <?php } ?>
                                </select>
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
                                <input class="form-control" type="text" name="contactoNombre"/>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Número de Contacto
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="contactoNumero"/>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Número de Cuenta
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="cuentaNumero"/>
                            </div>
                        </div>
                    </fieldset>

                </div>
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-danger btn-fill" onclick="cancelarRegistro('empresas')">Cancelar</button>
                    <button type="submit" class="btn btn-info btn-fill">Registrar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal -->
</div>
