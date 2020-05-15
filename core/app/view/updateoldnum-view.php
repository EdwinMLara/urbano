<center>
	<div id='cargando'>
		<img src='plugins/imagenes/2.gif'>
	</div>
</center>
<?php
	if(count($_POST)>0){
		$licence = OldDataBase::getById($_POST["numero_licencia"]);
		$id=$_POST["id"];
		$licence->numero_licencia = $_POST["numero_licencia"];
		
		$licence->nombre_solicitante = $_POST["nombre_solicitante"];
		$licence->domicilio_solicitante = $_POST["domicilio_solicitante"];
		$licence->ciudad_solicitante = $_POST["ciudad_solicitante"];
		$licence->telefono_solicitante = $_POST["telefono_solicitante"];
		$licence->predial_obra = $_POST["cta_catastral"];
		$licence->ubicacion_obra = $_POST["ubicacion_obra"];
		$licence->frente = $_POST["frente"];
		$licence->paramentos = $_POST["paramentos"];
		$licence->lindero_norte = $_POST["lindero_norte"];
		$licence->lindero_sur = $_POST["lindero_sur"];
		$licence->lindero_oeste = $_POST["lindero_oeste"];
		$licence->observaciones = $_POST["observaciones"];
		$licence->esquina= $_POST["esquina"];
		$licence->lindero_este = $_POST["lindero_este"];
		$licence->numero = $_POST["numero"];
		$licence->oficial = $_POST["oficial"];
		
		$licence->update();
		
		Core::redir("report/visoroldnumeracion.php?id=$id");
	}
?>