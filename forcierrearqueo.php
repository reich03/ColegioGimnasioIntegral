<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria") {
          
$con = new Login();
$con = $con->ContarRegistros();

$tra = new Login();
$ses = $tra->ExpiraSession();

$reg = $tra->ArqueoCajaPorId();

if(isset($_POST['btn-update']))
{
$reg = $tra->CerrarArqueoCaja();
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
<body onLoad="muestraReloj(); getTime();" class="fixed-left">
   
  
   <!----- INICIO DE MENU ----->
   <?php include('menu.php'); ?>
   <!----- FIN DE MENU ----->


<div class="content-page">
<div class="content">
<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-tasks"></i> Gestión de Cierre</h4>
<ol class="breadcrumb pull-right"><li><a href="panel">Inicio</a></li>
<li><a href="arqueoscajas">Control</a></li>
<li class="active">Cierre de Caja</li>
</ol>

<div class="clearfix"></div>

</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Cierre de Caja</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12"> 
            <div class="box-body">
			
<form class="form" name="cierrecaja" id="cierrecaja" method="post" data-id="<?php echo $reg[0]["codarqueo"] ?>" action="#">
                                                  <div id="error">
                                                 <!-- error will be shown here ! -->
                                                  </div>
												
				<div class="row">
        

        <div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
                        <label class="control-label">Caja N°: <span class="symbol required"></span></label>
  <i class="fa fa-bars form-control-feedback"></i>
 <input type="hidden" name="codarqueo" id="codarqueo" <?php if (isset($reg[0]['codarqueo'])) { ?> value="<?php echo $reg[0]['codarqueo']; ?>"<?php } ?>>
<?php if ($_SESSION["acceso"]=="cajero") { ?><input type="hidden" class="form-control" name="codcaja" id="codcaja" value="<?php echo $reg[0]['codcaja']; ?>" ><input type="text" class="form-control" name="nrocaja" id="nrocaja" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" value="<?php echo $reg[0]['nrocaja'].": ".$reg[0]['nombrecaja']; ?>" readonly="readonly"><?php } else { ?>
                <select name="codcaja" id="codcaja" class="form-control" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
      <?php
      $caja = new Login();
      $caja = $caja->ListarCajas();
      for($i=0;$i<sizeof($caja);$i++){
                  ?>
  <option value="<?php echo $caja[$i]['codcaja']; ?>"<?php if (!(strcmp($reg[0]['codcaja'], htmlentities($caja[$i]['codcaja'])))) {echo "selected=\"selected\"";} ?>><?php echo $caja[$i]['nrocaja'].": ".$caja[$i]['nombrecaja']; ?></option>        
                      <?php } ?>
                  </select>
                <?php } ?>  
                              </div> 
                        </div>
            

        <div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
           <label class="control-label">Monto Inicial: <span class="symbol required"></span></label>
 <input type="text" class="form-control" name="montoinicial" id="montoinicial" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Monto Inicial" value="<?php echo $reg[0]['montoinicial']; ?>" readonly="readonly">
                        <i class="fa fa-usd form-control-feedback"></i>  
                              </div> 
                        </div>

         
        <div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
                        <label class="control-label">Ingresos: <span class="symbol required"></span></label>
 <input type="text" class="form-control" name="ingresos" id="ingresos" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Ingresos en Caja" value="<?php echo $reg[0]['ingresos']; ?>" readonly="readonly">
                        <i class="fa fa-usd form-control-feedback"></i>  
                              </div> 
                        </div>
            
        <div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
                        <label class="control-label">Egresos: <span class="symbol required"></span></label>
 <input type="text" class="form-control" name="egresos" id="egresos" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Egresos de Caja" value="<?php echo $reg[0]['egresos']; ?>" readonly="readonly">
                        <i class="fa fa-usd form-control-feedback"></i>  
                              </div> 
                        </div> 
                
        </div>
        
        <div class="row">
            
        <div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
              <label class="control-label">Estimado en Caja: <span class="symbol required"></span></label>
 <input type="text" class="form-control" name="estimado" id="estimado" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Estimado en Caja" value="<?php echo number_format($reg[0]['montoinicial']+$reg[0]['ingresos']-$reg[0]['egresos'], 2, '.', ''); ?>" readonly="readonly">
                        <i class="fa fa-usd form-control-feedback"></i>  
                              </div> 
                        </div> 
                        
        <div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
              <label class="control-label">Efectivo Disponible: <span class="symbol required"></span></label>
 <input type="text" class="form-control cierrecaja" name="dineroefectivo" id="dineroefectivo" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Dinero en Efectivo" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" required="" aria-required="true">
                        <i class="fa fa-usd form-control-feedback"></i>  
                              </div> 
                        </div>  

        <div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
                        <label class="control-label">Diferencia: <span class="symbol required"></span></label>
 <input type="text" class="form-control" name="diferencia" id="diferencia" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Diferencia en Caja" readonly="readonly">
                        <i class="fa fa-usd form-control-feedback"></i>  
                              </div> 
                        </div> 
            
            
        <div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
                        <label class="control-label">Comentario: </label>
<textarea name="comentarios" class="form-control" id="comentarios" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Comentario de Cierre" required="" aria-required="true"></textarea>
                        <i class="fa fa-comment-o form-control-feedback"></i>  
                              </div> 
                        </div>    
        </div><br>
                   
					
			  
            <div class="text-right"> 
<button type="submit" name="btn-update" id="btn-update" class="btn btn-primary"><span class="fa fa-edit"></span> Cerrar Caja</button>
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