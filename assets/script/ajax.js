function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

/*################################################# AQUI FUNCIONES PARA VARIOS PROCESOS ###################################################*/


//////// FUNCIONES PARA MOSTRAR MENSAJES DE ALERTA DE ACTUALIZAR, ELIMINAR Y PAGAR REGISTROS
function actualizar(url)
{
	if(confirm('ESTA SEGURO DE ACTUALIZAR ESTE REGISTRO ?'))
	{
		window.location=url;
	}
}

function eliminar(url)
{
	if(confirm('ESTA SEGURO DE ELIMINAR ESTE REGISTRO ?'))
	{
		window.location=url;
	}
}

function pagar(url)
{
	if(confirm('ESTA SEGURO DE REALIZAR EL PAGO DE FACTURA DE COMPRA ?'))
	{
		window.location=url;
	}
}

function VerificaMovimiento()
{
  alert('ESTE MOVIMIENTO EN CAJA NO PUEDE ELIMINARSE,\nLA FECHA DE MOVIMIENTO ES DIFERENTE A LA ACTUAL ');
}

function cerrarcaja(url)
{
  if(confirm('ESTA SEGURO DE REALIZAR EL CIERRE DE ESTA CAJA ?'))
  {
    window.location=url;
  }
}




$(document).ready(function(){ 
$(".precio").keydown(function(event) {
   if(event.shiftKey)
   {
        event.preventDefault();
   }
 
   if (event.keyCode == 46 || event.keyCode == 8)    {
   }
   else {
        if (event.keyCode < 95) {
          if (event.keyCode < 48 || event.keyCode > 57) {
                event.preventDefault();
          }
        } 
        else {
              if (event.keyCode < 96 || event.keyCode > 105) {
                  event.preventDefault();
              }
        }
      }
   });
});


//FUNCION PARA LIMPIAR CAMPOS DE INSCRIPCIONES
function LimpiarInscripciones(){
$("#inscripciones")[0].reset(); 
$("#muestracampomonto").html("");
$("#muestraforpagos").html("");
$("#error").html("");
}

// FUNCION PARA LIMPIAR CHECKBOX ACTIVOS
function LimpiarCheckbox(){
$("input[type='checkbox']:checked:enabled").attr('checked',false);
$("#cargacheckbox").html("");
//$('#reservacion').attr('disabled', 'disabled');
//$('.combo').attr('disabled', 'disabled');  
}


//FUNCION MOSTRAR DATOS PERSONALES DEL USUARIO
function VerUsuario(codigo){

	var muestra = document.getElementById('muestrausuariomodal');
	
		//instanciamos el objetoAjax
		ajax=objetoAjax();
		//uso del medotod GET
		ajax.open("GET", "funciones.php?BuscaUsuarioModal=si&codigo="+codigo);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}



//FUNCION MOSTRAR DATOS PERSONALES DEL DOCENTE
function VerDocente(coddoc){

	var muestra = document.getElementById('muestradocentemodal');
	
		//instanciamos el objetoAjax
		ajax=objetoAjax();
		//uso del medotod GET
		ajax.open("GET", "funciones.php?BuscaDocenteModal=si&coddoc="+coddoc);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}

//FUNCION MOSTRAR DATOS DE ARQUEO DE CAJA
function VerArqueo(codarqueo){

	var muestra = document.getElementById('muestraarqueomodal');
	
		//instanciamos el objetoAjax
		ajax=objetoAjax();
		//uso del medotod GET
		ajax.open("GET", "funciones.php?BuscaArqueoCajaModal=si&codarqueo="+codarqueo);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}

//FUNCION PARA BUSQUEDA DE ARQUEOS POR FECHAS PARA REPORTES
function BuscarArqueosxFechas(desde,hasta,codperiodo){

	var muestra = document.getElementById('muestraarqueosxfechas');
			 
		ajax=objetoAjax();
		ajax.open("GET", "funciones.php?BuscaArqueosxFechas=si&desde="+desde+"&hasta="+hasta+"&codperiodo="+codperiodo);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}


//FUNCION MOSTRAR DATOS DE MOVIMIENTO DE CAJA
function VerMovimientoCaja(codmovimientocaja){

	var muestra = document.getElementById('muestramovimientocajamodal');
	
		//instanciamos el objetoAjax
		ajax=objetoAjax();
		//uso del medotod GET
		ajax.open("GET", "funciones.php?BuscaMovimientoCajaModal=si&codmovimientocaja="+codmovimientocaja);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}


