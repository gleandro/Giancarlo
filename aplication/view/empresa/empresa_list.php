<!-- LISTADO DE EMPRESAS -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar-->
                </div>
                <table id="bootstrap-table-empresas" class="table">
                    <thead>
                        <th data-field="state" data-checkbox="true"></th>
                        <th data-field="id" class="text-center">ID</th>
                        <th data-field="razon" data-sortable="true">Razon Social</th>
                        <th data-field="ruc" data-sortable="true">RUC</th>
                        <th data-field="email" data-sortable="true">Correo</th>
                        <th data-field="telefono" data-sortable="true">Telefono</th>
                        <th data-field="web" data-sortable="true">Tipo</th>
                        <th data-field="direccion" data-sortable="true">Domicilio Fiscal</th>
                        <th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($listadoEmpresas as $Empresa) {?>
                        <tr>
                            <td></td>
                            <td><?php echo($Empresa['id']) ?></td>
                            <td><?php echo($Empresa['ruc']) ?></td>
                            <td><?php echo($Empresa['razon']) ?></td>
                            <td><?php echo($Empresa['email']) ?></td>
                            <td><?php echo($Empresa['telefono']) ?></td>
                            <td><?php echo($Empresa['tipo']) ?></td>
                            <td><?php echo($Empresa['direccion']) ?></td>
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