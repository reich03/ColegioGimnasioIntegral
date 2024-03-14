<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="docente") {

$con = new Login();
$con = $con->ContarRegistros();

$tra = new Login();
$ses = $tra->ExpiraSession();

if(isset($_POST['btn-update']))
{
$reg = $tra->ActualizarPassword();
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
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-edit"></i> Password</h4>
<ol class="breadcrumb pull-right"><li><a href="panel">Inicio</a></li>
<li class="active">Password</li>
</ol>

<div class="clearfix"></div>

</div>
</div>
</div>

<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-primary">
      <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Password</h3></div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-12 col-xs-12">
            <div class="box-body">
             <form name="updatepassword" id="updatepassword" method="post" data-id="<?php echo $_SESSION["codigo"]?>" action="#">

              <div id="error">
               <!-- error will be shown here ! -->
             </div> 

             <div class="row"> 

  <?php if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria") {  ?>

          <div class="col-md-3"> 
              <div class="form-group has-feedback"> 
                 <label class="control-label">NIT/CI de Usuario: <span class="symbol required"></span></label> 
                 <input name="codigo" type="hidden" value="<?php echo $_SESSION['codigo']; ?>" id="codigo" />
                 <input name="cedula" class="form-control" type="text" id="cedula" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Cédula de Usuario" autocomplete="off" value="<?php echo $_SESSION['cedula']; ?>" readonly="readonly"/>
                 <i class="fa fa-pencil form-control-feedback"></i>   
              </div> 
          </div>

          <div class="col-md-3"> 
              <div class="form-group has-feedback"> 
                <label class="control-label">Usuarios de Acceso: <span class="symbol required"></span></label> 
                <input name="usuario" class="form-control" type="text" id="usuario" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Usuario de Acceso" autocomplete="off" value="<?php echo $_SESSION['usuario']; ?>" required="" aria-required="true"/>
                <i class="fa fa-user form-control-feedback"></i>   
              </div> 
          </div>	

  <?php } else { ?>

          <div class="col-md-3"> 
              <div class="form-group has-feedback"> 
                 <label class="control-label">NIT/CI de Docente: <span class="symbol required"></span></label> 
                 <input type="hidden" name="codigo" id="codigo" value="<?php echo $_SESSION['coddoc']; ?>"/>
                 <input name="cedula" class="form-control" type="text" id="cedula" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Cédula de Usuario" autocomplete="off" value="<?php echo $_SESSION['ceddoc']; ?>" readonly="readonly"/>
                 <i class="fa fa-pencil form-control-feedback"></i>   
               </div> 
          </div>

          <div class="col-md-3"> 
              <div class="form-group has-feedback"> 
                <label class="control-label">Usuarios de Acceso: <span class="symbol required"></span></label> 
                <input name="usuario" class="form-control" type="text" id="usuario" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Usuario de Acceso" autocomplete="off" value="<?php echo $_SESSION['ceddoc']; ?>" readonly="" required="" aria-required="true"/>
                <i class="fa fa-user form-control-feedback"></i>   
              </div> 
          </div>  

  <?php } ?>

            <div class="col-md-3"> 
             <div class="form-group has-feedback"> 
               <label class="control-label">Nuevo Password de Acceso: <span class="symbol required"></span></label> 
               <input name="password" class="form-control" type="text" id="password" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nuevo Password" autocomplete="off" required="" aria-required="true"/>
               <i class="fa fa-unlock form-control-feedback"></i>   
             </div> 
           </div> 

           <div class="col-md-3"> 
             <div class="form-group has-feedback"> 
              <label class="control-label">Repita Nuevo Password: <span class="symbol required"></span></label> 
              <input name="password2" class="form-control" type="text" id="password2" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Repita Nuevo Password" autocomplete="off" required="" aria-required="true"/>
              <i class="fa fa-unlock form-control-feedback"></i>   
            </div> 
          </div> 	
        </div> </br>

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