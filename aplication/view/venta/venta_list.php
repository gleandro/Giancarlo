<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-content">
				<div class="toolbar"></div>
				<table id="bootstrap-table-ventas" class="table">
					<thead>
						<th data-field="state" data-checkbox="true"></th>
                        <th data-field="id" class="text-center">ID</th>
                        <th data-field="cliente" data-sortable="true">Cliente</th>
												<th data-field="documento" data-sortable="true">Documento</th>
                        <th data-field="fecha" data-sortable="true">Fecha Venta</th>
												<th data-field="fecha_reserva" data-sortable="true">Fecha Reserva</th>
                        <th data-field="nombre" data-sortable="true">Nombre</th>
                        <th data-field="precio" data-sortable="true">Precio</th>
                        <th data-field="pasajero" data-sortable="true">Pasajero</th>
												<th data-field="estado" data-sortable="true">Estado</th>
												<th data-field="id_estado" data-visible="false">id_estado</th>
												<th data-field="id_agencia" data-visible="false">id_agencia</th>
                        <th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>
					</thead>
					<?php foreach ($listVentas as $venta) {?>
						<tr>
							<td></td>
							<td><?php echo ($venta['id']) ?></td>
							<td><?php echo ($venta['cliente']) ?></td>
							<td><?php echo ($venta['documento']) ?></td>
							<td><?php echo ($venta['fecha']) ?></td>
							<td><?php echo ($venta['fecha_reserva']) ?></td>
							<td><?php echo ($venta['nombre']) ?></td>
							<td><?php echo "$".($venta['precio']) ?></td>
							<td><?php echo ($venta['pasajeros']) ?></td>
							<td><?php echo $objVentas->getEstado($venta['estado'],$estados,$venta['pagado']); ?></td>
							<td><?php echo $venta['estado'] ?></td>
							<td><?php echo $venta['id_agencia'] ?></td>
						</tr>
					<?php
					} ?>
				</table>

			</div>

		</div>

	</div>

</div>
