// FUNCION AUTOCOMPLETE PARA ESTUDIANTES, PADRES Y TUTORES


$(function() {
           $("#busquedadocente").autocomplete({
           source: "class/buscadocente.php",
		   minLength: 2,
           select: function(event, ui) { 
		    $('#coddoc').val(ui.item.coddoc);
           }  
      });
 });

$(function() {
           $("#cedpadre").autocomplete({
           source: "class/buscarepresentante.php",
		   minLength: 2,
           select: function(event, ui) { 
		    $('#nompadre').val(ui.item.nompadre);
		    $('#apepadre').val(ui.item.apepadre);
		    $('#direcpadre').val(ui.item.direcpadre);
		    $('#tlfpadre').val(ui.item.tlfpadre);
		    $('#expedpadre').val(ui.item.expedpadre);
		    $('#parentesco').val(ui.item.parentesco);
		    $('#estadopadre').val(ui.item.estadopadre);
		    $('#profpadre').val(ui.item.profpadre);
		    $('#trabajapadre').val(ui.item.trabajapadre);
		    $('#statuspad').val(ui.item.statuspad);
           }  
      });
 });

$(function() {
           $("#cedula").autocomplete({
           source: "class/buscaestudiante.php",
		   minLength: 2,
           select: function(event, ui) { 
		    $('#cedula').val(ui.item.cedest);
           }  
      });
 });


$(function() {
           $("#busqueda").autocomplete({
           source: "class/busquedaestudiante.php",
		   minLength: 2,
           select: function(event, ui) {
		    $('#codest').val(ui.item.codest); 
		    $('#cedest').val(ui.item.cedest);
		    $('#pnomest').val(ui.item.pnomest);
		    $('#snomest').val(ui.item.snomest);
		    $('#papeest').val(ui.item.papeest);
		    $('#sapeest').val(ui.item.sapeest);
		    $('#sexoest').val(ui.item.sexoest);
		    $('#direcest').val(ui.item.direcest);
		    $('#fnacest').val(ui.item.fnacest);
           }  
      });
 });