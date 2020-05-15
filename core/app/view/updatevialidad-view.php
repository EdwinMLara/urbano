<?php

if(count($_POST)>0){
	$user = VialidadData::getById($_POST["colonia_id"]);
	$user->nombre = $_POST["name"];
	$user->update();
	print "<script>window.location='index.php?view=vialidades';</script>";
}
?>