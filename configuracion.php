<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
if ($_SESSION['acceso'] == "administrador") {

$con = new Login();
$con = $con->ContarRegistros();

$tra = new Login();
$ses = $tra->ExpiraSession();

$reg = $tra->ConfiguracionPorId();

if(isset($_POST['btn-update']))
{
$reg = $tra->ActualizarConfiguracion();
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
<script type="text/javascript" src="assets/script/jquery.mask.js"></script>
<script type="text/javascript" src="assets/script/validation.min.js"></script>
<script type="text/javascript" src="assets/script/script.js"></script>
<script type="text/javascript">
    jQuery.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-zA-ZñÑáéíóúÁÉÍÓÚ,. ]+$/i.test(value);
    }, "Ingrese solo letras para Nombre");
</script>
<script type="text/javascript">
	$(document).ready(function() {
	$("#tlfdirecc").mask("9-9999999");
	});
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
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-edit"></i> Configuración del Sistema</h4>
<ol class="breadcrumb pull-right"><li><a href="panel">Inicio</a></li>
<li class="active">Configuración</li>
</ol>

<div class="clearfix"></div>

</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Configuración del Sistema</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12">
            <div class="box-body">

 <form class="form" method="post" data-id="<?php echo $reg[0]["id"] ?>" action="#" name="configuracion" id="configuracion">

                                                  <div id="error">
                                                 <!-- error will be shown here ! -->
                                                  </div>
												  
				<div class="row"> 
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
     <label class="control-label">Nº de DNI de Director: <span class="symbol required"></span></label> 
<input name="id" class="form-control" type="hidden" id="id" value="<?php echo $reg[0]['id']; ?>"/>
<input name="ceddirector" class="form-control" type="text" id="ceddirector" onKeyUp="this.value=this.value.toUpperCase();" value="<?php echo $reg[0]['ceddirector']; ?>" placeholder="Ingrese Nº de DNI de Director" autocomplete="off" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>   
                                                                </div> 
                                                            </div>
															
							<div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
        <label class="control-label">Nombre de Director: <span class="symbol required"></span></label> 
<input name="director" class="form-control" type="text" id="director" onKeyUp="this.value=this.value.toUpperCase();" value="<?php echo $reg[0]['director']; ?>" placeholder="Ingrese Nombre de Director" autocomplete="off" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i> 
                                                                </div> 
                                                            </div>
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
        <label class="control-label">Teléfono de Director: <span class="symbol required"></span></label> 
<input name="tlfdirec" class="form-control" type="text" id="tlfdirec" onKeyUp="this.value=this.value.toUpperCase();" value="<?php echo $reg[0]['tlfdirec']; ?>" placeholder="Ingrese Teléfono de Director" autocomplete="off" required="required"/>
                        <i class="fa fa-phone form-control-feedback"></i>   
                                                                </div> 
                                                            </div> 	
                    </div>
					
					<div class="row"> 
															
							<div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
         <label class="control-label">Correo de Director: <span class="symbol required"></span></label> 
<input name="correodirec" class="form-control" type="text" id="correodirec" onKeyUp="this.value=this.value.toUpperCase();" value="<?php echo $reg[0]['correodirec']; ?>" placeholder="Ingrese Correo de Director" autocomplete="off" required="required"/>
                        <i class="fa fa-envelope-o form-control-feedback"></i>
                                                                </div> 
                                                            </div> 	
                     
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
      <label class="control-label">NIT de Institución: <span class="symbol required"></span></label> 
<input name="codinstituto" class="form-control" type="text" id="codinstituto" onKeyUp="this.value=this.value.toUpperCase();" value="<?php echo $reg[0]['codinstituto']; ?>" placeholder="Ingrese NIT de Institución" autocomplete="off" required="required"/>
                        <i class="fa fa-archive form-control-feedback"></i>   
                                                                </div> 
                                                            </div>
															
							<div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
      <label class="control-label">Nombre de Institución: <span class="symbol required"></span></label> 
   <input name="nominstituto" class="form-control" type="text" id="nominstituto" onKeyUp="this.value=this.value.toUpperCase();" value="<?php echo $reg[0]['nominstituto']; ?>" placeholder="Ingrese Nombre de Institución" autocomplete="off" required="required"/>
                        <i class="fa fa-bank form-control-feedback"></i>
                                                                </div> 
                                                            </div> 	
                    </div>
					
					<div class="row"> 
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
       <label class="control-label">Dirección de Institución: <span class="symbol required"></span></label> 
<input name="direcinstituto" class="form-control" type="text" id="direcinstituto" onKeyUp="this.value=this.value.toUpperCase();" value="<?php echo $reg[0]['direcinstituto']; ?>" placeholder="Ingrese Dirección de Institución" autocomplete="off" required="required"/>
                        <i class="fa fa-map-marker form-control-feedback"></i>   
                                                                </div> 
                                                            </div>
															
							<div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
      <label class="control-label">Teléfono de Institución: <span class="symbol required"></span></label> 
 <input name="tlfinstituto" class="form-control" type="text" id="tlfinstituto" onKeyUp="this.value=this.value.toUpperCase();" value="<?php echo $reg[0]['tlfinstituto']; ?>" placeholder="Ingrese Teléfono de Institución" autocomplete="off" required="required"/>
                        <i class="fa fa-phone form-control-feedback"></i>
                                                                </div> 
                                                            </div>
                    <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
                               <label class="control-label">Correo de Institución: <span class="symbol required"></span></label> 
