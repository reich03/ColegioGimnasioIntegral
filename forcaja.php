<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
     if ($_SESSION['acceso'] == "administrador") {

$con = new Login();
$con = $con->ContarRegistros();

$tra = new Login();
$ses = $tra->ExpiraSession();

if(isset($_POST['btn-submit']))
{
$reg = $tra->RegistrarCajas();
exit;
}
else if(isset($_POST['btn-update']))
{
$reg = $tra->ActualizarCaja();
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
<script type="text/javascript" src="assets/script/validation.min.js"></script>
<script type="text/javascript" src="assets/script/script.js"></script>
<!-- script jquery -->
  
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
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-tasks"></i> Gestión de Cajas</h4>
<ol class="breadcrumb pull-right"><li><a href="panel">Inicio</a></li>
<li><a href="cajas">Control</a></li>
<li class="active">Cajas</li>
</ol>

<div class="clearfix"></div>

</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Gestión de Cajas</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12"> 
            <div class="box-body">
			
<?php  if (isset($_GET['codcaja'])) {
			
			$reg = $tra->CajaPorId(); ?>
			
<form class="form" name="updatecajas" id="updatecajas" method="post" data-id="<?php echo $reg[0]["codcaja"] ?>" action="#">
				
		<?php } else { ?>
				
		<form class="form" method="post"  action="#" name="cajas" id="cajas">	
			
		<?php } ?>
                                                  <div id="error">
                                                 <!-- error will be shown here ! -->
                      </div>
												
				<div class="row"> 
                            <div class="col-md-3"> 
                              <div class="form-group has-feedback"> 
         <label class="control-label">N° de Caja: <span class="symbol required"></span></label> 
  <input type="hidden" name="codcaja" id="codcaja" <?php if (isset($reg[0]['codcaja'])) { ?> value="<?php echo $reg[0]['codcaja']; ?>"<?php } ?>>
<div id="codigocaja"><input type="text" class="form-control" name="nrocaja" id="nrocaja" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="N° de Caja" <?php if (isset($reg[0]['nrocaja'])) { ?> value="<?php echo $reg[0]['nrocaja']; ?>" <?php } else { ?>  value="<?php echo $reg = $tra->CodigoCaja(); ?>" <?php } ?> readonly="readonly"></div>
                        <i class="fa fa-pencil form-control-feedback"></i>
                              </div> 
                        </div>

							<div class="col-md-5"> 
                               <div class="form-group has-feedback"> 
                 <label class="control-label">Nombre de Caja: <span class="symbol required"></span></label> 
  <input type="text" class="form-control" name="nombrecaja" id="nombrecaja" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Nombre de Caja" <?php if (isset($reg[0]['nombrecaja'])) { ?> value="<?php echo $reg[0]['nombrecaja']; ?>"<?php } ?> tabindex="1" required="" aria-required="true">
                        <i class="fa fa-desktop form-control-feedback"></i>  
                              </div> 
                        </div> 	

                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
        <label class="control-label">Nombre de Responsable: <span class="symbol required"></span></label> 
  <i class="fa fa-bars form-control-feedback"></i>
  <?php if (isset($reg[0]['codigo'])) { ?>
			<select name="codigo" id="codigo" class="form-control" tabindex="2" required="" aria-required="true">
												<option value="">SELECCIONE</option>
												<?php
############################# BUSQUEDA DE USUARIOS ######################################
			$usuario = new Login();
			$usuario = $usuario->ListarUsuarios();
			for($i=0;$i<sizeof($usuario);$i++){
		              ?>
<option value="<?php echo $usuario[$i]['codigo'] ?>"<?php if (!(strcmp($reg[0]['codigo'], htmlentities($usuario[$i]['codigo'])))) {echo "selected=\"selected\"";} ?>><?php echo $usuario[$i]['nombres'].": ".$usuario[$i]['nivel'] ?></option>			  
                      <?php 
	}
############################# FIN DE BUSQUEDA DE USUARIOS ######################################
?>
							    </select>
                             <?php } else { ?>  
	<select name="codigo" id="codigo" class="form-control" tabindex="2" required="" aria-required="true">
												<option value="">SELECCIONE</option>
												<?php
############################# BUSQUEDA DE USUARIOS ######################################
			$usuario = new Login();
			$usuario = $usuario->ListarUsuarios();
			for($i=0;$i<sizeof($usuario);$i++){
		              ?>
<option value="<?php echo $usuario[$i]['codigo'] ?>"><?php echo $usuario[$i]['nombres'].": ".$usuario[$i]['nivel'] ?></option>			  
                      <?php 
	}
############################# FIN DE BUSQUEDA DE USUARIOS ######################################
?>
							    </select>
                              <?php } ?>
							  
                              </div> 
                        </div>	
                    </div><br>
					
            <div class="text-right"> 
<?php  if (isset($_GET['codcaja'])) { ?>
<button type="submit" name="btn-update" id="btn-update" class="btn btn-primary"><span class="fa fa-edit"></span> Actualizar</button>
<button class="btn btn-danger" type="reset"><i class="fa fa-trash-o"></i> Cancelar</button> 
    <?php } else { ?>
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><span class="fa fa-save"></span> Guardar</button>
<button class="btn btn-danger" type="reset"><i class="fa fa-trash-o"></i> Limpiar</button>
    <?php } ?>   
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