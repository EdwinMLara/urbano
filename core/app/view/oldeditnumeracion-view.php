<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h1 class="box-title">Editar Alineamiento y Numero Oficial</h1>
			</div>
			<div class="box-body">
				<form class="form-horizontal" method="post" enctype="multipart/form-data" id="updateoldnum" action="index.php?view=updateoldnum" role="form">
					<?php
						$numero_licencia=$_GET['id'];
						$numeracion = OldDataBase::getById($numero_licencia);
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
											<input type="text" name="ubicacion_obra" class="form-control" value="<?php echo $numeracion->ubicacion_obra; ?>" maxlength="100" required>
										</div>
									</div>
									<div class="form-group label-floating">
										<div class="col-md-4">
											<label for="inputEmail1" class="control-label">Número Actual</label>
										</div>
										<div class="col-md-8">
											<input type="text" name="numero" class="form-control" value="<?php echo $numeracion->numero;?>" maxlength="6" required>
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
								</div>
							</div>
						</div>
					</div>					
					<input type="hidden" name="id" class="form-control" value="<?php echo $numeracion->id;?>">
					<button type="submit" class="btn btn-primary">Guarda Nueva Licencia</button>
				</form>
			</div>
		</div>
	</div>
</div>