<?php
require_once("class/class.php");
    if (isset($_SESSION['acceso'])) {
        if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="docente") {

$con = new Login();
$con = $con->ConfiguracionPorId();

$tipo = base64_decode($_GET['tipo']);
switch($tipo)
  {

case 'USUARIOS': 

$hoy = "LISTADO_GENERAL_USUARIOS";
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr> <th colspan="9"> LISTADO GENERAL DE USUARIOS </th> </tr>
</table>

<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th bgcolor="#81AAF9">Nº</th>
           <th bgcolor="#81AAF9">Nº DE DNI</th>
           <th bgcolor="#81AAF9">NOMBRES Y APELLIDOS</th>
           <th bgcolor="#81AAF9">SEXO</th>
           <th bgcolor="#81AAF9">CARGO</th>
           <th bgcolor="#81AAF9">EMAIL</th>
           <th bgcolor="#81AAF9">USUARIO</th>
           <th bgcolor="#81AAF9">NIVEL</th>
           <th bgcolor="#81AAF9">STATUS</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarUsuarios();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['cedula']; ?></td>
           <td><?php echo $reg[$i]['nombres']; ?></td>
           <td><?php echo $reg[$i]['sexo']; ?></td>
           <td><?php echo $reg[$i]['cargo']; ?></td>
           <td><?php echo $reg[$i]['email']; ?></td>
           <td><?php echo $reg[$i]['usuario']; ?></td>
           <td><?php echo $reg[$i]['nivel']; ?></td>
           <td><?php echo $reg[$i]['status']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'LOGS': 

$hoy = "LISTADO_GENERAL_LOGS";
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr> <th colspan="6"> LISTADO GENERAL DE LOG'S DE ACCESO DE USUARIOS </th> </tr>
</table>

<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th bgcolor="#81AAF9">Nº</th>
           <th bgcolor="#81AAF9">IP EQUIPO</th>
           <th bgcolor="#81AAF9">TIEMPO DE ENTRADA</th>
           <th bgcolor="#81AAF9">NAVEGADOR DE ACCESO</th>
           <th bgcolor="#81AAF9">PÁGINAS DE ACCESO</th>
           <th bgcolor="#81AAF9">USUARIOS</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarLogs();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['ip']; ?></td>
           <td><?php echo $reg[$i]['tiempo']; ?></td>
           <td><?php echo $reg[$i]['detalles']; ?></td>
           <td><?php echo $reg[$i]['paginas']; ?></td>
           <td><?php echo $reg[$i]['usuario']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'ARQUEOSGENERAL': 

$hoy = "LISTADO_GENERAL_ARQUEOS";
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr> <th colspan="9"> LISTADO GENERAL DE ARQUEOS DE CAJAS </th> </tr>
</table>

<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">

         <tr>
           <th bgcolor="#81AAF9">Nº</th>
           <th bgcolor="#81AAF9">RESPONSABLE</th>
           <th bgcolor="#81AAF9">Nº DE CAJA</th>
           <th bgcolor="#81AAF9">FECHA DE APERTURA</th>
           <th bgcolor="#81AAF9">FECHA DE CIERRE</th>
           <th bgcolor="#81AAF9">ESTIMADO</th>
           <th bgcolor="#81AAF9">EFECTIVO</th>
           <th bgcolor="#81AAF9">DIFERENCIA</th>
           <th bgcolor="#81AAF9">PERIODO ESCOLAR</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarArqueoCaja();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['nombres']; ?></span></td>
           <td><?php echo $reg[$i]['nombrecaja']; ?></span></td>
           <td><?php echo $reg[$i]['fechaapertura']; ?></span></td>
           <td><?php echo $reg[$i]['fechacierre']; ?></span></td>
           <td><?php echo number_format($reg[$i]['montoinicial']+$reg[$i]['ingresos']-$reg[$i]['egresos'], 2, '.', ','); ?></td>
           <td><?php echo number_format($reg[$i]["dineroefectivo"], 2, '.', '.'); ?></td>
           <td><?php echo number_format($reg[$i]["diferencia"], 2, '.', '.'); ?></td>
           <td><?php echo $reg[$i]['periodo']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;



case 'ARQUEOSXFECHAS': 

$tra = new Login();
$reg = $tra->BuscarArqueosxFechas();

$hoy = "ARQUEOS_DE_CAJA_DESDE_".str_replace(" ", "_",$_GET["desde"]." HASTA ".$_GET["hasta"]." Y PERIODO ".$reg[0]['periodo']);

header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr> <th colspan="9"> LISTADO GENERAL DE ARQUEOS DE CAJAS POR FECHAS </th> </tr>
</table>

<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">

         <tr>
           <th bgcolor="#81AAF9">Nº</th>
           <th bgcolor="#81AAF9">RESPONSABLE</th>
           <th bgcolor="#81AAF9">Nº DE CAJA</th>
           <th bgcolor="#81AAF9">FECHA DE APERTURA</th>
           <th bgcolor="#81AAF9">FECHA DE CIERRE</th>
           <th bgcolor="#81AAF9">ESTIMADO</th>
           <th bgcolor="#81AAF9">EFECTIVO</th>
           <th bgcolor="#81AAF9">DIFERENCIA</th>
           <th bgcolor="#81AAF9">PERIODO ESCOLAR</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['nombres']; ?></span></td>
           <td><?php echo $reg[$i]['nombrecaja']; ?></span></td>
           <td><?php echo $reg[$i]['fechaapertura']; ?></span></td>
           <td><?php echo $reg[$i]['fechacierre']; ?></span></td>
           <td><?php echo number_format($reg[$i]['montoinicial']+$reg[$i]['ingresos']-$reg[$i]['egresos'], 2, '.', ','); ?></td>
           <td><?php echo number_format($reg[$i]["dineroefectivo"], 2, '.', '.'); ?></td>
           <td><?php echo number_format($reg[$i]["diferencia"], 2, '.', '.'); ?></td>
           <td><?php echo $reg[$i]['periodo']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'MOVIMIENTOSGENERAL': 

$hoy = "LISTADO_GENERAL_MOVIMIENTOS";
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr> <th colspan="8"> LISTADO GENERAL DE MOVIMIENTOS EN CAJAS </th> </tr>
</table>

<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">

         <tr>
           <th bgcolor="#81AAF9">Nº</th>
           <th bgcolor="#81AAF9">TIPO</th>
           <th bgcolor="#81AAF9">Nº DE CAJA</th>
           <th bgcolor="#81AAF9">RESPONSABLE</th>
           <th bgcolor="#81AAF9">DESCRIPCIÓN DE MOVIMIENTO</th>
           <th bgcolor="#81AAF9">PERIODO ESCOLAR</th>
           <th bgcolor="#81AAF9">FECHA MOVIMIENTO</th>
           <th bgcolor="#81AAF9">MONTO MOVIMIENTO</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarMovimientoCajas();

if($reg==""){
echo "";      
} else {
  
$a=1; 
$TotalIngresos=0;
$TotalEgresos=0;
for($i=0;$i<sizeof($reg);$i++){ 
$TotalIngresos+=$ingresos = ( $reg[$i]['tipomovimientocaja'] == 'INGRESO' ? $reg[$i]['montomovimientocaja'] : "0");
$TotalEgresos+=$egresos = ( $reg[$i]['tipomovimientocaja'] == 'EGRESO' ? $reg[$i]['montomovimientocaja'] : "0");
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['tipomovimientocaja']; ?></td>
           <td><?php echo $reg[$i]['nrocaja']." : ".$reg[$i]['nombrecaja']; ?></td>
           <td><?php echo $reg[$i]['nombres']; ?></td>
           <td><?php echo $reg[$i]['descripcionmovimientocaja']; ?></td>
           <td><?php echo $reg[$i]['periodo']; ?></td>
           <td><?php echo $reg[$i]['fechamovimientocaja']; ?></td>
           <td><?php echo number_format($reg[$i]['montomovimientocaja'], 2, '.', ','); ?></td>
         </tr>
        <?php } } ?>
         <tr align="center" class="even_row">
           <td colspan="6">&nbsp;</td>
           <td><strong>Total Ingresos</strong></div></td>
           <td><strong><?php echo number_format($TotalIngresos, 2, '.', ','); ?></strong></td>
         </tr>
         <tr align="center" class="even_row">
           <td colspan="6">&nbsp;</td>
           <td><strong>Total Egresos</strong></div></td>
           <td><strong><?php echo number_format($TotalEgresos, 2, '.', ','); ?></strong></td>
         </tr>
         <tr align="center" class="even_row">
           <td colspan="6">&nbsp;</td>
           <td><strong>Total General</strong></div></td>
           <td><strong><?php echo number_format($TotalIngresos-$TotalEgresos, 2, '.', ','); ?></strong></td>
         </tr>
</table>
<?php
break;

case 'MOVIMIENTOSXFECHAS': 

$tra = new Login();
$reg = $tra->BuscarMovimientosxFechas();

$hoy = "MOVIMIENTOS_EN_CAJA_Nº_".str_replace(" ", "_",$reg[0]["nrocaja"]." ".$reg[0]["nombres"]." DESDE ".$_GET["desde"]." HASTA ".$_GET["hasta"]." Y PERIODO ".$reg[0]['periodo']);

header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr> <th colspan="8"> LISTADO GENERAL DE MOVIMIENTOS POR FECHAS </th> </tr>
</table>

<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">

         <tr>
           <th bgcolor="#81AAF9">Nº</th>
           <th bgcolor="#81AAF9">TIPO</th>
           <th bgcolor="#81AAF9">Nº DE CAJA</th>
           <th bgcolor="#81AAF9">RESPONSABLE</th>
           <th bgcolor="#81AAF9">DESCRIPCIÓN DE MOVIMIENTO</th>
           <th bgcolor="#81AAF9">MONTO MOVIMIENTO</th>
           <th bgcolor="#81AAF9">FECHA MOVIMIENTO</th>
           <th bgcolor="#81AAF9">PERIODO ESCOLAR</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1; 
$TotalIngresos=0;
$TotalEgresos=0;
for($i=0;$i<sizeof($reg);$i++){ 
$TotalIngresos+=$ingresos = ( $reg[$i]['tipomovimientocaja'] == 'INGRESO' ? $reg[$i]['montomovimientocaja'] : "0");
$TotalEgresos+=$egresos = ( $reg[$i]['tipomovimientocaja'] == 'EGRESO' ? $reg[$i]['montomovimientocaja'] : "0");
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['tipomovimientocaja']; ?></td>
           <td><?php echo $reg[$i]['nrocaja']." : ".$reg[$i]['nombrecaja']; ?></td>
           <td><?php echo $reg[$i]['nombres']; ?></td>
           <td><?php echo $reg[$i]['descripcionmovimientocaja']; ?></td>
           <td><?php echo number_format($reg[$i]['montomovimientocaja'], 2, '.', ','); ?></td>
           <td><?php echo $reg[$i]['fechamovimientocaja']; ?></td>
           <td><?php echo $reg[$i]['periodo']; ?></td>
         </tr>
        <?php } } ?>
         <tr align="center" class="even_row">
           <td colspan="6">&nbsp;</td>
           <td><strong>Total Ingresos</strong></div></td>
           <td><strong><?php echo number_format($TotalIngresos, 2, '.', ','); ?></strong></td>
         </tr>
         <tr align="center" class="even_row">
           <td colspan="6">&nbsp;</td>
           <td><strong>Total Egresos</strong></div></td>
           <td><strong><?php echo number_format($TotalEgresos, 2, '.', ','); ?></strong></td>
         </tr>
         <tr align="center" class="even_row">
           <td colspan="6">&nbsp;</td>
           <td><strong>Total General</strong></div></td>
           <td><strong><?php echo number_format($TotalIngresos-$TotalEgresos, 2, '.', ','); ?></strong></td>
         </tr>
</table>
<?php
break;

case 'GASTOSXFECHAS': 

$gasto = new Login();
$gasto = $gasto->BuscarGastosReportes();

$hoy = "GASTOS_DESDE_".$_GET["desde"]."_HASTA_".$_GET["hasta"]."_PERIODO_".str_replace(" ", "_", $gasto[0]["periodo"]);
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
 <tr> <th colspan="6"> <?php echo 'LISTADO DE GASTOS DESDE: '.$_GET["desde"]." HASTA: ".$_GET["hasta"]." - PERIODO ".str_replace(" ", "_", $gasto[0]["periodo"]); ?> </th> </tr>
</table> 

<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">

         <tr>
           <th bgcolor="#81AAF9">Nº</th>
           <th bgcolor="#81AAF9">Nº FACTURA/REC.</th>
           <th bgcolor="#81AAF9">DESCRIPCIÓN DE GASTO</th>           
           <th bgcolor="#81AAF9">FECHA DE GASTO</th>           
           <th bgcolor="#81AAF9">FECHA REGISTRO</th>
           <th bgcolor="#81AAF9">MONTO DE GASTO</th>

         </tr>
      <?php 
if($gasto==""){
echo "";      
} else {
  
$a=1;  
$GastoTotal=0;   
for($i=0;$i<sizeof($gasto);$i++){
$GastoTotal+=$gasto[$i]['montogasto'];
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $gasto[$i]['nrorecibo']; ?></td>
           <td><?php echo $gasto[$i]['descripciongasto']; ?></td>
           <td><?php echo date("d-m-Y",strtotime($gasto[$i]['fechagasto'])); ?></td>
           <td><?php echo date("d-m-Y",strtotime($gasto[$i]['ingresogasto'])); ?></td>
           <td><?php echo number_format($gasto[$i]['montogasto'], 2, '.', ','); ?></td>
         </tr>
        <?php } } ?>
         <tr align="center" class="even_row">
           <td colspan="4">&nbsp;</td>
           <td><strong>TOTAL GASTOS</strong></td>
           <td><strong><?php echo number_format($GastoTotal, 2, '.', ','); ?></strong></td>
         </tr>
</table>

<?php
break;

case 'MATERIAS': 

$hoy = "LISTADO_GENERAL_MATERIAS";
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr> <th colspan="6"> LISTADO GENERAL DE MATERIAS </th> </tr>
</table>

<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">

         <tr>
           <th bgcolor="#81AAF9">Nº</th>
           <th bgcolor="#81AAF9">CÓDIGO</th>
           <th bgcolor="#81AAF9">NOMBRE DE ÁREA</th>
           <th bgcolor="#81AAF9">NOMBRE DE MATERIA</th>
           <th bgcolor="#81AAF9">NIVEL</th>
           <th bgcolor="#81AAF9">GRADO</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarMaterias();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codmateria']; ?></td>
           <td><?php echo $reg[$i]['nomarea']; ?></td>
           <td><?php echo $reg[$i]['nommateria']; ?></td>
           <td><?php echo $reg[$i]['nivel']; ?></td>
           <td><?php echo $reg[$i]['grado']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'MATERIASXCURSOS':

$tra = new Login();
$reg = $tra->BuscarMateriasReportes(); 

$hoy = "LISTADO_MATERIAS_NIVEL_".str_replace(" ", "_", $reg[0]["nivel"])."_GRADO_".str_replace(" ", "_", $reg[0]["grado"]);
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr> <th colspan="4"> <?php echo 'LISTADO DE MATERIAS DEL NIVEL '.str_replace(" ", "_", $reg[0]["nivel"])." - GRADO ".str_replace(" ", "_", $reg[0]["grado"]); ?> </th> </tr>
</table>

<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">

         <tr>
           <th bgcolor="#81AAF9">Nº</th>
           <th bgcolor="#81AAF9">CÓDIGO</th>
           <th bgcolor="#81AAF9">NOMBRE DE ÁREA</th>
           <th bgcolor="#81AAF9">NOMBRE DE MATERIA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codmateria']; ?></td>
           <td><?php echo $reg[$i]['nomarea']; ?></td>
           <td><?php echo $reg[$i]['nommateria']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;



case 'DOCENTES': 

$hoy = "LISTADO_GENERAL_DOCENTES";
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr> <th colspan="12"> LISTADO GENERAL DE DOCENTES DE LA INSTITUCIÓN </th> </tr>
</table>

<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">

         <tr>
           <th bgcolor="#81AAF9">Nº</th>
           <th bgcolor="#81AAF9">Nº DE DNI</th>
           <th bgcolor="#81AAF9">NOMBRES Y APELLIDOS</th>
           <th bgcolor="#81AAF9">ESTADO CIVIL</th>
           <th bgcolor="#81AAF9">Nº TELÉFONO</th>
           <th bgcolor="#81AAF9">DIRECCIÓN DOMICILIARIA</th>
           <th bgcolor="#81AAF9">ESPECIALIDAD</th>
           <th bgcolor="#81AAF9">LUGAR DE NACIMIENTO</th>
           <th bgcolor="#81AAF9">FECHA NACIMIENTO</th>
           <th bgcolor="#81AAF9">EMAIL</th>
           <th bgcolor="#81AAF9">HORAS ASIGNADAS</th>
           <th bgcolor="#81AAF9">Nº DE CARGO</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarDocentes();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo ($reg[$i]['ceddoc']."-".$status = ( $reg[$i]["expedido"] == 'LA PAZ' ? "LP." : ($status = ( $reg[$i]["expedido"] == 'COCHABAMBA' ? "CB." : ($status = ( $reg[$i]["expedido"] == 'SANTA CRUZ' ? "SC." : ($status = ( $reg[$i]["expedido"] == 'CHUQUISACA' ? "CH." : ($status = ( $reg[$i]["expedido"] == 'ORURO' ? "OR." : ($status = ( $reg[$i]["expedido"] == 'TARIJA' ? "TJ." : ($status = ( $reg[$i]["expedido"] == 'POTOSI' ? "PT." : ($status = ( $reg[$i]["expedido"] == 'BENI' ? "BE." : ($status = ( $reg[$i]["expedido"] == 'PANDO' ? "PA." : "")))))))))))))))))); ?></td>
           <td><?php echo $reg[$i]['nomdoc']; ?></td>
           <td><?php echo $reg[$i]['edocivildoc']; ?></td>
           <td><?php echo $reg[$i]['tlfdoc']; ?></td>
           <td><?php echo $reg[$i]['direcdoc']; ?></td>
           <td><?php echo $reg[$i]['especdoc']; ?></td>
           <td><?php echo $reg[$i]['lugarnacdoc']; ?></td>
           <td><?php echo $reg[$i]['fecnacdoc']; ?></td>
           <td><?php echo $reg[$i]['correodoc']; ?></td>
           <td><?php echo $reg[$i]['horasdoc']; ?></td>
           <td><?php echo $reg[$i]['codcargodoc']; ?></td>
         </tr>
        <?php } } ?>
