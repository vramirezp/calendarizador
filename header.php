<?php
	require('config.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Calendarizador</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<link rel="shortcut icon" href="icono.ico" type="image/x-icon">
	<link rel="icon" href="icono.ico" type="image/x-icon">

	<!-- Jquery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="jquery-1.3.2.min.js"></script>
	
	<!-- Bootstrap -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<!-- Font-Awesome Iconos -->
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" />

	<!-- Swal, es decir Sweet Alert -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.3/sweetalert2.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.3/sweetalert2.min.css" />

	<!-- Fancy box pantallas dinamicas -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js"></script>

	<!-- Style propio -->
	<link rel="stylesheet" type="text/css" href="style.css">

	<script type="text/javascript" src="evento.js"></script>

	<!-- PDF -->
	<script src="jspdf.min.js"></script>
	<script type="text/javascript" src="html2canvas.js"></script>
	<script type="text/javascript" src="pdf.js"></script>

	<script language="javascript">
		$(document).ready(function() {
			$(".botonExcel").click(function(event) {
				$("#datos_a_enviar").val( $("<div>").append( $("#calendar").eq(0).clone()).html());
				$("#FormularioExportacion").submit();
			});

			$(".botonWord").click(function(event) {
				$("#datos_a_enviar2").val( $("<div>").append( $("#calendar").eq(0).clone()).html());
				$("#FormularioExportacion2").submit();
			});
		});
	</script>
</head>

<nav class="navbar navbar-default border-bottom-0 border-abajo-celeste fondo-abajo-trans border-radius-0 barra-arriba fondoceleste" style="padding: 0px; padding-bottom: 10px; padding-left: 15px; padding-right: 15px;" role="navigation">
	<div class="container nav-inferior-padding">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="margin-top: 15px; margin-right: 0px;">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			</button>
			<div class="titulo-pagina fondo-arriba barra-arriba" style="padding: 0px;">
				<div align="left" style="padding-top: 15px; padding-bottom: 0px;"><a href="index.php" class="titulo-principal" style="color:#fff;"><img src="icono3.png" class="img-titulo"> Calendarizador</a></div>
			</div>
			<?php if(@$_SESSION['id']): ?>
  				
  			<?php else: ?>
  				
  			<?php endif; ?>
	    </div>

	    <div class="collapse navbar-collapse barra-arriba" id="myNavbar" style="padding-top: 10px; padding-top: 10px;">

		<ul class="nav navbar-nav navbar-right">
	<?php if(@$_SESSION['id']): ?>
		<li><a id="fondotro" href="index.php"><span class="fa fa-home"></span> Inicio</a></li>
		<li><a href="Calendarizador.pdf" id="fondotro" target="_blank"><i class="fa fa-question-circle"></i> Cómo Funciona</a></li>

		<li class="dropdown" id="fond">
			<a href="#" class="dropdown-toggle" id="fondotro" data-toggle="dropdown"><span class="fa fa-wrench"></span> Utilidades <b class="caret"></b></a>
			<ul class="dropdown-menu" id="fond">
				<li><a href="informes/GenerarPDF.php" id="fondotro"><i class="fa fa-calendar"></i> Calendario PDF</a></li>
				<?php if(array_pop(explode('/', $_SERVER['PHP_SELF'])) == 'index.php'): ?>
					<li><a href="#" onclick="genPDF()" id="fondotro"><i class="fa fa-file-pdf-o"></i> Exportar a PDF</a></li>
					<li><a href="#" class="botonExcel" id="fondotro"><i class="fa fa-file-excel-o"></i> Exportar a Excel</a></li>
						<form action="ficheroExcel.php" method="post" id="FormularioExportacion">
							<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
						</form>
					<li><a href="#" class="botonWord" id="fondotro"><i class="fa fa-file-word-o"></i> Exportar a Word</a></li>
						<form action="ficheroWord.php" method="post" id="FormularioExportacion2">
							<input type="hidden" id="datos_a_enviar2" name="datos_a_enviar2" />
						</form>
				<?php endif; ?>
				<li><a href="https://play.google.com/store/apps/details?id=com.inforconce.usuario.calendarizador" id="fondotro"><i class="fa fa-download"></i> Descargar App</a></li>
			</ul>
		</li>

		<li class="dropdown" id="fond">
			<a href="#" class="dropdown-toggle" id="fondotro" data-toggle="dropdown"><span class="fa fa-user"></span> Cuenta <b class="caret"></b></a>
			<ul class="dropdown-menu" id="fond">
				<li><a href="salir.php" id="fondotro"><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>
				<li><a href="clave.php" id="fondotro"><i class="fa fa-key"></i> Cambiar Contraseña</a></li>
				<li><a href="eliminar.php" id="fondotro" style="color: #FF8585;"><i class="fa fa-trash"></i> Eliminar Cuenta</a></li>
			</ul>
		</li>
	<?php else: ?>
		<li><a id="fondotro" href="login.php"><span class="fa fa-sign-in"></span> Iniciar sesión</a></li>
		<li><a id="fondotro" href="Calendarizador.pdf" target="_blank"><i class="fa fa-question-circle"></i> Cómo Funciona</a></li>
		<li><a id="fondotro" href="registro.php" style="color: #FF8585;"><i class="fa fa-user"></i> ¿No tienes una cuenta? REGÍSTRATE</a></li>
	<?php endif; ?>

		</ul>
	</div>
	</div>
</nav>

<body>