//FUNCION PARA BUSQUEDA DE MOVIMIENTOS POR FECHAS PARA REPORTES
function BuscarMovimientosxFechas(codcaja,desde,hasta,codperiodo){

	var muestra = document.getElementById('muestramovimientosxfechas');
			 
		ajax=objetoAjax();
		ajax.open("GET", "funciones.php?BuscaMovimientosxFechas=si&codcaja="+codcaja+"&desde="+desde+"&hasta="+hasta+"&codperiodo="+codperiodo);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}


//FUNCION PARA MOSTRAR GRADOS POR NIVELES
function ActivaGrados(codnivel){

	var muestra = document.getElementById('codgrado');
	
		//instanciamos el objetoAjax
		ajax=objetoAjax();
		//uso del medotod GET
		ajax.open("GET", "funciones.php?BuscaGrados=si&codnivel="+codnivel);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				//muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
		
		
	var muestra2 = document.getElementById('muestracampomonto');
	
		//instanciamos el objetoAjax
		ajax2=objetoAjax();
		//uso del medotod GET
		ajax2.open("GET", "funciones.php?MuestraCampoMesPago=si&codnivel="+btoa(codnivel));
		ajax2.onreadystatechange=function() {
				if (ajax2.readyState==1 || ajax2.readyState==2 || ajax2.readyState==3) {
				muestra2.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax2.readyState==4) {
				var resul2=ajax2.responseText
				muestra2.innerHTML = resul2											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax2.send(null);
}


//FUNCION PARA MOSTRAR SECCION POR GRADOS
function ActivaSeccion(codgrado){

	var muestra = document.getElementById('codseccion');
	
		//instanciamos el objetoAjax
		ajax=objetoAjax();
		//uso del medotod GET
		ajax.open("GET", "funciones.php?BuscaSeccion=si&codgrado="+codgrado);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}


//FUNCION PARA MOSTRAR MATERIAS POR GRADOS
function ActivaMaterias(codgrado){

	var muestra = document.getElementById('codmateria');
	
		//instanciamos el objetoAjax
		ajax=objetoAjax();
		//uso del medotod GET
		ajax.open("GET", "funciones.php?BuscaMaterias=si&codgrado="+codgrado);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}


//FUNCION PARA MOSTRAR FORMULARIO DE PAGOS EN INSCRIPCION DE ESTUDIANTES
function ActivaPagos(montopago,becado){

	var muestra = document.getElementById('muestraforpagos');
	
		//instanciamos el objetoAjax
		ajax=objetoAjax();
		//uso del medotod GET
		ajax.open("GET", "funciones.php?BuscaFormularioPagos=si&montopago="+montopago+"&becado="+becado);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}

//FUNCION MOSTRAR DATOS PERSONALES DEL DOCENTE
function VerMateria(codmateria){

	var muestra = document.getElementById('muestramateriamodal');
	
		//instanciamos el objetoAjax
		ajax=objetoAjax();
		//uso del medotod GET
		ajax.open("GET", "funciones.php?BuscaMateriaModal=si&codmateria="+codmateria);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}

//FUNCION PARA BUSQUEDA DE ESTUDIANTES PARA REPORTES
function BuscarMateriasReportes(codnivel,codgrado){

	var muestra = document.getElementById('muestramaterias');
			 
		ajax=objetoAjax();
		ajax.open("GET", "funciones.php?BuscaMateriasReportes=si&codnivel="+codnivel+"&codgrado="+codgrado);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}










/*########################################### AQUI FUNCIONES PARA PROCESAR PERIODO ESOCOLAR ################################################*/

//FUNCION MOSTRAR DATOS PERSONALES DEL PERIODO ESCOLAR
function VerPeriodo(codperiodo){

	var muestra = document.getElementById('muestraperiodomodal');
	
		//instanciamos el objetoAjax
		ajax=objetoAjax();
		//uso del medotod GET
		ajax.open("GET", "funciones.php?BuscaPeriodoModal=si&codperiodo="+codperiodo);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}

//FUNCION PARA CREAR NUEVO PERIODO ESCOLAR
function CrearPeriodo(mesesactivos,periodo,descripcion,cuotaunica,interesmora,diasvence){

	var muestra = document.getElementById('muestraperiodo');

					var elementos = document.getElementsByName("mesesactivos[]");
					var cont = 0; 
					for (var x=0; x < elementos.length; x++) {
					 if (elementos[x].checked) {
					  cont = cont + 1;
					 }
				}
					 if(cont > 0) {
					texto = []; 
					for (x=0;x<elementos.length;x++){
					if (elementos[x].checked==true) {
					texto.push(elementos[x].value);
				}
		} 
		//document.forms['miformulario']['destinook'].value = texto.split(","); 
		ajax=objetoAjax();
		ajax.open("GET", "funciones.php?CrearPeriodoEscolar=si&mesesactivos="+texto+"&periodo="+periodo+"&descripcion="+descripcion+"&cuotaunica="+cuotaunica+"&interesmora="+interesmora+"&diasvence="+diasvence);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);		
					 } else {
						alert('POR FAVOR DEBE DE SELECCIONAR AL MENOS UN MES PARA PAGOS'); 
				}
}
























/*########################################### AQUI FUNCIONES PARA PROCESAR ASIGNACION DE CURSOS ################################################*/

//FUNCION PARA REGISTRAR ASIGNACION DE CURSOS
function BuscaDocente(){
    
$('#muestradocente').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var coddoc = $("#coddoc").val();
var dataString = $("#asignaciones").serialize();
var url = 'funciones.php?CrearAsignacion=si';

        $.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {
                $('#muestradocente').empty();
                $('#muestradocente').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
            }
      }); 
}

