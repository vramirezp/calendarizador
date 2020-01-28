<?php
	session_start();
	$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
	"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	$month = $_SESSION['mes'];
	$year =  $_SESSION['anio'];

	$t = $meses[$month].' '.$year;
	
	header("Content-Type: application/vnd.ms-word");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Disposition: filename=".$t.".doc");

	if (isset($_POST['datos_a_enviar2']) && $_POST['datos_a_enviar2'] != '') echo utf8_decode($_POST['datos_a_enviar2']);
?>