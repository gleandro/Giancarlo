<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.3/css/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo _css_ ?>bootstrap-multiselect.css">

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.2.3/js/dataTables.select.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo _js_ ?>bootstrap-multiselect.js"></script>

<div class="row">
  <div class="col-md-12">
    <div class="card card-wizard" id="wizardPaquete">
      <!--<form id="wizardForm" method="GET" action="">-->
      <form id="wizardForm" method="post" novalidate="" enctype="multipart/form-data">
        <input type="hidden" name="action" id="action" value="registrarPaquete">
        <div class="card-header text-center">
          <h4 class="card-title">Registrar Nuevo Programa de Viaje</h4>
          <p class="category">Complete los formularios para poder registrar un nuevo programa de viaje.</p>
        </div>
        <div class="card-content">
          <ul class="nav">
            <li><a href="#tab1" data-toggle="tab">Datos del Programa</a></li>
            <li><a href="#tab2" data-toggle="tab">Itinerario del Programa</a></li>
            <li><a href="#tab3" data-toggle="tab">Inclusiones del Programa</a></li>
            <li><a href="#tab4" data-toggle="tab">Configuración de Hoteles</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane" id="tab1">
              <h5 class="text-center">Datos del Programa.</h5>
              <div class="row">
                <div class="col-md-10 col-md-offset-1">
                  <div class="form-group">
                    <label class="control-label">
                      Nombre del Programa
                    </label>
                    <input class="form-control" type="text" name="nombre_paquete" placeholder="Viaje " required="required"/>
                  </div>
                </div>
                <div class="col-md-10 col-md-offset-1">
                  <div class="form-group">
                    <label class="control-label">
                      Seleccione los destinos incluidos en el programa
                    </label>
                    <select multiple title="Multiple Select" class="selectpicker" data-style="btn-info btn-fill btn-block" data-size="7" name="departamento[]" required="required">
                      <?php if (is_array($listadoDepartamentos) || is_object($listadoDepartamentos)) {
                        foreach ($listadoDepartamentos as $departamento) { ?>
                          <option value="<?php echo $departamento['id'] ?>"><?php echo $departamento['nombre']; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-10 col-md-offset-1">
                    <div class="form-group">
                      <label class="control-label">
                        Descripción del Programa
                      </label>
                      <textarea class="form-control" name="descripcion_paquete" id=""></textarea>
                    </div>
                  </div>
                  <div class="col-md-10 col-md-offset-1">
                    <div class="form-group">
                      <label class="control-label">
                        Utilidad
                      </label>
                      <input class="form-control" required="required" type="number" min="0" max="100" name="utilidad_paquete" id="" value="0"></input>
                    </div>
                  </div>
                  <div class="col-md-10 col-md-offset-1">
                    <div class="form-group">
                      <label class="control-label">
                        Subir imagen
                      </label>
                      <input class="form-control" type="file" name="files" id="files"/>
                      <br />
                      <output id="list"></output>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab2">
                <div class="row">
                  <div class="col-md-10 col-md-offset-1 text-right" style="padding-top:2%">
                    <a class="btn btn-info btn-fill" style="cursor: pointer;" onclick="addOneMoreDay()">&nbsp;&nbsp;&nbsp;&nbsp;Agregar día&nbsp;&nbsp;&nbsp;&nbsp;</a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                    <input type="hidden" class="card-dia" value="1"/>
                    <div class="contenedor-card-apend-container">
                      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default" style="border: 1px;border-color: #0003;border-style: solid;background-color:white">
                          <div class="panel-heading" style="background-color:white" role="tab" id="heading1">
                            <h4 class="panel-title">
                              <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="false" aria-controls="collapseOne">
                                <h4 class="card-title">Día 1</h4>
                              </a>
                            </h4>
                          </div>
                          <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                            <div class="panel-body">
                              <div class="card card-1">
                                <input type="hidden" class="listaservicio-1" value="1"/>
                                <div class="card-content">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label class="control-label">
                                          Nombre
                                        </label>
                                        <input class="form-control" type="text" name="nombreDia[0][]" required="required" placeholder="Nombre para Identificar el Día"/>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label class="control-label">
                                          Itinerario
                                        </label>
                                        <textarea class="form-control" name="descripcion[0][]" rows="5" cols="5"></textarea>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="contenedor-servicios-apend-container">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="contenedor-card-apend-container">
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab3">
                <div class="row">
                  <div class="col-sm-12 col-md-6" id="lista_servicios_dia">
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="row">
                      <h5 class="text-center">Ingrese las Inclusiones y exclusiones del Programa.</h5>
                      <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                          <input class="form-control" type="text" id="nombre_inclusion" placeholder="descripcion de inclusion " value=""/>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-9 col-md-9">
                        <div class="form-group">
                          <select class="selectpicker" Title=".::.Seleccione Tipo de inclusion.::." id="inclusiones">
                            <option value="1">Incluye</option>
                            <option value="2">No Incluye</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3 col-md-3">
                        <div class="form-group text-right">
                          <button type="button" class="btn btn-info" id="add_inclusion">Ingresar inclusion</button>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 text-center">
                        <h3>Incluye</h3>
                        <ul class="list-group" id="incluye">
                          <li id="vacio" class="list-group-item list-group-item-success"><p>No se ingresaron</p><p>Inclusiones</p></li>
                        </ul>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 text-center">
                        <h3>No Incluye</h3>
                        <ul class="list-group" id="excluye">
                          <li id="vacio" class="list-group-item list-group-item-danger"><p>No se ingresaron</p><p>Exclusiones</p></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                <div class="tab-pane" id="tab4">
                  <h5 class="text-center">Ingrese las diferentes opciones de hoteles para el paquete.</h5>
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-7">
                      <h5>Seleccion las opciones de hoteles(Destino-estrellas-hotel-precio)</h5>
                      <div id="opciones_hoteles" class="form-group"></div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5">
                      <h5>Lista de opciones de hoteles</h5>
                      <div id="lista_opciones_hoteles" class="form-group"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-default btn-fill btn-wd btn-back pull-left">Back</button>
              <button type="button" class="btn btn-info btn-fill btn-wd btn-next pull-right btn-next-add">Next</button>
              <button type="submit" class="btn btn-info btn-fill btn-wd btn-finish pull-right">Registrar</button>
              <!--<button type="button" class="btn btn-info btn-fill btn-wd btn-finish pull-right" onclick="onFinishWizardPaquetes()">Finish</button>-->
              <div class="clearfix"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
