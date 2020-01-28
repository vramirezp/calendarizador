<?php
	session_start();
	if(@$_SESSION['id']): 
	include('header.php');
?>
	<script type="text/javascript" src="eliminar.js"></script>

	<h2 style="text-align: center; font-family: Times; font-weight: bold;">Eliminar Cuenta</h2>
	</br> </br> </br>
<div class="col-md-12">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Se eliminarán todos sus eventos de manera permanente.</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form class="form-horizontal" action="" method="POST" id="formularioLogin" enctype="multipart/form-data">
	                    <fieldset>
	                    	<input class="form-control" name="user" id="user" type="hidden" value="<?php echo $_SESSION['usuario'] ?>">
			    			<input class="btn btn-danger pull-right" type="button" value="ELIMINAR" id="enviar" style="align: center;">
				    	</fieldset>
				    </form>
			    </div>
			</div>
		</div>
</div>
<?php
	include('footer.php');
	else:
		echo "<script>window.location='index.php';</script>";
	endif;
?>