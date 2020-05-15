<div class="row">
	<div class="col-md-12">
		<center>
		<h1>Visualizacion de PDF de la licencia de construccion</h1>
		<?php
			$documento=$_GET["id"];
		?>
		<object type="application/pdf" data="storage/constrccion/<?php echo $documento;?>.pdf" width="720" height="1080">
		</center>
	</div>
</div>