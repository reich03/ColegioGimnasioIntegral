<?php
require_once("class/class.php");
?>
<script type="text/javascript" src="assets/script/ajax.js"></script>
<script src="assets/script/jscalendario.js"></script>
<script src="assets/script/autocompleto.js"></script> 
<!-- Calendario -->

<?php
$con = new Login();
$con = $con->ConfiguracionPorId(); 

$per = new Login();
$per = $per->PeriodoEscolarActivo();

$new = new Login();
?>


<?php 
############################# MUESTRA NUMERO DE CAJA ######################################
if (isset($_GET['muestracodigocaja'])) {
  
$tra = new Login();
  ?>
<input type="text" class="form-control" name="nrocaja" id="nrocaja" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="N° de Caja" <?php if (isset($reg[0]['nrocaja'])) { ?> value="<?php echo $reg[0]['nrocaja']; ?>" <?php } else { ?>  value="<?php echo $reg = $tra->CodigoCaja(); ?>" <?php } ?> readonly="readonly">
<?php 
  }
############################# MUESTRA NUMERO DE CAJA ######################################
?>

<?php 
######################## BUSCA GRADOS #################################
if (isset($_GET['BuscaGrados']) && isset($_GET['codnivel'])) {
  
   $grad = $new->ListarGradosNiveles();
  ?>
    </div>
  </div>
 <select name="codgrado" id="codgrado" class="form-control"  required="required">
       <option value="">SELECCIONE</option>
  <?php for($i=0;$i<sizeof($grad);$i++){ ?>
<option value="<?php echo $grad[$i]['codgrado']; ?>" ><?php echo $grad[$i]['grado']; ?></option>
  <?php } ?>
</select> 
<?php
}
######################## BUSCA GRADOS #################################
?>


<?php 
############################# BUSCA SECCIONES #################################
if (isset($_GET['BuscaSeccion']) && isset($_GET['codgrado'])) {
	
	 $sec = $new->ListarSeccionesGrados();
	?>
    </div>
  </div>
 <select name="codseccion" id="codseccion" class="form-control" required="required">
       <option value="">SELECCIONE</option>
	<?php for($i=0;$i<sizeof($sec);$i++){ ?>
<option value="<?php echo $sec[$i]['codseccion']; ?>" ><?php echo $sec[$i]['seccion']; ?></option>
	<?php } ?>
</select>	
<?php
}
############################# BUSCA SECCIONES #################################
?>


<?php 
############################# BUSCA MATERIAS #################################
if (isset($_GET['BuscaMaterias']) && isset($_GET['codgrado'])) {
  
   $mat = $new->ListarMateriasGrados();
  ?>
    </div>
  </div>
 <select name="codmateria" id="codmateria" class="form-control" required="required">
       <option value="">SELECCIONE</option>
  <?php for($i=0;$i<sizeof($mat);$i++){ ?>
<option value="<?php echo $mat[$i]['codmateria']; ?>" ><?php echo $mat[$i]['nommateria']; ?></option>
  <?php } ?>
</select> 
<?php
}
############################# BUSCA MATERIAS #################################
?>



<?php
############################# MOSTRAR USUARIO EN VENTANA MODAL ############################
if (isset($_GET['BuscaUsuarioModal']) && isset($_GET['codigo'])) { 
$reg = $new->UsuariosPorId();
?>
  
  <div class="row">
  <table border="0" align="center">
 
    <td rowspan="9">
  <?php if (isset($reg[0]['cedula'])) {
  if (file_exists("fotos/".$reg[0]['cedula'].".jpg")){
    echo "<img src='fotos/".$reg[0]['cedula'].".jpg?".date('h:i:s')."' class='img-rounded' border='0' width='100' height='110' title='Foto del Usuario' data-rel='tooltip'>"; 
}else{
    echo "<img src='fotos/avatar.jpg' class='img-rounded' border='1' width='90' height='100' title='Sin Foto' data-rel='tooltip'>"; 
} } else {
  echo "<img src='fotos/avatar.jpg' class='img-rounded' border='1' width='90' height='100' title='Sin Foto' data-rel='tooltip'>"; 
}
?></td>
  <tr>
    <td><strong>Nº de DNI:</strong> <?php echo $reg[0]['cedula']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres:</strong> <?php echo $reg[0]['nombres']; ?></td>
  </tr>
  <tr>
    <td><strong>Sexo:</strong> <?php echo $reg[0]['sexo']; ?></td>
  </tr>
  <tr>
    <td><strong>Cargo: </strong> <?php echo $reg[0]['cargo']; ?></td>
  </tr>
  <tr>
    <td><strong>Correo Electrónico: </strong> <?php echo $reg[0]['email']; ?></td>
  </tr>
  <tr>
    <td><strong>Usuario: </strong> <?php echo $reg[0]['usuario']; ?></td>
  </tr>
  <tr>
    <td><strong>Nivel: </strong> <?php echo $reg[0]['nivel']; ?></td>
  </tr>
  <tr>
    <td><strong>Status: </strong> <?php echo $status = ( $reg[0]['status'] == 'ACTIVO' ? "<span class='label label-success'><i class='fa fa-check'></i> ".$reg[0]['status']."</span>" : "<span class='label label-warning'><i class='fa fa-times'></i> ".$reg[0]['status']."</span>"); ?></td>
  </tr>
</table>
</div>
  
  <?php
   } 
############################# MOSTRAR USUARIO EN VENTANA MODAL ############################$_SESSION['acceso'] == 'docente' ? $_SESSION['coddoc'] : $GET['coddoc']
?>











<?php
############################# MOSTRAR PERIODO EN VENTANA MODAL ############################
if (isset($_GET['BuscaPeriodoModal']) && isset($_GET['codperiodo'])) { 

$reg = $new->VerPeriodoEscolar();

  ?>
  <div class="row">
  <table border="0" align="center">
  <tr>
    <td><strong>Código:</strong> <?php echo $reg[0]['codperiodo']; ?></td>
  </tr>
  <tr>
    <td><strong>Periodo Escolar:</strong> <?php echo $reg[0]['periodo']; ?></td>
  </tr>
  <tr>
    <td><strong>Descripción de Periodo:</strong> <?php echo $reg[0]['descripcion']; ?></td>
  </tr>
  <tr>
    <td><strong>Fecha Creado:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fechacreado'])); ?></td>
  </tr>
  <tr>
    <td><strong>Meses para Pagos:</strong> <?php echo convertir($reg[0]['mesesactivos']); ?></td>
  </tr>
  <tr>
    <td><strong>Interés de Mora:</strong> <?php echo $reg[0]['interesmora']; ?></td>
  </tr>
  <tr>
    <td><strong>Cuota Unica:</strong> <?php echo $reg[0]['cuotaunica']; ?></td>
  </tr>
  <tr>
    <td><strong>Día que Vence Cuota:</strong> <?php echo $reg[0]['diasvence']; ?></td>
  </tr>
  <tr>
    <td><strong>Status de Periodo:</strong> <?php echo $status = ( $reg[0]['statusperiodo'] == '1' ? "<span class='label label-success'><i class='fa fa-check'></i> ACTIVO</span>" : "<span class='label label-warning'><i class='fa fa-times'></i> INACTIVO</span>"); ?></td>
  </tr>
</table>
</div>
  
  <?php
   } 
############################# MOSTRAR PERIODO EN VENTANA MODAL ############################
?>

<?php
############################# FUNCION PARA CREAR PERIODO ESCOLAR #############################
if (isset($_GET['CrearPeriodoEscolar']) && isset($_GET['mesesactivos']) && isset($_GET['periodo']) && isset($_GET['descripcion']) && isset($_GET['cuotaunica']) && isset($_GET['interesmora']) && isset($_GET['diasvence'])) {

$periodo = $_GET['periodo'];
$descripcion =$_GET['descripcion'];
$cuotaunica =$_GET['cuotaunica'];
$interesmora =$_GET['interesmora'];
$diasvence =$_GET['diasvence'];
$mesesactivos =$_GET['mesesactivos'];

if($periodo==""){

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE UN NUEVO PERIODO ESCOLAR </center>";
  echo "</div>";    
  exit;
      
  } elseif($descripcion==""){

    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE LA DESCRIPCIÓN DEL NUEVO PERIODO ESCOLAR </center>";
    echo "</div>";    
    exit;
      
  } elseif($cuotaunica==""){

    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE EL MONTO DE CUOTA UNICA PARA PAGOS </center>";
    echo "</div>";    
    exit;
      
  } elseif($interesmora==""){

    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE EL MONTO DE INTÉRES DE MORA PARA PAGOS </center>";
    echo "</div>";    
    exit;
      
  } elseif($diasvence==""){

    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE DIA PARA VENCIMIENTO DE CUOTAS POR MES </center>";
    echo "</div>";    
    exit;
  
  }  else {   
  ?>
  
<div class="row">
<div class="col-sm-12">
<div class="panel panel-primary"> 
     
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12">

<div class='alert alert-danger'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
<center><span class='fa fa-info'></span> Al crear un nuevo periodo escolar todo el sistema se verá afectado por dicha creación, debe de estar seguro que haya culminado</br> el periodo escolar pasado y de realizar un Respaldo de Información correspondiente </center>
</div>  

                                                  
            <div class="box-body">
              <div class="row">
        
                <div class="col-md-12">
          <div class="form-group has-feedback">
                 <label>Ingrese Password de Administrador: <span class="symbol required"></span></label>
 <input name="password" class="form-control" type="password" id="password" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese su Password de Administrador" autocomplete="off" required="required"/><small class="text-danger">Ingrese su Password de Acceso como Administrador del Sistema</small>
                        <i class="fa fa-unlock-alt form-control-feedback"></i>  
                  </div><!-- /.form-group -->
                </div><!-- /.col -->

              </div><!-- /.row -->
            </div><br>
            <div class="text-right">
       <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><span class="fa fa-refresh"></span> Verificar Password</button>
        </div>
      </div>
        </div>
      </div>
    </div>
  </div>
</div>  
  <?php
         }
   } 
############################# FUNCION PARA CREAR PERIODO ESCOLAR #############################
?>













<?php
############################# CARGAR ARQUEO DE CAJA EN VENTANA MODAL ############################
if (isset($_GET['BuscaArqueoCajaModal']) && isset($_GET['codarqueo'])) { 

$reg = $new->ArqueoCajaPorId();

  ?>
  <div class="row">
  <table border="0" align="center" >
    <tr>
    <td><strong>Nº de Caja:</strong> <?php echo $reg[0]['nrocaja']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Caja:</strong> <?php echo $reg[0]['nombrecaja']; ?></td>
  </tr>
  <tr>
    <td><strong>Monto Inicial:</strong> <?php echo number_format($reg[0]['montoinicial'], 2, '.', ','); ?></td>
  </tr>
  <tr>
    <td><strong>Ingresos:</strong> <?php echo number_format($reg[0]['ingresos'], 2, '.', ','); ?></td>
  </tr>
  <tr>
    <td><strong>Egresos:</strong> <?php echo number_format($reg[0]['egresos'], 2, '.', ','); ?></td>
  </tr>
  <tr>
    <td><strong>Dinero en Efectivo:</strong> <?php echo number_format($reg[0]['dineroefectivo'], 2, '.', ','); ?></td>
  </tr>
  <tr>
    <td><strong>Diferencia:</strong> <?php echo number_format($reg[0]['diferencia'], 2, '.', ','); ?></td>
  </tr>
  <tr>
    <td><strong>Comentario:</strong> <?php if($reg[0]['comentarios']=="") { echo "SIN COMENTARIOS"; } else { echo $reg[0]['comentarios']; } ?></td>
  </tr>
  <tr>
    <td><strong>Hora Apertura:</strong> <?php echo date("d-m-Y h:i:s",strtotime($reg[0]['fechaapertura'])); ?></td>
  </tr>
  <tr>
    <td><strong>Hora Cierre:</strong> <?php echo $cierre = ( $reg[0]['statusarqueo'] == '1' ? $reg[0]['fechacierre'] : date("d-m-Y h:i:s",strtotime($reg[0]['fechacierre']))); ?></td>
  </tr>
  <tr>
    <td><strong>Responsable:</strong> <?php echo $reg[0]['nombres']; ?></td>
  </tr>
  <tr>
    <td><strong>Periodo Escolar:</strong> <?php echo $reg[0]['periodo']; ?></td>
  </tr>
</table>
</div>
  
  <?php
   } 
############################# CARGAR ARQUEO DE CAJA EN VENTANA MODAL ############################
?>

<?php
############################# BUSQUEDA DE ARQUEOS POR FECHAS PARA REPORTES #######################
if (isset($_GET['BuscaArqueosxFechas']) && isset($_GET['desde']) && isset($_GET['hasta']) && isset($_GET['codperiodo'])) { 
  
   $desde = $_GET['desde'];
   $hasta = $_GET['hasta'];
   $codperiodo = $_GET['codperiodo'];
   

 if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU BÚSQUEDA</center>";
  echo "</div>";    
  exit;
    

} else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA FINAL PARA TU BÚSQUEDA</center>";
  echo "</div>";    
  exit;

 } elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> LA FECHA DE INICIO NO PUEDE SER MAYOR QUE LA FECHA DE FIN</center>";
  echo "</div>";    
  exit;
   
   } elseif($codperiodo=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE PERIODO ESCOLAR PARA TU BÚSQUEDA</center>";
  echo "</div>";    
  exit;
   
    } else {

$mov = new Login();
$reg = $mov->BuscarArqueosxFechas();

  ?>

   <div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-tasks"></i> Arqueos de Cajas por Fecha Desde <?php echo $_GET["desde"]." Hasta ".$_GET["hasta"]; ?> del Periodo <?php echo $reg[0]['periodo']; ?></h3>
</div>

<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">

<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
        <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                            <thead>
                                                <tr>
                          <th>Nº</th>
                          <th>Caja</th>
                          <th>Hora de Apertura</th>
                          <th>Hora de Cierre</th>
                          <th>Estimado</th>
                          <th>Efectivo</th>
                          <th>Diferencia</th>
                         </tr>
                         </thead>
                         <tbody>
<?php 
$arqueo = new Login();
$reg = $arqueo->BuscarArqueosxFechas();
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                         <td class="sorting_1" tabindex="0"><?php echo $a++; ?></td>
              <td><?php echo $reg[$i]['nombrecaja']; ?></td>
              <td><?php echo $reg[$i]['fechaapertura']; ?></td>
              <td><?php echo $reg[$i]['fechacierre']; ?></td>
<td><?php echo number_format($reg[$i]['montoinicial']+$reg[$i]['ingresos']-$reg[$i]['egresos'], 2, '.', ','); ?></td>
<td><?php echo number_format($reg[$i]['dineroefectivo'], 2, '.', ','); ?></td>
              <td><?php echo number_format($reg[$i]['diferencia'], 2, '.', ','); ?></td>
                          
                                                </tr>
                        <?php  }  ?>
                                            </tbody>
                                        </table>
<div align="center"><a href="reportepdf?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&codperiodo=<?php echo $codperiodo; ?>&tipo=<?php echo base64_encode("ARQUEOSXFECHAS") ?>" target="_blank" rel="noopener noreferrer"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>
                          
<a href="reporteexcel?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&codperiodo=<?php echo $codperiodo; ?>&tipo=<?php echo base64_encode("ARQUEOSXFECHAS") ?>"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-excel-o"></span> Exportar Excel</button> </a>                    
                            </div><br />
                              </div>                                     
                          </div>
                       </div>
                    </div>
                 </div>
             </div>
          </div>
       </div>
    </div>
  <?php
     }
 } 
############################# BUSQUEDA DE ARQUEOS POR FECHAS PARA REPORTES #######################
?>


<?php 
############################# MUESTRA MOVIMIENTO DB #############################################
if (isset($_GET['muestramovimientodb']) && isset($_GET['codmovimientocaja'])) {
  
$tra = new Login();
$reg = $tra->MovimientoCajasPorId();

  ?>
<input type="hidden" name="montomovimientocajadb" id="montomovimientocajadb" <?php if (isset($reg[0]['montomovimientocaja'])) { ?> value="<?php echo $reg[0]['montomovimientocaja']; ?>"<?php } ?>>
<?php 
  }
############################# MUESTRA MOVIMIENTO DB #############################################
?>

<?php
############################# CARGAR MOVIMIENTO EN VENTANA MODAL ############################
if (isset($_GET['BuscaMovimientoCajaModal']) && isset($_GET['codmovimientocaja'])) { 

$reg = $new->MovimientoCajasPorId();

  ?>
  
  <div class="row">
  <table border="0" align="center" >
  <tr>
    <td><strong>Tipo de Movimiento:</strong> <?php echo $reg[0]['tipomovimientocaja']; ?></td>
  </tr>
    <tr>
    <td><strong>Nº de Recibo:</strong> <?php echo $reg[0]['nrorecibo']; ?></td>
  </tr>
  <tr>
    <td><strong>Monto de Movimiento:</strong> <?php echo number_format($reg[0]['montomovimientocaja'], 2, '.', ','); ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Caja:</strong> <?php echo $reg[0]['nombrecaja']; ?></td>
  </tr>
  <tr>
    <td><strong>Descripción de Movimiento:</strong> <?php echo $reg[0]['descripcionmovimientocaja']; ?></td>
  </tr>
  <tr>
    <td><strong>Fecha de Movimiento:</strong> <?php echo date("d-m-Y h:i:s",strtotime($reg[0]['fechamovimientocaja'])); ?></td>
  </tr>
  <tr>
    <td><strong>Persona que Registro:</strong> <?php echo $reg[0]['nombres']; ?></td>
  </tr>
  <tr>
    <td><strong>Periodo Escolar:</strong> <?php echo $reg[0]['periodo']; ?></td>
  </tr>
</table>
</div>
  
  <?php
   } 
############################# CARGAR MOVIMIENTO EN VENTANA MODAL ############################
?>


