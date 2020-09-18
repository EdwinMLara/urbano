<div class="row">
	<?php
		$numero_licencia=$_GET['id'];
		$construccion = ConstruccionData::getById($numero_licencia);
	?>
	<div class="row">
		<div class="col-md-4"><center><img src="/urbano1.5/plugins/imagenes/uriangato.png" style="width: 100px; height: auto;"></center></div>
		<div class="col-md-4"><center><h3>LICENCIA DE CONSTRUCCIÓN</h3><h4>Dirección de Desarrollo Urbano</h4></center></div>
		<div class="col-md-4"><center><img src="/urbano1.5/plugins/imagenes/escudomin.png" style="width: 100px; height: auto;"></center></div>
	</div>
	<div class="row mt-4">
		<div class="col-md-7">
			<div style=" padding: 20px 150px 0px; margin-top:20px">
				<input type="hidden" id="no_recibo" name="numero_recibo" size="10" class="form-control" maxlength="4" value="<?php echo $construccion->numero_recibo ?>">
				<label class="control-label">Licencia numero<?php echo " ".$construccion->numero_licencia ?></label><br/>
				<label class="control-label">Licencia de Recibo<?php echo " ".$construccion->numero_recibo ?></label><br/>
				<label class="control-label">Licencia numero<?php echo " ".$construccion->vigencia1." a ".$construccion->vigencia2 ?></label><br/><br/>

				<label class="control-label" style="font-size: large;">Datos del solicitante propietario</label><br/><br/>
				<label class="control-label">Nombre: <?php echo " ".$construccion->nombre_solicitante ?></label><br/>
				<label class="control-label">Direccion: <?php echo " ".$construccion->domicilio_solicitante ?></label><br/>
				<label class="control-label">Ciudad: <?php echo " ".$construccion->ciudad_solicitante?></label><br/><br/>
				
				<label class="control-label" style="font-size: large;">Datos del responsable de la obra</label><br/><br/>
				<label class="control-label">Nombre: <?php echo " ".$construccion->nombre_suscriptor ?></label><br/>
				<label class="control-label">Direccion: <?php echo " ".$construccion->domicilio_suscriptor ?></label><br/>
				<label class="control-label">Numero de registro: <?php echo " ".$construccion->numero_perito?></label><br/><br/>

				<label class="control-label" style="font-size: large;">Datos de la obra</label><br/><br/>
				<label class="control-label">Cuenta predial: <?php echo " ".$construccion->predial_obra ?></label><br/>
				<label class="control-label">Ubicacion de la obra: <?php echo " ".$construccion->ubicacion_obra ?></label><br/>
				<label class="control-label">Destino de la construccion: <?php echo " ".$construccion->destino_obra?></label><br/>
				<label class="control-label">Superficie de construccion: <?php echo " ".$construccion->superficie_obra?></label><br/>
				<label class="control-label">Destino de la construccion: <?php echo " ".$construccion->documentos_obra?></label><br/><br/>

				<label class="control-label" style="font-size: large;">observaciones</label><br/>
				<label class="control-label">Destino de la construccion: <?php echo " ".$construccion->observaciones?></label><br/>

			</div>
		</div>
		<div class="col-md-5">
		<input id="photo" type="text" name="photo" hidden>	
				<div id="qrcode" style="width: 50px; height: auto; margin-top:20px; padding:10%"></div>
		</div>
	</div>
	<div class="row">
		<div style=" padding: 20px 150px 0px; margin-top:20px">
		<center>
			<h4 style="font-weight: bold;">Uriangato Guanajuato., a<?php echo " ".$construccion->vigencia1?></h4>
		</center>
			<div style="font-weight: bold; padding: 20px">NOTA: Es importante seguir los lineamientos que nos marca el Reglamento de Construcción Municipal. (El material de
			construcción sobre la vía pública sólo podrá permanecer 48 horas; si se requiere de más tiempo, el ciudadano
			deberá solicitar un permiso especial)-Artículo 19</div>
			<ul>
				<li>* Queda estrictamente prohibida la construcción sobre la marquesina - Artículos 17 y 22.</li>
				<li>* Este permiso quedará anulado si la propiedad no cumpliera con lo expuesto con anterioridad o si ésta afectara a terceros.</li>
				<li>* Las demoliciones que ocasionara la omisión anterior será por cuenta del solicitante - Artículos 208 y 210.</li>
				<li>* Responsabilidades y Sanciones - Artículos 218,219,220 y 221.</li>
				<li>* A efecto de inspección - Articulos 215.</li>
			</ul>
		</div>
	</div>
</div>
<script src="/urbano1.5/plugins/Qr/qrcode.min.js"></script>
<script src="/urbano1.5/plugins/bootstrap/js/GenerateQr.js"></script>