//FUNCION PARA LIMPIAR CAMPOS EN ASIGNACION DE CURSOS
function LimpiarAsignacion(){
    
$("#codturno").val("");
$("#codnivel").val("");
$('#codgrado').html("<option value=''>SIN RESULTADOS</option>");
$('#codseccion').html("<option value=''>SIN RESULTADOS</option>");
$('#codmateria').html("<option value=''>SIN RESULTADOS</option>");

}

//FUNCION MOSTRAR DATOS DE ASIGNACION DE CURSO A DOCENTE
function VerAsignacion(codasignacion){

	var muestra = document.getElementById('muestraasignacionmodal');
	
		//instanciamos el objetoAjax
		ajax=objetoAjax();
		//uso del medotod GET
		ajax.open("GET", "funciones.php?BuscaAsignacionModal=si&codasignacion="+codasignacion);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}

//FUNCION PARA BUSQUEDA DE ASIGNACIONES DE CURSOS A DOCENTES PARA REPORTES
function BuscarAsignacionMateriasReportes(coddoc,codperiodo){

	var muestra = document.getElementById('muestraasignaciones');
			 
		ajax=objetoAjax();
		ajax.open("GET", "funciones.php?BuscaAsignacionMateriasReportes=si&coddoc="+coddoc+"&codperiodo="+codperiodo);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}





























/*########################################### AQUI FUNCIONES PARA PROCESAR INSCRIPCIONES DE ESTUDIANTES ################################################*/

//FUNCION PARA REGISTRAR INSCRIPCION DE ESTUDIANTES
function BuscaEstudiante(){
    
$('#muestraestudiante').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var cedula = $("#cedula").val();
var dataString = $("#inscripciones").serialize();
var url = 'funciones.php?CrearEstudiante=si';

        $.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {
                $('#muestraestudiante').empty();
                $('#muestraestudiante').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
            }
      }); 
}


//FUNCION PARA BUSQUEDA DE ESTUDIANTES PARA PROCESOS
function BusquedaControlEstudiantes(codturno,codnivel,codgrado,codseccion){

	var muestra = document.getElementById('muestraestudiantes');
			 
		ajax=objetoAjax();
		ajax.open("GET", "funciones.php?BusquedaControlEstudiantes=si&codturno="+codturno+"&codnivel="+codnivel+"&codgrado="+codgrado+"&codseccion="+codseccion);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}

//FUNCION MOSTRAR DATOS PERSONALES DEL ESTUDIANTE
function VerEstudiante(codest){

	var muestra = document.getElementById('muestraestudiantemodal');
	
		//instanciamos el objetoAjax
		ajax=objetoAjax();
		//uso del medotod GET
		ajax.open("GET", "funciones.php?BuscaEstudianteModal=si&codest="+codest);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}

