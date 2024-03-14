<?php
	include('class.consultas.php');
	$filtro    = $_GET["term"];
	$Json      = new Json;
	$estudiante  = $Json->BuscaEstudiante($filtro);
	echo  json_encode($estudiante);
	
?>  