<?php
require_once("class/class.php");
if (isset($_SESSION['acceso'])) {

$tra = new Login();

if(isset($_POST['btn-login']))
    {
    $log = $tra->Logueo();
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link href="assets/images/favicon.png" rel="icon" type="image">
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="assets/css/icons.css" rel="stylesheet" type="text/css">
<link href="assets/css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="assets/css/animate.min.css">
<!-- script jquery -->
<script src="assets/js/jquery.min.js"></script> 
<script type="text/javascript" src="assets/script/titulos.js"></script>
<script type="text/javascript" src="assets/script/validation.min.js"></script>
<script type="text/javascript" src="assets/script/script.js"></script>
<!-- script jquery -->
</head>
<body>

	
<div class="accountbg"></div>

              <div class="wrapper-page">
                     <div class="simple-page-form animated flipInY panel panel-color panel-primary panel-pages">
                          <div class="panel-heading bg-img"> 
 <span class="text-center m-t-12 text-white"><div align="center"><img src="assets/images/logo_dark.png" alt="Software para Gestión Academica" width="220" height="80" class='retina-ready'></div></span>                         </div>

<div class="panel-body">
<form class="form-horizontal m-t-10" name="lockscreen" id="lockscreen" action="">

                    <div id="error">
        <!-- error will be shown here ! -->
                    </div>

<?php if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria") {  ?>

<div class="text-center"> 
<?php
if (isset($_SESSION['cedula'])) {
	if (file_exists("fotos/".$_SESSION['cedula'].".jpg")){
    echo "<img src='fotos/".$_SESSION['cedula'].".jpg?".date('h:i:s')."' class='img-responsive img-circle img-thumbnail' alt='thumbnail' width='90' height='90'>"; 
} else {
    echo "<img src='fotos/avatar.jpg' class='img-responsive img-circle img-thumbnail' alt='thumbnail' width='90' height='90'>"; 
} } else {
	echo "<img src='fotos/avatar.jpg' class='img-responsive img-circle img-thumbnail' alt='thumbnail' width='90' height='90'>"; 
}
?>
</div>

<div class="form-group">
  <center><h4><?php echo $_SESSION['nombres'] ?></h4></center>
  <p align="center" class="text-muted">Introduzca su Contraseña para Acceder al Sistema</p>
</div> 

<div class="form-group has-feedback">
    <label class="control-label">Ingrese su Password: <span class="symbol required"></span></label>
    <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION['usuario'] ?>">
    <input type="hidden" name="select" id="select" value="<?php echo $_SESSION['select'] ?>">
    <input class="form-control" type="password" placeholder="Ingrese su Password" name="password" id="password" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" required="" aria-required="true">
    <i class="fa fa-lock form-control-feedback"></i>            
</div>

<div class="form-group has-feedback">
    <a tabindex="-1" style="border-style: none;" href="#" title="Refrescar Imagen" onClick="document.getElementById('siimage').src = 'assets/captcha/securimage_show.php?sid=' + Math.random(); this.blur(); return false"><img id="siimage" name="siimage" style="border: 1px solid #CCCCCC; margin-right: 5px" src="assets/captcha/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" onClick="this.blur()" alt="CAPTCHA Image" width="150" height="65" align="left"></a>
    <label>Ingrese Código: <span class="symbol required"></span></label><br /><input type="text" class="form-control" name="captcha1" id="captcha1" autocomplete="off" style="width:160px;height:30px" placeholder="Ingrese Código" required />
</div>

<div class="form-group m-t-10 m-b-0">
    <div class="col-sm-12 text-center"><a href="logout" class="text-muted">No Acceder con <?php echo $_SESSION['usuario']?>?</a></div>
</div>


<?php } else { ?>

<div class="text-center"> 
<?php
if (isset($_SESSION['ceddoc'])) {
    if (file_exists("fotos/".$_SESSION['ceddoc'].".jpg")){
    echo "<img src='fotos/".$_SESSION['ceddoc'].".jpg?".date('h:i:s')."' class='img-responsive img-circle img-thumbnail' alt='thumbnail' width='90' height='90'>"; 
} else {
    echo "<img src='fotos/docente.jpg' class='img-responsive img-circle img-thumbnail' alt='thumbnail' width='90' height='90'>"; 
} } else {
    echo "<img src='fotos/docente.jpg' class='img-responsive img-circle img-thumbnail' alt='thumbnail' width='90' height='90'>"; 
}
?>
</div>


<div class="form-group">
  <center><h4><?php echo $_SESSION['nomdoc'] ?></h4></center>
  <p align="center" class="text-muted">Introduzca su Contraseña para Acceder al Sistema</p>
</div> 

<div class="form-group has-feedback">
    <label class="control-label">Ingrese su Password: <span class="symbol required"></span></label>
    <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION['ceddoc'] ?>">
    <input type="hidden" name="select" id="select" value="<?php echo $_SESSION['select'] ?>">
    <input class="form-control" type="password" placeholder="Ingrese su Password" name="password" id="password" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" required="" aria-required="true">
    <i class="fa fa-lock form-control-feedback"></i>            
</div>

<div class="form-group has-feedback">
    <a tabindex="-1" style="border-style: none;" href="#" title="Refrescar Imagen" onClick="document.getElementById('siimage').src = 'assets/captcha/securimage_show.php?sid=' + Math.random(); this.blur(); return false"><img id="siimage" name="siimage" style="border: 1px solid #CCCCCC; margin-right: 5px" src="assets/captcha/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" onClick="this.blur()" alt="CAPTCHA Image" width="150" height="65" align="left"></a>
    <label>Ingrese Código: <span class="symbol required"></span></label><br /><input type="text" class="form-control" name="captcha1" id="captcha1" autocomplete="off" style="width:160px;height:30px" placeholder="Ingrese Código" required />
</div>


<div class="form-group m-t-10 m-b-0">
    <div class="col-sm-12 text-center"><a href="logout" class="text-muted">No Acceder con <?php echo $_SESSION['ceddoc']?>?</a></div>
</div>

<?php } ?>



<div class="form-group text-center m-t-20">
<div class="col-xs-12"> 
<button class="btn btn-block btn-lg btn-warning waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Haga clic aquí para iniciar sesión" name="btn-login" id="btn-login" type="submit"><span class="fa fa-sign-in"></span> Acceder</button>
</div>
</div>

</form>
</div>
</div>
</div> 

        <script>
            var resizefunc = [];
        </script>

        <!-- Main -->
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
  

        <script src="assets/plugins/notifyjs/dist/notify.min.js"></script>
        <script src="assets/plugins/notifications/notify-metro.js"></script>
        <script src="assets/plugins/notifications/notifications.js"></script>
        <script src="assets/plugins//noty/packaged/jquery.noty.packaged.min.js"></script>
</body>
</html>
<?php } else { ?>
        <script type='text/javascript' language='javascript'>
        alert('NO TIENES PERMISO PARA ACCEDER AL SISTEMA.\nDEBERA DE INICIAR SESION')  
        document.location.href='logout'  
        </script> 
<?php } ?>