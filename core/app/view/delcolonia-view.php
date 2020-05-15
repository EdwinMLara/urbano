<?php
	$delcol = ColoniaData::getById($_GET["id"]);
	$delcol->del();
	Core::redir("./index.php?view=colonias");
?>