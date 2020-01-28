<?php
	session_start();
	if(@$_SESSION['id']): 
	include('header.php');
?>
	<script type="text/javascript" src="clave.js"></script>

	<h2 style="text-align: center; font-family: Times; font-weight: bold;">Cambiar Contraseña</h2>
	</br> </br> </br>

<div class="col-md-12">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Ingrese los siguientes datos:</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form accept-charset="UTF-8" role="form">
                    <fieldset>
			    	  	<div class="form-group">
			    	  		<input class="form-control" name="user" id="user" type="hidden" value="<?php echo $_SESSION['user'] ?>">
			    		    <input class="form-control" placeholder="Contraseña Antigua" name="antigua" id="antigua" type="password">
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Nueva Contraseña" name="nueva" id="nueva" type="password">
			    		</div>
			    		
			    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Guardar" id="registrar">
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