/////FUNCION PARA ELIMINAR ESTUDIANTE 
function EliminarEstudiante(codest,cedpadre,tipo,codturno,codnivel,codgrado,codseccion) {

var dataString = 'codest='+codest+'&cedpadre='+cedpadre+'&tipo='+tipo;
var eliminar = confirm("ESTA SEGURO DE ELIMINAR ESTE ESTUDIANTE?\nAL ELIMINARLO, SE ELIMINARAN TODOS SUS REGISTROS RELACIONADOS")
    
        if ( eliminar ) { 
        
        $.ajax({
            type: "GET",
            url: "eliminar.php",
            data: dataString,
            success: function(response) {            
                $('#delete-ok').empty();
                $('#delete-ok').append('<center>'+response+'</center>').fadeIn("slow");
$("#muestraestudiantes").load("funciones.php?BusquedaControlEstudiantes=si&codturno="+codturno+'&codnivel='+codnivel+'&codgrado='+codgrado+'&codseccion='+codseccion);
                setTimeout(function() { $("#delete-ok").html(""); }, 5000);
                $('#'+parent).remove();
            }
        });
      }
}

// FUNCION PARA ACTUALIZAR DATOS DE ESTUDIANTES DE VENTANA MODAL
function EditEstudiante(codest,cedest,pnomest,snomest,papeest,sapeest,sexoest,direcest,fnacest,codturno,codnivel,codgrado,codseccion) {
	
    // do anything you want here
	$("#updateestudiantes #codest").val(codest);
	$("#updateestudiantes #cedest").val(cedest);
	$("#updateestudiantes #pnomest").val(pnomest);
	$("#updateestudiantes #snomest").val(snomest);
	$("#updateestudiantes #papeest").val(papeest);
	$("#updateestudiantes #sapeest").val(sapeest);
	$("#updateestudiantes #sexoest").val(sexoest);
	$("#updateestudiantes #direcest").val(direcest);
	$("#updateestudiantes #fnacest").val(fnacest);
	$("#updateestudiantes #codturno2").val(codturno);
	$("#updateestudiantes #codnivel2").val(codnivel);
	$("#updateestudiantes #codgrado2").val(codgrado);
	$("#updateestudiantes #codseccion2").val(codseccion);
};

// FUNCION PARA RETIRAR ESTUDIANTES DE VENTANA MODAL
function RetiraEstudiante(codest,cedest,pnomest,papeest,codperiodo,codturno,codnivel,codgrado,codseccion) {
    // do anything you want here
	$("#retiroestudiantes #codest").val(codest);
	$("#retiroestudiantes #cedest").val(cedest);
	$("#retiroestudiantes #pnomest").val(pnomest);
	$("#retiroestudiantes #papeest").val(papeest);
	$("#retiroestudiantes #codperiodo").val(codperiodo);
	$("#retiroestudiantes #codturno3").val(codturno);
	$("#retiroestudiantes #codnivel3").val(codnivel);
	$("#retiroestudiantes #codgrado3").val(codgrado);
	$("#retiroestudiantes #codseccion3").val(codseccion);
};


//FUNCION PARA CARGAR DETALLES DE PAGOS DE CUOTAS AL INSCRIBIR ESTUDIANTES
function CargaDetallesPagosInscripcion(mespago,montopago,cuotaunica,becado){

var muestra = document.getElementById('muestradetallepagos');

var elementos = document.getElementsByName("mespago[]");
					var cont = 0; 
					for (var x=0; x < elementos.length; x++) {
					 if (elementos[x].checked && !elementos[x].disabled) {
					  cont = cont + 1;
					 }
				}
					 if(cont > 0) {
					texto = []; 
					for (x=0;x<elementos.length;x++){
					if (elementos[x].checked && !elementos[x].disabled) {
					texto.push(elementos[x].value);
				}
		} 

ajax=objetoAjax();
ajax.open("GET", "funciones.php?CargaDetallePagosInscripcion=si&mespago="+texto+"&mespago2="+mespago+"&montopago="+montopago+"&cuotaunica="+cuotaunica+"&becado="+becado+"&totalpago="+cont);
ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);		
					 } 
}


//FUNCION PARA BUSQUEDA DE ESTUDIANTES PARA REPORTES
function BuscarEstudiantesReportes(codturno,codnivel,codgrado,codseccion){

	var muestra = document.getElementById('muestraestudiantes');
			 
		ajax=objetoAjax();
		ajax.open("GET", "funciones.php?BuscaEstudiantesReportes=si&codturno="+codturno+"&codnivel="+codnivel+"&codgrado="+codgrado+"&codseccion="+codseccion);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}



