<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria") {

$con = new Login();
$con = $con->ContarRegistros();

$tra = new Login();
$ses = $tra->ExpiraSession();

if(isset($_POST['btn-submit']))
{
$reg = $tra->RegistrarDocentes();
exit;
} 
else if(isset($_POST['btn-update']))
{
$reg = $tra->ActualizarDocentes();
exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="assets/images/favicon.png" rel="icon" type="image">
<link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="assets/css/icons.css" rel="stylesheet" type="text/css">
<link href="assets/css/style.css" rel="stylesheet" type="text/css"> 

<!-- script jquery -->
<script src="assets/js/jquery.min.js"></script> 
<script type="text/javascript" src="assets/script/titulos.js"></script>
<script type="text/jscript" language="javascript" src="assets/script/ajax.js"></script>
<script type="text/javascript" src="assets/script/validation.min.js"></script>
<script type="text/javascript" src="assets/script/script.js"></script>
<script type="text/javascript">
    jQuery.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-zA-ZñÑáéíóúÁÉÍÓÚ,. ]+$/i.test(value);
    }, "Ingrese solo letras");
</script>
<!-- script jquery -->  

<!-- Calendario -->
    <link rel="stylesheet" href="assets/calendario/jquery-ui.css" />
    <script src="assets/calendario/jquery-ui.js"></script>
    <script src="assets/script/jscalendario.js"></script>
    <script src="assets/script/autocompleto.js"></script>
<!-- Calendario -->
	

</head>
<body onLoad="muestraReloj()" class="fixed-left">
   

  
   <!----- INICIO DE MENU ----->
   <?php include('menu.php'); ?>
   <!----- FIN DE MENU ----->


<div class="content-page">
<div class="content">
<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-edit"></i> Gestión de Docentes</h4>
<ol class="breadcrumb pull-right"><li><a href="panel">Inicio</a></li>
<li><a href="docentes">Control</a></li>
<li class="active">Gestión de Docentes</li>
</ol>

<div class="clearfix"></div>

</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Gestión de Docentes</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12">
   <div class="box-body">
      
<?php  if (isset($_GET['coddoc'])) {
      
      $reg = $tra->DocentesPorId(); ?>
      
<form class="form" name="updatedocentes" id="updatedocentes" method="post" data-id="<?php echo $reg[0]["coddoc"] ?>" action="#">
        
    <?php } else { ?>
        
<form class="form" method="post" action="#" name="docentes" id="docentes">

    <?php } ?>
 

                                                  <div id="error">
                                                 <!-- error will be shown here ! -->
                                                     </div> 
                        <div class="row"> 
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
        <label class="control-label">Nº de DNI: <span class="symbol required"></span></label> 
<input type="hidden" name="coddoc" id="coddoc" <?php if (isset($reg[0]['coddoc'])) { ?> value="<?php echo $reg[0]['coddoc']; ?>"<?php } ?>>
 <input name="ceddoc" class="form-control" type="text" id="ceddoc" onKeyUp="this.value=this.value.toUpperCase();" <?php if (isset($reg[0]['ceddoc'])) { ?> value="<?php echo $reg[0]['ceddoc']; ?>"<?php } ?> placeholder="Ingrese Nº de DNI de Docente" autocomplete="off" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>   
                                                                </div> 
                                                            </div>
															
             <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
            <label class="control-label">Expedido: <span class="symbol required"></span></label>
  <i class="fa fa-bars form-control-feedback"></i>
                              <?php if (isset($reg[0]['expedido'])) { ?>
<select name="expedido" id="expedido" class="form-control" required="required">
    <option value="">SELECCIONE</option>
<option value="LA PAZ"<?php if (!(strcmp('LA PAZ', $reg[0]['expedido']))) {echo "selected=\"selected\"";} ?>>LA PAZ</option>
<option value="COCHABAMBA"<?php if (!(strcmp('COCHABAMBA', $reg[0]['expedido']))) {echo "selected=\"selected\"";} ?>>COCHABAMBA</option>
<option value="SANTA CRUZ"<?php if (!(strcmp('SANTA CRUZ', $reg[0]['expedido']))) {echo "selected=\"selected\"";} ?>>SANTA CRUZ</option>
<option value="CHUQUISACA"<?php if (!(strcmp('CHUQUISACA', $reg[0]['expedido']))) {echo "selected=\"selected\"";} ?>>CHUQUISACA</option>
<option value="ORURO"<?php if (!(strcmp('ORURO', $reg[0]['expedido']))) {echo "selected=\"selected\"";} ?>>ORURO</option>
<option value="TARIJA"<?php if (!(strcmp('TARIJA', $reg[0]['expedido']))) {echo "selected=\"selected\"";} ?>>TARIJA</option>
<option value="POTOSI"<?php if (!(strcmp('POTOSI', $reg[0]['expedido']))) {echo "selected=\"selected\"";} ?>>POTOSI</option>
<option value="BENI"<?php if (!(strcmp('BENI', $reg[0]['expedido']))) {echo "selected=\"selected\"";} ?>>BENI</option>
<option value="PANDO"<?php if (!(strcmp('PANDO', $reg[0]['expedido']))) {echo "selected=\"selected\"";} ?>>PANDO</option>
      </select>
                             <?php } else { ?>  
 <select name="expedido" id="expedido" class="form-control" required="required">
    <option value="">SELECCIONE</option>
    <option value="LA PAZ">LA PAZ</option>
        <option value="COCHABAMBA">COCHABAMBA</option>
        <option value="SANTA CRUZ">SANTA CRUZ</option>
        <option value="CHUQUISACA">CHUQUISACA</option>
        <option value="ORURO">ORURO</option>
        <option value="TARIJA">TARIJA</option>
        <option value="POTOSI">POTOSI</option>
        <option value="BENI">BENI</option>
        <option value="PANDO">PANDO</option>
      </select>
                              <?php } ?>
                              </div> 
                        </div> 

              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
