<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-content">
				<div class="toolbar"></div>
				<table id="bootstrap-table-counter" class="table">
						<thead>
								<th data-field="state" data-checkbox="true"></th>
								<th data-field="id" class="text-center">ID</th>
								<th data-field="rol" class="text-center">Rol</th>
								<th data-field="nombre" data-sortable="true">Nombre</th>
								<th data-field="apellido" data-sortable="true">Apellido</th>
								<th data-field="email" data-sortable="true">Email</th>
								<th data-field="fechaIngreso" class="text-center">Ingreso</th>
								<th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>
						</thead>
						<tbody>
							<?php foreach ($listcounter as $counter) { ?>
								<tr>
									<td></td>
									<td><?php echo $counter['id'] ?></td>
									<td><?php echo $counter['nombre_rol'] ?></td>
									<td><?php echo $counter['nombre'] ?></td>
									<td><?php echo $counter['apellido'] ?></td>
									<td><?php echo $counter['email'] ?></td>
									<td><?php echo fecha_long($counter['fecha']) ?></td>
								</tr>
							<?php } ?>
						</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
