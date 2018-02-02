<style>
/* Center the loader */
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

</style>
<div id="loader" hidden></div>
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
