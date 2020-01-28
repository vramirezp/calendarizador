$(document).ready(function ()
{
	//Agregar
	$(document).on('click', '#agregar', function(e){
    	e.preventDefault(); //Evitar que se envie el formulario hasta que procese todo el contenido
		var parametros = $('#formularioAgregar').serializeArray();
       
		if(ComprobarCampos(parametros) == true)
    	{
    		var hora = document.getElementById('hora').value;
    		var nombre = document.getElementById('nombre').value;
    		var desc = document.getElementById('descripcion').value;

    		if(comprobarHora(hora) == true)
    		{
    			if(comprobarNameDesc(nombre,desc) == true)
    			{
					$.post("evento.module.php", parametros, function(data){
						if(data == true)
						{
							swal({
								type: 'success',
								title: 'Agregado correctamente',
							}).then((result) => {
								parent.$.fancybox.close();

								var fecha = document.getElementById('fecha').value;
								var div = fecha.split('/');

		            			var dia = div[0];
		            			var mes = div[1];
		            			if(mes<10)mes=mes.substring(1,2);
		            			var anio = div[2];

		            			window.location="index.php?id=0&mes="+mes+"&anio="+anio;
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
				}
				else
				{
					swal({
					type: 'error',
					title: 'El nombre y la descripción no pueden contener comillas',
					});
				}
			}
			else
			{
				swal({
					type: 'error',
					title: 'Hora incorrecta',
				});
			}
		}
    });

    //Modificar
    $(document).on('click', '#guardar', function(e)
    {	
    	e.preventDefault();
		var parametros = $('#formularioGuardar').serializeArray();

		if(ComprobarCampos(parametros) == true)
    	{
    		var fecha = document.getElementById('fecha').value;

    		if(comprobarFecha(fecha) == true)
    		{
    			var hora = document.getElementById('hora').value;

    			if(comprobarHora(hora) == true)
    			{
    				var nombre = document.getElementById('nombre').value;
    				var desc = document.getElementById('descripcion').value;

    				if(comprobarNameDesc(nombre,desc) == true)
    				{
						$.post("evento.module.php", parametros, function(data){
							console.log(data);
							if (data == true) {
								swal({
									type: 'success',
									title: 'Modificado correctamente',
								}).then((result) => {
									parent.$.fancybox.close();
									var fecha = document.getElementById('fecha').value;
									var div = fecha.split('/');

			            			var dia = div[0];
			            			var mes = div[1];
			            			if(mes<10)mes=mes.substring(1,2);
			            			var anio = div[2];

			            			window.location="index.php?id=0&mes="+mes+"&anio="+anio;
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
					}
					else
					{
						swal({
							type: 'error',
							title: 'El nombre y la descripción no pueden contener comillas',
						});
					}
				}
				else
				{
					swal({
						type: 'error',
						title: 'Hora incorrecta',
					});
				}
			}
			else
			{
				swal({
						type: 'error',
						title: 'Fecha incorrecta',
				});
			}
		}
    });

    //Eliminar
    $(document).on('click', '#eliminar', function () {
		var idevento = $(this).attr('id-data');

		if(idevento>0)
    	{
    		var parametros = {
					funcion: 2,
					id: idevento
			};

			swal({  type: 'warning',
    		text: '¿Desea eliminar el registro?',
    		showCancelButton: true,
   			confirmButtonColor: '#DD6B55',
    		confirmButtonText: 'Si',
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false  }).then(() =>
			{ 
				$.post("evento.module.php", parametros, (data) => {
					swal({
						type: 'success',
						title: 'Eliminado correctamente',
					}).then(function () {

						var fecha = document.getElementById('fecha').value;
						var div = fecha.split('/');
		            	var dia = div[0];
		           		var mes = div[1];
		           		if(mes<10)mes=mes.substring(1,2);
		      			var anio = div[2];
		       			window.location="index.php?id=0&mes="+mes+"&anio="+anio;
					});
			    });
			});
    	}
	});

	//Agregar
	$(document).on('click', '#cancelar', function(e){
    	e.preventDefault(); 
    	var fecha = document.getElementById('fecha').value;
		var div = fecha.split('/');
		var dia = div[0];
		var mes = div[1];
		if(mes<10)mes=mes.substring(1,2);
		var anio = div[2];
		window.location="index.php?id=0&mes="+mes+"&anio="+anio;
    });
});

function ComprobarCampos(parametros)
{
	var puede = true;
	jQuery.each(parametros, function (i, campo) {
		if (campo.value.length == 0) {
			swal({
				type: 'error',
				title: 'Campos vacios, rellene',
			});
			puede = false;
		}
	});
	return puede;
}

function comprobarFecha(fecha)
{
    var puede = false;

    if(fecha.includes('/'))
    {
        var div = fecha.split('/');

        if(div.length==3)
        {
            var dia = div[0];
            var mes = div[1];
            var anio = div[2];

            if(anio.length==4 && dia.length==2 && mes.length==2)
            {
                if(isNaN(dia)==false && isNaN(mes)==false &&isNaN(anio)==false)
                {
                	if(dia<32 && dia>0 && mes<13 && mes>0)
                	{
                		return true;
                	}
                }
            }
        }
    }
    return puede;
}

function comprobarHora(hora)
{
    var puede = false;

    if(hora.includes(':'))
    {
        var div = hora.split(':');

        if(div.length==2)
        {
            var hor = div[0];
            var min = div[1];

            if(hor.length==2 && min.length==2)
            {
                if(isNaN(hor)==false && isNaN(min)==false)
                {
                	if(hor<25 && hor>-1 && min<60 && min>-1)
                	{
                		return true;
                	}
                }
            }
        }
    }
    return puede;
}

function comprobarNameDesc(nombre,desc)
{
	var puede = true

	if(nombre.includes("'") || desc.includes("'"))
	{
		puede = false;
	}

	if(nombre.includes('"') || desc.includes('"'))
	{
		puede = false;
	}

	return puede;
}