</table>

<?php
break;

case 'ASIGNACIONES': 

$hoy = "LISTADO_GENERAL_ASIGNACIONES_DOCENTES";
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr> <th colspan="9"> LISTADO GENERAL DE ASIGNACIONES DE MATERIAS A DOCENTES</th> </tr>
</table>

<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">

         <tr>
           <th bgcolor="#81AAF9">Nº</th>
           <th bgcolor="#81AAF9">Nº DE DNI</th>
           <th bgcolor="#81AAF9">NOMBRES DEL DOCENTE</th>
           <th bgcolor="#81AAF9">TURNO</th>
           <th bgcolor="#81AAF9">NIVEL</th>
           <th bgcolor="#81AAF9">GRADO</th>
           <th bgcolor="#81AAF9">SECCIÓN</th>
           <th bgcolor="#81AAF9">NOMBRE DE MATERIA</th>
           <th bgcolor="#81AAF9">PERIODO ESCOLAR</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarAsignacion();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo ($reg[$i]['ceddoc']."-".$status = ( $reg[$i]["expedido"] == 'LA PAZ' ? "LP." : ($status = ( $reg[$i]["expedido"] == 'COCHABAMBA' ? "CB." : ($status = ( $reg[$i]["expedido"] == 'SANTA CRUZ' ? "SC." : ($status = ( $reg[$i]["expedido"] == 'CHUQUISACA' ? "CH." : ($status = ( $reg[$i]["expedido"] == 'ORURO' ? "OR." : ($status = ( $reg[$i]["expedido"] == 'TARIJA' ? "TJ." : ($status = ( $reg[$i]["expedido"] == 'POTOSI' ? "PT." : ($status = ( $reg[$i]["expedido"] == 'BENI' ? "BE." : ($status = ( $reg[$i]["expedido"] == 'PANDO' ? "PA." : "")))))))))))))))))); ?></td>
           <td><?php echo $reg[$i]['nomdoc']; ?></td>
           <td><?php echo $reg[$i]['turno']; ?></td>
           <td><?php echo $reg[$i]['nivel']; ?></td>
           <td><?php echo $reg[$i]['grado']; ?></td>
           <td><?php echo $reg[$i]['seccion']; ?></td>
           <td><?php echo $reg[$i]['nommateria']; ?></td>
           <td><?php echo $reg[$i]['periodo']; ?></td>
         </tr>
        <?php } } ?>
