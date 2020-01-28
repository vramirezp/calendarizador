<?php
	include('header.php');
	require('config.php');

	$id = $_REQUEST['id_evento'];
	$sqlCompleta = "SELECT * FROM evento WHERE ev_id = $id";
	$sql = mysqli_query($conexion, $sqlCompleta);

	if($sql->num_rows > 0)
	{
		$dato = $sql->fetch_assoc();
		
		$evento   = $dato['ev_nombre'];
		$descripcion   = $dato['ev_descripcion'];
		$fecha    = $dato['ev_fecha'];
		$tipo     = $dato['ev_tipo'];
		$anio     = substr($fecha, 0,4);
		$mes      = substr($fecha,5,2);
		$dia      = substr($fecha,8,2);
		$hora     = substr($dato['ev_hora'],0,5);
		$fecha_final = $dia.'/'.$mes.'/'.$anio;
	}
?>
<script type="text/javascript" src="evento.js"></script>
<h2 style="text-align: center; font-family: Times; font-weight: bold;">Calendario Eventos</h2>
<form action="" method="POST" id="formularioGuardar" enctype="multipart/form-data">
	<div  align="center">
				<div class="panel-heading">
				    	<h3 class="panel-title">Ver Evento</h3>
				</div>
		  		<table class="table-bordered fondo-blanco margin-auto" style="width: 600px; height: 300px;">
					<tr>
						<input type="hidden" name="funcion" id="funcion" value="3">
						<input type="hidden" name="ide" id="ide" value="<?php echo $id ?>">
						<td><label style="margin-left: 5px;">Nombre Evento:</label></td><td><input class="form-control" type="text" for="email" name="nombre" id="nombre" value="<?php echo $evento ?>"></td>
					</tr>
					<tr>
						<td><label style="margin-left: 5px;">Descripción:</label></td><td><input class="form-control" type="text" for="email" name="descripcion" id="descripcion" value="<?php echo $descripcion ?>"</td>
					</tr>
					<tr>
						<td><label style="margin-left: 5px;">fecha:</label></td><td><input class="form-control" type="text" for="email" name="fecha" id="fecha" value='<?php echo $fecha_final?>' ></td>
					</tr>
					<tr>
						<td><label style="margin-left: 5px;">Hora:</label></td><td><input class="form-control" type="text" for="email" name="hora" id="hora" value='<?php echo $hora?>'></td>
					</tr>
					<tr>
				  		    <td><label style="margin-left: 5px;">Tipo:</label></td><td>
				  		   	    <select name="tipo" id="tipo" class="form-control">
				  		   	    	<?php
				  		   	    		if($tipo==1)
				  		   	    			echo "<option selected='selected'>Clases</option><option>Personal</option><option>Otro</option>";
				  		   	    		elseif ($tipo==2)
				  		   	    			echo "<option>Clases</option><option selected='selected'>Personal</option><option>Otro</option>";
				  		   	    		elseif ($tipo==3)
				  		   	    			echo "<option>Clases</option><option>Personal</option><option selected='selected'>Otro</option>";
				  		   	    		else
				  		   	    			echo "<option>Clases</option><option>Personal</option><option>Otro</option>";
				  		   	    	?>
								</select>
							</td>
				  	</tr>
					<tr align="center">
						<td><a href='index.php'>Volver</a></td>
						<td>
							<input class="btn btn-danger" type="button" name="eliminar" id="eliminar" id-data="<?php echo $id ?>" value="Eliminar">
							<input class="btn btn-primary" type="submit" id="guardar" value="Actualizar">
						</td>
					</tr>
				</table>
    </div>	
</form>