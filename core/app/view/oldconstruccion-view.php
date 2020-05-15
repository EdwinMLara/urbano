<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h1 class="box-title">Licencias de Construcción</h1>
			</div>
			<div class="box-body">
				<?php
					$construccion = OldDataBase::getAllcon();
					if(count($construccion)>0){
				?>
				<table class="table datatable table-bordered table-hover">
					<thead>
						<th>#</th>
						<th>Vigencia1</th>
						<th>Vigencia2</th>
						<th>Solicitante</th>
						<th>Cta. Catastral</th>
						<th>Ubicacion Obra</th>
						<th>Destino Obra</th>
						<th>Superficie</th>
						<th></th>
					</thead>
					<?php foreach($construccion as $constru):?>
					<tr>
						<td><?php echo $constru->numero_licencia;?></td>
						<td><?php echo $constru->vigencia1;?></td>
						<td><?php echo $constru->vigencia2;?></td>
						<td><?php echo $constru->nombre_solicitante;?></td>
						<td><?php echo $constru->predial_obra;?></td>
						<td><?php echo $constru->ubicacion_obra;?></td>
						<td><?php echo $constru->destino_obra;?></td>
						<td><?php echo $constru->superficie_obra;?></td>
						<td></td>
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