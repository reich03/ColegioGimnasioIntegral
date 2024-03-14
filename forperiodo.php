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
$reg = $tra->RegistrarPeriodoEscolar();
exit;
} 
else if(isset($_POST['btn-update']))
{
$reg = $tra->ActualizarPeriodoEscolar();
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
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-edit"></i> Gestión de Periodos</h4>
<ol class="breadcrumb pull-right"><li><a href="panel">Inicio</a></li>
<li><a href="periodoescolar">Control</a></li>
<li class="active">Gestión de Periodos</li>
</ol>

<div class="clearfix"></div>

</div>
</div>
</div>
      
<?php  if (isset($_GET['codperiodo'])) {
      
      $reg = $tra->PeriodoEscolarPorId(); ?>
      
<form class="form" name="updateperiodoescolar" id="updateperiodoescolar" method="post" data-id="<?php echo $reg[0]["codperiodo"] ?>" action="#">
        
    <?php } else { ?>
        
<form class="form" method="post" action="#" name="periodoescolar" id="periodoescolar">

    <?php } ?> 

<div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Gestión de Periodos</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12">
            <div class="box-body">

                                                  <div id="error">
                                                 <!-- error will be shown here ! -->
                                                     </div> 
             
			 <div class="row"> 
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
              <label class="control-label">Periodo Escolar: <span class="symbol required"></span></label> 
<input type="hidden" name="codperiodo" id="codperiodo" <?php if (isset($reg[0]['codperiodo'])) { ?> value="<?php echo $reg[0]['codperiodo']; ?>"<?php } ?>>
<input name="periodo" class="form-control" type="text" id="periodo" onKeyUp="this.value=this.value.toUpperCase();" <?php if (isset($reg[0]['periodo'])) { ?> value="<?php echo $reg[0]['periodo']; ?>"<?php } ?> placeholder="Ingrese Periodo Escolar" autocomplete="off" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>    
                                                                </div> 
                                                            </div>
															
							<div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
<label class="control-label">Descripción de Periodo Escolar: <span class="symbol required"></span></label> 
<input name="descripcion" class="form-control" type="text" id="descripcion" onKeyUp="this.value=this.value.toUpperCase();" <?php if (isset($reg[0]['descripcion'])) { ?> value="<?php echo $reg[0]['descripcion']; ?>"<?php } ?> placeholder="Ingrese Descripción de Periodo Escolar" autocomplete="off" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>   
                                                                </div> 
                                                            </div> 
                          <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Monto Cuota Unica: <span class="symbol required"></span></label> 
<input name="cuotaunica" class="form-control" type="text" id="cuotaunica" onKeyUp="this.value=this.value.toUpperCase();" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" <?php if (isset($reg[0]['cuotaunica'])) { ?> value="<?php echo $reg[0]['cuotaunica']; ?>"<?php } ?> placeholder="Ingrese Monto Cuota Unica" autocomplete="off" required="required"/>
                        <i class="fa fa-dollar form-control-feedback"></i> 
                                                                </div> 
                                                            </div> 	
                    </div>   
					
					
					<div class="row"> 
                          <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Interés por Mora en Pago: <span class="symbol required"></span></label> 
<input name="interesmora" class="form-control" type="text" id="interesmora" onKeyUp="this.value=this.value.toUpperCase();" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" <?php if (isset($reg[0]['interesmora'])) { ?> value="<?php echo $reg[0]['interesmora']; ?>"<?php } ?> placeholder="Ingrese Interés por Mora en Pago de Cuotas" autocomplete="off" required="required"/>
                        <i class="fa fa-dollar form-control-feedback"></i> 
                                                                </div> 
                                                            </div> 
					
					<div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
  <label class="control-label">Dia para Vencimiento de Pago: <span class="symbol required"></span></label>
  <i class="fa fa-bars form-control-feedback"></i>
                              <?php if (isset($reg[0]['diasvence'])) { ?>
<select name="diasvence" id="diasvence" class="form-control" required="required">
              <option value="">SELECCIONE</option>
              <?php for($i=1;$i<=28;$i++) { ?>  
            <option value="<?php echo $i; ?>"<?php if ($i == $reg[0]['diasvence']) { ?> selected="selected" <?php } ?>><?php echo $i; ?></option>
            <?php } ?>   
   </select>
                             <?php } else { ?>  
  <select name="diasvence" id="diasvence" class="form-control" required="required">
              <option value="">SELECCIONE</option>
              <?php for($i=1;$i<=28;$i++) { ?>  
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>   
   </select>
                              <?php } ?>
                              </div> 
                        </div>

                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
            <label class="control-label">Fecha Creado: <span class="symbol required"></span></label> 
<input name="fechacreado" class="form-control" type="text" id="fechacreado" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Fecha Creado" autocomplete="off" <?php if (isset($reg[0]['fechacreado'])) { ?> value="<?php echo date("d-m-Y",strtotime($reg[0]['fechacreado'])); ?>" <?php } else { ?> value="<?php echo date("d-m-Y"); ?>" <?php } ?> readonly="readonly"/>
                        <i class="fa fa-calendar form-control-feedback"></i>    
                                                                </div> 
                                                            </div>
                  </div> 

                     </div><!-- /.box-body -->
								</div>
                          </div>
                     </div>
                </div>
           </div>
       </div>
	   
	   
	   <div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Gestión de Meses Activos para Pagos</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12">
   <div class="box-body">


			<?php  if (isset($_GET['codperiodo'])) { ?>

        <div class="row"> 
<?php
$meses = array('01' => 'Enero', '02'=> 'Febrero', '03'=> 'Marzo', '04'=> 'Abril', '05'=> 'Mayo', '06'=> 'Junio', '07'=> 'Julio', '08'=> 'Agosto', '09'=> 'Septiembre', '10'=> 'Octubre', '11'=> 'Noviembre', '12' => 'Diciembre');

                    foreach($meses as $num=>$mes) { ?>
                  <div class="col-md-2"> 
                                <div class="checkbox checkbox-primary">
  <input name="mesesactivos[]" id="mesesactivos<?php echo "{$num}"; ?>" type="checkbox" class="checkbox" value="<?php echo "{$num}"; ?>" <?php 
$news = explode(",", $reg[0]['mesesactivos']);
foreach ($news as $value){
echo $value == "{$num}"?"checked=\"checked\"":''; }?> >

                                            <label for="mesesactivos<?php echo "{$num}"; ?>">
                                                <?php echo "{$mes}"; ?>
                                            </label>
                                </div>
                            </div><?php  } ?>
                    </div>

        <?php } else { ?>

					<div class="row"> 
<?php
$meses = array('01' => 'Enero', '02'=> 'Febrero', '03'=> 'Marzo', '04'=> 'Abril', '05'=> 'Mayo', '06'=> 'Junio', '07'=> 'Julio', '08'=> 'Agosto', '09'=> 'Septiembre', '10'=> 'Octubre', '11'=> 'Noviembre', '12' => 'Diciembre');
                  foreach($meses as $num=>$mes) { ?>
					        <div class="col-md-2"> 
                                <div class="checkbox checkbox-primary">
  <input name="mesesactivos[]" id="mesesactivos<?php echo "{$num}"; ?>" type="checkbox" class="checkbox" value="<?php echo "{$num}"; ?>">
                                            <label for="mesesactivos<?php echo "{$num}"; ?>">
                                                <?php echo "{$mes}"; ?>
                                            </label>
                                </div>
                            </div><?php  } ?>
                    </div><?php } ?><br>
        
            <div class="text-right"> 
<?php  if (isset($_GET['codperiodo'])) { ?>
<button type="submit" name="btn-update" id="btn-update" class="btn btn-primary"><span class="fa fa-edit"></span> Actualizar</button>
<button class="btn btn-danger" type="reset"><i class="fa fa-trash-o"></i> Cancelar</button> 
    <?php } else { ?>
<button type="button" onClick="CrearPeriodo(document.getElementById('mesesactivos<?php echo "{$num}"; ?>').value,document.getElementById('periodo').value,document.getElementById('descripcion').value,document.getElementById('cuotaunica').value,document.getElementById('interesmora').value,document.getElementById('diasvence').value)" class="btn btn-primary"><span class="fa fa-save"></span> Crear Periodo</button>
<button class="btn btn-danger" type="reset"><i class="fa fa-trash-o"></i> Limpiar</button>
    <?php } ?>   
                          </div>
                    </div><!-- /.box-body -->
								</div>
                          </div>
                     </div>
              </div>
       </div>
</div>
	   
	   
	     <div id="muestraperiodo"></div>
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