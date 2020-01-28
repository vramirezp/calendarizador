<?php
	require('config.php');
	$data = '';
	if(count($_POST) > 0)
	{
		switch(@$_POST['funcion'])
		{
			case 1://Agregar
			{
				$nombre 		 = @$_POST['nombre'];
				$descripcion 	 = @$_POST['descripcion'];
				$fecha 			 = @$_POST['fecha'];
				$hora 			 = @$_POST['hora'];
				$tipo			 = @$_POST['tipo'];
				$fecha2			 = '';
				$tipo2			 = 1;

				if($tipo=='Clases/Trabajo')$tipo2=1;
				if($tipo=='Personal')$tipo2=2;
				if($tipo=='Otro')$tipo2=3;

				$dia  = substr($fecha,0,2);
				$mes  = substr($fecha,3,2);
				$anio = substr($fecha,6,4);

				$fecha2 = $anio.'-'.$mes.'-'.$dia;

				if(strlen($nombre) > 0 && strlen($descripcion) > 0)
				{
					if(strlen($hora) == 5)
					{
						$hora = $hora.':00';
						$sentencia = "INSERT INTO evento (ev_nombre,ev_descripcion,ev_fecha,ev_hora,us_user,ev_tipo) VALUES ('".$nombre."', '".$descripcion."', '".$fecha2."', '".$hora."', '".$_SESSION['usuario']."',".$tipo2.")";
						$sql = mysqli_query($conexion, $sentencia);
						$data = true;
					}
					else $data = 'Hora no valida';
				}
				else $data = 'Debe ingresar todos los datos';

				//mail('victor.ramirezprov@gmail.com', 'Mi título', 'probando maiiiiiiiiiiiil');
			}
			case 2://Eliminar
			{
				$id = @$_POST['id'];

				if(isset($id))
				{
					$sql = mysqli_query($conexion, "DELETE FROM evento WHERE ev_id = ".$id." LIMIT 1");
					$data = '1';
				}
			}
			case 3://Modificar
			{
				$id = @$_POST['ide'];

				if(isset($id))
				{
					$nombre = @$_POST['nombre'];
					$descripcion = @$_POST['descripcion'];
					$fecha = @$_POST['fecha'];
					$hora = @$_POST['hora'];
					$tipo = @$_POST['tipo'];

					$fecha2	= '';
					$tipo2  = 0;

					if($tipo=='Clases')$tipo2=1;
					if($tipo=='Personal')$tipo2=2;
					if($tipo=='Otro')$tipo2=3;

					$dia  = substr($fecha,0,2);
					$mes  = substr($fecha,3,2);
					$anio = substr($fecha,6,4);

					$fecha2 = $anio.'-'.$mes.'-'.$dia;

					if(strlen($nombre) > 0 && strlen($descripcion) > 0 && strlen($fecha) > 0)
					{
						if(strlen($hora) == 5)
						{
							$sql = mysqli_query($conexion, "UPDATE evento SET ev_nombre = '".$nombre."', ev_descripcion = '".$descripcion."', ev_fecha = '".$fecha2."', ev_hora = '".$hora."', ev_tipo = ".$tipo2." WHERE ev_id = ".$id." LIMIT 1");
							$data = true;
						}
						else $data = 'Hora no valida';
					}
					else $data = 'Debe ingresar todos los datos';
				}
			}
		}
	}
	echo $data;
?>