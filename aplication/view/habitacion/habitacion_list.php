<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-content">
				<div class="toolbar"></div>
				<table id="bootstrap-table-habitaciones" class="table">
						<thead>
								<th data-field="state" data-checkbox="true"></th>
								<th data-field="id" class="text-center">ID</th>
								<th data-field="nombre" data-sortable="true">Nombre</th>
								<th data-field="apellido" data-sortable="true">Cantidad</th>
								<th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>
						</thead>
						<tbody>
							<?php foreach ($listadoHabitaciones as $habitacion) { ?>
								<tr>
									<td></td>
									<td><?php echo $habitacion['id'] ?></td>
									<td><?php echo $habitacion['nombre'] ?></td>
									<td><?php echo $habitacion['cantidad'] ?></td>
								</tr>
							<?php } ?>
						</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
