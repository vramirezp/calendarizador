$(document).ready(function(){

    $(document).on('click', '#ingresar', function(e){
    	e.preventDefault();
    	/*var usuario = $('#usuario').val();
    	var pass = $('#pass').val();

		var parametros = {
			usuario: usuario,
			password: pass
	    };
		
		$.post("login.module.php", parametros, function(data){
			if(data == true)
			{
				swal({
					type: 'success',
					title: 'Inicio Exitoso',
				}).then(function () {
					//window.location="index.php";
				window.location.reload(true); 
				});
				
			}
			else
			{
				swal({
					type: 'error',
					title: data,
				});
			}
	    });*/

	    var parametros = $('#formularioLogin').serializeArray();

	    if(ComprobarCampos(parametros) == true)
    	{

		    var datos = new FormData();
			
				$.each(parametros, function(index, item) 
				{
					datos.append(item.name, item.value);
				});

		    $.ajax({				
				url : 'login.module.php',
				type: 'post',
				dataType: 'html',
				cache: false,
				processData: false,
				contentType:false,				
				data: datos,
				success: function(data) {

					if(data == true)
					{
						window.location.reload(true);	
					}
					else
					{						
						swal({
							type: 'error',
							html: data,
							title: 'Error',
						});				
					}
				}
			});
		}
    });
});

function ComprobarCampos(parametros)
{
	var puede = true;
	jQuery.each( parametros, function( i, campo ) {
		if(campo.value.length == 0) 
		{
			swal({
				type: 'error',
				html: 'Campos vacíos',
				title: 'Error:',
			});
			puede = false;
		}
	});
	return puede;
}