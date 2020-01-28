<?php 
	session_start();
	if(!@$_SESSION['id']):
	include('header.php');
?>

<script type="text/javascript" src="login.js"></script>
<link rel="stylesheet" type="text/css" href="login.css">

  <div class="login-page">
    <div class="form"> 
    <h1><strong>Iniciar Sesión</strong></h1>
    <hr class="hr-abajo">    
      <form action="" method="POST" id="formularioLogin" enctype="multipart/form-data"
        <input type="hidden" name="funcion" value="1">
        <input class="inp" placeholder="Usuario" id="usuario" value="<?php echo @$_GET['usuario']; ?>" name="usuario" type="text">
        <input class="inp" type="password" name="pass" placeholder="Contraseña" id="pass" name="password" type="password" value="">
        <input class="boton" id="ingresar" type="submit" value="Ingresar">
      </form>    
    </div>
  </div>
<?php
	include('footer.php');
	else:
		echo "<script>window.location='index.php';</script>";
	endif;
?>