//FUNCION MOSTRAR DATOS PERSONALES DEL PADRE O TUTOR
function VerPadre(codpadre){

	var muestra = document.getElementById('muestratutormodal');
	
		//instanciamos el objetoAjax
		ajax=objetoAjax();
		//uso del medotod GET
		ajax.open("GET", "funciones.php?BuscaTutorModal=si&codpadre="+codpadre);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}


//FUNCION PARA BUSQUEDA DE REPRESENTANTES PARA REPORTES
function BuscarRepresentantesReportes(codturno,codnivel,codgrado,codseccion){

	var muestra = document.getElementById('muestrarepresentantes');
			 
		ajax=objetoAjax();
		ajax.open("GET", "funciones.php?BuscaRepresentantesReportes=si&codturno="+codturno+"&codnivel="+codnivel+"&codgrado="+codgrado+"&codseccion="+codseccion);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}
























/*########################################### AQUI FUNCIONES PARA PAGOS DE ESTUDIANTES ################################################*/

/////// FUNCION PARA BUSCAR PAGOS PARA ESTUDIANTE
function CrearNuevoPago(codest,codperiodo){

	var muestra = document.getElementById('muestraestudiantepagos');
	
		//instanciamos el objetoAjax
		ajax=objetoAjax();
		//uso del medotod GET
		ajax.open("GET", "funciones.php?CrearPagosEstudiante=si&codest="+codest+"&codperiodo="+codperiodo);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}

/////// FUNCION PARA BUSCAR PAGOS POR ESTUDIANTE
function BuscarPagosxEstudiantes(codest,codperiodo){

	var muestra = document.getElementById('muestrapagosxestudiantes');
	
		//instanciamos el objetoAjax
		ajax=objetoAjax();
		//uso del medotod GET
		ajax.open("GET", "funciones.php?BuscarPagosxEstudiante=si&codest="+codest+"&codperiodo="+codperiodo);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}

//FUNCION PARA CARGAR DETALLES DE PAGOS DE CUOTAS
function CargaDetallesPagos(mespago,montopago,montomora){

	var muestra = document.getElementById('cargacheckbox');

var elementos = document.getElementsByName("mespago[]");
					var cont = 0; 
					for (var x=0; x < elementos.length; x++) {
					 if (elementos[x].checked && !elementos[x].disabled) {
					  cont = cont + 1;
					 }
				}
					 if(cont > 0) {
					texto = []; 
					for (x=0;x<elementos.length;x++){
					if (elementos[x].checked && !elementos[x].disabled) {
					texto.push(elementos[x].value);
				}
		} 

		ajax=objetoAjax();
		ajax.open("GET", "funciones.php?CargaCheckbox=si&mespago="+texto+"&montopago="+montopago+"&montomora="+montomora+"&total="+cont);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);		
					 } 
}


//FUNCION MOSTRAR DATOS PERSONALES DEL PAGO DE ESTUDIANTE
function VerPagos(codpago){

	var muestra = document.getElementById('muestrapagosmodal');
	
		//instanciamos el objetoAjax
		ajax=objetoAjax();
		//uso del medotod GET
		ajax.open("GET", "funciones.php?BuscaPagoModal=si&codpago="+codpago);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}


//FUNCION PARA BUSQUEDA DE COMPROBANTE DE PAGOS PARA REPORTES
function BuscarComprobantePagos(codest,codperiodo){

	var muestra = document.getElementById('muestracomprobantespagos');
			 
		ajax=objetoAjax();
		ajax.open("GET", "funciones.php?BuscaComprobantesReportes=si&codest="+codest+"&codperiodo="+codperiodo);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}

//FUNCION PARA BUSQUEDA DE PAGOS GENERALES PARA REPORTES
function BuscarPagosGenerales(desde,hasta,codperiodo){

	var muestra = document.getElementById('muestrapagosgeneral');
			 
		ajax=objetoAjax();
		ajax.open("GET", "funciones.php?BuscaPagosGeneralesReportes=si&desde="+desde+"&hasta="+hasta+"&codperiodo="+codperiodo);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}


