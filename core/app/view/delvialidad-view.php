<?php
	$delcol = VialidadData::getById($_GET["id"]);
	$delcol->del();
	Core::redir("./index.php?view=vialidades");
?>