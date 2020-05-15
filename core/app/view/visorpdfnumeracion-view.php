<div class="row">
	<div class="col-md-12">
		<center>
		<h1>Visualizacion de PDF de Alineamiento y Número Oficial</h1>
		<?php
			$documento=$_GET["id"];
		?>
		<object type="application/pdf" data="storage/numeracion/<?php echo $documento;?>.pdf" width="720" height="1080">
		</center>
	</div>
</div>