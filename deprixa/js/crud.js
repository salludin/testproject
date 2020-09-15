// Funciones principales del módulo CRUD //
$(document).ready(function(e) {
//Funcion "notificar" para mostrar notificaiones recibe 2 variables uno el mensaje y el otro el estilo de mensaje
function notificar(mensaje,tipo){
	// estilo de mensaje satisfactorio "success"
	if(tipo=='ok'){
		$.notify({	// plugin bootstrap-notify más información en: http://bootstrap-growl.remabledesigns.com/
			icon: 'glyphicon glyphicon-ok-sign', // icono se puede usar de bootstrap o font-awesome				
			message: mensaje
		},{
			element: 'body',
			offset: 31, // posicion en px x,y
			spacing: 10, // espacio del div contenedor
			placement: { // posicion para mostrar mensaje
				from: "top",
				align: "center" 
			},
			type: 'success', // estilo de mensaje "succes,info,danger,warning"
			delay: 1000 // tiempo en mili segundos que permance visible la notificaci{on
		});
	}
	// estilo de mensaje error "danger"
	if(tipo=='error'){
		$.notify({   
			icon: 'glyphicon glyphicon-remove-sign',				
			message: mensaje
		},{
			element: 'body',
			offset: 31,
			spacing: 10,
			placement: {
				from: "top",
				align: "center"
			},
			z_index: 10031,
			type: 'danger',
			delay: 2000
		});
	}
	// estilo de mensaje información "info"
	if(tipo=='info'){
		$.notify({
			icon: 'glyphicon glyphicon-info-sign',				
			message: mensaje
		},{
			element: 'body',
			offset: 31,
			spacing: 10,
			placement: {
				from: "top",
				align: "center"
			},
			type: 'info',
			delay: 2000
		});
	}
	//* aqui podras seguir agregando más notificaciones perzonalizadas, recuerda revisar la documentación de los plugins. *//
	
}

//* inicio y configuración de data tables más información en: https://datatables.net/   *//
var treload = $('#tabla-usuarios').DataTable({
	dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "plugins/DataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf", // ruta del complemento flash necesario para las exportaciones
			
            "aButtons": [ // configuración de botones
                {
                    "sExtends": "copy",
                    "sButtonText": "Copy", // texto personalizado
					"fnComplete": function() { // mensaje personalizado 
								this.fnInfo( '<h3>Copied Table</h3>\
									<p>Use Ctrl + v to paste the copied.</p>',
									2500 // tiempo en milisegundos que se muestra visible el mensaje
								);
				},
					"mColumns": [ 0, 1, 2, 3, 4 ] // columnas que seran copiadas
					
                },
                {
                    "sExtends": "csv",
                    "sButtonText": "CSV",
					"mColumns": [ 0, 1, 2, 3, 4 ]
                },
				{
                    "sExtends": "xls",
                    "sButtonText": "Exel",
					"mColumns": [ 0, 1, 2, 3, 4 ]
                },
                {
                    "sExtends": "pdf",
                    "sButtonText": "PDF",
					"mColumns": [ 0, 1, 2, 3, 4 ]
                },
				{
                    "sExtends": "print",
                    "sButtonText": "Print",
					"sInfo": "<H2> print view </ h2> <br> Use the print function of your browser or Ctrl + P. precione Press escape to exit. " // mensaje personalizado
                }
				
				
            ]
        
            
        
        }, // fin de configurar botones tabletools
	"oLanguage": {
      			"sUrl": "plugins/dataTables/dataTables.spanish.txt"  // idioma español para data tables
    },
	
	"columnDefs": [ { // insertamos las operaciones en la posición 5 al final de la tabla
    "targets": 6,
    "data": "id", // campo a recuperar en esta columnas id del usuario
    "render": function ( data, type, full ) { // renderisado de datos creamos los botones de editar, estado y eliminar
      return '<button type="button" class="btn btn-sm btn-default editar" id="'+full['id']+'" data-toggle="modal" data-target="#editar"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-sm btn-default estado" id="'+full['id']+'"><i class="fa fa-shield"></i></button> <button type="button" class="btn btn-sm btn-default eliminar" id="'+full['id']+'"><i class="fa fa-trash"></i></button>';
    }	
  	
	}
	
	 ],
	ajax: { // configuración ajax
            "url": "settings/add-offices/listar.php",
            "type": "GET",
			"dataSrc": ""
    },
				
    columns: [ // columnas que seran mostradas este debe ser igual a la cantidad de <theads> de la tabla
        
        { data: 'off_name' }, // recuperamos y mostramos 
        { data: 'address' },
		{ data: 'city' },
		{ data: 'ph_no' },
		{ data: 'office_time' },
		{ "mRender": function ( data, type, full ) { // renderisado de datos segun al estado del usuario mostramos un mensaje y estilo diferentes
			if(full['estado']==1){
				return '<span class="label label-success">Active</span>';
			}
			else{
				return '<span class="label label-danger">Inactive</span>';
			}
        
		}} 
    ]
} );
// fin del plugin data tables

// añadir estilos a los otones de exportación
var tt = new $.fn.dataTable.TableTools( treload ); // buscamos la extensión table tools
$( tt.fnContainer() ).insertBefore('div.dataTables_wrapper'); // insertamos un estilo para hacer flotar a la derecha los botones de exportar

// agregar foco al campo de texto nombre en modal nuevo usuario, cuando la ventana modal este visible
$('#nuevo').on('shown.bs.modal', function (event) {
  $('#formularioNuevo')[0].reset();	// reseamos el formulario para añadir un nuevo registro
  $('#formularioNuevo [name=nombre]').focus();
});

// agregamos foco al compo de texto nombre en modal editar usuario , cuando la ventana modal este visible
$('#editar').on('shown.bs.modal', function (event) {
  $('#edit_nombre').focus();
});

// funcion para recargar o refrescar la table
$(document).on("click", '#recarga', function (event) {
 treload.ajax.reload();
});

//function para guardar usuario en la BD
$('#guardarNuevo').click(function (event) {
var datos = $('#formularioNuevo').serialize();	// recuperamos todos los campos del formulario

			$.ajax ({ // configuraci{on de ajax
            type: "POST",
            url: "settings/add-offices/agregar.php",
            data: datos,
			dataType:"json"
        	}).done(function(data){
					// switch procesa todos los mensajes del servidor
					switch(data.msg){
						case 'ok':
						//cerramos la ventana modal nuevo usuario
						$('#nuevo').modal('toggle');
						// mostramos una notificación satisfactoria
						notificar("The user was successfully registered in the database.","ok");
						//recargamos la tabla
						treload.ajax.reload();
						
						break;
						
						case 'nomvacio':
						// mostramos una notificación de error
						notificar("Error the Office field is required.","error");
						//añadimos una clase error al campo nombre
						$('#gnombre').addClass('has-error');
						
						break;
						
						case 'apevacio':
						notificar("Error the Address field is required.","error");
						//añadimos una clase error al campo nombre
						$('#gapellido').addClass('has-error');
						
						break;
						
						case 'telvacio':
						notificar("Error the City field is required.","error");
						//añadimos una clase error al campo nombre
						$('#gtelefono').addClass('has-error');
						
						break;
						
						case 'emavaci':
						notificar("Error the Phone field is required.","error");
						//añadimos una clase error al campo nombre
						$('#gemail').addClass('has-error');
						
						break;
						
						case 'usuvacio':
						notificar("Error the Office Timing field is required","error");
						//añadimos una clase error al campo nombre
						$('#gusuario').addClass('has-error');
						
						break;
						
						case 'pasvacio':
						notificar("Error the Contact Person field is required.","error");
						//añadimos una clase error al campo nombre
						$('#gpassword').addClass('has-error');
						
						break;
						//* Aqui puedes añadir mas mensajes que provengan del servidor *//
						
					} // fin del switch 
        	}); // fin de ajax
}); // fin del evento click

// funcion para guardar editar usuario
$(document).on("click", '#actualizar', function (event) {
var datos = $('#formularioEditar').serialize(); // recuperamos todos los campos del formulario editar usuario
			$.ajax ({ // configuraci{on de ajax
            type: "POST",
            url: "settings/add-offices/actualizar.php",
            data: datos,
			dataType:"json"
        	}).done(function(data){
				if(data.msg=='ok'){
					//cerramos la ventana modal editar usuario
					$('#editar').modal('toggle');
					notificar(" Office data were updated correctly.","info");
        			treload.ajax.reload();
				}
				else{
					notificar(" Error could not update the data in the office.","error");
				}
        	});
});


// eventos de keypress formulario nuevo usuario sirve para mostrar error en campos de formulario si estos estan vacios método utilizando clases
$('.off_name').keypress(function(event){
	if($('.off_name').val().length>1){ // cantidad de caracteres mayor a 1
	//quitamos la clase error
	$('#gnombre').removeClass('has-error');	
	}
	else{
	//agregamos la clase error
	$('#gnombre').addClass('has-error');
	}
});

$('.address').keypress(function(event){
	if($('.address').val().length>1){
	//quitamos la clase error
	$('#gapellido').removeClass('has-error');	
	}
	else{
	//agregamos la clase error
	$('#gapellido').addClass('has-error');
	}
});

$('.city').keypress(function(event){
	if($('.city').val().length>1){
	//quitamos la clase error
	$('#gtelefono').removeClass('has-error');	
	}
	else{
	//agregamos la clase error
	$('#gtelefono').addClass('has-error');
	}
});

$('.ph_no').keypress(function(event){
	if($('.ph_no').val().length>1){
	//quitamos la clase error
	$('#gemail').removeClass('has-error');	
	}
	else{
	//agregamos la clase error
	$('#gemail').addClass('has-error');
	}
});

$('.office_time').keypress(function(event){
	if($('.office_time').val().length>1){
	//quitamos la clase error
	$('#gusuario').removeClass('has-error');	
	}
	else{
	//agregamos la clase error
	$('#gusuario').addClass('has-error');
	}
});

$('.contact_person').keypress(function(event){
	if($('.contact_person').val().length>1){
	//quitamos la clase error
	$('#gpassword').removeClass('has-error');	
	}
	else{
	//agregamos la clase error
	$('#gpassword').addClass('has-error');
	}
});

// eventos de keypress formulario editar usuario sirve para mostrar error en campos de formulario si estos estan vacios método utilizando ids

$('#edit_nombre').keypress(function(event){
	if($('#edit_nombre').val().length>1){
	//quitamos la clase error
	$('#Enombre').removeClass('has-error');	
	}
	else{
	//agregamos la clase error
	$('#Enombre').addClass('has-error');
	}
});

$('#edit_apellido').keypress(function(event){
	if($('#edit_apellido').val().length>1){
	//quitamos la clase error
	$('#Eapellido').removeClass('has-error');	
	}
	else{
	//agregamos la clase error
	$('#Eapellido').addClass('has-error');
	}
});

$('#edit_telefono').keypress(function(event){
	if($('#edit_telefono').val().length>1){
	//quitamos la clase error
	$('#Etelefono').removeClass('has-error');	
	}
	else{
	//agregamos la clase error
	$('#Etelefono').addClass('has-error');
	}
});

$('#edit_email').keypress(function(event){
	if($('#edit_email').val().length>1){
	//quitamos la clase error
	$('#Eemail').removeClass('has-error');	
	}
	else{
	//agregamos la clase error
	$('#Eemail').addClass('has-error');
	}
});

$('#edit_usuario').keypress(function(event){
	if($('#edit_usuario').val().length>1){
	//quitamos la clase error
	$('#Eusuario').removeClass('has-error');	
	}
	else{
	//agregamos la clase error
	$('#Eusuario').addClass('has-error');
	}
});
// fin de controles

//funcion para eliminar usuario
$(document).on("click", '.eliminar', function (event) {			
	var id = $(this).attr ("id"); // recuperamos la id del usuario
	
swal({ // plugin sweet alert más información en: http://t4t5.github.io/sweetalert/
  title: "¿Are you sure?", // título del alert
  text: "This office will be completely removed from the database", // texto del alert
  type: "warning", // estilo del alert
  showCancelButton: true, // mostrar botón de cancelar
  cancelButtonText: "Cancel", // texto alternativo del botón por defecto cancel
  confirmButtonColor: "#DD6B55", // color del botón confirmar
  confirmButtonText: "Yes, Delete", // texto del botón confirmar
  closeOnConfirm: false // cerrar alert al confirmar
},
function(){ // esta función se ejecuta cuando confirmamos  por si
	
	$.ajax ({ // configuración de ajax
				type: "POST",
				url: "settings/add-offices/eliminar.php",
				data: { "id" : id },
				dataType:"json"
				}).done(function(data){
					if(data.msg=='ok'){
					swal("Removed!", "The office was removed from the Database", "success"); // mostramos un mensaje en el mismo alert
					treload.ajax.reload(); // recargamos la tabla
					}
					else{
					notificar("Error Could not delete the office","error");
					}
				}); // fin de ajax
}); // fin de sweet alert
	

}); // fin del evento click

//funcion para cambiar de estado al usuario
$(document).on("click", '.estado', function (event) {			
	var id = $(this).attr ("id"); // recuperamos la id del usuario
	
swal({ // plugin sweet alert
  title: "¿Are you sure?",
  text: "It will change the officer status",
  type: "warning",
  showCancelButton: true,
  cancelButtonText: "Cancel",
  confirmButtonColor: "#5BC0DE",
  confirmButtonText: "Yes, Change",
  closeOnConfirm: false
},
function(){
	// esta funcion se ejecuta si aceptamos eliminar
	$.ajax ({ // configuración de ajax
				type: "POST",
				url: "settings/add-offices/estado.php",
				data: { "id" : id },
				dataType:"json"
				}).done(function(data){
					if(data.msg=='ok'){
					swal("Changed", "It is to change the Officer status.", "success");
					treload.ajax.reload();
					}
					else{
					notificar("Error failed to change the status of the office","error");
					}
				}); 
});
	

});

// función para recuperar datos del usuario a editar
$(document).on("click", '.editar', function (event) {
			var id = $(this).attr ("id"); // recuperamos la id del usuario	
			$('#id_user').val(id); // guardamos la id del usuario temporalmente en el campo oculto
			$.ajax ({ // configuración de ajax
            type: "POST",
            url: "settings/add-offices/editar.php",
            data: { "id":id },
			dataType: 'json'
        	}).done(function(data){
					// recuperamos y asignamos a los campos del formulario editar usuario
        			$('#formularioEditar input[name="id"]').val(data[0]['id']); // selección por id y atributo
					$('#formularioEditar input[name="off_name"]').val(data[0]['off_name']);
					$('#formularioEditar input[name="address"]').val(data[0]['address']);
					$('#formularioEditar input[name="city"]').val(data[0]['city']);
					$('#formularioEditar input[name="ph_no"]').val(data[0]['ph_no']);
					$('#formularioEditar input[name="office_time"]').val(data[0]['office_time']);
					$('#formularioEditar input[name="contact_person"]').val(data[0]['contact_person']);
					if(data[0].estado=='1'){ // marcamos o desmarcamos el check box activo según estado del usuario
					$('#estado').prop('checked', 'true');	
					
					}
					else{
					$('#estado').removeAttr('checked');		
					}		
        	}); // fin de ajax
}); // fin del evento click


//fin del document ready
});