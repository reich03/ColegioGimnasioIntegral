<?php
require_once("class/class.php");
$tra = new Login();
$tipo = base64_decode($_GET['tipo']);
switch($tipo)
	{
/*case 'USUARIOS':
$tra->EliminarUsuarios();
exit;
break;*/

case 'PERIODOESCOLAR':
$tra->EliminarPeriodoEscolar();
exit;
break;

case 'CAJAS':
$tra->EliminarCaja();
exit;
break;

case 'ARQUEOCAJA':
$tra->EliminarArqueoCaja();
exit;
break;

case 'MOVIMIENTOCAJA':
$tra->EliminarMovimientoCajas();
exit;
break;

case 'GASTOS':
$tra->EliminarGastos();
exit;
break;

case 'NIVELES':
$tra->EliminarNivel();
exit;
break;

case 'TURNOS':
$tra->EliminarTurno();
exit;
break;

case 'GRADOS':
$tra->EliminarGrados();
exit;
break;

case 'SECCIONES':
$tra->EliminarSecciones();
exit;
break;

case 'HORAS':
$tra->EliminarHoras();
exit;
break;

case 'DIAS':
$tra->EliminarDias();
exit;
break;

case 'AULAS':
$tra->EliminarAulas();
exit;
break;

case 'MATERIAS':
$tra->EliminarMaterias();
exit;
break;

case 'DOCENTES':
$tra->EliminarDocentes();
exit;
break;

case 'ASIGNACIONES':
$tra->EliminarAsignacion();
exit;
break;

case 'ESTUDIANTES':
$tra->EliminarEstudiantes();
exit;
break;

case 'PAGOS':
$tra->EliminarPagos();
exit;
break;

}
?>