</table>

<?php
break;

case 'ASIGNACIONESXDOCENTES': 

$tra = new Login();
$reg = $tra->BuscarAsignacionMateriasReportes();

$hoy = "ASIGNACIONES_X_DOCENTES_PERIODO_".str_replace(" ", "_", $reg[0]["periodo"]);

header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr> <th colspan="9"> LISTADO GENERAL DE ASIGNACIONES DE MATERIAS A DOCENTES DEL PERIODO ESCOLAR <?php echo $reg[0]["periodo"]; ?></th> </tr>
</table>

<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">

         <tr>
           <th bgcolor="#81AAF9">Nº</th>
           <th bgcolor="#81AAF9">Nº DE DNI</th>
           <th bgcolor="#81AAF9">NOMBRES DEL DOCENTE</th>
           <th bgcolor="#81AAF9">TURNO</th>
           <th bgcolor="#81AAF9">NIVEL</th>
           <th bgcolor="#81AAF9">GRADO</th>
           <th bgcolor="#81AAF9">SECCIÓN</th>
           <th bgcolor="#81AAF9">NOMBRE DE MATERIA</th>
           <th bgcolor="#81AAF9">PERIODO ESCOLAR</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo ($reg[$i]['ceddoc']."-".$status = ( $reg[$i]["expedido"] == 'LA PAZ' ? "LP." : ($status = ( $reg[$i]["expedido"] == 'COCHABAMBA' ? "CB." : ($status = ( $reg[$i]["expedido"] == 'SANTA CRUZ' ? "SC." : ($status = ( $reg[$i]["expedido"] == 'CHUQUISACA' ? "CH." : ($status = ( $reg[$i]["expedido"] == 'ORURO' ? "OR." : ($status = ( $reg[$i]["expedido"] == 'TARIJA' ? "TJ." : ($status = ( $reg[$i]["expedido"] == 'POTOSI' ? "PT." : ($status = ( $reg[$i]["expedido"] == 'BENI' ? "BE." : ($status = ( $reg[$i]["expedido"] == 'PANDO' ? "PA." : "")))))))))))))))))); ?></td>
           <td><?php echo $reg[$i]['nomdoc']; ?></td>
           <td><?php echo $reg[$i]['turno']; ?></td>
           <td><?php echo $reg[$i]['nivel']; ?></td>
           <td><?php echo $reg[$i]['grado']; ?></td>
           <td><?php echo $reg[$i]['seccion']; ?></td>
           <td><?php echo $reg[$i]['nommateria']; ?></td>
           <td><?php echo $reg[$i]['periodo']; ?></td>
         </tr>
        <?php } } ?>
