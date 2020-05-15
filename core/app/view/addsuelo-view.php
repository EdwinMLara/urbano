<center>
	<div id='cargando'>
		<img src='plugins/imagenes/2.gif'>
	</div>
</center>
<?php
	if(count($_POST)>0){
		$numero_recibo=$_POST["numero_recibo"];
		
		$licence = new SueloData();
		
		$licence->numero_recibo = $_POST["numero_recibo"];
		$licence->fecha_alta = $_POST["fecha_alta"];
		$licence->nombre_solicitante = strtoupper($_POST["nombre_solicitante"]);
		$licence->domicilio_solicitante = $_POST["domicilio_solicitante"];
		$licence->numero = $_POST["numero"];
		$licence->colonia = $_POST["colonia"];
		$licence->status = $_POST["status"];
		$licence->fecha_sol = $_POST["fecha_sol"];
		$licence->domicilio_predio = $_POST["domicilio_predio"];
		$licence->numero_predio = $_POST["numero_predio"];
		$licence->colonia_predio = $_POST["colonia_predio"];
		$licence->add();
		Core::redir("report/usosuelo.php?num=$numero_recibo");
		//print "<script>window.location='report/numeracion.php?num=$no_recibo';</script>";
	}
?>