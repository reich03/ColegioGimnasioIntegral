<?php 
if(isset($_SESSION['acceso'])) { 
if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="docente") {  ?>

 </html> 

 <body onLoad="muestraReloj()" class="fix-header"

 <div id="wrapper">

<div class="topbar">
 
 <div class="topbar-left">
          <div class="text-center">

<a href="panel" class="logo"><img src="assets/images/logo_sm.png" height="80"></a>
<a href="panel" class="logo-sm"><img src="assets/images/logo.png" height="50"></a>

          </div>
 </div>

 <div class="navbar navbar-default" role="navigation">
 <div class="container">
 <div class="">

 <div class="pull-left"> 
 <button type="button" class="button-menu-mobile open-left waves-effect waves-light"><i class="ion-navicon"></i> </button> 
 <span class="clearfix"></span></div>
 <form class="navbar-form pull-left" role="search">
 <div class="form-group"> 
 <input class="form-control search-bar" style="width: 185px;" placeholder="Búsqueda..." type="text">
 </div> 
 <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
 </form>

 <ul class="nav navbar-nav navbar-right pull-right">
 
 <!--- MEJORAR DE AQUI ---->

                               <!-- Reloj start-->
                                <li id="header_inbox_bar" class="dropdown hidden-xs">
                                    <a data-toggle="dropdown" class="simple" href="#">
                                    <span id="spanreloj"></span>
                                    </a>
                                </li>
                                <!-- Reloj end -->

 <li class="dropdown hidden-xs"> 
 <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" title="Cuotas Vencidas" aria-expanded="true"> 
 <i class="fa fa-bell"></i> 
 <span class="badge badge-xs badge-danger"><?php echo $con[0]['totalvenc'] ?></span> 
 </a>
 </li>
 <!--- MEJORAR DE AQUI ---->
   
   <li class="hidden-xs"> 
   <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="fa fa-crosshairs"></i></a>   </li>
   <li class="dropdown"> 
   <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
   
   <span class="dropdown hidden-xs"><abbr title="<?php echo estado($_SESSION['acceso']); ?>"><?php echo $_SESSION['nombres']; ?></abbr></span>

<?php if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria") {  ?>

<?php if (isset($_SESSION['cedula'])) {
     if (file_exists("fotos/".$_SESSION['cedula'].".jpg")){
        echo "<img src='fotos/".$_SESSION['cedula'].".jpg?' class='img-circle'>"; 
  }else{
        echo "<img src='fotos/avatar.jpg' class='img-circle'>"; 
  } } else {
        echo "<img src='fotos/avatar.jpg' class='img-circle'>"; 
  } ?> 

<?php } else { ?> 

<?php if (isset($_SESSION['ceddoc'])) {
     if (file_exists("fotos/".$_SESSION['ceddoc'].".jpg")){
        echo "<img src='fotos/".$_SESSION['ceddoc'].".jpg?' class='img-circle'>"; 
  }else{
        echo "<img src='fotos/docente.jpg' class='img-circle'>"; 
  } } else {
        echo "<img src='fotos/docente.jpg' class='img-circle'>"; 
  } ?> 

<?php } ?> 

</a>
   <ul class="dropdown-menu">
   <li><a href="perfil"><i class="fa fa-user"></i> Mi Perfil</a></li>
   <li><a href="password"><i class="fa fa-edit"></i> Actualizar Password </a></li>
   <li><a href="bloqueo"><i class="fa fa-clock-o"></i> Bloquear Sesión</a></li>
   <li class="divider"></li>
   <li><a href="logout"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
   </ul>
   </li>
   </ul>
   </div>
   </div>
   </div>
   </div>

   <div class="left side-menu">
   <div class="sidebar-inner slimscrollleft" style="overflow: hidden; width: auto; height: 566px;">
   
   <div class="user-details">
   <div class="text-center"> 

<?php if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria") {  ?>

<?php if (isset($_SESSION['cedula'])) {
         if (file_exists("fotos/".$_SESSION['cedula'].".jpg")){
            echo "<img src='fotos/".$_SESSION['cedula'].".jpg?' class='img-circle'>"; 
      } else {
            echo "<img src='fotos/avatar.jpg' class='img-circle'>"; 
      } } else {
            echo "<img src='fotos/avatar.jpg' class='img-circle'>"; 
} ?>

<?php } else { ?> 

<?php if (isset($_SESSION['ceddoc'])) {
         if (file_exists("fotos/".$_SESSION['ceddoc'].".jpg")){
            echo "<img src='fotos/".$_SESSION['ceddoc'].".jpg?' class='img-circle'>"; 
      } else {
            echo "<img src='fotos/docente.jpg' class='img-circle'>"; 
      } } else {
            echo "<img src='fotos/docente.jpg' class='img-circle'>"; 
} ?> 

<?php } ?>
  