<?php
############################# BUSQUEDA DE MOVIMIENTOS POR FECHAS PARA REPORTES #######################
if (isset($_GET['BuscaMovimientosxFechas']) && isset($_GET['codcaja']) && isset($_GET['desde']) && isset($_GET['hasta']) && isset($_GET['codperiodo'])) { 
  
   $codcaja = $_GET['codcaja'];
   $desde = $_GET['desde'];
   $hasta = $_GET['hasta'];
   $codperiodo = $_GET['codperiodo'];
   

 if($codcaja=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE CAJA PARA TU BÚSQUEDA</center>";
  echo "</div>";    
  exit;
    

} else if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU BÚSQUEDA</center>";
  echo "</div>";    
  exit;
    

} else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA FINAL PARA TU BÚSQUEDA</center>";
  echo "</div>";    
  exit;

 } elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> LA FECHA DE INICIO NO PUEDE SER MAYOR QUE LA FECHA DE FIN</center>";
  echo "</div>";    
  exit;
   
   } elseif($codperiodo=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE PERIODO ESCOLAR PARA TU BÚSQUEDA</center>";
  echo "</div>";    
  exit;
   
    } else {

$mov = new Login();
$reg = $mov->BuscarMovimientosxFechas();

  ?>

   <div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-tasks"></i> Consulta de Movimientos de Caja <?php echo $reg[0]['nrocaja'].": ".$reg[0]['nombrecaja']; ?> - Fecha Desde <?php echo $_GET["desde"]." Hasta ".$_GET["hasta"]; ?> del Periodo <?php echo $reg[0]['periodo']; ?></h3>
</div>

<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">

<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
        <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                            <thead>
                                                <tr>
                          <th>Nº</th>
                          <th>Nº Fact/Rec</th>
                          <th>Responsable</th>
                          <th>Fecha Movimiento</th>
                          <th>Tipo Movimiento</th>
                          <th>Descripción</th>
                          <th>Monto</th>
                         </tr>
                         </thead>
                         <tbody>
<?php 
$a=1;
$TotalIngresos=0;
$TotalEgresos=0;
for($i=0;$i<sizeof($reg);$i++){ 
$TotalIngresos+=$ingresos = ( $reg[$i]['tipomovimientocaja'] == 'INGRESO' ? $reg[$i]['montomovimientocaja'] : "0");
$TotalEgresos+=$egresos = ( $reg[$i]['tipomovimientocaja'] == 'EGRESO' ? $reg[$i]['montomovimientocaja'] : "0"); 
?>
                                               <tr role="row" class="odd">
                         <td class="sorting_1" tabindex="0"><?php echo $a++; ?></td>
                          <td><?php echo $reg[$i]['nrorecibo']; ?></td>
                          <td><?php echo $reg[$i]['nombres']; ?></td>
                         <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechamovimientocaja'])); ?></td>
<td><?php echo $status = ( $reg[$i]['tipomovimientocaja'] == 'INGRESO' ? "<span class='label label-info'><i class='fa fa-check'></i> ".$reg[$i]['tipomovimientocaja']."</span>" : "<span class='label label-danger'><i class='fa fa-times'></i> ".$reg[$i]['tipomovimientocaja']."</span>"); ?></td>
                         <td><?php echo $reg[$i]['descripcionmovimientocaja']; ?></td>
          <td><?php echo number_format($reg[$i]['montomovimientocaja'], 2, '.', ','); ?></td>
                          
                                                </tr>
                        <?php  }  ?>
                                            </tbody>
                                        </table>
<h4 class="text-left"><b>Total Ingresos:</b> <span class='label label-success'> <?php echo number_format($TotalIngresos, 2, '.', ','); ?> </span></h4>
<h4 class="text-left"><b>Total Egresos:</b> <span class='label label-success'> <?php echo number_format($TotalEgresos, 2, '.', ','); ?> </span></h4>
<h4 class="text-left"><b>Total General:</b> <span class='label label-success'> <?php echo number_format($TotalIngresos-$TotalEgresos, 2, '.', ','); ?> </span></h4>
           <div align="center">
<a href="reportepdf?codcaja=<?php echo $codcaja; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&codperiodo=<?php echo $codperiodo; ?>&tipo=<?php echo base64_encode("MOVIMIENTOSXFECHAS") ?>" target="_blank" rel="noopener noreferrer"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>
                          
<a href="reporteexcel?codcaja=<?php echo $codcaja; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&codperiodo=<?php echo $codperiodo; ?>&tipo=<?php echo base64_encode("MOVIMIENTOSXFECHAS") ?>"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-excel-o"></span> Exportar Excel</button> </a>                                   </div><br />        
                               </div>
                           </div>
                      </div>
                   </div>
               </div>
           </div>
        </div>
     </div>
 </div>
  <?php
     }
 } 
############################# BUSQUEDA DE MOVIMIENTOS POR FECHAS PARA REPORTES #######################
?>










<?php
############################# MOSTRAR MATERIAS EN VENTANA MODAL ############################
if (isset($_GET['BuscaMateriaModal']) && isset($_GET['codmateria'])) { 

$reg = $new->MateriasPorId();

  ?> 
  <div class="row">
  <table border="0" align="center">
  <tr>
    <td><strong>Código Materia:</strong> <?php echo $reg[0]['codmateria']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Área:</strong> <?php echo $reg[0]['nomarea']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Materia:</strong> <?php echo $reg[0]['nommateria']; ?></td>
  </tr>
  <tr>
    <td><strong>Nivel:</strong> <?php echo $reg[0]['nivel']; ?></td>
  </tr>
  <tr>
    <td><strong>Grado:</strong> <?php echo $reg[0]['grado']; ?></td>
  </tr>
</table>
</div>
  <?php
   } 
############################# MOSTRAR MATERIAS EN VENTANA MODAL ############################
?>

<?php
######################### BUSQUEDA MATERIAS POR NIVEL PARA REPORTES ########################
if (isset($_GET['BuscaMateriasReportes']) && isset($_GET['codnivel']) && isset($_GET['codgrado'])) { 
  
   $codnivel = $_GET['codnivel'];
   $codgrado = $_GET['codgrado'];
   

 if($codnivel=="") {

     echo "<div class='alert alert-danger'>";
     echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE NIVEL PARA TU BÚSQUEDA</center>";
     echo "</div>";   
   exit;
   
   } elseif($codgrado=="") {

     echo "<div class='alert alert-danger'>";
     echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE GRADO PARA TU BÚSQUEDA</center>";
     echo "</div>";   
   exit;

} else {

$mat = new Login();
$mat = $mat->BuscarMateriasReportes();
  ?>

   <div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-tasks"></i> Consulta de Materias del Nivel <?php echo $mat[0]['nivel']; ?> - Grado <?php echo $mat[0]['grado']; ?></h3>
</div>

<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">

<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
                         <tr role="row">
                          <th>Nº</th>
                          <th>Código</th>
                          <th>Nombre de Area</th>
                          <th>Nombre de Materia</th>
                         </tr>
                         </thead>
                         <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($mat);$i++){  
?>
                                               <tr role="row" class="odd">
                         <td class="sorting_1" tabindex="0"><?php echo $a++; ?></td>
                         <td><?php echo $mat[$i]['codmateria']; ?></td>
                         <td><?php echo $mat[$i]['nomarea']; ?></td>
                         <td><?php echo $mat[$i]['nommateria']; ?></td>
                         </tr>
                         <?php  }  ?>
                         </tbody>
</table>
<div align="center"><a href="reportepdf?codnivel=<?php echo $codnivel; ?>&codgrado=<?php echo $codgrado; ?>&tipo=<?php echo base64_encode("MATERIASXCURSOS") ?>" target="_blank" rel="noopener noreferrer"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>
                          
<a href="reporteexcel?codnivel=<?php echo $codnivel; ?>&codgrado=<?php echo $codgrado; ?>&tipo=<?php echo base64_encode("MATERIASXCURSOS") ?>"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-excel-o"></span> Exportar Excel</button> </a>                     
                                   </div><br />        
                               </div>
                           </div>
                      </div>
                   </div>
               </div>
           </div>
        </div>
     </div>
 </div>
  <?php
  
   }
 } 
######################### BUSQUEDA MATERIAS POR NIVEL PARA REPORTES ########################
?>






















<?php
############################# MOSTRAR DOCENTE EN VENTANA MODAL ############################
if (isset($_GET['BuscaDocenteModal']) && isset($_GET['coddoc'])) { 

$reg = $new->DocentesPorId();

  ?>
  
  <div class="row">
  <table border="0" align="center">
  <tr>
    <td><strong>Nº de DNI:</strong> <?php echo $reg[0]['ceddoc']."-".$reg[0]['expedido']; ?></td>
    <td>
  </tr>
  <tr>
    <td><strong>Nombres y Apellidos:</strong> <?php echo $reg[0]['nomdoc']; ?></td>
  </tr>
  <tr>
    <td><strong>Estado Civil:</strong> <?php echo $reg[0]['edocivildoc']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de Teléfono:</strong> <?php echo $reg[0]['tlfdoc']; ?></td>
  </tr>
  <tr>
    <td><strong>Dirección Domiciliaria:</strong> <?php echo $reg[0]['direcdoc']; ?></td>
  </tr>
  <tr>
    <td><strong>Lugar de Nacimiento:</strong> <?php echo $reg[0]['lugarnacdoc']; ?></td>
  </tr>
  <tr>
    <td><strong>Fecha de Nacimiento:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fecnacdoc'])); ?></td>
  </tr>
  <tr>
    <td><strong>Correo:</strong> <?php echo $reg[0]['correodoc']; ?></td>
  </tr>
  <tr>
    <td><strong>Especialidad:</strong> <?php echo $reg[0]['especdoc']; ?></td>
  </tr>
  <tr>
    <td><strong>Horas Asignadas:</strong> <?php echo $reg[0]['horasdoc']; ?></td>
  </tr>
  <tr>
    <td><strong>Código de Cargo:</strong> <?php echo $reg[0]['codcargodoc']; ?></td>
  </tr>
</table>
</div> 
  <?php
   } 
############################# MOSTRAR DOCENTE EN VENTANA MODAL ############################
?>




<?php
############################# MOSTRAR DOCENTE PARA ASIGNACION DE CURSOS ############################
if (isset($_GET['CrearAsignacion']) && isset($_GET['coddoc'])) {

$coddoc =$_GET['coddoc']; 

if($coddoc==""){

    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> POR FAVOR REALICE LA BÚSQUEDA DEL DOCENTE CORRECTAMENTE </center>";
    echo "</div>";    
    exit;
  
  }  else { 

  $reg = $new->VerificaPeriodoAsignaciones();

  ?>

  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Datos del Docente</h3></div>
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <div class="box-body">

                <div class="row">

                  <div class="col-md-4"> 
                    <div class="form-group has-feedback"> 
                      <label class="control-label">Nombre del Docente: <span class="symbol required"></span></label>
                      <input type="hidden" name="codperiodo" id="codperiodo" value="<?php echo $per[0]['codperiodo']; ?>"/>
                      <input type="text" class="form-control" name="nomdoc" id="nomdoc" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Nombre del Docente" autocomplete="off" value="<?php echo $reg[0]['ceddoc'].": ".$reg[0]['nomdoc']; ?>" disabled="disabled"/>
                      <i class="fa fa-pencil form-control-feedback"></i>    
                    </div> 
                  </div>

                  <div class="col-md-5"> 
                    <div class="form-group has-feedback"> 
                      <label class="control-label">Dirección del Docente: <span class="symbol required"></span></label>
                      <input type="text" class="form-control" name="direcdoc" id="direcdoc" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Dirección del Docente" autocomplete="off" value="<?php echo $reg[0]['direcdoc']; ?>" disabled="disabled"/>
                      <i class="fa fa-pencil form-control-feedback"></i>    
                    </div> 
                  </div>

                  <div class="col-md-3"> 
                   <div class="form-group has-feedback"> 
                    <label class="control-label">Seleccione Turno: <span class="symbol required"></span></label> 
                    <i class="fa fa-bars form-control-feedback"></i>
                    <select name="codturno" id="codturno" class="form-control" required="required">
                      <option value="">SELECCIONE</option>
                      <?php
                      $tur = new Login();
                      $tur = $tur->ListarTurno();
                      for($i=0;$i<sizeof($tur);$i++){
                        ?>
                        <option value="<?php echo $tur[$i]['codturno'] ?>"><?php echo $tur[$i]['turno'] ?></option>       
                      <?php } ?>
                    </select>  
                  </div> 
                </div>
              </div>


              <div class="row"> 
                <div class="col-md-3"> 
                 <div class="form-group has-feedback"> 
                  <label class="control-label">Seleccione Nivel: <span class="symbol required"></span></label>
                  <i class="fa fa-bars form-control-feedback"></i> 
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
                </div> 
              </div>
              <div class="col-md-3"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Seleccione Grado: <span class="symbol required"></span></label> 
                  <i class="fa fa-bars form-control-feedback"></i>
                  <select name="codgrado" id="codgrado" class="form-control" onChange="ActivaSeccion(document.getElementById('codgrado').value)" required="required">
                    <option value="">SIN RESULTADOS</option>
                  </select>        
                </div> 
              </div>

              <div class="col-md-3"> 
               <div class="form-group has-feedback"> 
                <label class="control-label">Seleccione Sección: <span class="symbol required"></span></label> 
                <i class="fa fa-bars form-control-feedback"></i>
                <select name="codseccion" id="codseccion" onChange="ActivaMaterias(document.getElementById('codgrado').value)" class="form-control">
                  <option value="">SIN RESULTADOS</option>
                </select>  
              </div> 
            </div> 

            <div class="col-md-3"> 
             <div class="form-group has-feedback"> 
              <label class="control-label">Seleccione Materia: <span class="symbol required"></span></label> 
              <i class="fa fa-bars form-control-feedback"></i>
              <select name="codmateria" id="codmateria" class="form-control" required="required">
                <option value="">SIN RESULTADOS</option>
              </select>  
            </div> 
          </div>
        </div><br>
        
        <div class="text-right">
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><span class="fa fa-save"></span> Guardar</button>
<button class="btn btn-danger" type="button" onClick="LimpiarAsignacion();"><i class="fa fa-trash-o"></i> Limpiar</button>
        </div>

      </div><!-- /.box-body -->
    </div>
  </div>
</div>
</div>
</div>
</div>


  <?php
      } 
   }
############################# MOSTRAR DOCENTE PARA ASIGNACION DE CURSOS ############################
?>

<?php
############################# MOSTRAR ASIGNACION DE CURSO A DOCENTE EN VENTANA MODAL ############################
if (isset($_GET['BuscaAsignacionModal']) && isset($_GET['codasignacion'])) { 

$reg = $new->AsignacionMateriasPorId();

  ?>
  
  <div class="row">
  <table border="0" align="center">
  <tr>
    <td><strong>Nº de DNI:</strong> <?php echo $reg[0]['ceddoc']."-".$reg[0]['expedido']; ?></td>
    <td>
  </tr>
  <tr>
    <td><strong>Nombres de Docente:</strong> <?php echo $reg[0]['nomdoc']; ?></td>
  </tr>
  <tr>
    <td><strong>Turno:</strong> <?php echo $reg[0]['turno']; ?></td>
  </tr>
  <tr>
    <td><strong>Nivel:</strong> <?php echo $reg[0]['nivel']; ?></td>
  </tr>
  <tr>
    <td><strong>Grado:</strong> <?php echo $reg[0]['grado']; ?></td>
  </tr>
  <tr>
    <td><strong>Sección:</strong> <?php echo $reg[0]['seccion']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Materia:</strong> <?php echo $reg[0]['nommateria']; ?></td>
  </tr>
  <tr>
    <td><strong>Peiodo Escolar:</strong> <?php echo $reg[0]['periodo']; ?></td>
  </tr>
</table>
</div> 
  <?php
   } 
############################# MOSTRAR ASIGNACION DE CURSO A DOCENTE EN VENTANA MODAL ############################
?>


<?php
######################### BUSQUEDA ASIGNACION DE MATERIAS A DOCENTES PARA REPORTES ########################
if (isset($_GET['BuscaAsignacionMateriasReportes']) && isset($_GET['coddoc']) && isset($_GET['codperiodo'])) { 
  
   $coddoc =$_GET['coddoc']; 
   $codperiodo = $_GET['codperiodo'];

   if($coddoc==""){

    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> POR FAVOR REALICE LA BÚSQUEDA DEL DOCENTE CORRECTAMENTE </center>";
    echo "</div>";    
    exit;
   
   } elseif($codperiodo=="") {

     echo "<div class='alert alert-danger'>";
     echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE PERIODO ESCOLAR PARA TU BÚSQUEDA</center>";
     echo "</div>";   
   exit;

} else {

$mat = new Login();
$reg = $mat->BuscarAsignacionMateriasReportes();
  ?>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-tasks"></i> Asignaciones de Materias del Periodo Escolar <?php echo $reg[0]['periodo']; ?></h3>
        </div>

        <div class="panel-body">
          <div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


            <div class="row">
              <div class="col-sm-12">

                <div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                  <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                   <thead>
                     <tr role="row">
                      <th>Nº</th>
                      <th>Turno</th>
                      <th>Nivel</th>
                      <th>Grado</th>
                      <th>Sección</th>
                      <th>Materia</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $a=1;
                    for($i=0;$i<sizeof($reg);$i++){  
                      ?>
                      <tr role="row" class="odd">
                       <td class="sorting_1" tabindex="0"><?php echo $a++; ?></td>
                       <td><?php echo $reg[$i]['turno']; ?></td>
                       <td><?php echo $reg[$i]['nivel']; ?></td>
                       <td><?php echo $reg[$i]['grado']; ?></td>
                       <td><?php echo $reg[$i]['seccion']; ?></td>
                       <td><?php echo $reg[$i]['nommateria']; ?></td>
                     </tr>
                   <?php  }  ?>
                 </tbody>
               </table>
               <div align="center"><a href="reportepdf?coddoc=<?php echo $coddoc; ?>&codperiodo=<?php echo $codperiodo; ?>&tipo=<?php echo base64_encode("ASIGNACIONESXDOCENTES") ?>" target="_blank" rel="noopener noreferrer"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>

                <a href="reporteexcel?coddoc=<?php echo $coddoc; ?>&codperiodo=<?php echo $codperiodo; ?>&tipo=<?php echo base64_encode("ASIGNACIONESXDOCENTES") ?>"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-excel-o"></span> Exportar Excel</button> </a>                     
              </div><br />        
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
  <?php
  
   }
 } 
######################### BUSQUEDA ASIGNACION DE MATERIAS A DOCENTES PARA REPORTES ########################
?>





































