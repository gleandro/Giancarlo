<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <div class="card card-wizard" id="wizardCardNuevoServicio">
            <form id="wizardFormNuevoServicio" method="GET" action="">
                <div class="card-header text-center">
                    <h4 class="card-title">Registrar Servicio</h4>
                    <p class="category">Complete el formulario para continuar</p>
                </div>
                <div class="card-content">
                    <ul class="nav">
                        <li><a href="#tab1" data-toggle="tab">Primer Paso</a></li>
                        <li><a href="#tab2" data-toggle="tab">Segundo Paso</a></li>
                        <li><a href="#tab3" data-toggle="tab">Tercer Paso</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="tab1">
                            <h5 class="text-center">Completa los datos antes de continuar.</h5>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                        <label class="control-label">
                                            Nombre del servicio
                                        </label>
                                        <input class="form-control"
                                               type="text"
                                               name="nombre"
                                               placeholder="Nombre del servicio"
                                               required="required"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                        <label class="control-label">
                                            Personas
                                        </label>
                                        <input class="form-control"
                                               type="number"
                                               name="alcance"
                                               number="true"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                        <label class="control-label">
                                            Precio Nacional
                                        </label>
                                        <input class="form-control"
                                               type="text"
                                               name="precio_nacional"
                                               number="true"
                                               placeholder="$"
                                               required="required"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                        <label class="control-label">
                                            Precio Extranjero
                                        </label>
                                        <input class="form-control"
                                               type="text"
                                               name="precio_extranjero"
                                               number="true"
                                               placeholder="$"
                                               required="required"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                        <label class="control-label">
                                            Contacto
                                        </label>
                                        <input class="form-control"
                                               type="text"
                                               name="contacto_nombre"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                        <label class="control-label">
                                            Número Contacto
                                        </label>
                                        <input class="form-control"
                                               type="text"
                                               name="contacto_numero"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                        <label class="control-label">
                                            Descripción
                                        </label>
                                        <textarea class="form-control"
                                               name="descripcion"
                                        ></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <h5 class="text-center">Completa los datos antes de continuar.</h5>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                        <label class="control-label">Tipo de servicio<star>*</star></label>
                                        <select class="form-control" name="tipo" data-style="btn btn-default btn-block" title="Tipo Empresa" data-size="7" required="required">
                                            <?php foreach ($listadoTipoServicios as $tipo) { ?>
                                                <option value="<?php echo $tipo['id'] ?>"><?php echo $tipo['nombre']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                        <label class="control-label">Empresa<star>*</star></label>
                                        <select class="form-control" name="empresa" data-style="btn btn-default btn-block" title="Empresa" data-size="7" required="required">
                                            <?php foreach ($listadoEmpresas as $empresa) { ?>
                                                <option value="<?php echo $empresa['id'] ?>"><?php echo $empresa['razon']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="tab3">
                            <h5 class="text-center">Puedes agregar más destinos</h5>

                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                        <label class="control-label">Destino<star>*</star></label>
                                        <select multiple title="Multiple Select" class="selectpicker" data-style="btn-info btn-fill btn-block" data-size="7" name="departamento[]">
                                            <?php foreach ($listadoDepartamentos as $departamento) { ?>
                                                <option value="<?php echo $departamento['id'] ?>"><?php echo $departamento['nombre']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-default btn-fill btn-wd btn-back pull-left">Atrás</button>
                    <button type="button" class="btn btn-info btn-fill btn-wd btn-next pull-right">Siguiente</button>
                    <button type="button" class="btn btn-info btn-fill btn-wd btn-finish pull-right" onclick="onFinishWizardAdd()">Finalizar</button>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>

    </div>

</div>
