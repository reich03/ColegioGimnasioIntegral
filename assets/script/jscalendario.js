$(function () {
//$(".calendario").datepicker({
  $('input').filter('.expira').datepicker({
   closeText: 'Cerrar',
   prevText: '<Anterior',
   nextText: 'Siguiente>',
   currentText: 'Hoy',
   monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
   monthNames: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
   dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
   dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sab'],
   dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
   weekHeader: 'Sm',
   dateFormat: 'dd-mm-yy',
   firstDay: 1,
 //maxDate: 0,
 changeMonth: true,
 changeYear: true,
 yearRange: '2018:2050'
});
});

$(function () {
$.datepicker.setDefaults($.datepicker.regional["es"]);

$(".nacimiento").datepicker({
 closeText: 'Cerrar',
 prevText: '<Anterior',
 nextText: 'Siguiente>',
 currentText: 'Hoy',
 monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNames: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
 dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sab'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
 weekHeader: 'Sm',
 dateFormat: 'dd-mm-yy',
 firstDay: 1,
 maxDate: 0,
 changeMonth: true,
 changeYear: true,
 yearRange: '1900:' + new Date().getFullYear()
 });
});

$(function () {
//$(".calendario").datepicker({
  $('input').filter('.calendario').datepicker({
   closeText: 'Cerrar',
   prevText: '<Anterior',
   nextText: 'Siguiente>',
   currentText: 'Hoy',
   monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
   monthNames: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
   dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
   dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sab'],
   dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
   weekHeader: 'Sm',
   dateFormat: 'dd-mm-yy',
   firstDay: 1,
 //maxDate: 0,
 changeMonth: true,
 changeYear: true,
 yearRange: '2000:2050'
});
});

$(function () {
//$(".calendario").datepicker({
  $('input').filter('.calendario2').datepicker({
   closeText: 'Cerrar',
   prevText: '<Anterior',
   nextText: 'Siguiente>',
   currentText: 'Hoy',
   monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
   monthNames: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
   dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
   dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sab'],
   dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
   weekHeader: 'Sm',
   dateFormat: 'dd-mm-yy',
   //firstDay: 1,
   minDate: 0,
   changeMonth: true,
   changeYear: true,
   yearRange: '2018:2050'
   });
});


$(function () {
$.datepicker.setDefaults($.datepicker.regional["es"]);

$("#inicioinscripcion").datepicker({
 closeText: 'Cerrar',
 prevText: '<Anterior',
 nextText: 'Siguiente>',
 currentText: 'Hoy',
 monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNames: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
 dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sab'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
 weekHeader: 'Sm',
 dateFormat: 'dd-mm-yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 changeMonth: true,
 changeYear: true,
 yearSuffix: '',
onClose: function (selectedDate) {
$("#fininscripcion").datepicker("option", "minDate", selectedDate);
}
});

$("#fininscripcion").datepicker({
 closeText: 'Cerrar',
 prevText: '<Anterior',
 nextText: 'Siguiente>',
 currentText: 'Hoy',
monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNames: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
 dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sab'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
 weekHeader: 'Sm',
 dateFormat: 'dd-mm-yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 changeMonth: true,
 changeYear: true,
 yearSuffix: '',
onClose: function (selectedDate) {
$("#inicioinscripcion").datepicker("option", "maxDate", selectedDate);
}
});

});



$(function () {
$.datepicker.setDefaults($.datepicker.regional["es"]);

$("#desde").datepicker({
 closeText: 'Cerrar',
 prevText: '<Anterior',
 nextText: 'Siguiente>',
 currentText: 'Hoy',
 monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNames: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
 dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sab'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
 weekHeader: 'Sm',
 dateFormat: 'dd-mm-yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 changeMonth: true,
 changeYear: true,
 yearSuffix: '',
onClose: function (selectedDate) {
$("#hasta").datepicker("option", "minDate", selectedDate);
}
});

$("#hasta").datepicker({
 closeText: 'Cerrar',
 prevText: '<Anterior',
 nextText: 'Siguiente>',
 currentText: 'Hoy',
monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNames: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
 dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sab'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
 weekHeader: 'Sm',
 dateFormat: 'dd-mm-yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 changeMonth: true,
 changeYear: true,
 yearSuffix: '',
onClose: function (selectedDate) {
$("#desde").datepicker("option", "maxDate", selectedDate);
}
});

});