<?php
########################### FUNCION INSCRIPCIONES DE ESTUDIANTES ###########################
if (isset($_GET['CrearEstudiante']) && isset($_GET['cedula'])) {

$cedula = $_GET['cedula'];

if($cedula==""){

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE EL Nº DE DNI DEL ESTUDIANTE PARA TU BÚSQUEDA</center>";
  echo "</div>";    
  exit;
      
    } /* elseif (!is_numeric($cedula)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE SOLO N&Uacute;MEROS PARA C&Eacute;DULA</center>";
  echo "</div>";    
  exit;
           } */ else { 
  
  $reg = $new->BuscarEstudiante();
       ?>
       
      <div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Datos del Estudiante</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12">
   <div class="box-body">


     <div class="row"> 
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
      <label class="control-label">Nº de DNI: <span class="symbol required"></span></label> 
<input type="hidden" name="codest" id="codest" value="<?php echo $reg[0]['codest']; ?>">
<input name="cuotaunica" type="hidden" id="cuotaunica" value="<?php echo $per[0]['cuotaunica']; ?>"/>
<input type="hidden" name="update" id="update" value="ACTUALIZAR">
<input name="cedest" class="form-control" type="text" id="cedest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de DNI de Estudiante" autocomplete="off" value="<?php echo $reg[0]['cedest']; ?>" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>   
                                                                </div> 
                                                            </div>
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
         <label class="control-label">Primer Nombre: <span class="symbol required"></span></label> 
<input name="pnomest" class="form-control" type="text" id="pnomest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Primer Nombre de Estudiante" autocomplete="off" value="<?php echo $reg[0]['pnomest']; ?>" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>  
                                                                </div> 
                                                            </div>  
                            <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
        <label class="control-label">Segundo Nombre: </label> 
<input name="snomest" class="form-control" type="text" id="snomest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Segundo Nombre de Estudiante" autocomplete="off" value="<?php echo $reg[0]['snomest']; ?>" />
                        <i class="fa fa-pencil form-control-feedback"></i>  
                                                                </div> 
                                                            </div>  
                    </div>
          
           <div class="row">
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
       <label class="control-label">Primer Apellido: <span class="symbol required"></span></label> 
<input name="papeest" class="form-control" type="text" id="papeest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Primer Apellido de Estudiante" autocomplete="off" value="<?php echo $reg[0]['papeest']; ?>" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>  
                                                                </div> 
                                                            </div>  
 
                            <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
      <label class="control-label">Segundo Apellido: </label> 
<input name="sapeest" class="form-control" type="text" id="sapeest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Segundo Apellido de Estudiante" autocomplete="off" value="<?php echo $reg[0]['sapeest']; ?>"/>
                        <i class="fa fa-pencil form-control-feedback"></i>  
                                                                </div> 
                                                            </div> 
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
            <label class="control-label">Sexo: <span class="symbol required"></span></label> 
  <i class="fa fa-bars form-control-feedback"></i>
    <select name="sexoest" id="sexoest" class='form-control' required="required">
        <option value="">SELECCIONE</option>
<option value="MASCULINO"<?php if (!(strcmp('MASCULINO', $reg[0]['sexoest']))) {echo "selected=\"selected\"";} ?>>MASCULINO</option>
<option value="FEMENINO"<?php if (!(strcmp('FEMENINO', $reg[0]['sexoest']))) {echo "selected=\"selected\"";} ?>>FEMENINO</option>
     </select>  
                                                                </div> 
                                                            </div>  
                    </div>

                    <div class="row"> 
                           <div class="col-md-8"> 
                               <div class="form-group has-feedback"> 
  <label class="control-label">Dirección Domiciliaria: <span class="symbol required"></span></label> 
<input name="direcest" class="form-control" type="text" id="direcest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Dirección Domiciliaria" autocomplete="off" value="<?php echo $reg[0]['direcest']; ?>" required="required"/>
                        <i class="fa fa-map-marker form-control-feedback"></i>  
                                                                </div> 
                                                            </div> 
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
      <label class="control-label">Fecha de Nacimiento: <span class="symbol required"></span></label> 
<input name="fnacest" class="form-control nacimiento" type="text" id="fnacest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Fecha de Nacimiento" autocomplete="off" value="<?php echo date("d-m-Y",strtotime($reg[0]['fnacest'])); ?>" required="required"/>
                        <i class="fa fa-calendar form-control-feedback"></i>  
                                                                </div> 
                                                            </div>  
                     </div> 
           
           <div class="row"> 
                           <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
      <label class="control-label">Seleccione Turno: <span class="symbol required"></span></label> 
  <i class="fa fa-bars form-control-feedback"></i>
<select name="codturno" id="codturno" class="form-control" required="required">
              <option value="">SELECCIONE</option>
      <?php
      $tur = new Login();
      $tur = $tur->ListarTurno();
      for($i=0;$i<sizeof($tur);$i++){
                  ?>
<option value="<?php echo $tur[$i]['codturno'] ?>"><?php echo $tur[$i]['turno'] ?></option>       
                      <?php } ?>
                  </select>  
                                                                </div> 
                                                            </div> 
                               
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
        <label class="control-label">Seleccione Nivel: <span class="symbol required"></span></label> 
  <i class="fa fa-bars form-control-feedback"></i>
 <select name="codnivel" id="codnivel" class="form-control" onChange="ActivaGrados(document.getElementById('codnivel').value) " required="required">
              <option value="">SELECCIONE</option>
      <?php
      $niv = new Login();
      $niv = $niv->ListarNivel();
      for($i=0;$i<sizeof($niv);$i++){
                  ?>
<option value="<?php echo $niv[$i]['codnivel'] ?>"><?php echo $niv[$i]['nivel'] ?></option>       
                      <?php } ?>
                  </select>  
      
  <div id="muestracampomonto"><input type="hidden" name="montopago" id="montopago" value="" /></div>    
                                                                </div> 
                                                            </div>                
 
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
      <label class="control-label">Seleccione Grado: <span class="symbol required"></span></label>
  <i class="fa fa-bars form-control-feedback"></i> 
 <select name="codgrado" id="codgrado" class="form-control" onChange="ActivaSeccion(document.getElementById('codgrado').value)" required="required">
              <option value="">SIN RESULTADOS</option>
                  </select>        
                                                                </div> 
                                                            </div>
                     </div>
           
           <div class="row">  
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
      <label class="control-label">Seleccione Sección: <span class="symbol required"></span></label> 
  <i class="fa fa-bars form-control-feedback"></i>
<select name="codseccion" id="codseccion" class="form-control" required="required">
                              <option value="">SIN RESULTADOS</option>
             </select> 
                                                                </div> 
                                                            </div>  
                              
              <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
          <label class="control-label">Esta Becado: <span class="symbol required"></span></label> 
  <i class="fa fa-bars form-control-feedback"></i>
<select name="becado" id="becado" class="form-control" onChange="ActivaPagos(document.getElementById('montopago').value,document.getElementById('becado').value)" required="required">
              <option value="">SELECCIONE</option>
              <option value="NO">NO</option>
              <option value="MEDIA">MEDIA</option>
              <option value="COMPLETA">COMPLETA</option>
                  </select>        
                                                                </div> 
                                                            </div>

              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
            <label class="control-label">Periodo Escolar: <span class="symbol required"></span></label> 
<input name="periodo" class="form-control" type="text" id="periodo" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Periodo Escolar" autocomplete="off" value="<?php echo $per[0]["periodo"]; ?>" readonly="readonly"/>
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


 <div id="muestraforpagos"></div>


 <div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Datos del Representante (Datos para Comprobante de Pago)</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12">
   <div class="box-body">


     <div class="row"> 
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
      <label class="control-label">Nº de DNI Padre/Tutor: <span class="symbol required"></span></label> 
<input type="hidden" name="statuspad" id="statuspad" value="">
<input name="cedant" class="form-control" type="hidden" id="cedant" value="<?php echo $reg[0]['cedpadre']; ?>"/>
<input name="cedpadre" class="form-control" type="text" id="cedpadre" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de DNI Padre/Tutor" autocomplete="off" value="<?php echo $reg[0]['cedpadre']; ?>" required="required" readonly="readonly"/>
                        <i class="fa fa-pencil form-control-feedback"></i>   
                                                                </div> 
                                                            </div>
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Nombres: <span class="symbol required"></span></label> 
<input name="nompadre" class="form-control" type="text" id="nompadre" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nombre Padre/Tutor" autocomplete="off" value="<?php echo $reg[0]['nompadre']; ?>" required="required" readonly="readonly"/>
                        <i class="fa fa-pencil form-control-feedback"></i>  
                                                                </div> 
                                                            </div>
                            <div class="col-md-4">
                 <div class="form-group has-feedback"> 
        <label class="control-label">Apellidos: <span class="symbol required"></span></label> 
<input name="apepadre" class="form-control" type="text" id="apepadre" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Apellido Padre/Tutor" autocomplete="off" value="<?php echo $reg[0]['apepadre']; ?>" required="required" readonly="readonly"/>
                        <i class="fa fa-pencil form-control-feedback"></i>  
                                                                </div> 
                                                            </div>  
                    </div>
          
          <div class="row">   
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
    <label class="control-label">Nº de Teléfono: <span class="symbol required"></span></label> 
<input name="tlfpadre" class="form-control" type="text" id="tlfpadre" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Teléfono de Representante" autocomplete="off" value="<?php echo $reg[0]['tlfpadre']; ?>" required="required" readonly="readonly"/>
             <i class="fa fa-phone form-control-feedback"></i>    
                                                                </div> 
                                                            </div>  
                     </div> <br>

     <div class="text-right">
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><span class="fa fa-save"></span> Inscribir</button>
<button class="btn btn-danger" type="button" onclick="
  document.getElementById('cedest').value = '<?php echo $reg[0]['cedest']; ?>',
  document.getElementById('pnomest').value = '<?php echo $reg[0]['pnomest']; ?>',
  document.getElementById('snomest').value = '<?php echo $reg[0]['snomest']; ?>',
  document.getElementById('papeest').value = '<?php echo $reg[0]['papeest']; ?>',
  document.getElementById('sapeest').value = '<?php echo $reg[0]['sapeest']; ?>',
  document.getElementById('sexoest').value = '<?php echo $reg[0]['sexoest']; ?>',
  document.getElementById('direcest').value = '<?php echo $reg[0]['direcest']; ?>',
  document.getElementById('fnacest').value = '<?php echo date("d-m-Y",strtotime($reg[0]['fnacest'])); ?>',
  document.getElementById('codturno').value = '',
  document.getElementById('codnivel').value = '',
  document.getElementById('codgrado').value = '',
  document.getElementById('codseccion').value = '',
  document.getElementById('becado').value = '',
  document.getElementById('cedpadre').value = '<?php echo $reg[0]['cedpadre']; ?>',
  document.getElementById('nompadre').value = '<?php echo $reg[0]['nompadre']; ?>',
  document.getElementById('apepadre').value = '<?php echo $reg[0]['apepadre']; ?>',
  document.getElementById('tlfpadre').value = '<?php echo $reg[0]['tlfpadre']; ?>'
        "><i class="fa fa-trash-o"></i> Cancelar</button>
                  </div>

                        </div><!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
       <?php    
          }
   } 
########################### FUNCION INSCRIPCIONES DE ESTUDIANTES ###########################
?>

<?php 
######################## MUESTRA CAMPO MESPAGO PARA DETALLES DE PAGO ######################
if (isset($_GET['MuestraCampoMesPago']) && isset($_GET['codnivel'])) {

$niv = new Login(); 
$niv = $niv->NivelPorId();

?><input type="hidden" name="montopago" id="montopago" value="<?php echo $niv[0]['pagonivel']; ?>" />             
<?php
  }
######################## MUESTRA CAMPO MESPAGO PARA DETALLES DE PAGO ######################
?>

<?php 
############################# MUESTRA FORMULARIO PAGOS EN INSCRIPCIONES ######################
if (isset($_GET['BuscaFormularioPagos']) && isset($_GET['montopago']) && isset($_GET['becado']) && $_GET['becado'] != "COMPLETA") {
  
$montopago = $_GET['montopago'];
$becado = $_GET['becado'];

 if($montopago=="") {

  echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE NIVEL DE GRADO</center>";
  echo "</div>";		
	exit;

} elseif($becado=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE TIPO DE BECA</center>";
  echo "</div>";    
  exit;
   
	 } else{  

?>

<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Cuotas para Pagos</h3></div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-12 col-xs-12">
           <div class="box-body">

          <div class="row"> 
<?php 
$meses = explode(", ",$per[0]['mesesactivos']);

if(count($meses)==10){ $m = date("m")-2; } elseif(count($meses)==11){ $m = date("m")-1; }
                                         
                    foreach($meses as $num=>$mes) { ?>
                  <div class="col-md-2"> 
                                <div class="checkbox checkbox-primary">
<input type="checkbox" name="mespago[]" id="mespago_<?php echo "{$num}"; ?>" onClick="CargaDetallesPagosInscripcion(document.getElementById('mespago_<?php echo "{$num}"; ?>').value,document.getElementById('montopago').value,document.getElementById('cuotaunica').value,document.getElementById('becado').value)" value="<?php echo "{$mes}"; ?>" <?php echo $activo = ( $num < $m ? "disabled=\"disabled\"" : ""); ?>>
                                            <label for="mespago_<?php echo "{$num}"; ?>">
                                                <?php echo convertir("{$mes}"); ?>
                                            </label>
                                </div>
                            </div><?php  } ?>
                       </div> 
		                <hr />			
		<div id="muestradetallepagos"></div> 
                   </div><!-- /.box-body -->
               </div>
             </div>
         </div>
      </div>
   </div>
</div>      
<?php  }
 }
############################# MUESTRA FORMULARIO PAGOS EN INSCRIPCIONES ######################
?>

<?php 
####################### MUESTRA MESES SELECCIONADOS PARA PAGOS AL INSCRIBIR ######################
if (isset($_GET['CargaDetallePagosInscripcion']) && isset($_GET['mespago']) && isset($_GET['mespago2']) && isset($_GET['montopago']) && isset($_GET['cuotaunica']) && isset($_GET['becado']) && isset($_GET['totalpago'])) {

$meses = explode(", ",$per[0]['mesesactivos']);

$inicio = reset($meses); // Primero
$fin = end($meses); // Ultimo
	
$montopago = ($_GET['becado']== "MEDIA" ? $_GET['montopago']/2 : $_GET['montopago']);
$montomes = ($_GET['becado']== "MEDIA" ? $_GET['montopago']/2 : $_GET['montopago']);
$cuotaunica = $_GET['cuotaunica'];
$mesespagados = $_GET["mespago"];
$total = $_GET['totalpago'];

$contador = explode(", ",$inicio.", ".$fin);
//$montomesextra = $montomes*count($mesextra);
$montomesextra = ($_GET['becado']== "MEDIA" ? rount($montopago*2, 2) : "0.00");

//$pagoTotal=0;
//echo $montocompleto = ($_GET["mespago2"] != $inicio ? "0.00" : $_GET['montopago']);
//$pagoTotal+=$montocompleto;

if($montomes=="") {

 echo "<div class='alert alert-danger'>";
 echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
 echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE NIVEL DE GRADO PARA MOSTRAR DETALLE DE PAGOS</center>";
 echo "</div>";		
 exit;
	 
	 } else{

?>
                                     <div class="row" style="border-radius: 0px">
                                          <div class="col-md-12">
<input type="hidden" name="cuotaunica" id="cuotaunica" value="<?php echo $cuotaunica; ?>">

<p class="text-left"><b>Cuotas de Meses a Pagar:</b> <?php echo "<font size=2>".convertir($mesespagados).", </font>"; ?></p>
<p class="text-left"><b>Monto de Cuota por Mes:</b> <?php echo $montomes; ?></p>

<p class="text-left"><label>Descuento: <input class="number" type="text" name="descuento" id="descuento" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:30px;width:60px;" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onkeyup="calculardescuento()" autocomplete="off" value="0.00"> % a cuotas</label></p>

<?php if($_GET['becado']== "MEDIA"){ ?>

<p class="text-left"><b>Monto Meses Extra:</b> <?php echo rount($montopago*2, 2); ?> <label> : <?php echo convertir($inicio." - ".$fin); ?></label></p>

<?php } ?>


<p class="text-left"><b>Monto de Cuota Única:</b> <?php echo $cuotaunica; ?></p>
                                                <hr>

<input type="hidden" name="montomesextra" id="montomesextra" value="<?php echo $montomesextra; ?>">

<input type="hidden" name="totalactual" id="totalactual" value="<?php echo rount($montopago*$total, 2); ?>">

<input type="hidden" name="texttotalcuota" id="texttotalcuota" value="<?php echo rount($montopago*$total, 2); ?>">

<input type="hidden" name="total" id="total" value="<?php echo rount($montopago*$total+$cuotaunica, 2); ?>">

<h3 class="text-left"><b>Total en Cuotas:</b> <span class='label label-success'><label id="totalcuota" name="totalcuota"><?php echo number_format($montopago*$total, 2, '.', ','); ?></label></span></h3>

<h3 class="text-left"><b>Descuento a Cuotas:</b> <span class='label label-success'><label id="textdescuento" name="textdescuento">0.00</label></span></h3>

<?php if($_GET['becado']== "MEDIA"){ ?>

<h3 class="text-left"><b>Total + Cuota Única + Monto Meses Extra:</b> <span class='label label-success'><label id="texttotal" name="texttotal"><?php echo number_format($montopago*$total+$cuotaunica+$montomesextra, 2, '.', ','); ?></label></span></h3>

<?php } else { ?>

<h3 class="text-left"><b>Total + Cuota Única:</b> <span class='label label-success'><label id="texttotal" name="texttotal"><?php echo number_format($montopago*$total+$cuotaunica, 2, '.', ','); ?></label></span></h3>

<?php } ?>
                                           </div>
                                      </div>
<?php }
	}
####################### MUESTRA MESES SELECCIONADOS PARA PAGOS AL INSCRIBIR ######################
?>