<label class="control-label">Nombres y Apellidos: <span class="symbol required"></span></label> 
<input name="nomdoc" class="form-control" type="text" id="nomdoc" onKeyUp="this.value=this.value.toUpperCase();" <?php if (isset($reg[0]['nomdoc'])) { ?> value="<?php echo $reg[0]['nomdoc']; ?>"<?php } ?> placeholder="Ingrese Nombres y Apellidos de Docente" autocomplete="off" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>  
                                                                </div> 
                                                            </div>   	
                    </div>
														
					<div class="row">

	                  <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
            <label class="control-label">Estado Civil: <span class="symbol required"></span></label>
  <i class="fa fa-bars form-control-feedback"></i>
                              <?php if (isset($reg[0]['edocivildoc'])) { ?>
<select name="edocivildoc" id="edocivildoc" class="form-control" required="required">
              <option value="">SELECCIONE</option>
              <option value="SOLTERO(A)"<?php if (!(strcmp('SOLTERO(A)', $reg[0]['edocivildoc']))) {echo "selected=\"selected\"";} ?>>SOLTERO(A)</option>
              <option value="CASADO(A)"<?php if (!(strcmp('CASADO(A)', $reg[0]['edocivildoc']))) {echo "selected=\"selected\"";} ?>>CASADO(A)</option>
              <option value="DIVORCIADO(A)"<?php if (!(strcmp('DIVORCIADO(A)', $reg[0]['edocivildoc']))) {echo "selected=\"selected\"";} ?>>DIVORCIADO(A)</option>
              <option value="VIUDO(A)"<?php if (!(strcmp('VIUDO(A)', $reg[0]['edocivildoc']))) {echo "selected=\"selected\"";} ?>>VIUDO(A)</option>
              <option value="CONCUBINO(A)"<?php if (!(strcmp('CONCUBINO(A)', $reg[0]['edocivildoc']))) {echo "selected=\"selected\"";} ?>>CONCUBINO(A)</option>
        </select>
                             <?php } else { ?>  
  <select name="edocivildoc" id="edocivildoc" class="form-control" required="required">
              <option value="">SELECCIONE</option>
              <option value="SOLTERO(A)">SOLTERO(A)</option>
              <option value="CASADO(A)">CASADO(A)</option>
              <option value="DIVORCIADO(A)">DIVORCIADO(A)</option>
              <option value="VIUDO(A)">VIUDO(A)</option>
              <option value="CONCUBINO(A)">CONCUBINO(A)</option>
        </select>
                              <?php } ?>
                              </div> 
                        </div>
                     
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
         <label class="control-label">Dirección Domiciliaria: <span class="symbol required"></span></label> 
 <input name="direcdoc" class="form-control" type="text" id="direcdoc" onKeyUp="this.value=this.value.toUpperCase();" <?php if (isset($reg[0]['direcdoc'])) { ?> value="<?php echo $reg[0]['direcdoc']; ?>"<?php } ?> placeholder="Ingrese Dirección de Docente" autocomplete="off" required="required"/>
                        <i class="fa fa-map-marker form-control-feedback"></i>  
                                                                </div> 
                                                          </div>  
                              
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
        <label class="control-label">Nº de Teléfono: <span class="symbol required"></span></label> 
<input name="tlfdoc" class="form-control" type="text" id="tlfdoc" onKeyUp="this.value=this.value.toUpperCase();" <?php if (isset($reg[0]['tlfdoc'])) { ?> value="<?php echo $reg[0]['tlfdoc']; ?>"<?php } ?> placeholder="Ingrese Teléfono de Docente" autocomplete="off" required="required"/>
             <i class="fa fa-phone form-control-feedback"></i>    
                                                                </div> 
                                                            </div>
                     </div> 
	
					 
					 <div class="row"> 															
							<div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
          <label class="control-label">Lugar de Nacimiento: <span class="symbol required"></span></label> 
 <input name="lugarnacdoc" class="form-control" type="text" id="lugarnacdoc" onKeyUp="this.value=this.value.toUpperCase();" <?php if (isset($reg[0]['lugarnacdoc'])) { ?> value="<?php echo $reg[0]['lugarnacdoc']; ?>"<?php } ?> placeholder="Ingrese Lugar de Nacimiento de Docente" autocomplete="off" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>   
                                                                </div> 
                                                            </div> 	

              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
            <label class="control-label">Fecha de Nacimiento: <span class="symbol required"></span></label> 
