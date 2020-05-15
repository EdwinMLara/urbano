<div class="row">
	<div class="col-md-12">
	<h1>Editar Alineamiento y Número Oficial </h1>
	<br>
	<form class="form-horizontal" method="post" enctype="multipart/form-data" id="eddinumeracion" action="index.php?view=eddinumeracion" role="form">
		<?php
			$numero_licencia=$_GET['id'];
			$numeracion = NumeracionData::getById($numero_licencia);
		?>
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Datos de la licencia
					</div>
					<div class="panel-body">
						<div class="col-md-6 form-group">
							<label class="control-label">No. Licencia</label>
							<input type="text" name="numero_licencia" size="10" class="form-control" value="<?php echo $numeracion->numero_licencia; ?>" readonly>
						</div>
						<div class="col-md-6 form-group">
							<label class="control-label">No. Recibo</label>
							<input type="text" name="numero_recibo" size="10" class="form-control"  value="<?php echo $numeracion->numero_recibo; ?>" readonly>
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
							<input type="text" name="fecha_alta" value="<?php echo $numeracion->fecha; ?>" size="10" class="form-control" readonly>
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
								<input type="text" name="nombre_solicitante" class="form-control" value="<?php echo $numeracion->nombre_solicitante; ?>" maxlength="100" required>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label class="control-label">Domicilio</label>
							</div>
							<div class="col-md-8">
								<input type="text" name="domicilio_solicitante" class="form-control" value="<?php echo $numeracion->domicilio_solicitante; ?>" maxlength="100" required>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label class="control-label">Ciudad</label>
							</div>
							<div class="col-md-8">
								<input type="text" name="ciudad_solicitante" class="form-control" value="<?php echo $numeracion->ciudad_solicitante;?>" maxlength="50" required>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label class="control-label">Telefono</label>
							</div>
							<div class="col-md-8">
								<input type="text" name="telefono_solicitante" class="form-control" value="<?php echo $numeracion->telefono_solicitante;?>" maxlength="10" required>
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
								<input type="text" name="cta_catastral" class="form-control" value="<?php echo $numeracion->predial_obra;?>" maxlength="13" required>
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
									<option value="<?php echo $vialidad->id;?>" <?php if($numeracion->ubicacion_obra!=null&&$numeracion->ubicacion_obra==$vialidad->id){ echo "selected"; } ?>><?php echo $vialidad->nombre; ?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label for="inputEmail1" class="control-label">Número Actual</label>
							</div>
							<div class="col-md-8">
								<input type="text" name="numero" class="form-control" value="<?php echo $numeracion->numero;?>" maxlength="20" required>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label for="inputEmail1" class="control-label">Colonia</label>
							</div>
							<div class="col-md-8">
								<?php
									$idcc=$numeracion->colonia;
									$colonias = ColoniaData::getAll();
								?>
								<select class="form-control" name="colonia" required>
									<option value="">Seleccione la Colonia</option>
									<?php foreach($colonias as $colonia):?>
									<option value="<?php echo $colonia->id;?>" <?php if($numeracion->colonia!=null&&$numeracion->colonia==$colonia->id){ echo "selected"; } ?>><?php echo $colonia->nombre ?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label for="inputEmail1" class="control-label">Medida del Frente</label>
							</div>
							<div class="col-md-4">
								<input type="text" name="frente" class="form-control" maxlength="50" value="<?php echo $numeracion->frente;?>" required>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label for="inputEmail1" class="control-label">Distancia de la Esquina más Próxima</label>
							</div>
							<div class="col-md-4">
								<input type="text" name="esquina" class="form-control" maxlength="150" value="<?php echo $numeracion->esquina;?>" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">
								<label for="inputEmail1" class="control-label">Distancia Entre Parametros</label>
							</div>
							<div class="col-md-4">
								<input type="text" name="paramentos" class="form-control" maxlength="150" value="<?php echo $numeracion->paramentos;?>" required>
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
									<input type="text" name="oficial" class="form-control" maxlength="150" value="<?php echo $numeracion->oficial;?>" required>
								</div>
							</div>
							<div class="form-group label-floating">
								<div class="col-md-4">
									<label for="inputEmail1" class="control-label">Lindero Norte</label>
								</div>
								<div class="col-md-8">
									<input type="text" name="lindero_norte" class="form-control" maxlength="150" value="<?php echo $numeracion->lindero_norte;?>">
								</div>
							</div>
							<div class="form-group label-floating">
								<div class="col-md-4">
									<label for="inputEmail1" class="control-label">Lindero Sur</label>
								</div>
								<div class="col-md-8">
									<input type="text" name="lindero_sur" class="form-control" maxlength="150" value="<?php echo $numeracion->lindero_sur;?>">
								</div>
							</div>
							<div class="form-group label-floating">
								<div class="col-md-4">
									<label for="inputEmail1" class="control-label">Lindero_Este</label>
								</div>
								<div class="col-md-8">
									<input type="text" name="lindero_este" class="form-control" maxlength="150" value="<?php echo $numeracion->lindero_este;?>">
								</div>
							</div>
							<div class="form-group label-floating">
								<div class="col-md-4">
									<label for="inputEmail1" class="control-label">Lindero Oeste</label>
								</div>
								<div class="col-md-8">
									<input type="text" name="lindero_oeste" class="form-control" maxlength="150" value="<?php echo $numeracion->lindero_oeste;?>">
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