<input name="correoinstituto" class="form-control" type="text" id="correoinstituto" onKeyUp="this.value=this.value.toUpperCase();" value="<?php echo $reg[0]['correoinstituto']; ?>" placeholder="Ingrese Correo de Institución" autocomplete="off" required="required"/>
                        <i class="fa fa-envelope-o form-control-feedback"></i>
                                                                </div> 
                                                            </div> 	
                    </div>
					
					<div class="row">
															 
                          <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
 <label class="control-label">Dias para Crear Nuevo Periodo: <span class="symbol required"></span></label> 
<input name="diascrealapso" class="form-control" type="text" id="diascrealapso" onKeyUp="this.value=this.value.toUpperCase();" value="<?php echo $reg[0]['diascrealapso']; ?>" placeholder="Ingrese Dias para Crear Nuevo Periodo Escolar" autocomplete="off" required="required"/>
                        <i class="fa fa-archive form-control-feedback"></i> 
                                                                </div> 
                                                            </div> 	 	
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
  <label class="control-label">Inicio Proceso de Inscripción: <span class="symbol required"></span></label> 
<input name="inicioinscripcion" class="form-control" type="text" id="inicioinscripcion" onKeyUp="this.value=this.value.toUpperCase();" value="<?php echo date("d-m-Y",strtotime($reg[0]['inicioinscripcion'])); ?>" placeholder="Ingrese Fecha de Inicio de Inscripción" autocomplete="off" required="required"/>
                        <i class="fa fa-calendar form-control-feedback"></i>   
                                                                </div> 
                                                            </div>
															
							<div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Fin Proceso de Inscripción: <span class="symbol required"></span></label> 
<input name="fininscripcion" class="form-control" type="text" id="fininscripcion" onKeyUp="this.value=this.value.toUpperCase();" value="<?php echo date("d-m-Y",strtotime($reg[0]['fininscripcion'])); ?>" placeholder="Ingrese Fecha de Fin de Inscripción" autocomplete="off" required="required"/>
                        <i class="fa fa-calendar form-control-feedback"></i>
                                                                </div> 
                                                            </div> 	
                    </div>

                    <div class="row">
                               
                          <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
    <label class="control-label">Trimestre Activo: <span class="symbol required"></span></label>
                              <?php if (isset($reg[0]['trimestreactivo'])) { ?>
  <select name="trimestreactivo" id="trimestreactivo" class="form-control" required="" aria-required="true">
<option value="0"<?php if (!(strcmp('0', $reg[0]['trimestreactivo']))) {echo "selected=\"selected\"";} ?>>NINGUNO</option>
<option value="1"<?php if (!(strcmp('1', $reg[0]['trimestreactivo']))) {echo "selected=\"selected\"";} ?>>1ER TRIMESTRE</option>
  <option value="2"<?php if (!(strcmp('2', $reg[0]['trimestreactivo']))) {echo "selected=\"selected\"";} ?>>2DO TRIMESTRE</option>
  <option value="3"<?php if (!(strcmp('3', $reg[0]['trimestreactivo']))) {echo "selected=\"selected\"";} ?>>3ER TRIMESTRE</option>
                      </select>
                             <?php } else { ?>  
<select name="trimestreactivo" id="trimestreactivo" class="form-control" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
                        <option value="1">1ER TRIMESTRE</option>
                        <option value="2">2DO TRIMESTRE</option>
                        <option value="3">3ER TRIMESTRE</option>
                  </select>
                              <?php } ?>
                              </div> 
                        </div> 

                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
    <label class="control-label">Inicio Registro de Notas: <span class="symbol required"></span></label> 
<input name="desde" class="form-control" type="text" id="desde" onKeyUp="this.value=this.value.toUpperCase();" value="<?php echo date("d-m-Y",strtotime($reg[0]['inicionotas'])); ?>" placeholder="Ingrese Fecha de Inicio de Notas" autocomplete="off" required="required"/>
                        <i class="fa fa-calendar form-control-feedback"></i>   
                                                                </div> 
                                                            </div>
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Fin Registro de Notas: <span class="symbol required"></span></label> 
    <input name="hasta" class="form-control" type="text" id="hasta" onKeyUp="this.value=this.value.toUpperCase();" value="<?php echo date("d-m-Y",strtotime($reg[0]['finnotas'])); ?>" placeholder="Ingrese Fecha de Fin de Notas" autocomplete="off" required="required"/>
                        <i class="fa fa-calendar form-control-feedback"></i>
                                                                </div> 
                                                            </div>  
                    </div><br>		
			  
            <div class="text-right">
<button type="submit" name="btn-update" id="btn-update" class="btn btn-primary"><span class="fa fa-edit"></span> Actualizar</button>
<button class="btn btn-danger" type="reset"><i class="fa fa-trash-o"></i> Cancelar</button> 
		    </div>
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