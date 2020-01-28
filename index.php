<?php
    include('header.php');

    require_once('Mobile_Detect.php');
    $detect = new Mobile_Detect();

	if ($detect->isMobile())
	{
		if(isset($_SESSION['mes']) && isset($_SESSION['anio']))
		{
			$mesmobile=$_SESSION['mes'];
			$aniomobile=$_SESSION['anio'];

			echo "<script>window.location='indexmobile.php?id=0&mes=$mesmobile&anio=$aniomobile';</script>";
		}
		else
		{
			echo "<script>window.location='indexmobile.php';</script>";
		}
	}

	if(@$_SESSION['id']):

	# definimos los valores iniciales para nuestro calendario
	$year=date("Y");
	$month=date("n");
	$diaActual=date("j");
	$monthActual=date("n");

	if(isset($_REQUEST['id']))
	{
		$id = $_REQUEST['id'];
		$mes = $_SESSION['mes'];
		$anio = $_SESSION['anio'];

		$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

		if($id==1)
		{
			if(!$pageWasRefreshed)
			{
				if($mes==1)
				{
					$mes=12;
					$anio=$anio-1;
				}
				else
				{
					$mes=$mes-1;
				}
			}
		}

		if($id==2)
		{
			if(!$pageWasRefreshed)
			{
				if($mes==12)
				{
					$mes=1;
					$anio=$anio+1;
				}
				else
				{
					$mes=$mes+1;
				}
			}
		}

		if($id==0)
		{
			$mes=$_REQUEST['mes'];
			$anio=$_REQUEST['anio'];
		}

		$_SESSION['mes']=$mes;
		$_SESSION['anio']=$anio;

		$year=$anio;
		$month=$mes;
	}
	else
	{
		$_SESSION['mes']=$month;
		$_SESSION['anio']=$year;
	}
	 
	

	# Obtenemos el ultimo dia del mes
	$ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));

	# Obtenemos el dia de la semana del primer dia
	# Devuelve 0 para domingo, 6 para sabado
	$diaSemana=date("w",mktime(0,0,0,$month,1,$year));
	$colum=7;

	if($ultimoDiaMes == 31)
	{
		if($diaSemana == 6 || $diaSemana == 7)
		{
			$colum=0;
		}
	}
	elseif($ultimoDiaMes == 30)
	{
		if($diaSemana == 7)
		{
			$colum=0;
		}
	}

	$diaSemana=date("w",mktime(0,0,0,$month,1,$year))+$colum;
	 
	$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
	"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
?> 

	<!-- INICIO DEL HEADER
<title>Calendario Organizador</title>
<meta charset="utf-8">
<link rel="shortcut icon" href="icono.ico" type="image/x-icon">
<link rel="icon" href="icono.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="style.css">

<nav class="navbar border-bottom-0 border-abajo-celeste fondo-abajo-trans border-radius-0" role="navigation">
<ul class="nav navbar-nav navbar-right nav-inferior" style="padding:1px 20px;">
	<?php if(@$_SESSION['id']): ?>
		<li><a href="salir.php"><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>
	<?php else: ?>
		<li><a href="registro.php" style="font-size: 15px; color: red;">¿No tienes una cuenta? REGISTRATE</a></li>
		<li><a href="login.php"><span class="fa fa-sign-in"></span> Iniciar sesión</a></li>
	<?php endif; ?>
</ul>
</nav>

<body background="fondo2.jpg">
	FIN DEL HEADER-->

	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="stacktable.css">
</br>
<input type="hidden" id="nombredoc" name="nombredoc" value="<?php echo $meses[$month].' '.$year ?>">
<h1 class="title" style="text-align: center; font-family: Times; font-weight: bold; margin: auto; font-size: 40px;"><?php echo $meses[$month].' '.$year ?></h1>
<br>
<div class="col-xs-12">

<table class="text-center" id="c">	
	<tr>
		<th class='link'></th>
		<th class='link'></th>
		<th class='link'><a href="index.php?id=1&mes=$mes"> <i class="fa fa-arrow-left"></i> Anterior</a></th>
		<th class='link'><a href="index.php">Actual</a></th>
		<th class='link'><a href="index.php?id=2&mes=$mes">Siguiente <i class="fa fa-arrow-right"></i></a></th>
		<th class='link'></th>
		<th class='link'></th>
	</tr>
