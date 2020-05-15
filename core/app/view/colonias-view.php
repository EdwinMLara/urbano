<div class="row">
	<div class="col-md-12">
	<div class="box">
		<div class="box-header">
			<a href="index.php?view=newcolonia" class="btn btn-success pull-right"><i class='fa fa-area-chart'></i> Nueva Colonia</a>
			<h1 class="box-title">Lista de Colonias</h1>
		</div>
		<div class="box-body">
		<?php
			$colonia = ColoniaData::getAll();
			if(count($colonia)>0){
				// si hay usuarios
				?>
				<table class="table datatable table-bordered table-hover">
				<thead>
					<th>#</th>
					<th>Nombre</th>
					<th></th>
				</thead>
				<?php
				foreach($colonia as $col){
				?>
				<tr>
					<td><?php echo $col->id; ?></td>
					<td><?php echo $col->nombre; ?></td>
					<td style="width:150px;">
						<a href="index.php?view=editcolonia&id=<?php echo $col->id;?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
						<a href="index.php?view=delcolonia&id=<?php echo $col->id;?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Eliminar</a>
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