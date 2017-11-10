<div class="row">
    <div class="col-md-10 col-md-offset-1">

        <div class="card card-wizard" id="wizardCotizacion">
            <form id="wizardFormCotizacion" method="post" novaelidate="" enctype="multipart/form-data">
                <input type="hidden" name="action" id="action" value="registrarCotizacion">
                <div class="card-header text-center">
                    <h4 class="card-title">Registrar Nueva Cotización de Viaje</h4>
                    <p class="category">Complete los formularios para poder registrar una nueva cotización de viaje.</p>
                </div>
        				<div class="card-content">
        				    <ul class="nav">
        						<li><a href="#tab1" data-toggle="tab">Datos del Programa</a></li>
        						<li><a href="#tab2" data-toggle="tab">Itinerario del Programa</a></li>

        					</ul>
        					<div class="tab-content">
        					    <div class="tab-pane" id="tab1">

                          <h5 class="text-center">Datos del Cliente.</h5>
                          <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                      <label class="control-label">
                                        Nombres
                                      </label>
                                      <input class="form-control"
                                             type="text"
                                             name="nombres_cliente"
                                             placeholder="Nombres "
                                             required="required"
                                             />
                                    </div>
                                </div>
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                        <label class="control-label">
                                          Fuente de Contacto
                                        </label>
                                        <select title=".:: Seleccione una Fuente ::." class="selectpicker" data-style="btn-info btn-fill btn-block" data-size="7" name="fuente_cliente" required="required">
                                            <?php foreach ($fuentes as $fuente) { ?>
                                                <option value="<?php echo $fuente['id'] ?>"><?php echo $fuente['nombre']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                        <label class="control-label">
                                          Nacionalidad
                                        </label>
                                        <select title=".:: Seleccione una Nacionalidad ::." class="selectpicker" data-style="btn-info btn-fill btn-block" data-size="7" name="nacionalidad_cliente" required="required">
                                            <?php foreach ($nacionalidades as $nacionalidad) { ?>
                                                <option value="<?php echo $nacionalidad['id'] ?>"><?php echo $nacionalidad['nombre']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                      <label class="control-label">
                                        Documento (DNI/PASAPORTE)
                                      </label>
                                      <input class="form-control"
                                             type="number"
                                             name="documento_cliente"
                                             placeholder="Documento "
                                             required="required"
                                             />
                                    </div>
                                </div>
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                      <label class="control-label">
                                        Teléfono
                                      </label>
                                      <input class="form-control"
                                             type="number"
                                             name="telefono_cliente"
                                             placeholder="Teléfono "
                                             required="required"
                                             />
                                    </div>
                                </div>
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                      <label class="control-label">
                                        Email
                                      </label>
                                      <input class="form-control"
                                             type="email"
                                             name="email_cliente"
                                             placeholder="Email "
                                             required="required"
                                             />
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
                                                  <input class="form-control"
                                                         type="text"
                                                         name="nombre_paquete"
                                                         placeholder="Viaje "
                                                         required="required"
          										                           />
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
                                                  <textarea class="form-control" name="descripcion_paquete" id=""></textarea>
                                              </div>
                                          </div>

                                          <div class="col-md-10 col-md-offset-1">
                                              <div class="form-group">
                                                  <label class="control-label">
                                                    Nro de Pasajeros
                                                  </label>
                                                  <select title=".:: Seleccione una cantidad ::." class="selectpicker" data-style="btn-info btn-fill btn-block" data-size="7" name="numero_pasajeros" required="required">
                                                      <?php for ($i=1; $i < 11 ; $i++) { ?>
                                                          <option value="<?php echo $i ?>"><?php echo $i; ?></option>
                                                      <?php } ?>
                                                  </select>
                                              </div>
                                          </div>

          								                <div class="col-md-10 col-md-offset-1">
                                              <div class="form-group">
                                                  <label class="control-label">
                              											Subir imagen
                              										</label>
                                                  <input class="form-control"
          		                                       type="file"
          		                                       name="files"
          		                                       id="files"
          		                                />
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
                                          <div class="card card-1">
                                            <input type="hidden" class="listaservicio-1" value="1"/>
                                            <input type="hidden" class="listahoteles-1" value="1"/>
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
              				                                        <input class="form-control"
              				                                               type="text"
              				                                               name="nombreDia[0][]"
              				                                               placeholder="Nombre para Identificar el Día"
                            														/>
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
                                              <div class="row">
          			                            		<div class="col-md-12">
          			                            			<a class="text-success" style="cursor: pointer;" onclick="addOneMoreHotel(1,'')">Añadir un hotel más al día <i class="fa fa-plus-circle"></i></a>
          			                            		</div>
          			                            	</div>
                                              <br>

          			                            	<div class="row">
          			                            		<div class="col-md-12">
          			                            			<p class="category">Servicios incluidos en el día.</p>
          			                            		</div>
          			                            	</div>

                                              <div class="contenedor-servicios-apend-container">

          			                            	</div>

          			                            	<div class="row">
          			                            		<div class="col-md-12">
          			                            			<a class="text-success" style="cursor: pointer;" onclick="addOneMoreService(1,'')">Añadir un servicio más al día <i class="fa fa-plus-circle"></i></a>
          			                            		</div>
          			                            	</div>
          			                            </div>
          			                          </div>
                                          <div class="contenedor-card-apend-container">

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
