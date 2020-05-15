<center>
	<div id='cargando'>
		<img src='plugins/imagenes/2.gif'>
	</div>
</center>
<?php
	if(count($_POST)>0){
		$no_recibo=$_POST["numero_recibo"];
		$posicionamiento=$_POST["posicionamiento"];
		$licence = new NumeracionData();
		
		$licence->numero_recibo = $_POST["numero_recibo"];
		$licence->fecha = $_POST["fecha_alta"];
		$licence->nombre_solicitante = $_POST["nombre_solicitante"];
		$licence->domicilio_solicitante = $_POST["domicilio_solicitante"];
		$licence->ciudad_solicitante = $_POST["ciudad_solicitante"];
		$licence->telefono_solicitante = $_POST["telefono_solicitante"];
		$licence->predial_obra = $_POST["cta_catastral"];
		$licence->ubicacion_obra = $_POST["ubicacion_obra"];
		$licence->colonia = $_POST["colonia"];
		$licence->frente = $_POST["frente"];
		$licence->paramentos = $_POST["paramentos"];
		$licence->lindero_norte = $_POST["lindero_norte"];
		$licence->lindero_sur = $_POST["lindero_sur"];
		$licence->status = $_POST["status"];
		$licence->lindero_oeste = $_POST["lindero_oeste"];
		$licence->observaciones = $_POST["observaciones"];
		$licence->esquina= $_POST["esquina"];
		$licence->lindero_este = $_POST["lindero_este"];
		$licence->numero = $_POST["numero"];
		$licence->oficial = $_POST["oficial"];
		$licence->add();
		Core::redir("report/numeracion.php?num=$no_recibo&posi=$posicionamiento");
		//print "<script>window.location='report/numeracion.php?num=$no_recibo';</script>";
	}
?>