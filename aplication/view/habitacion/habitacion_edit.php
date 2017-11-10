<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <form id="formEditHabitacion" class="form-horizontal" method="post" novalidate="">
              <input type="hidden" name="action" id="action" value="modificarHabitacion">
                <div class="card-content">
                    <h4 class="card-title">Complete los datos para actualizar la habitación</h4>
                    <input type="hidden" name="id" value="<?php echo $objHabitacion->__get('_id'); ?>">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Nombres
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control"
                                       type="text"
                                       name="nombre_habitacion"
                                       required="required"
                                       value="<?php echo $objHabitacion->__get('_nombre'); ?>"
                                />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Cantidad
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control"
                                       type="number"
                                       name="cantidad_habitacion"
                                       required="required"
                                       value="<?php echo $objHabitacion->__get('_cantidad'); ?>"
                                />
                            </div>
                        </div>
                    </fieldset>

                </div>
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-danger btn-fill" onclick="cancelarRegistro('habitaciones')">Cancelar</button>
                    <button type="submit" class="btn btn-info btn-fill">Actualizar</button>
                </div>
            </form>
        </div>
    </div>

</div>
