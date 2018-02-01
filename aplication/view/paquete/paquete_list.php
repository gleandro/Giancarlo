<!-- LISTADO DE EMPRESAS -->

<div id="loader" hidden></div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar-->
                </div>
                <table id="bootstrap-table-paquetes" class="table">
                    <thead>
                        <th data-field="state" data-checkbox="true"></th>
                        <th data-field="id" class="text-center">ID</th>
                        <th data-field="nombre" data-sortable="true">Nombre</th>
                        <th data-field="descripcion" data-sortable="true">Descripción</th>
                        <th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listadoPaquetes as $Paquete) {?>
                        <tr>
                            <td></td>
                            <td><?php echo($Paquete['id']) ?></td>
                            <td><?php echo($Paquete['nombre']) ?></td>
                            <td><?php echo($Paquete['descripcion']) ?></td>
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
