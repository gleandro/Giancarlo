<div class="row">
    <div class="col-md-10 col-md-offset-1">

        <div class="card card-wizard" id="wizardEditarPaquete">
            <form id="wizardFormEditarPaquete" method="post" novalidate="" enctype="multipart/form-data">
              <input type="hidden" name="action" id="action" value="actualizarPaquete">
              <input type="hidden" value="<?php echo $objPaquete->__get('_id') ?>" name="idpaquete">
                <div class="card-header text-center">
                    <h4 class="card-title">Modificar Programa de Viaje</h4>
                    <p class="category">Complete el formulario para continuar.</p>
                </div>
        				<div class="card-content">
        				    <ul class="nav">
        						<li><a href="#tab1" data-toggle="tab">Datos del Programa</a></li>
        						<li><a href="#tab2" data-toggle="tab">Itinerario del Programa</a></li>

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
                                                <input class="form-control"
                                                       type="text"
                                                       name="nombre_paquete"
                                                       placeholder="Viaje "
                                                       value="<?php echo $objPaquete->__get('_nombre') ?>"
        										                           />
                                                </div>
                                            </div>

                                        <div class="col-md-10 col-md-offset-1">
                                            <div class="form-group">
                                                <label class="control-label">
                            											Seleccione los destinos incluidos en el programa
                            										</label>
                                                <select multiple title="Multiple Select" class="selectpicker" data-style="btn-info btn-fill btn-block" data-size="7" name="departamento[]">
                                                    <?php foreach ($listadoDepartamentos as $departamento) { ?>
                                                        <option value="<?php echo $departamento['id'] ?>"
                                                        <?php echo (in_array($departamento['id'],$objPaquete->__get('_departamento'))) ? "selected":""; ?>   >
                                                            <?php echo $departamento['nombre']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-10 col-md-offset-1">
                                            <div class="form-group">
                                                <label class="control-label">
                            											Descripción del Programa
                            										</label>
                                                <textarea class="form-control" name="descripcion_paquete" id=""><?php echo $objPaquete->__get('_descripcion') ?></textarea>
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
                                            <output id="list">
                                                <?php if ($objPaquete->__get('_imagen')!=''): ?>
                                                  <img class="thumb" src="../aplication/webroot/imgs/<?php echo($objPaquete->__get('_imagen')) ?>" alt="">
                                                <?php endif ?>
                                            </output>
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
                                          <?php $i=1;foreach ($objPaquete->__get('_itinerario') as $key => $itinerario) { ?>
                                            <div class="card card-<?php echo (int)($key+1) ?>">
            			                            <div class="card-header">
            			                                <h4 class="card-title">Día <?php echo (int)($key+1) ?><span> <a class="text-danger" href="#"><i class="fa fa-trash-o"></i></a></span></h4>
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
                				                                               name="nombreDia[]"
                				                                               placeholder="Nombre para Identificar el Día"
                                                                       value="<?php echo $itinerario['nombre'] ?>"
                              														/>
                              													</div>
                			                            		</div>
                                                </div>
                                                <div class="row">
                			                            		<div class="col-md-12">
                				                            		<div class="form-group">
            			                                        	<label class="control-label">Hotel<star>*</star></label>
            			                                        	<select class="selectpicker" name="hotel[]" data-style="btn btn-default btn-block" title=".::Seleccione un Hotel::." data-size="7">
                                                              <?php foreach ($listadoHoteles as $Hotel) { ?>
                                                                  <option value="<?php echo $depa['id'] ?>"
                                                                  <?php echo ($Hotel['id']==$itinerario['id_hotel']) ? "selected":"";  ?> >
                                                                  <?php echo $Hotel['nombre']; ?></option>
                                                              <?php } ?>
                                                            </select>
            				                                    </div>
            			                                    </div>
            			                            	</div>
            			                            	<div class="row">
            			                            		<div class="col-md-12">
            			                            			<p class="category">Servicios incluidos en el día.</p>
            			                            		</div>
            			                            	</div>
                                                <?php $servicios = Paquetes::getPaquetesItinerarioDetalle($itinerario['id_paquete_itinerario']); ?>
                                                <?php foreach ($servicios as $key => $value) { ?>
                                                  <div class="contenedor-servicios-apend contenedor-servicios-apend-<?php echo $key+1 ?>">
              			                            		<div class="row">
              				                            		<div class="col-md-12">
              				                            			<div class="form-group">
              				                                        	<label class="control-label">Lista de servicios <?php echo $key+1 ?><star>*</star></label>
              				                                        	<select class="selectpicker" name="servicio[<?php echo $key ?>][]" data-style="btn btn-default btn-block" title=".::Lista de Servicios::." data-size="7">
                                                                  <?php foreach ($listadoServicios as $servicio) { ?>
                                                                      <option value="<?php echo $depa['id'] ?>"
                                                                      <?php echo ($servicio['id']==$value['id_servicio']) ? "selected":"";  ?> >
                                                                      <?php echo $servicio['nombre']; ?></option>
                                                                  <?php } ?>
                                                                </select>
              					                                    </div>
              				                            		</div>
              				                            	</div>
              			                            	</div>
                                                <?php } ?>
            			                            	<div class="row">
            			                            		<div class="col-md-12">
            			                            			<a class="text-success" style="cursor: pointer;" onclick="addOneMoreService(1)">Añadir un servicio más al día <i class="fa fa-plus-circle"></i></a>
            			                            		</div>
            			                            	</div>
            			                            </div>
            			                          </div>
                                          <?php } ?>



                                    	</div>
                                    </div>

        					    </div>
        					</div>
        				</div>
        				<div class="card-footer">
                    <button type="button" class="btn btn-default btn-fill btn-wd btn-back pull-left">Back</button>
                    <button type="button" class="btn btn-info btn-fill btn-wd btn-next pull-right">Next</button>
                    <button type="submit" class="btn btn-info btn-fill pull-right">Finalizar</button>
                    <div class="clearfix"></div>
				        </div>
        	</form>
    	</div>

    </div>
</div>
