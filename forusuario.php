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
$reg = $tra->RegistrarUsuarios();
exit;
} 
else if(isset($_POST['btn-update']))
{
$reg = $tra->ActualizarUsuarios();
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
<!-- Custom file upload -->
<script src="assets/plugins/fileupload/bootstrap-fileupload.min.js"></script>
<script type="text/javascript" src="assets/script/jquery.mask.js"></script>
<script type="text/javascript" src="assets/script/titulos.js"></script>
<script type="text/javascript" src="assets/script/script2.js"></script>
<script type="text/javascript" src="assets/script/jscalendario.js"></script>
<script type="text/javascript" src="assets/script/validation.min.js"></script>
<script type="text/javascript" src="assets/script/script.js"></script>
<script type="text/javascript">
    jQuery.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-zA-ZñÑáéíóúÁÉÍÓÚ,. ]+$/i.test(value);
    });
</script>
<script type="text/javascript">
  $(document).ready(function() {
  $("#nrotelefono").mask("(9999) - 999999999");
  });
</script>
<!-- script jquery -->

<!-- Calendario -->
<link rel="stylesheet" href="assets/calendario/jquery-ui.css" />
<script src="assets/calendario/jquery-ui.js"></script>
<script type="text/javascript" src="assets/script/jscalendario.js"></script>
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
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-tasks"></i> Gestión de Usuarios</h4>
<ol class="breadcrumb pull-right"><li><a href="panel">Inicio</a></li>
<li><a href="usuarios">Control</a></li>
<li class="active">Gestión de Usuarios</li>
</ol>

<div class="clearfix"></div>

</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Gestión de Usuarios</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12"> 
            <div class="box-body">
      
<?php  if (isset($_GET['codigo'])) {
      
      $reg = $tra->UsuariosPorId(); ?>
      
<form class="form" name="updateusuario" id="updateusuario" method="post" data-id="<?php echo $reg[0]["codigo"] ?>" action="#" enctype="multipart/form-data" >
        
    <?php } else { ?>
        
    <form class="form" method="post"  action="#" name="usuario" id="usuario" enctype="multipart/form-data"> 
      
    <?php } ?>
                                              <div id="error">
                                              <!-- error will be shown here ! -->
                                              </div>
                        
        <div class="row"> 
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
  <label class="control-label">Nº de DNI: <span class="symbol required"></span></label> 
 <input type="hidden" name="codigo" id="codigo" <?php if (isset($reg[0]['codigo'])) { ?> value="<?php echo $reg[0]['codigo']; ?>"<?php } ?>>
<input type="text" class="form-control" name="cedula" id="cedula" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Nº de DNI de Usuario" <?php if (isset($reg[0]['cedula'])) { ?> value="<?php echo $reg[0]['cedula']; ?>"<?php } ?> required="" aria-required="true">
                        <i class="fa fa-pencil form-control-feedback"></i>  
                              </div> 
                        </div>
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Nombre de Usuario: <span class="symbol required"></span></label> 
  <input type="text" class="form-control" name="nombres" id="nombres" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Nombre de Usuario" <?php if (isset($reg[0]['nombres'])) { ?> value="<?php echo $reg[0]['nombres']; ?>"<?php } ?> required="" aria-required="true">
                        <i class="fa fa-pencil form-control-feedback"></i>  
                              </div> 
                        </div>

                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
            <label class="control-label">Sexo de Usuario: <span class="symbol required"></span></label>
  <i class="fa fa-bars form-control-feedback"></i>
                              <?php if (isset($reg[0]['sexo'])) { ?>
<select name="sexo" id="sexo" class="form-control" tabindex="3" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
<option value="MASCULINO"<?php if (!(strcmp('MASCULINO', $reg[0]['sexo']))) {echo "selected=\"selected\"";} ?>>MASCULINO</option>
<option value="FEMENINO"<?php if (!(strcmp('FEMENINO', $reg[0]['sexo']))) {echo "selected=\"selected\"";} ?>>FEMENINO</option>
                      </select>
                             <?php } else { ?>  
  <select name="sexo" id="sexo" class="form-control" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
                        <option value="MASCULINO">MASCULINO</option>
                        <option value="FEMENINO">FEMENINO</option>
                  </select>
                              <?php } ?>
                              </div> 
                        </div> 
                    </div>

          <div class="row">  
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
  <label class="control-label">Cargo de Usuario: <span class="symbol required"></span></label> 
    <input type="text" class="form-control" name="cargo" id="cargo" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Cargo de Usuario" <?php if (isset($reg[0]['cargo'])) { ?> value="<?php echo $reg[0]['cargo']; ?>"<?php } ?> required="" aria-required="true">
                        <i class="fa fa-pencil form-control-feedback"></i>  
                              </div> 
                        </div> 

                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
  <label class="control-label">Correo de Usuario: <span class="symbol required"></span></label> 
 <input type="text" class="form-control" name="email" id="email" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Correo de Usuario" <?php if (isset($reg[0]['email'])) { ?> value="<?php echo $reg[0]['email']; ?>"<?php } ?> required="" aria-required="true">
                        <i class="fa fa-envelope-o form-control-feedback"></i>  
                              </div> 
                        </div>  
                              
              <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
  <label class="control-label">Usuarios de Acceso: <span class="symbol required"></span></label> 
