<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar-->
                </div>
                <table id="bootstrap-table" class="table">
                    <thead>
                        <th data-field="state" data-checkbox="true"></th>
                        <th data-field="id" class="text-center">ID</th>
                        <th data-field="nombre" data-sortable="true">Nombre</th>
                        <th data-field="departamento" data-sortable="true">Departamento</th>
                        <th data-field="estrellas" data-sortable="true">Estrellas</th>
                        <th data-field="empresa" data-sortable="true">Empresa</th>
                        <th data-field="contacto" data-sortable="true">Contacto</th>
                        <th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listadoHoteles as $Hotel) {?>
                        <tr>
                            <td></td>
                            <td><?php echo($Hotel['id']) ?></td>
                            <td><?php echo($Hotel['nombre']) ?></td>
                            <td><?php echo($Hotel['departamento']) ?></td>
                            <td><?php echo($Hotel['estrellas']) ?></td>
                            <td><?php echo($Hotel['empresa']) ?></td>
                            <td><?php echo($Hotel['contacto_nombre']) ?></td>
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
</div> <!-- end row -->