</table>

<?php
break;

case 'ESTUDIANTESXCURSOS': 

$tra = new Login();
$reg = $tra->BuscarEstudiantesReportes();

$hoy = "ESTUDIANTES_X_CURSOS_PERIODO_".str_replace(" ", "_", $reg[0]["periodo"]);
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr> <th colspan="10"> <?php echo "LISTADO GENERAL DE ESTUDIANTES POR CURSOS DEL PERIODO ESCOLAR ", $reg[0]["periodo"]; ?> </th> </tr>
</table>

<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">

         <tr>
           <th bgcolor="#81AAF9">Nº</th>
           <th bgcolor="#81AAF9">Nº DE DNI</th>
           <th bgcolor="#81AAF9">APELLIDOS Y NOMBRES</th>
           <th bgcolor="#81AAF9">FECHA NACIMIENTO</th>
           <th bgcolor="#81AAF9">EDAD</th>
           <th bgcolor="#81AAF9">NIVEL</th>
           <th bgcolor="#81AAF9">GRADO</th>
           <th bgcolor="#81AAF9">SECCIÓN</th>
           <th bgcolor="#81AAF9">TURNO</th>
           <th bgcolor="#81AAF9">BECADO</th>
         </tr>
      <?php 
if($reg==""){
echo "";      
} else {
  
$a=1;  
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['cedest']; ?></td>
           <td><?php echo $reg[$i]['papeest']." ".$reg[$i]['sapeest']." ".$reg[$i]['pnomest']." ".$reg[$i]['snomest']; ?></td>
           <td><?php echo $reg[$i]["fnacest"]; ?></td>
           <td><?php echo edad($reg[$i]["fnacest"])." AÑOS"; ?></td>
           <td><?php echo $reg[$i]['nivel']; ?></td>
           <td><?php echo $reg[$i]['grado']; ?></td>
           <td><?php echo $reg[$i]['seccion']; ?></td>
           <td><?php echo $reg[$i]['turno']; ?></td>
           <td><?php echo $reg[$i]['becado']; ?></td>
         </tr>
        <?php } } ?>
