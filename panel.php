<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="docente") {

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
<script type="text/javascript" src="assets/plugins/Chart.js/Chart.min.js"></script>
<script type="text/javascript" src="assets/plugins/Chart.js/legend.js"></script>
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
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-tasks"></i> Panel Principal </h4>
<ol class="breadcrumb pull-right">
<li class="active">Panel Principal</li>
</ol>

<div class="clearfix"></div>
</div>
</div>
</div>

<?php if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria") { ?>

<div class="row">
<div class="col-sm-3 col-lg-3">
<div class="panel panel-primary text-center">
<div class="panel-heading"><h4 class="panel-title"><i class="fa fa-tasks"></i> Estudiantes Inscritos</h4></div>
<div class="panel-body">
<h3 class=""><b><span class="ion ion-android-contact "></span> <?php echo "#".$con[0]['est'] ?></b></h3>
</div>
</div>
</div>

<div class="col-sm-3 col-lg-3">
<div class="panel panel-primary text-center">
<div class="panel-heading"><h4 class="panel-title"><i class="fa fa-tasks"></i> Total Docentes</h4></div>
<div class="panel-body">
<h3 class=""><b><span class="ion ion-university "></span> <?php echo "#".$con[0]['doc'] ?></b></h3>
</div>
</div>
</div>

<div class="col-sm-3 col-lg-3">
<div class="panel panel-primary text-center">
<div class="panel-heading"><h4 class="panel-title"><i class="fa fa-tasks"></i> Total Usuarios</h4></div>
<div class="panel-body">
<h3 class=""><b><span class="fa fa-user"></span> <?php echo "#".$con[0]['user'] ?></b></h3>
</div>
</div>
</div>

<div class="col-sm-3 col-lg-3">
<div class="panel panel-primary text-center">
<div class="panel-heading"><h4 class="panel-title"><i class="fa fa-tasks"></i> Cuotas Vencidas</h4></div>
<div class="panel-body">
<h3 class=""><b><span class="ion ion-ios7-timer"></span> <?php echo "#".$con[0]['totalvenc'] ?></b></h3>
</div>
</div>
</div>

</div>

<?php } else { ?>

<div class="row">
<div class="col-sm-4 col-lg-4">
<div class="panel panel-primary text-center">
<div class="panel-heading"><h4 class="panel-title"><i class="fa fa-tasks"></i> Estudiantes Inscritos</h4></div>
<div class="panel-body">
<h3 class=""><b><span class="ion ion-android-contact"></span> <?php echo "#".$con[0]['est'] ?></b></h3>
</div>
</div>
</div>

<div class="col-sm-4 col-lg-4">
<div class="panel panel-primary text-center">
<div class="panel-heading"><h4 class="panel-title"><i class="fa fa-tasks"></i> Total Tutores</h4></div>
<div class="panel-body">
<h3 class=""><b><span class="fa fa-user"></span> <?php echo "#".$con[0]['tutor'] ?></b></h3>
</div>
</div>
</div>

<div class="col-sm-4 col-lg-4">
<div class="panel panel-primary text-center">
<div class="panel-heading"><h4 class="panel-title"><i class="fa fa-tasks"></i> Total Docentes</h4></div>
<div class="panel-body">
<h3 class=""><b><span class="ion ion-university"></span> <?php echo "#".$con[0]['doc'] ?></b></h3>
</div>
</div>
</div>

</div>

<?php } ?>


                        <div class="row">
                            <div class="col-lg-7">
                                <div class="panel panel-border panel-primary">
                                    <div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-pie-chart"></i> Gráfico de Pagos de Cuotas</h3>
                                    </div>
                                    <div class="panel-body">
									<div align="center" id="canvas-holder" class="widget-content">
									<canvas id="pieChart" width="250" height="100"></canvas>
									<h5><div id="pieLegend"></div></h5>
									</div>
<script>
var data = [
                {
				  value: <?php echo $con[0]['totalpag'] ?>,
					color: "#5ae85a",
					highlight: "#42a642",
					label: "Cuotas Pagadas"
				},
				{
          value: <?php echo $con[0]['totalpend'] ?>,
          color:"#0b82e7",
          highlight: "#0c62ab",
          label: "Cuotas Pendientes"
				},
				{
          value: <?php echo $con[0]['totalvenc'] ?>,
          color: "red",
          highlight: "#FF0043",
          label: "Cuotas Vencidas"
				}
				
			];

var ctx = document.getElementById("pieChart").getContext("2d");
var pieChart = new Chart(ctx).Pie(data, {responsive:true});
legend(document.getElementById("pieLegend"), data, pieChart, "<%=label%>: <%=value%>");
</script>                              
                                       </div>
                                 </div>
                            </div>


                          <div class="col-lg-5">
                              <div class="panel panel-border panel-primary">
                                    <div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Gráfico de Estudiantes por Sexo</h3>
                                    </div>
                                    <div class="panel-body">
                  <div align="center" id="canvas-holder" class="widget-content">
                  <canvas id="barChart" width="250" height="160"></canvas>
                  <h5><div id="barLegend"></div></h5> 
                  </div>
      <script>  
var data = {
    labels : ["Estudiantes por Sexo"],
    datasets : [
      {
        fillColor : "#6b9dfa",
        strokeColor : "#6b9dfa",
        highlightFill: "#1864f2",
        highlightStroke: "#6b9dfa",
        data : [<?php echo $con[0]['masculino'] ?>],
                label : 'Masculino'
      },
            {
                fillColor : "rgba(255, 87, 51, 0.5)",
                strokeColor : "rgba(255, 87, 51, 0.75)",
                highlightFill : "rgba(255, 87, 51, 1)",
                highlightStroke : "#fff",
                data : [<?php echo $con[0]['femenino'] ?>],
                label : 'Femenino'
            }
    ]

  } 

var ctx = document.getElementById("barChart").getContext("2d");
var barChart = new Chart(ctx).Bar(data, {
   responsive : true,
   animation: true,
   barValueSpacing : 5,
   barDatasetSpacing : 1,
   tooltipFillColor: "rgba(0,0,0,0.8)",                
   multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
});
legend(document.getElementById("barLegend"), data, barChart, "<%=label%> ");
//legend(document.getElementById("barLegend"), data, "<%=label%>: <%=value%>g");
</script>
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
        
        <!-- jQuery  -->
        <script src="assets/plugins/sweetalert/dist/sweetalert.min.js"></script>
        
        
        <!-- flot Chart -->
        <script src="assets/plugins/flot-chart/jquery.flot.js"></script>
        <script src="assets/plugins/flot-chart/jquery.flot.time.js"></script>
        <script src="assets/plugins/flot-chart/jquery.flot.tooltip.min.js"></script>
        <script src="assets/plugins/flot-chart/jquery.flot.resize.js"></script>
        <script src="assets/plugins/flot-chart/jquery.flot.pie.js"></script>
        <script src="assets/plugins/flot-chart/jquery.flot.selection.js"></script>
        <script src="assets/plugins/flot-chart/jquery.flot.stack.js"></script>
        <script src="assets/plugins/flot-chart/jquery.flot.crosshair.js"></script>
		
		
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
        <script src="assets/pages/jquery.chat.js"></script>
        
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
          <script type="text/jscript">
            $(window).load(function() {
              $.get('funciones.php', {'verifica_meses': true})
            });
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