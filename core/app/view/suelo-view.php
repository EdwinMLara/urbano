<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<div class="btn-group  pull-right">
					<a href="index.php?view=newsuelo" class="btn btn-success"><i class="fa fa-plus-circle"></i> Nueva Licencia</a>
				</div>
				<h1 class="box-title">Licencias de Uso de Suelo</h1>
			</div>
			<div class="box-body">
				<?php
					$suelo=SueloData::getAll();
					if(count($suelo)>0){
				?>
						<table class="table datatable table-bordered table-hover">
							<thead>
								<th>#</th>
								<th>Nombre del Solicitante</th>
								<th>Dirección</th>
								<th>Numero</th>
								<th>Colonia</th>
								<th>Dirección del Predio</th>
								<th>Numero del Predio</th>
								<th>Colonia del Predio</th>
								<th>Fecha</th>
								<th></th>
							</thead>
							<?php foreach($suelo as $suel):?>
							<tr>
								<td><?php echo $suel->id;?></td>
								<td><?php echo $suel->nombre_solicitante;?></td>
								<td><?php
									$ids= $suel->domicilio_solicitante;
									$datosvialidad=VialidadData::getById($ids);
									echo $datosvialidad->nombre; ?>
								</td>
								<td><?php echo $suel->numero;?></td>
								<td><?php 
									$ids=$suel->colonia;
									$datoscolonia=ColoniaData::getById($ids);
									echo $datoscolonia->nombre;?>
								</td>
								<td><?php
									$idp= $suel->domicilio_predio;
									$datosvialidad=VialidadData::getById($idp);
									echo $datosvialidad->nombre;?>
								</td>
								<td><?php echo $suel->numero_predio;?></td>
								<td><?php
									$idp=$suel->colonia_predio;
									$datoscolonia=ColoniaData::getById($idp);
									echo $datoscolonia->nombre;?>
								</td>
								<td><?php echo $suel->fecha_alta; ?></td>
								<td>
									<a href="./?view=visorpdfusosuelo&id=<?php echo $suel->id;?>" class="btn btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>
									<!--<a href="" class="btn btn-default"><i class="fa fa-trash" aria-hidden="true"></i></a>-->
								</td>
							</tr>
							<?php endforeach;?>
						</table>
					<?php
						}else{
					?>
					<div class="jumbotron">
						<h2>No hay licencias</h2>
						<p>No se han agregado licencias en la base de datos, puedes agregar uno dando click en el boton <b>"Agregar Licencia"</b>.</p>
					</div>
					<?php	}	?>
			</div>
		</div>
	</div>
</div>