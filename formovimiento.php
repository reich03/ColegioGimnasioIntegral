<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria") {
          
$con = new Login();
$con = $con->ContarRegistros();

$tra = new Login();
$ses = $tra->ExpiraSession();

if(isset($_POST['btn-submit']))
{
$reg = $tra->RegistrarMovimientoCajas();
exit;
}
else if(isset($_POST['btn-update']))
{
$reg = $tra->ActualizarMovimientoCajas();
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

<!-- Calendario -->
<link rel="stylesheet" href="assets/calendario/jquery-ui.css" />
<script src="assets/calendario/jquery-ui.js"></script>
<script src="assets/script/jscalendario.js"></script>
<script src="assets/script/autocompleto.js"></script>
<!-- Calendario -->
  
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
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-tasks"></i> Gestión de Movimiento Cajas</h4>
<ol class="breadcrumb pull-right"><li><a href="panel">Inicio</a></li>
<li><a href="movimientoscajas">Control</a></li>
<li class="active">Movimiento Cajas</li>
</ol>

<div class="clearfix"></div>

</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Gestión de Movimiento Cajas</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12"> 
            <div class="box-body">
			
<?php  if (isset($_GET['codmovimientocaja'])) {
      
      $mov = new Login();
      $reg = $mov->MovimientoCajasPorId(); ?>
      
  <form class="form" name="updatemovimientocaja" id="updatemovimientocaja" method="post" data-id="<?php echo $reg[0]["codmovimientocaja"] ?>">
        
    <?php } else { ?>
        
    <form class="form" method="post"  action="#" name="movimientocaja" id="movimientocaja">
      
    <?php } ?>
                                                  <div id="error">
                                                 <!-- error will be shown here ! -->
                                                  </div>
												
				<div class="row">
         <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
          <label class="control-label">Tipo de Movimiento: <span class="symbol required"></span></label>
  <i class="fa fa-bars form-control-feedback"></i>
  <input type="hidden" name="codmovimientocaja" id="codmovimientocaja" <?php if (isset($reg[0]['codmovimientocaja'])) { ?> value="<?php echo $reg[0]['codmovimientocaja']; ?>"<?php } ?>>
                 <?php if (isset($reg[0]['tipomovimientocaja'])) { ?>
               <select name="tipomovimientocaja" id="tipomovimientocaja" class="form-control" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
  <option value="INGRESO"<?php if (!(strcmp('INGRESO', $reg[0]['tipomovimientocaja']))) {echo "selected=\"selected\"";} ?>>INGRESO</option>
  <option value="EGRESO"<?php if (!(strcmp('EGRESO', $reg[0]['tipomovimientocaja']))) {echo "selected=\"selected\"";} ?>>EGRESO</option>
                      </select>
                             <?php } else { ?>  
               <select name="tipomovimientocaja" id="tipomovimientocaja" class="form-control" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
                        <option value="INGRESO">INGRESO</option>
                        <option value="EGRESO">EGRESO</option>
                      </select>
                              <?php } ?>
                              </div> 
                        </div>
            
            
     <?php if($_SESSION["acceso"] == "administrador") { ?>

      <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
          <label class="control-label">Caja de Venta: <span class="symbol required"></span></label> 
  <i class="fa fa-bars form-control-feedback"></i>
                    <?php if (isset($reg[0]['codcaja'])) { ?>
                <select name="codcaja" id="codcaja" class="form-control" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
      <?php
      $caja = new Login();
      $caja = $caja->ListarCajasAbiertas();
      for($i=0;$i<sizeof($caja);$i++){
                  ?>
  <option value="<?php echo $caja[$i]['codcaja']; ?>"<?php if (!(strcmp($reg[0]['codcaja'], htmlentities($caja[$i]['codcaja'])))) {echo "selected=\"selected\"";} ?>><?php echo $caja[$i]['nrocaja'].": ".$caja[$i]['nombrecaja']; ?></option>        
                      <?php } ?>
                  </select>
                             <?php } else { ?> 

               <select name="codcaja" id="codcaja" class="form-control" required="" aria-required="true">
                  <option value="">SELECCIONE</option>
      <?php
      $caja = new Login();
      $caja = $caja->ListarCajasAbiertas();
      for($i=0;$i<sizeof($caja);$i++){
                  ?>
  <option value="<?php echo $caja[$i]['codcaja']; ?>"><?php echo $caja[$i]['nrocaja'].": ".$caja[$i]['nombrecaja']; ?></option>       
                      <?php } ?>
                  </select>
                              <?php } ?>
                              </div> 
                        </div>

              <?php } else { 
      $caja = new Login();
      $caja = $caja->MuestraCaja(); ?>            

        <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
      <label class="control-label">Caja de Venta: <span class="symbol required"></span></label>
 <input type="hidden" name="codcaja" id="codcaja" value="<?php echo $caja[0]["codcaja"]; ?>"><input type="text" class="form-control" name="nrocaja" id="nrocaja" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" value="<?php echo $caja[0]["nrocaja"].": ".$caja[0]['nombrecaja']; ?>" readonly="readonly">
                        <i class="fa fa-desktop form-control-feedback"></i>  
                              </div> 
                        </div>

                <?php } ?>
                               
                           
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
        <label class="control-label">Nº de Factura/Recibo: <span class="symbol required"></span></label> 
 <input name="nrorecibo" class="form-control" type="text" id="nrorecibo" onKeyUp="this.value=this.value.toUpperCase();" <?php if (isset($reg[0]['nrorecibo'])) { ?> value="<?php echo $reg[0]['nrorecibo']; ?>" <?php } else { ?> value="00000" <?php } ?> placeholder="Ingrese Nº de Factura/Recibo" autocomplete="off" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>   
                                                                </div> 
                                                            </div>
                    </div>
          
          <div class="row">
                              

                <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
          <label class="control-label">Monto Movimiento: <span class="symbol required"></span></label> 
  <div id="cargamovimientoinput"><input type="hidden" name="montomovimientocajadb" id="montomovimientocajadb" <?php if (isset($reg[0]['montomovimientocaja'])) { ?> value="<?php echo $reg[0]['montomovimientocaja']; ?>"<?php } ?>></div>

  <input class="form-control number" type="text" name="montomovimientocaja" id="montomovimientocaja" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Monto de Movimiento" <?php if (isset($reg[0]['montomovimientocaja'])) { ?> value="<?php echo $reg[0]['montomovimientocaja']; ?>"<?php } ?> required="" aria-required="true">
                        <i class="fa fa-money form-control-feedback"></i> 
                              </div> 
                        </div>
              

                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
       <label class="control-label">Descripción de Movimiento: <span class="symbol required"></span></label> 
<textarea name="descripcionmovimientocaja" class="form-control" id="descripcionmovimientocaja" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Descripción de Movimiento" required="" aria-required="true"><?php if (isset($reg[0]['descripcionmovimientocaja'])) { ?><?php echo $reg[0]['descripcionmovimientocaja']; ?><?php } ?></textarea>
                        <i class="fa fa-map-marker form-control-feedback"></i> 
                              </div> 
                        </div>
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
            <label class="control-label">Fecha de Movimiento: <span class="symbol required"></span></label> 
<input name="fechamovimientocaja" class="form-control nacimiento" type="text" id="fechamovimientocaja" onKeyUp="this.value=this.value.toUpperCase();" <?php if (isset($reg[0]['fechamovimientocaja'])) { ?> value="<?php echo date("d-m-Y",strtotime($reg[0]['fechamovimientocaja'])); ?>" <?php } else { ?> value="<?php echo date("d-m-Y") ?>" <?php } ?> placeholder="Ingrese Fecha de Movimiento" autocomplete="off" required="required"/>
                        <i class="fa fa-calendar form-control-feedback"></i>  
                                                                </div> 
                                                            </div>   
                    </div><br>
                   			  
            <div class="text-right"> 
<?php  if (isset($_GET['codmovimientocaja'])) { ?>
<button type="submit" name="btn-update" id="btn-update" class="btn btn-primary"><span class="fa fa-edit"></span> Actualizar</button>
		<?php } else { ?>
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><span class="fa fa-save"></span> Guardar</button>	
		<?php } ?>
<button class="btn btn-danger" type="reset"><i class="fa fa-times-circle"></i> Cancelar</button>  
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