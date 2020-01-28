<?php
	session_start();
	if(@$_SESSION['id']): 
	include('header.php');
	require('config.php');

	$dia = $_REQUEST['dia'];
	$mes = $_REQUEST['mes'];
	$anio = $_REQUEST['anio'];

	if(strlen($dia)==1)$dia='0'.$dia;
	if(strlen($mes)==1)$mes='0'.$mes;

	$fecha = $dia.'/'.$mes.'/'.$anio;
	$fecha_sql = $anio.'-'.$mes.'-'.$dia;
?>

<h2 style="text-align: center; font-family: Times; font-weight: bold;">Agregar Evento</h2>
</br>
<div class="col-md-12">
	<form class="form-horizontal" action="" method="POST" id="formularioAgregar" enctype="multipart/form-data">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<input type="hidden" name="funcion" value="1">
					<div class="panel-heading">
				    	<h3 class="panel-title">Ingrese los datos del evento:</h3>
				 	</div>
				 		<div class="panel-body padding-30 padding-top-15 padding-bottom-15">
							<div class="form-group">
								<div class="col-sm-5">
									<label class="" for="nombre">Nombre:</label>
								</div>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="nombre"name="nombre" required="">
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-5">
									<label class="" for="nombre">Descripción:</label>
								</div>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="descripcion" name="descripcion" required>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-5">
									<label class="" for="nombre">Fecha:</label>
								</div>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="fecha" name="fecha" readonly="readonly" required value="<?php echo $fecha ?>">
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-5">
									<label class="" for="nombre">Hora:</label>
								</div>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="hora" name="hora" placeholder="Ej: 08:30" required>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-5">
									<label class="" for="nombre">Tipo:</label>
								</div>
								<div class="col-sm-7">
									<select name="tipo" id="tipo" class="form-control">
										<option>Clases/Trabajo</option>
										<option>Personal</option>
										<option>Otro</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-4">
									<button type="button" class="btn btn-danger btn-block" style="background-color: green;" id="cancelar">Volver</button>
								</div>		
								<div class="col-sm-4">
									
								</div>	
								<div class="col-sm-4">
									<button type="submit" class="btn btn-primary btn-block" id="agregar">Guardar</button>
								</div>						
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