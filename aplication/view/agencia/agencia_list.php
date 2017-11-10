<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-content">
				<div class="toolbar"></div>
				<table id="bootstrap-table-agencia" class="table">
					<thead>
						<th data-field="state" data-checkbox="true"></th>
                        <th data-field="id" class="text-center">ID</th>
                        <th data-field="nombre" data-sortable="true">Razón Social</th>
                        <th data-field="ruc" data-sortable="true">Ruc</th>
                        <th data-field="email" data-sortable="true">Email</th>
                        <th data-field="tel" data-sortable="true">Teléfono</th>
                        <th data-field="contacto" data-sortable="true">Contacto</th>
                        <th data-field="comision" data-sortable="true">Comision</th>
                        <th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>
					</thead>
					<?php foreach ($listagencias as $agencia) {?>
						<tr>
							<td></td>
							<td><?php echo ($agencia['id']) ?></td>
							<td><?php echo ($agencia['razonsocial']) ?></td>
							<td><?php echo ($agencia['ruc']) ?></td>
							<td><?php echo ($agencia['email']) ?></td>
							<td><?php echo ($agencia['telefono']) ?></td>
							<td><?php echo ($agencia['contacto']) ?></td>
							<td><?php echo ($agencia['comision'].'%') ?></td>
						</tr>
					<?php
					} ?>
				</table>

			</div>

		</div>

	</div>

</div>
