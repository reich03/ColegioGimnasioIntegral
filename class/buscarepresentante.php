<?php
	include('class.consultas.php');
	$filtro    = $_GET["term"];
	$Json      = new Json;
	$representante  = $Json->BuscaRepresentante($filtro);
	echo  json_encode($representante);
	
?>  