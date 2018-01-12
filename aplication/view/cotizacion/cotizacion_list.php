<!-- LISTADO DE EMPRESAS -->
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-content">
        <div class="toolbar">
          <!--Here you can write extra buttons/actions for the toolbar-->
        </div>
        <table id="bootstrap-table-cotizaciones" class="table">
          <thead>
            <th data-field="state" data-checkbox="true"></th>
            <th data-field="id" class="text-center">ID</th>
            <th data-field="nombre" data-sortable="true">Nombre</th>
            <th data-field="descripcion" data-sortable="true">Descripción</th>
            <th data-field="cantidad" data-sortable="true">Pasajeros</th>
            <th data-field="fecha" data-sortable="true">Fecha Cotización</th>
            <th data-field="fecha_reserva" data-sortable="true">Fecha Reserva</th>
            <th data-field="precio" data-sortable="true">Precio</th>
            <th data-field="estado" data-sortable="true">Estado</th>
            <th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>
          </thead>
          <tbody>
            <?php
            foreach ($listadoCotizaciones as $cotizacion) {?>
              <tr>
                <td></td>
                <td><?php echo $cotizacion['id'] ?></td>
                <td><?php echo $cotizacion['nombre'] ?></td>
                <td><?php echo $cotizacion['descripcion'] ?></td>
                <td><?php echo $cotizacion['cantidad'] ?></td>
                <!-- <td><?php echo fecha_long($cotizacion['fecha']) ?></td> -->
                <td><?php echo $cotizacion['fecha'] ?></td>
                <td><?php echo $cotizacion['fecha_reserva'] ?></td>
                <td><?php echo "$".$cotizacion['precio'] ?></td>
                <?php
                if($cotizacion['estado'] == 1){
                  echo "<td class='text-info'>Vendido</td>";
                }else {
                  echo "<td class='text-success'>Cotizado</td>";
                }
                ?>
                <td></td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div><!--  end card  -->
  </div> <!-- end col-md-12 -->
</div><!--endrow-->
<!-- LISTADO DE EMPRESAS -->
