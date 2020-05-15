<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h1 class="box-title">Reporte de Licencias de Construccion</h1>
			</div>
			<div class="box-body">
				<form>
					<input type="hidden" name="view" value="repconstruccion">
					<div class="row">
						<div class="col-md-3">
							<input type="date" name="sd" value="<?php if(isset($_GET["sd"])){ echo $_GET["sd"]; }?>" class="form-control" placeholder="dd/mm/aaaa">
						</div>
						<div class="col-md-3">
							<input type="date" name="ed" value="<?php if(isset($_GET["ed"])){ echo $_GET["ed"]; }?>" class="form-control" placeholder="dd/mm/aaaa">
						</div>
						<div class="col-md-3">
							<input type="submit" class="btn btn-success btn-block" value="Procesar">
						</div>
					</div>
				</form>
				<br>
				<br>
				<!------>
				<div class="row">
					<div class="col-md-12">
				<?php	if(isset($_GET["sd"]) && isset($_GET["ed"]) ):
							if($_GET["sd"]!=""&&$_GET["ed"]!=""):
							$operations = array();
								$operations = ConstruccionData::getAllByDateOp($_GET["sd"],$_GET["ed"]);
								if(count($operations)>0):
									$supertotal = 0; 
									$totalfolio = 0;
								?>
									<div class="col-md-3">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
											<i class="fa fa-download"></i> Descargar <span class="caret"></span>
										</button>	
										<ul class="dropdown-menu" role="menu">
											<li><a href="report/repcontruccion.php?sd=<?php echo $_GET["sd"];?>&ed=<?php echo $_GET["ed"];?>"><i class="fa fa-file-pdf-o"></i> PDF</a></li>
										</ul>
									</div>
									<br>
									<br>
									<!-- AQUI SE INICIA PARA EL PDF -->
									<table class="table table-bordered">
										<thead>
											<th>Numero de Licencia</th>
											<th>Fecha de Expedicion</th>
											<th>Solicitante</th>
											<th>Domicilio de Construcción</th>
											<th>Descripcion Construcción</th>
											<th>Vigencia Inicial</th>
											<th>Vigencia Final</th>
										</thead>
										<?php foreach($operations as $operation):?>
										<tr>
											<td><?php echo $operation->numero_licencia; ?></td>
											<td><?php echo $operation->fecha; ?></td>
											<td><?php echo $operation->nombre_solicitante; ?></td>
											<td><?php echo $operation->ubicacion_obra; ?></td>
											<td><?php echo $operation->destino_obra; ?></td>
											<td><?php echo $operation->vigencia1; ?></td>
											<td><?php echo $operation->vigencia2; ?></td>
										</tr>
										<?php
											$totalfolio=($totalfolio+1);
											endforeach; 
										?>
									</table>
									<h3>Total de Licencias Expedidas: <?php echo $totalfolio; ?></h3>
									<!-- AQUI SE TERMINA PARA EL PDF -->
									<br>
									<?php else:// si no hay operaciones?>
									<script>
										$("#wellcome").hide();
									</script>
									<div class="jumbotron">
										<h2>No hay operaciones</h2>
										<p>El rango de fechas seleccionado no proporciono ningun resultado de operaciones.</p>
									</div>
								<?php endif; ?>
								<?php else:?>
								<script>
									$("#wellcome").hide();
								</script>
								<div class="jumbotron">
									<h2>Fecha Incorrectas</h2>
									<p>Puede ser que no selecciono un rango de fechas, o el rango seleccionado es incorrecto.</p>
								</div>
							<?php endif;
						endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>