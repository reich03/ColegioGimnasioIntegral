/*Author: Ing. Denis Ohara A. Cel: 67368741, email: dohara.system@gmail.com */


/* FUNCION JQUERY PARA VALIDAR ACCESO DE USUARIOS*/
$('document').ready(function() {
						   
	 $("#loginform").validate({
      rules:
	  {
			select: { required: true, },
			usuario: { required: true, },
			password: { required: true, },
			captcha1: { required: true, },
	   },
       messages:
	   {
		    select:{  required: "Seleccione Tipo de Usuario" },
		    usuario:{  required: "Por favor ingrese su Usuario de Acceso" },
			password:{  required: "Por favor ingrese su Clave de Acceso" },
			captcha1:{  required: "Ingrese C&oacute;digo" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* login submit */
	   function submitForm()
	   {		
			var data = $("#loginform").serialize();
				
			$.ajax({
				
			type : 'POST',
			url  : 'index.php',
			data : data,
			beforeSend: function()
			{	
				$("#error").fadeOut();
				
				 var n = noty({
                 text: "<span class='fa fa-refresh'></span> VERIFICANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 1000, });
                 //$("#btn-login").html('<i class="fa fa-refresh"></i> Verificando...');
			},
			success :  function(response)
			   {						
					if(response==1){ 
								 
								    $("#error").fadeIn(1000, function(){ 
			
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'error',
                 timeout: 5000, });
			     $("#btn-login").html('<i class="fa fa-sign-in"></i> Acceder');
				    
					                                                 });
			   
	                             } else if(response==2){
									 
									 $("#error").fadeIn(1000, function(){
			
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> EL C&Oacute;DIGO ES INCORRECTO, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'error',
                 timeout: 5000, });
			     $("#btn-login").html('<i class="fa fa-sign-in"></i> Acceder');
				 
				                                                        }); 
			   
					              } else if(response==3){
									 
									 $("#error").fadeIn(1000, function(){
			
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS DATOS INGRESADOS NO EXISTEN, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'error',
                 timeout: 5000, });
			     $("#btn-login").html('<i class="fa fa-sign-in"></i> Acceder');
				 
				                                                        }); 
			   
					              } else {
									  
									    $("#error").fadeIn(1000, function(){
				
				 $("#btn-login").html('<i class="fa fa-sign-in"></i> Acceder');
				 setTimeout(' window.location.href = "panel"; ',500);
				 
				                                                     });  
					}
			   }
		 });
				return false;
		}
	   /* login submit */
});





/* FUNCION JQUERY PARA VALIDAR ACCESO DE USUARIOS*/
$('document').ready(function()
{ 
						   
	 $("#lockscreen").validate({
      rules:
	  {
			select: { required: true, },
			usuario: { required: true, },
			password: { required: true, },
			captcha1: { required: true, },
	   },
       messages:
	   {
		    select:{  required: "Seleccione Tipo de Usuario" },
		    usuario:{  required: "Por favor ingrese su Usuario de Acceso" },
			password:{  required: "Por favor ingrese su Clave de Acceso" },
			captcha1:{  required: "Ingrese C&oacute;digo" },
       },
	   errorElement: "span",
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* login submit */
	   function submitForm()
	   {		
			var data = $("#lockscreen").serialize();
				
			$.ajax({
				
			type : 'POST',
			url  : 'lockscreen.php',
			data : data,
			beforeSend: function()
			{	
				$("#error").fadeOut();
				
				 var n = noty({
                 text: "<span class='fa fa-refresh'></span> VERIFICANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 1000, });
                 //$("#btn-login").html('<i class="fa fa-refresh"></i> Verificando...');
			},
			success :  function(response)
			   {						
					if(response==1){ 
								 
								    $("#error").fadeIn(1000, function(){ 
			
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'error',
                 timeout: 5000, });
			     $("#btn-login").html('<i class="fa fa-sign-in"></i> Acceder');
				    
					                                                 });
			   
	                             } else if(response==2){
									 
									 $("#error").fadeIn(1000, function(){
			
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> EL C&Oacute;DIGO ES INCORRECTO, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'error',
                 timeout: 5000, });
			     $("#btn-login").html('<i class="fa fa-sign-in"></i> Acceder');
				 
				                                                        }); 
			   
					              } else if(response==3){
									 
									 $("#error").fadeIn(1000, function(){
			
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS DATOS INGRESADOS NO EXISTEN, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'error',
                 timeout: 5000, });
			     $("#btn-login").html('<i class="fa fa-sign-in"></i> Acceder');
				 
				                                                        }); 
			   
					              } else {
									  
									    $("#error").fadeIn(1000, function(){
				
				 $("#btn-login").html('<i class="fa fa-sign-in"></i> Acceder');
				 setTimeout(' window.location.href = "panel"; ',500);
				 
				                                                     });  
					}
			   }
		 });
				return false;
		}
	   /* login submit */
});

 


/* FUNCION JQUERY PARA RECUPERAR CONTRASEÑA DE USUARIOS */	 
	 
$('document').ready(function()
{ 
     /* validation */
	$("#recuperarpassword").validate({
      rules:
	  {
			select: { required: true, },
			email: { required: true,  email: true  },
	   },
       messages:
 	   {
			select:{  required: "Seleccione Tipo de Usuario" },
			email:{  required: "Ingrese su Correo Electr&oacute;nico", email: "Ingrese un Correo Electr&oacute;nico V&aacute;lido" },
       },
	   errorElement: "span",
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	    /* form submit */
	  function submitForm()
	   {		
				var data = $("#recuperarpassword").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'index.php',
				data : data,
				beforeSend: function()
				{	
					$("#errorr").fadeOut();
					$("#btn-recuperar").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#errorr").fadeIn(1000, function(){ 
			
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'error',
                 timeout: 5000, });
			     $("#btn-recuperar").html('<span class="fa fa-check-square-o"></span> Recuperar Password');
				    
					                                                 });																			
								}
								else if(data==2)
								{
									
					$("#errorr").fadeIn(1000, function(){ 
			
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> EL CORREO INGRESADO NO FUE ENCONTRADO, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'error',
                 timeout: 5000, });
			     $("#btn-recuperar").html('<span class="fa fa-check-square-o"></span> Recuperar Password');
				    
					                                                 });
					
								} else {
										
									$("#errorr").fadeIn(1000, function(){
										
				$("#recuperarpassword")[0].reset();
				 var n = noty({
				 text: '<center> &nbsp; '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				 $("#btn-recuperar").html('<span class="fa fa-check-square-o"></span> Recuperar Password');	
				                                
												                      });
								       }
						   }
				});
			 return false;
		}
	   /* form submit */
});
/*  FIN DE FUNCION PARA RECUPERAR CONTRASEÑA DE USUARIOS */
 
 
 
 
 
 
 
 
 
 
 
 
/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CONTRASEÑA */	 
	 
$('document').ready(function()
{ 
								
     /* validation */
	 $("#updatepassword").validate({
      rules:
	  {
			usuario: {required: true },
			password: {required: true, minlength: 8},  
            password2:   {required: true, minlength: 8, equalTo: "#password"}, 
	   },
       messages:
	   {
            usuario:{  required: "Ingrese Usuario de Acceso" },
            password:{ required: "Ingrese su Nuevo Password", minlength: "Ingrese 8 caracteres como m&iacute;nimo" },
		    password2:{ required: "Repita su Nuevo Password", minlength: "Ingrese 8 caracteres como m&iacute;nimo", equalTo: "Este Password no coincide" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updatepassword").serialize();
				var id= $("#updatepassword").attr("data-id");
		        var codigo = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'password.php?codigo='+codigo,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){ 
			
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'error',
                 timeout: 5000, });
			     $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
				    
					                                                 });																			
								} else if(data==2){
									
					    $("#error").fadeIn(1000, function(){ 
			
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> NO PUEDE USAR LA CLAVE ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'error',
                 timeout: 5000, });
			     $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
				    
					                                                 });
					
								} else if(data==3) {
									
					    $("#error").fadeIn(1000, function(){ 
			
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LAS CLAVES INGRESADAS NO COINCIDEN, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'error',
                 timeout: 5000, });
			     $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
				    
					                                                 });
					
								} else {
										
									$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> &nbsp; '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				 $("#updatepassword")[0].reset();
				 $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');	
				                                
												                      });
								       }
						   }
				});
			 return false;
		}
	   /* form submit */
});
/* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CONTRASEÑA */
 
  
 
 
 
 
 
 
 
 
 












 
 
 






/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CONFIGURACION GENERAL */	 
	 
