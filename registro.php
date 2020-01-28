<?php
	session_start();
	if(!@$_SESSION['id']): 
	include('header.php');
?>
	<script type="text/javascript" src="registro.js"></script>
	<link rel="stylesheet" type="text/css" href="login.css">

	<div class="login-page">
    <div class="form"> 
    <h1><strong>Registrarse</strong></h1>
    <hr class="hr-abajo">    
      <form action="" method="POST" id="formularioLogin" enctype="multipart/form-data"
        <input type="hidden" name="funcion" value="1">
        <input class="inp" placeholder="Usuario, Max 18c" name="usuario" id="usuario" type="text">
		<input class="inp" placeholder="Contraseña, Max 30c" name="password" id="pass" type="password" value="">
		<input class="boton" type="submit" value="Registrar" id="registrar">
      </form>    
    </div>
  </div>
		    		    
<?php
	include('footer.php');
	else:
		echo "<script>window.location='index.php';</script>";
	endif;
?>