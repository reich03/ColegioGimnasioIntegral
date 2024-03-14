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
$reg = $tra->RegistrarSecciones();
exit;
}
elseif(isset($_POST['btn-update']))
{
$reg = $tra->ActualizarSecciones();
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
<script type="text/javascript" src="assets/script/ajax.js"></script>
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
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-edit"></i> Gestión de Secciones</h4>
<ol class="breadcrumb pull-right"><li><a href="panel">Inicio</a></li>
<li><a href="secciones">Control</a></li>
<li class="active">Gestión de Secciones</li>
</ol>

<div class="clearfix"></div>

</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Gestión de Secciones</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12">
            <div class="box-body">


 <?php  if (isset($_GET['codseccion'])) {
      
      $reg = $tra->SeccionesPorId(); ?>
      
<form class="form" name="updateseccion" id="updateseccion" method="post" data-id="<?php echo $reg[0]["codseccion"] ?>" action="#">
        
    <?php } else { ?>
        
<form class="form" method="post" action="#" name="secciones" id="secciones"> 
      
    <?php } ?>
 
                                                  <div id="error">
                                                 <!-- error will be shown here ! -->
                                                     </div> 
             
			 
			 <div class="row"> 
							 <div class="col-md-6"> 
                              <div class="form-group has-feedback"> 
            <label class="control-label">Seleccione Nivel: <span class="symbol required"></span></label>
  <i class="fa fa-bars form-control-feedback"></i>
<input type="hidden" name="codseccion" id="codseccion" <?php if (isset($reg[0]['codseccion'])) { ?> value="<?php echo $reg[0]['codseccion']; ?>" <?php } ?> >

                              <?php if (isset($reg[0]['codnivel'])) { ?>
<select name="codnivel" id="codnivel" class="form-control" onChange="ActivaGrados(document.getElementById('codnivel').value)" required="required">
                        <option value="">SELECCIONE</option>
      <?php
      $niv = new Login();
      $niv = $niv->ListarNivel();
      for($i=0;$i<sizeof($niv);$i++){
                  ?>
<option value="<?php echo $niv[$i]['codnivel'] ?>"<?php if ($niv[$i]['codnivel'] == $reg[0]['codnivel']) { ?> selected="selected" <?php } ?>><?php echo $niv[$i]['nivel'] ?></option>        
                      <?php } ?>
                  </select>
                             <?php } else { ?>  
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
                              <?php } ?>
                              </div> 
                        </div>


            <div class="col-md-3"> 
                              <div class="form-group has-feedback"> 
<label class="control-label">Seleccione Grado: <span class="symbol required"></span></label>
  <i class="fa fa-bars form-control-feedback"></i>
          <?php if (isset($reg[0]['codgrado'])) { ?>
<select name="codgrado" id="codgrado" class="form-control" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
      <?php
      $gra = new Login();
      $gra = $gra->ListarGrados();
      for($i=0;$i<sizeof($gra);$i++){
                  ?>
<option value="<?php echo $gra[$i]['codgrado'] ?>"<?php if ($gra[$i]['codgrado'] == $reg[0]['codgrado']) { ?> selected="selected" <?php } ?>><?php echo $gra[$i]['grado'] ?></option> 
                      <?php } ?>
                  </select>
                             <?php } else { ?>

<select class="form-control" id="codgrado" name="codgrado" required="required">
<option value="">SELECCIONE</option>
          </select>
                              <?php } ?>
                    </div>
                </div>
															
                            <div class="col-md-3"> 
                              <div class="form-group has-feedback"> 
          <label class="control-label">Sección o Paralelo: <span class="symbol required"></span></label> 
 <input name="seccion" class="form-control" type="text" id="seccion" onKeyUp="this.value=this.value.toUpperCase();" <?php if (isset($reg[0]['seccion'])) { ?> value="<?php echo $reg[0]['seccion']; ?>"<?php } ?> placeholder="Ingrese Sección o Paralelo" autocomplete="off" required="required"/>
					   <i class="fa fa-pencil form-control-feedback"></i>  
                                                                </div> 
                                                            </div>	
                    </div><br>        
       
       
            <div class="text-right">
<?php  if (isset($_GET['codseccion'])) { ?>
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