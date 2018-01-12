<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <div class="card">
      <form id="formAddHotel" class="form-horizontal" action="" method="post" novalidate="" enctype="multipart/form-data">
        <input type="hidden" name="action" id="action" value="registrarHotel">
        <div class="card-content">
          <h4 class="card-title">Complete los datos para registrar el hotel</h4>

          <fieldset>
            <div class="form-group">
              <label class="col-sm-3 control-label">
                Nombre Hotel
              </label>
              <div class="col-sm-9">
                <input class="form-control" type="text" name="nombre" required="required"/>
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
                    <option value="<?php echo $depa['id'] ?>"><?php echo $depa['departamento']; ?></option>
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
                    <option value="<?php echo $empresa['id'] ?>"><?php echo $empresa['razon']; ?></option>
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
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
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
                <input class="form-control" type="text" name="nombreContacto"/>
              </div>
            </div>
          </fieldset>

          <fieldset>
            <div class="form-group">
              <label class="col-sm-3 control-label">
                Número Contacto
              </label>
              <div class="col-sm-9">
                <input class="form-control" type="text" name="numeroContacto"/>
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
                <output id="list"></output>
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
