<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h1 class="box-title">Predios Registrados en Catastro con Numero</h1>
			</div>
			<div class="box-body">
				<div class="row">
					<form id="searchnum">
						<input type="hidden" name="view" value="predioscatas">
						<div class="col-md-3">
							<label class="control-label">Seleccione la Colonia</label>
							<?php
								$colonias = ColoniaData::getAll();
							?>
							<select class="form-control" name="idc">
								<option value="">Seleccione la Colonia</option>
								<?php foreach($colonias as $colonia):?>
								<option value="<?php echo $colonia->id;?>"><?php echo $colonia->nombre ?></option>
								<?php endforeach;?>
							</select>
						</div>
						<div class="col-md-3">
							<label class="control-label">Seleccione la Calle</label>
							<?php
								$vialidades = VialidadData::getAll();
							?>
							<select class="form-control" name="idv">
								<option value="">Seleccione la Vialidad</option>
								<?php foreach($vialidades as $vialidad):?>
								<option value="<?php echo $vialidad->id;?>"><?php echo $vialidad->nombre ?></option>
								<?php endforeach;?>
							</select>
						</div>
						<div class="col-md-3">
							<button type="submit" class="btn btn-primary">Buscar</button>
						</div>
					</form>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php
							if(isset($_GET["idc"]) && isset($_GET["idv"])):
								if($_GET["idc"]!=""&&$_GET["idv"]!=""):
									$resultado = array();
									$resultado = CatastroData::getcv($_GET["idc"],$_GET["idv"]);
									if(count($resultado)>0):
									?>
									<table class="table table-bordered">
										<thead>
											<th>Colonia</th>
											<th>Vialidad</th>
											<th>Numero</th>
										</thead>
										<?php foreach($resultado as $resul):?>
										<tr>
											<td><?php
												$idc=($resul->cve_colonia);
												$datoscolonia=ColoniaData::getById($idc);
												echo utf8_decode($datoscolonia->nombre);
												?>
											</td>
											<td><?php
												$idv=($resul->cve_vialidad);
												$datosvialidad=VialidadData::getById($idv);
												echo utf8_decode($datosvialidad->nombre);
												?>
											</td>
											<td><?php echo $resul->no_ext; ?></td>
										</tr>
										<?php endforeach; ?>
									</table>
									<?php else:// si no hay operaciones?>
									<script>
										$("#wellcome").hide();
									</script>
									<div class="jumbotron">
										<h2>No hay Registros</h2>
										<p>Debido a que en la vialidad no pertenese a la colonia.</p>
									</div>
									<?php
									endif;
								else: ?>
									<script>
										$("#wellcome").hide();
									</script>
									<div class="jumbotron">
										<h2>No hay Registros</h2>
										<p>No se espesifico uno de los filtros.</p>
									</div>
						<?php	endif;
							endif;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
