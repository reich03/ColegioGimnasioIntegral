<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria") {

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


<!-- Calendario -->
<link rel="stylesheet" href="assets/calendario/jquery-ui.css" />
<script src="assets/calendario/jquery-ui.js"></script>
<script src="assets/script/jscalendario.js"></script>
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
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-tasks"></i> Búsqueda de Pagos General</h4>
<ol class="breadcrumb pull-right"><li><a href="panel">Inicio</a></li>
<li class="active">Búsqueda de Pagos General</li>
</ol>

<div class="clearfix"></div>

</div>
</div>
</div>	  
		  
 <form class="form" method="post" action="#" name="pagosgeneral" id="pagosgeneral">

<div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Búsqueda de Pagos General</h3></div>
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
           <label class="control-label">Fecha Desde: <span class="symbol required"></span></label> 
<input name="desde" class="form-control" type="text" id="desde" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Fecha Desde" autocomplete="off" required="required"/>
                        <i class="fa fa-calendar form-control-feedback"></i>  
                                                                </div> 
                                                            </div>
															
						  <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
          <label class="control-label">Fecha Hasta: <span class="symbol required"></span></label> 
<input name="hasta" class="form-control" type="text" id="hasta" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Fecha Hasta" autocomplete="off" required="required"/>
                        <i class="fa fa-calendar form-control-feedback"></i>  
                                                                </div> 
                                                            </div>		
															
							<div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
        <label class="control-label">Seleccione Periodo: <span class="symbol required"></span></label> 
  <i class="fa fa-bars form-control-feedback"></i>
<select name="codperiodo" id="codperiodo" class="form-control" required="required">
							<option value="">SELECCIONE</option>
			<?php
			$per = new Login();
			$per = $per->ListarPeriodoEscolar();
			for($i=0;$i<sizeof($per);$i++){
		              ?>
<option value="<?php echo $per[$i]['codperiodo'] ?>"><?php echo $per[$i]['periodo'] ?></option>			  
                      <?php } ?>
							    </select>  
                                                                </div> 
                                                 </div> 					
                    </div><br>
			 
            <div class="text-right">
<button type="button" onClick="BuscarPagosGenerales(document.getElementById('desde').value,document.getElementById('hasta').value,document.getElementById('codperiodo').value)" class="btn btn-primary"><span class="fa fa-search"></span> Realizar Búsqueda</button>
		    </div>
              
			                    
                                   </div><!-- /.box-body -->
								</div>
                          </div>
                     </div>
                </div>
           </div>
       </div>
	   
	     <div id="muestrapagosgeneral"></div>
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