</table>

<?php
break;

case 'REPRESENTANTESXCURSOS': 

$tra = new Login();
$reg = $tra->BuscarRepresentantesReportes();

$hoy = "REPRESENTANTES_X_CURSOS_PERIODO_".str_replace(" ", "_", $reg[0]["periodo"]);
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr> <th colspan="11"> <?php echo "LISTADO GENERAL DE PADRES/TUTORES POR CURSOS DEL PERIODO ESCOLAR ", $reg[0]["periodo"]; ?> </th> </tr>
</table>

<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">

         <tr>
           <th bgcolor="#81AAF9">Nº</th>
           <th bgcolor="#81AAF9">Nº DE DNI</th>
           <th bgcolor="#81AAF9">APELLIDOS Y NOMBRES</th>
           <th bgcolor="#81AAF9">FECHA NACIMIENTO</th>
           <th bgcolor="#81AAF9">EDAD</th>
           <th bgcolor="#81AAF9">NIVEL</th>
           <th bgcolor="#81AAF9">GRADO</th>
           <th bgcolor="#81AAF9">SECCIÓN</th>
           <th bgcolor="#81AAF9">TURNO</th>
           <th bgcolor="#81AAF9">BECADO</th>
           <th bgcolor="#81AAF9">PADRE/TUTOR</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1;  
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['cedest']; ?></td>
           <td><?php echo $reg[$i]['papeest']." ".$reg[$i]['sapeest']." ".$reg[$i]['pnomest']." ".$reg[$i]['snomest']; ?></td>
           <td><?php echo $reg[$i]["fnacest"]; ?></td>
           <td><?php echo edad($reg[$i]["fnacest"])." AÑOS"; ?></td>
           <td><?php echo $reg[$i]['nivel']; ?></td>
           <td><?php echo $reg[$i]['grado']; ?></td>
           <td><?php echo $reg[$i]['seccion']; ?></td>
           <td><?php echo $reg[$i]['turno']; ?></td>
           <td><?php echo $reg[$i]['becado']; ?></td>
           <td><?php echo $reg[$i]['cedpadre']." - ".$reg[$i]['nompadre']." ".$reg[$i]['apepadre']; ?></td>
         </tr>
        <?php } } ?>