</table>

<table id="calendar" border="1" cellpadding="10" cellspacing="0" bordercolor="#666666">	
	<tr>
		<th style="background: #255C9F; color: white; font-size: 20px;" class="semana">Lunes</th>
		<th style="background: #255C9F; color: white; font-size: 20px;" class="semana">Martes</th>
		<th style="background: #255C9F; color: white; font-size: 20px;" class="semana">Miércoles</th>
		<th style="background: #255C9F; color: white; font-size: 20px;" class="semana">Jueves</th>
		<th style="background: #255C9F; color: white; font-size: 20px;" class="semana">Viernes</th>
		<th style="background: #255C9F; color: white; font-size: 20px;" class="semana">Sábado</th>
		<th style="background: #255C9F; color: white; font-size: 20px;" class="semana">Domingo</th>
	</tr>
	<tr bgcolor="silver">
		<?php
		$last_cell=$diaSemana+$ultimoDiaMes;

		// hacemos un bucle hasta 42, que es el m�ximo de valores que puede
		// haber... 6 columnas de 7 dias
		for($i=1;$i<=42;$i++)
		{
			if($i==$diaSemana)
			{
				// determinamos en que dia empieza
				$day=1;
			}
			if($i<$diaSemana || $i>=$last_cell)
			{
				// celca vacia
				echo "<td style='background: white; color: white;'>&nbsp;</td>";
			}
			else
			{
				//Inicio de la celda
				if($day==$diaActual && $monthActual==$month)echo "<td valign='top' style='height: 80px; background: #B9F0F1; font-size: 20px;' class='hoy eventos'><div font-size: 20px;' class='dia'><a style='text-decoration: none; font-size: 20px; hover{color:#000; text-decoration: underline;}' href='agregarevento.php?dia=$day&mes=$month&anio=$year'>$day</a></div>";
				else echo "<td valign='top' style='height: 80px; background: white; font-size: 20px;' class='eventos'><div class='dia'><a style='text-decoration: none; hover{color:#000; text-decoration: underline;}' href='agregarevento.php?dia=$day&mes=$month&anio=$year'>$day</a></div>";

				//Carga la base de datos
				$sqlCompleta = "SELECT * FROM evento WHERE us_user = '".$_SESSION['usuario']."'";
				$sql = mysqli_query($conexion, $sqlCompleta);

				if($sql->num_rows > 0)
				{
					while($dato = $sql->fetch_assoc()) 
					{
						$id_ev    = $dato['ev_id'];
						$evento   = $dato['ev_nombre'];
						$fecha_ev = $dato['ev_fecha'];
						$tipo_ev  = $dato['ev_tipo'];
						$anio_ev  = substr($fecha_ev, 0,4);
						$mes_ev   = substr($fecha_ev,5,2);
						$dia_ev   = substr($fecha_ev,8,2);

						$clase='uno';

						if($tipo_ev==1)$clase='uno';
						if($tipo_ev==2)$clase='dos';
						if($tipo_ev==3)$clase='tres';

						if($day==$dia_ev && $month==$mes_ev && $year==$anio_ev)
						{
							//Evento del día
							echo "<a style='text-decoration: none; hover{color:#000; text-decoration: underline;}' href='evento.php?id_evento=$id_ev' class='$clase'>$evento</br></a>";
						}
					}
				}

				//Dia y fin de la celda
				echo "</td>";
					
				$day++;
			}
			// cuando llega al final de la semana, iniciamos una columna nueva
			if($i%7==0)
			{
				echo "</tr><tr>\n";
			}
		}
	?>
	</tr>
</table>

<br><br>
</div>

<?php
	include('footer.php');
	else:
		echo "<script>window.location='login.php';</script>";
	endif;
?>

<script type="text/javascript">
	function tableToExcel(table, name, filename) {
        let uri = 'data:application/vnd.ms-excel;base64,', 
        template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><title></title><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>', 
        base64 = function(s) { return window.btoa(decodeURIComponent(encodeURIComponent(s))) },         format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; })}
        
        if (!table.nodeType) table = document.getElementById(table)
        var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}

        var link = document.createElement('a');
        link.download = document.getElementById("nombredoc").value;
        link.href = uri + base64(format(template, ctx));
        link.click();
}
</script>>