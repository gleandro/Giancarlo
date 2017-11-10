<!-- LISTADO DE EMPRESAS -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar-->
                </div>
                <table id="bootstrap-table-servicios" class="table">
                    <thead>
                        <th data-field="state" data-checkbox="true"></th>
                        <th data-field="id" class="text-center">ID</th>
                        <th data-field="razon" data-sortable="true">Nombre</th>
                        <th data-field="ruc" data-sortable="true">Tipo</th>
                        <th data-field="email" data-sortable="true">Precio</th>
                        <th data-field="telefono" data-sortable="true">Cantidad</th>
                        <th data-field="web" data-sortable="true">Empresa</th>
                        <th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($listadoServicios as $Servicio) {?>
                        <tr>
                            <td></td>
                            <td><?php echo($Servicio['id']) ?></td>
                            <td><?php echo($Servicio['nombre']) ?></td>
                            <td><?php echo($Servicio['tipo_servicio']) ?></td>
                            <td><?php echo($Servicio['precio']) ?></td>
                            <td><?php echo($Servicio['alcance']) ?></td>
                            <td><?php echo($Servicio['empresa']) ?></td>
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