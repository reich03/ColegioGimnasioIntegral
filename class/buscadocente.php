<?php
	include('class.consultas.php');
	$filtro    = $_GET["term"];
	$Json      = new Json;
	$docente  = $Json->BuscaDocente($filtro);
	echo  json_encode($docente);
	
?>  