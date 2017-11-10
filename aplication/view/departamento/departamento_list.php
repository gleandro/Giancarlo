<div class="row">
    <!-- LISTADO DE DEPARTAMENTOS -->
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <div class="card-content">
                <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar-->
                </div>
                <table id="bootstrap-table-departamentos" class="table">
                    <thead>
                        <th data-field="state" data-checkbox="true"></th>
                        <th data-field="id" class="text-center">ID</th>
                        <th data-field="nombre" data-sortable="true">Nombre</th>
                        <th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($listadoDepartamentos as $Departamento) {?>
                        <tr>
                            <td></td>
                            <td><?php echo($Departamento['id']) ?></td>
                            <td><?php echo($Departamento['nombre']) ?></td>
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
    <!-- LISTADO DE DEPARTAMENTOS -->
</div>