$('document').ready(function()
{ 
								
     /* validation */
	 $("#configuracion").validate({
      rules:
	  {
			ceddirector: { required: true, digits: true },
			director: { required: true, lettersonly: true },
			tlfdirec: { required: true, digits: false },
			correodirec: { required: true,  email : true },
			codinstituto: { required: true },
			nominstituto: { required: true },
			direcinstituto: { required: true},
			tlfinstituto: { required: true, digits: false },
			correoinstituto: { required: true,  email : true },
			inicioinscripcion: { required: true,  date : false },
			fininscripcion: { required: true,  date : false },
			trimestreactivo: { required: false },
			inicionotas: { required: true,  date : false },
			finnotas: { required: true,  date : false },
			diascrealapso: { required: true, number: true },
	   },
       messages:
	   {
            ceddirector:{ required: "Ingrese N&deg; de DNI de Director", digits: "Ingrese solo d&iacute;gitos para NIT/CI de Director" },
			director:{ required: "Ingrese Nombre de Director", lettersonly: "Ingrese solo letras para Nombre" },
			tlfdirec: { required: "Ingrese N&deg; de Tel&eacute;fono de Director", digits: "Ingrese solo d&iacute;gitos para Tel&eacute;fono de Director" },
			correodirec: { required: "Ingrese Correo de Director", email: "Ingrese un Correo v&aacute;lido" },
			codinstituto:{ required: "Ingrese NIT de Instituci&oacute;n" },
			nominstituto:{ required: "Ingrese Nombre de Instituci&oacute;n" },
			direcinstituto:{ required: "Ingrese Direcci&oacute;n de Instituci&oacute;n" },
			tlfinstituto: { required: "Ingrese N&deg; de Tel&eacute;fono de Instituci&oacute;n", digits: "Ingrese solo d&iacute;gitos para Tel&eacute;fono de Instituci&oacute;n" },
			correoinstituto: { required: "Ingrese Correo de Instituci&oacute;n", email: "Ingrese un Correo v&aacute;lido" },
			inicioinscripcion: { required: "Ingrese Inicio Proceso de Inscripci&oacute;n", date: "Ingrese una Fecha v&aacute;lida" },
			fininscripcion: { required: "Ingrese Fin Proceso de Inscripci&oacute;n", date: "Ingrese una Fecha v&aacute;lida" },
			trimestreactivo: { required: "Seleccione Bimestre Activo" },
			inicionotas: { required: "Ingrese Inicio de Registro de Notas", date: "Ingrese una Fecha v&aacute;lida" },
			finnotas: { required: "Ingrese Fin de Registro de Notas", date: "Ingrese una Fecha v&aacute;lida" },
			diascrealapso: { required: "Ingrese D&iacute;as para Crear Nuevo Periodo Escolar", number: "Ingrese solo n&uacute;meros Cantidad de D&iacute;as" },
           
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#configuracion").serialize();
				var id= $("#configuracion").attr("data-id");
		        var id = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'configuracion.php?id='+id,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
						$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'error',
                 timeout: 5000, });
				 $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
				 
				                                                      }); 
																				
								} else { 
								     
						$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'success',
                 timeout: 5000, });
				 $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');	
				                                
												                      });
							    }
					    }
			    });
		  return false;
	  }
	  /* form submit */	   
});
/* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CONFIGURACION GENERAL */
 






















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE USUARIOS */	 
	 
$('document').ready(function()
{ 
     /* validation */
	 $("#usuario").validate({
      rules:
	  {
			cedula: { required: true,  digits : true, minlength: 7 },
			nombres: { required: true, lettersonly: true },
			sexo: { required: true, },
			cargo: { required: true, },
			email: { required: true, email: true },
			usuario: { required: true, },
			password: {required: true, minlength: 8},  
            password2:   {required: true, minlength: 8, equalTo: "#password"}, 
			status: { required: true, },
			nivel: { required: true, },
	   },
       messages:
	   {
           cedula:{ required: "Ingrese N&deg; de DNI de Usuario", digits: "Ingrese solo d&iacute;gitos para C&eacute;dula", minlength: "Ingrese 7 d&iacute;gitos como m&iacute;nimo" },
			nombres:{ required: "Ingrese Nombre Completo de Usuario" },
            sexo:{ required: "Seleccione Sexo de Usuario" },
			cargo: { required: "Ingrese Cargo de Usuario" },
			email:{  required: "Ingrese Email de Usuario", email: "Ingrese un Email V&aacute;lido" },
			usuario:{ required: "Ingrese Usuario de Acceso" },
			password:{ required: "Ingrese Password de Acceso", minlength: "Ingrese 8 caracteres como m&iacute;nimo" },
		    password2:{ required: "Repita Password de Acceso", minlength: "Ingrese 8 caracteres como m&iacute;nimo", equalTo: "Este Password no coincide" },
			status:{ required: "Seleccione Status de Usuario" },
			nivel:{ required: "Seleccione Nivel de Acceso" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#usuario").serialize();
				var formData = new FormData($("#usuario")[0]);
				
				$.ajax({
				type : 'POST',
				url  : 'forusuario.php',
				data : formData,
				//necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> YA EXISTE UN USUARIO CON ESTE N&deg; DE DNI, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}
								else if(data==3){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE CORREO ELECTR&Oacute;NICO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
											
									});
								}
								else if(data==4)
								{
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE USUARIO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');

									});
								}
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				 $("#usuario")[0].reset();
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE USUARIOS *//*  FIN DE FUNCION PARA VALIDAR REGISTRO DE USUARIOS */


/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE USUARIOS */	 	 
$('document').ready(function()
{ 
     /* validation */
	 $("#updateusuario").validate({
      rules:
	  {
			cedula: { required: true,  digits : true, minlength: 7 },
			nombres: { required: true, lettersonly: true },
			sexo: { required: true, },
			cargo: { required: true, },
			email: { required: true, email: true },
			usuario: { required: true, },
			password: {required: true, minlength: 8},  
            password2:   {required: true, minlength: 8, equalTo: "#password"}, 
			status: { required: true, },
			nivel: { required: true, },
	   },
       messages:
	   {
           cedula:{ required: "Ingrese N&deg; de DNI de Usuario", digits: "Ingrese solo d&iacute;gitos para C&eacute;dula", minlength: "Ingrese 7 d&iacute;gitos como m&iacute;nimo" },
			nombres:{ required: "Ingrese Nombre Completo de Usuario" },
            sexo:{ required: "Seleccione Sexo de Usuario" },
			cargo: { required: "Ingrese Cargo de Usuario" },
			email:{  required: "Ingrese Email de Usuario", email: "Ingrese un Email V&aacute;lido" },
			usuario:{ required: "Ingrese Usuario de Acceso" },
			password:{ required: "Ingrese Password de Acceso", minlength: "Ingrese 8 caracteres como m&iacute;nimo" },
		    password2:{ required: "Repita Password de Acceso", minlength: "Ingrese 8 caracteres como m&iacute;nimo", equalTo: "Este Password no coincide" },
			status:{ required: "Seleccione Status de Usuario" },
			nivel:{ required: "Seleccione Nivel de Acceso" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	  /* form submit */
	  function submitForm()
	   {		
				var data = $("#updateusuario").serialize();
				var formData = new FormData($("#updateusuario")[0]);
				var id= $("#updateusuario").attr("data-id");
		        var codigo = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'forusuario.php?codigo='+codigo,
				data : formData,
				//necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> YA EXISTE UN USUARIO CON ESTE N&deg; DE DNI, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}
								else if(data==3){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE CORREO ELECTR&Oacute;NICO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
											
									});
								}
								else if(data==4)
								{
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE USUARIO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');

									});
								}
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'success',
                 timeout: 5000, });
				 $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
				 setTimeout("location.href='usuarios'", 15000);
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE USUARIOS */
 
 


 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
/* FUNCION JQUERY PARA VALIDAR REGISTRO DE PERIODO ESCOLAR */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#periodoescolar").validate({
      rules:
	  {
			periodo: { required: true },
			descripcion: { required: true },
			cuotaunica: { required: true, number: true },
			interesmora: { required: true, number: true },
			diasvence: { required: true },
			password: { required: true },
	   },
       messages:
	   {
            periodo:{ required: "Ingrese Periodo Escolar" },
			descripcion:{ required: "Ingrese Descripci&oacute;n de Perido Escolar"},
			cuotaunica: { required: "Ingrese Monto de Cuota Unica", number: "Ingrese solo n&uacute;meros para Cuota Unica" },
			interesmora: { required: "Ingrese Inter&eacute;s por Mora en Pago", number: "Ingrese solo n&uacute;meros para Inter&eacute;s por Mora" },
			diasvence:{ required: "Seleccione D&iacute;a para Vencimiento de Pago"},
			password: { required: "Ingrese Password de Administrador" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#periodoescolar").serialize();
				var periodo = $("#periodo").val();

      if ($('input[type=checkbox]:checked').length === 0) {
	 
	            alert('DEBE DE SELECCIONAR AL MENOS UN MES PARA PAGOS');
         
                return false;
	 
	  } else {
				
				$.ajax({
				
				type : 'POST',
				url  : 'forperiodo.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-refresh"></span> Verificar Password');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> EL PASSWORD INGRESADO NO ES EL CORRECTO, POR FAVOR DEBER&Aacute; DE CREARLO PARA PROCESAR ARQUEOS ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}  
								else if(data==3){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> A&Uacute;N NO PUEDE CREAR PERIODO ESCOLAR, FALTAN DIAS POR TRANSCURRIR DESDE EL &Uacute;LTIMO PERIODO CREADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-refresh"></span> Verificar Password');
																				
									});
								}  
								else if(data==4){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> EL PERIODO ESCOLAR " + periodo + " YA SE ENCUENTRA CREADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-refresh"></span> Verificar Password');
																				
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				$("#periodoescolar")[0].reset();
				$("#muestraperiodo").html("");	
				$("#btn-submit").html('<span class="fa fa-save"></span> Crear Periodo');
										
									});
								}
						   }
				});
				return false;
			  }
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE PERIODO ESCOLAR */ 
 
 /* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE PERIODO ESCOLAR */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#updateperiodoescolar").validate({
      rules:
	  {
			periodo: { required: true },
			descripcion: { required: true },
			cuotaunica: { required: true, number: true },
			interesmora: { required: true, number: true },
			diasvence: { required: true },
	   },
       messages:
	   {
            periodo:{ required: "Ingrese Periodo Escolar" },
			descripcion:{ required: "Ingrese Descripci&oacute;n de Perido Escolar"},
			cuotaunica: { required: "Ingrese Monto de Cuota Unica", number: "Ingrese solo n&uacute;meros para Cuota Unica" },
			interesmora: { required: "Ingrese Inter&eacute;s por Mora en Pago", number: "Ingrese solo n&uacute;meros para Inter&eacute;s por Mora" },
			diasvence:{ required: "Seleccione D&iacute;a para Vencimiento de Pago"},
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updateperiodoescolar").serialize();
				var periodo = $("#periodo").val();
				var id= $("#updateperiodoescolar").attr("data-id");
		        var codperiodo = id;

      if ($('input[type=checkbox]:checked').length === 0) {
	 
	            alert('DEBE DE SELECCIONAR AL MENOS UN MES PARA PAGOS');
         
                return false;
	 
	  } else {
				
				$.ajax({
				
				type : 'POST',
				url  : 'forperiodo.php?codperiodo='+codperiodo,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> EL PERIODO ESCOLAR " + periodo + " YA SE ENCUENTRA CREADO, POR FAVOR DEBER&Aacute; DE CREARLO PARA PROCESAR ARQUEOS ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'success',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
					    setTimeout("location.href='periodoescolar'", 5000);
										
									});
								}
						   }
				});
				return false;
			}
		}
	   /* form submit */	   
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE PERIODO ESCOLAR */
 