<?php
######################### BUSQUEDA ESTUDIANTES PARA PROCESOS ########################
if (isset($_GET['BusquedaControlEstudiantes']) && isset($_GET['codturno']) && isset($_GET['codnivel']) && isset($_GET['codgrado']) && isset($_GET['codseccion'])) { 
  
   $codturno = $_GET['codturno'];
   $codnivel = $_GET['codnivel'];
   $codgrado = $_GET['codgrado'];
   $codseccion = $_GET['codseccion'];
   

 if($codturno=="") {

     echo "<div class='alert alert-danger'>";
     echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE TURNO PARA TU BÚSQUEDA</center>";
     echo "</div>";   
   exit;
    
} elseif($codnivel=="") {

     echo "<div class='alert alert-danger'>";
     echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE NIVEL PARA TU BÚSQUEDA</center>";
     echo "</div>";   
   exit;
   
   } elseif($codgrado=="") {

     echo "<div class='alert alert-danger'>";
     echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE GRADO PARA TU BÚSQUEDA</center>";
     echo "</div>";   
   exit;
   
   } elseif($codseccion=="") {

     echo "<div class='alert alert-danger'>";
     echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE SECCIÓN PARA TU BÚSQUEDA</center>";
     echo "</div>";   
   exit;
   
   } else {

$reg = new Login();
$reg = $reg->ListarEstudiantes();

  ?>

   <div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-tasks"></i> Control de Estudiantes de Nivel <?php echo $reg[0]['nivel']; ?> - <?php echo $reg[0]['grado']; ?> Sección <?php echo $reg[0]['seccion']; ?> del Periodo <?php echo $reg[0]['periodo']; ?></h3>
</div>

<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">

<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
                         <tr role="row">
                          <th>N°</th>
                          <th>Nº de DNI</th>
                          <th>Apellidos y Nombres</th>
                          <th>Nivel</th>
                          <th>Grado/Sección</th>
                          <th>Status</th>
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
                         <td><?php echo $reg[$i]['cedest']; ?></td>
<td><?php echo $reg[$i]['papeest']." ".$reg[$i]['sapeest']." ".$reg[$i]['pnomest']." ".$reg[$i]['snomest']; ?></td>
                         <td><?php echo $reg[$i]['nivel']; ?></td>
<td><?php echo $grado = ( $reg[$i]['grado'] == "" ? "NINGUNO" : $reg[$i]['grado'] )." / ".$seccion = ( $reg[$i]['seccion'] == "" ? "NINGUNO" : $reg[$i]['seccion'] ); ?></td>
<td><?php echo $status = ( $reg[$i]['statusest'] == 1 ? "<span class='label label-success'><i class='fa fa-check'></i> ACTIVO</span>" : "<span class='label label-warning'><i class='fa fa-times'></i> INACTIVO</span>"); ?></td>
                         <td>
<a class="btn btn-success btn-xs" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target="#panel-modal" data-backdrop="static" data-keyboard="false" onClick="VerEstudiante('<?php echo base64_encode($reg[$i]["codest"]); ?>')"><i class="fa fa-eye"></i></a>

<a class="btn btn-primary btn-xs" title="Editar" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" onClick="EditEstudiante('<?php echo $reg[$i]["codest"]; ?>','<?php echo $reg[$i]["cedest"]; ?>','<?php echo $reg[$i]["pnomest"]; ?>','<?php echo $reg[$i]["snomest"]; ?>','<?php echo $reg[$i]["papeest"]; ?>','<?php echo $reg[$i]["sapeest"]; ?>','<?php echo $reg[$i]["sexoest"]; ?>','<?php echo $reg[$i]["direcest"]; ?>','<?php echo date("d-m-Y",strtotime($reg[$i]['fnacest'])); ?>','<?php echo $codturno ?>','<?php echo $codnivel ?>','<?php echo $codgrado ?>','<?php echo $codseccion ?>')"><i class="fa fa-pencil"></i></a>
                                 
<a class="btn btn-danger btn-xs" title="Eliminar" onClick="EliminarEstudiante('<?php echo base64_encode($reg[$i]["codest"]); ?>','<?php echo base64_encode($reg[$i]["cedpadre"]) ?>','<?php echo base64_encode("ESTUDIANTES") ?>','<?php echo $codturno ?>','<?php echo $codnivel ?>','<?php echo $codgrado ?>','<?php echo $codseccion ?>')"><i class="fa fa-trash-o"></i></a>

<a class="btn btn-info btn-xs" title="Retirar" data-toggle="modal" data-target="#myModal2" data-backdrop="static" data-keyboard="false" onClick="RetiraEstudiante('<?php echo $reg[$i]["codest"]; ?>','<?php echo $reg[$i]["cedest"]; ?>','<?php echo $reg[$i]["pnomest"]." ".$reg[$i]["snomest"]; ?>','<?php echo $reg[$i]["papeest"]." ".$reg[$i]["sapeest"]; ?>','<?php echo $reg[$i]["codperiodo"]; ?>','<?php echo $codturno ?>','<?php echo $codnivel ?>','<?php echo $codgrado ?>','<?php echo $codseccion ?>')"><i class="fa fa-user-times"></i></a> </td>
                         </tr>
                         <?php } } ?>
                         </tbody>
</table><br />
                        </div>
                       </div>
                    </div>
                 </div>
              </div>
            </div>
         </div>
      </div>
  </div>
  <?php
  
   }
 } 
######################### BUSQUEDA ESTUDIANTES PARA PROCESOS ########################
?>

<?php
############################# MOSTRAR ESTUDIANTES EN VENTANA MODAL ###############################
if (isset($_GET['BuscaEstudianteModal']) && isset($_GET['codest'])) { 

$reg = $new->EstudiantesPorId();

  ?>
  
  <div class="row">
  <table border="0" align="center">
  <tr>
    <td><strong>Nº de DNI:</strong> <?php echo $reg[0]['cedest']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres:</strong> <?php echo $reg[0]['pnomest']." ".$reg[0]['snomest']; ?></td>
  </tr>
  <tr>
    <td><strong>Apellidos:</strong> <?php echo $reg[0]['papeest']." ".$reg[0]['sapeest']; ?></td>
  </tr>
  <tr>
    <td><strong>Sexo:</strong> <?php echo $reg[0]['sexoest']; ?></td>
  </tr>
  <tr>
    <td><strong>Dirección Domiciliaria:</strong> <?php echo $reg[0]['direcest']; ?></td>
  </tr>
  <tr>
    <td><strong>Fecha Nacimiento:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fnacest'])); ?></td>
  </tr>
  <tr>
    <td><strong>Edad:</strong> <?php echo edad($reg[0]['fnacest']); ?></td>
  </tr>
  <tr>
    <td><strong>Nivel:</strong> <?php echo $reg[0]['nivel']; ?></td>
  </tr>
  <tr>
    <td><strong>Grado:</strong> <?php echo $grado = ( $reg[0]['grado'] == "" ? "NINGUNO" : $reg[0]['grado'] ); ?></td>
  </tr>
  <tr>
    <td><strong>Sección:</strong> <?php echo $seccion = ( $reg[0]['seccion'] == "" ? "NINGUNO" : $reg[0]['seccion'] ); ?></td>
  </tr>
  <tr>
    <td><strong>Turno:</strong> <?php echo $reg[0]['turno']; ?></td>
  </tr>
  <tr>
    <td><strong>Becado:</strong> <?php echo $reg[0]['becado']; ?></td>
  </tr>
  <tr>
    <td><strong>Status:</strong> <?php echo $status = ( $reg[0]['statusest'] == 1 ? "<span class='label label-success'><i class='fa fa-check'></i> ACTIVO</span>" : "<span class='label label-warning'><i class='fa fa-times'></i> INACTIVO</span>"); ?></td>
  </tr>
<?php if($reg[0]['statusest'] == '1'){ ?>
  <tr>
    <td><strong>Periodo Escolar:</strong> <?php echo $reg[0]['periodo']; ?></td>
  </tr>
  <tr>
    <td><strong>Fecha de Inscripción:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fechainscripcion'])); ?></td>
  </tr>
<?php } else { ?>
  <tr>
    <td><strong>Último Periodo Inscrito:</strong> <?php echo $reg[0]['periodo']; ?></td>
  </tr>
<?php } ?>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Nº de DNI Padre/Tutor:</strong> <?php echo $reg[0]['cedpadre']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres Padre/Tutor:</strong> <?php echo $reg[0]['nompadre']; ?></td>
  </tr>
  <tr>
    <td><strong>Apellidos Padre/Tutor:</strong> <?php echo $reg[0]['apepadre']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de Teléfono Padre/Tutor:</strong> <?php echo $reg[0]['tlfpadre']; ?></td>
  </tr>
</table>
</div>
  
  <?php
   } 
############################# MOSTRAR ESTUDIANTES EN VENTANA MODAL ###############################
?>

<?php
######################### BUSQUEDA ESTUDIANTES POR TURNOS PARA REPORTES ########################
if (isset($_GET['BuscaEstudiantesReportes']) && isset($_GET['codturno']) && isset($_GET['codnivel']) && isset($_GET['codgrado']) && isset($_GET['codseccion'])) { 
	
   $codturno = $_GET['codturno'];
	 $codnivel = $_GET['codnivel'];
	 $codgrado = $_GET['codgrado'];
	 $codseccion = $_GET['codseccion'];
	 

 if($codturno=="") {

     echo "<div class='alert alert-danger'>";
     echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE TURNO PARA TU BÚSQUEDA</center>";
     echo "</div>";   
   exit;
    
} elseif($codnivel=="") {

     echo "<div class='alert alert-danger'>";
	   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE NIVEL PARA TU BÚSQUEDA</center>";
     echo "</div>";		
	 exit;
	 
	 } elseif($codgrado=="") {

     echo "<div class='alert alert-danger'>";
	   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE GRADO PARA TU BÚSQUEDA</center>";
     echo "</div>";		
	 exit;
	 
	 } elseif($codseccion=="") {

     echo "<div class='alert alert-danger'>";
	   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE SECCIÓN PARA TU BÚSQUEDA</center>";
     echo "</div>";		
	 exit;
	 
	 } else {

$est = new Login();
$est = $est->BuscarEstudiantesReportes();

  ?>

   <div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-tasks"></i> Consulta de Estudiantes de <?php echo $est[0]['nivel']; ?> - <?php echo $est[0]['grado']; ?> Sección <?php echo $est[0]['seccion']; ?> del Periodo <?php echo $est[0]['periodo']; ?></h3>
</div>

<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">

<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                 <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
												 <tr role="row">
													<th>Nº</th>
													<th>Nº de DNI</th>
													<th>Nombres</th>
													<th>Apellidos</th>
													<th>Nivel</th>
													<th>Grado</th>
													<th>Sección</th>
													<th>Turno</th>
													<th>Periodo</th>
												 </tr>
												 </thead>
												 <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($est);$i++){  
?>
                                               <tr role="row" class="odd">
											   <td class="sorting_1" tabindex="0"><?php echo $a++; ?></td>
											   <td><?php echo $est[$i]['cedest']; ?></td>
											   <td><?php echo $est[$i]['pnomest']." ".$est[$i]['snomest']; ?></td>
											   <td><?php echo $est[$i]['papeest']." ".$est[$i]['sapeest']; ?></td>
											   <td><?php echo $est[$i]['nivel']; ?></td>
											   <td><?php echo $est[$i]['grado']; ?></td>
											   <td><?php echo $est[$i]['seccion']; ?></td>
											   <td><?php echo $est[$i]['turno']; ?></td>
											   <td><?php echo $est[$i]['periodo']; ?></td>
											   
											   </tr>
											   <?php  }  ?>
											   </tbody>
</table>
<div align="center"><a href="reportepdf?codseccion=<?php echo $codseccion; ?>&codturno=<?php echo $codturno; ?>&tipo=<?php echo base64_encode("ESTUDIANTESXCURSOS") ?>" target="_blank" rel="noopener noreferrer"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>
													
<a href="reporteexcel?codseccion=<?php echo $codseccion; ?>&codturno=<?php echo $codturno; ?>&tipo=<?php echo base64_encode("ESTUDIANTESXCURSOS") ?>"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-excel-o"></span> Exportar Excel</button> </a>	
                                  </div><br />        
                               </div>
                           </div>
                      </div>
                   </div>
               </div>
           </div>
        </div>
     </div>
 </div>
  <?php
  
   }
 } 
######################### BUSQUEDA ESTUDIANTES POR TURNOS PARA REPORTES ########################
?>


<?php
############################# MOSTRAR REPRESENTANTES EN VENTANA MODAL ###############################
if (isset($_GET['BuscaTutorModal']) && isset($_GET['codpadre'])) { 

$reg = $new->TutorPorIdMuestra();

  ?>
  
 <div class="row">
  <table border="0" align="center">
  <tr>
    <td><strong>Nº de DNI Padre/Tutor:</strong> <?php echo $reg[0]['cedpadre']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres Padre/Tutor:</strong> <?php echo $reg[0]['nompadre']; ?></td>
  </tr>
  <tr>
    <td><strong>Apellidos Padre/Tutor:</strong> <?php echo $reg[0]['apepadre']; ?></td>
  </tr>
  <tr>
    <td><strong>Teléfono Padre/tutor:</strong> <?php echo $reg[0]['tlfpadre']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>

<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>

  
   <tr>
    <td><strong>Nº:</strong> <?php echo "#".$a++; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de DNI Estudiante:</strong> <?php echo $reg[$i]['cedest']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres Estudiante:</strong> <?php echo $reg[$i]['pnomest']." ".$reg[$i]['snomest']; ?></td>
  </tr>
  <tr>
    <td><strong>Apellidos Estudiante:</strong> <?php echo $reg[$i]['papeest']." ".$reg[$i]['sapeest']; ?></td>
  </tr>
  <tr>
    <td><strong>Edad:</strong> <?php echo edad($reg[$i]['fnacest']); ?></td>
  </tr>
  <tr>
    <td><strong>Turno:</strong> <?php echo $reg[$i]['turno']; ?></td>
  </tr>
  <tr>
    <td><strong>Nivel:</strong> <?php echo $reg[$i]['nivel']; ?></td>
  </tr>
  <tr>
    <td><strong>Grado:</strong> <?php echo $grado = ( $reg[0]['grado'] == "" ? "NINGUNO" : $reg[$i]['grado'] ); ?></td>
  </tr>
  <tr>
    <td><strong>Sección:</strong> <?php echo $seccion = ( $reg[0]['seccion'] == "" ? "NINGUNO" : $reg[$i]['seccion'] ); ?></td>
  </tr>
  <tr>
  <td><strong>Status:</strong> <?php echo $status = ( $reg[$i]['statusest'] == 1 ? "<span class='label label-success'><i class='fa fa-check'></i> ACTIVO</span>" : "<span class='label label-warning'><i class='fa fa-times'></i> INACTIVO</span>"); ?></td>
  </tr>
  <tr>
    <td><strong>Periodo Escolar:</strong> <?php echo $reg[$i]['periodo']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
<?php } ?> 
</table>
</div>
<br />
  <?php
   } 
############################# MOSTRAR REPRESENTANTES EN VENTANA MODAL ###############################
?>

<?php
######################### BUSQUEDA REPRESENTANTES POR TURNOS PARA REPORTES ########################
if (isset($_GET['BuscaRepresentantesReportes']) && isset($_GET['codturno']) && isset($_GET['codnivel']) && isset($_GET['codgrado']) && isset($_GET['codseccion'])) { 
	
   $codturno = $_GET['codturno'];
	 $codnivel = $_GET['codnivel'];
	 $codgrado = $_GET['codgrado'];
	 $codseccion = $_GET['codseccion'];
	 

 if($codturno=="") {

   echo "<div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE TURNO PARA TU BÚSQUEDA</center>";
   echo "</div>";   
   exit;
    
} elseif($codnivel=="") {

   echo "<div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE NIVEL PARA TU BÚSQUEDA</center>";
   echo "</div>";		
   exit;
	 
	 } elseif($codgrado=="") {

   echo "<div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE GRADO PARA TU BÚSQUEDA</center>";
   echo "</div>";		
   exit;
	 
	 } elseif($codseccion=="") {

   echo "<div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE SECCIÓN PARA TU BÚSQUEDA</center>";
   echo "</div>";		
   exit;
	 
	 } else {

$rep = new Login();
$rep = $rep->BuscarRepresentantesReportes();

  ?>

   <div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-tasks"></i> Consulta de Representantes de <?php echo $rep[0]['nivel']; ?> - <?php echo $rep[0]['grado']; ?> Sección <?php echo $rep[0]['seccion']; ?> del Periodo <?php echo $rep[0]['periodo']; ?></h3>
</div>

<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">

<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                  <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
												 <tr role="row">
													<th>Nº</th>
													<th>Estudiante</th>
													<th>Nº de DNI</th>
													<th>Nombres</th>
													<th>Apellidos</th>
													<th>Nivel</th>
													<th>Grado</th>
													<th>Sección</th>
													<th>Turno</th>
												 </tr>
												 </thead>
												 <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($rep);$i++){  
?>
                                               <tr role="row" class="odd">
											   <td class="sorting_1" tabindex="0"><?php echo $a++; ?></td>
<td><abbr title="<?php echo $rep[$i]['pnomest']." ".$rep[$i]['snomest']." ".$rep[$i]['papeest']." ".$rep[$i]['sapeest']; ?>"><?php echo $rep[$i]['cedest']; ?></abbr></td>
											   <td><?php echo $rep[$i]['cedpadre']; ?></td>
											   <td><?php echo $rep[$i]['nompadre']; ?></td>
											   <td><?php echo $rep[$i]['apepadre']; ?></td>
											   <td><?php echo $rep[$i]['nivel']; ?></td>
											   <td><?php echo $rep[$i]['grado']; ?></td>
											   <td><?php echo $rep[$i]['seccion']; ?></td>
											   <td><?php echo $rep[$i]['turno']; ?></td>
											   
											   </tr>
											   <?php  }  ?>
											   </tbody>
</table>
<div align="center"><a href="reportepdf?codseccion=<?php echo $codseccion; ?>&codturno=<?php echo $codturno; ?>&tipo=<?php echo base64_encode("REPRESENTANTESXCURSOS") ?>" target="_blank" rel="noopener noreferrer"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>
													
<a href="reporteexcel?codseccion=<?php echo $codseccion; ?>&codturno=<?php echo $codturno; ?>&tipo=<?php echo base64_encode("REPRESENTANTESXCURSOS") ?>"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-excel-o"></span> Exportar Excel</button> </a>									  
				                          </div><br />        
                               </div>
                           </div>
                      </div>
                   </div>
               </div>
           </div>
        </div>
     </div>
 </div>
  <?php
  
   }
 } 
######################### BUSQUEDA REPRESENTANTES POR TURNOS PARA REPORTES ########################
?>


























