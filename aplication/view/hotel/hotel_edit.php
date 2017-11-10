<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <form id="formEditHotel" class="form-horizontal" action="" method="post" novalidate="" enctype="multipart/form-data">
            <input type="hidden" name="action" id="action" value="modificarHotel">
            <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'] ?>">
                <div class="card-content">
                    <h4 class="card-title">Modifique los campos</h4>
                    
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Nombre Hotel
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control"
                                       type="text"
                                       name="nombre"
                                       required="required"
                                       value="<?php echo $objHotel->__get('_nombre') ?>" 
                                />
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Departamento
                            </label>
                            <div class="col-sm-9">
                                <select class="selectpicker" name="departamento" data-style="btn btn-default btn-block" title="Departamento" data-size="7" required="required">
                                    <?php foreach ($listadoDepartamentos as $depa) { ?>
                                        <option 
                                        value="<?php echo $depa['id'] ?>"
                                        <?php echo ($depa['id']==$objHotel->__get('_departamento')) ? "selected":"";  ?> >
                                        <?php echo $depa['departamento']; ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Empresa
                            </label>
                            <div class="col-sm-9">
                                <select class="selectpicker" name="empresa" data-style="btn btn-default btn-block" title="Empresa" data-size="7" required="required">
                                    <?php foreach ($listadoEmpresas as $empresa) { ?>
                                        <option 
                                        value="<?php echo $empresa['id'] ?>"
                                        <?php echo ($empresa['id']==$objHotel->__get('_empresa')) ? "selected":"";  ?> >
                                        <?php echo $empresa['razon']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Estrellas
                            </label>
                            <div class="col-sm-2">
                                <select class="selectpicker" name="estrellas" data-style="btn btn-default btn-block" title="Estellas" data-size="7" required="required">
                                    <option value="1" <?php echo ("1"==$objHotel->__get('_estrellas')) ? "selected":"";  ?> >1</option>
                                    <option value="2" <?php echo ("2"==$objHotel->__get('_estrellas')) ? "selected":"";  ?> >2</option>
                                    <option value="3" <?php echo ("3"==$objHotel->__get('_estrellas')) ? "selected":"";  ?> >3</option>
                                    <option value="4" <?php echo ("4"==$objHotel->__get('_estrellas')) ? "selected":"";  ?> >4</option>
                                    <option value="5" <?php echo ("5"==$objHotel->__get('_estrellas')) ? "selected":"";  ?> >5</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Nombre Contacto
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control"
                                       type="text"
                                       name="nombreContacto"
                                       value="<?php echo $objHotel->__get('_nombre_contacto') ?>" 
                                />
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Número Contacto
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control"
                                       type="text"
                                       name="numeroContacto"
                                       value="<?php echo $objHotel->__get('_numero_contacto') ?>" 
                                />
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Imagen
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control"
                                       type="file"
                                       name="files"
                                       id="files"
                                />
                                <br />
                                <output id="list">
                                    <?php if ($objHotel->__get('_imagen')): ?>
                                        <img class="thumb" src="../aplication/webroot/imgs/<?php echo($objHotel->__get('_imagen')) ?>" alt="">
                                    <?php endif ?>
                                </output>
                            </div>
                        </div>
                    </fieldset>


                </div>
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-danger btn-fill" onclick="cancelarRegistro('hoteles')">Cancelar</button>
                    <button type="submit" class="btn btn-info btn-fill">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
