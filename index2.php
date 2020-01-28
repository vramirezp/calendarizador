<?php
# definimos los valores iniciales para nuestro calendario

$year=date("Y");
$month=date("n");
$diaActual=date("j");

if(isset($_REQUEST['id']))
{
	$id = $_REQUEST['id'];
	$mes = $_REQUEST['mes'];
	//echo "<script>alert($mes.' '.$month);</script>";
	//$month = $mes++;
	
	if($id==1)$month=$month-1;
	if($id==2)$month=$month+1;
}
 
# Obtenemos el dia de la semana del primer dia
# Devuelve 0 para domingo, 6 para sabado
$diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
# Obtenemos el ultimo dia del mes
$ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));
 
$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

require('config.php');
?> 
	<!-- Style propio-->
	<link rel="stylesheet" type="text/css" href="style.css">
<body>
<h1 class="title" style="text-align: center;"><?php echo $meses[$month].' '.$year ?></h1>
<table id="calendar">	
	<tr>
		<th class='link'></th>
		<th class='link'></th>
		<th class='link'><a href="index.php?id=1&mes=$month">Anterior</a></th>
		<th class='link'><a href="index.php">Actual</a></th>
		<th class='link'><a href="index.php?id=2&mes=$month">Siguiente</a></th>
		<th class='link'></th>
		<th class='link'></th>
	</tr>
	<tr>
		<th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
		<th>Vie</th><th>Sab</th><th>Dom</th>
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
				echo "<td>&nbsp;</td>";
			}
			else
			{
				//Inicio de la celda
				echo "<td><div class='dia'><a href='agregarevento.php?dia=$day&mes=$month&anio=$year'>$day</a></div>";

				//Carga la base de datos
				$sqlCompleta = "SELECT * FROM evento";
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

						$clase='';

						if($tipo_ev==1)$clase='uno';
						if($tipo_ev==2)$clase='dos';
						if($tipo_ev==3)$clase='tres';

						if($day==$dia_ev && $month==$mes_ev && $year==$anio_ev)
						{
							//Evento del día
							echo "<a href='evento.php?id_evento=$id_ev' class='$clase'>$evento</br></a>";
						}
					}
				}

				//if($day==$diaActual) echo "<td class='hoy'><a href='evento.php' class='event'>$eventos</a> <div class='dia'>$day</div></td>";

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
</body>
</html>