<input name="fecnacdoc" class="form-control nacimiento" type="text" id="fecnacdoc" onKeyUp="this.value=this.value.toUpperCase();" <?php if (isset($reg[0]['fecnacdoc'])) { ?> value="<?php echo date("Y-m-d",strtotime($reg[0]['fecnacdoc'])); ?>" <?php } ?> placeholder="Ingrese Fecha de Nacimiento" autocomplete="off" required="required"/>
                        <i class="fa fa-calendar form-control-feedback"></i>  
                                                                </div> 
                                                            </div>                                
                              <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
             <label class="control-label">Correo Electronico: <span class="symbol required"></span></label> 
<input name="correodoc" class="form-control" type="text" id="correodoc" onKeyUp="this.value=this.value.toUpperCase();" <?php if (isset($reg[0]['correodoc'])) { ?> value="<?php echo $reg[0]['correodoc']; ?>"<?php } ?> placeholder="Ingrese Correo de Docente" autocomplete="off" required="required"/>
                        <i class="fa fa-envelope-o form-control-feedback"></i>      
                                                                </div> 
                                                            </div> 
                     </div>
					 
           <div class="row">
 
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
          <label class="control-label">Especialidad: <span class="symbol required"></span></label> 
<input name="especdoc" class="form-control" type="text" id="especdoc" onKeyUp="this.value=this.value.toUpperCase();" <?php if (isset($reg[0]['especdoc'])) { ?> value="<?php echo $reg[0]['especdoc']; ?>"<?php } ?> placeholder="Ingrese Especialidad de Docente" autocomplete="off" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>      
                                                                </div> 
                                                            </div>
                   
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
            <label class="control-label">Horas Asignadas: <span class="symbol required"></span></label> 
 <input name="horasdoc" class="form-control" type="text" id="horasdoc" onKeyUp="this.value=this.value.toUpperCase();" <?php if (isset($reg[0]['horasdoc'])) { ?> value="<?php echo $reg[0]['horasdoc']; ?>"<?php } ?> placeholder="Ingrese Horas Asignadas de Docente" autocomplete="off" required="required"/>
                        <i class="fa fa-clock-o form-control-feedback"></i>   
                                                                </div> 
                                                            </div>
															
							<div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
         <label class="control-label">Código de Cargo: <span class="symbol required"></span></label> 
<input name="codcargodoc" class="form-control" type="text" id="codcargodoc" onKeyUp="this.value=this.value.toUpperCase();" <?php if (isset($reg[0]['codcargodoc'])) { ?> value="<?php echo $reg[0]['codcargodoc']; ?>"<?php } ?> placeholder="Ingrese Código de Cargo de Docente" autocomplete="off" required="required"/>
                        <i class="fa fa-archive form-control-feedback"></i>  
                                                                </div> 
                                                            </div> 	
                    </div><br>
        
            <div class="text-right"> 
<?php  if (isset($_GET['coddoc'])) { ?>
<button type="submit" name="btn-update" id="btn-update" class="btn btn-primary"><span class="fa fa-edit"></span> Actualizar</button>
<button class="btn btn-danger" type="reset"><i class="fa fa-trash-o"></i> Cancelar</button> 
    <?php } else { ?>
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><span class="fa fa-save"></span> Guardar</button>
<button class="btn btn-danger" type="reset"><i class="fa fa-trash-o"></i> Limpiar</button>
    <?php } ?> 
                                </form>
                                    </div><!-- /.box-body -->
								</div>
                          </div>
                     </div>
                </div>
           </div>
       </div>
</div>


<footer class="footer"> <i class="fa fa-copyright"></i> <span class="current-year"></span>. </footer>
</div>
</div> 

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        
        <!-- jQuery  -->
        <script src="assets/plugins/moment/moment.js"></script>
        
        <!-- jQuery  -->
        <script src="assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="assets/plugins/counterup/jquery.counterup.min.js"></script>
           
        <!-- jQuery  -->
        <script src="assets/pages/jquery.dashboard.js"></script>
        <script src="assets/plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
  

   </body>
   </html>
<?php } else { ?> 
    <script type='text/javascript' language='javascript'>
      alert('NO TIENES PERMISO PARA ACCEDER A ESTA PAGINA.\nCONSULTA CON EL ADMINISTRADOR PARA QUE TE DE ACCESO')  
    document.location.href='panel'   
        </script> 
<?php } } else { ?>
    <script type='text/javascript' language='javascript'>
      alert('NO TIENES PERMISO PARA ACCEDER AL SISTEMA.\nDEBERA DE INICIAR SESION')  
    document.location.href='logout'  
        </script> 
<?php } ?>  