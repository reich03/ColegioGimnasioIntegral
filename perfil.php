<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="docente") {

$con = new Login();
$con = $con->ContarRegistros();

$tra = new Login();
$ses = $tra->ExpiraSession();

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
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-user"></i> Perfil de Usuario</h4>
<ol class="breadcrumb pull-right"><li><a href="panel">Inicio</a></li>
<li class="active">Mi perfil de Usuario</li>
</ol>

<div class="clearfix"></div>

</div>
</div>
</div>

<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-primary">
      <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-user"></i> Mi Perfil de Usuario</h3></div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-12 col-xs-12">
            <div class="box-body">
              <form class="form" name="perfil" id="perfil" method="post" action="#">

  <?php if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria") {  ?>

        <div class="row">  
            <div class="col-md-3"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Nº de DNI de Usuario: <span class="symbol required"></span></label> 
                  <br /><abbr title="Nº de DNI de Usuario"><?php echo $_SESSION['cedula']; ?></abbr>
                </div> 
            </div> 

            <div class="col-md-4"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Nombre de Usuario: <span class="symbol required"></span></label> 
                  <br /><abbr title="Nombre de Usuario"><?php echo $_SESSION['nombres']; ?></abbr>
                </div> 
            </div> 

            <div class="col-md-2"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Correo de Usuario: <span class="symbol required"></span></label> 
                  <br /><abbr title="Correo de Usuario"><?php echo $_SESSION['email']; ?></abbr>
                </div> 
            </div>  

            <div class="col-md-3"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Cargo de Usuario: <span class="symbol required"></span></label> 
                  <br /><abbr title="Cargo de Usuario"><?php echo $_SESSION['cargo']; ?></abbr>
                </div> 
            </div>
        </div>


        <div class="row">  
            <div class="col-md-3"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Sexo de Usuario: <span class="symbol required"></span></label> 
                  <br /><abbr title="Usuario de Acceso"><?php echo $_SESSION['sexo']; ?></abbr>
                </div> 
            </div> 

            <div class="col-md-4"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Usuario de Acceso: <span class="symbol required"></span></label> 
                  <br /><abbr title="Usuario de Acceso"><?php echo $_SESSION['usuario']; ?></abbr>
                </div> 
            </div> 

            <div class="col-md-2"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Status de Acceso: <span class="symbol required"></span></label> 
                  <br /><abbr title="Status de Acceso"><?php echo $_SESSION['status']; ?></abbr>
                </div> 
            </div>  

            <div class="col-md-3"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Nivel de Acceso: <span class="symbol required"></span></label> 
                  <br /><abbr title="Nivel de Acceso"><?php echo $_SESSION['nivel']; ?></abbr>
                </div> 
            </div>
        </div>


<?php } else {  ?>

        <div class="row">  
            <div class="col-md-3"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Nº de DNI de Docente: <span class="symbol required"></span></label> 
                  <br /><abbr title="Cédula de Docente"><?php echo $_SESSION['ceddoc']; ?></abbr>
                </div> 
            </div> 

            <div class="col-md-4"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Nombre de Docente: <span class="symbol required"></span></label> 
                  <br /><abbr title="Nombre de Docente"><?php echo $_SESSION['nomdoc']; ?></abbr>
                </div> 
            </div> 

            <div class="col-md-2"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Nº de Telefóno: <span class="symbol required"></span></label> 
                  <br /><abbr title="Nº de Telefóno"><?php echo $_SESSION['tlfdoc']; ?></abbr>
                </div> 
            </div>  

            <div class="col-md-3"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Especialidad: <span class="symbol required"></span></label> 
                  <br /><abbr title="Especialidad"><?php echo $_SESSION['especdoc']; ?></abbr>
                </div> 
            </div>
        </div>


        <div class="row">  
            <div class="col-md-3"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Fecha de Nacimiento: <span class="symbol required"></span></label> 
                  <br /><abbr title="Fecha de Nacimiento"><?php echo $_SESSION['fecnacdoc']; ?></abbr>
                </div> 
            </div> 

            <div class="col-md-4"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Dirección Domiciliaria: <span class="symbol required"></span></label> 
                  <br /><abbr title="Dirección Domiciliaria"><?php echo $_SESSION['direcdoc']; ?></abbr>
                </div> 
            </div> 

            <div class="col-md-2"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Edad: <span class="symbol required"></span></label> 
                  <br /><abbr title="Edad"><?php echo edad($_SESSION['fecnacdoc']); ?> AÑOS</abbr>
                </div> 
            </div>  

            <div class="col-md-3"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Lugar de Nacimiento: <span class="symbol required"></span></label> 
                  <br /><abbr title="Lugar de Nacimiento"><?php echo $_SESSION['lugarnacdoc']; ?></abbr>
                </div> 
            </div>
        </div>


        <div class="row">
            <div class="col-md-3"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Horas de Trabajo: <span class="symbol required"></span></label> 
                  <br /><abbr title="Horas de Trabajo"><?php echo $_SESSION['horasdoc']; ?> HORAS</abbr>
                </div> 
            </div>  

            <div class="col-md-4"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Estado Civil: <span class="symbol required"></span></label> 
                  <br /><abbr title="Estado Civil"><?php echo $_SESSION['edocivildoc']; ?></abbr>
                </div> 
            </div>

            <div class="col-md-2"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Código de Cargo: <span class="symbol required"></span></label> 
                  <br /><abbr title="Código de Cargo"><?php echo $_SESSION['codcargodoc']; ?> </abbr>
                </div> 
            </div>

            <div class="col-md-3"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Expedido: <span class="symbol required"></span></label> 
                  <br /><abbr title="Expedido"><?php echo $_SESSION['expedido']; ?></abbr>
                </div> 
            </div>  
        </div>

          

<?php } ?>

      <div class="modal-footer">
        <a href="panel"><button type="button" class="btn btn-success"><i class="fa fa-arrow-left"></i> Regresar</button></a>
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