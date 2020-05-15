<?php

if(count($_POST)>0){
	$user = new ColoniaData();
	$user->nombre = $_POST["name"];
	$user->add();
	print "<script>window.location='index.php?view=colonias';</script>";
}
?>