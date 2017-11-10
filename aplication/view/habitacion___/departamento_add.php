<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <form id="formAddDepartamento" name="formAddDepartamento" class="form-horizontal" action="" method="post" novalidate="">
                <div class="card-content">
                    <h4 class="card-title">Complete los datos para registrar un nuevo departamento</h4>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Nombre de Departamento 
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control"
                                       type="text"
                                       name="nombre"
                                       required="required"
                                />
                            </div>
                        </div>
                    </fieldset>
                    
                </div>
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-danger btn-fill" onclick="cancelarRegistro('departamentos')">Cancelar</button>
                    <button type="submit" class="btn btn-info btn-fill">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>