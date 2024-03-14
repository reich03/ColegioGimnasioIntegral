// JavaScript Document
// FUNCION PARA DARLE TITULO A TODOS LOS ARCHIVOS
$(document).ready(function() {

document.title = '.:: Sistema Integrado para la Gestión Académica ::.';		
$(".current-year").text('2018 - ' + new Date().getFullYear() + ' CopyRight. Todos los Derechos Reservados. SIGA');
//$(".logo").text('SOFTWARE ACADÉMICO');		
}); 


// FUNCION PARA PERMITIR CAMPOS NUMEROS
function NumberFormat(num, numDec, decSep, thousandSep){
    var arg;
    var Dec;
    Dec = Math.pow(10, numDec); 
    if (typeof(num) == 'undefined') return; 
    if (typeof(decSep) == 'undefined') decSep = ',';
    if (typeof(thousandSep) == 'undefined') thousandSep = '.';
    if (thousandSep == '.')
     arg=/./g;
    else
     if (thousandSep == ',') arg=/,/g;
    if (typeof(arg) != 'undefined') num = num.toString().replace(arg,'');
    num = num.toString().replace(/,/g, '.'); 
    if (isNaN(num)) num = "0";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num * Dec + 0.50000000001);
    cents = num % Dec;
    num = Math.floor(num/Dec).toString(); 
    if (cents < (Dec / 10)) cents = "0" + cents; 
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
     num = num.substring(0, num.length - (4 * i + 3)) + thousandSep + num.substring(num.length - (4 * i + 3));
    if (Dec == 1)
     return (((sign)? '': '-') + num);
    else
     return (((sign)? '': '-') + num + decSep + cents);
   } 

   function EvaluateText(cadena, obj){
    opc = false; 
    if (cadena == "%d")
     if (event.keyCode > 47 && event.keyCode < 58)
      opc = true;
    if (cadena == "%f"){ 
     if (event.keyCode > 47 && event.keyCode < 58)
      opc = true;
     if (obj.value.search("[.*]") == -1 && obj.value.length != 0)
      if (event.keyCode == 46)
       opc = true;
    }
    if(opc == false)
     event.returnValue = false; 
   }
   
   $(document).ready(function(){ 
$(".number").keydown(function(event) {
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
   
  
function getTime()
        {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            var num = new Array ("01","02","03","04","05","06","07","08","09","10","11","12");
      var mt = "AM";

         // Pongo el formato 12 horas
      if (h> 12) {
      mt = "PM";
      h = h - 12;
      }
      if (h == 0) h = 12;
      // Pongo minutos y segundos con dos digitos
      //if (m <= 9) m = "0" + m;
      //if (s <= 9) s = "0" + s;
      
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
document.getElementById('fecharegistro').value= today.getDate() + "-" + num[today.getMonth()] + "-" + today.getFullYear() + " " + h+":"+m+":"+s;
$('#result3').html(today.getDate() + "-" + num[today.getMonth()] + "-" + today.getFullYear() + " " + h+":"+m+":"+s);
            t=setTimeout(function(){getTime()},500);
        }

        function checkTime(i)
        {
            if (i<10)
            {
                i="0" + i;
            }
            return i;
        }

// FUNCION PARA LA FECHA Y HORA
function muestraReloj()
{
// Compruebo si se puede ejecutar el script en el navegador del usuario
if (!document.layers && !document.all && !document.getElementById) return;
// Obtengo la hora actual y la divido en sus partes
var num = new Array ("01","02","03","04","05","06","07","08","09","10","11","12");
var fechacompleta = new Date();
var horas = fechacompleta.getHours();
var minutos = fechacompleta.getMinutes();
var segundos = fechacompleta.getSeconds();

var day = fechacompleta.getDate();
var mes = fechacompleta.getMonth(); 
var year = fechacompleta.getFullYear();

// Pongo el dia, minutos y segundos con dos digitos
if (day <= 9) day = "0" + day;
if (horas <= 9) horas = "0" + horas;
if (minutos <= 9) minutos = "0" + minutos;
if (segundos <= 9) segundos = "0" + segundos;
// En la variable 'cadenareloj' puedes cambiar los colores y el tipo de fuente
//cadenareloj = "<font size='-1' face='verdana'>" + horas + ":" + minutos + ":" + segundos + " " + mt + "</font>";
cadenareloj = "<i class='fa fa-calendar'></i> " + day + "-" + num[mes]  + "-" + year + "     " + horas + ":" + minutos + ":" + segundos;

// Escribo el reloj de una manera u otra, segun el navegador del usuario
if (document.layers) {
document.layers.spanreloj.document.write(cadenareloj);
document.layers.spanreloj.document.close();
}
else if (document.all) spanreloj.innerHTML = cadenareloj;
else if (document.getElementById) document.getElementById("spanreloj").innerHTML = cadenareloj;
// Ejecuto la funcion con un intervalo de un segundo
setTimeout("muestraReloj()", 1000);
}


//FUNCION PARA CALCULAR DESCUENTO EN INSCRIPCIONES
function calculardescuento(){

      var desc = $('input#descuento').val();
      desc2  = desc/100;
      var total = $('input#totalactual').val();
      var unica = $('input#cuotaunica').val();
      var montomesextra = $('input#montomesextra').val();

      //CALCULO DEL TOTAL DE FACTURA
      TotalDescuentoGeneral = total * desc2;
      TotalFactura = total - TotalDescuentoGeneral;
            
      var original=parseFloat(TotalFactura);
      var original2=parseFloat(TotalFactura) + parseFloat(unica) + parseFloat(montomesextra);

      $("#textdescuento").text(TotalDescuentoGeneral.toFixed(2));
      $("#texttotalcuota").val(original.toFixed(2));
      $("#totalcuota").text(original.toFixed(2));
      $("#total").val(original2.toFixed(2));
      $("#texttotal").text(original2.toFixed(2));
       
        }


//FUNCION PARA CALCULAR LA DIFERENCIA EN CIERRE DE CAJA
$(document).ready(function (){
          $('.cierrecaja').keyup(function (){
      
      var efectivo = $('input#dineroefectivo').val();
      var estimado = $('input#estimado').val();
            
      //REALIZO EL CALCULO Y MUESTRO LA DEVOLUCION
      total=efectivo - estimado;
      var original=parseFloat(total.toFixed(2));
      $("#diferencia").val(original.toFixed(2));/**/
      
          });
});