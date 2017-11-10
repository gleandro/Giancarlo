<div class="row">
  <div class="col-lg-4 col-md-4">
    <div class="card card-user">
      <div class="image">
        <img src="../aplication/webroot/imgs/card-fondo-hotel.jpg" alt="..."/>
      </div>
      <div class="card-content">
        <div class="author">
          <img class="avatar border-white" src="../aplication/webroot/imgs/<?php echo($objHotel->__get('_imagen')) ?>" alt="..."/>
          <h4 class="card-title"><?php echo $objHotel->__get('_nombre') ?><br />
            <a href="hoteles.php?action=edit&id=<?php echo $objHotel->__get('_id') ?>"><small>Editar</small></a>
          </h4>
        </div>
        <p class="description text-center">
          <?php echo $objHotel->__get('_departamento_nombre') ?>
        </p>
        <p class="description text-center">
          <?php echo $objHotel->__get('_empresa_nombre') ?>
        </p>
      </div>
      <hr>
      <div class="text-center">
        <div class="row">
          <div class="col-md-3 col-md-offset-1">
            <h5>12<br /><small>Planes</small></h5>
          </div>
          <div class="col-md-3">
            <h5>1<br /><small>Vendidos</small></h5>
          </div>
          <div class="col-md-4">
            <a href="" class="text-success" data-toggle="modal" data-target="#modalNuevaTarifa"><h5>Nueva Tarifa<br /><i class="fa fa-plus-square text-success"></i></h5></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <h4>Tarifas Extrangeras</h4>
    <div class="row" id="extranjero">

    </div>
  </div>
  <div class="col-md-4">
    <h4>Tarifas Nacionales</h4>
    <div class="row" id="nacional">

    </div>
  </div>
  <?php foreach ($listadoTarifas as $tarifa) {
    $html = '<div class="col-lg-12 col-md-12" id="card'.$tarifa['id'].'">';
    $html .= '<div class="card">';
    $html .= '<div class="card-header">';
    $html .= '<h5 class="card-title">'.$tarifa['habitacion'].'</h5>';
    $html .= '</div>';
    $html .= '<div class="card-content">';
    $html .= '<div class="row">';
    $html .= '<div class="col-lg-8 col-md-8">';
    $html_extranjero = $html.'<h4 class="text-left">Precio: <span class="text-success">'.$tarifa['precio_extranjero'].'</span><i class="fa fa-usd text-success"></i> </h4>';
    $html_nacional = $html.'<h4 class="text-left">Precio: <span class="text-success">'.$tarifa['precio_nacional'].'</span><i class="fa fa-usd text-success"></i> </h4>';
    $html = '</div>';
    $html .= '<div class="col-lg-4 col-md-4">';
    $html .= '<h3 class="text-right">';

    $html_extranjero .= $html.'<a onclick="editarTarifa('.$tarifa['id'].','.$tarifa['id_habitacion'].','.$tarifa['precio_extranjero'].',2)" class="text-card"><i class="fa fa-pencil-square-o text-warning"></i></a> ';
    $html_nacional .= $html.'<a onclick="editarTarifa('.$tarifa['id'].','.$tarifa['id_habitacion'].','.$tarifa['precio_nacional'].',1)" class="text-card"><i class="fa fa-pencil-square-o text-warning"></i></a> ';

    $html = '<a onclick="eliminarTarifa('.$tarifa['id'].')" class="text-card"><i class="fa fa-trash-o text-danger"></i></a></h3>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html_extranjero .= $html;
    $html_nacional .= $html;

    echo "<script type='text/javascript'>
          $('#extranjero').append('".$html_extranjero."');
          $('#nacional').append('".$html_nacional."');

    </script>";
  }
  ?>
</div>


<div class="row">
  <div class="col-md-12">



    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="modalNuevaTarifa">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form id="formAddHotelTarifa" class="form-horizontal" action="" method="GET" novalidate="">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="gridSystemModalLabel">Nueva Tarifa</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" name="hotel" id="hotel" value="<?php echo $_GET['id'] ?>">
              <div class="card-content">
                <fieldset>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      Tipo de Habitación
                    </label>
                    <div class="col-sm-9">
                      <select class="selectpicker" name="habitacion" data-style="btn btn-default btn-block" title="Tipo" data-size="7" required="required">
                        <?php foreach ($listadoHabitaciones as $habitacion) {?>
                          <option value="<?php echo $habitacion['id'] ?>" ><?php echo $habitacion['habitacion'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </fieldset>

                <fieldset>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      Precio Nacional
                    </label>
                    <div class="col-sm-9">
                      <input class="form-control" type="number" name="precio_nacional" required="required"/>
                    </div>
                  </div>
                </fieldset>

                <fieldset>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      Precio Extranjero
                    </label>
                    <div class="col-sm-9">
                      <input class="form-control" type="number" name="precio_extranjero" required="required"/>
                    </div>
                  </div>
                </fieldset>

              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="modalEditarTarifa">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form id="formEditHotelTarifa" class="form-horizontal" action="" method="GET" novalidate="">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="gridSystemModalLabel">Editar Tarifa</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" name="edithotel" id="hotel" value="<?php echo $_GET['id'] ?>">
              <input type="hidden" name="edittarifa" id="idtarifa" value="">
              <div class="card-content">

                <fieldset>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      Tipo de Tarifa
                    </label>
                    <div class="col-sm-9">
                      <select class="selectpicker" id="edittipo" name="edittipo" data-style="btn btn-default btn-block" title="Tipo" data-size="7" required="required">
                        <option value="1" >Tarifa Nacional</option>
                        <option value="2" >Tarifa Extrangera</option>
                      </select>
                    </div>
                  </div>
                </fieldset>

                <fieldset>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      Tipo de Habitación
                    </label>
                    <div class="col-sm-9">
                      <select class="selectpicker" id="edithabitacion" name="edithabitacion" data-style="btn btn-default btn-block" title="Tipo" data-size="7" required="required">
                        <?php foreach ($listadoHabitaciones as $habitacion) {?>
                          <option value="<?php echo $habitacion['id'] ?>" ><?php echo $habitacion['habitacion'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </fieldset>

                <fieldset>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      Precio
                    </label>
                    <div class="col-sm-9">
                      <input class="form-control" type="number" name="editprecio" id="editprecio" required="required"/>
                    </div>
                  </div>
                </fieldset>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

  </div>
</div>
