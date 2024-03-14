<?php
	include('class.consultas.php');
	$filtro    = $_GET["term"];
	$Json      = new Json;
	$estudiante  = $Json->BusquedaEstudiante($filtro);
	echo  json_encode($estudiante);
?>  