<?php
	error_reporting(E_ALL & ~E_DEPRECATED);
	error_reporting(0);
	ob_start();
	session_start();

	//Conexión a la base de datos para cargar los eventos;
	$conexion = mysqli_connect('localhost', 'inforcon', 'blackballoon17', 'inforcon_calendario');

	if (!$conexion) {
	    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
	    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
	    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	}

	date_default_timezone_set('America/Santiago');
?>