//FUNCION PARA BUSQUEDA DE PAGOS DE CUOTAS AL DIA PARA REPORTES
function BuscarPagosAlDia(codturno,codnivel,codgrado,codseccion,mespago,codperiodo){
	var muestra = document.getElementById('muestrapagosaldia');
			 
		ajax=objetoAjax();
		ajax.open("GET", "funciones.php?BuscaPagosAlDiaReportes=si&codturno="+codturno+"&codnivel="+codnivel+"&codgrado="+codgrado+"&codseccion="+codseccion+"&mespago="+mespago+"&codperiodo="+codperiodo);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}


//FUNCION PARA BUSQUEDA DE PAGOS DE CUOTAS VENCIDAS PARA REPORTES
function BuscarPagosVencidos(codturno,codnivel,codgrado,codseccion,codperiodo){
	var muestra = document.getElementById('muestrapagosvencidos');
			 
		ajax=objetoAjax();
		ajax.open("GET", "funciones.php?BuscaPagosVencidosReportes=si&codturno="+codturno+"&codnivel="+codnivel+"&codgrado="+codgrado+"&codseccion="+codseccion+"&codperiodo="+codperiodo);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}






















/*########################################### AQUI FUNCIONES PARA PROCESAR NOTAS DE ESTUDIANTES ################################################*/


//FUNCION PARA BUSQUEDA DE ESTUDIANTES PARA NOTAS
function BuscarEstudiantesNotas(codturno,codnivel,codgrado,codseccion,codmateria){

	var muestra = document.getElementById('muestraestudiantesnotas');
			 
		ajax=objetoAjax();
		ajax.open("GET", "funciones.php?BuscaEstudiantesNotas=si&codturno="+codturno+"&codnivel="+codnivel+"&codgrado="+codgrado+"&codseccion="+codseccion+"&codmateria="+codmateria);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}



//FUNCION MOSTRAR DATOS DE NOTAS DEL ESTUDIANTE
function VerNota(codnota){

	var muestra = document.getElementById('muestranotamodal');
	
		//instanciamos el objetoAjax
		ajax=objetoAjax();
		//uso del medotod GET
		ajax.open("GET", "funciones.php?BuscaNotasModal=si&codnota="+codnota);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}



//FUNCION PARA BUSQUEDA DE NOTAS ACTUALES
function BuscarNotas(codest){

	var muestra = document.getElementById('muestranotas');
			 
		ajax=objetoAjax();
		ajax.open("GET", "funciones.php?BuscaNotas=si&codest="+codest+"&c=d");
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}


//FUNCION PARA BUSQUEDA DE NOTAS POR CURSOS
function BuscarNotasxCursos(codturno,codnivel,codgrado,codseccion,codperiodo){

	var muestra = document.getElementById('muestranotasxcursos');
			 
		ajax=objetoAjax();
		ajax.open("GET", "funciones.php?BuscaNotasxCursos=si&codturno="+codturno+"&codnivel="+codnivel+"&codgrado="+codgrado+"&codseccion="+codseccion);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}


//FUNCION PARA BUSQUEDA DE NOTAS POR PERIODO ESCOLAR
function BuscarNotasxPeriodos(codest,codperiodo){

	var muestra = document.getElementById('muestranotasxperiodos');
			 
		ajax=objetoAjax();
		ajax.open("GET", "funciones.php?BuscaNotasxPeriodos=si&codest="+codest+"&codperiodo="+codperiodo);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}

//FUNCION PARA BUSQUEDA DE ESTUDIANTES NUEVAS NOTAS
function BuscaEstudianteNuevaNota(codest){

	var muestra = document.getElementById('muestraestudiantenuevanota');
	$("#muestramateriasnotas").html("");
			 
		ajax=objetoAjax();
		ajax.open("GET", "funciones.php?BuscaEstudiantesNuevaNota=si&codest="+codest);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}

//FUNCION PARA BUSQUEDA DE ESTUDIANTES NUEVAS NOTAS # 2
function VerificaNuevaNota(codest,codseccion,codturno,codperiodo){

	var muestra = document.getElementById('muestramateriasnotas');
			 
		ajax=objetoAjax();
		ajax.open("GET", "funciones.php?VerificaNuevaNota=si&codest="+codest+"&codseccion="+codseccion+"&codturno="+codturno+"&codperiodo="+codperiodo);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><img src='assets/images/loading.gif' width='40' height='40'/></center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		//como hacemos uso del metodo GET
		//colocamos null
		ajax.send(null);
}



