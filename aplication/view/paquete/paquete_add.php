<div class="row">
  <div class="col-md-10 col-md-offset-1">
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
                <h5 class="text-center">Complete el Itinerario para el Paquete</h5>
                <div class="row">
                  <div class="col-md-10 col-md-offset-1 text-right">
                    <a class="text-success" style="cursor: pointer;" onclick="addOneMoreDay()">Agregar un día más al itenerario <span><i class="fa fa-plus-square"></i></span></a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                    <input type="hidden" class="card-dia" value="1"/>
                    <div class="contenedor-card-apend-container">
                      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                          <div class="panel-heading" role="tab" id="heading1">
                            <h4 class="panel-title">
                              <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="false" aria-controls="collapseOne">
                                dia 1
                              </a>
                            </h4>
                          </div>
                          <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                            <div class="panel-body">
                              <div class="card card-1">
                                <input type="hidden" class="listaservicio-1" value="1"/>
                                <div class="card-header">
                                  <h4 class="card-title">Día 1<span> <a class="text-danger" onclick="eliminarPaquete(1,'');"><i class="fa fa-trash-o"></i></a></span></h4>
                                  <p class="category">Detalle del Día</p>
                                </div>
                                <div class="card-content">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label class="control-label">
                                          Nombre
                                        </label>
                                        <input class="form-control" type="text" name="nombreDia[0][]" placeholder="Nombre para Identificar el Día"/>
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
                                  <div class="contenedor-hoteles-apend-container">
                                  </div>
                                  <br>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <p class="category">Servicios incluidos en el día.</p>
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
                <h5 class="text-center">Ingrese las Inclusiones y exclusiones del Programa.</h5>
                <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                    <div class="form-group">
                      <label class="control-label">
                        Descripción de inclusion
                      </label>
                      <input class="form-control" type="text" id="nombre_inclusion" placeholder="descripcion de inclusion " value=""/>
                    </div>
                  </div>
                  <div class="col-md-10 col-md-offset-1">
                    <div class="form-group">
                      <select class="selectpicker" Title=".::.Seleccione Tipo de inclusion.::." id="inclusiones">
                        <option value="1">Incluye</option>
                        <option value="2">No Incluye</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-10 col-md-offset-1">
                    <div class="form-group text-right">
                      <button type="button" class="btn btn-info" id="add_inclusion">Ingresar inclusion</button>
                    </div>
                  </div>
                  <div class="col-md-10 col-md-offset-1">
                    <div class="row">
                      <div class="col-md-6 text-center">
                        <h3>Incluye</h3>
                        <ul class="list-group" id="incluye">
                          <li id="vacio" class="list-group-item list-group-item-success"><p>No se ingresaron</p><p>Inclusiones</p></li>
                        </ul>
                      </div>
                      <div class="col-md-6 text-center">
                        <h3>No Incluye</h3>
                        <ul class="list-group" id="excluye">
                          <li id="vacio" class="list-group-item list-group-item-danger"><p>No se ingresaron</p><p>Exclusiones</p></li>
                        </ul>
                      </div>
                    </div>
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