<?php
############################# FUNCION PARA PAGOS DE ESTUDIANTES ###########################
if (isset($_GET['CrearPagosEstudiante']) && isset($_GET['codest']) && isset($_GET['codperiodo'])) {

$codest = $_GET['codest'];
$codperiodo = $_GET['codperiodo'];

  /*} else if(!is_numeric($cedest)){*/
  if($codest==""){

  echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR REALICE LA BÚSQUEDA DEL ESTUDIANTE CORRECTAMENTE</center>";
  echo "</div>";		
	exit;
			
	} elseif ($codperiodo==""){

  echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE PERIODO ESCOLAR PARA TU BÚSQUEDA</center>";
  echo "</div>";		
	exit;

           } else { 
	
$reg = $new->BuscarPagosEstudiantes();
 
		   ?>

       <div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Datos del Estudiante</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12">
   <div class="box-body">

                        <div class="row"> 
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
<label class="control-label">Nº de DNI de Estudiante: <span class="symbol required"></span></label>
<input type="hidden" name="cedest" id="cedest" value="<?php echo $reg[0]['cedula']; ?>">
<input type="hidden" name="montopago" id="montopago" value="<?php echo $reg[0]['montopago']; ?>">     
<input type="hidden" name="montomora" id="montomora" value="<?php echo number_format($reg[0]['totalvenc'] * $reg[0]['interesmora'], 2, '.', '.'); ?>">
<input type="hidden" name="vencidos" id="vencidos" value="<?php echo $reg[0]['totalvenc']; ?>">
<input type="hidden" name="codperiodo" id="codperiodo" value="<?php echo $reg[0]['codperiodo']; ?>">
<input type="hidden" name="becado" id="becado" value="<?php echo $reg[0]['becado']; ?>">
<input type="hidden" name="cantmora" id="cantmora" value="<?php echo $reg[0]['totalvenc']; ?>">
<br /><abbr title="Código de Estudiante"><?php echo $reg[0]['cedula']; ?></abbr>
                          
                                                                </div> 
                                                            </div>
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
   <label class="control-label">Apellidos y Nombres: <span class="symbol required"></span></label> 
<br /><abbr title="Nombres del Estudiante"><?php echo $reg[0]['pApellido']." ".$reg[0]['sApellido']." ".$reg[0]['pNombre']." ".$reg[0]['sNombre']; ?></abbr>
                                                                </div>
                                                            </div>
                            <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Nivel: <span class="symbol required"></span></label> 
<br /><abbr title="Nivel"><?php echo $reg[0]['nivel']; ?></abbr>
                                                                </div> 
                                                            </div>    
                    </div>
          
           <div class="row"> 
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Grado y Sección: <span class="symbol required"></span></label> 
<br /><abbr title="Grado y Sección"><?php echo $reg[0]['grado']." / SECCI&Oacute;N '".$reg[0]['seccion']."'"; ?></abbr>
                                                                </div> 
                                                            </div> 

                           <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Turno: <span class="symbol required"></span></label> 
<br /><abbr title="Turno"><?php echo $reg[0]['turno']; ?></abbr>
                                                                </div> 
                                                            </div> 
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Becado: <span class="symbol required"></span></label> 
<br /><abbr title="Becado"><?php echo $reg[0]['becado']; ?></abbr>  
                                                                </div> 
                                                            </div>
                     </div> 
           
           <div class="row"> 
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Periodo Escolar: <span class="symbol required"></span></label> 
<br /><abbr title="Periodo Escolar Inscrito"><?php echo $reg[0]['periodo']; ?></abbr>  
                                                                </div> 
                                                            </div>
                           <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Fecha de Inscripción: <span class="symbol required"></span></label> 
<br /><abbr title="Fecha de Inscripción"><?php echo date("d-m-Y",strtotime($reg[0]['fechainscripcion'])); ?></abbr>
                                                                </div> 
                                                            </div> 

                      <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Edad: <span class="symbol required"></span></label> 
<br /><abbr title="Edad"><?php echo edad($reg[0]['fnacest'])." A&Ntilde;OS"; ?></abbr>
                                                                </div> 
                                                            </div> 
          </div>

          <div class="row">
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
<label class="control-label">Nº de DNI Padre/Tutor: <span class="symbol required"></span></label> 
<br /><abbr title="NIT/CI Padre/Tutor"><?php echo $reg[0]['cedpadre']; ?></abbr>  
                                                                </div> 
                                                            </div>
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Nombres y Apellidos Padre/Tutor: <span class="symbol required"></span></label> 
<br /><abbr title="Nombres y Apellidos Padre/Tutor"><?php echo $reg[0]['nompadre']." ".$reg[0]['apepadre']; ?></abbr> 
                                                                </div> 
                                                            </div> 
                              
              <div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Nº de Teléfono: <span class="symbol required"></span></label> 
<br /><abbr title="Nº de Teléfono"><?php echo $reg[0]['tlfpadre']; ?></abbr>  
                                                                </div> 
                                                            </div> 

                                    </div><!-- /.box-body -->
                               </div>
                          </div>
                     </div>
                </div>
           </div>
      </div>
	</div>

      <div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Gestión de Pagos del Periodo <?php echo $reg[0]['periodo']; ?></h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12">
   <div class="box-body">

          <div class="row">  
<?php

$meses = explode(", ",$reg[0]['mesesactivos']);
$mesespagados = explode(", ",$reg[0]['mesespag']);
$mesesvenc = explode(", ",$reg[0]['mesesvenc']);
if(count($meses)==10){ $m = date("m")-2; } elseif(count($meses)==11){ $m = date("m")-1; }
                                         
            foreach($meses as $num=>$mes) { ?>
                  <div class="col-md-2"> 
                                <div class="checkbox checkbox-primary">
<input type="checkbox" name="mespago[]" id="mespago_<?php echo "{$num}"; ?>" onClick="CargaDetallesPagos(document.getElementById('mespago_<?php echo "{$num}"; ?>').value,document.getElementById('montopago').value,document.getElementById('montomora').value)" value="<?php echo "{$mes}"; ?>" <?php

/* echo $meschecked == "{$mes}"?"checked=\"checked\"disabled=\"disabled\"":''; } ?> type="checkbox"> */
/* echo $activo = ( $meschecked == "{$mes}" || $num < $m ? "checked=\"checked\"disabled=\"disabled\"" : ""); } ?>> */
/* echo $activo = ($meschecked == "{$mes}"?"checked=\"checked\"disabled=\"disabled\"" : ""); } ?>> */
foreach($mesespagados as $meschecked){ 
   echo $activo = ($meschecked == "{$mes}"?"checked=\"checked\"disabled=\"disabled\"" : ""); } ?>>
                                            <label for="mespago_<?php echo "{$num}"; ?>">
                                                <?php echo convertir("{$mes}"); ?>
                                            </label>
                               </div>
                            </div><?php } ?>
                    </div>
          <hr />  
      
  <?php if(count($meses) == $reg[0]['totalpagad']+$reg[0]['totalpagad2']) { 
  
      $desc = $reg[0]["descuento"]/100;
      $pagados = $reg[0]['totalpagad']*$reg[0]['montopago'];
      $pagosmora = $reg[0]["cantmora"]*$reg[0]['interesmora'];
      $descuento = $pagados*$desc;
      
  ?>
	
	
<div class="row" style="border-radius: 0px">
                                      <div class="col-md-12">
  <p class="text-left"><b>Cuotas de Meses Pagados:</b> <?php echo convertir($reg[0]['mesespag']); ?></p>
  <p class="text-left"><b>Meses Vencidos Pagados:</b> <?php echo $nro = ( $reg[0]["cantmora"] == '' ? "0" : $reg[0]["cantmora"]); ?></p>
  <p class="text-left"><b>Inter&eacute;s por Mora:</b> <?php echo $reg[0]['interesmora']; ?></p>
  <p class="text-left"><b>Pago por Mora:</b> <?php echo number_format($pagosmora, 2, '.', ','); ?></p>
  <p class="text-left"><b>Monto de la Cuota por Mes:</b> <?php echo $reg[0]['montopago']; ?></p>
                                          <hr>
  <h3 class="text-left"><b>Total Pagado:</b> <?php echo "<span class='label label-success'>".number_format($pagados+$pagosmora+$reg[0]["cuotaunica"]+$reg[0]["montomesextra"]-$descuento, 2, '.', ',')."</span>"; ?></h3>
                                          <hr /> </div>
</div>
	                                       
	
	<?php

 echo "<div class='alert alert-danger'>";
 echo "<center><span class='fa fa-info-circle'></span> EL ESTUDIANTE A REALIZADO EL PAGO TOTAL DE MENSUALIDADES CORRESPONDIENTE AL PERIODO ESCOLAR ".$reg[0]['periodo']."</center>";
 echo "</div>";		
 exit;     
	                                                } ?> 


<div class="row" style="border-radius: 0px">
                                      <div class="col-md-12">
  <p class="text-left"><b>Cuotas de Meses Pagados:</b> <?php echo convertir($reg[0]['mesespag']); ?></p>
  <p class="text-left"><b>Cuotas de Meses Vencidos:</b> <?php echo convertir($reg[0]['mesesvenc']); ?></p>
  <p class="text-left"><b>Inter&eacute;s por Mora:</b> <?php echo $reg[0]['interesmora']; ?></p>
  <p class="text-left"><b>Pago por Mora:</b> <?php echo number_format($reg[0]['totalvenc'] * $reg[0]['interesmora'], 2, '.', ','); ?></p>
                                      </div>
</div>

<div id="cargacheckbox"></div>
          
            <div class="text-right">
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><span class="fa fa-save"></span> Registrar Pago</button>
<button type="button" class="btn btn-danger" onClick="LimpiarCheckbox()"><i class="fa fa-trash-o"></i> Cancelar</button>
            </div>
                           </div><!-- /.box-body -->
                        </div>
                     </div>
                  </div>
               </div>
           </div>
      </div>
<?php		
        }
  }
############################# FUNCION PARA PAGOS DE ESTUDIANTES ###########################
?>

<?php 
########################### MUESTRA MESES SELECCIONADOS PARA PAGOS ######################
if (isset($_GET['CargaCheckbox']) && isset($_GET['mespago']) && isset($_GET['montopago']) && isset($_GET['montomora']) && isset($_GET['total'])) {
	
$monto = $_GET['montopago'];
$montomora = $_GET['montomora'];	
$mesespagados = $_GET["mespago"];
$total = $_GET['total'];
?>

<input type="hidden" name="pagados" id="pagados" value="<?php echo $_GET['total']; ?>">

  <div class="row" style="border-radius: 0px">
        <div class="col-md-12">
    <p class="text-left"><b>Cuotas de Meses a Pagar:</b> <?php echo "<font size=2>".convertir($mesespagados).", </font>"; ?></p>
    <p class="text-left"><b>Monto de la Cuota por Mes:</b> <?php echo $monto; ?></p>
                                                <hr>
    <input type="hidden" name="total" id="total" value="<?php echo rount($monto*$total+$montomora, 2); ?>">
<h3 class="text-left"><b>Total a Pagar:</b> <span class='label label-success'><label id="texttotal" name="texttotal"><?php echo number_format($monto*$total+$montomora, 2, '.', ','); ?></label></span></h3>
        </div>
  </div>
<?php
	}
########################### MUESTRA MESES SELECCIONADOS PARA PAGOS ######################
?>


<?php
############################# FUNCION BUSCA PAGOS POR ESTUDIANTES ###########################
if (isset($_GET['BuscarPagosxEstudiante']) && isset($_GET['codest']) && isset($_GET['codperiodo'])) {

$codest = $_GET['codest'];
$codperiodo = $_GET['codperiodo'];

  /*} else if(!is_numeric($cedest)){*/
  if($codest==""){

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR REALICE LA BÚSQUEDA DEL ESTUDIANTE CORRECTAMENTE</center>";
  echo "</div>";    
  exit;
      
  } elseif ($codperiodo==""){

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE PERIODO ESCOLAR PARA TU BÚSQUEDA</center>";
  echo "</div>";    
  exit;

           } else { 
  
$reg = $new->ListarPagosxEstudiantes();

       ?>
<div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-tasks"></i> Consulta de Pagos del Estudiante <?php echo $reg[0]['pnomest']." ".$reg[0]['snomest']." ".$reg[0]['papeest']." ".$reg[0]['sapeest']; ?> del Periodo <?php echo $reg[0]['periodo']; ?> </h3>
</div>

<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">

<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
                         <tr role="row">
                          <th>N°</th>
                          <th>Becado</th>
                          <th>Turno</th>
                          <th>Nivel</th>
                          <th>Grado</th>
                          <th>Sección</th>
                          <th>Mes</th>
                          <th>Monto por Mes</th>
                          <th>Fecha de Pago</th>
                          <th>Status</th>
                            <th>Ver</th>
                         </tr>
                         </thead>
                         <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                         <td class="sorting_1" tabindex="0"><?php echo $a++; ?></td>
                         <td><?php echo $reg[$i]['becado']; ?></td>
                         <td><?php echo $reg[$i]['turno']; ?></td>
                         <td><?php echo $reg[$i]['nivel']; ?></td>
                         <td><?php echo $reg[$i]['grado']; ?></td>
                         <td><?php echo $reg[$i]['seccion']; ?></td>
                         <td><?php echo convertir($reg[$i]['mespago']); ?></td>
                         <td><?php echo $reg[$i]['montopago']; ?></td>
<td><?php echo $fecha = ( $reg[$i]['statuspago'] == 2 ? "PENDIENTE" : date("d-m-Y",strtotime($reg[$i]['fechapago']))); ?></td>
<td><?php echo $status = ( $reg[$i]['statuspago'] == 1 ? "<span class='label label-success'><i class='fa fa-check'></i> PAGADA</span>" : "<span class='label label-default'><i class='fa fa-times'></i> VENCIDA</span>"); ?></td>
                         <td>
<a href="#" class="btn btn-success btn-xs" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target="#panel-modal" data-backdrop="static" data-keyboard="false" onClick="VerPagos('<?php echo base64_encode($reg[$i]["codpago"]); ?>')"><i class="fa fa-eye"></i></a>
 </td>
                         </tr>
                         <?php  }  ?>
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
<?php   
        }
  }
############################# FUNCION BUSCA PAGOS POR ESTUDIANTES ###########################
?>

<?php
########################## MOSTRAR PAGOS EN VENTANA MODAL ##############################
if (isset($_GET['BuscaPagoModal']) && isset($_GET['codpago'])) { 

$reg = $new->PagosPorId();

  ?>
  
  <div class="row">
  <table border="0" align="center">
  <tr>
    <td><strong>Nº de DNI:</strong> <?php echo $reg[0]['cedest']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres:</strong> <?php echo $reg[0]['pnomest']." ".$reg[0]['snomest']; ?></td>
  </tr>
  <tr>
    <td><strong>Apellidos:</strong> <?php echo $reg[0]['papeest']." ".$reg[0]['sapeest']; ?></td>
  </tr>
  <tr>
    <td><strong>Sexo:</strong> <?php echo $reg[0]['sexoest']; ?></td>
  </tr>
  <tr>
    <td><strong>Dirección Domiciliaria:</strong> <?php echo $reg[0]['direcest']; ?></td>
  </tr>
  <tr>
    <td><strong>Fecha Nacimiento:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fnacest'])); ?></td>
  </tr>
  <tr>
    <td><strong>Edad:</strong> <?php echo edad($reg[0]['fnacest']); ?> AÑOS</td>
  </tr>
  <tr>
    <td><strong>Nivel:</strong> <?php echo $reg[0]['nivel']; ?></td>
  </tr>
  <tr>
    <td><strong>Grado:</strong> <?php echo $reg[0]['grado']; ?></td>
  </tr>
  <tr>
    <td><strong>Sección:</strong> <?php echo $reg[0]['seccion']; ?></td>
  </tr>
  <tr>
    <td><strong>Turno:</strong> <?php echo $reg[0]['turno']; ?></td>
  </tr>
  <tr>
    <td><strong>Periodo Escolar:</strong> <?php echo $reg[0]['periodo']; ?></td>
  </tr>
  <tr>
    <td><strong>Becado:</strong> <?php echo $reg[0]['becado']; ?></td>
  </tr>
  <tr>
    <td><strong>Mes a Pagar:</strong> <?php echo convertir($reg[0]['mespago']); ?></td>
  </tr>
  <tr>
    <td><strong>Monto a Pagar:</strong> <?php echo $reg[0]['montopago']; ?></td>
  </tr>
  <tr>
    <td><strong>Fecha de Pago:</strong> <?php echo date("d-m-Y",strtotime($reg[0]['fechapago'])); ?></td>
  </tr>
  <tr>
    <td><strong>Status:</strong> <?php echo $status = ( $reg[0]['statuspago'] == 1 ? "<span class='label label-success'><i class='fa fa-check'></i> PAGADA</span>" : "<span class='label label-default'><i class='fa fa-times'></i> VENCIDA</span>"); ?></td>
  </tr>
</table>
</div>
  <?php
   } 
########################## MOSTRAR PAGOS EN VENTANA MODAL ##############################
?>

<?php
############################# BUSQUEDA DE COMPROBANTES DE PAGOS ############################
if (isset($_GET['BuscaComprobantesReportes']) && isset($_GET['codest']) && isset($_GET['codperiodo'])) { 
	
	 $codest = $_GET['codest'];
	 $codperiodo = $_GET['codperiodo'];
	 

 if($codest=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR REALICE LA BÚSQUEDA DEL ESTUDIANTE CORRECTAMENTE</center>";
  echo "</div>";		
  exit;
	 
	 } elseif($codperiodo=="") {

  echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE PERIODO ESCOLAR PARA TU BÚSQUEDA</center>";
  echo "</div>";		
	exit;
	 
		} else {

$com = new Login();
$com = $com->BuscarComprobantesReportes();

  ?>

   <div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-tasks"></i> Consulta Comprobantes de Pagos del Periodo <?php echo $com[0]['periodo']; ?></h3>
</div>

<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">

<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
												 <tr role="row">
													<th>Nº</th>
													<th>Nº de DNI</th>
													<th>Nombres</th>
													<th>Apellidos</th>
													<th>Pagados</th>
													<th>Monto por Mes</th>
													<th>Vencidos</th>
													<th>Pago Total</th>
													<th>Comprobante</th>
												 </tr>
												 </thead>
												 <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($com);$i++){  
$desc=$com[$i]['descuento']/100;
$calculo=$com[$i]["sumpago"] + $com[$i]['cantmora'] * $com[$i]['interesmora'] + $com[$i]['cuotaunica'];
$subtotal= $calculo * $desc;
$total=$calculo - $subtotal;
?>
                                               <tr role="row" class="odd">
											   <td class="sorting_1" tabindex="0"><?php echo $a++; ?></td>
											   <td><?php echo $com[$i]['cedest']; ?></td>
											   <td><?php echo $com[$i]['pnomest']." ".$com[$i]['snomest']; ?></td>
											   <td><?php echo $com[$i]['papeest']." ".$com[$i]['sapeest']; ?></td>
											   <td><?php echo $com[$i]['cantidad']." Meses"; ?></td>
											   <td><?php echo $com[$i]['montopago']; ?></td>
<td><?php echo $cantidad = ( $com[$i]['cantmora'] == 0 ? "0" : $com[$i]['cantmora']); ?></td>

<td><?php echo number_format($total, 2, '.', ','); ?></td>

											   <td class="actions"><div align="center">
<a href="reportepdf?codest=<?php echo base64_encode($com[$i]['codest']); ?>&numcomprobante=<?php echo base64_encode($com[$i]['numcomprobante']); ?>&tipo=<?php echo base64_encode("COMPROBANTEPAGOS") ?>" class="btn btn-success btn-xs" title="Imprimir PDF" target="_blank" rel="noopener noreferrer"><i class="fa fa-file-pdf-o"></i></a></div></td>
											   </tr>
											   <?php  }  ?>
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
  <?php
     }
 } 