</table>

<?php
break;

case 'PAGOSFECHAS': 

$tra = new Login();
$reg = $tra->BuscarPagosGeneralReportes();

$egreso = new Login();
$egreso = $egreso->SumaGastosFechas();

$hoy = "PAGOS_DESDE_".$_GET["desde"]."_HASTA_".$_GET["hasta"]."_PERIODO_".str_replace(" ", "_", $reg[0]["periodo"]);

header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr> <th colspan="12"> <?php echo "LISTADO GENERAL DE PAGOS DESDE: ".$_GET["desde"]." HASTA: ".$_GET["hasta"]." - PERIODO ".str_replace(" ", "_", $reg[0]["periodo"]); ?> </th> </tr>
</table>

<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th bgcolor="#81AAF9">Nº</th>
           <th bgcolor="#81AAF9">Nº DE DNI</th>
           <th bgcolor="#81AAF9">NOMBRES Y APELLIDOS</th>
           <th bgcolor="#81AAF9">NIVEL</th>
           <th bgcolor="#81AAF9">GRADO</th>
           <th bgcolor="#81AAF9">SECCIÓN</th>
           <th bgcolor="#81AAF9">TURNO</th>
           <th bgcolor="#81AAF9">BECADO</th>
           <th bgcolor="#81AAF9">MESES PAGADOS</th>
           <th bgcolor="#81AAF9">MORA</th>
           <th bgcolor="#81AAF9">MONTO POR MES</th>
           <th bgcolor="#81AAF9">MONTO MES EXTRA</th>
           <th bgcolor="#81AAF9">PAGO TOTAL</th>
         </tr>
      <?php 
