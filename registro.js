$(document).ready(function(){

    $(document).on('click', '#registrar', function(e){
    	e.preventDefault();
    	var usuario = $('#usuario').val();
    	var pass = $('#pass').val();

		var parametros = {
			usuario: usuario,
			password: pass
	    };
		$.post("registro.module.php", parametros, function(data){
			if(data == true)
			{
				swal({
					type: 'success',
					title: 'Registro Exitoso',
				}).then(function () {
					window.location='login.php?usuario=' + usuario; 
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