<input type="text" class="form-control" name="usuario" id="usuario" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Usuario de Acceso" <?php if (isset($reg[0]['usuario'])) { ?> value="<?php echo $reg[0]['usuario']; ?>"<?php } ?> required="" aria-required="true">
                        <i class="fa fa-user form-control-feedback"></i>  
                              </div> 
                    </div>
             </div>  
          
          <div class="row"> 
                           <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
  <label class="control-label">Password de Acceso: <span class="symbol required"></span></label> 
   <input name="password" class="form-control" type="text" id="password" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Password de Acceso" autocomplete="off"  required="required"/>
                        <i class="fa fa-unlock form-control-feedback"></i>  
                              </div> 
                        </div> 
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Repita Password: <span class="symbol required"></span></label>
<input type="text" class="form-control" name="password2" id="password2" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Password de Acceso" required="" aria-required="true">
                        <i class="fa fa-unlock form-control-feedback"></i>  
                              </div> 
                        </div>  

      <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
    <label class="control-label">Nivel de Acceso: <span class="symbol required"></span></label>
  <i class="fa fa-bars form-control-feedback"></i>
                              <?php if (isset($reg[0]['nivel'])) { ?>
  <select name="nivel" id="nivel" class="form-control" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
  <option value="ADMINISTRADOR(A)"<?php if (!(strcmp('ADMINISTRADOR(A)', $reg[0]['nivel']))) {echo "selected=\"selected\"";} ?>>ADMINISTRADOR(A)</option>
  <option value="SECRETARIA"<?php if (!(strcmp('SECRETARIA', $reg[0]['nivel']))) {echo "selected=\"selected\"";} ?>>SECRETARIA</option>
                      </select>
                             <?php } else { ?>  
<select name="nivel" id="nivel" class="form-control" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
                        <option value="ADMINISTRADOR(A)">ADMINISTRADOR(A)</option>
                        <option value="SECRETARIA">SECRETARIA</option>
                  </select>
                              <?php } ?>
                              </div> 
                        </div> 
             </div>  
          
          <div class="row"> 
                   
                              
              <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
        <label class="control-label">Status de Usuario: <span class="symbol required"></span></label>
  <i class="fa fa-bars form-control-feedback"></i>
                               <?php if (isset($reg[0]['status'])) { ?>
  <select name="status" id="status" class="form-control" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
  <option value="ACTIVO"<?php if (!(strcmp('ACTIVO', $reg[0]['status']))) {echo "selected=\"selected\"";} ?>>ACTIVO</option>
  <option value="INACTIVO"<?php if (!(strcmp('INACTIVO', $reg[0]['status']))) {echo "selected=\"selected\"";} ?>>INACTIVO</option>
                      </select>
                             <?php } else { ?>
 <select name="status" id="status" class="form-control" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
                        <option value="ACTIVO">ACTIVO</option>
                        <option value="INACTIVO">INACTIVO</option>
                      </select>
                   <?php } ?> 
                              </div> 
                        </div> 
                              
             <div class="col-sm-4">
                          <div class="fileinput fileinput-new" data-provides="fileinput">
      <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 90px; height: 100px;">
<?php if (isset($reg[0]['cedula'])) {
  if (file_exists("fotos/".$reg[0]['cedula'].".jpg")){
    echo "<img src='fotos/".$reg[0]['cedula'].".jpg?".date('h:i:s')."' class='img-rounded' border='0' width='100' height='110' title='Foto del Usuario' data-rel='tooltip'>"; 
}else{
    echo "<img src='fotos/avatar.jpg' class='img-rounded' border='1' width='90' height='100' title='Sin Foto' data-rel='tooltip'>"; 
} } else {
  echo "<img src='fotos/avatar.jpg' class='img-rounded' border='1' width='90' height='100' title='Sin Foto' data-rel='tooltip'>"; 
}
?>
                            </div>
                            <div>
                              <span class="btn btn-default btn-file">
              <span class="fileinput-new"><i class="fa fa-file-image-o"></i> Imagen</span>
               <span class="fileinput-exists"><i class="fa fa-paint-brush"></i> Imagen</span>
<input type="file" size="10" data-original-title="Subir Fotografia" data-rel="tooltip" placeholder="Suba su Fotografia" name="imagen" id="imagen"  />
                              </span>
 <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times-circle"></i> Remover</a><small><p>Para Subir su Fotografía debe tener en cuenta lo siguiente:<br> * La Imagen debe ser extensión.jpg<br> * La imagen no debe ser mayor de 50 KB</p></small>                             </div>
                          </div>
                        </div>
              
                    </div><br>
        
            <div class="text-right"> 
<?php  if (isset($_GET['codigo'])) { ?>
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
        <script src="assets/plugins/noty/packaged/jquery.noty.packaged.min.js"></script>>
  

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