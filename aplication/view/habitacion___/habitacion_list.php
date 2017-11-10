<div class="row">
    <!-- LISTADO DE habitaciones -->
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <div class="card-content">
                <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar-->
                </div>
                <table id="bootstrap-table-habitaciones" class="table">
                    <thead>
                        <th data-field="state" data-checkbox="true"></th>
                        <th data-field="id" class="text-center">ID</th>
                        <th data-field="nombre" data-sortable="true">Nombre</th>
                        <th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($listadoHabitaciones as $Habitacion) {?>
                        <tr>
                            <td></td>
                            <td><?php echo($Habitacion['id']) ?></td>
                            <td><?php echo($Habitacion['nombre']) ?></td>
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
    <!-- LISTADO DE habitaciones -->
</div>