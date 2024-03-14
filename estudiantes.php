<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria") {

$con = new Login();
$con = $con->ContarRegistros();

$tra = new Login();
$ses = $tra->ExpiraSession();

if(isset($_POST['btn-update']))
{
$reg = $tra->ActualizarEstudiante();
exit;
}
else if(isset($_POST['btn-retiro']))
{
$reg = $tra->RetiroEstudiante();
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
          
        <!-- sample modal content -->
<div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                                            <div class="modal-dialog">
                                                <div class="modal-content p-0 b-0">
                                                    <div class="panel panel-color panel-primary">
                                                        <div class="panel-heading"> 
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="assets/images/close.png"/></button> 
             <h3 class="panel-title"><i class="fa fa-align-justify"></i> Datos del Estudiante</h3> 
                                                        </div> 
                                                        <div class="panel-body"> 
                                                         <div id="muestraestudiantemodal"></div>
                                                        </div>
                                                     <div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-times-circle"></span> Aceptar</button>
                  </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->



<div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none">

  <div class="modal-dialog modal-lg">
    <div class="modal-content p-0 b-0">
      <div class="panel panel-color panel-primary">
        <div class="panel-heading">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="assets/images/close.png"/></button> 
          <h3 class="panel-title"><i class="fa fa-tasks"></i> Actualización de Estudiante</h3>
        </div>
 <form class="form" name="updateestudiantes" id="updateestudiantes" method="post" action="#">
          <div class="panel-body">
            <div id="error">
              <!-- error will be shown here ! -->
            </div>

    <div class="row"> 
      <div class="col-md-4"> 
        <div class="form-group has-feedback"> 
          <label class="control-label">Nº de DNI: <span class="symbol required"></span></label> 
          <input type="hidden" name="codturno2" id="codturno2">
          <input type="hidden" name="codnivel2" id="codnivel2">
          <input type="hidden" name="codgrado2" id="codgrado2">
          <input type="hidden" name="codseccion2" id="codseccion2">
          <input type="hidden" name="codest" id="codest">
          <input name="cedest" class="form-control" type="text" id="cedest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de DNI de Estudiante" autocomplete="off" required="required"/>
          <i class="fa fa-pencil form-control-feedback"></i>   
        </div> 
      </div>

      <div class="col-md-4"> 
       <div class="form-group has-feedback"> 
        <label class="control-label">Primer Nombre: <span class="symbol required"></span></label> 
        <input name="pnomest" class="form-control" type="text" id="pnomest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Primer Nombre de Estudiante" autocomplete="off" required="required"/>
        <i class="fa fa-pencil form-control-feedback"></i>  
      </div> 
    </div> 
    <div class="col-md-4"> 
     <div class="form-group has-feedback"> 
      <label class="control-label">Segundo Nombre:</label> 
      <input name="snomest" class="form-control" type="text" id="snomest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Segundo Nombre de Estudiante" autocomplete="off"/>
      <i class="fa fa-pencil form-control-feedback"></i>  
    </div> 
  </div>  
</div>

<div class="row">  

  <div class="col-md-4"> 
   <div class="form-group has-feedback"> 
     <label class="control-label">Primer Apellido: <span class="symbol required"></span></label> 
     <input name="papeest" class="form-control" type="text" id="papeest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Primer Apellido de Estudiante" autocomplete="off" required="required"/>
     <i class="fa fa-pencil form-control-feedback"></i>  
   </div> 
 </div>  

 <div class="col-md-4"> 
   <div class="form-group has-feedback"> 
    <label class="control-label">Segundo Apellido:</label> 
    <input name="sapeest" class="form-control" type="text" id="sapeest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Segundo Apellido de Estudiante" autocomplete="off"/>
    <i class="fa fa-pencil form-control-feedback"></i>  
  </div> 
</div> 

<div class="col-md-4"> 
 <div class="form-group has-feedback"> 
  <label class="control-label">Sexo: <span class="symbol required"></span></label> 
  <i class="fa fa-bars form-control-feedback"></i> 
  <select name="sexoest" id="sexoest" class='form-control' required="required">
    <option value="">SELECCIONE</option>
    <option value="MASCULINO">MASCULINO</option>
    <option value="FEMENINO">FEMENINO</option>
  </select>  
</div> 
</div>  
</div>

<div class="row"> 
<div class="col-md-8"> 
<div class="form-group has-feedback"> 
<label class="control-label">Dirección Domiciliaria: <span class="symbol required"></span></label> 
<input name="direcest" class="form-control" type="text" id="direcest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Dirección Domiciliaria" autocomplete="off" required="required"/>
<i class="fa fa-map-marker form-control-feedback"></i>  
</div> 
</div> 

    <div class="col-md-4"> 
     <div class="form-group has-feedback"> 
      <label class="control-label">Fecha de Nacimiento: <span class="symbol required"></span></label> 
      <input name="fnacest" class="form-control nacimiento" type="text" id="fnacest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Fecha de Nacimiento" autocomplete="off" required="required"/>
      <i class="fa fa-calendar form-control-feedback"></i>  
    </div> 
  </div>  
</div><br>

</div>
      <div class="modal-footer">
        <button type="submit" name="btn-update" id="btn-update" class="btn btn-primary"><span class="fa fa-edit"></span> Actualizar</button> 
        <button class="btn btn-danger" type="reset" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-trash-o"></i> Cerrar</button>
      </div></form>
    </div>
  </div>
</div>
</div>   
                                  




<div id="myModal2" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none">

  <div class="modal-dialog modal-lg">
    <div class="modal-content p-0 b-0">
      <div class="panel panel-color panel-primary">
        <div class="panel-heading">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="assets/images/close.png"/></button> 
          <h3 class="panel-title"><i class="fa fa-tasks"></i> Retiro de Estudiante</h3>
        </div>
 <form class="form" name="retiroestudiantes" id="retiroestudiantes" method="post" action="#">
          <div class="panel-body">
            <div id="retiro">
              <!-- error will be shown here ! -->
            </div>

    <div class="row"> 
      <div class="col-md-4"> 
        <div class="form-group has-feedback"> 
          <label class="control-label">Nº de DNI: <span class="symbol required"></span></label> 
          <input type="hidden" name="codturno3" id="codturno3">
          <input type="hidden" name="codnivel3" id="codnivel3">
          <input type="hidden" name="codgrado3" id="codgrado3">
          <input type="hidden" name="codseccion3" id="codseccion3">
          <input type="hidden" name="codest" id="codest">
          <input type="hidden" name="codperiodo" id="codperiodo">
          <input name="cedest" class="form-control" type="text" id="cedest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Código de Estudiante" autocomplete="off" readonly="readonly"/>
          <i class="fa fa-pencil form-control-feedback"></i>   
        </div> 
      </div>

      <div class="col-md-4"> 
       <div class="form-group has-feedback"> 
        <label class="control-label">Nombres: <span class="symbol required"></span></label> 
        <input name="pnomest" class="form-control" type="text" id="pnomest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nombres de Estudiante" autocomplete="off" readonly="readonly"/>
        <i class="fa fa-pencil form-control-feedback"></i>  
      </div> 
    </div> 
    <div class="col-md-4"> 
     <div class="form-group has-feedback"> 
      <label class="control-label">Apellidos:</label> 
      <input name="papeest" class="form-control" type="text" id="papeest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Apellidos de Estudiante" autocomplete="off" readonly="readonly"/>
      <i class="fa fa-pencil form-control-feedback"></i>  
    </div> 
  </div>  
</div>

<div class="row"> 
<div class="col-md-8"> 
<div class="form-group has-feedback"> 
<label class="control-label">Observaciones de Retiro: <span class="symbol required"></span></label> 
<input name="observacionest" class="form-control" type="text" id="observacionest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Observaciones de Retiro" autocomplete="off" required="required"/>
<i class="fa fa-comment-o form-control-feedback"></i>  
</div> 
</div> 

    <div class="col-md-4"> 
     <div class="form-group has-feedback"> 
      <label class="control-label">Fecha de Retiro: <span class="symbol required"></span></label> 
      <input name="retiroest" class="form-control calendario" type="text" id="retiroest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Fecha de Retiro" autocomplete="off" value="<?php echo date("d-m-Y") ?>" required="required"/>
      <i class="fa fa-calendar form-control-feedback"></i>  
    </div> 
  </div>  
</div><br>

</div>
      <div class="modal-footer">
        <button type="submit" name="btn-retiro" id="btn-retiro" class="btn btn-primary"><span class="fa fa-edit"></span> Retirar</button> 
        <button class="btn btn-danger" type="button" onclick="document.getElementById('observacionest').value = ''" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-trash-o"></i> Cerrar</button>
      </div></form>
    </div>
  </div>
</div>
</div>  


   
  
   <!----- INICIO DE MENU ----->
   <?php include('menu.php'); ?>
   <!----- FIN DE MENU ----->


<div class="content-page">
<div class="content">
<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-tasks"></i> Control de Estudiantes</h4>
<ol class="breadcrumb pull-right"><li><a href="panel">Inicio</a></li>
<li class="active">Control de Estudiantes</li>
</ol>

<div class="clearfix"></div>

</div>
</div>
</div>    
      
<form class="form" method="post" action="#" name="busquedaestudiantes" id="busquedaestudiantes">

  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Control de Estudiantes</h3></div>
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <div class="box-body">

               <div id="delete-ok"></div>

               <div class="row"> 
                <div class="col-md-3"> 
                 <div class="form-group has-feedback"> 
           <label class="control-label">Seleccione Turno: <span class="symbol required"></span></label> 
  <i class="fa fa-bars form-control-feedback"></i> 
                  <select name="codturno" id="codturno" class="form-control" required="required">
                    <option value="">SELECCIONE</option>
                    <?php
                    $tur = new Login();
                    $tur = $tur->ListarTurno();
                    for($i=0;$i<sizeof($tur);$i++){
                      ?>
                      <option value="<?php echo $tur[$i]['codturno'] ?>"><?php echo $tur[$i]['turno'] ?></option>       
                    <?php } ?>
                  </select>  
                </div> 
              </div>  
              <div class="col-md-3"> 
               <div class="form-group has-feedback"> 
      <label class="control-label">Seleccione Nivel: <span class="symbol required"></span></label> 
  <i class="fa fa-bars form-control-feedback"></i> 
                <select name="codnivel" id="codnivel" class="form-control" onChange="ActivaGrados(document.getElementById('codnivel').value)" required="required">
                  <option value="">SELECCIONE</option>
                  <?php
                  $niv = new Login();
                  $niv = $niv->ListarNivel();
                  for($i=0;$i<sizeof($niv);$i++){
                    ?>
                    <option value="<?php echo $niv[$i]['codnivel'] ?>"><?php echo $niv[$i]['nivel'] ?></option>       
                  <?php } ?>
                </select>  
              </div> 
            </div>
            <div class="col-md-3"> 
              <div class="form-group has-feedback"> 
       <label class="control-label">Seleccione Grado: <span class="symbol required"></span></label>
  <i class="fa fa-bars form-control-feedback"></i>  
                <select name="codgrado" id="codgrado" class="form-control" onChange="ActivaSeccion(document.getElementById('codgrado').value)" required="required">
                  <option value="">SIN RESULTADOS</option>
                </select>        
              </div> 
            </div>

            <div class="col-md-3"> 
             <div class="form-group has-feedback"> 
      <label class="control-label">Seleccione Sección: <span class="symbol required"></span></label>
  <i class="fa fa-bars form-control-feedback"></i>  
              <select name="codseccion" id="codseccion" class="form-control">
                <option value="">SIN RESULTADOS</option>
              </select>  
            </div> 
          </div> 
        </div><br>

        <div class="text-right">
          <button type="button" onClick="BusquedaControlEstudiantes(document.getElementById('codturno').value,document.getElementById('codnivel').value,document.getElementById('codgrado').value,document.getElementById('codseccion').value)" class="btn btn-primary"><span class="fa fa-search"></span> Realizar Búsqueda</button>
        </div>

      </div><!-- /.box-body -->
    </div>
  </div>
</div>
</div>
</div>
</div>

<div id="muestraestudiantes"></div>

</form>
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