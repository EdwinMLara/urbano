<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<div class="btn-group  pull-right">
					<a href="index.php?view=newconstruccion" class="btn btn-success"><i class="fa fa-plus-circle"></i> Nueva Licencia</a>
				</div>
				<h1 class="box-title">Licencias de Construcción</h1>
			</div>
			<div class="box-body">
				<?php
					$emitidos=ConstruccionData::getAll();
					if(count($emitidos)>0){
				?>
				<table class="table datatable table-bordered table-hover">
					<thead>
						<th>#</th>
						<th>Nombre del Solicitante</th>
						<th>Cuenta Catastral</th>
						<th>Ubicación de la Obra</th>
						<th>Vigencia 1</th>
						<th>Vigencia 2</th>
						<th></th>
						<th></th>
					</thead>
					<?php foreach($emitidos as $emiti):?>
					<tr>
						<td><?php echo $emiti->numero_licencia;?></td>
						<td><?php echo $emiti->nombre_solicitante;?></td>
						<td><?php echo $emiti->predial_obra;?></td>
						<td><?php echo $emiti->ubicacion_obra;?></td>
						<td><?php echo date ('d-m-Y', strtotime($emiti->vigencia1)); ?></td>
						<td><?php echo date ('d-m-Y', strtotime($emiti->vigencia2)); ?></td>
						<td>
							<a href="./?view=visorpdfconstruccion&id=<?php echo $emiti->numero_licencia;?>" class="btn btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>
						</td>
						<td>
							<a href="./?view=editconstruccion&id=<?php echo $emiti->numero_licencia;?>" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
						</td>
					</tr>
					<?php endforeach;?>
				</table>
				<?php
					}else{
				?>
				<div class="jumbotron">
					<h2>No hay Licencias de Construcción</h2>
					<p>No se han agregado licencias en la base de datos, puedes agregar uno dando click en el boton <b>"Agregar Licencia"</b>.</p>
				</div>
				<?php
					}
				?>
			</div>
		</div>
	</div>
</div>