############################# BUSQUEDA DE COMPROBANTES DE PAGOS ############################
?>

<?php
############################# BUSQUEDA DE PAGOS EN GENERAL PARA REPORTES #######################
if (isset($_GET['BuscaPagosGeneralesReportes']) && isset($_GET['desde'])  && isset($_GET['hasta']) && isset($_GET['codperiodo'])) { 
	
	 $desde = $_GET['desde'];
	 $hasta = $_GET['hasta'];
	 $codperiodo = $_GET['codperiodo'];
	 

 if($desde=="") {

  echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU BÚSQUEDA</center>";
  echo "</div>";		
  exit;
		

} else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA FINAL PARA TU BÚSQUEDA</center>";
  echo "</div>";		
  exit;

   } elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> LA FECHA DE INICIO NO PUEDE SER MAYOR QUE LA FECHA DE FIN</center>";
  echo "</div>";		
  exit;
	 
	 } elseif($codperiodo=="") {

  echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE PERIODO ESCOLAR PARA TU BÚSQUEDA</center>";
  echo "</div>";		
	exit;
	 
		} else {

$com = new Login();
$com = $com->BuscarPagosGeneralReportes();

$egreso = new Login();
$egreso = $egreso->SumaGastosFechas();

  ?>

   <div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-tasks"></i> Consulta de Pagos Desde <?php echo $_GET["desde"]." Hasta ".$_GET["hasta"]; ?> del Periodo <?php echo $com[0]['periodo']; ?></h3>
</div>

<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">

<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
												 <tr role="row">
													<th>Nº</th>
													<th>Nombres y Apellidos de Estudiante</th>
													<th>Becado</th>
                          <th>Meses Pagados</th>
                          <th>Mora</th>
                          <th>Monto por Mes</th>
                          <th>Pago Monto Extra</th>
													<th>Pago Total</th>
												   </tr>
												 </thead>
												 <tbody>
<?php 
$a=1;
$pagoTotal=0;
for($i=0;$i<sizeof($com);$i++){
$desc=$com[$i]['descuento']/100; 
$calculo=($com[$i]['sumpago'])+($com[$i]['cantmora']*$com[$i]['interesmora']);
$subtotal= $calculo*$desc;
$total=$calculo-$subtotal+$com[$i]['cuotaunica']+$com[$i]['montomesextra'];
$pagoTotal+=$total;
?>
                                               <tr role="row" class="odd">
											   <td class="sorting_1" tabindex="0"><?php echo $a++; ?></td>
<td><abbr title="<?php echo "Nº de Código: ".$com[$i]['cedest']; ?>"><?php echo $com[$i]['pnomest']." ".$com[$i]['snomest']." ".$com[$i]['papeest']." ".$com[$i]['sapeest']; ?></abbr></td>
											   <td><?php echo $com[$i]['becado']; ?></td>
                         <td><?php echo convertir($com[$i]["meses"]); ?></td>
<td><?php echo $mora = ( $com[$i]['cantmora'] == '' ? "0" : $com[$i]['cantmora']); ?><sup><?php echo $com[$i]['interesmora']; ?></sup></td>
                         <td><?php echo $com[$i]['montopago']; ?></td>
                         <td><?php echo $montoextra = ($com[$i]['montomesextra']== "" ? "0.00" : $com[$i]['montomesextra']); ?></td>
                         <td><?php echo number_format($total, 2, '.', ','); ?></td>
											 </tr>
											   <?php  }  ?>
                        <tr role="row">
        <td colspan="6" class="sorting_1" tabindex="0">&nbsp;</td>
													 <td><strong>Monto Total</strong></td>
        <td><strong><?php echo number_format($pagoTotal, 2, '.', ','); ?></strong></td>
                        </tr>
                        <tr role="row">
        <td colspan="6" class="sorting_1" tabindex="0">&nbsp;</td>
                           <td><strong>Egresos</strong></td>
        <td><strong><?php echo number_format($egreso[0]['egresos'], 2, '.', ','); ?></strong></td>
                        </tr>
                        <tr role="row">
        <td colspan="6" class="sorting_1" tabindex="0">&nbsp;</td>
                           <td><strong>Total General</strong></td>
        <td><strong><?php echo number_format($pagoTotal-$egreso[0]['egresos'], 2, '.', ','); ?></strong></td>
                        </tr>
											   </tbody>
</table>
           <div align="center">
<a href="reportepdf?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&codperiodo=<?php echo $codperiodo; ?>&tipo=<?php echo base64_encode("PAGOSFECHAS") ?>" target="_blank" rel="noopener noreferrer"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>
													
<a href="reporteexcel?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&codperiodo=<?php echo $codperiodo; ?>&tipo=<?php echo base64_encode("PAGOSFECHAS") ?>"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-excel-o"></span> Exportar Excel</button> </a>	                    
                                   </div><br />        
                               </div>
                           </div>
                      </div>
                   </div>
               </div>
           </div>
        </div>
     </div>
 </div>
  <?php
     }
 } 
############################# BUSQUEDA DE PAGOS EN GENERAL PARA REPORTES #######################
?>


<?php
############################# BUSQUEDA DE PAGOS AL DIA PARA REPORTES ############################
if (isset($_GET['BuscaPagosAlDiaReportes']) && isset($_GET['codturno']) && isset($_GET['codnivel']) && isset($_GET['codgrado']) && isset($_GET['codseccion']) && isset($_GET['mespago']) && isset($_GET['codperiodo'])) { 
	
   $codturno = $_GET['codturno'];
	 $codnivel = $_GET['codnivel'];
	 $codgrado = $_GET['codgrado'];
	 $codseccion = $_GET['codseccion'];
	 $mespago = $_GET['mespago'];
	 $codperiodo = $_GET['codperiodo'];
	 

 if($codturno=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE TURNO PARA TU BÚSQUEDA</center>";
  echo "</div>";    
  exit;
   
   } elseif($codnivel=="") {

  echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE NIVEL PARA TU BÚSQUEDA</center>";
  echo "</div>";		
	exit;
	 
	 } elseif($codgrado=="") {

  echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE GRADO PARA TU BÚSQUEDA</center>";
  echo "</div>";		
	exit;
	 
	 } elseif($codseccion=="") {

  echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE SECCIÓN PARA TU BÚSQUEDA</center>";
  echo "</div>";		
	exit;
	 
	 } elseif($mespago=="") {

  echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE MES DE PAGO PARA TU BÚSQUEDA</center>";
  echo "</div>";		
	exit;
	 
	 } elseif($codperiodo=="") {

  echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE PERIODO ESCOLAR PARA TU BÚSQUEDA</center>";
  echo "</div>";		
	exit;
	 
		} else {

    $com = new Login();
    $com = $com->BuscarPagosAlDiaReportes();

  ?>

   <div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-tasks"></i> Consulta de Pagos por Cursos del Mes de <?php echo convertir($mespago); ?> del Periodo <?php echo $com[0]['periodo']; ?></h3>
</div>

<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">

<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
												 <tr role="row">
													<th>Nº</th>
													<th>Nº de DNI</th>
													<th>Nombres</th>
													<th>Apellidos</th>
													<th>Becado</th>
													<th>Cuota por Mes</th>
													<th>Pago por Mes</th>
												   </tr>
												 </thead>
												 <tbody>
<?php 
$a=1;
$pagoTotal=0;
for($i=0;$i<sizeof($com);$i++){
$desc=$com[$i]['descuento']/100;
$calculo=$com[$i]['montopago']+$com[$i]['cantmora']*$com[$i]['interesmora']+$com[0]['cuotaunica'];
$subtotal= $calculo * $desc;
$total=$calculo - $subtotal;
$pagoTotal+=$total;
?>
                                               <tr role="row" class="odd">
											   <td class="sorting_1" tabindex="0"><?php echo $a++; ?></td>
											   <td><?php echo $com[$i]['cedula']; ?></td>
											   <td><?php echo $com[$i]['pNombre']." ".$com[$i]['sNombre']; ?></td>
											   <td><?php echo $com[$i]['pApellido']." ".$com[$i]['sApellido']; ?></td>
											   <td><?php echo $com[$i]['becado']; ?></td>
											   <td><?php echo $com[$i]['montopago']; ?></td>
<td><?php echo number_format($total, 2, '.', ','); ?></td>
											   </tr>
											   <?php  }  ?>
                        <tr role="row">
              <td colspan="5" class="sorting_1" tabindex="0">&nbsp;</td>
              <td><strong>Monto Total</strong></td>
              <td><strong><?php echo number_format($pagoTotal, 2, '.', ','); ?></strong></td>
                         </tr>
											   </tbody>
</table>
        <div align="center">
<a href="reportepdf?codseccion=<?php echo $codseccion; ?>&codturno=<?php echo $codturno; ?>&mespago=<?php echo $mespago; ?>&codperiodo=<?php echo $codperiodo; ?>&tipo=<?php echo base64_encode("PAGOSALDIA") ?>" target="_blank" rel="noopener noreferrer"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>
													
<a href="reporteexcel?codseccion=<?php echo $codseccion; ?>&codturno=<?php echo $codturno; ?>&mespago=<?php echo $mespago; ?>&codperiodo=<?php echo $codperiodo; ?>&tipo=<?php echo base64_encode("PAGOSALDIA") ?>"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-excel-o"></span> Exportar Excel</button> </a>                    
                                   </div><br />        
                               </div>
                           </div>
                      </div>
                   </div>
               </div>
           </div>
        </div>
     </div>
 </div>
  <?php
     }
 } 
############################# BUSQUEDA DE PAGOS AL DIA PARA REPORTES ############################
?>

<?php
############################# BUSQUEDA DE PAGOS VENCIDOS PARA REPORTES #######################
if (isset($_GET['BuscaPagosVencidosReportes']) && isset($_GET['codturno']) && isset($_GET['codnivel']) && isset($_GET['codgrado']) && isset($_GET['codseccion']) && isset($_GET['codperiodo'])) { 
	
   $codturno = $_GET['codturno'];
	 $codnivel = $_GET['codnivel'];
	 $codgrado = $_GET['codgrado'];
	 $codseccion = $_GET['codseccion'];
	 $codperiodo = $_GET['codperiodo'];
	 

 if($codturno=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE TURNO PARA TU BÚSQUEDA</center>";
  echo "</div>";    
  exit;
   
   } elseif($codnivel=="") {

  echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE NIVEL PARA TU BÚSQUEDA</center>";
  echo "</div>";		
	exit;
	 
	 } elseif($codgrado=="") {

  echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE GRADO PARA TU BÚSQUEDA</center>";
  echo "</div>";		
	exit;
	 
	 } elseif($codseccion=="") {

  echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE SECCIÓN PARA TU BÚSQUEDA</center>";
  echo "</div>";		
	exit;
	 
	 } elseif($codperiodo=="") {

  echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE PERIODO ESCOLAR PARA TU BÚSQUEDA</center>";
  echo "</div>";		
	exit;
	 
		} else {

  $com = new Login();
  $com = $com->BuscarPagosVencidosReportes();

  ?>

   <div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-tasks"></i> Consulta de Pagos Vencidos del Periodo <?php echo $com[0]['periodo']; ?></h3>
</div>

<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">

<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
												 <tr role="row">
													<th>Nº</th>
													<th>Nombres y Apellidos de Estudiante</th>
													<th>Meses Vencidos</th>
													<th>Interés por Mora</th>
													<th>Cuota por Mes</th>
                          <th>Pago Total</th>
												   </tr>
												 </thead>
												 <tbody>
<?php 
$a=1;
$pagoTotal=0;
for($i=0;$i<sizeof($com);$i++){ 
$pagoTotal+=($com[$i]['montopago']+$com[$i]['interesmora'])*count(explode(", ",$com[$i]['meses']));  
?>
                                               <tr role="row" class="odd">
											   <td class="sorting_1" tabindex="0"><?php echo $a++; ?></td>
<td><abbr title="<?php echo "Nº de Código: ".$com[$i]['cedula']; ?>"><?php echo $com[$i]['pNombre']." ".$com[$i]['sNombre']." ".$com[$i]['pApellido']." ".$com[$i]['sApellido']; ?></abbr></td>
											   <td><?php echo convertir($com[$i]["meses"]); ?></td>
											   <td><?php echo $com[$i]["interesmora"]; ?></td>
											   <td><?php echo number_format($com[$i]['montopago'], 2, '.', ','); ?></td>
                         <td><?php echo number_format(($com[$i]['montopago']+$com[$i]['interesmora'])*count(explode(", ",$com[$i]['meses'])), 2, '.', ','); ?></td>
											   </tr>
											   <?php  }  ?>
                        <tr role="row">
                      <td colspan="4" class="sorting_1" tabindex="0">&nbsp;</td>
                      <td><strong>Monto Total</strong></td>
                      <td><strong><?php echo number_format($pagoTotal, 2, '.', ','); ?></strong></td>
                         </tr>
											   </tbody>
</table>
           <div align="center">
<a href="reportepdf?codseccion=<?php echo $codseccion; ?>&codturno=<?php echo $codturno; ?>&codperiodo=<?php echo $codperiodo; ?>&tipo=<?php echo base64_encode("PAGOSVENCIDOS") ?>" target="_blank" rel="noopener noreferrer"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>
													
<a href="reporteexcel?codseccion=<?php echo $codseccion; ?>&codturno=<?php echo $codturno; ?>&codperiodo=<?php echo $codperiodo; ?>&tipo=<?php echo base64_encode("PAGOSVENCIDOS") ?>"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-excel-o"></span> Exportar Excel</button> </a>	

<a href="reportepdf?codseccion=<?php echo $codseccion; ?>&codturno=<?php echo $codturno; ?>&codperiodo=<?php echo $codperiodo; ?>&tipo=<?php echo base64_encode("AVISOCOBRANZA") ?>" target="_blank" rel="noopener noreferrer"><button class="btn btn-danger btn-lg" type="button"><span class="fa fa-exclamation-triangle"></span> Aviso de Cobranza</button> </a>                    
                                   </div><br />        
                               </div>
                           </div>
                      </div>
                   </div>
               </div>
           </div>
        </div>
     </div>
 </div>
  <?php
     }
 } 
############################# BUSQUEDA DE PAGOS VENCIDOS PARA REPORTES #######################
?>






























<?php
############################# FUNCION PARA VERIFICA NOTAS NUEVOS INSCRITOS ###########################
if (isset($_GET['BuscaEstudiantesNuevaNota']) && isset($_GET['codest'])) {

$codest = $_GET['codest'];

  if($codest==""){

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR REALICE LA BÚSQUEDA DEL ESTUDIANTE CORRECTAMENTE</center>";
  echo "</div>";    
  exit;

  } else { 
  
$reg = $new->BuscarEstudianteNuevaNota();
 
       ?>

       <div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Datos del Estudiante</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12">
   <div class="box-body">

                        <div class="row"> 
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
<label class="control-label">Nº de DNI de Estudiante: <span class="symbol required"></span></label>
<input type="hidden" name="codest" id="codest" value="<?php echo $reg[0]['codest']; ?>">
<input type="hidden" name="cedest" id="cedest" value="<?php echo $reg[0]['cedest']; ?>">
<input type="hidden" name="codperiodo" id="codperiodo" value="<?php echo $reg[0]['codperiodo']; ?>">
<input type="hidden" name="becado" id="becado" value="<?php echo $reg[0]['becado']; ?>">
<br /><abbr title="Código de Estudiante"><?php echo $reg[0]['cedest']; ?></abbr>
                          
                                                                </div> 
                                                            </div>
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
   <label class="control-label">Apellidos y Nombres: <span class="symbol required"></span></label> 
<br /><abbr title="Nombres del Estudiante"><?php echo $reg[0]['papeest']." ".$reg[0]['sapeest']." ".$reg[0]['pnomest']." ".$reg[0]['snomest']; ?></abbr>
                                                                </div> 
                                                            </div>
                            <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Nivel: <span class="symbol required"></span></label> 
<br /><abbr title="Nivel del Estudiante"><?php echo $reg[0]['nivel']; ?></abbr>
                                                                </div> 
                                                            </div>    
                    </div>
          
           <div class="row"> 
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Grado y Sección: <span class="symbol required"></span></label> 
<br /><abbr title="Grado y Secciónn del Estudiante"><?php echo $reg[0]['grado']." / SECCI&Oacute;N '".$reg[0]['seccion']."'"; ?></abbr>
                                                                </div> 
                                                            </div> 

                           <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Turno: <span class="symbol required"></span></label> 
<br /><abbr title="Turno del Estudiante"><?php echo $reg[0]['turno']; ?></abbr>
                                                                </div> 
                                                            </div> 
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Becado: <span class="symbol required"></span></label> 
<br /><abbr title="Becado"><?php echo $reg[0]['becado']; ?></abbr>  
                                                                </div> 
                                                            </div>
                     </div> 
           
           <div class="row"> 
                             <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Periodo Escolar: <span class="symbol required"></span></label> 
<br /><abbr title="Periodo Escolar Inscrito"><?php echo $reg[0]['periodo']; ?></abbr>  
                                                                </div> 
                                                            </div>
                           <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Fecha de Inscripción: <span class="symbol required"></span></label> 
<br /><abbr title="Fecha de Inscripción"><?php echo date("d-m-Y",strtotime($reg[0]['fechainscripcion'])); ?></abbr>
                                                                </div> 
                                                            </div>

                           <div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
  <label class="control-label">Edad: <span class="symbol required"></span></label> 
  <br /><abbr title="Edad"><?php echo edad($reg[0]['fnacest'])." A&Ntilde;OS"; ?></abbr>
                                                                </div> 
                                                            </div>                             
                     </div> 
           
           <div class="row"> 

                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
<label class="control-label">Nº de DNI Padre/Tutor: <span class="symbol required"></span></label> 
<br /><abbr title="NIT/CI Padre/Tutor"><?php echo $reg[0]['cedpadre']; ?></abbr>  
                                                                </div> 
                                                            </div>

              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Nombres y Apellidos Padre/Tutor: <span class="symbol required"></span></label> 
<br /><abbr title="Nombres y Apellidos Padre/Tutor"><?php echo $reg[0]['nompadre']." ".$reg[0]['apepadre']; ?></abbr> 
                                                                </div> 
                                                            </div>
                              
              <div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Nº de Teléfono: <span class="symbol required"></span></label> 
<br /><abbr title="Nº de Teléfono"><?php echo $reg[0]['tlfpadre']; ?></abbr>  
                                                                </div> 
                                                            </div>    
                              </div>

                              <hr>
                                   
                    <div align="center">
<a class="btn btn-success btn-lg" title="Verifica Nota" onClick="VerificaNuevaNota('<?php echo base64_encode($reg[0]["codest"]); ?>','<?php echo base64_encode($reg[0]["codseccion"]); ?>','<?php echo base64_encode($reg[0]["codturno"]); ?>','<?php echo base64_encode($reg[0]["codperiodo"]); ?>')"><i class="fa fa-history"></i> Verifica Notas</a>
                    </div>

                                  </div><!-- /.box-body -->
                              </div>
                          </div>
                     </div>
                </div>
           </div>
      </div>
<?php   
      }
  }
