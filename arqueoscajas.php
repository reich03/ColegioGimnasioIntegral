<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria") {
        
$con = new Login();
$con = $con->ContarRegistros();

$tra = new Login();
$ses = $tra->ExpiraSession();
$reg = $tra->ListarArqueoCaja();

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


<div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                                            <div class="modal-dialog">
                                                <div class="modal-content p-0 b-0">
                                                    <div class="panel panel-color panel-primary">
                                                        <div class="panel-heading"> 
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="assets/images/close.png"/></button> 
        <h3 class="panel-title"><i class="fa fa-align-justify"></i> Datos de Arqueo de Caja</h3> 
                                                        </div> 
                                                        <div class="panel-body"> 
                                                         <div id="muestraarqueomodal"></div>
                                                        </div>
                                                     <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-times-circle"></span> Aceptar</button>
                  </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->

   

  
   <!----- INICIO DE MENU ----->
   <?php include('menu.php'); ?>
   <!----- FIN DE MENU ----->


<div class="content-page">
<div class="content">
<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-tasks"></i> Control de Arqueos</h4>
<ol class="breadcrumb pull-right"><li><a href="panel">Inicio</a></li>
<li class="active">Control de Arqueos</li>
</ol>

<div class="clearfix"></div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-tasks"></i> Control de Arqueos<span class="pull-right">

<div class="btn-group dropdown">
<button type="button" class="btn btn-default waves-effect waves-light"><span class="fa fa-cog"></span> Procesos</button>
        <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="caret"></i></button>
            <ul class="dropdown-menu" role="menu">
<li><a href="forarqueo" data-toggle="tooltip" data-placement="left" title="" data-original-title="Nuevo Arqueo"><i class="fa fa-plus"></i> Nuevo</a></li>
<li><a href="reportepdf?tipo=<?php echo base64_encode("ARQUEOSGENERAL") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="left" title="" data-original-title="Listado (Pdf)"><i class="fa fa-file-pdf-o"></i> Listado (Pdf)</a></li>
<li><a href="reporteexcel?tipo=<?php echo base64_encode("ARQUEOSGENERAL") ?>" data-toggle="tooltip" data-placement="left" title="" data-original-title="Listado (Excel)"><i class="fa fa-file-excel-o"></i> Listado (Excel)</a></li>
            </ul>
</div>
</span></h3>
</div>

<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">
<?php
    if(isset($_GET["mesage"]))
{
  switch($_GET["mesage"])
  {
    case 1:
    echo "<div class='alert alert-info'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-check-square-o'></span> EL ARQUEO DE CAJA FUE ELIMINADO EXITOSAMENTE </center>";
        echo "</div>";  
    break;
    
    case 2:
    echo "<div class='alert alert-warning'>";
    echo "<center><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<span class='fa fa-info-circle'></span> USTED NO TIENE ACCESO PARA ELIMINAR ARQUEOS DE CAJAS, NO ERES EL ADMINISTRADOR DEL SISTEMA</center>"; 
        echo "</div>";  
    break;
    
  }
}   
     ?> 
<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;" width="100%" cellspacing="0">
                                                 <thead>
                         <tr role="row">
                          <th>N°</th>
                          <th>Caja</th>
                          <th>Hora de Apertura</th>
                          <th>Hora de Cierre</th>
                          <th>Estimado</th>
                          <th>Efectivo</th>
                          <th>Diferencia</th>
                         <th>Acciones</th>
                         </tr>
                         </thead>
                         <tbody>
<?php 

if($reg==""){

    echo "";      
    
} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                         <td class="sorting_1" tabindex="0"><?php echo $a++; ?></td>
                                               <td><?php echo $reg[$i]['nombrecaja']; ?></td>
                                               <td><?php echo $reg[$i]['fechaapertura']; ?></td>
                                               <td><?php echo $reg[$i]['fechacierre']; ?></td>
<td><?php echo number_format($reg[$i]['montoinicial']+$reg[$i]['ingresos']-$reg[$i]['egresos'], 2, '.', ','); ?></td>
                                               <td><?php echo $reg[$i]['dineroefectivo']; ?></td>
                                               <td><?php echo $reg[$i]['diferencia']; ?></td>
                         <td>
 
<a href="#" class="btn btn-success btn-xs" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target="#panel-modal" data-backdrop="static" data-keyboard="false" onClick="VerArqueo('<?php echo base64_encode($reg[$i]["codarqueo"]); ?>')"><i class="fa fa-search-plus"></i></a>

<?php if($reg[$i]["statusarqueo"]=='1'){ ?><a href="#" class="btn btn-warning btn-xs" title="Cerrar Caja" onClick="cerrarcaja('forcierrearqueo?codarqueo=<?php echo base64_encode($reg[$i]["codarqueo"]) ?>')"><i class="fa fa-archive"></i></a><?php } ?>
 </td>
                         </tr>
                         <?php } } ?>
                         </tbody>
</table>
                                                 </div>
                                             </div>
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
        <script src="assets/js/jquery.min.js"></script>
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
		
		<!-- Datatables-->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
        <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables/buttons.bootstrap.min.js"></script>
        <script src="assets/plugins/datatables/jszip.min.js"></script>
        <script src="assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.scroller.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/pages/datatables.init.js"></script>

        <!-- jQuery  -->
        <script src="assets/pages/jquery.todo.js"></script>
        
        <!-- jQuery  -->
        <script src="assets/pages/jquery.dashboard.js"></script>
        
        <script type="text/javascript">
            /* ==============================================
            Counter Up
            =============================================== */
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });
            });
        </script>
		

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
            } );
            TableManageButtons.init();
        </script>
  
  

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