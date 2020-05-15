<div class="row">
	<div class="col-md-12">
	<h1>Nueva Licencia de Construcción</h1>
	<br>
	<form class="form-horizontal" method="post" enctype="multipart/form-data" id="addconstruccion" action="index.php?view=addconstruccion" role="form">
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Datos de la licencia
					</div>
					<div class="panel-body">
						<div class="col-md-12 form-group">
							<?php
								$maxidd = ConstruccionData::maxid();
								if($maxidd==""){
									$astmaxid=0;
									$folionext = ((int)$astmaxid+1);
								}else{
									foreach ($maxidd as $astmaxid){
										$folionext = ((int)$astmaxid+1);
									}
								}
							?>
							<div class="col-md-6">
							<label class="control-label">No. Licencia</label>
							</div>
							<div class="col-md-6">
							<input type="text" name="no_licencia" size="10" class="form-control" value="<?php echo $folionext; ?>" readonly>
							</div>
						</div>
						<div class="col-md-12 form-group">
							<div class="col-md-6">
								<label class="control-label">No. Recibo</label>
							</div>
							<div class="col-md-6">
								<input type="text" name="numero_recibo" size="10" class="form-control" maxlength="4" required>
							</div>
						</div>
						<div class="col-md-12 form-group">
							<div class="col-md-6">
								<label class="control-label">Fecha Alta</label>
							</div>
							<div class="col-md-6">
								<input type="text" name="fecha_alta" value="<?php echo date('Y-m-d');?>" size="10" class="form-control" readonly>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Vijencia de la licencia
					</div>
					<div class="panel-body">
						<div class="col-md-12 form-group">
							<div class="col-md-3">
								<label class="control-label">Inicio</label>
							</div>
							<div class="col-md-9">
								<input type="text" name="vigencia1" class="form-control" id="example1" required>
							</div>
						</div>
						<div class="col-md-12 form-group">
							<div class="col-md-3">
								<label class="control-label">Final</label>
							</div>
							<div class="col-md-9">
								<input type="text" name="vigencia2" class="form-control" id="example2" required>
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
						Datos del solicitante propietario
					</div>
					<div class="panel-body">
						<div class="form-group label-floating">
							<div class="col-md-5">
								<label class="control-label">Nombre Completo</label>
							</div>
							<div class="col-md-7">
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
						Datos del responsable de la obra(Solicitante)
					</div>
					<div class="panel-body">
						<div class="form-group label-floating">
							<div class="col-md-5">
								<label class="control-label">Nombre Completo</label>
							</div>
							<div class="col-md-7">
								<input type="text" name="nombre_suscriptor" class="form-control" maxlength="100" required>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label class="control-label">Domicilio</label>
							</div>
							<div class="col-md-8">
								<input type="text" name="domicilio_suscriptor" class="form-control" maxlength="100" required>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-5">
								<label class="control-label">Perito con registro numero</label>
							</div>
							<div class="col-md-7">
								<input type="text" name="numero_perito" id="numeropr" class="form-control" maxlength="15" required>
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
						Datos de la obra
					</div>
					<div class="panel-body">
						<div class="col-md-6">
							<div class="form-group label-floating">
								<div class="col-md-5">
									<label for="inputEmail1" class="control-label">Cuenta Predial</label>
								</div>
								<div class="col-md-7">
									<input type="text" name="cta_catastral" class="form-control" maxlength="250" required>
								</div>
							</div>
							<div class="form-group label-floating">
								<div class="col-md-4">
									<label for="inputEmail1" class="control-label">Ubicacion</label>
								</div>
								<div class="col-md-8">
									<input type="text" name="ubicacion_obra" class="form-control" maxlength="150" required>
								</div>
							</div>
							<div class="form-group label-floating">
								<label for="inputEmail1" class="control-label">Descripcion de la Construccion</label>
								<input type="text" name="destino_obra" class="form-control" maxlength="150" required>
							</div>
							<div class="form-group label-floating">
								<div class="col-md-6">
									<label for="inputEmail1" class="control-label">Superficie a Construir</label>
								</div>
								<div class="col-md-6">
									<input type="text" name="superficie_obra" class="form-control" maxlength="150" required>
								</div>
							</div>
							<div class="form-group label-floating">
								<label for="inputEmail1" class="control-label">Documentos Adjuntos</label>
								<input type="text" name="documentos_obra" class="form-control" maxlength="150" required>
							</div>
							<div class="form-group label-floating">
								<label for="inputEmail1" class="control-label">Observaciones</label>
								<input type="text" name="observaciones" class="form-control" maxlength="150">
							</div>
						</div>
						<div class="col-md-6">
							<center>
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Imagen</label>
									<br>
									<input type="file" name="image" id="image" placeholder="">
								</div>
							</center>
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