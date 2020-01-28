<?php
require('config.php');
$mensaje = '';
if($_POST)
{
	$usuario 		= @$_POST['usuario'];
	$antigua	 	= @$_POST['antigua'];
	$nueva	 		= @$_POST['nueva'];

	if(!empty($antigua) && !empty($nueva))
	{
		$consulta = mysqli_query($conexion, "SELECT us_user, us_pass FROM usuario WHERE us_pass='". $antigua ."' LIMIT 1");

		if($consulta->num_rows != 0)
		{	
			if (strlen($antigua) < 20 && strlen($nueva) < 20)
			{
				if(strlen($nueva) > 6)
				{
					$sql = mysqli_query($conexion, "UPDATE usuario SET us_pass='". $nueva ."' WHERE us_user='".$usuario."'");
					$mensaje = true;
				}
				else $mensaje = "La contraseña debe contener al menos 6 caracteres";
			}
			else $mensaje = "Contraseñas muy largas";
		} 
		else $mensaje = 'La contraseña antigua es incorrecta';
	}
	else $mensaje = 'Debe ingresar una contraseña';
}

echo ($mensaje);
?>