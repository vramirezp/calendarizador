$(document).ready(function(){

    $(document).on('click', '#registrar', function(e){
    	e.preventDefault();
    	var usuario = $('#usuario').val();
    	var antigua = $('#antigua').val();
    	var nueva = $('#nueva').val();

		var parametros = {
			usuario: usuario,
			antigua: antigua,
			nueva: nueva
	    };
		$.post("clave.module.php", parametros, function(data){
			if(data == true)
			{
				swal({
					type: 'success',
					title: 'Contraseña cambiada',
				}).then(function () {
					window.location='index.php'; 
				});
				
			}
			else
			{
				swal({
					type: 'error',
					title: data,
				});
			}
	    });
  
    });
});