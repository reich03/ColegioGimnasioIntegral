<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria") {

$con = new Login();
$con = $con->ContarRegistros();

$tra = new Login();
$ses = $tra->ExpiraSession();

$reg = $tra->TutorPorId();

if(isset($_POST['btn-update']))
{
$reg = $tra->ActualizarTutor();
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
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-edit"></i> Actualizar Representantes</h4>
<ol class="breadcrumb pull-right"><li><a href="panel">Inicio</a></li>
<li><a href="representantes">Control</a></li>
<li class="active">Actualizar Representantes</li>
</ol>

<div class="clearfix"></div>

</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Actualizar Representantes</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12">
            <div class="box-body">
<form class="form" name="updaterepresentante" id="updaterepresentante" method="post" data-id="<?php echo $reg[0]["codpadre"] ?>" action="#">

                                                  <div id="error">
                                                 <!-- error will be shown here ! -->
                                                     </div> 
            			  
			 <div class="row"> 
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
          <label class="control-label">Nº de DNI: <span class="symbol required"></span></label> 
<input name="codpadre" type="hidden" id="codpadre" value="<?php echo $reg[0]['codpadre']; ?>"/>

<input name="cedant" class="form-control" type="hidden" id="cedant" value="<?php echo $reg[0]['cedpadre']; ?>"/>

<input name="cedpadre" class="form-control" type="text" id="cedpadre" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de DNI de Padre/Tutor" autocomplete="off" value="<?php echo $reg[0]['cedpadre']; ?>" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>   
                                                                </div> 
                                                            </div>
															
							<div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
      <label class="control-label">Nombre de Padre/Tutor: <span class="symbol required"></span></label> 
<input name="nompadre" class="form-control" type="text" id="nompadre" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nombre de Padre/Tutor" autocomplete="off" value="<?php echo $reg[0]['nompadre']; ?>" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>  
                                                                </div> 
                                                            </div>
                            <div class="col-md-4">
                 <div class="form-group has-feedback"> 
      <label class="control-label">Apellidos de Padre/Tutor: <span class="symbol required"></span></label> 
<input name="apepadre" class="form-control" type="text" id="apepadre" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Apellidos de Padre/Tutor" autocomplete="off" value="<?php echo $reg[0]['apepadre']; ?>" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>  
                                                                </div> 
                                                            </div>  	
                    </div>
					
					<div class="row"> 	
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
      <label class="control-label">Nº de Tel&eacute;fono: <span class="symbol required"></span></label> 
<input name="tlfpadre" class="form-control" type="text" id="tlfpadre" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Tel&eacute;fono de Padre/Tutor" autocomplete="off" value="<?php echo $reg[0]['tlfpadre']; ?>" required="required"/>
					   <i class="fa fa-phone form-control-feedback"></i>    
                                                                </div> 
                                                            </div>	
                     </div>	<br>  
              
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