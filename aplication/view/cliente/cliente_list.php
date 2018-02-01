<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-content">
				<div class="toolbar"></div>
				<table id="bootstrap-table-cliente" class="table">
					<thead>
						<th data-field="state" data-checkbox="true"></th>
                        <th data-field="id" class="text-center">ID</th>
                        <th data-field="nombre" data-sortable="true">Nombre</th>
												<th data-field="documento" data-sortable="true">Documento</th>
												<th data-field="nacionalidad" data-sortable="true">Nacionalidad</th>
												<th data-field="telefono" data-sortable="true">Telefono</th>
												<th data-field="email" data-sortable="true">Email</th>
												<th data-field="fuente" data-sortable="true">Fuente</th>
												<th data-field="sexo" data-sortable="true">Sexo</th>
                        <th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>
					</thead>
					<?php foreach ($listClientes as $cliente) {?>
						<tr>
							<td></td>
							<td><?php echo $cliente['id'] ?></td>
							<td><?php echo $cliente['nombre'] ?></td>
							<td><?php echo $cliente['documento'] ?></td>
							<td><?php echo ($cliente['nacionalidad']) ? 'Nacional' : 'Extranjero' ?></td>
							<td><?php echo $cliente['telefono'] ?></td>
							<td><?php echo $cliente['email'] ?></td>
							<td><?php echo $cliente["fuente"]->__get("_nombre") ?></td>
							<td><?php echo ($cliente['sexo']) ? 'Femenino' : 'Masculino' ?></td>
						</tr>
					<?php
					} ?>
				</table>

			</div>

		</div>

	</div>

</div>
