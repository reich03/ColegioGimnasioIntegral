<?php
require_once("class/class.php");

$tra = new Login();

if(isset($_POST['btn-login']))
{
	$log = $tra->Logueo();
	exit;
}
elseif(isset($_POST["btn-recuperar"]))
{
	$reg = $tra->RecuperarPassword();
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

    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="assets/images/close.png"/></button>
                  <h4 class="modal-title text-primary" id="myModalLabel"><strong>Recuperar Password</strong></h4>
              </div>
              <form class="form-horizontal m-t-10" method="post" name="recuperarpassword" id="recuperarpassword">
                <div id="errorr">
                    <!-- error will be shown here ! -->
                </div>

                <div class="col-sm-12">
                    <div class="form-group has-feedback">
                        <label class="control-label">Seleccione Acceso: <span class="symbol required"></span></label>
                        <i class="fa fa-bars form-control-feedback"></i>  
                        <select name="select" id="select" class='form-control' required="" aria-required="true">
                            <option value="">SELECCIONE</option>
                            <option value="ADMINISTRADOR(A)">ADMINISTRADOR(A)</option>
                            <option value="SECRETARIA">SECRETARIA</option>
                            <option value="DOCENTE">DOCENTE</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-12">
                  <div class="form-group has-feedback">
                    <label class="control-label">Ingrese su Email: <span class="symbol required"></span></label>
                    <input class="form-control" type="email" placeholder="Ingrese su Email" name="email" id="email" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" required="" aria-required="true">
                    <i class="fa fa-envelope form-control-feedback"></i>					
                </div>
            </div>

            <p class="text-danger"><small>Su nueva clave de Acceso será enviada al Correo Electrónico que ingrese</small></p>

            <div class="modal-footer"> 
                <button class="btn btn-block btn-lg btn-warning waves-effect waves-light" name="btn-recuperar" id="btn-recuperar" type="submit"><span class="fa fa-check-square-o"></span> Recuperar Password</button>
            </div>
        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
					



<div class="accountbg"></div>

<div class="wrapper-page">
   <div class="simple-page-form animated flipInY panel panel-color panel-primary panel-pages">

       <div class="panel-heading bg-img"> 
        <span class="text-center m-t-12 text-white"><div align="center"><img src="assets/images/logo_dark.png" alt="Software para Gestión Academica" width="220" height="80" class='retina-ready'></div></span>
    </div>

    <div class="panel-body">
        <form class="form-horizontal m-t-10" name="loginform" id="loginform" action="">

            <div id="error">
                <!-- error will be shown here ! -->
            </div>

            <div class="form-group has-feedback">
                <label class="control-label">Seleccione Acceso: <span class="symbol required"></span></label>
                <i class="fa fa-bars form-control-feedback"></i>  
                <select name="select" id="select" class='form-control' required="" aria-required="true">
                    <option value="">SELECCIONE</option>
                    <option value="ADMINISTRADOR(A)">ADMINISTRADOR(A)</option>
                    <option value="SECRETARIA">SECRETARIA</option>
                    <option value="DOCENTE">DOCENTE</option>
                </select>
            </div>

            <div class="form-group has-feedback">
                <label class="control-label">Ingrese su Usuario: <span class="symbol required"></span></label>
                <input type="text" class="form-control" placeholder="Ingrese su Usuario" name="usuario" id="usuario" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" required="" aria-required="true">
                <i class="fa fa-user form-control-feedback"></i>
            </div>

            <div class="form-group has-feedback">
                <label class="control-label">Ingrese su Password: <span class="symbol required"></span></label>
                <input class="form-control" type="password" placeholder="Ingrese su Password" name="password" id="password" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" required="" aria-required="true">
                <i class="fa fa-lock form-control-feedback"></i>				    
            </div>

            <div class="form-group has-feedback">
                <a tabindex="-1" style="border-style: none;" href="#" title="Refrescar Imagen" onClick="document.getElementById('siimage').src = 'assets/captcha/securimage_show.php?sid=' + Math.random(); this.blur(); return false"><img id="siimage" name="siimage" style="border: 1px solid #CCCCCC; margin-right: 5px" src="assets/captcha/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" onClick="this.blur()" alt="CAPTCHA Image" width="150" height="65" align="left"></a>
                <label>Ingrese Código: <span class="symbol required"></span></label><br /><input type="text" class="form-control" name="captcha1" id="captcha1" autocomplete="off" style="width:160px;height:30px" placeholder="Ingrese Código" required />                    
            </div>

            <div class="form-group text-center m-t-10">
                <div class="col-xs-12"> 
                    <button class="btn btn-block btn-lg btn-warning waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Haga clic aquí para iniciar sesión" name="btn-login" id="btn-login" type="submit"><span class="fa fa-sign-in"></span> Acceder</button>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <a href="#" class="on-default centered" data-href="#" data-toggle="modal" data-target=".bs-example-modal-sm" data-placement="left" data-backdrop="static" data-keyboard="false" rel="tooltip" title="Recuperar Contraseña"><center><i class="fa fa-lock m-r-5"></i> ¿ Olvidaste tu Password ?</center></a></div>
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
		
		 <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/images/login-bg.jpg", {speed: 500});
    </script>
</body>
</html>