if($reg==""){
echo "";      
} else {
  
$a=1;  
$pagoTotal=0;   
for($i=0;$i<sizeof($reg);$i++){
$desc=$reg[$i]['descuento']/100; 
$calculo=($reg[$i]['sumpago'])+($reg[$i]['cantmora']*$reg[$i]['interesmora']);
$subtotal= $calculo*$desc;
$total=$calculo-$subtotal+$reg[$i]['cuotaunica']+$reg[$i]['montomesextra'];
$pagoTotal+=$total;
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['cedest']; ?></td>
           <td><?php echo $reg[$i]['pnomest']." ".$reg[$i]['snomest']." ".$reg[$i]['papeest']." ".$reg[$i]['sapeest']; ?></td>
           <td><?php echo $reg[$i]['nivel']; ?></td>
           <td><?php echo $reg[$i]['grado']; ?></td>
           <td><?php echo $reg[$i]['seccion']; ?></td>
           <td><?php echo $reg[$i]['turno']; ?></td>
           <td><?php echo $reg[$i]['becado']; ?></td>
           <td><?php echo convertir($reg[$i]["meses"]); ?></td>
           <td><?php echo $mora = ($reg[$i]['cantmora'] == '' ? "0" : $reg[$i]['cantmora']); ?> <sup><?php echo $reg[$i]['interesmora']; ?></td>
           <td><?php echo $reg[$i]['montopago']; ?></td>
           <td><?php echo $montoextra = ($reg[$i]['montomesextra']== "" ? "0.00" : $reg[$i]['montomesextra']); ?></td>
<td><?php echo number_format($total, 2, '.', ','); ?></td>
         </tr>
        <?php } } ?>
         <tr align="center" class="even_row">
           <td colspan="11">&nbsp;</td>
           <td><strong>MONTO TOTAL</strong></td>
           <td><strong><?php echo number_format($pagoTotal, 2, '.', ','); ?></strong></td>
         </tr>
         <tr align="center" class="even_row">
           <td colspan="11">&nbsp;</td>
           <td><strong>EGRESOS</strong></td>
           <td><strong><?php echo number_format($egreso[0]['egresos'], 2, '.', ','); ?></strong></td>
         </tr>
         <tr align="center" class="even_row">
           <td colspan="11">&nbsp;</td>
           <td><strong>TOTAL GENERAL</strong></td>
           <td><strong><?php echo number_format($pagoTotal-$egreso[0]['egresos'], 2, '.', ','); ?></strong></td>
         </tr>
</table>

<?php
break;

case 'PAGOSALDIA': 

$tra = new Login();
$reg = $tra->BuscarPagosAlDiaReportes();

$hoy = "PAGOS_MES_".convertir($_GET['mespago'])."_PERIODO_".str_replace(" ", "_", $reg[0]["periodo"]);
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr> <th colspan="11"> <?php echo "LISTADO DE PAGOS AL DÍA AL MES DE: ".convertir($_GET["mespago"])." - PERIODO ".str_replace(" ", "_", $reg[0]["periodo"]); ?> </th> </tr>
</table>

<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th bgcolor="#81AAF9">Nº</th>
           <th bgcolor="#81AAF9">Nº DE DNI</th>
           <th bgcolor="#81AAF9">NOMBRES Y APELLIDOS</th>
           <th bgcolor="#81AAF9">NIVEL</th>
           <th bgcolor="#81AAF9">GRADO</th>
           <th bgcolor="#81AAF9">SECCIÓN</th>
           <th bgcolor="#81AAF9">TURNO</th>
           <th bgcolor="#81AAF9">BECADO</th>
           <th bgcolor="#81AAF9">INTERÉS MORA</th>
           <th bgcolor="#81AAF9">CUOTA MES</th>
           <th bgcolor="#81AAF9">PAGO TOTAL</th>
         </tr>
      <?php 
