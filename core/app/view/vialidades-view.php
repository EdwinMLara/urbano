<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<a href="index.php?view=newvialidad" class="btn btn-success pull-right"><i class='fa fa-road'></i> Nueva vialidad</a>
				<h1 class="box-title">Lista de vialidades</h1>
			</div>
			<div class="box-body">
				<?php
					$vialidades = VialidadData::getAll();
					if(count($vialidades)>0){
						// si hay usuarios
				?>
					<table class="table datatable table-bordered table-hover">
						<thead>
							<th>#</th>
							<th>Nombre</th>
							<th></th>
						</thead>
						<?php
							foreach($vialidades as $vial){
						?>
						<tr>
							<td><?php echo $vial->id; ?></td>
							<td><?php echo $vial->nombre; ?></td>
							<td style="width:200px;">
								<a href="index.php?view=editvialidad&id=<?php echo $vial->id;?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
								<a href="index.php?view=delvialidad&id=<?php echo $vial->id;?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Eliminar</a>
							</td>
						</tr>
						<?php
							}
						echo "</table>";
					}else{
					// no hay usuarios
					}
				?>
			</div>
		</div>
	</div>
</div>