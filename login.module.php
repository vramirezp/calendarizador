<?php
require('config.php');

$mensaje = '';
if($_POST)
{
	$usuario 		= @$_POST['usuario'];
	$contrasena 	= @$_POST['pass'];

	$consulta = mysqli_query($conexion,"SELECT us_user, us_pass FROM usuario WHERE us_pass = '$contrasena' AND us_user = '$usuario'");

	if($consulta->num_rows > 0)
	{
		$campo = $consulta->fetch_assoc();
			
		$_SESSION['id'] = $campo['us_pass'];
		$_SESSION['usuario'] = $campo['us_user'];
			
		$mensaje = true;
	} 
	else $mensaje = 'Usuario y/o Contraseña incorrectos.';
}

echo ($mensaje);
?>