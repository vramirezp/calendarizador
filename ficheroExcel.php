<?php
	session_start();
	$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
	"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	$month = $_SESSION['mes'];
	$year =  $_SESSION['anio'];

	$t = $meses[$month].' '.$year;
	
	header("Content-type: application/vnd.ms-excel; name='excel'");
	header("Content-Disposition: filename=".$t.".xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	if (isset($_POST['datos_a_enviar']) && $_POST['datos_a_enviar'] != '') echo utf8_decode($_POST['datos_a_enviar']);
?>