############################# FUNCION PARA VERIFICA NOTAS NUEVOS INSCRITOS ###########################
?>

<?php
############################# FUNCION PARA VERIFICA NOTAS NUEVOS INSCRITOS #2 ##########################
if (isset($_GET['VerificaNuevaNota']) && isset($_GET['codest']) && isset($_GET['codseccion']) && isset($_GET['codturno']) && isset($_GET['codperiodo'])) {

   $codest = $_GET['codest'];
   $trimestre = $con[0]['trimestreactivo'];

  if($codest==""){

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR REALICE LA B&Uacute;SQUEDA DEL ESTUDIANTE CORRECTAMENTE</center>";
  echo "</div>";    
  exit;

  } else { 
  
  $nota = new Login();
  $nota = $nota->VerificaNotasEstudiantes();
 
       ?>
     
<input name="trimestre" type="hidden" id="trimestre" value="<?php echo $trimestre; ?>"/>
<input name="codturno" type="hidden" id="codturno" value="<?php echo $nota[0]['codturno']; ?>"/>
<input name="codnivel" type="hidden" id="codnivel" value="<?php echo $nota[0]['codnivel']; ?>"/>
<input name="nivel" type="hidden" id="nivel" value="<?php echo $nota[0]['nivel']; ?>"/>
<input name="codgrado" type="hidden" id="codgrado" value="<?php echo $nota[0]['codgrado']; ?>"/>
<input name="codseccion" type="hidden" id="codseccion" value="<?php echo $nota[0]['codseccion']; ?>"/>
<input name="codperiodo" type="hidden" id="codperiodo" value="<?php echo $per[0]['codperiodo']; ?>"/>

<?php
if($nota[0]['nivel']=="INICIAL"){
?>

<div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-edit"></i> Gestión de Notas en <?php echo $nota[0]['nivel']; ?> - <?php echo $nota[0]['grado']; ?> Sección <?php echo $nota[0]['seccion']; ?> del Periodo <?php echo $nota[0]['periodo']; ?></h3>
</div>

<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">

<div id="div"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
                        <tr role="row">
                        <th>N&deg;</th>
                        <th>Nombres y Apellidos del Estudiante</th>
                        <?php if ($trimestre == 1) { ?>
                          <th>1er Trimestre</th>
                        <?php } elseif ($trimestre == 2) { ?>
                          <th>2do Trimestre</th>
                        <?php } elseif ($trimestre == 3) { ?>
                          <th>3er Trimestre</th>
                        <?php } ?>
                         </tr>
                         </thead>
                         <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($nota);$i++){
?>

                                               <tr role="row" class="odd">
<td><?php echo $a++; ?></td>

<td><input type="hidden" name="codmateria[]" id="codmateria" value="<?php echo $nota[$i]['codmateria']; ?>"/><input type="hidden" name="coddoc[]" id="coddoc" value="<?php echo $nota[$i]['coddoc']; ?>"/><abbr title="<?php echo "Nº de Materia: ".$nota[$i]['codmateria']; ?>"><?php echo $nota[$i]['nommateria']; ?></abbr></td>         


         <?php if ($trimestre == 0) { ?>

<!-- PROCESO NOTA 1 -->
<td align="center"><?php echo "<h5>0</h5>"; ?></td>

<!-- PROCESO NOTA 2 -->
<td align="center"><?php echo "<h5>0</h5>"; ?></td>

<!-- PROCESO NOTA 3 -->
<td align="center"><?php echo "<h5>0</h5>"; ?></td>

                        <?php } ?>

<td align="center"><textarea class="form-control" style="width: 520px;height: 50px;" name="nota1[]" id="nota" onfocus="this.style.background=('#B7F0FF')" onBlur="this.style.background=('#FFF')" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Valoraci&oacute;n del 1er Trimestre"></textarea></td>


                         </tr>
                         <?php  }  ?>
                         </tbody>
</table></div>
                </div><br />

<?php if ($trimestre != 0) { ?>
                <div class="text-right">
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><span class="fa fa-save"></span> Guardar</button>
            </div>
<?php } ?>
                              
                           </div><!-- /.box-body -->
                        </div>
                     </div>
                  </div>
               </div>
           </div>
      </div>

<?php } else { ?>

<div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-edit"></i> Gestión de Notas a Nuevos Inscritos del Periodo <?php echo $nota[0]['periodo']; ?></h3>
</div>

<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">

<div id="div"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
                         <tr role="row">
                          <th>Nº</th>
                          <th>Nombre de Materia</th>
                          <th>1er Trimestre</th>
                          <th>2do Trimestre</th>
                          <th>3er Trimestre</th>
                          <th>Definitiva</th>
                         </tr>
                         </thead>
                         <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($nota);$i++){  
?>
                                               <tr role="row" class="odd">
                         <td><?php echo $a++; ?></td>
<td><input type="hidden" name="codmateria[]" id="codmateria" value="<?php echo $nota[$i]['codmateria']; ?>"/><input type="hidden" name="coddoc[]" id="coddoc" value="<?php echo $nota[$i]['coddoc']; ?>"/><abbr title="<?php echo "Nº de Materia: ".$nota[$i]['codmateria']; ?>"><?php echo $nota[$i]['nommateria']; ?></abbr></td>          

<!-- PROCESO NOTA 1 -->
<td align="center"><label class="label"><input class="form-control" style="width: 70px;" name="nota1[]" id="nota" onfocus="this.style.background=('#B7F0FF')" onBlur="this.style.background=('#FFF')" type="text" size="3" maxlength="3" onchange="cambio(this)" autocomplete="off" placeholder="Nº1"/></label></td>


<!-- PROCESO NOTA 2 -->
<td align="center"><?php echo "<h5>0</h5>"; ?></td>

<!-- PROCESO NOTA 3 -->
<td align="center"><?php echo "<h5>0</h5>"; ?></td>

<!-- PROCESO DEFINITIVA -->
<td align="center"><?php echo "<h5>0</h5>"; ?></td>
                         </tr>
                         <?php  }  ?>
                         </tbody>
</table></div>
                </div><br />

<?php if ($trimestre != 0) { ?>
                <div class="text-right">
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><span class="fa fa-save"></span> Guardar</button>
            </div>
<?php } ?>
                               
                            </div><!-- /.box-body -->
                        </div>
                     </div>
                  </div>
               </div>
           </div>
      </div>
  <?php
      }
   }
 } 
############################# FUNCION PARA VERIFICA NOTAS NUEVOS INSCRITOS #2 ##########################
?>































<?php
######################### BUSQUEDA ESTUDIANTES PARA REGISTRAR NOTAS ########################
if (isset($_GET['BuscaEstudiantesNotas']) && isset($_GET['codturno']) && isset($_GET['codnivel']) && isset($_GET['codgrado']) && isset($_GET['codseccion']) && isset($_GET['codmateria'])) { 
  
   $codturno = $_GET['codturno'];
   $codnivel = $_GET['codnivel'];
   $codgrado = $_GET['codgrado'];
   $codseccion = $_GET['codseccion'];
   $codmateria = $_GET['codmateria'];
   $trimestre = $con[0]['trimestreactivo'];

 if($codturno=="") {

     echo "<div class='alert alert-danger'>";
     echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE TURNO PARA TU BÚSQUEDA</center>";
     echo "</div>";   
   exit;
    
 } elseif($codnivel=="") {

     echo "<div class='alert alert-danger'>";
     echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE NIVEL PARA TU BÚSQUEDA</center>";
     echo "</div>";   
   exit;
   
   } elseif($codgrado=="") {

     echo "<div class='alert alert-danger'>";
     echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE GRADO PARA TU BÚSQUEDA</center>";
     echo "</div>";   
   exit;
   
   } elseif($codseccion=="") {

     echo "<div class='alert alert-danger'>";
     echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE SECCIÓN PARA TU BÚSQUEDA</center>";
     echo "</div>";   
   exit;
   
   } elseif($codmateria=="") {

     echo "<div class='alert alert-danger'>";
     echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE MATERIA PARA TU BÚSQUEDA</center>";
     echo "</div>";   
   exit;
   
   } elseif($trimestre=="") {

     echo "<div class='alert alert-danger'>";
     echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     echo "<center><span class='fa fa-info-circle'></span> NO EXISTEN TRIMESTRE ACTIVO PARA REGISTRO DE NOTAS</center>";
     echo "</div>";   
   exit;
   
   } else {

$nota = new Login();
$nota = $nota->ProcesarNotasEstudiantes();

$materia = new Login();
$materia = $materia->MateriasId();

  ?>
     
<input name="trimestre" type="hidden" id="trimestre" value="<?php echo $trimestre; ?>"/>
<input name="codperiodo" type="hidden" id="codperiodo" value="<?php echo $per[0]['codperiodo']; ?>"/>
<input name="nivel" type="hidden" id="nivel" value="<?php echo $nota[0]['nivel']; ?>"/>
<input type="hidden" name="update" value="ok" />

<?php
if($nota[0]['nivel']=="INICIAL"){
?>

<div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-edit"></i> Gestión de Notas en <?php echo $nota[0]['nivel']; ?> - <?php echo $nota[0]['grado']; ?> Sección <?php echo $nota[0]['seccion']; ?> del Periodo <?php echo $nota[0]['periodo']; ?></h3>
</div>

<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">

<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
                        <tr role="row">
            <th colspan="3"><?php echo "<h5><center>".$materia[0]['nommateria']."</center></h5>"; ?></th>
                           </tr>
                         <tr role="row">
                          <th>N&deg;</th>
                          <th>Apellidos y Nombres del Estudiante</th>
                          
                        <?php if ($trimestre == 1) { ?>
                          <th>1er Trimestre</th>
                        <?php } elseif ($trimestre == 2) { ?>
                          <th>2do Trimestre</th>
                        <?php } elseif ($trimestre == 3) { ?>
                          <th>3er Trimestre</th>
                        <?php } ?>
                         </tr>
                         </thead>
                         <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($nota);$i++){
?>

                                               <tr role="row" class="odd">
<td><input name="codest[]" type="hidden" id="codest" value="<?php echo $nota[$i]['codest']; ?>"/>
<?php echo $a++; ?></td>

<td><abbr title="<?php echo "N&deg; de C&oacute;digo : ".$nota[$i]['cedest']; ?>"><?php echo $nota[$i]['papeest']." ".$nota[$i]['sapeest']." ".$nota[$i]['pnomest']." ".$nota[$i]['snomest']; ?></abbr></td> 


                        <?php if ($trimestre == 0) { ?>

<!-- PROCESO NOTA 1 -->
<td align="center"><?php echo "<h5>".$nota[$i]['nota1']."</h5>"; ?></td>

<!-- PROCESO NOTA 2 -->
<td align="center"><?php echo "<h5>".$nota[$i]['nota2']."</h5>"; ?></td>

<!-- PROCESO NOTA 3 -->
<td align="center"><?php echo "<h5>".$nota[$i]['nota3']."</h5>"; ?></td>


                        <?php } elseif ($trimestre == 1) { ?>
<td align="center"><textarea class="form-control" style="width: 520px;height: 50px;" name="nota1[]" id="nota" onfocus="this.style.background=('#B7F0FF')" onBlur="this.style.background=('#FFF')" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Valoraci&oacute;n del 1er Trimestre"><?php if (isset($nota[$i]['nota1'])) { echo $nota[$i]['nota1'];  } ?></textarea></td>
                        <?php } elseif ($trimestre == 2) { ?>
<td align="center"><textarea class="form-control" style="width: 520px;height: 50px;" name="nota2[]" id="nota" onfocus="this.style.background=('#B7F0FF')" onBlur="this.style.background=('#FFF')" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Valoraci&oacute;n del 2do Trimestre"><?php if (isset($nota[$i]['nota2'])) { echo $nota[$i]['nota2'];  } ?></textarea></td>
                        <?php } elseif ($trimestre == 3) { ?>
<td align="center"><textarea class="form-control" style="width: 520px;height: 50px;" name="nota3[]" id="nota" onfocus="this.style.background=('#B7F0FF')" onBlur="this.style.background=('#FFF')" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Valoraci&oacute;n del 3er Trimestre"><?php if (isset($nota[$i]['nota3'])) { echo $nota[$i]['nota3'];  } ?></textarea></td>
                        <?php } ?>

                         </tr>
                         <?php  }  ?>
                         </tbody>
</table></div>
                </div><br />

<?php if ($trimestre != 0) { ?>
                <div class="text-right">
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><span class="fa fa-save"></span> Guardar</button>
            </div>
<?php } ?>
                           </div><!-- /.box-body -->
                        
                     </div>
                  </div>
               </div>
           </div>
      </div>
  </div>

<?php } else { ?>

<div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-edit"></i> Gestión de Notas en <?php echo $nota[0]['nivel']; ?> - <?php echo $nota[0]['grado']; ?> Sección <?php echo $nota[0]['seccion']; ?> del Periodo <?php echo $nota[0]['periodo']; ?></h3>
</div>

<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">

<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
                         <tr role="row">
                           <th rowspan="2">Nº</th>
                           <th rowspan="2">Apellidos y Nombres del Estudiante</th>
<th colspan="4"><center><?php echo "<h5><center>".$materia[0]['nommateria']."</center></h5>"; ?></center></th>
                           </tr>
                         <tr role="row">
                          <th>1er Trimestre</th>
                          <th>2do Trimestre</th>
                          <th>3er Trimestre</th>
                          <th>Definitiva</th>
                         </tr>
                         </thead>
                         <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($nota);$i++){  
?>
                                               <tr role="row" class="odd">
                         <td><?php echo $a++; ?></td>
<td><input name="codest[]" type="hidden" id="codest" value="<?php echo $nota[$i]['codest']; ?>"/><abbr title="<?php echo "Nº de Código: ".$nota[$i]['cedest']; ?>"><?php echo $nota[$i]['papeest']." ".$nota[$i]['sapeest']." ".$nota[$i]['pnomest']." ".$nota[$i]['snomest']; ?></abbr></td>          



<!-- PROCESO NOTA 1 -->
<?php if ($trimestre != 1) { ?>

<td align="center"><?php echo $nota1 = ( $nota[$i]['nota1'] <= '50' && $nota[$i]['nota1'] > '0' ? "<h5><font color='red'>".$nota[$i]['nota1']."</font color></h5>" : "<h5>".$nota[$i]['nota1']."</h5>"); ?></td>

<?php } else { ?>

<td align="center"><label class="label"><input class="form-control" style="width: 70px;" name="nota1[]" id="nota" onfocus="this.style.background=('#B7F0FF')" onBlur="this.style.background=('#FFF')" type="text" size="3" maxlength="3" onchange="cambio(this)" autocomplete="off" placeholder="Nº1" <?php if (isset($nota[$i]['nota1'])) { ?> value="<?php echo $nota[$i]['nota1']; ?>"<?php } ?>/></label></td>

<?php } ?> 



<!-- PROCESO NOTA 2 -->
<?php if ($trimestre != 2) { ?>

<td align="center"><?php echo $nota2 = ( $nota[$i]['nota2'] <= '50' && $nota[$i]['nota2'] > '0' ? "<h5><font color='red'>".$nota[$i]['nota2']."</font color></h5>" : "<h5>".$nota[$i]['nota2']."</h5>"); ?></td>

<?php } else { ?>

<td align="center"><label class="label"><input class="form-control" style="width: 70px;" name="nota2[]" id="nota" onfocus="this.style.background=('#B7F0FF')" onBlur="this.style.background=('#FFF')" type="text" size="3" maxlength="3" onchange="cambio(this)" autocomplete="off" placeholder="Nº2" <?php if (isset($nota[$i]['nota2'])) { ?> value="<?php echo $nota[$i]['nota2']; ?>"<?php } ?>/></label></td>

<?php } ?>


<!-- PROCESO NOTA 3 -->
<?php if ($trimestre != 3) { ?>

<td align="center"><?php echo $nota3 = ( $nota[$i]['nota3'] <= '50' && $nota[$i]['nota3'] > '0' ? "<h5><font color='red'>".$nota[$i]['nota3']."</font color></h5>" : "<h5>".$nota[$i]['nota3']."</h5>"); ?></td>

<?php } else { ?>

<td align="center"><label class="label"><input class="form-control" style="width: 70px;" name="nota3[]" id="nota" onfocus="this.style.background=('#B7F0FF')" onBlur="this.style.background=('#FFF')" type="text" size="3" maxlength="3" onchange="cambio(this)" autocomplete="off" placeholder="Nº3" <?php if (isset($nota[$i]['nota3'])) { ?> value="<?php echo $nota[$i]['nota3']; ?>"<?php } ?>/></label></td>

<?php } ?>


<!-- PROCESO DEFINITIVA -->
<td align="center"><?php echo $definitiva = ( $nota[$i]['definitiva'] <= '50' && $nota[$i]['definitiva'] > '0' ? "<h5><font color='red'>".$nota[$i]['definitiva']."</font color></h5>" : "<h5>".$nota[$i]['definitiva']."</h5>"); ?></td>
                         </tr>
                         <?php  }  ?>
                         </tbody>
</table></div>
                </div><br />
                
<?php if ($trimestre != 0) { ?>
                <div class="text-right">
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><span class="fa fa-save"></span> Guardar</button>
            </div>
<?php } ?>
                           </div><!-- /.box-body -->
                        
                     </div>
                  </div>
               </div>
           </div>
      </div>
  </div>
  <?php
      }
   }
 } 
