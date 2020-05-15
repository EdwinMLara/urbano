<?php

if(count($_POST)>0){
	$user = new VialidadData();
	$user->nombre = $_POST["name"];
	$user->add();
	print "<script>window.location='index.php?view=vialidades';</script>";
}
?>