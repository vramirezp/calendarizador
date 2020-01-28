

$(document).ready(function(){
	//BORRAR CUENTA
	$(document).on('click', '#enviar', function(){

		var usuario = $('#user').val();

		var parametros = {
			user: usuario
	    };

		swal({  type: 'warning',
    		text: '¿Desea eliminar su cuenta de forma permanente?',
    		showCancelButton: true,
   			confirmButtonColor: '#DD6B55',
    		confirmButtonText: 'Si',
			cancelButtonText: 'No',
			closeOnConfirm: false,
			closeOnCancel: false  }).then(() =>
			{ 
				
				$.post('eliminar.module.php', parametros, (data) => {
						if(data=='1')
						{
							swal({
								type: 'success',
								title: 'Cuenta eliminada correctamente',
							}).then(function () {
								window.location='salir.php';
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
});