/* FUNCION JQUERY PARA VALIDAR REGISTRO DE CAJAS DE VENTAS */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#cajas").validate({
      rules:
	  {
			nrocaja: { required: true, },
			nombrecaja: { required: true, },
			codigo: { required: true, },
	   },
       messages:
	   {
            nrocaja:{  required: "Ingrese Numero de Caja" },
			nombrecaja:{ required: "Ingrese Nombre de Caja" },
			codigo:{ required: "Seleccione Responsable de Caja" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#cajas").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'forcaja.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE NOMBRE DE CAJA YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}  
								else if(data==3){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE USUARIO YA TIENE UNA CAJA DE COBRO ASIGNADA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
			    $("#cajas")[0].reset();	
				$("#codigocaja").load("funciones.php?muestracodigocaja=si");
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE CAJAS DE VENTAS */


/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CAJA DE VENTAS */	 
     $('document').ready(function()
{ 
     /* validation */
	 $("#updatecajas").validate({
       rules:
	  {
			nrocaja: { required: true, },
			nombrecaja: { required: true, },
			codigo: { required: true, },
	   },
       messages:
	   {
            nrocaja:{  required: "Ingrese Numero de Caja" },
			nombrecaja:{ required: "Ingrese Nombre de Caja" },
			codigo:{ required: "Seleccione Responsable de Caja" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updatecajas").serialize();
				var id= $("#updatecajas").attr("data-id");
		        var codcaja = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'forcaja.php?codcaja='+codcaja,
				data : data,

				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE NOMBRE DE CAJA YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}  
								else if(data==3){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE USUARIO YA TIENE UNA CAJA DE COBRO ASIGNADA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'success',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
				setTimeout("location.href='cajas'", 5000);
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CAJAS DE VENTAS */
 


































/* FUNCION JQUERY PARA VALIDAR REGISTRO DE ARQUEO DE CAJA */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#arqueocaja").validate({
      rules:
	  {
			codcaja: { required: true, },
			montoinicial: { required: true, number : true},
			dineroefectivo: { required: true, number : true},
	   },
       messages:
	   {
			codcaja: { required: "Seleccione Caja para Arqueo" },
			montoinicial:{ required: "Ingrese Monto Inicial", number: "Ingrese solo digitos con 2 decimales" },
			dineroefectivo:{ required: "Ingrese Monto en Efectivo", number: "Ingrese solo digitos con 2 decimales" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#arqueocaja").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'forarqueo.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> NO EXISTEN UN PERIODO ESCOLAR ACTIVO, POR FAVOR DEBER&Aacute; DE CREARLO PARA PROCESAR ARQUEOS ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}  
								else if(data==3){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> YA EXISTE UN ARQUEO ABIERTO DE ESTA CAJA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
			    $("#arqueocaja")[0].reset();	
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE ARQUEO DE CAJA */

/* FUNCION JQUERY PARA VALIDAR CIERRE DE CAJA */	 
$('document').ready(function()
{ 
								
     /* validation */
	 $("#cierrecaja").validate({
      rules:
	  {
			codcaja: { required: true, },
			montoinicial: { required: true, number : true},
			dineroefectivo: { required: true, number : true},
			comentarios: { required: false,},
	   },
       messages:
	   {
			codcaja: { required: "Seleccione Caja para Atqueo" },
			montoinicial:{ required: "Ingrese Monto Inicial", number: "Ingrese solo digitos con 2 decimales" },
			dineroefectivo:{ required: "Ingrese Monto en Efectivo", number: "Ingrese solo digitos con 2 decimales" },
			comentarios:{  required: "Ingrese Comentario de Cierre" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#cierrecaja").serialize();
				var id= $("#cierrecaja").attr("data-id");
				var dineroefectivo = $('#dineroefectivo').val();
		        var codarqueo = id;
	
	       if (dineroefectivo==0.00 || dineroefectivo==0) {
	            
				$("#dineroefectivo").focus();
				$('#dineroefectivo').val("");
				$('#dineroefectivo').css('border-color','#0D89F1');
				alert('POR FAVOR INGRESE UN MONTO VALIDO PARA EFECTIVO DISPONIBLE');
         
        return false;
	 
	  } else {
				
				$.ajax({
				
				type : 'POST',
				url  : 'forcierrearqueo.php?codarqueo='+codarqueo,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Cerrar Caja');
										
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'success',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Cerrar Caja');
			     setTimeout("location.href='arqueoscajas'", 5000);
										
									});
								}
						   }
				});
				return false;
			}
		}
	   /* form submit */	   
});
/* FIN DE  FUNCION JQUERY PARA VALIDAR CIERRE DE CAJA */


































 /* FUNCION JQUERY PARA VALIDAR REGISTRO DE MOVIMIENTOS EN CAJA */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#movimientocaja").validate({
      rules:
	  {
			tipomovimientocaja: { required: true, },
			nrorecibo: { required: true },
			montomovimientocaja: { required: true, number : true },
			mediopagomovimientocaja: { required: true, },
			codcaja: { required: true, },
			descripcionmovimientocaja: { required: true, },
			fechamovimientocaja: { required: true },
	   },
       messages:
	   {
            tipomovimientocaja:{  required: "Seleccione Tipo de Movimiento" },
            nrorecibo:{ required: "Ingrese N&deg; de Factura/Recibo" },
			montomovimientocaja:{ required: "Ingrese Monto de Movimiento", number: "Ingrese solo digitos con 2 decimales" },
			mediopagomovimientocaja:{ required: "Seleccione Medio de Pago" },
			codcaja:{ required: "Seleccione Caja" },
			descripcionmovimientocaja:{ required: "Ingrese Descripci&oacute;n de Movimiento" },
			fechamovimientocaja: { required: "Ingrese Fecha del Gasto" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#movimientocaja").serialize();
				var cant = $('#montomovimientocaja').val();
	
	        if (cant==0.00 || cant==0) {
	            
				$("#montomovimientocaja").focus();
				$('#montomovimientocaja').val("");
				$('#montomovimientocaja').css('border-color','#0D89F1');
				alert('POR FAVOR INGRESE UN MONTO VALIDO PARA MOVIMIENTO EN CAJA');
         
        return false;
	 
	  } else {
		  
				$.ajax({
				
				type : 'POST',
				url  : 'formovimiento.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> NO EXISTEN UN PERIODO ESCOLAR ACTIVO, POR FAVOR DEBER&Aacute; DE CREARLO PARA PROCESAR ARQUEOS ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}  
								else if(data==3){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> DEBE DE REALIZAR EL ARQUEO DE CAJA PARA REGISTRAR MOVIMIENTOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}  
								else if(data==4){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> EL MONTO A RETIRAR NO EXISTE EN CAJA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}  
								else if(data==5){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR INGRESE UN MONTO VALIDO PARA MOVIMIENTO DE CAJA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
			    $("#movimientocaja")[0].reset();	
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}
						   }
				});
				return false;
			  }
		}
	   /* form submit */	   
});
/* FIN DE FUNCION PARA VALIDAR REGISTRO DE MOVIMIENTOS EN CAJA */

/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE MOVIMIENTOS EN CAJA */	 
     $('document').ready(function()
{ 
     /* validation */
	 $("#updatemovimientocaja").validate({
       rules:
	  {
			tipomovimientocaja: { required: true, },
			nrorecibo: { required: true },
			montomovimientocaja: { required: true, number : true },
			mediopagomovimientocaja: { required: true, },
			codcaja: { required: true, },
			descripcionmovimientocaja: { required: true, },
			fechamovimientocaja: { required: true },
	   },
       messages:
	   {
            tipomovimientocaja:{  required: "Seleccione Tipo de Movimiento" },
            nrorecibo:{ required: "Ingrese N&deg; de Factura/Recibo" },
			montomovimientocaja:{ required: "Ingrese Monto de Movimiento", number: "Ingrese solo digitos con 2 decimales" },
			mediopagomovimientocaja:{ required: "Seleccione Medio de Pago" },
			codcaja:{ required: "Seleccione Caja" },
			descripcionmovimientocaja:{ required: "Ingrese descripci&oacute;n de Movimiento" },
			fechamovimientocaja: { required: "Ingrese Fecha del Gasto" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updatemovimientocaja").serialize();
				var id= $("#updatemovimientocaja").attr("data-id");
		        var codmovimientocaja = id;
				var cant = $('#montomovimientocaja').val();
	
	        if (cant==0.00 || cant==0) {
	            
				$("#montomovimientocaja").focus();
				$('#montomovimientocaja').val("");
				$('#montomovimientocaja').css('border-color','#0D89F1');
				alert('POR FAVOR INGRESE UN MONTO VALIDO PARA MOVIMIENTO EN CAJA');
         
        return false;
	 
	  } else {
				$.ajax({
				
				type : 'POST',
				url  : 'formovimiento.php?codmovimientocaja='+codmovimientocaja,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> NO EXISTEN UN PERIODO ESCOLAR ACTIVO, POR FAVOR DEBER&Aacute; DE CREARLO PARA PROCESAR ARQUEOS ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}  
								else if(data==3){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> DEBE DE REALIZAR EL ARQUEO DE CAJA PARA REGISTRAR MOVIMIENTOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}  
								else if(data==4){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> EL MONTO A RETIRAR NO EXISTE EN CAJA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}  
								else if(data==5){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR INGRESE UN MONTO VALIDO PARA MOVIMIENTO DE CAJA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'success',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
$("#cargamovimientoinput").load("funciones.php?muestramovimientodb=si&codmovimientocaja="+btoa(codmovimientocaja));
					    setTimeout("location.href='movimientoscajas'", 5000);
										
									});
								}
						   }
				});
				return false;
			}
		}
	   /* form submit */	   
});
/* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE MOVIMIENTOS EN CAJA */
 
 

























 /* FUNCION JQUERY PARA VALIDAR REGISTRO DE TURNOS */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#turno").validate({
      rules:
	  {
			turno: { required: true },
	   },
       messages:
	   {
            turno:{ required: "Ingrese Turno de Inscripci&oacute;n" },
           
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#turno").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'forturno.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE TURNO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				$("#turno")[0].reset();
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE TURNOS*/


/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE TURNOS*/	 
$('document').ready(function()
{ 
     /* validation */
	 $("#updateturno").validate({
      
      rules:
	  {
			turno: { required: true },
	   },
       messages:
	   {
            turno:{ required: "Ingrese Turno de Inscripci&oacute;n" },
           
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updateturno").serialize();
				var id= $("#updateturno").attr("data-id");
		        var codturno = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'forturno.php?codturno='+codturno,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE TURNO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'success',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
				setTimeout("location.href='turnos'", 5000);
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE TURNOS */
 
 
  
 




















 /* FUNCION JQUERY PARA VALIDAR REGISTRO DE NIVELES */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#nivel").validate({
      rules:
	  {
			nivel: { required: true },
			pagonivel: { required: true,  number : true },
	   },
       messages:
	   {
           nivel:{ required: "Ingrese Nombre de Nivel" },
		   pagonivel:{ required: "Ingrese Monto de Pago del Nivel", number: "Ingrese solo d&iacute;gitos para Monto de Pago del Nivel" },
           
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#nivel").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'fornivel.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE NIVEL YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				$("#nivel")[0].reset();
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE NIVELES*/


/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE NIVELES*/	 
$('document').ready(function()
{ 
     /* validation */
	 $("#updatenivel").validate({
      
      rules:
	  {
			nivel: { required: true },
			pagonivel: { required: true,  number : true },
	   },
       messages:
	   {
           nivel:{ required: "Ingrese Nombre de Nivel" },
		   pagonivel:{ required: "Ingrese Monto de Pago del Nivel", number: "Ingrese solo d&iacute;gitos para Monto de Pago del Nivel" },
           
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updatenivel").serialize();
				var id= $("#updatenivel").attr("data-id");
		        var codnivel = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'fornivel.php?codnivel='+codnivel,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE NIVEL YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'success',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
				setTimeout("location.href='niveles'", 5000);
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE NIVELES */
 

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 














 /* FUNCION JQUERY PARA VALIDAR REGISTRO DE GRADOS */	 
	 
$('document').ready(function()
{ 
     /* validation */
	 $("#grados").validate({
      rules:
	  {
			codnivel: { required: true },
			grado: { required: true },
	   },
       messages:
	   {
			codnivel:{ required: "Seleccione Nivel de Grado" },
			grado:{ required: "Ingrese Nombre de Grado" },
           
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#grados").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'forgrado.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> YA EXISTE UN GRADO CON ESTE NOMBRE, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				$("#grados")[0].reset();
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE GRADOS*/

/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE GRADOS*/	 
$('document').ready(function()
{ 
     /* validation */
	 $("#updategrados").validate(
	 {
      rules:
	  {
			codgrado: { required: true },
			codnivel: { required: true },
			grado: { required: true },
	   },
       messages:
	   {
			codgrado:{ required: "Ingrese C&oacute;digo de Grado" },
			codnivel:{ required: "Seleccione Nivel de Grado" },
			grado:{ required: "Ingrese Nombre de Grado" },
           
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updategrados").serialize();
				var id= $("#updategrados").attr("data-id");
		        var codgrado = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'forgrado.php?codgrado='+codgrado,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> YA EXISTE UN GRADO CON ESTE NOMBRE, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'success',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
				setTimeout("location.href='grados'", 5000);
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE GRADOS */
 






























/* FUNCION JQUERY PARA VALIDAR REGISTRO DE SECCIONES */	 
	 
$('document').ready(function()
{ 
     /* validation */
	 $("#secciones").validate({
      rules:
	  {
			codgrado: { required: true },
			codnivel: { required: true },
			seccion: { required: true },
	   },
       messages:
	   {
			codgrado:{ required: "Seleccione Grado" },
			codnivel:{ required: "Seleccione Nivel de Grado" },
			seccion:{ required: "Ingrese Secci&oacute;n de Grado" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#secciones").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'forseccion.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> YA EXISTE ESTA SECCI&Oacute;N PARA EL GRADO SELECCIONADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				$("#secciones")[0].reset();
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE SECCIONES*/


/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE SECCIONES*/	 
$('document').ready(function()
{ 
     /* validation */
	 $("#updateseccion").validate({
      rules:
	  {
			codseccion: { required: true },
			codgrado: { required: true },
			codnivel: { required: true },
			seccion: { required: true },
	   },
       messages:
	   {
			codseccion:{ required: "Ingrese C&oacute;digo de Secci&oacute;n" },
			codgrado:{ required: "Seleccione Grado" },
			codnivel:{ required: "Seleccione Nivel de Grado" },
			seccion:{ required: "Ingrese Secci&oacute;n de Grado" },
           
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updateseccion").serialize();
				var id= $("#updateseccion").attr("data-id");
		        var codseccion = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'forseccion.php?codseccion='+codseccion,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> YA EXISTE ESTA SECCI&Oacute;N PARA EL GRADO SELECCIONADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'success',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
				setTimeout("location.href='secciones'", 5000);
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE SECCIONES */
 









































 /* FUNCION JQUERY PARA VALIDAR REGISTRO DE AREAS DE MATERIAS */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#areas").validate({
      rules:
	  {
			nomarea: { required: true },
	   },
       messages:
	   {
            nomarea:{ required: "Ingrese Nombre de &Aacute;rea para Materias" },
           
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#areas").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'forarea.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTA &Aacute;REA DE MATERIA YA SE ENCUENTRA REGISTRADA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				$("#areas")[0].reset();
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE AREAS DE MATERIAS*/

/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE AREAS DE MATERIAS*/	 
$('document').ready(function()
{ 
     /* validation */
	 $("#updatearea").validate({
      rules:
	  {
			nomarea: { required: true },
	   },
       messages:
	   {
            nomarea:{ required: "Ingrese Nombre de &Aacute;rea para Materias" },
           
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updatearea").serialize();
				var id= $("#updatearea").attr("data-id");
		        var codarea = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'forarea.php?codarea='+codarea,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTA &Aacute;REA DE MATERIA YA SE ENCUENTRA REGISTRADA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'success',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
				setTimeout("location.href='areas'", 5000);
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE AREAS DE MATERIAS */
 
 





















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE MATERIAS */	 
	 
$('document').ready(function()
{ 
     /* validation */
	 $("#materias").validate({
      rules:
	  {
			codarea: { required: true },
			nommateria: { required: true},
			codgrado: { required: true},
			codnivel: { required: true},
	   },
       messages:
	   {
            codarea:{ required: "Seleccione &Aacute;rea de Materia" },
			nommateria:{ required: "Ingrese Nombre de Materia" },
			codnivel:{ required: "Seleccione Nivel para Grado" },
			codgrado:{ required: "Seleccione Grado para Materia" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#materias").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'formateria.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> YA EXISTE ESTA MATERIA PARA EL GRADO SELECCIONADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				$("#materias")[0].reset();
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE MATERIAS */


/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE MATERIAS */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#updatemateria").validate({
      rules:
	  {
			codmateria: { required: true },
			codarea: { required: true },
			nommateria: { required: true},
			codgrado: { required: true},
			codnivel: { required: true},
	   },
       messages:
	   {
            codmateria:{ required: "Ingrese C&oacute;digo de Materia" },
			codarea:{ required: "Seleccione &Aacute;rea de Materia" },
			nommateria:{ required: "Ingrese Nombre de Materia" },
			codnivel:{ required: "Seleccione Nivel para Grado" },
			codgrado:{ required: "Seleccione Grado para Materia" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updatemateria").serialize();
				var id= $("#updatemateria").attr("data-id");
		        var codmateria = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'formateria.php?codmateria='+codmateria,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTA &Aacute;REA DE MATERIA YA SE ENCUENTRA REGISTRADA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'success',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
				setTimeout("location.href='materias'", 5000);
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE MATERIAS */



































/* FUNCION JQUERY PARA VALIDAR REGISTRO DE HORAS */	 
	 
$('document').ready(function()
{ 
     /* validation */
	 $("#horas").validate({
      rules:
	  {
			codhora: { required: true },
			nomhora: { required: true},
	   },
       messages:
	   {
            codhora:{ required: "Ingrese C&oacute;digo de Hora" },
			nomhora:{ required: "Ingrese Descripci&oacute;n de Hora" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#horas").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'forhora.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VAC&Iacute;OS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
																				
								}  
								else if(data==2){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> YA EXISTE UNA HORA CON ESTA DESCRIPCI&Oacute;N, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
																				
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$("#horas")[0].reset();	
					    $("#codigohora").load("funciones.php?muestracodigohoras=si");
						setTimeout(function() { $("#error").html(""); }, 5000);		
						$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}
						  }
				});
				return false;
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE HORAS */


/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE HORAS */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#updatehora").validate({
      rules:
	  {
			codhora: { required: true },
			nomhora: { required: true},
	   },
       messages:
	   {
            codhora:{ required: "Ingrese C&oacute;digo de Hora" },
			nomhora:{ required: "Ingrese Descripci&oacute;n de Hora" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updatehora").serialize();
				var id= $("#updatehora").attr("data-id");
		        var codhora = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'forhora.php?codhora='+codhora,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VAC&Iacute;OS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}  
								else if(data==2){
									
									$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> YA EXISTE UNA HORA CON ESTA DESCRIPCI&Oacute;N, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}
								else{
										
						$("#error").fadeIn(1000, function(){
						$("#error").html('<center> '+data+' </center>');
						$('#btn-update').attr("disabled", true);
						$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
					    setTimeout("location.href='horas'", 5000);
						
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE HORAS */






















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE DIAS */	 
	 
$('document').ready(function()
{ 
     /* validation */
	 $("#dias").validate({
      rules:
	  {
			coddia: { required: true },
			nomdia: { required: true},
	   },
       messages:
	   {
            coddia:{ required: "Ingrese C&oacute;digo de D&Iacute;a" },
			nomdia:{ required: "Ingrese Descripci&oacute;n de D&Iacute;a" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#dias").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'fordia.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VAC&Iacute;OS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
																				
								}  
								else if(data==2){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> YA EXISTE UN D&Iacute;A CON ESTA DESCRIPCI&Oacute;N, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
																				
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$("#dias")[0].reset();	
						setTimeout(function() { $("#error").html(""); }, 5000);		
						$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}
						  }
				});
				return false;
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE DIAS */


/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE DIAS */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#updatedia").validate({
      rules:
	  {
			coddia: { required: true },
			nomdia: { required: true},
	   },
       messages:
	   {
            coddia:{ required: "Ingrese C&oacute;digo de D&iacute;a" },
			nomdia:{ required: "Ingrese Descripci&oacute;n de D&iacute;a" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updatedia").serialize();
				var id= $("#updatedia").attr("data-id");
		        var coddida = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'fordia.php?coddia='+coddia,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VAC&Iacute;OS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}  
								else if(data==2){
									
									$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> YA EXISTE UN D&Iacute;A CON ESTA DESCRIPCI&Oacute;N, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}
								else{
										
						$("#error").fadeIn(1000, function(){
						$("#error").html('<center> '+data+' </center>');
						$('#btn-update').attr("disabled", true);
						$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
					    setTimeout("location.href='dias'", 5000);
						
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE DIAS */






























/* FUNCION JQUERY PARA VALIDAR REGISTRO DE AULAS */	 
	 
$('document').ready(function()
{ 
     /* validation */
	 $("#aulas").validate({
      rules:
	  {
			codaula: { required: true },
			nomaula: { required: true},
			descripcaula: { required: true},
	   },
       messages:
	   {
            codaula:{ required: "Ingrese C&oacute;digo de Aula de Clases" },
			nomaula:{ required: "Ingrese Nombre Corto de Aula de Clases" },
			descripcaula:{ required: "Ingrese Nombre Largo de Aula de Clases" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#aulas").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'foraula.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VAC&Iacute;OS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
									$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
																				
								}  
								else if(data==2){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> YA EXISTE UN AULA DE CLASES CON ESTE NOMBRE, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
									$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
																				
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$("#aulas")[0].reset();	
						setTimeout(function() { $("#error").html(""); }, 5000);		
						$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}
						  }
				});
				return false;
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE AULAS */


/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE AULAS */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#updateaula").validate({
      rules:
	  {
			codaula: { required: true },
			nomaula: { required: true},
			descripcaula: { required: true},
	   },
       messages:
	   {
            codaula:{ required: "Ingrese C&oacute;digo de Aula de Clases" },
			nomaula:{ required: "Ingrese Nombre Corto de Aula de Clases" },
			descripcaula:{ required: "Ingrese Nombre Largo de Aula de Clases" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updateaula").serialize();
				var id= $("#updateaula").attr("data-id");
		        var codaula = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'foraula.php?codaula='+codaula,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VAC&Iacute;OS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}  
								else if(data==2){
									
									$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> YA EXISTE UN AULA DE CLASES CON ESTE NOMBRE, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}
								else{
										
						$("#error").fadeIn(1000, function(){
						$("#error").html('<center> '+data+' </center>');
						$('#btn-update').attr("disabled", true);
						$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
					    setTimeout("location.href='aulas'", 5000);
						
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE AULAS */

































 

/* FUNCION JQUERY PARA VALIDAR REGISTRO DE DOCENTES */	 
	 
$('document').ready(function()
{ 
     /* validation */
	 $("#docentes").validate({
      rules:
	  {
			ceddoc: { required: true },
			nomdoc: { required: true, lettersonly: true },
			fecnacdoc: { required: true,  date : false },
			tlfdoc: { required: true, digits: true },
			edocivildoc: { required: true },
			lugarnacdoc: { required: true },
			correodoc: { required: true,  email : true },
			ingresodoc: { required: true },
			especdoc: { required: true},
			direcdoc: { required: true},
			expedido: { required: true},
			horasdoc: { required: true, digits: true },
			codcargodoc: { required: true},
	   },
       messages:
	   {
            ceddoc:{ required: "Ingrese N&deg; de DNI de Docente" },
			nomdoc:{ required: "Ingrese Nombre de Docente", lettersonly: "Ingrese solo letras para Nombre" },
			fecnacdoc: { required: "Ingrese Fecha de Nacimiento de Docente", date: "Ingrese una Fecha v&aacute;lida" },
			tlfdoc: { required: "Ingrese N&deg; de Tel&eacute;fono de Docente", digits: "Ingrese solo d&iacute;gitos para Tel&eacute;fono de Docente" },
			edocivildoc:{ required: "Seleccione Estado Civil de Docente" },
			lugarnacdoc:{ required: "Ingrese Lugar de Nacimiento de Docente" },
			correodoc: { required: "Ingrese Correo de Docente", email: "Ingrese un Correo v&aacute;lido" },
			ingresodoc:{ required: "Ingrese C&oacute;digo de Instituci&oacute;n" },
			especdoc:{ required: "Ingrese Especialidad de Docente" },
			direcdoc:{ required: "Ingrese Direcci&oacute;n de Docente" },
			expedido:{ required: "Seleccione Expedido de C&eacute;dula de Docente" },
			horasdoc:{ required: "Ingrese Horas Asignadas", digits: "Ingrese solo d&iacute;gitos para Horas Asignadas" },
			codcargodoc:{ required: "Ingrese C&oacute;digo de Cargo" },
           
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#docentes").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'fordocente.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> YA EXISTE UN DOCENTE CON ESTE N&deg; DE C&Eacute;DULA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				 $("#docentes")[0].reset();
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE DOCENTES */


/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE DOCENTES */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#updatedocentes").validate({
      rules:
	  {
			ceddoc: { required: true },
			nomdoc: { required: true, lettersonly: true },
			fecnacdoc: { required: true,  date : false },
			tlfdoc: { required: true, digits: true },
			edocivildoc: { required: true },
			lugarnacdoc: { required: true },
			correodoc: { required: true,  email : true },
			ingresodoc: { required: true },
			especdoc: { required: true},
			direcdoc: { required: true},
			expedido: { required: true},
			horasdoc: { required: true, digits: true },
			codcargodoc: { required: true},
	   },
       messages:
	   {
            ceddoc:{ required: "Ingrese N&deg; de DNI de Docente" },
			nomdoc:{ required: "Ingrese Nombre de Docente", lettersonly: "Ingrese solo letras para Nombre" },
			fecnacdoc: { required: "Ingrese Fecha de Nacimiento de Docente", date: "Ingrese una Fecha v&aacute;lida" },
			tlfdoc: { required: "Ingrese N&deg; de Tel&eacute;fono de Docente", digits: "Ingrese solo d&iacute;gitos para Tel&eacute;fono de Docente" },
			edocivildoc:{ required: "Seleccione Estado Civil de Docente" },
			lugarnacdoc:{ required: "Ingrese Lugar de Nacimiento de Docente" },
			correodoc: { required: "Ingrese Correo de Docente", email: "Ingrese un Correo v&aacute;lido" },
			ingresodoc:{ required: "Ingrese C&oacute;digo de Instituci&oacute;n" },
			especdoc:{ required: "Ingrese Especialidad de Docente" },
			direcdoc:{ required: "Ingrese Direcci&oacute;n de Docente" },
			expedido:{ required: "Seleccione Expedido de C&eacute;dula de Docente" },
			horasdoc:{ required: "Ingrese Horas Asignadas", digits: "Ingrese solo d&iacute;gitos para Horas Asignadas" },
			codcargodoc:{ required: "Ingrese C&oacute;digo de Cargo" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updatedocentes").serialize();
				var id= $("#updatedocentes").attr("data-id");
		        var coddoc = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'fordocente.php?coddoc='+coddoc,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE CORREO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> YA EXISTE UN DOCENTE CON ESTE N&deg; DE C&Eacute;DULA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'success',
                 timeout: 5000, });
				 $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
     			 setTimeout("location.href='docentes'", 15000);
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE DOCENTES */
 
/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE DOCENTES EN SESSION */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#updatedocentesession").validate({
      rules:
	  {
			ceddoc: { required: true },
			nomdoc: { required: true, lettersonly: true },
			fecnacdoc: { required: true,  date : false },
			tlfdoc: { required: true, digits: true },
			edocivildoc: { required: true },
			lugarnacdoc: { required: true },
			correodoc: { required: true,  email : true },
			ingresodoc: { required: true },
			especdoc: { required: true},
			direcdoc: { required: true},
			expedido: { required: true},
			horasdoc: { required: true, digits: true },
			codcargodoc: { required: true},
	   },
       messages:
	   {
            ceddoc:{ required: "Ingrese N&deg; de DNI de Docente" },
			nomdoc:{ required: "Ingrese Nombre de Docente", lettersonly: "Ingrese solo letras para Nombre" },
			fecnacdoc: { required: "Ingrese Fecha de Nacimiento de Docente", date: "Ingrese una Fecha v&aacute;lida" },
			tlfdoc: { required: "Ingrese N&deg; de Tel&eacute;fono de Docente", digits: "Ingrese solo d&iacute;gitos para Tel&eacute;fono de Docente" },
			edocivildoc:{ required: "Seleccione Estado Civil de Docente" },
			lugarnacdoc:{ required: "Ingrese Lugar de Nacimiento de Docente" },
			correodoc: { required: "Ingrese Correo de Docente", email: "Ingrese un Correo v&aacute;lido" },
			ingresodoc:{ required: "Ingrese C&oacute;digo de Instituci&oacute;n" },
			especdoc:{ required: "Ingrese Especialidad de Docente" },
			direcdoc:{ required: "Ingrese Direcci&oacute;n de Docente" },
			expedido:{ required: "Seleccione Expedido de C&eacute;dula de Docente" },
			horasdoc:{ required: "Ingrese Horas Asignadas", digits: "Ingrese solo d&iacute;gitos para Horas Asignadas" },
			codcargodoc:{ required: "Ingrese C&oacute;digo de Cargo" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updatedocentesession").serialize();
				var formData = new FormData($("#updatedocentesession")[0]);
		        var coddoc = $('input#coddoc').val();
				
				$.ajax({
				type : 'POST',
				url  : 'datos.php?coddoc='+coddoc,
				data : formData,
				//necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE CORREO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> YA EXISTE UN DOCENTE CON ESTE N&deg; DE C&Eacute;DULA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'success',
                 timeout: 5000, });
				 $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE DOCENTES EN SESSION */
 
































 

/* FUNCION JQUERY PARA VALIDAR REGISTRO DE ASIGNACIONES DE CURSOS A DOCENTES */	 
	 
$('document').ready(function()
{ 
     /* validation */
	 $("#asignaciones").validate({
      rules:
	  {
			coddoc: { required: true },
			busquedadocente: { required: true },
			codturno: { required: true },
			codnivel: { required: true },
			codgrado: { required: true },
			codseccion: { required: true },
			codmateria: { required: true }
	   },
       messages:
	   {
            coddoc:{ required: "Realice la Busqueda del Docente" },
			busquedadocente:{ required: "Realice la Busqueda del Docente" },
			codturno:{ required: "Seleccione Turno" },
			codnivel:{ required: "Seleccione Nivel" },
			codgrado:{ required: "Seleccione Grado" },
			codseccion:{ required: "Seleccione Secci&oacute;n" },
			codmateria:{ required: "Seleccione Materia" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#asignaciones").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'forasignacion.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTA MATERIA YA SE ENCUENTRA ASIGNADA A UN DOCENTE, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				 $("#asignaciones")[0].reset();
				 $("#muestradocente").html("");
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE ASIGNACIONES DE CURSOS A DOCENTES */

































/* FUNCION JQUERY PARA VALIDAR REGISTRO DE ESTUDIANTES */	 
	 
$('document').ready(function()
{ 
     /* validation */
	 $("#inscripciones").validate({
      rules:
	  {
		  cedula: { required: true, },
		  cedest: { required: true, },
		  pnomest: { required: true, lettersonly: true },
		  snomest: { required: false, lettersonly: false },
		  papeest: { required: true, lettersonly: true },
		  sapeest: { required: false, lettersonly: false },
		  sexoest: { required: true },
		  direcest: { required: true},
		  fnacest: { required: true,  date : false },
		  coddoc: { required: true },
		  codnivel: { required: true },
		  codgrado: { required: true },
		  codseccion: { required: true },
		  codturno: { required: true },
		  becado: { required: true },
		  cedpadre: { required: true, },
		  nompadre: { required: true, lettersonly: true },
		  apepadre: { required: true, lettersonly: true },
		  direcpadre: { required: false},
		  tlfpadre: { required: true, digits: true },
		  expedpadre: { required: false },
		  parentesco: { required: false },
		  estadopadre: { required: false },
		  profpadre: { required: false },
		  trabajapadre: { required: false},
			
	   },
       messages:
	   {
		  cedula:{ required: "Ingrese N&deg de DNI de Estudiante" },
		  cedest:{ required: "Ingrese N&deg de DNI de Estudiante" },
		  pnomest:{ required: "Ingrese Primer Nombre de Estudiante", lettersonly: "Ingrese solo letras para Primer Nombre" },
		  snomest:{ required: "Ingrese Segundo Nombre de Estudiante", lettersonly: "Ingrese solo letras para Segundo Nombre" },
		  papeest:{ required: "Ingrese Primer Apellido de Estudiante", lettersonly: "Ingrese solo letras para Primer Apellido" },
		  sapeest:{ required: "Ingrese Segundo Apellido de Estudiante", lettersonly: "Ingrese solo letras para Segundo Apellido" },
		  sexoest:{ required: "Seleccione Sexo de Estudiante" },
		  direcest:{ required: "Ingrese Direcci&oacute;n de Estudiante" },
		  fnacest: { required: "Ingrese Fecha de Nacimiento", date: "Ingrese una Fecha v&aacute;lida" },
		  coddoc:{ required: "Seleccione Docente" },
	      codnivel:{ required: "Seleccione Nivel" },
		  codgrado:{ required: "Seleccione Grado a Cursar" },
		  codseccion:{ required: "Seleccione Secci&oacute;n a Cursar" },
		  codturno:{ required: "Seleccione Turno" },
		  becado:{ required: "Seleccione si es Becado" },
		  cedpadre:{ required: "Ingrese NIT/CI de Padre/Tutor" },
		  nompadre:{ required: "Ingrese Nombre de Padre/Tutor", lettersonly: "Ingrese solo letras para Nombre" },
		  apepadre:{ required: "Ingrese Apellido de Padre/Tutor", lettersonly: "Ingrese solo letras para Apellido" },
		  direcpadre:{ required: "Ingrese Direcci&oacute;n Domiciliaria de Padre/Tutor" },
		  tlfpadre: { required: "Ingrese N&deg; de Tel&eacute;fono de Padre/Tutor", digits: "Ingrese solo d&iacute;gitos para Tel&eacute;fono" },
		  expedpadre:{ required: "Seleccione Expedido de Padre/Tutor" },
		  parentesco:{ required: "Ingrese Parentesco de Padre/Tutor" },
		  estadopadre:{ required: "Seleccione Estado Civil de Padre/Tutor" },
		  profpadre:{ required: "Ingrese Profesi&oacute;n de Padre/Tutor" },
		  trabajapadre:{ required: "Ingrese Lugar de Trabajo de Padre/Tutor" },
			
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#inscripciones").serialize();
				var becado = $('#becado').val();
				var cedest = $('#cedest').val();
			  //if ($('input[type=checkbox]').is(':checked')) { // Se puede cambiar por una clase $(".checks").is(":checked")
	            if (becado != "COMPLETA" && $('input[type=checkbox]:checked').length === 0) {
	 
	            alert('DEBE DE SELECCIONAR AL MENOS UN MES DE PAGO');
         
                return false;
	 
	  } else {
				
				$.ajax({
				
				type : 'POST',
				url  : 'inscripciones.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> YA EXISTE UN ESTUDIANTE CON ESTE N&deg; DE C&Eacute;DULA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Inscribir');
																				
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
			     $("#muestraestudiante").load("funciones.php?CrearEstudiante=si&cedula="+cedest);
				 $("#btn-submit").html('<span class="fa fa-save"></span> Inscribir');
										
									});
								}
						   }
				});
				return false;
			   }
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE ESTUDIANTES */
 
/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE ESTUDIANTES */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#updateestudiantes").validate({
      rules:
	  {
		  cedest: { required: true, },
		  pnomest: { required: true, lettersonly: true },
		  snomest: { required: false, lettersonly: false },
		  papeest: { required: true, lettersonly: true },
		  sapeest: { required: false, lettersonly: false },
		  sexoest: { required: true },
		  direcest: { required: true },
		  fnacest: { required: true,  date : false },
		  codnivel: { required: true },
		  codgrado: { required: true },
		  codseccion: { required: true },
		  codturno: { required: true },
		  becado: { required: true },
	   },
       messages:
	   {
		  cedest:{ required: "Ingrese N&deg de DNI de Estudiante" },
		  pnomest:{ required: "Ingrese Primer Nombre de Estudiante", lettersonly: "Ingrese solo letras para Primer Nombre" },
		  snomest:{ required: "Ingrese Segundo Nombre de Estudiante", lettersonly: "Ingrese solo letras para Segundo Nombre" },
		  papeest:{ required: "Ingrese Primer Apellido de Estudiante", lettersonly: "Ingrese solo letras para Primer Apellido" },
		  sapeest:{ required: "Ingrese Segund Apellido de Estudiante", lettersonly: "Ingrese solo letras para Segundo Apellido" },
		  sexoest:{ required: "Seleccione Sexo de Estudiante" },
		  direcest:{ required: "Ingrese Direcci&oacute;n de Estudiante" },
		  fnacest: { required: "Ingrese Fecha de Nacimiento", date: "Ingrese una Fecha v&aacute;lida" },
	      codnivel:{ required: "Seleccione Nivel" },
		  codgrado:{ required: "Seleccione Grado a Cursar" },
		  codseccion:{ required: "Seleccione Secci&oacute;n a Cursar" },
		  codturno:{ required: "Seleccione Turno" },
		  becado:{ required: "Seleccione si es Becado" },			
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updateestudiantes").serialize();
		        var codest = $('input#codest').val();
		        var codturno = $('input#codturno2').val();
		        var codnivel = $('input#codnivel2').val();
		        var codgrado = $('input#codgrado2').val();
		        var codseccion = $('input#codseccion2').val();
				
				$.ajax({
				
				type : 'POST',
				url  : 'estudiantes.php?codest='+codest,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> YA EXISTE UN ESTUDIANTE CON ESTE N&deg; DE C&Eacute;DULA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'success',
                 timeout: 5000, });
$("#muestraestudiantes").load("funciones.php?BusquedaControlEstudiantes=si&codturno="+codturno+'&codnivel='+codnivel+'&codgrado='+codgrado+'&codseccion='+codseccion);
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE ESTUDIANTES */

/* FUNCION JQUERY PARA VALIDAR RETIRO DE ESTUDIANTES */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#retiroestudiantes").validate({
      rules:
	  {
		  cedest: { required: true, },
		  pnomest: { required: true, lettersonly: true },
		  snomest: { required: false, lettersonly: false },
		  papeest: { required: true, lettersonly: true },
		  sapeest: { required: false, lettersonly: false },
		  observacionest: { required: true },
		  retiroest: { required: true,  date : false },
	   },
       messages:
	   {
		  cedest:{ required: "Ingrese N&deg de DNI de Estudiante" },
		  pnomest:{ required: "Ingrese Primer Nombre de Estudiante", lettersonly: "Ingrese solo letras para Primer Nombre" },
		  snomest:{ required: "Ingrese Segundo Nombre de Estudiante", lettersonly: "Ingrese solo letras para Segundo Nombre" },
		  papeest:{ required: "Ingrese Primer Apellido de Estudiante", lettersonly: "Ingrese solo letras para Primer Apellido" },
		  sapeest:{ required: "Ingrese Segund Apellido de Estudiante", lettersonly: "Ingrese solo letras para Segundo Apellido" },
		  observacionest:{ required: "Ingrese Observaci&oacute;n de Retiro" },
		  retiroest: { required: "Ingrese Fecha de Retiro", date: "Ingrese una Fecha v&aacute;lida" },			
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#retiroestudiantes").serialize();
		        var codest = $('input#codest').val();
		        var codturno = $('input#codturno3').val();
		        var codnivel = $('input#codnivel3').val();
		        var codgrado = $('input#codgrado3').val();
		        var codseccion = $('input#codseccion3').val();
				
				$.ajax({
				
				type : 'POST',
				url  : 'estudiantes.php?codest='+codest,
				data : data,
				beforeSend: function()
				{	
					$("#retiro").fadeOut();
					$("#btn-retiro").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#retiro").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-retiro").html('<span class="fa fa-save"></span> Retirar');
										
									});
								}  
								else if(data==2){
									
					$("#retiro").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> YA EXISTE UN ESTUDIANTE CON ESTE N&deg; DE C&Eacute;DULA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-retiro").html('<span class="fa fa-save"></span> Retirar');
																				
									});
								}  
								else{
										
					$("#retiro").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
$("#muestraestudiantes").load("funciones.php?BusquedaControlEstudiantes=si&codturno="+codturno+'&codnivel='+codnivel+'&codgrado='+codgrado+'&codseccion='+codseccion);
				 $("#btn-retiro").html('<span class="fa fa-save"></span> Retirar');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR RETIRO DE ESTUDIANTES */


/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE REPRESENTANTES */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#updaterepresentante").validate({
      rules:
	  {
		  cedpadre: { required: true },
		  nompadre: { required: true, lettersonly: true },
		  apepadre: { required: true, lettersonly: true },
		  direcpadre: { required: false},
		  tlfpadre: { required: true, digits: true },
		  expedpadre: { required: false },
		  parentesco: { required: false },
		  estadopadre: { required: false },
		  profpadre: { required: false },
		  trabajapadre: { required: false},
			
	   },
       messages:
	   {
		  cedpadre:{ required: "Ingrese N&deg de DNI de Padre/Tutor" },
		  nompadre:{ required: "Ingrese Nombre de Padre/Tutor", lettersonly: "Ingrese solo letras para Nombre" },
		  apepadre:{ required: "Ingrese Apellido de Padre/Tutor", lettersonly: "Ingrese solo letras para Apellido" },
		  direcpadre:{ required: "Ingrese Direcci&oacute;n Domiciliaria de Padre/Tutor" },
		  tlfpadre: { required: "Ingrese N&deg; de Tel&eacute;fono de Padre/Tutor", digits: "Ingrese solo d&iacute;gitos para Tel&eacute;fono" },
		  expedpadre:{ required: "Seleccione Expedido de Padre/Tutor" },
		  parentesco:{ required: "Ingrese Parentesco de Padre/Tutor" },
		  estadopadre:{ required: "Seleccione Estado Civil de Padre/Tutor" },
		  profpadre:{ required: "Ingrese Profesi&oacute;n de Padre/Tutor" },
		  trabajapadre:{ required: "Ingrese Lugar de Trabajo de Padre/Tutor" },
			
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updaterepresentante").serialize();
				var id= $("#updaterepresentante").attr("data-id");
		        var codpadre = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'editrepresentante.php?codpadre='+codpadre,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> YA EXISTE UN PADRE/TUTOR CON ESTE N&deg; DE C&Eacute;DULA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'success',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
				setTimeout("location.href='representantes'", 5000);
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE REPRESENTANTES */
 

































/* FUNCION JQUERY PARA VALIDAR REGISTRO DE PAGOS */	 
	 
$('document').ready(function()
{ 
     /* validation */
	 $("#pagos").validate({
      rules:
	  {
		  cedest: { required: true, digits: true },
		  codperiodo: { required: true },
		  codnivel: { required: true },
		  codgrado: { required: true },
		  codturno: { required: true },
		  becado: { required: true },
			
	   },
       messages:
	   {
		  cedest:{ required: "Ingrese N&deg de DNI de Estudiante", digits: "Ingrese solo d&iacute;gitos para C&oacute;digo" },
	      codperiodo:{ required: "Periodo" },
		  codnivel:{ required: "Nivel" },
		  codgrado:{ required: "Grado" },
		  codturno:{ required: "Turno" },
		  becado:{ required: "Becado" },
			
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#pagos").serialize();
			    var check = $("input[type='checkbox']:checked:enabled").length;
						
		if(check == "0"){
	 
	            alert('DEBE DE SELECCIONAR AL MENOS UN MES DE PAGO ');
         
                return false; 
	 
	  } else {
	           				
				$.ajax({
				
				type : 'POST',
				url  : 'forpagos.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE SELECCIONAR AL MENOS UN MES PARA PAGOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				$("#pagos")[0].reset();	
				$("#muestraestudiantepagos").html("");
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}
						   }
				});
				return false;
			   }
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE PAGOS */

/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE PAGOS */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#updatepagos").validate({
      rules:
	  {
		  codest: { required: true, digits: true },
		  codpago: { required: true, digits: true },
		  montopago: { required: true, number: true },
	   },
       messages:
	   {
		  codest:{ required: "Ingrese N&deg de DNI de Estudiante", digits: "Ingrese solo d&iacute;gitos para C&oacute;digo" },
		  codpago:{ required: "Ingrese C&oacute;digo de Pago", digits: "Ingrese solo d&iacute;gitos para C&oacute;digo" },
		  montopago: { required: "Ingrese Monto de Pago", number: "Ingrese solo n&uacute;meros para Monto de Pago" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updatepagos").serialize();
				var id= $("#updatepagos").attr("data-id");
		        var codpago = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'editpago.php?codpago='+codpago,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE SELECCIONAR AL MENOS UN MES PARA PAGOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'success',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
				setTimeout("location.href='pagos'", 5000);
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE PAGOS */

































/* FUNCION JQUERY PARA VALIDAR REGISTRO DE NOTAS */	 
	 
$('document').ready(function()
{ 
     /* validation */
	 $("#notas").validate({
      rules:
	  {
		  cedest: { required: true },
		  codperiodo: { required: true },
		  codnivel: { required: true },
		  codgrado: { required: true },
		  codturno: { required: true },
		  becado: { required: true },
			
	   },
       messages:
	   {
		  cedest:{ required: "Ingrese N&deg de DNI de Estudiante" },
	      codperiodo:{ required: "Periodo" },
		  codnivel:{ required: "Nivel" },
		  codgrado:{ required: "Grado" },
		  codturno:{ required: "Turno" },
		  becado:{ required: "Becado" },
			
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#notas").serialize();
				var codturno = $('#codturno').val();
				var codnivel = $('#codnivel').val();
				var codgrado = $('#codgrado').val();
				var codseccion = $('#codseccion').val();
				var codmateria = $('#codmateria').val();

	           				
				$.ajax({
				
				type : 'POST',
				url  : 'fornotas.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> NO PUEDEN EXISTIR NOTAS O VALORACI&Oacute;N DE TRIMESTRES EN BLANCO O VALOR A CERO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
$("#muestraestudiantesnotas").load("funciones.php?BuscaEstudiantesNotas=si&codturno="+codturno+"&codnivel="+codnivel+"&codgrado="+codgrado+"&codseccion="+codseccion+"&codmateria="+codmateria);
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE NOTAS */


/* FUNCION JQUERY PARA VALIDAR REGISTRO DE NOTAS NUEVOS INSCRITOS */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#nuevasnotas").validate({
      rules:
	  {
		  cedest: { required: true },
		  codperiodo: { required: true },
		  codnivel: { required: true },
		  codgrado: { required: true },
		  codturno: { required: true },
		  becado: { required: true },
			
	   },
       messages:
	   {
		  cedest:{ required: "Ingrese N&deg de DNI de Estudiante" },
	      codperiodo:{ required: "Periodo" },
		  codnivel:{ required: "Nivel" },
		  codgrado:{ required: "Grado" },
		  codturno:{ required: "Turno" },
		  becado:{ required: "Becado" },
			
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#nuevasnotas").serialize();
				var codest = $('#codest').val();
				var codturno = $('#codturno').val();
				var codseccion = $('#codseccion').val();
				var codperiodo = $('#codperiodo').val();

	           				
				$.ajax({
				
				type : 'POST',
				url  : 'nuevasnotas.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}  
								else if(data==2){
									
					$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> NO PUEDEN EXISTIR NOTAS O VALORACI&Oacute;N DE TRIMESTRES EN BLANCO O VALOR A CERO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}  
								else{
										
					$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
$("#muestramateriasnotas").load("funciones.php?VerificaNuevaNota=si&codest="+btoa(codest)+"&codseccion="+btoa(codseccion)+"&codturno="+btoa(codturno)+"&codperiodo="+btoa(codperiodo));
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/* FUNCION JQUERY PARA VALIDAR REGISTRO DE NOTAS NUEVOS INSCRITOS */	 