<div class="row">
	<div class="col-md-12">
	<h1>Nueva Uso de Suelo</h1>
	<br>
	<form class="form-horizontal" method="post" enctype="multipart/form-data" id="addsuelo" action="index.php?view=addsuelo" role="form">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Datos del Uso de Suelo
					</div>
					<div class="panel-body">
						<div class="form-group label-floating">
							<?php
								$maxidd = SueloData::maxid();
								if($maxidd==""){
									$astmaxid=0;
									$folionext = ($astmaxid+1);
								}else{
									foreach ($maxidd as $astmaxid){
										$folionext = ($astmaxid+1);
									}
								}
							?>
							<div class="col-md-2">
								<label class="control-label">No. Licencia</label>
							</div>
							<div class="col-md-2">
								<input type="text" name="no_licencia" size="10" class="form-control" value="<?php echo $folionext; ?>" readonly>
							</div>
						<!--</div>
						<div class="form-group label-floating">-->
							<div class="col-md-2">
								<label class="control-label">Fecha</label>
							</div>
							<div class="col-md-2">
								<input type="text" name="fecha_alta" value="<?php echo date('Y-m-d');?>" size="10" class="form-control" readonly>
							</div>
						<!--</div>
						<div class="form-group label-floating">-->
							<div class="col-md-2">
								<label class="control-label">No de Recibo</label>
							</div>
							<div class="col-md-2">
								<input type="text" name="numero_recibo" size="10" class="form-control" required>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Datos del Solicitante
					</div>
					<div class="panel-body">
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label class="control-label">Nombre Completo</label>
							</div>
							<div class="col-md-8">
								<input type="text" name="nombre_solicitante" class="form-control" maxlength="100" required>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-2">
								<label class="control-label">Dirección</label>
							</div>
							<div class="col-md-6">
								<?php
									$vialidades = VialidadData::getAll();
								?>
								<select class="form-control" name="domicilio_solicitante" required>
									<option value="">Seleccione la Vialidad</option>
									<?php foreach($vialidades as $vialidad):?>
									<option value="<?php echo $vialidad->id;?>"><?php echo $vialidad->nombre ?></option>
									<?php endforeach;?>
								</select>
							</div>
							<div class="col-md-2">
								<label class="control-label">No.</label>
							</div>
							<div class="col-md-2">
								<input type="text" name="numero" class="form-control" maxlength="5" required>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-2">
								<label for="inputEmail1" class="control-label">Colonia</label>
							</div>
							<div class="col-md-10">
								<?php
									$colonias = ColoniaData::getAll();
								?>
								<select class="form-control" name="colonia">
									<option value="">Seleccione la Colonia</option>
									<?php foreach($colonias as $col):?>
									<option value="<?php echo $col->id;?>"><?php echo $col->nombre ?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Datos del Predio para el Permiso
					</div>
					<div class="panel-body">
						<div class="form-group label-floating">
							<div class="col-md-2">
								<label class="control-label">Dirección</label>
							</div>
							<div class="col-md-6">
								<?php
									$vialidades = VialidadData::getAll();
								?>
								<select class="form-control" name="domicilio_predio" required>
									<option value="">Seleccione la Vialidad</option>
									<?php foreach($vialidades as $vialidad):?>
									<option value="<?php echo $vialidad->id;?>"><?php echo $vialidad->nombre ?></option>
									<?php endforeach;?>
								</select>
							</div>
							<div class="col-md-2">
								<label class="control-label">No.</label>
							</div>
							<div class="col-md-2">
								<input type="text" name="numero_predio" class="form-control" maxlength="5">
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-2">
								<label for="inputEmail1" class="control-label">Colonia</label>
							</div>
							<div class="col-md-10">
								<?php
									$colonias = ColoniaData::getAll();
								?>
								<select class="form-control" name="colonia_predio">
									<option value="">Seleccione la Colonia</option>
									<?php foreach($colonias as $col):?>
									<option value="<?php echo $col->id;?>"><?php echo $col->nombre ?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label for="inputEmail1" class="control-label">Fecha de Solicitud</label>
							</div>
							<div class="col-md-8">
								<input type="date" name="fecha_sol" class="form-control">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<input type="text" name="status" value="aceptado" hidden>
		<button type="submit" class="btn btn-primary">Guarda Nueva Licencia</button>
	</form>
	</div>
</div>