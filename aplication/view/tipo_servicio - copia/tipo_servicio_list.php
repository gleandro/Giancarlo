<div class="row">
    <!-- LISTADO DE TIPOS DE SERVICIOS -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-content">
                <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar-->
                </div>
                <table id="bootstrap-table-tipo-servicios" class="table">
                    <thead>
                        <th data-field="state" data-checkbox="true"></th>
                        <th data-field="id" class="text-center">ID</th>
                        <th data-field="nombre" data-sortable="true">Nombre</th>
                        <th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($listadoTipoServicios as $Tipo) {?>
                        <tr>
                            <td></td>
                            <td><?php echo($Tipo['id']) ?></td>
                            <td><?php echo($Tipo['nombre']) ?></td>
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
    <!-- LISTADO DE TIPOS DE SERVICIOS -->
    <!-- INDICADORES DE TIPOS DE SERVICIOS -->
    <div class="col-md-6">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Servicios más Utilizados</h4>
                <p class="category">En Cotizaciones</p>
            </div>
            <div class="card-content">
                <div id="chartActivity" class="ct-chart"></div>
            </div>
            <div class="card-footer">
                <div class="chart-legend">
                    <i class="fa fa-circle text-info"></i> Transporte
                    <i class="fa fa-circle text-warning"></i> Guía
                    <i class="fa fa-circle text-danger"></i> Gastronomia
                </div>
                <hr>
                <div class="stats">
                    <i class="ti-check"></i> Data information certified
                </div>
            </div>
        </div>
    </div>
    <!-- INDICADORES DE TIPOS DE SERVICIOS -->
</div>