<div class="row">
	<div class="col-md-12">
	<h1>Nuevo Alineamiento y Número Oficial </h1>
	<br>
	<form class="form-horizontal" method="post" enctype="multipart/form-data" id="addnumeracion" action="index.php?view=addnumeracion" role="form">
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Datos de la licencia
					</div>
					<div class="panel-body">
						<div class="col-md-6 form-group">
							<?php
								$maxidd = NumeracionData::maxid();
								if($maxidd==""){
									$astmaxid=0;
									$folionext = ($astmaxid+1);
								}else{
									foreach ($maxidd as $astmaxid){
										$folionext = ($astmaxid+1);
									}
								}
							?>
								<label class="control-label">No. Licencia</label>
								<input type="text" name="no_licencia" size="10" class="form-control" value="<?php echo $folionext; ?>" readonly>
						</div>
						<div class="col-md-6 form-group">
							<label class="control-label">No. Recibo</label>
							<input type="text" name="numero_recibo" size="10" class="form-control" value="<?php echo $folionext; ?>" readonly>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Fecha de Expedición de la Licencia
					</div>
					<div class="panel-body">
						<div class="col-md-6 form-group">
								<label class="control-label">Fecha</label>
								<input type="text" name="fecha_alta" value="<?php echo date('Y-m-d');?>" size="10" class="form-control" readonly>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Datos del solicitante propietario
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
							<div class="col-md-4">
								<label class="control-label">Domicilio</label>
							</div>
							<div class="col-md-8">
								<input type="text" name="domicilio_solicitante" class="form-control" maxlength="100" required>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label class="control-label">Ciudad</label>
							</div>
							<div class="col-md-8">
								<input type="text" name="ciudad_solicitante" class="form-control" maxlength="50" required>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label class="control-label">Telefono</label>
							</div>
							<div class="col-md-8">
								<input type="text" name="telefono_solicitante" class="form-control" maxlength="10" required>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Datos del Predio
					</div>
					<div class="panel-body">
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label for="inputEmail1" class="control-label">Cuenta Predial</label>
							</div>
							<div class="col-md-8">
								<input type="text" name="cta_catastral" class="form-control" maxlength="13" required>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label for="inputEmail1" class="control-label">Dirección</label>
							</div>
							<div class="col-md-8">
								<?php
									$vialidades = VialidadData::getAll();
								?>
								<select class="form-control" name="ubicacion_obra" required>
									<option value="">Seleccione la Vialidad</option>
									<?php foreach($vialidades as $vialidad):?>
									<option value="<?php echo $vialidad->id;?>"><?php echo $vialidad->nombre ?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label for="inputEmail1" class="control-label">Número Expedido</label>
							</div>
							<div class="col-md-8">
								<input type="text" name="numero" class="form-control" maxlength="25" required>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label for="inputEmail1" class="control-label">Colonia</label>
							</div>
							<div class="col-md-8">
								<?php
									$colonias = ColoniaData::getAll();
								?>
								<select class="form-control" name="colonia" required>
									<option value="">Seleccione la Colonia</option>
									<?php foreach($colonias as $colonia):?>
									<option value="<?php echo $colonia->id;?>"><?php echo $colonia->nombre ?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label for="inputEmail1" class="control-label">Medida del Frente</label>
							</div>
							<div class="col-md-4">
								<input type="text" name="frente" class="form-control" maxlength="50" required>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label for="inputEmail1" class="control-label">Distancia de la Esquina más Próxima</label>
							</div>
							<div class="col-md-4">
								<input type="text" name="esquina" class="form-control" maxlength="150" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">
								<label for="inputEmail1" class="control-label">Distancia Entre Parametros</label>
							</div>
							<div class="col-md-4">
								<input type="text" name="paramentos" class="form-control" maxlength="150" required>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Vialidades Colindantes con la Propiedad
					</div>
					<div class="panel-body">
						<div class="col-md-6">
							<div class="form-group label-floating">
								<div class="col-md-4">
									<label for="inputEmail1" class="control-label">Numero Oficial</label>
								</div>
								<div class="col-md-8">
									<input type="text" name="oficial" class="form-control" maxlength="150" required>
								</div>
							</div>
							<div class="form-group label-floating">
								<div class="col-md-4">
									<label for="inputEmail1" class="control-label">Lindero Norte</label>
								</div>
								<div class="col-md-8">
									<input type="text" name="lindero_norte" class="form-control" maxlength="150">
								</div>
							</div>
							<div class="form-group label-floating">
								<div class="col-md-4">
									<label for="inputEmail1" class="control-label">Lindero Sur</label>
								</div>
								<div class="col-md-8">
									<input type="text" name="lindero_sur" class="form-control" maxlength="150">
								</div>
							</div>
							<div class="form-group label-floating">
								<div class="col-md-4">
									<label for="inputEmail1" class="control-label">Lindero_Este</label>
								</div>
								<div class="col-md-8">
									<input type="text" name="lindero_este" class="form-control" maxlength="150">
								</div>
							</div>
							<div class="form-group label-floating">
								<div class="col-md-4">
									<label for="inputEmail1" class="control-label">Lindero Oeste</label>
								</div>
								<div class="col-md-8">
									<input type="text" name="lindero_oeste" class="form-control" maxlength="150">
								</div>
							</div>
							<div class="form-group label-floating">
								<div class="col-md-4">
									<label for="inputEmail1" class="control-label">Observaciones</label>
								</div>
								<div class="col-md-8">
									<input type="text" name="observaciones" class="form-control" maxlength="150">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group label-floating">
								<div class="col-md-4">
									<label for="inputEmail1" class="control-label">Seleccione el posicionamiento del Numero</label>
								</div>
								<div class="col-md-8">
									<select class="form-control" name="posicionamiento">
										<option value="">Seleccione el Posicionamiento</option>
										<option value="1">Centrado</option>
										<option value="2">Esquina Inferior Este</option>
										<option value="3">Esquina Inferior Oeste</option>
									</select>
								</div>
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