</div>
   <div class="user-info">
   <div class="dropdown"> 
   <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo estado($_SESSION['acceso']); ?></a>
   <ul class="dropdown-menu">
  <li><a href="perfil"><i class="fa fa-user"></i> Mi Perfil</a></li>
   <li><a href="password"><i class="fa fa-edit"></i> Actualizar Password </a></li>
   <li><a href="bloqueo"><i class="fa fa-clock-o"></i> Bloquear Sesión</a></li>
   <li class="divider"></li>
   <li><a href="logout"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
   </ul>
   </div>
   <p class="text-muted m-0"><i class="fa fa-dot-circle-o text-success"></i> Online</p>
   </div>
   </div>



<?php switch($_SESSION['acceso'])
                                 {
                  case 'administrador':  ?>

	<!----- INICIO DE MENU ----->
   <div id="sidebar-menu">
   <ul>
   <li> <a href="panel" class="waves-effect"><i class="fa fa-home"></i><span> Inicio </span></a></li>

    <li class="has_sub"> 
   <a href="javascript:void(0);" class="waves-effect">
   <i class="fa fa-cog"></i> <span> Administración </span><span class="pull-right"><i class="ion ion-plus"></i></span></a>
   <ul class="list-unstyled" style="">
   <li><a href="configuracion">Configuración</a></li>
   <li><a href="periodoescolar">Periodo Escolar</a></li>
   <li class="has_sub"><a href="javascript:void(0);"><span>Cajas de Cobros</span><i class="pull-right fa fa-angle-double-right"></i></a>
                                  <ul style="">
                  <li><a href="cajas">Cajas de Cobro</a></li>
                  <li><a href="arqueoscajas">Arqueos de Cajas</a></li>
                  <li><a href="arqueosxfechas">Arqueos x Fechas</a></li>
                                  </ul>
                          </li>
   <li class="has_sub"><a href="javascript:void(0);"><span>Gastos e Ingresos</span><i class="pull-right fa fa-angle-double-right"></i></a>
                                  <ul style="">
                  <li><a href="movimientoscajas">Movimientos</a></li>
                  <li><a href="movimientosxfechas">Movim. x Fechas</a></li>
                                  </ul>
                          </li>
   <li class="has_sub"><a href="javascript:void(0);"><span>Inscripciones</span><i class="pull-right fa fa-angle-double-right"></i></a>
                                  <ul style="">
                  <li><a href="turnos">Turnos</a></li>
									<li><a href="niveles">Niveles</a></li>
									<li><a href="grados">Grados</a></li>
									<li><a href="secciones">Secciones</a></li>
                                  </ul>
                          </li>
   <li class="has_sub"><a href="javascript:void(0);"><span>Notas</span><i class="pull-right fa fa-angle-double-right"></i></a>
                                  <ul style="">
                  <li><a href="areas">Áreas de Materias</a></li>
                  <li><a href="materias">Materias</a></li>
                  <li><a href="busquedamaterias">Reporte Materias</a></li>
                                  </ul>
                          </li>
 <!--<li class="has_sub"><a href="javascript:void(0);"><span>Horario Escolar</span><i class="pull-right fa fa-angle-double-right"></i></a>
                                  <ul style="">
									<li><a href="horas">Horas</a></li>
                  <li><a href="dias">Dias</a></li>
									<li><a href="aulas">Aulas</a></li>
                                  </ul>
                          </li>-->
  <li class="has_sub"><a href="javascript:void(0);"><span>Seguridad</span><i class="pull-right fa fa-angle-double-right"></i></a>
                                  <ul style="">
                                    <li><a href="usuarios">Usuarios</a></li>
									<li><a href="logs">Logs de Acceso</a></li>
                                  </ul>
                          </li>
	<li class="has_sub"><a href="javascript:void(0);"><span>Base de Datos</span><i class="pull-right fa fa-angle-double-right"></i></a>
                                  <ul style="">
                  <li><a href="backup">Respaldar</a></li>
                  <li><a href="restore">Restaurar</a></li>
                                  </ul>
                          </li>
   </ul>
   </li>

   <li class="has_sub"> 
   <a href="javascript:void(0);" class="waves-effect">
   <i class="fa fa-mortar-board"></i> <span> Docentes </span> <span class="pull-right"><i class="ion ion-plus"></i></span></a>
   <ul class="list-unstyled" style="">
   <li><a href="docentes">Docentes</a></li>
  <li><a href="asignaciones">Asignación de Materias</a></li>
   <li><a href="busquedaasignaciones">Búsqueda Asignaciones</a></li>
   </ul>
   </li>
   
   <li class="has_sub"> 
   <a href="javascript:void(0);" class="waves-effect">
   <i class="fa fa-male"></i> <span> Estudiantes </span> <span class="pull-right"><i class="ion ion-plus"></i></span></a>
   <ul class="list-unstyled" style="">
   <li><a href="inscripciones">Inscripciones</a></li>
   <li><a href="estudiantes"> Control de Estudiantes</a></li>
   <li><a href="listadogeneral"> Listado General</a></li>
   <li><a href="busquedaestudiantes">Búsqueda Reportes</a></li>
   </ul>
   </li>
   
   <li class="has_sub"> 
   <a href="javascript:void(0);" class="waves-effect">
   <i class="ion ion-person-stalker"></i><span> Padres y Tutores </span><span class="pull-right"><i class="ion ion-plus"></i></span></a>
   <ul class="list-unstyled" style="">
   <li><a href="representantes">Control Padres/Tutores</a></li>
   <li><a href="busquedarepresentantes">Búsqueda Reportes</a></li>
   </ul>
   </li>
   
   <li class="has_sub"> 
   <a href="javascript:void(0);" class="waves-effect">
   <i class="fa fa-usd"></i><span> Gestión de Pagos </span><span class="pull-right"><i class="ion ion-plus"></i></span></a>
   <ul class="list-unstyled" style="">
   <li><a href="forpagos">Nuevos Pagos</a></li>
   <li><a href="pagos">Control de Pagos</a></li>
   <li class="has_sub"><a href="javascript:void(0);"><span>Reportes</span><i class="pull-right fa fa-angle-double-right"></i></a>
            <ul style="">
   <li><a href="comprobantes">Comprobante</a></li>
   <li><a href="cuotasg">Cuotas General</a></li>
   <li><a href="cuotasc">Cuotas al Día</a></li>
   <li><a href="cuotasv">Cuotas Vencidas</a></li>
           </ul>
   </li>
   </ul>
   </li>

   <li class="has_sub"> 
   <a href="javascript:void(0);" class="waves-effect">
   <i class="fa fa-paste"></i><span> Gestión de Notas </span><span class="pull-right"><i class="ion ion-plus"></i></span></a>
   <ul class="list-unstyled" style="">
   <li><a href="fornotas">Registrar Notas</a></li>
  <li><a href="nuevasnotas">Notas a Nuevos Inscritos</a></li>
   <li><a href="notas">Boletín Escolar</a></li>
   <li><a href="notasxcursos">Boletín por Cursos</a></li>
   <li><a href="notasxperiodos">Notas por Periodos</a></li>
   </ul>
   </li>
   
   <li> <a href="logout" class="waves-effect"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
   
   </ul>
   </div>
   <!----- FIN DE MENU ----->
				
    <?php
         break;
         case 'secretaria': ?>

    <!----- INICIO DE MENU ----->
   <div id="sidebar-menu">
   <ul>
   <li> <a href="panel" class="waves-effect"><i class="fa fa-home"></i><span> Inicio </span></a></li>
   
    <li class="has_sub"> 
   <a href="javascript:void(0);" class="waves-effect">
   <i class="fa fa-cog"></i> <span> Administración </span><span class="pull-right"><i class="ion ion-plus"></i></span></a>
   <ul class="list-unstyled" style="">
   <li class="has_sub"><a href="javascript:void(0);"><span>Arqueos de Cajas</span><i class="pull-right fa fa-angle-double-right"></i></a>
                                  <ul style="">
                  <li><a href="arqueoscajas">Arqueos de Cajas</a></li>
                  <li><a href="arqueosxfechas">Arqueos x Fechas</a></li>
                                  </ul>
                          </li>
   <li class="has_sub"><a href="javascript:void(0);"><span>Gastos e Ingresos</span><i class="pull-right fa fa-angle-double-right"></i></a>
                                  <ul style="">
                  <li><a href="movimientoscajas">Movimientos</a></li>
                  <li><a href="movimientosxfechas">Movim. x Fechas</a></li>
                                  </ul>
                          </li>
   </ul>
   </li>

   <li class="has_sub"> 
   <a href="javascript:void(0);" class="waves-effect">
   <i class="fa fa-mortar-board"></i> <span> Docentes </span> <span class="pull-right"><i class="ion ion-plus"></i></span></a>
   <ul class="list-unstyled" style="">
   <li><a href="docentes">Docentes</a></li>
  <li><a href="asignaciones">Asignación de Materias</a></li>
   <li><a href="busquedaasignaciones">Búsqueda Asignaciones</a></li>
   </ul>
   </li>
   
   <li class="has_sub"> 
   <a href="javascript:void(0);" class="waves-effect">
   <i class="fa fa-male"></i> <span> Estudiantes </span> <span class="pull-right"><i class="ion ion-plus"></i></span></a>
   <ul class="list-unstyled" style="">
   <li><a href="inscripciones">Inscripciones</a></li>
   <li><a href="estudiantes"> Control de Estudiantes</a></li>
   <li><a href="listadogeneral"> Listado General</a></li>
   <li><a href="busquedaestudiantes">Búsqueda Reportes</a></li>
   </ul>
   </li>
   
   <li class="has_sub"> 
   <a href="javascript:void(0);" class="waves-effect">
   <i class="ion ion-person-stalker"></i><span> Padres y Tutores </span><span class="pull-right"><i class="ion ion-plus"></i></span></a>
   <ul class="list-unstyled" style="">
   <li><a href="representantes">Control Padres/Tutores</a></li>
   <li><a href="busquedarepresentantes">Búsqueda Reportes</a></li>
   </ul>
   </li>
   
   <li class="has_sub"> 
   <a href="javascript:void(0);" class="waves-effect">
   <i class="fa fa-usd"></i><span> Gestión de Pagos </span><span class="pull-right"><i class="ion ion-plus"></i></span></a>
   <ul class="list-unstyled" style="">
   <li><a href="forpagos">Nuevos Pagos</a></li>
   <li><a href="pagos">Control de Pagos</a></li>
   <li class="has_sub"><a href="javascript:void(0);"><span>Reportes</span><i class="pull-right fa fa-angle-double-right"></i></a>
            <ul style="">
   <li><a href="comprobantes">Comprobante</a></li>
   <li><a href="cuotasg">Cuotas General</a></li>
   <li><a href="cuotasc">Cuotas al Día</a></li>
   <li><a href="cuotasv">Cuotas Vencidas</a></li>
           </ul>
   </li>
   </ul>
   </li>

   <li class="has_sub"> 
   <a href="javascript:void(0);" class="waves-effect">
   <i class="fa fa-paste"></i><span> Gestión de Notas </span><span class="pull-right"><i class="ion ion-plus"></i></span></a>
   <ul class="list-unstyled" style="">
   <li><a href="fornotas">Registrar Notas</a></li>
   <li><a href="nuevasnotas">Notas a Nuevos Inscritos</a></li>
   <li><a href="notas">Boletín Escolar</a></li>
   <li><a href="notasxcursos">Boletín por Cursos</a></li>
   <li><a href="notasxperiodos">Notas por Periodos</a></li>
   </ul>
   </li>
   
   <li> <a href="logout" class="waves-effect"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
   
   </ul>
   </div>
   <!----- FIN DE MENU ----->
				

       <?php
         break;
         case 'docente': ?>

    <!----- INICIO DE MENU ----->
   <div id="sidebar-menu">
   <ul>
   <li> <a href="panel" class="waves-effect"><i class="fa fa-home"></i><span> Inicio </span></a></li>

   <li> <a href="datos" class="waves-effect"><i class="fa fa-edit"></i><span> Actualizar mis Datos </span></a></li>

   <li class="has_sub"> 
   <a href="javascript:void(0);" class="waves-effect">
   <i class="fa fa-folder-open"></i> <span> Asignaciones </span> <span class="pull-right"><i class="ion ion-plus"></i></span></a>
   <ul class="list-unstyled" style="">
   <li><a href="asignaciones">Asignación de Materias</a></li>
   <li><a href="busquedaasignaciones">Búsqueda Asignaciones</a></li>
   </ul>
   </li>

   <li> <a href="busquedaestudiantes" class="waves-effect"><i class="fa fa-folder-open"></i><span> Búsqueda Estudiantes </span></a></li>

   <li> <a href="busquedarepresentantes" class="waves-effect"><i class="fa fa-folder-open"></i><span> Búsqueda Tutores </span></a></li>  

   <li class="has_sub"> 
   <a href="javascript:void(0);" class="waves-effect">
   <i class="fa fa-paste"></i><span> Gestión de Notas </span><span class="pull-right"><i class="ion ion-plus"></i></span></a>
   <ul class="list-unstyled" style="">
   <li><a href="fornotas">Registrar Notas</a></li>
   <li><a href="notasxcursos">Boletín por Cursos</a></li>
   </ul>
   </li>
   
   <li> <a href="logout" class="waves-effect"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
   
   </ul>
   </div>
   <!----- FIN DE MENU ----->
        

      <?php
         break; } 
      ?>

        <div class="clearfix"></div>
      </div>
    </div>
</div>

</body>
</html>
<?php } else { ?> 
    <script type='text/javascript' language='javascript'>
      alert('NO TIENES PERMISO PARA ACCEDER A ESTA PAGINA.\nCONSULTA CON EL ADMINISTRADOR PARA QUE TE DE ACCESO')  
    document.location.href='logout'   
        </script> 
<?php } } else { ?>
    <script type='text/javascript' language='javascript'>
      alert('NO TIENES PERMISO PARA ACCEDER AL SISTEMA.\nDEBERA DE INICIAR SESION')  
    document.location.href='logout'  
        </script> 
<?php } ?> 