<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
if ($_SESSION['acceso'] == "administrador") {

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
<script type="text/javascript" src="assets/script/validation.min.js"></script>
		<script type="text/javascript">
	$(document).ready(function(){
		$(".validacion").validate();
	});
		</script>
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
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-tasks"></i> Restauración de Base de Datos</h4>
<ol class="breadcrumb pull-right"><li><a href="panel">Inicio</a></li>
<li class="active">Restauración</li>
</ol>

<div class="clearfix"></div>

</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-database"></i>  Restauración de Base de Datos</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12">
<?php
error_reporting(E_ALL - E_NOTICE);
ini_set('upload_max_filesize', '80M');
ini_set('post_max_size', '80M');
ini_set('memory_limit', '-1'); //evita el error Fatal error: Allowed memory size of X bytes exhausted (tried to allocate Y bytes)...
ini_set('max_execution_time', 300); // es lo mismo que set_time_limit(300) ;
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300);
//En MYSQL archivo "my.ini" ==> max_allowed_packet = 22M
//"SET GLOBAL max_allowed_packet = 22M;"
//"SET GLOBAL connect_timeout = 20;"
//"SET GLOBAL net_read_timeout=50;"
//esto no se si solo es modificable en php.ini
ini_set('file_uploads','On'); 
ini_set('upload_tmp_dir','upload');

function run_split_sql($uploadfile, $host, $usuario,$passwd){
    $strSQLs = file_get_contents($uploadfile);
    unlink($uploadfile);
    //  Elimina lineas vacias o que empiezan por -- #   //   o entre /* y */
    // Elimna los espacios en blanco entre ; y \r\n
    // handle DOS and Mac encoded linebreaks
                    $strSQLs=preg_replace("/\r\n$/","\n",$strSQLs);
                    $strSQLs=preg_replace("/\r$/","\n",$strSQLs);
    $strSQLs = trim(preg_replace('/ {2,}/', ' ', $strSQLs));    // ----- remove multiple spaces ----- 
    $strSQLs = str_replace("\r","",$strSQLs);                     //los \r\n los dejamos solo en \n
    $lines=explode("\n",$strSQLs);
    $strSQLs = array();
    $in_comment = false;
    foreach ($lines as $key => $line){
        $line=trim($line); //preg_replace("#.*/#","",$line)
        $ignoralinea=(( "#" == $line[0] ) || ("--" == substr($line,0,2)) || (!$line) || ($line==""));
        if (!$ignoralinea){
            //Eliminar comentarios que empiezan por /* y terminan por */    
            if( preg_match("/^\/\*/", ($line)) )       $in_comment = true;
            if( !$in_comment )     $strSQLs[] = $line ;
            if( preg_match("/\*\//", ($line)) )      $in_comment = false;
        }
    }
    unset($lines);
    // Particionar en sentencias
    $IncludeDelimiter=false;
    $delimiter=";";
    $delimiterLen= 1;
    $sql="";
    // CONEXION 
    $conexion = new mysqli('localhost','allcodec_acadsis','AcademicSoft19','allcodec_academico',3306) or die ("No se puede conectar con el servidor MySQL: %s\n". $conexion->connect_error);
	
    $NumLin=0;
    foreach ($strSQLs as $key => $line){
        
        if ("DELIMITER" == substr($line,0,9)){  //empieza por DELIMITER
            $D=explode(" ",$line);
            $delimiter= $D[1];
            $delimiterLen= strlen($delimiter);
            $sql=($IncludeDelimiter)? $line ."\n" : "";
        }elseif (substr($line,-1*$delimiterLen) == $delimiter) { //hemos alcanzado el  Delimiter
                if (($NumLinea++ % 100)==0) {// ver con que base de datos estamos para poder reconectar caso de error
                        $respuesta = $conexion->query("select database() as db");
                        $row = $respuesta->fetch_array(MYSQLI_NUM);
                        $db=$row[0];
                }
                $sql .= ($IncludeDelimiter)? $line : substr($line,0,-1*$delimiterLen);
                $respuesta = $conexion->query($sql);
                if ($respuesta) echo "";
				
                    else {
     echo "";
                        if (!$conexion->ping() ){ 
							
							$conexion = new mysqli('localhost','root','','softacademy',3306) or die ("No se puede conectar con el servidor MySQL: %s\n". $conexion->connect_error);
                            $respuesta = $conexion->query($sql);
                            if ($respuesta) echo "<br>$NumLinea REEJECUTADO:  ". str_replace("\n"," ",substr($sql,0,130))."...";
                                else echo "<br><b><u>$NumLinea REPITE-E R R O R: ".$conexion->errno." :</u></b>". $conexion->error ." ====> ". substr($sql,0,1022)."...";
                        }
                    }    
                        
                $sql="";
        } else { 
                $sql .= $line ."\n";
        }
    }
    $conexion->close();    
}

if (isset($_POST['upload'])) {
    $uploadfile = "./" . basename($_FILES['userfile']['name']);
    print '';
    switch ($_FILES['userfile']['error']){
        case 0:
            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		
		echo"<br><div align='center' class='alert alert-success'>";
		echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
		echo "<span class='icon-ok-sign'></span> LA COPIA DE SEGURIDAD <b> $uploadfile </b> SE HA RESTAURADO CORRECTAMENTE </div>";
		
	   // echo" LA COPIA DE SEGURIDAD <b> $uploadfile </b> SE HA RESTAURADO CORRECTAMENTE</div>";
                    run_split_sql($uploadfile, $host, $usuario,$passwd );
             } else     echo "<br>¡Posible error en carga de archivos!";
            break;
        case 1: // UPLOAD_ERR_INI_SIZE
            echo "<br>El archivo sobrepasa el limite autorizado por el servidor(archivo php.ini) !";
            break;
        case 2: // UPLOAD_ERR_FORM_SIZE
            echo "<br>El archivo sobrepasa el limite autorizado en el formulario HTML !";
            break;
        case 3: // UPLOAD_ERR_PARTIAL
            echo "<br>El envio del archivo ha sido suspendido durante la transferencia!";
            break;
        case 4: // UPLOAD_ERR_NO_FILE
			echo "<br><font color='red'> Por Favor seleccione el backup de la base de datos para restaurar !</font>";
            break;
        default: 
            echo "<br>ERROR DESCONOCIDO !"; 
            break;
    }
    print "";
    unset($_POST['upload']);
    $_POST[]=array();
}
?>
 <form class="form validacion" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
    <INPUT type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAXFILESIZE; ?>">

                                                  <div id="error">
                                                 <!-- error will be shown here ! -->
                                                     </div> 
            <div class="box-body">
              <div class="row">
			  
                <div class="col-md-12">
				  <div class="form-group has-feedback">
                 <label>Realice la búsqueda del Archivo: <span class="symbol required"></span></label>
<input type="file" class="form-control" size="10" data-original-title="Subir Archivo" data-rel="tooltip" title="Por favor realice la búsqueda del archivo a restaurar" placeholder="Suba su Backup" name="userfile" id="userfile" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>  
                  </div><!-- /.form-group -->
                </div><!-- /.col -->

              </div><!-- /.row -->
            </div><br><!-- /.box-body -->
      
       <div class="text-right"> 
<button type="submit" name="upload" id="upload" class="btn btn-primary waves-effect waves-light"><span class="fa fa-cloud-upload"></span> Restaurar</button>
<button class="btn btn-danger" type="reset"><i class="fa fa-trash-o"></i> Limpiar</button>
                      </div>
                                </form>
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
