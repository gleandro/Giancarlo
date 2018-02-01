<link rel="stylesheet" type="text/css" href="<?php echo _css_ ?>bootstrap-multiselect.css">

<script type="text/javascript" language="javascript" src="<?php echo _js_ ?>bootstrap-multiselect.js"></script>

<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <div class="card">
      <form id="formAddCliente" class="form-horizontal" method="post" novalidate="">
        <input type="hidden" name="action" id="action" value="registrarCliente">
        <div class="card-content">
          <h4 class="card-title">Complete los datos para registrar el nuevo cliente</h4>
          <fieldset>
            <div class="form-group">
              <label class="col-sm-3 control-label">Nombre</label>
              <div class="col-sm-9">
                <input class="form-control" type="text" name="nombre" placeholder="Nombre" required />
              </div>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group">
              <label class="col-sm-3 control-label">Documento</label>
              <div class="col-sm-9">
                <input class="form-control" type="text" name="documento" placeholder="Nro Documento" required/>
              </div>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group">
              <label class="col-sm-3 control-label">Whatsapp</label>
              <div class="col-sm-9">
                <input class="form-control" type="text" name="telefono" placeholder="whatsapp"/>
              </div>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group">
              <label class="col-sm-3 control-label">Email</label>
              <div class="col-sm-9">
                <input class="form-control" type="text" name="email" placeholder="Email"/>
              </div>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group">
              <label class="col-sm-3 control-label">Sexo</label>
              <div class="col-sm-9">
                <select class="form-control" data-style="btn-info btn-fill btn-block" name="sexo" required>
                  <option value="0">Masculino</option>
                  <option value="1">Femenino</option>
                </select>
              </div>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group">
              <label class="col-sm-3 control-label">Nacionalidad</label>
              <div class="col-sm-9">
                <select class="form-control" data-style="btn-info btn-fill btn-block" name="nacionalidad" required>
                  <option value="1">Nacional</option>
                  <option value="2">Extranjero</option>
                </select>
              </div>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group">
              <label class="col-sm-3 control-label">Fuente de contacto</label>
              <div class="col-sm-9">
                <select class="form-control" data-style="btn-info btn-fill btn-block" name="fuente" required>
                  <?php foreach ($listFuentes as $key => $fuente): ?>
                    <option value="<?php echo $fuente['id'] ?>"><?php echo $fuente['nombre'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </fieldset>
        </div>
        <div class="card-footer text-center">
          <button type="button" class="btn btn-danger btn-fill" onclick="cancelarRegistro('clientes')">Cancelar</button>
          <button type="submit" class="btn btn-info btn-fill">Registrar</button>
        </div>
      </form>
    </div>
  </div>
</div>
