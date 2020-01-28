<?php
	require('config.php');

   require_once('Mobile_Detect.php');
    $detect = new Mobile_Detect();

   if (!$detect->isMobile()) {
      echo "<script>window.location='index.php';</script>";
   }

   require_once('Mobile_Detect.php');
   $detect = new Mobile_Detect();
   
   if (!$detect->isMobile()) {
   //echo "<script>window.location='index.php';</script>";
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
   
   # Obtenemos el dia de la semana del primer dia
   # Devuelve 0 para domingo, 6 para sabado
   $diaSemana=date("w",mktime(0,0,0,$month,1,$year));
   # Obtenemos el ultimo dia del mes
   $ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));
   
   $meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
   "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
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

   <!-- Style propio-->
   <link rel="stylesheet" type="text/css" href="style2.css">
   <script type="text/javascript" src="evento.js"></script>
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
            <li><a href="informes/GenerarPDF.php" id="fondotro" target="_blank"><i class="fa fa-calendar"></i> Calendario PDF</a></li>
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

</br>
<h1 class="title" style="text-align: center; font-family: Times; font-weight: bold; margin: auto; font-size: 40px;"><?php echo $meses[$month].' '.$year ?></h1>
<br><br>
<div class="col-xs-12 wid" style="margin-bottom: 5px;">
   <div class="wid text-center" style="width: 100%;">  
   	<a href="indexmobile.php?id=1&mes=$mes" class="pull-left" style="font-size: 18px;"><i class="fa fa-arrow-left"></i><strong> Anterior </strong></a></tr>
      <a href="indexmobile.php" style="font-size: 18px;"><strong> Actual </strong></a>
      <a href="indexmobile.php?id=2&mes=$mes" class="pull-right" style="font-size: 18px;"><strong> Siguiente </strong><i class="fa fa-arrow-right"></i></a>
   </div>
   
      <div class"filacolor">
         <?php
            $last_cell=$diaSemana+$ultimoDiaMes;
            $daysem = 'L';
            $diasem = $diaSemana;
            
            // hacemos un bucle hasta 42, que es el m�ximo de valores que puede
            // haber... 6 columnas de 7 dias
            for($i=1;$i<=42;$i++)
            {
               if($diasem==8)$diasem=1;

               if($diasem==1){$daysem='Lunes';}
               if($diasem==2){$daysem='Martes';}
               if($diasem==3){$daysem='Miércoles';}
               if($diasem==4){$daysem='Jueves';}
               if($diasem==5){$daysem='Viernes';}
               if($diasem==6){$daysem='Sábado';}
               if($diasem==7){$daysem='Domingo';}
               

            	if($i==$diaSemana)
            	{
            		// determinamos en que dia empieza
            		$day=1;
            	}
            	if($i<$diaSemana || $i>=$last_cell)
            	{
            	}
            	else
            	{
                  if ($day%2==0) $clase = 'a'; else $clase = 'b';
            		//Inicio de la celda
            		if($day==$diaActual && $monthActual==$month)echo "<div class='hoy eventos $clase'><div class='dia'><a class 'fila' href='agregarevento.php?dia=$day&mes=$month&anio=$year'>$day</a><div class='daysem'>$daysem</div></div>";
            		else echo "<div class='eventos $clase'><div class='dia'><a class 'fila' href='agregarevento.php?dia=$day&mes=$month&anio=$year'>$day</a><div class='daysem'>$daysem</div></div>";
            
            		//Carga la base de datos
            		$sqlCompleta = "SELECT * FROM evento WHERE us_user = '".$_SESSION['usuario']."'";
            		$sql = mysqli_query($conexion, $sqlCompleta);

                  $cont = 0;
            
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
                          if ($cont%2==0) $clase2 = 'ab'; else $clase2 = 'bb';
            					//Evento del día
            					echo "<div class='$clase2'><a href='evento.php?id_evento=$id_ev' class='$clase'>$evento</br></a></div>";
            				}

                        $cont++;
            			}
            		}
            
            		//Dia y fin de la celda
            		echo "</div>";
            			
            		$day++;
                  $diasem++;
            	}     
            }
            ?>
            <br><br>
      </div>
</div>
<script src="stacktable.js"></script>
<script>
   $('#ca').stacktable();
</script>
<?php
   include('footer.php');
   else:
   	echo "<script>window.location='login.php';</script>";
   endif;
?>