<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-content">
				<div class="toolbar"></div>
				<table id="bootstrap-table-ventas" class="table">
					<thead>
						<th data-field="state" data-checkbox="true"></th>
						<th data-field="id" data-sortable="true" class="text-center">ID Venta</th>
						<th data-field="id_itinerario" data-sortable="true" class="text-center">ID ITINERARIO</th>
						<th data-field="tipo" data-sortable="true">Tipo</th>
						<th data-field="id_servicio" data-visible="false"></th>
						<th data-field="nombre" data-sortable="true">Nombre</th>
						<th data-field="cliente" data-sortable="true">Cliente</th>
						<th data-field="documento" data-sortable="true">Documento</th>
						<th data-field="fecha_reserva" data-sortable="true">Fecha Reserva</th>
					</thead>
					<?php foreach ($listVentas as $venta) {?>
						<tr>
							<td></td>
							<td><?php echo ($venta['id']) ?></td>
							<td><?php echo ($venta['id_itinerario']) ?></td>
							<td><?php echo ($venta['tipo']) ?></td>
							<td><?php echo ($venta['id_servicio']) ?></td>
							<td><?php echo ($venta['nombre']) ?></td>
							<td><?php echo ($venta['cliente']) ?></td>
							<td><?php echo ($venta['documento']) ?></td>
							<td><?php echo ($venta['fecha_reserva']) ?></td>
						</tr>
						<?php
					} ?>
				</table>

			</div>

		</div>

	</div>

</div>
