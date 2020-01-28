<?php
	session_start();
	if(@$_SESSION['id']): 
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

<h2 style="text-align: center; font-family: Times; font-weight: bold;">Revisar Evento</h2>
</br>
<div class="col-md-12">
<form class="form-horizontal" action="" method="POST" id="formularioGuardar" enctype="multipart/form-data">
<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			  		<input type="hidden" name="funcion" value="3">
			  		<input type="hidden" name="ide" value="<?php echo $id ?>">
			  		<div class="panel-heading">
					    	<h3 class="panel-title">Datos del evento:</h3>
					</div>
						<div class="panel-body padding-30 padding-top-15 padding-bottom-15">
							<div class="form-group">
								<div class="col-sm-5">
									<label class="" for="nombre">Nombre:</label>
								</div>
								<div class="col-sm-7">
									<input class="form-control" type="text" for="email" name="nombre" id="nombre" value="<?php echo $evento ?>">
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-5">
									<label class="" for="nombre">Descripción:</label>
								</div>
								<div class="col-sm-7">
									<input class="form-control" type="text" for="email" name="descripcion" id="descripcion" value="<?php echo $descripcion ?>">
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-5">
									<label class="" for="nombre">Fecha:</label>
								</div>
								<div class="col-sm-7">
									<input class="form-control" type="text" for="email" name="fecha" id="fecha" value='<?php echo $fecha_final?>' >
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-5">
									<label class="" for="nombre">Hora:</label>
								</div>
								<div class="col-sm-7">
									<input class="form-control" type="text" for="email" name="hora" id="hora" value='<?php echo $hora?>'>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-5">
									<label class="" for="nombre">Tipo:</label>
								</div>
								<div class="col-sm-7">
									<select name="tipo" id="tipo" class="form-control">
				  		   	    	<?php
				  		   	    		if($tipo==1)
				  		   	    			echo "<option selected='selected'>Clases/Trabajo</option><option>Personal</option><option>Otro</option>";
				  		   	    		elseif ($tipo==2)
				  		   	    			echo "<option>Clases/Trabajo</option><option selected='selected'>Personal</option><option>Otro</option>";
				  		   	    		elseif ($tipo==3)
				  		   	    			echo "<option>Clases/Trabajo</option><option>Personal</option><option selected='selected'>Otro</option>";
				  		   	    		else
				  		   	    			echo "<option>Clases/Trabajo</option><option>Personal</option><option>Otro</option>";
				  		   	    	?>
								</select>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-4">
									<button type="button" class="btn btn-danger btn-block" style="background-color: green;" id="cancelar">Volver</button>
								</div>	
	
								<div class="col-sm-4">
									<input class="btn btn-danger btn-block" type="button" name="eliminar" id="eliminar" id-data="<?php echo $id ?>" value="Eliminar">
								</div>

								<div class="col-sm-4">
									<button type="submit" class="btn btn-primary btn-block" name="guardar" id="guardar">Guardar</button>
								</div>						
							</div>
						</div>

			</div>
			</div>
    </div>	
</form>
</div>



</body>

<?php
	include('footer.php');
	else:
		echo "<script>window.location='index.php';</script>";
	endif;
?>