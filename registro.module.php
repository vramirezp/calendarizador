<?php
require('config.php');
$mensaje = '';
if($_POST)
{
	$usuario 		= @$_POST['usuario'];
	$contrasena 	= @$_POST['password'];
	if(!empty($usuario) && !empty($contrasena))
	{
		$consulta = mysqli_query($conexion, "SELECT us_pass FROM usuario WHERE us_user = '".$usuario."' LIMIT 1");

		if($consulta->num_rows == 0)
		{	
			if (strlen($usuario) < 18 && strlen($contrasena) < 20)
			{
				if(strlen($usuario) >= 6 && strlen($contrasena) >= 6)
				{
					$sql = mysqli_query($conexion, "INSERT INTO usuario VALUES ('".$usuario."','".$contrasena."')");
					$mensaje = true;
				}
				else $mensaje = "Usuario y Contraseña deben tener al menos 6 caracteres";
			}
			else $mensaje = "Usuario o Contraseña son muy largos";
		} 
		else $mensaje = 'Usuario ya existe';
	}
	else $mensaje = 'Campos vacios, rellenelos.';
}

echo ($mensaje);
?>