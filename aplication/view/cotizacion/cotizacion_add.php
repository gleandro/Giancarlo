<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.3/css/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo _css_ ?>bootstrap-multiselect.css">

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.2.3/js/dataTables.select.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo _js_ ?>bootstrap-multiselect.js"></script>

<div class="row">
  <div class="col-md-12">
    <div class="card card-wizard" id="wizardCotizacion">
      <form id="wizardFormCotizacion" method="post" novaelidate="" enctype="multipart/form-data">
        <input type="hidden" name="action" id="action" value="registrarCotizacion">
        <div class="card-content">
          <ul class="nav">
            <li><a href="#tab1" data-toggle="tab">Datos</a></li>
            <li><a href="#tab2" data-toggle="tab">Itinerario</a></li>
            <li><a href="#tab3" data-toggle="tab">Inclusiones</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane" id="tab1">
              <h5 class="text-center">Datos del Cliente.</h5>
              <div class="row">
                <div class="col-md-5 col-md-offset-1">
                  <div class="form-group">
                    <label class="control-label">
                      Paquete
                    </label>
                    <select id="list_paquetes">
                      <option value="0"> - seleccione un paquete - </option>
                      <?php foreach ($listaPaquetes as $key => $value): ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <a href="#" onclick="agregarCliente();"><i class="ti-user"></i></a>
                    <label class="control-label">
                      Cliente
                    </label>
                    <select id="list_clientes" name="id_cliente">
                      <option value="0"> - seleccione un cliente - </option>
                      <?php foreach ($listadoClientes as $key => $cliente): ?>
                        <option value="<?php echo $cliente['id'] ?>"><?php echo $cliente['nombre'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-5 col-md-offset-1">
                  <div class="form-group">
                    <label class="control-label">
                      Fuente de Contacto
                    </label>
                    <select disabled id="list_fuentes" name="fuente_cliente">
                      <option value="0"> - Seleccione una fuente de contacto - </option>
                      <?php foreach ($fuentes as $fuente): ?>
                        <option value="<?php echo $fuente['id'] ?>"><?php echo $fuente['nombre']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label class="control-label">
                      Documento (DNI/PASAPORTE)
                    </label>
                    <input disabled class="form-control" type="number" placeholder="Documento" required="required" id="ajax_Documento"/>
                  </div>
                </div>
                <div class="col-md-5 col-md-offset-1">
                  <div class="form-group">
                    <label class="control-label">
                      Teléfono
                    </label>
                    <input disabled class="form-control" type="number" placeholder="Teléfono" required="required" id="ajax_Telefono"/>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label class="control-label">
                      Email
                    </label>
                    <input disabled class="form-control" type="email" placeholder="Email" required="required" id="ajax_Email"/>
                  </div>
                </div>
              </div>
              <h5 class="text-center">Datos del Programa.</h5>
              <div class="row">
                <div class="col-md-10 col-md-offset-1">
                  <div class="form-group">
                    <label class="control-label">
                      Nombre del Programa
                    </label>
                    <input id="nombre" class="form-control" type="text" name="nombre_paquete" placeholder="Viaje" required="required"/>
                  </div>
                </div>

                <div class="col-md-10 col-md-offset-1">
                  <div class="form-group">
                    <label class="control-label">
                      Seleccione los destinos incluidos en el programa
                    </label>
                    <select multiple title="Multiple Select" class="selectpicker" data-style="btn-info btn-fill btn-block" data-size="7" name="departamento[]" required="required">
                      <?php foreach ($listadoDepartamentos as $departamento) { ?>
                        <option value="<?php echo $departamento['id'] ?>"><?php echo $departamento['nombre']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-10 col-md-offset-1">
                  <div class="form-group">
                    <label class="control-label">
                      Descripción del Programa
                    </label>
                    <textarea id="descripcion" class="form-control" name="descripcion_paquete" ></textarea>
                  </div>
                </div>

                <div class="col-md-10 col-md-offset-1">
                  <div class="form-group">
                    <label class="control-label">
                      Nro de Pasajeros
                    </label>
                    <input class="form-control" type="text" name="numero_pasajeros" placeholder="numero de pasajeros" required="required"/>
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
                  <a class="btn btn-info btn-fill" style="cursor: pointer;" onclick="addOneMoreDay()">&nbsp;&nbsp;&nbsp;&nbsp;Agregar dia&nbsp;&nbsp;&nbsp;&nbsp;</a>
                </div>
              </div>
              <div class="row">
                <div class="col-md-10 col-md-offset-1">
                  <input type="hidden" class="card-dia" value="1"/>
                  <input type="hidden" id="editarpaquete" value="0">
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
                                      <label class="control-label">Nombre</label>
                                      <input class="form-control" type="text" name="nombreDia[0]" required="required" placeholder="Nombre para Identificar el Día"/>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="control-label">Itinerario</label>
                                      <textarea class="form-control" name="descripcion[0]" rows="5" cols="5"></textarea>
                                    </div>
                                  </div>
                                </div>
                                <div class="contenedor-hoteles-apend-container">
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
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab3">
              <h5 class="text-center">Ingrese las Inclusiones y exclusiones del Programa.</h5>
              <div class="row">
                <div class="col-sm-12 col-md-5 col-md-offset-1">
                  <div class="form-group">
                    <input class="form-control" type="text" id="nombre_inclusion" placeholder="descripcion de inclusion " value=""/>
                  </div>
                </div>
                <div class="col-sm-9 col-md-4">
                  <div class="form-group">
                    <select class="selectpicker" Title=".::.Seleccione Tipo de inclusion.::." id="inclusiones">
                      <option value="1">Incluye</option>
                      <option value="2">No Incluye</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3 col-md-1">
                  <div class="form-group text-right">
                    <button type="button" class="btn btn-info" id="add_inclusion">Ingresar inclusion</button>
                  </div>
                </div>
                <div class="col-sm-12 col-md-10 col-md-offset-1">
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