######################### BUSQUEDA ESTUDIANTES PARA REGISTRAR NOTAS ########################
?>

<?php
######################## FUNCION PARA BUSQUEDA NOTAS POR ESTUDIANTES #########################
if (isset($_GET['BuscaNotas']) && isset($_GET['codest']) && isset($_GET['c'])) {

$codest = $_GET['codest'];
$c = $_GET['c'];

  if($codest==""){

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR REALICE LA BÚSQUEDA DEL ESTUDIANTE CORRECTAMENTE</center>";
  echo "</div>";    
  exit;

   } else { 
  
$reg = $new->BuscarNotasEstudiantes();

       ?>

       <div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Datos del Estudiante</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12">
   <div class="box-body">

                        <div class="row"> 
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
<label class="control-label">Código de Estudiante: <span class="symbol required"></span></label>
<br /><abbr title="Código de Estudiante"><?php echo $reg[0]['cedest']; ?></abbr>
                          
                                                                </div> 
                                                            </div>
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
   <label class="control-label">Apellidos y Nombres: <span class="symbol required"></span></label> 
<br /><abbr title="Apellidos y Nombres del Estudiante"><?php echo $reg[0]['pnomest']." ".$reg[0]['snomest']." ".$reg[0]['papeest']." ".$reg[0]['sapeest']; ?></abbr>
                                                                </div>
                                                            </div>
                            <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Nivel: <span class="symbol required"></span></label> 
<br /><abbr title="Nivel del Estudiante"><?php echo $reg[0]['nivel']; ?></abbr>
                                                                </div> 
                                                            </div>    
                    </div>
          
           <div class="row"> 
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Grado y Sección: <span class="symbol required"></span></label> 
<br /><abbr title="Grado y Sección del Estudiante"><?php echo $reg[0]['grado']." / SECCI&Oacute;N '".$reg[0]['seccion']."'"; ?></abbr>
                                                                </div> 
                                                            </div> 

                           <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Turno: <span class="symbol required"></span></label> 
<br /><abbr title="Turno del Estudiante"><?php echo $reg[0]['turno']; ?></abbr>
                                                                </div> 
                                                            </div> 
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Becado: <span class="symbol required"></span></label> 
<br /><abbr title="Becado"><?php echo $reg[0]['becado']; ?></abbr>  
                                                                </div> 
                                                            </div>
                     </div> 
           
           <div class="row"> 
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Periodo Escolar: <span class="symbol required"></span></label> 
<br /><abbr title="Periodo Escolar Inscrito"><?php echo $reg[0]['periodo']; ?></abbr>  
                                                                </div> 
                                                            </div>

                           <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Fecha de Inscripción: <span class="symbol required"></span></label> 
<br /><abbr title="Fecha de Nacimiento"><?php echo date("d-m-Y",strtotime($reg[0]['fechainscripcion'])); ?></abbr>
                                                                </div> 
                                                            </div>

                           <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Edad: <span class="symbol required"></span></label> 
<br /><abbr title="Edad"><?php echo edad($reg[0]['fnacest'])." A&Ntilde;OS"; ?></abbr>
                                                                </div> 
                                                            </div>                
                     </div> 
           
           <div class="row"> 
                             <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
<label class="control-label">NIT/CI Padre/Tutor: <span class="symbol required"></span></label> 
<br /><abbr title="NIT/CI Padre/Tutor"><?php echo $reg[0]['cedpadre']; ?></abbr>  
                                                                </div> 
                                                            </div>                             
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Nombres y Apellidos Padre/Tutor: <span class="symbol required"></span></label> 
<br /><abbr title="Nombres y Apellidos Padre/Tutor"><?php echo $reg[0]['nompadre']." ".$reg[0]['apepadre']; ?></abbr> 
                                                                </div> 
                                                            </div>
                              
              <div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Nº de Teléfono: <span class="symbol required"></span></label> 
<br /><abbr title="Nº de Teléfono"><?php echo $reg[0]['tlfpadre']; ?></abbr>  
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
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-edit"></i> Control de Notas del Periodo <?php echo $reg[0]['periodo']; ?></h3>
</div>

<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">

<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
                          <tr role="row">
                          <th>Nº</th>
                          <th>Nombre de Materia</th>
                          <th>1er Trimestre</th>
                          <th>2do Trimestre</th>
                          <th>3er Trimestre</th>
<?php if ($reg[0]['nivel'] != "INICIAL") { ?><th>Definitiva</th><?php } ?>
                         </tr>
                         </thead>
                         <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                         <td><?php echo $a++; ?></td>
<td><abbr title="<?php echo "Código : ".$reg[$i]['codmateria']; ?>"><?php echo $reg[$i]['nommateria']; ?></abbr></td>          


<!-- PROCESO NOTA 1 -->
<td align="center"><?php echo $nota1 = ( $reg[$i]['nota1'] <= '50' && $reg[$i]['nota1'] > '0' ? "<h5><font color='red'>".$reg[$i]['nota1']."</font color></h5>" : "<h5>".$reg[$i]['nota1']."</h5>"); ?></td>

<!-- PROCESO NOTA 2 -->
<td align="center"><?php echo $nota2 = ( $reg[$i]['nota2'] <= '50' && $reg[$i]['nota2'] > '0' ? "<h5><font color='red'>".$reg[$i]['nota2']."</font color></h5>" : "<h5>".$reg[$i]['nota2']."</h5>"); ?></td>

<!-- PROCESO NOTA 3 -->
<td align="center"><?php echo $nota3 = ( $reg[$i]['nota3'] <= '50' && $reg[$i]['nota3'] > '0' ? "<h5><font color='red'>".$reg[$i]['nota3']."</font color></h5>" : "<h5>".$reg[$i]['nota3']."</h5>"); ?></td>

<?php if ($reg[0]['nivel'] != "INICIAL") { ?>
<!-- PROCESO DEFINITIVA -->
<td align="center"><?php echo $definitiva = ( $reg[$i]['definitiva'] <= '50' && $reg[$i]['definitiva'] > '0' ? "<h5><font color='red'>".$reg[$i]['definitiva']."</font color></h5>" : "<h5>".$reg[$i]['definitiva']."</h5>"); ?></td>
<?php } ?>
                         </tr>
                         <?php  }  ?>
                         </tbody>
</table></div><br />

<div align="center">
<a href="reportepdf?codest=<?php echo $codest; ?>&tipo=<?php echo base64_encode("BOLETA") ?>" target="_blank" rel="noopener noreferrer"><button class="btn btn-warning btn-lg" type="button"><span class="fa fa-files-o"></span> Imprimir Boleta</button></a>                    
          </div> 

                                    
                                </div>
                           </div><!-- /.box-body -->
                        </div>
                     </div>
                  </div>
               </div>
           </div>
      </div>
<?php           
      }
  }
######################## FUNCION PARA BUSQUEDA NOTAS POR ESTUDIANTES #########################
?>


<?php
######################### FUNCION PARA BUSQUEDA NOTAS POR CURSOS ########################
if (isset($_GET['BuscaNotasxCursos']) && isset($_GET['codturno']) && isset($_GET['codnivel']) && isset($_GET['codgrado']) && isset($_GET['codseccion'])) { 
  
   $codturno = $_GET['codturno'];
   $codnivel = $_GET['codnivel'];
   $codgrado = $_GET['codgrado'];
   $codseccion = $_GET['codseccion'];
   

 if($codturno=="") {

     echo "<div class='alert alert-danger'>";
     echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE TURNO PARA TU BÚSQUEDA</center>";
     echo "</div>";   
   exit;
    
} elseif($codnivel=="") {

     echo "<div class='alert alert-danger'>";
     echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE NIVEL PARA TU BÚSQUEDA</center>";
     echo "</div>";   
   exit;
   
   } elseif($codgrado=="") {

     echo "<div class='alert alert-danger'>";
     echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE GRADO PARA TU BÚSQUEDA</center>";
     echo "</div>";   
   exit;
   
   } elseif($codseccion=="") {

     echo "<div class='alert alert-danger'>";
     echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE SECCI&Oacute;N PARA TU BÚSQUEDA</center>";
     echo "</div>";   
   exit;
    
} else {

$nota = new Login();
$nota = $nota->BuscarNotasxCursos();

  ?>

   <div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-tasks"></i> Consulta de Notas de <?php echo $nota[0]['nivel']; ?> - <?php echo $nota[0]['grado']; ?> Sección <?php echo $nota[0]['seccion']; ?> del Periodo <?php echo $nota[0]['periodo']; ?></h3>
</div>

<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">

<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
                         <tr role="row">
                          <th>Nº</th>
                          <th>Código</th>
                          <th>Nombres</th>
                          <th>Apellidos</th>
                          <th>Nombres de Padre/Tutor</th>
                          <th>Boletín</th>
                         </tr>
                         </thead>
                         <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($nota);$i++){  
?>
                                               <tr role="row" class="odd">
                         <td class="sorting_1" tabindex="0"><?php echo $a++; ?></td>
                         <td><?php echo $nota[$i]['cedest']; ?></td>
                         <td><?php echo $nota[$i]['pnomest']." ".$nota[$i]['snomest']; ?></td>
                         <td><?php echo $nota[$i]['papeest']." ".$nota[$i]['sapeest']; ?></td>
                         <td><?php echo $nota[$i]['cedpadre']." : ".$nota[$i]['nompadre']." ".$nota[$i]['apepadre']; ?></td>
                         <td><div align="center">
<a href="reportepdf?codest=<?php echo $nota[$i]['codest']; ?>&tipo=<?php echo base64_encode("BOLETA") ?>&c=<?php echo base64_encode("v") ?>" class="btn btn-success btn-xs" title="Imprimir PDF" target="_blank"><i class="fa fa-file-pdf-o"></i></a></div></td>
                         </tr>
                         <?php  }  ?>
                         </tbody>
</table>

<!--<div align="center">
<a href="reportepdf?codseccion=<?php echo $codseccion; ?>&codturno=<?php echo $codturno; ?>&tipo=<?php echo base64_encode("BOLETAXCURSOS") ?>" target="_blank" rel="noopener noreferrer"><button class="btn btn-warning btn-lg" type="button"><span class="fa fa-files-o"></span> Imprimir Boletas</button></a>                    </div> -->

                                 </div><br />
                               </div>
                           </div><!-- /.box-body -->
                        </div>
                     </div>
                  </div>
               </div>
           </div>
      </div>
  <?php
   }
 } 
######################### FUNCION PARA BUSQUEDA NOTAS POR CURSOS ########################
?>

<?php
######################### FUNCION PARA BUSQUEDA NOTAS POR PERIODOS ########################
if (isset($_GET['BuscaNotasxPeriodos']) && isset($_GET['codest']) && isset($_GET['codperiodo'])) {

$codest = $_GET['codest'];
$codperiodo = $_GET['codperiodo'];

  if($codest==""){

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR REALICE LA BÚSQUEDA DEL ESTUDIANTE CORRECTAMENTE</center>";
  echo "</div>";    
  exit;
      
  } elseif ($codperiodo==""){

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE PERIODO ESCOLAR PARA TU BÚSQUEDA</center>";
  echo "</div>";    
  exit;

           } else { 
  
$reg = $new->BuscarNotasxPeriodos();

       ?>

       <div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Datos del Estudiante</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12">
   <div class="box-body">

                        <div class="row"> 
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
<label class="control-label">Código de Estudiante: <span class="symbol required"></span></label>
<br /><abbr title="Código de Estudiante"><?php echo $reg[0]['cedest']; ?></abbr>
                          
                                                                </div> 
                                                            </div>
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
   <label class="control-label">Apellidos y Nombres: <span class="symbol required"></span></label> 
<br /><abbr title="Nombres del Estudiante"><?php echo $reg[0]['papeest']." ".$reg[0]['sapeest']." ".$reg[0]['pnomest']." ".$reg[0]['snomest']; ?></abbr>
                                                                </div> 
                                                            </div>
                            <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Nivel: <span class="symbol required"></span></label> 
<br /><abbr title="Nivel del Estudiante"><?php echo $reg[0]['nivel']; ?></abbr>
                                                                </div> 
                                                            </div>    
                    </div>
          
           <div class="row"> 
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Grado y Sección: <span class="symbol required"></span></label> 
<br /><abbr title="Grado y Secciónn del Estudiante"><?php echo $reg[0]['grado']." / SECCI&Oacute;N '".$reg[0]['seccion']."'"; ?></abbr>
                                                                </div> 
                                                            </div> 

                           <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Turno: <span class="symbol required"></span></label> 
<br /><abbr title="Turno del Estudiante"><?php echo $reg[0]['turno']; ?></abbr>
                                                                </div> 
                                                            </div> 
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Becado: <span class="symbol required"></span></label> 
<br /><abbr title="Becado"><?php echo $reg[0]['becado']; ?></abbr>  
                                                                </div> 
                                                            </div>
                     </div> 
           
           <div class="row">
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Periodo Escolar: <span class="symbol required"></span></label> 
<br /><abbr title="Periodo Escolar Inscrito"><?php echo $reg[0]['periodo']; ?></abbr>  
                                                                </div> 
                                                            </div>
 
                           <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Fecha de Inscripción: <span class="symbol required"></span></label> 
<br /><abbr title="Fecha de Inscripción"><?php echo date("d-m-Y",strtotime($reg[0]['fechainscripcion'])); ?></abbr>
                                                                </div> 
                                                            </div> 
 
                           <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Edad: <span class="symbol required"></span></label> 
<br /><abbr title="Edad"><?php echo edad($reg[0]['fnacest'])." A&Ntilde;OS"; ?></abbr>
                                                                </div> 
                                                            </div> 


 </div> 
           
           <div class="row"> 
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
<label class="control-label">NIT/CI Padre/Tutor: <span class="symbol required"></span></label> 
<br /><abbr title="NIT/CI Padre/Tutor"><?php echo $reg[0]['cedpadre']; ?></abbr>  
                                                                </div> 
                                                            </div>
                    
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Nombres y Apellidos Padre/Tutor: <span class="symbol required"></span></label> 
<br /><abbr title="Nombres y Apellidos Padre/Tutor"><?php echo $reg[0]['nompadre']." ".$reg[0]['apepadre']; ?></abbr> 
                                                                </div> 
                                                            </div> 
                              
              <div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Nº de Teléfono: <span class="symbol required"></span></label> 
<br /><abbr title="Nº de Teléfono"><?php echo $reg[0]['tlfpadre']; ?></abbr>  
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
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-edit"></i> Control de Notas del Periodo <?php echo $reg[0]['periodo']; ?></h3>
</div>

<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">

<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
                          <tr role="row">
                          <th>Nº</th>
                          <th>Nombre de Materia</th>
                          <th>1er Trimestre</th>
                          <th>2do Trimestre</th>
                          <th>3er Trimestre</th>
<?php if ($reg[0]['nivel'] != "INICIAL") { ?><th>Definitiva</th><?php } ?>
                         </tr>
                         </thead>
                         <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                         <td><?php echo $a++; ?></td>
<td><abbr title="<?php echo "Código : ".$reg[$i]['codmateria']; ?>"><?php echo $reg[$i]['nommateria']; ?></abbr></td>          


<!-- PROCESO NOTA 1 -->
<td align="center"><?php echo $nota1 = ( $reg[$i]['nota1'] <= '50' && $reg[$i]['nota1'] > '0' ? "<h5><font color='red'>".$reg[$i]['nota1']."</font color></h5>" : "<h5>".$reg[$i]['nota1']."</h5>"); ?></td>

<!-- PROCESO NOTA 2 -->
<td align="center"><?php echo $nota2 = ( $reg[$i]['nota2'] <= '50' && $reg[$i]['nota2'] > '0' ? "<h5><font color='red'>".$reg[$i]['nota2']."</font color></h5>" : "<h5>".$reg[$i]['nota2']."</h5>"); ?></td>

<!-- PROCESO NOTA 3 -->
<td align="center"><?php echo $nota3 = ( $reg[$i]['nota3'] <= '50' && $reg[$i]['nota3'] > '0' ? "<h5><font color='red'>".$reg[$i]['nota3']."</font color></h5>" : "<h5>".$reg[$i]['nota3']."</h5>"); ?></td>


<?php if ($reg[0]['nivel'] != "INICIAL") { ?>
<!-- PROCESO DEFINITIVA -->
<td align="center"><?php echo $definitiva = ( $reg[$i]['definitiva'] <= '50' && $reg[$i]['definitiva'] > '0' ? "<h5><font color='red'>".$reg[$i]['definitiva']."</font color></h5>" : "<h5>".$reg[$i]['definitiva']."</h5>"); ?></td>
<?php } ?>
                         </tr>
                         <?php  }  ?>
                         </tbody>
</table>

<div align="center">
<a href="reportepdf?codest=<?php echo $codest; ?>&codperiodo=<?php echo $codperiodo; ?>&tipo=<?php echo base64_encode("BOLETAXPERIODO") ?>" target="_blank" rel="noopener noreferrer"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-files-o"></span> Imprimir Boleta</button></a>                    
                       </div><br>
                              </div>
                           </div><!-- /.box-body -->
                        </div>
                     </div>
                  </div>
               </div>
           </div>
      </div>
  </div>
<?php           
      }
  }
######################### FUNCION PARA BUSQUEDA NOTAS POR PERIODOS ########################
?>


<?php
######################## VERIFICA MESES VENCIDOS #################################
if (isset($_GET['verifica_meses'])) {
  
$meses = new Login();
$meses = $meses->VerificaMesesVencidos();

}
######################## VERIFICA MESES VENCIDOS #################################
?>
