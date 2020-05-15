<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<div class="btn-group pull-right">
					<a href="index.php?view=newnumeracion" class="btn btn-success"><i class="fa fa-plus-circle"></i> Nuevo Alineamiento y Número Oficial</a>
				</div>
				<h1 class="box-title">Alineamiento y Numero Oficial</h1>
			</div>
			<div class="box-body">
				<?php
					$numeracion = OldDataBase::getAllnu();
					if(count($numeracion)>0){
				?>
				<table class="table datatable table-bordered table-hover">
					<thead>
						<th>#</th>
						<th>Licencia</th>
						<th>Nombre Solicitante</th>
						<th>Domicilio</th>
						<th>Predial Obra</th>
						<th>Oficial</th>
						<th>Fecha</th>
						<th></th>
						<th></th>
					</thead>
					<?php foreach($numeracion as $numero):?>
					<tr>
						<td><?php echo $numero->id;?></td>
						<td><?php echo $numero->numero_licencia;?></td>
						<td><?php echo $numero->nombre_solicitante;?></td>
						<td><?php echo $numero->ubicacion_obra;?></td>
						<td><?php echo $numero->predial_obra;?></td>
						<td><?php echo $numero->oficial;?></td>
						<td><?php echo $numero->fecha; ?></td>
						<td>
							<a href="./?view=oldeditnumeracion&id=<?php echo $numero->numero_licencia;?>" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
						</td>
						<td>
							<a href="report/visoroldnumeracion.php?id=<?php echo $numero->id;?>" class="btn btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>
						</td>
					</tr>
					<?php endforeach;?>
				</table>
				<?php
					}else{
				?>
					<div class="jumbotron">
						<h2>No hay Alineamientos y Números Oficiales</h2>
						<p>No se han agregado Alineamientos y Números Oficiales en la base de datos, puedes agregar uno dando click en el boton <b>"Nuevo Alineamiento y Número Oficial"</b>.</p>
					</div>
				<?php
					}
				?>
			</div>
		</div>
	</div>
</div>