if($reg==""){
echo "";      
} else {
  
$a=1;  
$pagoTotal=0;   
for($i=0;$i<sizeof($reg);$i++){
$desc=$reg[$i]['descuento']/100;
$calculo=$reg[$i]['montopago']+$reg[$i]['cantmora']*$reg[$i]['interesmora']+$reg[0]['cuotaunica'];
$subtotal= $calculo * $desc;
$total=$calculo - $subtotal;
$pagoTotal+=$total;
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['cedula']; ?></td>
           <td><?php echo $reg[$i]['pNombre']." ".$reg[$i]['sNombre']." ".$reg[$i]['pApellido']." ".$reg[$i]['sApellido']; ?></td>
           <td><?php echo $reg[$i]['nivel']; ?></td>
           <td><?php echo $reg[$i]['grado']; ?></td>
           <td><?php echo $reg[$i]['seccion']; ?></td>
           <td><?php echo $reg[$i]['turno']; ?></td>
           <td><?php echo $reg[$i]['becado']; ?></td>
           <td><?php echo number_format($reg[$i]['interesmora'], 2, '.', ','); ?></td>
           <td><?php echo number_format($reg[$i]['montopago'], 2, '.', ','); ?></td>
           <td><?php echo number_format($total, 2, '.', ','); ?></td>
         </tr>
        <?php } } ?>
         <tr align="center" class="even_row">
           <td colspan="9">&nbsp;</td>
           <td><strong>MONTO TOTAL</strong></td>
           <td><strong><?php echo number_format($pagoTotal, 2, '.', ','); ?></strong></td>
         </tr>
</table>

<?php
break;

case 'PAGOSVENCIDOS': 

$tra = new Login();
$reg = $tra->BuscarPagosVencidosReportes();

$hoy = "PAGOS_VENCIDOS_PERIODO_".str_replace(" ", "_", $reg[0]["periodo"]);
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr> <th colspan="12"> <?php echo "LISTADO DE PAGOS VENCIDOS "." - PERIODO ".str_replace(" ", "_", $reg[0]["periodo"]); ?> </th> </tr>
</table>

<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th bgcolor="#81AAF9">Nº</th>
           <th bgcolor="#81AAF9">Nº DE DNI</th>
           <th bgcolor="#81AAF9">NOMBRES Y APELLIDOS</th>
           <th bgcolor="#81AAF9">NIVEL</th>
           <th bgcolor="#81AAF9">GRADO</th>
           <th bgcolor="#81AAF9">SECCIÓN</th>
           <th bgcolor="#81AAF9">TURNO</th>
           <th bgcolor="#81AAF9">BECADO</th>
           <th bgcolor="#81AAF9">MESES VENCIDOS</th>
           <th bgcolor="#81AAF9">INTERÉS MORA</th>
           <th bgcolor="#81AAF9">CUOTA MES</th>
           <th bgcolor="#81AAF9">PAGO TOTAL</th>
         </tr>
      <?php 
if($reg==""){
echo "";      
} else {
  
$a=1;  
$pagoTotal=0;   
for($i=0;$i<sizeof($reg);$i++){
$pagoTotal+=($reg[$i]['montopago']+$reg[$i]['interesmora'])*count(explode(", ",$reg[$i]['meses']));
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['cedula']; ?></td>
           <td><?php echo $reg[$i]['pNombre']." ".$reg[$i]['sNombre']." ".$reg[$i]['pApellido']." ".$reg[$i]['sApellido']; ?></td>
           <td><?php echo $reg[$i]['nivel']; ?></td>
           <td><?php echo $reg[$i]['grado']; ?></td>
           <td><?php echo $reg[$i]['seccion']; ?></td>
           <td><?php echo $reg[$i]['turno']; ?></td>
           <td><?php echo $reg[$i]['becado']; ?></td>
           <td><?php echo convertir($reg[$i]["meses"]) ?></td>
           <td><?php echo number_format($reg[$i]['interesmora'], 2, '.', ','); ?></td>
           <td><?php echo number_format($reg[$i]['montopago']+$reg[$i]['cantmora']*$reg[$i]['interesmora'], 2, '.', ','); ?></td>
<td><?php echo number_format(($reg[$i]['montopago']+$reg[$i]['interesmora'])*count(explode(", ",$reg[$i]['meses'])), 2, '.', ','); ?></td>
         </tr>
        <?php } } ?>
         <tr align="center" class="even_row">
           <td colspan="10">&nbsp;</td>
           <td><strong>MONTO TOTAL</strong></td>
           <td><strong><?php echo number_format($pagoTotal, 2, '.', ','); ?></strong></td>
         </tr>
</table>

<?php
break;










case 'CAJAS': 

$hoy = "CAJAS_VENTAS";
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº CAJA</th>
           <th>NOMBRE DE CAJA</th>
           <th>CÉDULA CAJERO</th>
           <th>NOMBRE CAJERO</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarCajas();

if($reg==""){
echo "";      
} else {
  
$a=1;  
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr align="center" class="even_row">
           <td><?php echo $reg[$i]['codcaja']; ?></td>
           <td><?php echo $reg[$i]['nrocaja']; ?></td>
           <td><?php echo $reg[$i]['nombrecaja']; ?></td>
           <td><?php echo $reg[$i]['cedula']; ?></td>
           <td><?php echo $reg[$i]['nombres']; ?></td>
         </tr>
        <?php } } ?>
</table>

<?php
break;

}
 
?>
<p align="center"><strong>ELABORADO POR: <?php echo $_SESSION["nombres"] ?></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>RECIBIDO POR:</strong>___________________________</p>

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