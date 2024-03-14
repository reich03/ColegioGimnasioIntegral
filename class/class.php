<?php
session_start();
require_once("classconexion.php");
//primero incluimos el script de securimage dohara.system@gmail.com
include_once("assets/captcha/securimage.php");
include_once('funciones_basicas.php');

ini_set('memory_limit', '-1'); //evita el error Fatal error: Allowed memory size of X bytes exhausted (tried to allocate Y bytes)...
ini_set('max_execution_time', 3800); // es lo mismo que set_time_limit(300) ; AZUL-#0D89F1 NARANJA-#f29e0c

############################################ CLASE LOGIN #############################################
class Login extends Db
{
	public function __construct()
	{
		parent::__construct();
	} 	

##########################  FUNCION PARA EXPIRAR SESSION POR INACTIVIDAD #######################
	public function ExpiraSession(){


	if(!isset($_SESSION['acceso'])){// Esta logeado?.
		header("Location: logout.php"); 
	}

	//Verifico el tiempo si esta seteado, caso contrario lo seteo.
	if(isset($_SESSION['time'])){
		$tiempo = $_SESSION['time'];
	}else{
		$tiempo = strtotime(date("Y-m-d h:i:s"));
	}

	$inactividad =360000; //600 equivale a 10 minutos

	$actual =  strtotime(date("Y-m-d h:i:s"));

	if( ($actual-$tiempo) >= $inactividad){
		?>					
		<script type='text/javascript' language='javascript'>
			alert('SU SESSION A EXPIRADO \nPOR FAVOR LOGUEESE DE NUEVO PARA ACCEDER AL SISTEMA') 
			document.location.href='logout'	 
		</script> 
		<?php

	}else{

		$_SESSION['time'] =$actual;

	} 
}

########################## FUNCION PARA EXPIRAR SESSION POR INACTIVIDAD #######################



###################### FUNCION PARA ACCEDER AL SISTEMA DE GESTIÓN ACADÉMICA #######################
	public function Logueo()
	{
		self::SetNames();
		if(empty($_POST["usuario"]) or empty($_POST["password"]))
		{
		echo "1";
		exit;
		}

		$img = new securimage();

		$valido_captcha = $img->check($_POST['captcha1']);
		
        if (!$valido_captcha){

        echo "2";
		exit;

		} else { 

	    $pass = sha1(md5($_POST["password"]));

		if ($_POST['select'] == "ADMINISTRADOR(A)" || $_POST['select']=="SECRETARIA") {

		$sql = "SELECT * FROM usuarios WHERE usuario = ? AND password = ? AND status = 'ACTIVO'";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_POST["usuario"], $pass));
		$num = $stmt->rowCount();
		if($num == 0)
		{
		echo "3";
		exit;
		}
		else
		{
			//if($row = $stmt->fetch())
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$p[]=$row;
			}
			$_SESSION["codigo"] = $p[0]["codigo"];
			$_SESSION["cedula"] = $p[0]["cedula"];
			$_SESSION["nombres"] = $p[0]["nombres"];
			$_SESSION["sexo"] = $p[0]["sexo"];
			$_SESSION["cargo"] = $p[0]["cargo"];
			$_SESSION["email"] = $p[0]["email"];
			$_SESSION["usuario"] = $p[0]["usuario"];
			$_SESSION["password"] = $p[0]["password"];
			$_SESSION["nivel"] = $p[0]["nivel"];
			$_SESSION["status"] = $p[0]["status"];
		    $_SESSION["select"] = $_POST['select'];
			
			$query = " insert into log values (null, ?, ?, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1,$a);
			$stmt->bindParam(2,$b);
			$stmt->bindParam(3,$c);
			$stmt->bindParam(4,$d);
			$stmt->bindParam(5,$e);
			
			$a = strip_tags($_SERVER['REMOTE_ADDR']);
			$b = strip_tags(date("Y-m-d h:i:s"));
			$c = strip_tags($_SERVER['HTTP_USER_AGENT']);
			$d = strip_tags($_SERVER['PHP_SELF']);
			$e = strip_tags($_POST["usuario"]);
			$stmt->execute();
			
			switch($_SESSION["nivel"])
	{
		     case 'ADMINISTRADOR(A)':
	         $_SESSION["acceso"]="administrador";
			
		   ?>
		   
			<script type="text/javascript">
            window.location="panel";
            </script>
			
		    <?php
		    break;
		    case 'SECRETARIA':
		    $_SESSION["acceso"]="secretaria";
			?>
		   
			<script type="text/javascript">
            window.location="panel";
            </script>
			
			<?php
		    break;
			}
		} 
		
	} else {

	$sql = "SELECT * FROM docentes WHERE ceddoc = ? AND clavedoc = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_POST["usuario"], $pass));
	$num = $stmt->rowCount();
	if($num == 0)
	{
		echo "3";
		exit;
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$p[]=$row;
		}

		$_SESSION["coddoc"] = $p[0]["coddoc"];
		$_SESSION["ceddoc"] = $p[0]["ceddoc"];
		$_SESSION["nomdoc"] = $p[0]["nomdoc"];
		$_SESSION["nombres"] = $p[0]["nomdoc"];
		$_SESSION["tlfdoc"] = $p[0]["tlfdoc"];
		$_SESSION["direcdoc"] = $p[0]["direcdoc"];
		$_SESSION["especdoc"] = $p[0]["especdoc"];
		$_SESSION["fecnacdoc"] = $p[0]["fecnacdoc"];
		$_SESSION["edocivildoc"] = $p[0]["edocivildoc"];
		$_SESSION["lugarnacdoc"] = $p[0]["lugarnacdoc"];
		$_SESSION["correodoc"] = $p[0]["correodoc"];
		$_SESSION["expedido"] = $p[0]["expedido"];
		$_SESSION["horasdoc"] = $p[0]["horasdoc"];
		$_SESSION["codcargodoc"] = $p[0]["codcargodoc"];
		$_SESSION["password"] = $p[0]["clavedoc"];
		$_SESSION["nivel"] = "DOCENTE";
		$_SESSION["select"] = $_POST['select'];
		$_SESSION["ingreso"] = strip_tags(date("d-m-Y h:i:s A"));

		$query = " insert into log values (null, ?, ?, ?, ?, ?); ";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1,$a);
		$stmt->bindParam(2,$b);
		$stmt->bindParam(3,$c);
		$stmt->bindParam(4,$d);
		$stmt->bindParam(5,$e);

		$a = strip_tags($_SERVER['REMOTE_ADDR']);
		$b = strip_tags(date("Y-m-d h:i:s"));
		$c = strip_tags($_SERVER['HTTP_USER_AGENT']);
		$d = strip_tags($_SERVER['PHP_SELF']);
		$e = strip_tags($_POST["usuario"]);
		$stmt->execute();

		switch($_SESSION["nivel"])
		{
			case 'DOCENTE':
			$_SESSION["acceso"]="docente";
			
			?>

			<script type="text/javascript">
				window.location="panel";
			</script>
			
			<?php
			break;
		       }
		    } 
		}
		
		//print_r($_POST);
		exit;
	}
}
###################### FUNCION PARA ACCEDER AL SISTEMA DE GESTIÓN ACADÉMICA #######################













################################ FUNCION RECUPERAR Y ACTUALIZAR PASSWORD ###############################

################################## FUNCION PARA RECUPERAR CLAVE ###################################
public function RecuperarPassword()
	{
		self::SetNames();
		if(empty($_POST["email"]))
		{
			echo "1";
			exit;
		}

		if ($_POST['select'] == "ADMINISTRADOR(A)" || $_POST['select']=="SECRETARIA") {
		
		$sql = "SELECT codigo, nombres, password, email FROM usuarios WHERE email = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_POST["email"]));
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "2";
		    exit;
		}
		else
		{
			//if($row = $stmt->fetch())
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$pa[] = $row;
			}
			$id = $pa[0]["codigo"];
			$nombres = $pa[0]["nombres"];
			$password = $pa[0]["password"];
		}
	
			$sql = " update usuarios set "
			  ." password = ? "
			  ." where "
			  ." codigo = ?;
			   ";
		    $stmt = $this->dbh->prepare($sql);
		    $stmt->bindParam(1, $password);
		    $stmt->bindParam(2, $codigo);
			
            $codigo = $id;
			$pass = strtoupper(generar_clave(10));
			$password = sha1(md5($pass));
            $stmt->execute();
		
       $para = $_POST["email"];
       $titulo = 'RECUPERACION DE PASSWORD';
       $header = 'From: ' . 'SISTEMA DE GESTION DE ACADEMICO';
       $msjCorreo = " Nombre: $nombres\n Nuevo Passw: $pass\n Mensaje: Por favor use esta nueva clave de acceso para ingresar al Sistema de Gestion de Academico\n";
       mail($para, $titulo, $msjCorreo, $header);
			
	echo "<span class='fa fa-check-square-o'></span> SU NUEVA CLAVE DE ACCESO LE FUE ENVIADA A SU CORREO";

	} else {

	$sql = "SELECT coddoc, nomdoc, correodoc FROM docentes WHERE correodoc = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute( array($_POST["email"]) );
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "2";
		exit;
	}
	else
	{
		
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$pa[] = $row;
		}
		$id = $pa[0]["coddoc"];
		$nombres = $pa[0]["nomdoc"];
	}
	
	$sql = "UPDATE docentes set "
	." clavedoc = ? "
	." where "
	." coddoc = ?;
	";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindParam(1, $password);
	$stmt->bindParam(2, $codigo);

	$codigo = $id;
	$pass = strtoupper(generar_clave(10));
	$password = sha1(md5($pass));
	$stmt->execute();

	$para = $_POST["email"];
	$titulo = 'RECUPERACION DE PASSWORD';
	$header = 'From: ' . 'SISTEMA DE GESTION DE ACADEMICO';
	$msjCorreo = " Nombre: $nombres\n Nuevo Passw: $pass\n Mensaje: Por favor use esta nueva clave de acceso para ingresar al Sistema de Gestion de Academico\n";
	mail($para, $titulo, $msjCorreo, $header);

	echo "<span class='fa fa-check-square-o'></span> SU NUEVA CLAVE DE ACCESO LE FUE ENVIADA A SU CORREO";

		 }
}	
################################## FUNCION PARA RECUPERAR CLAVE ###################################

############################# FUNCION PARA ACTUALIZAR PASSWORD  ##################################
	public function ActualizarPassword()
	{
		self::SetNames();
		if(empty($_POST["cedula"]))
		{
			echo "1";
			exit;
		} elseif(sha1(md5($_POST["password"]))==$_SESSION["password"]){

		echo "2";
		exit;

	   } elseif(sha1(md5($_POST["password"]))!=sha1(md5($_POST["password2"]))){

		echo "3";
		exit;
	   }

if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria") {

		$sql = " UPDATE usuarios set "
			  ." usuario = ?, "
			  ." password = ? "
			  ." where "
			  ." codigo = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $usuario);
		$stmt->bindParam(2, $password);
		$stmt->bindParam(3, $codigo);	
			
		$usuario = strip_tags($_POST["usuario"]);
		$password = sha1(md5($_POST["password"]));
		$codigo = strip_tags($_SESSION["codigo"]);
		$stmt->execute();
		
    echo "<span class='fa fa-check-square-o'></span> SU CLAVE DE ACCESO FUE ACTUALIZADA EXITOSAMENTE, SER&Aacute; EXPULSADO DE SU SESI&Oacute;N Y DEBER&Aacute; DE ACCEDER NUEVAMENTE";
		?>
		<script>
        function redireccionar(){location.href="logout.php";}
        setTimeout ("redireccionar()", 3000);
        </script>
		<?php
		exit;

	} else {

		$sql = "UPDATE docentes set "
		." clavedoc = ? "
		." where "
		." coddoc = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $password);
		$stmt->bindParam(2, $codigo);	

		$password = sha1(md5($_POST["password"]));
		$codigo = strip_tags($_POST["codigo"]);
		$stmt->execute();
		
		echo "<span class='fa fa-check-square-o'></span> SU CLAVE DE ACCESO FUE ACTUALIZADA EXITOSAMENTE, SER&Aacute; EXPULSADO DE SU SESI&Oacute;N Y DEBER&Aacute; DE ACCEDER NUEVAMENTE";
		?>
		<script>
			function redireccionar(){location.href="logout.php";}
			setTimeout ("redireccionar()", 3000);
		</script>
		<?php
		exit;

} 


	}
############################# FUNCION PARA ACTUALIZAR PASSWORD  ##################################

############################## FUNCION RECUPERAR Y ACTUALIZAR PASSWORD ##############################





































############################# FUNCION CONFIGURACION GENERAL DEL SISTEMA ##################################

########################### FUNCION ID CONFIGURACION DEL SISTEMA #########################
	public function ConfiguracionPorId()
	{
		self::SetNames();
		$sql = " select * from configuracion where id = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array('1') );
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
########################### FUNCION ID CONFIGURACION DEL SISTEMA #########################

########################### FUNCION  ACTUALIZAR CONFIGURACION ##############################
	public function ActualizarConfiguracion()
	{
		
		if(empty($_POST["ceddirector"]) or empty($_POST["director"]) or empty($_POST["codinstituto"]))
		{
			echo "1";
			exit;
		}
		$sql = " update configuracion set "
			  ." ceddirector = ?, "
			  ." director = ?, "
			  ." tlfdirec = ?, "
			  ." correodirec = ?, "
			  ." codinstituto = ?, "
			  ." nominstituto = ?, "
			  ." direcinstituto = ?, "
			  ." tlfinstituto = ?, "
			  ." correoinstituto = ?, "
			  ." inicioinscripcion = ?, "
			  ." fininscripcion = ?, "
			  ." trimestreactivo = ?, "
			  ." inicionotas = ?, "
			  ." finnotas = ?, "
			  ." diascrealapso = ? "
			  ." where "
			  ." id = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $ceddirector);
		$stmt->bindParam(2, $director);
		$stmt->bindParam(3, $tlfdirec);
		$stmt->bindParam(4, $correodirec);
		$stmt->bindParam(5, $codinstituto);
		$stmt->bindParam(6, $nominstituto);
		$stmt->bindParam(7, $direcinstituto);
		$stmt->bindParam(8, $tlfinstituto);
		$stmt->bindParam(9, $correoinstituto);
		$stmt->bindParam(10, $inicioinscripcion);
		$stmt->bindParam(11, $fininscripcion);
		$stmt->bindParam(12, $trimestreactivo);
		$stmt->bindParam(13, $inicionotas);
		$stmt->bindParam(14, $finnotas);
		$stmt->bindParam(15, $diascrealapso);
		$stmt->bindParam(16, $id);
			
		$ceddirector = strip_tags($_POST["ceddirector"]);
		$director = strip_tags($_POST["director"]);
		$tlfdirec = strip_tags($_POST["tlfdirec"]);
		$correodirec = strip_tags($_POST["correodirec"]);
		$codinstituto = strip_tags($_POST["codinstituto"]);
		$nominstituto = strip_tags($_POST["nominstituto"]);
		$direcinstituto = strip_tags($_POST["direcinstituto"]);
		$tlfinstituto = strip_tags($_POST["tlfinstituto"]);
		$correoinstituto = strip_tags($_POST["correoinstituto"]);
		$inicioinscripcion = strip_tags(date("Y-m-d",strtotime($_POST['inicioinscripcion'])));
		$fininscripcion = strip_tags(date("Y-m-d",strtotime($_POST['fininscripcion'])));
		$trimestreactivo = strip_tags($_POST["trimestreactivo"]);
		$inicionotas = strip_tags(date("Y-m-d",strtotime($_POST['desde'])));
		$finnotas = strip_tags(date("Y-m-d",strtotime($_POST['hasta'])));
		$diascrealapso = strip_tags($_POST["diascrealapso"]);
		$id = strip_tags($_POST["id"]);
		$stmt->execute();
		
	echo "<span class='fa fa-check-square-o'></span> LOS DATOS DE CONFIGURACI&Oacute;N DEL SISTEMA FUERON ACTUALIZADOS EXITOSAMENTE";
    exit;
}
########################### FUNCION  ACTUALIZAR CONFIGURACION ##############################
	
############################ FIN DE FUNCION CONFIGURACION GENERAL DEL SISTEMA ########################









































####################################### CLASE USUARIOS #############################################

################################## FUNCION REGISTRAR USUARIOS ###############################
	public function RegistrarUsuarios()
	{
		self::SetNames();
		if(empty($_POST["nombres"]) or empty($_POST["usuario"]) or empty($_POST["password"]))
		{
			echo "1";
			exit;
		}
		$sql = " select cedula from usuarios where cedula = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["cedula"]) );
		$num = $stmt->rowCount();
		if($num > 0)
		{
		
		echo "2";
		exit;
		}
		else
		{
		$sql = " select email from usuarios where email = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["email"]) );
		$num = $stmt->rowCount();
		if($num > 0)
		{
		
		echo "3";
		exit;
		}
		else
		{
		$sql = " select usuario from usuarios where usuario = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["usuario"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$query = " insert into usuarios values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $cedula);
			$stmt->bindParam(2, $nombres);
			$stmt->bindParam(3, $sexo);
			$stmt->bindParam(4, $cargo);
			$stmt->bindParam(5, $email);
			$stmt->bindParam(6, $usuario);
			$stmt->bindParam(7, $password);
			$stmt->bindParam(8, $nivel);
			$stmt->bindParam(9, $status);
			
			$cedula = strip_tags($_POST["cedula"]);
			$nombres = strip_tags($_POST["nombres"]);
			$sexo = strip_tags($_POST["sexo"]);
			$cargo = strip_tags($_POST["cargo"]);
			$email = strip_tags($_POST["email"]);
			$usuario = strip_tags($_POST["usuario"]);
			$password = sha1(md5($_POST["password"]));
			$nivel = strip_tags($_POST["nivel"]);
			$status = strip_tags($_POST["status"]);
			$stmt->execute();
		
		##################  SUBIR FOTO DE USUARIOS ######################################
         //datos del arhivo  
         if (isset($_FILES['imagen']['name'])) { $nombre_archivo = $_FILES['imagen']['name']; } else { $nombre_archivo =''; }
		 if (isset($_FILES['imagen']['type'])) { $tipo_archivo = $_FILES['imagen']['type']; } else { $tipo_archivo =''; }
		 if (isset($_FILES['imagen']['size'])) { $tamano_archivo = $_FILES['imagen']['size']; } else { $tamano_archivo =''; }  
         //compruebo si las características del archivo son las que deseo  
		 if ((strpos($tipo_archivo,'image/jpeg')!==false)&&$tamano_archivo<50000) 
		 {  
		 if (move_uploaded_file($_FILES['imagen']['tmp_name'], "fotos/".$nombre_archivo) && rename("fotos/".$nombre_archivo,"fotos/".$_POST["cedula"].".jpg"))
		 { 
		 ## se puede dar un aviso
		 } 
		 ## se puede dar otro aviso 
		 }
		##################  FINALIZA SUBIR FOTO DE USUARIOS ######################################

	echo "<span class='fa fa-check-square-o'></span> EL USUARIO HA SIDO REGISTRADO EXITOSAMENTE";
	exit;
		}
		else
		{
			echo "4";
			exit;
		   }
		}
	}
}
################################## FUNCION REGISTRAR USUARIOS ###############################

################################## FUNCION LISTAR USUARIOS ################################
	public function ListarUsuarios()
	{
		self::SetNames();
		$sql = " select * from usuarios ";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
################################## FUNCION LISTAR USUARIOS ################################

############################ FUNCION LISTAR LOGS DE USUARIOS #############################
	public function ListarLogs()
	{
		self::SetNames();
		if($_SESSION['acceso'] == "administrador") {
		$sql = " select * from log ORDER BY tiempo DESC ";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
		
	} else {
	         
			 $sql = " select * from log where usuario = '".$_SESSION["usuario"]."'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
############################ FUNCION LISTAR LOGS DE USUARIOS #############################

############################ FUNCION ID USUARIOS #################################
	public function UsuariosPorId()
	{
		self::SetNames();
		$sql = " select * from usuarios where codigo = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codigo"])) );
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
############################ FUNCION ID USUARIOS #################################
	
############################ FUNCION ACTUALIZAR USUARIOS ############################
	public function ActualizarUsuarios()
	{
		
		if(empty($_POST["cedula"]) or empty($_POST["nombres"]) or empty($_POST["usuario"]) or empty($_POST["password"]))
		{
			echo "1";
			exit;
		}
		self::SetNames();
		$sql = " select * from usuarios where codigo != ? and cedula = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["codigo"], $_POST["cedula"]) );
		$num = $stmt->rowCount();
		if($num > 0)
		{
		echo "2";
		exit;
		}
		else
		{
		$sql = " select email from usuarios where codigo != ? and email = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["codigo"], $_POST["email"]) );
		$num = $stmt->rowCount();
		if($num > 0)
		{
		echo "3";
		exit;
		}
		else
		{
		$sql = " select usuario from usuarios where codigo != ? and usuario = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["codigo"], $_POST["usuario"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
		$sql = " update usuarios set "
			  ." cedula = ?, "
			  ." nombres = ?, "
			  ." sexo = ?, "
			  ." cargo = ?, "
			  ." email = ?, "
			  ." usuario = ?, "
			  ." password = ?, "
			  ." nivel = ?, "
			  ." status = ? "
			  ." where "
			  ." codigo = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $cedula);
		$stmt->bindParam(2, $nombres);
		$stmt->bindParam(3, $sexo);
		$stmt->bindParam(4, $cargo);
		$stmt->bindParam(5, $email);
		$stmt->bindParam(6, $usuario);
		$stmt->bindParam(7, $password);
		$stmt->bindParam(8, $nivel);
		$stmt->bindParam(9, $status);
		$stmt->bindParam(10, $codigo);
			
		$cedula = strip_tags($_POST["cedula"]);
		$nombres = strip_tags($_POST["nombres"]);
		$sexo = strip_tags($_POST["sexo"]);
		$cargo = strip_tags($_POST["cargo"]);
		$email = strip_tags($_POST["email"]);
		$usuario = strip_tags($_POST["usuario"]);
		$password = sha1(md5($_POST["password"]));
		$nivel = strip_tags($_POST["nivel"]);
		$status = strip_tags($_POST["status"]);
		$codigo = strip_tags($_POST["codigo"]);
		$stmt->execute();
		
		##################  SUBIR FOTO DE USUARIOS ######################################
         //datos del arhivo  
         if (isset($_FILES['imagen']['name'])) { $nombre_archivo = $_FILES['imagen']['name']; } else { $nombre_archivo =''; }
		 if (isset($_FILES['imagen']['type'])) { $tipo_archivo = $_FILES['imagen']['type']; } else { $tipo_archivo =''; }
		 if (isset($_FILES['imagen']['size'])) { $tamano_archivo = $_FILES['imagen']['size']; } else { $tamano_archivo =''; }  
         //compruebo si las características del archivo son las que deseo  
		 if ((strpos($tipo_archivo,'image/jpeg')!==false)&&$tamano_archivo<50000) 
		 {  
		 if (move_uploaded_file($_FILES['imagen']['tmp_name'], "fotos/".$nombre_archivo) && rename("fotos/".$nombre_archivo,"fotos/".$_POST["cedula"].".jpg"))
		 { 
		 ## se puede dar un aviso
		 } 
		 ## se puede dar otro aviso 
		 }
		##################  FINALIZA SUBIR FOTO DE USUARIOS ######################################
		
    echo "<span class='fa fa-check-square-o'></span> EL USUARIO HA SIDO ACTUALIZADO EXITOSAMENTE";
	exit;
	
	}
		else
		{
			echo "4";
			exit;
			}
		}
	}
}
############################ FUNCION ACTUALIZAR USUARIOS ############################

################################ FUNCION ELIMINAR USUARIOS #################################
	public function EliminarUsuarios()
	{
		$sql = " select codigo from pagos where codigo = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codigo"])) );
		$num = $stmt->rowCount();
		if($num == 0)
		{

		$sql = " delete from usuarios where codigo = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codigo);
		$codigo = base64_decode($_GET["codigo"]);
		$stmt->execute();
		
		header("Location: usuarios?mesage=1");
		exit;
		   
		   }else {
		   
			header("Location: usuarios?mesage=2");
			exit;
		  }
			
	}
################################ FUNCION ELIMINAR USUARIOS #################################

################################## FIN DE CLASE USUARIOS #########################################




























##################################### CLASE PERIODO ESCOLAR ####################################

######################### FUNCION REGISTRAR PERIODO ESCOLAR #############################
	    public function RegistrarPeriodoEscolar() {
		
		self::SetNames();
		if(empty($_POST["periodo"]) or empty($_POST["descripcion"]) or empty($_POST["password"]))
		{
			echo "1";
			exit;
		}
					  
	   if (sha1(md5($_POST['password'])) != $_SESSION['password']) {
			   
		    echo "2";
			exit; 
		}	
			
	$sql = " SELECT * FROM periodoescolar";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
            $query = " insert into periodoescolar values (null, ?, ?, ?, ?, ?, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $periodo);
			$stmt->bindParam(2, $descripcion);
			$stmt->bindParam(3, $fechacreado);
			$stmt->bindParam(4, $mesesactivos);
			$stmt->bindParam(5, $interesmora);
			$stmt->bindParam(6, $cuotaunica);
			$stmt->bindParam(7, $diasvence);
			$stmt->bindParam(8, $statusperiodo);
			
			$periodo = strip_tags($_POST["periodo"]);
			$descripcion = strip_tags($_POST["descripcion"]);
			$fechacreado = strip_tags(date("Y-m-d"));
		    $mesesactivos = implode(", ",$_POST["mesesactivos"]);
			$interesmora = strip_tags($_POST["interesmora"]);
			$cuotaunica = strip_tags($_POST["cuotaunica"]);
			$diasvence = strip_tags($_POST["diasvence"]);
			$statusperiodo = strip_tags("1");
			$stmt->execute();
			
        echo "<span class='fa fa-check-square-o'></span> EL PERIODO ESCOLAR HA SIDO CREADO EXITOSAMENTE ";
		exit;
			
		} else {
		
		### CONSULTO LA BASE DE DATOS PARA SABER LA FECHA DEL ULTIMO LAPSO CREADO
		$sql = "select * from periodoescolar ORDER BY codperiodo DESC";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$fechacr = $row['fechacreado'];
				
		### BUSCO LA DIFERENCIA ENTRE LAS 2 FECHAS
		$fecha1 = date_create($fechacr);
		$fecha2 = date_create(date('Y-m-d'));
		$result = date_diff($fecha1, $fecha2);
		$dif = $result->format('%a');
		
		### CONSULTA LA BASE DE DATOS PARA SABER A CUANTOS DIAS ESTA CONFIGURADO PODER CREAR OTRO LAPSO
        $sql2 = "select diascrealapso from configuracion";
		foreach ($this->dbh->query($sql2) as $row2)
		{
			$this->p2[] = $row2;
		}
		$diascrealapso = $row2['diascrealapso'];		
		
	    if($dif < $diascrealapso) {
		
		    echo "3";
			exit; 
		
		} else {
		
		$sql = " select periodo from periodoescolar where periodo = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["periodo"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{    
		
		    $sql = " update periodoescolar set "
		      ." statusperiodo = ?;
			   ";
		    $stmt = $this->dbh->prepare($sql);
		    $stmt->bindParam(1,$statusperiodo);		
		    $statusperiodo = strip_tags("0");
		    $stmt->execute();
		
		    $query = " insert into periodoescolar values (null, ?, ?, ?, ?, ?, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $periodo);
			$stmt->bindParam(2, $descripcion);
			$stmt->bindParam(3, $fechacreado);
			$stmt->bindParam(4, $mesesactivos);
			$stmt->bindParam(5, $interesmora);
			$stmt->bindParam(6, $cuotaunica);
			$stmt->bindParam(7, $diasvence);
			$stmt->bindParam(8, $statusperiodo);
			
			$periodo = strip_tags($_POST["periodo"]);
			$descripcion = strip_tags($_POST["descripcion"]);
			$fechacreado = strip_tags(date("Y-m-d"));
		    $mesesactivos = implode(", ",$_POST["mesesactivos"]);
			$interesmora = strip_tags($_POST["interesmora"]);
			$cuotaunica = strip_tags($_POST["cuotaunica"]);
			$diasvence = strip_tags($_POST["diasvence"]);
			$statusperiodo = strip_tags("1");
			$stmt->execute();
			
			$sql = " update estudiantes set "
		      ." statusest = ?"
			  ." where "
			  ." statusest = '1';
			   ";
		    $stmt = $this->dbh->prepare($sql);
		    $stmt->bindParam(1,$statusest);		
		    $statusest = strip_tags("0");
		    $stmt->execute();
			
			$sql = " update padres set "
		      ." statuspad = ?"
			  ." where "
			  ." statuspad = '1';
			   ";
		    $stmt = $this->dbh->prepare($sql);
		    $stmt->bindParam(1,$statuspad);		
		    $statuspad = strip_tags("0");
		    $stmt->execute();
		 
	echo "<span class='fa fa-check-square-o'></span> EL PERIDO ESCOLAR HA SIDO CREADO EXITOSAMENTE ";
	exit;
		}
		else
		{
			echo "4";
			exit;
		}
		
		}
	}  
}
######################### FUNCION REGISTRAR PERIODO ESCOLAR #############################

######################## FUNCION LISTAR PERIODO ESCOLAR ##########################
	public function ListarPeriodoEscolar()
	{
		self::SetNames();
		$sql = " select * from periodoescolar ORDER BY codperiodo DESC ";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}	
######################## FUNCION LISTAR PERIODO ESCOLAR ##########################

#################### FUNCION VER PERIODO ESCOLAR ########################
	public function VerPeriodoEscolar()
	{
		self::SetNames();
		$sql = " select * from periodoescolar where codperiodo = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codperiodo"])) );
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
#################### FUNCION VER PERIODO ESCOLAR ########################

######################### FUNCION ID PERIODO ESCOLAR #########################
	public function PeriodoEscolarPorId()
	{
		self::SetNames();
		$sql = " select codperiodo from pagos where codperiodo = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codperiodo"])) );
		$num = $stmt->rowCount();
		if($num > 0)
		{
		?>
		<script type='text/javascript' language='javascript'>
	    alert('ESTE PERIODO ESCOLAR NO PUEDE SER MODIFICADO, TIENE PAGOS ASIGNADOS ACTUALMENTE')  
		document.location.href='periodoescolar'	 
        </script> 
		<?php
		exit;
		
		} else {
		
		$sql = " select * from periodoescolar where codperiodo = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codperiodo"])) );
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
}
######################### FUNCION ID PERIODO ESCOLAR #########################

####################### FUNCION ID PERIODO ACTIVO ############################
	public function PeriodoEscolarActivo()
	{
		self::SetNames();
		$sql = " select * from periodoescolar where statusperiodo = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array('1') );
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
####################### FUNCION ID PERIODO ACTIVO ############################

##################### FUNCION ACTUALIZAR PERIODO ESCOLAR #####################
	public function ActualizarPeriodoEscolar()
	{
		
		self::SetNames();
		if(empty($_POST["periodo"]) or empty($_POST["descripcion"]))
		{
			echo "1";
			exit;
		}
		$sql = " select periodo from periodoescolar where codperiodo != ? and periodo = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["codperiodo"], $_POST["periodo"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
		$sql = " update periodoescolar set "
			  ." periodo = ?, "
			  ." descripcion = ?, "
			  ." mesesactivos = ?, "
			  ." interesmora = ?, "
			  ." cuotaunica = ?, "
			  ." diasvence = ? "
			  ." where "
			  ." codperiodo = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $periodo);
		$stmt->bindParam(2, $descripcion);
		$stmt->bindParam(3, $mesesactivos);
		$stmt->bindParam(4, $interesmora);
		$stmt->bindParam(5, $cuotaunica);
		$stmt->bindParam(6, $diasvence);
		$stmt->bindParam(7, $codperiodo);
			
		$periodo = strip_tags($_POST["periodo"]);
		$descripcion = strip_tags($_POST["descripcion"]);
		$mesesactivos = implode(", ",$_POST["mesesactivos"]);
		$interesmora = strip_tags($_POST["interesmora"]);
		$cuotaunica = strip_tags($_POST["cuotaunica"]);
		$diasvence = strip_tags($_POST["diasvence"]);
		$codperiodo = strip_tags($_POST["codperiodo"]);
		$stmt->execute();
		
    echo "<span class='fa fa-check-square-o'></span> EL PERIODO ESCOLAR HA SIDO ACTUALIZADO EXITOSAMENTE";
    exit;
	}
		else
		{
			echo "2";
			exit;
		}
  }
##################### FUNCION ACTUALIZAR PERIODO ESCOLAR #####################

###################### FUNCION ELIMINAR PERIODO ESCOLAR ##########################
	
	public function EliminarPeriodoEscolar()
	{

		if($_SESSION['acceso'] == "administrador") {
		
		$sql = " select codperiodo from pagos where codperiodo = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codperiodo"])) );
		$num = $stmt->rowCount();
		if($num == 0)
		{

		$sql = " delete from periodoescolar where codperiodo = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codperiodo);
		$codperiodo = base64_decode($_GET["codperiodo"]);
		$stmt->execute();
		
		header("Location: periodoescolar?mesage=1");
		exit;
		   
		   }else {
		   
			header("Location: periodoescolar?mesage=2");
			exit;
		  }
			
	} else {
		
		header("Location: periodoescolar?mesage=3");
		exit;
	    }	
	}
###################### FUNCION ELIMINAR PERIODO ESCOLAR ##########################

############################## FIN DE CLASE PERIODO ESCOLAR ##############################































####################################### CLASE CAJAS DE VENTAS ######################################

###################################### FUNCION CODIGO PRODUCTO ##################################
	public function CodigoCaja()
	{
		self::SetNames();

		$sql = " select nrocaja from cajas ORDER BY nrocaja DESC limit 1 ";
		foreach ($this->dbh->query($sql) as $row){

			$nrocaja["nrocaja"]=$row["nrocaja"];

		}
		if(empty($nrocaja["nrocaja"]))
		{
			echo $nro = '001';

		} else
		{
			$resto = substr($nrocaja["nrocaja"], 0, -0);
			$coun = strlen($resto);
			$num     = substr($nrocaja["nrocaja"] , $coun);
			$dig     = $num + 1;
			$codigo = str_pad($dig, 3, "0", STR_PAD_LEFT);
			echo $nro = $codigo;
		}
	}
###################################### FUNCION CODIGO PRODUCTO ######################################


###################################### FUNCION REGISTRAR CAJAS ##################################
public function RegistrarCajas()
	{
		self::SetNames();
		if(empty($_POST["nrocaja"]) or empty($_POST["nombrecaja"]))
		{
			echo "1";
			exit;
		}
		$sql = " select nombrecaja from cajas where nombrecaja = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["nombrecaja"]) );
		$num = $stmt->rowCount();
		if($num > 0)
		{
		echo "2";
		exit;
		}
		else
		{
		$sql = " select codigo from cajas where codigo = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["codigo"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$query = " insert into cajas values (null, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $nrocaja);
			$stmt->bindParam(2, $nombrecaja);
			$stmt->bindParam(3, $codigo);
			
			$nrocaja = strip_tags($_POST["nrocaja"]);
			$nombrecaja = strip_tags($_POST["nombrecaja"]);
			$codigo = strip_tags($_POST["codigo"]);
			$stmt->execute();
			
			echo "<span class='fa fa-check-square-o'></span> LA CAJA PARA COBROS HA SIDO REGISTRADA EXITOSAMENTE </div>";
		    exit;
		}
		else
		{
			echo "3";
			exit;
		  }
	    }
     }
###################################### FUNCION REGISTRAR CAJAS ##################################

###################################### FUNCION LISTAR CAJAS ##################################
public function ListarCajas()
{
	self::SetNames();

	if($_SESSION['acceso'] == "administrador") {

	$sql = " select * from cajas LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo ";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;

     }  else {

	$sql = " select * from cajas LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo WHERE cajas.codigo = '".$_SESSION["codigo"]."'";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;

     }
}
###################################### FUNCION LISTAR CAJAS ##################################

################################## FUNCION LISTAR CAJAS ABIERTAS ##################################
public function ListarCajasAbiertas()
{
	self::SetNames();
	$sql = " select * from cajas INNER JOIN arqueocaja ON cajas.codcaja = arqueocaja.codcaja LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo WHERE arqueocaja.statusarqueo = '1'";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
}
################################### FUNCION LISTAR CAJAS ABIERTAS ##################################

###################################### FUNCION ID CAJAS ##################################
public function CajaPorId()
{
	self::SetNames();
	$sql = " select * from cajas INNER JOIN usuarios ON cajas.codigo = usuarios.codigo WHERE cajas.codcaja = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute( array(base64_decode($_GET["codcaja"])) );
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
###################################### FUNCION ID CAJAS ##################################

###################################### FUNCION ID CAJAS #2 #################################
	public function CajerosPorId()
	{
		self::SetNames();
		$sql = " select * from cajas INNER JOIN usuarios ON cajas.codigo = usuarios.codigo WHERE cajas.codcaja = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_GET["codcaja"]) );
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$this->p[] = $row;
				}
				return $this->p;
				$this->dbh=null;
			}
		}
###################################### FUNCION ID CAJAS #2 #################################

###################################### FUNCION ACTUALIZAR CAJAS ##################################
public function ActualizarCaja()
	{
		self::SetNames();
		if(empty($_POST["codcaja"]))
		{
			echo "1";
		    exit;
		}
		$sql = " select nombrecaja from cajas where codcaja != ? and nombrecaja = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["codcaja"], $_POST["nombrecaja"]) );
		$num = $stmt->rowCount();
		if($num > 0)
		{
		echo "2";
		exit;
		}
		else
		{
		$sql = " select codigo from cajas where codcaja != ? and codigo = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["codcaja"], $_POST["codigo"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
		$sql = " update cajas set "
		      ." nrocaja = ?, "
			  ." nombrecaja = ?, "
			  ." codigo = ? "
			  ." where "
			  ." codcaja = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $nrocaja);
		$stmt->bindParam(2, $nombrecaja);
		$stmt->bindParam(3, $codigo);
		$stmt->bindParam(4, $codcaja);
			
		$nrocaja = strip_tags($_POST["nrocaja"]);
		$nombrecaja = strip_tags($_POST["nombrecaja"]);
		$codigo = strip_tags($_POST["codigo"]);
		$codcaja = strip_tags($_POST["codcaja"]);
		$stmt->execute();
		
		echo "<span class='fa fa-check-square-o'></span> LA CAJA PARA COBRO HA SIDO ACTUALIZADA EXITOSAMENTE </div>";
		exit;
	}
		else
		{
			echo "3";
			exit;
		  }
	    }
     }
###################################### FUNCION ACTUALIZAR CAJAS ##################################

###################################### FUNCION ELIMINAR CAJAS ##################################
		public function EliminarCaja()
		{

		$sql = " select codcaja from arqueocaja where codcaja = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codcaja"])) );
		$num = $stmt->rowCount();
		if($num == 0)
		{

				$sql = " delete from cajas where codcaja = ? ";
				$stmt = $this->dbh->prepare($sql);
				$stmt->bindParam(1,$codcaja);
				$codcaja = base64_decode($_GET["codcaja"]);
				$stmt->execute();

				header("Location: cajas?mesage=1");
				exit;

			}else {

				header("Location: cajas?mesage=2");
				exit;
			}

		} 
###################################### FUNCION ELIMINAR CAJAS ##################################

###################################### FUNCION VERIFICA CAJAS ######################################
	public function MuestraCaja()
	{
		self::SetNames();
		$sql = " select * from cajas where codigo = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_SESSION["codigo"]) );
		$num = $stmt->rowCount();
		if($num==0)
		{
		echo "";		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
###################################### FUNCION VERIFICA CAJAS ######################################

#################################### FIN DE CLASE CAJAS DE VENTAS ###################################
































###################################### CLASE ARQUEO DE CAJA ######################################

###################################### FUNCION VERIFICA CAJAS ######################################
	public function VerificaCaja()
	{
		self::SetNames();
		$sql = " select * from cajas where codigo = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_SESSION["codigo"]) );
		$num = $stmt->rowCount();
		if($num==0)
		{

		if($_SESSION["acceso"] == "administrador") {

	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<center><span class='fa fa-info-circle'></span> DISCULPE, USTED NO TIENE ASIGNADA UNA CAJA PARA ARQUEOS, PARA REALIZAR ASIGNACION DE CAJA HAZ CLIC <a href='forarqueo'>AQUI</a></center>";
	echo "</div>";

	} else {

	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<center><span class='fa fa-info-circle'></span> DISCULPE, USTED NO TIENE ASIGNADA UNA CAJA PARA ARQUEOS, DIRIJASE AL ADMINISTRADOR DEL SISTEMA PARA QUE LE SEA ASIGNADA UNA CAJA</center>";
	echo "</div>";
	}
		}
		else
		{
			?>

			<div class="row">
        
  <?php if($_SESSION["acceso"] == "secretaria") { 

  	   $caja = new Login();
       $caja = $caja->MuestraCaja(); ?>

        <div class="col-md-6"> 
                               <div class="form-group has-feedback"> 
            <label class="control-label">Caja de Venta: <span class="symbol required"></span></label>
<input type="hidden" name="codcaja" id="codcaja" value="<?php echo $caja[0]['codcaja']; ?>"><input type="text" class="form-control" name="nrocaja" id="nrocaja" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" value="<?php echo $caja[0]['nrocaja'].": ".$caja[0]['nombrecaja']; ?>" readonly="readonly">
                        <i class="fa fa-desktop form-control-feedback"></i>  
                              </div> 
                        </div>  

<?php } else { ?>

        <div class="col-md-6"> 
                               <div class="form-group has-feedback"> 
          <label class="control-label">Cajas de Ventas: <span class="symbol required"></span></label>
  <i class="fa fa-bars form-control-feedback"></i>
 <input type="hidden" name="codarqueo" id="codarqueo" <?php if (isset($reg[0]['codarqueo'])) { ?> value="<?php echo $reg[0]['codarqueo']; ?>"<?php } ?>>

               <select name="codcaja" id="codcaja" class="form-control" required="" aria-required="true">
                  <option value="">SELECCIONE</option>
      <?php
      $caja = new Login();
      $caja = $caja->ListarCajas();
      for($i=0;$i<sizeof($caja);$i++){
                  ?>
  <option value="<?php echo $caja[$i]['codcaja']; ?>"><?php echo $caja[$i]['nombrecaja'].": ".$caja[$i]['nombres']; ?></option>       
                      <?php } ?>
                  </select>
                              </div> 
                        </div>
            
                              <?php } ?> 
                               
        <div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
          <label class="control-label">Hora de Apertura: <span class="symbol required"></span></label>
<?php if (isset($reg[0]['fechaapertura'])) { ?><input type="text" class="form-control" name="fechaapertura" id="fechaapertura" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Hora Apertura"  value="<?php echo $reg[0]['fechaapertura']; ?>" readonly="readonly"><?php } else { ?><input type="text" class="form-control" name="fecharegistro" id="fecharegistro" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Hora Apertura" readonly="readonly"><?php } ?>
                        <i class="fa fa-clock-o form-control-feedback"></i>  
                              </div> 
                        </div>
                        
        <div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
              <label class="control-label">Monto Inicial: <span class="symbol required"></span></label>
 <input type="text" class="form-control" name="montoinicial" id="montoinicial" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Monto Inicial" <?php if (isset($reg[0]['montoinicial'])) { ?> value="<?php echo $reg[0]['montoinicial']; ?>"<?php } ?> required="" aria-required="true">
                        <i class="fa fa-usd form-control-feedback"></i>  
                              </div> 
                        </div>    
        </div><br>
                   
					
			  
            <div class="text-right"> 
<?php  if (isset($_GET['codarqueo'])) { ?>
<button type="submit" name="btn-update" id="btn-update" class="btn btn-primary"><span class="fa fa-edit"></span> Actualizar</button>
		<?php } else { ?>
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><span class="fa fa-save"></span> Guardar</button>	
		<?php } ?>
<button class="btn btn-danger" type="reset"><i class="fa fa-times-circle"></i> Cancelar</button>  
                          </div>

			<?php
		}
	}
###################################### FUNCION VERIFICA CAJAS ######################################

################################ FUNCION PARA REGISTRAR ARQUEO DE CAJA ##############################
		public function RegistrarArqueoCaja()
		{
			self::SetNames();
			if(empty($_POST["codcaja"]) or empty($_POST["montoinicial"]) or empty($_POST["fecharegistro"]))
			{
				echo "1";
				exit;
			}

			$sql ="SELECT periodo from periodoescolar where statusperiodo = 1";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute();
			$num = $stmt->rowCount();
			if($num==0)
			{
				echo "2";	
				exit;
			}

			$conf = "select codperiodo from periodoescolar where statusperiodo = '1'";
			foreach ($this->dbh->query($conf) as $rowcon)
			{
				$this->pcon[] = $rowcon;
			}
			$codperiodo = $rowcon['codperiodo'];	

			$sql = " select codcaja from arqueocaja where codcaja = ? and statusarqueo = '1'";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute( array($_POST["codcaja"]) );
			$num = $stmt->rowCount();
			if($num == 0)
			{
				$query = " insert into arqueocaja values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
				$stmt = $this->dbh->prepare($query);
				$stmt->bindParam(1, $codcaja);
				$stmt->bindParam(2, $montoinicial);
				$stmt->bindParam(3, $ingresos);
				$stmt->bindParam(4, $egresos);
				$stmt->bindParam(5, $dineroefectivo);
				$stmt->bindParam(6, $diferencia);
				$stmt->bindParam(7, $comentarios);
				$stmt->bindParam(8, $fechaapertura);
				$stmt->bindParam(9, $fechacierre);
				$stmt->bindParam(10, $statusarqueo);
				$stmt->bindParam(11, $codperiodo);

				$codcaja = strip_tags($_POST["codcaja"]);
				$montoinicial = strip_tags($_POST["montoinicial"]);
				if (strip_tags(isset($_POST['ingresos']))) { $ingresos = strip_tags($_POST['ingresos']); } else { $ingresos =''; }
				if (strip_tags(isset($_POST['egresos']))) { $egresos = strip_tags($_POST['egresos']); } else { $egresos =''; }
				if (strip_tags(isset($_POST['dineroefectivo']))) { $dineroefectivo = strip_tags($_POST['dineroefectivo']); } else { $dineroefectivo =''; }
				if (strip_tags(isset($_POST['diferencia']))) { $diferencia = strip_tags($_POST['diferencia']); } else { $diferencia =''; }
				if (strip_tags(isset($_POST['comentarios']))) { $comentarios = strip_tags($_POST['comentarios']); } else { $comentarios =''; }
				$fechaapertura = strip_tags(date("Y-m-d h:i:s",strtotime($_POST['fecharegistro'])));
				$fechacierre = strip_tags(date("0000-00-00 00:00:00"));
				$statusarqueo = strip_tags("1");
				$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> EL ARQUEO DE CAJA HA SIDO REALIZADO EXITOSAMENTE";
			exit;
			}
			else
			{
				echo "3";
				exit;
			}
		}
############################### FUNCION PARA REGISTRAR ARQUEO DE CAJA #############################

################################# FUNCION PARA LISTAR ARQUEO DE CAJA ################################
		public function ListarArqueoCaja()
		{
			self::SetNames();
			
			if($_SESSION['acceso'] == "administrador") {

 $sql = " SELECT * FROM arqueocaja INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo LEFT JOIN periodoescolar ON arqueocaja.codperiodo = periodoescolar.codperiodo";
			foreach ($this->dbh->query($sql) as $row)
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;


			} else {


$sql = " SELECT * FROM arqueocaja INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo LEFT JOIN periodoescolar ON arqueocaja.codperiodo = periodoescolar.codperiodo WHERE cajas.codigo = '".$_SESSION["codigo"]."'";
			foreach ($this->dbh->query($sql) as $row)
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;

			}
		}
############################### FUNCION PARA LISTAR ARQUEO DE CAJA ##################################

################################ FUNCION ID ARQUEO DE CAJA #####################################
		public function ArqueoCajaPorId()
		{
			self::SetNames();
			$sql = " SELECT * FROM arqueocaja INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo LEFT JOIN periodoescolar ON arqueocaja.codperiodo = periodoescolar.codperiodo where arqueocaja.codarqueo = ? ";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute( array(base64_decode($_GET["codarqueo"])) );
			$num = $stmt->rowCount();
			if($num==0)
			{
				echo "";
			}
			else
			{
				if($row = $stmt->fetch(PDO::FETCH_ASSOC))
					{
						$this->p[] = $row;
					}
					return $this->p;
					$this->dbh=null;
				}
			}
######################################### FUNCION ID ARQUEO DE CAJA #################################

############################### FUNCION PARA CERRAR ARQUEO DE CAJA ##################################
			public function CerrarArqueoCaja()
			{

				self::SetNames();
if(empty($_POST["codarqueo"]) or empty($_POST["codcaja"]) or empty($_POST["montoinicial"]) or empty($_POST["dineroefectivo"]))
				{
					echo "1";
					exit;
				}

				$sql = " update arqueocaja set "
				." dineroefectivo = ?, "
				." diferencia = ?, "
				." comentarios = ?, "
				." fechacierre = ?, "
				." statusarqueo = ? "
				." where "
				." codarqueo = ?;
				";
				$stmt = $this->dbh->prepare($sql);
				$stmt->bindParam(1, $dineroefectivo);
				$stmt->bindParam(2, $diferencia);
				$stmt->bindParam(3, $comentarios);
				$stmt->bindParam(4, $fechacierre);
				$stmt->bindParam(5, $statusarqueo);
				$stmt->bindParam(6, $codarqueo);

				$dineroefectivo = strip_tags($_POST["dineroefectivo"]);
				$diferencia = strip_tags($_POST["diferencia"]);
				$comentarios = strip_tags($_POST['comentarios']);
				$fechacierre = strip_tags(date("Y-m-d h:i:s"));
				$statusarqueo = strip_tags("0");
				$codarqueo = strip_tags($_POST["codarqueo"]);
				$stmt->execute();

		echo "<span class='fa fa-check-square-o'></span> EL ARQUEO DE CAJA HA SIDO CERRADO EXITOSAMENTE";
		exit;
	}
################################# FUNCION PARA CERRAR ARQUEO DE CAJA ################################

############################# FUNCION BUSCAR ARQUEOS POR FECHAS ###############################
public function BuscarArqueosxFechas() 
	       {
		self::SetNames();

	if ($_SESSION['acceso'] == "administrador") {
		
$sql = "SELECT * FROM arqueocaja INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo LEFT JOIN periodoescolar ON arqueocaja.codperiodo = periodoescolar.codperiodo WHERE DATE_FORMAT(arqueocaja.fechaapertura,'%Y-%m-%d') >= ? AND DATE_FORMAT(arqueocaja.fechaapertura,'%Y-%m-%d') <= ? AND arqueocaja.codperiodo = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim(date("Y-m-d",strtotime($_GET['desde']))));
		$stmt->bindValue(2, trim(date("Y-m-d",strtotime($_GET['hasta']))));
		$stmt->bindValue(3, trim($_GET['codperiodo']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<center><div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<span class='fa fa-info-circle'></span> NO EXISTEN ARQUEOS PARA LAS FECHAS INGRESADA</div></center>";
	exit;
		}
		else
		{
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
	}
	
} else {

$sql = "SELECT * FROM arqueocaja INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo LEFT JOIN periodoescolar ON arqueocaja.codperiodo = periodoescolar.codperiodo WHERE DATE_FORMAT(arqueocaja.fechaapertura,'%Y-%m-%d') >= ? AND DATE_FORMAT(arqueocaja.fechaapertura,'%Y-%m-%d') <= ?  AND arqueocaja.codperiodo = ? AND cajas.codigo = '".$_SESSION["codigo"]."'";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim(date("Y-m-d",strtotime($_GET['desde']))));
		$stmt->bindValue(2, trim(date("Y-m-d",strtotime($_GET['hasta']))));
		$stmt->bindValue(3, trim($_GET['codperiodo']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
		echo "<center><div class='alert alert-danger'>";
		echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
		echo "<span class='fa fa-info-circle'></span> NO EXISTEN ARQUEOS PARA LAS FECHAS INGRESADA</div></center>";
		exit;
		}
		else
		{
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
	     }	
    }
}
############################# FUNCION BUSCAR ARQUEOS POR FECHAS ###############################

#################################### FIN DE CLASE ARQUEO DE CAJA #####################################












































##################################### CLASE MOVIMIENTOS DE CAJAS ####################################

########################### FUNCION PARA REGISTRAR MOVIMIENTOS DE CAJAS ########################
public function RegistrarMovimientoCajas()
{
	self::SetNames();
	if(empty($_POST["tipomovimientocaja"]) or empty($_POST["codcaja"]) or empty($_POST["montomovimientocaja"]))
	{
		echo "1";
		exit;
	}

	$sql ="SELECT periodo from periodoescolar where statusperiodo = 1";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute();
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "2";	
		exit;
	}

	$conf = "select codperiodo from periodoescolar where statusperiodo = '1'";
	foreach ($this->dbh->query($conf) as $rowcon)
	{
		$this->pcon[] = $rowcon;
	}
	$codperiodo = $rowcon['codperiodo'];

	$sql = " SELECT * FROM arqueocaja INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja WHERE arqueocaja.codcaja = ".$_POST["codcaja"]." AND statusarqueo = '1'";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute();
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "3";
		exit;

	}  
	else if($_POST["montomovimientocaja"]>0)
	{


#################### AQUI AGREGAMOS EL INGRESO A ARQUEO DE CAJA ####################
		$sql = "select montoinicial, ingresos, egresos from arqueocaja where codcaja = '".$_POST["codcaja"]."'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$inicial = $row['montoinicial'];
		$ingreso = $row['ingresos'];
		$egresos = $row['egresos'];
		$total = $inicial+$ingreso-$egresos;

		if($_POST["tipomovimientocaja"]=="INGRESO"){

			$sql = " update arqueocaja set "
			." ingresos = ? "
			." where "
			." codcaja = ? and statusarqueo = '1';
			";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $ingresos);
			$stmt->bindParam(2, $codcaja);

			$ingresos = rount($_POST["montomovimientocaja"]+$ingreso,2);
			$codcaja = strip_tags($_POST["codcaja"]);
			$stmt->execute();

			$query = " insert into movimientoscajas values (null, ?, ?, ?, ?, ?, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $tipomovimientocaja);
			$stmt->bindParam(2, $codcaja);
			$stmt->bindParam(3, $nrorecibo);
			$stmt->bindParam(4, $montomovimientocaja);
			$stmt->bindParam(5, $descripcionmovimientocaja);
			$stmt->bindParam(6, $fechamovimientocaja);
			$stmt->bindParam(7, $codperiodo);
			$stmt->bindParam(8, $codigo);

			$tipomovimientocaja = strip_tags($_POST["tipomovimientocaja"]);
			$codcaja = strip_tags($_POST["codcaja"]);
			$nrorecibo = strip_tags($_POST["nrorecibo"]);
			$montomovimientocaja = strip_tags($_POST["montomovimientocaja"]);
			$descripcionmovimientocaja = strip_tags($_POST["descripcionmovimientocaja"]);
			$fechamovimientocaja = strip_tags(date("Y-m-d",strtotime($_POST['fechamovimientocaja'])));
			$codigo = strip_tags($_SESSION["codigo"]);
			$stmt->execute();

		} else {

			if($_POST["montomovimientocaja"]>$total){

				echo "4";
				exit;

			} else {

				$sql = " update arqueocaja set "
				." egresos = ? "
				." where "
				." codcaja = ? and statusarqueo = '1';
				";
				$stmt = $this->dbh->prepare($sql);
				$stmt->bindParam(1, $egresos);
				$stmt->bindParam(2, $codcaja);

				$egresos = rount($_POST["montomovimientocaja"]+$egresos,2);
				$codcaja = strip_tags($_POST["codcaja"]);
				$stmt->execute();

				$query = " insert into movimientoscajas values (null, ?, ?, ?, ?, ?, ?, ?, ?); ";
				$stmt = $this->dbh->prepare($query);
				$stmt->bindParam(1, $tipomovimientocaja);
				$stmt->bindParam(2, $codcaja);
				$stmt->bindParam(3, $nrorecibo);
				$stmt->bindParam(4, $montomovimientocaja);
				$stmt->bindParam(5, $descripcionmovimientocaja);
				$stmt->bindParam(6, $fechamovimientocaja);
				$stmt->bindParam(7, $codperiodo);
				$stmt->bindParam(8, $codigo);

				$tipomovimientocaja = strip_tags($_POST["tipomovimientocaja"]);
				$codcaja = strip_tags($_POST["codcaja"]);
				$nrorecibo = strip_tags($_POST["nrorecibo"]);
				$montomovimientocaja = strip_tags($_POST["montomovimientocaja"]);
				$descripcionmovimientocaja = strip_tags($_POST["descripcionmovimientocaja"]);
				$fechamovimientocaja = strip_tags(date("Y-m-d",strtotime($_POST['fechamovimientocaja'])));
				$codigo = strip_tags($_SESSION["codigo"]);
				$stmt->execute();

			}

		}

	echo "<span class='fa fa-check-square-o'></span> EL MOVIMIENTO DE CAJA HA SIDO REGISTRADO EXITOSAMENTE";
	exit;
	}
	else
	{
		echo "5";
		exit;
	}
}
########################### FUNCION PARA REGISTRAR MOVIMIENTOS DE CAJAS ########################

######################### FUNCION PARA LISTAR MOVIMIENTOS DE CAJAS ############################ 
public function ListarMovimientoCajas()
{
            self::SetNames();
     
     if($_SESSION['acceso'] == "administrador") {

 $sql = " SELECT * FROM movimientoscajas INNER JOIN cajas ON movimientoscajas.codcaja = cajas.codcaja LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo LEFT JOIN periodoescolar ON movimientoscajas.codperiodo = periodoescolar.codperiodo ORDER BY movimientoscajas.fechamovimientocaja DESC ";
			foreach ($this->dbh->query($sql) as $row)
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;

          } else {

            $sql = " SELECT * FROM movimientoscajas INNER JOIN cajas ON movimientoscajas.codcaja = cajas.codcaja LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo LEFT JOIN periodoescolar ON movimientoscajas.codperiodo = periodoescolar.codperiodo WHERE movimientoscajas.codigo = '".$_SESSION["codigo"]."'";
			foreach ($this->dbh->query($sql) as $row)
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
       } 
}
######################### FUNCION PARA LISTAR MOVIMIENTOS DE CAJAS ########################### 

######################## FUNCION PARA SELECCIONAR MOVIMIENTOS DE CAJAS ###########################
public function MovimientoCajasPorId()
{
self::SetNames();
$sql = " SELECT * from movimientoscajas LEFT JOIN cajas ON movimientoscajas.codcaja = cajas.codcaja LEFT JOIN usuarios ON movimientoscajas.codigo = usuarios.codigo LEFT JOIN periodoescolar ON movimientoscajas.codperiodo = periodoescolar.codperiodo WHERE movimientoscajas.codmovimientocaja = ?";
$stmt = $this->dbh->prepare($sql);
$stmt->execute( array(base64_decode($_GET["codmovimientocaja"])) );
$num = $stmt->rowCount();
if($num==0)
{
	echo "";
}
else
{
	if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
######################### FUNCION PARA SELECCIONAR MOVIMIENTOS DE CAJAS ############################

####################### FUNCION PARA ACTUALIZAR MOVIMIENTOS DE CAJAS ########################
public function ActualizarMovimientoCajas()
{
	self::SetNames();
if(empty($_POST["tipomovimientocaja"]) or empty($_POST["codcaja"]) or empty($_POST["montomovimientocaja"]))
	{
		echo "1";
		exit;
	}

	if($_POST["montomovimientocaja"]>0)
	{

	#################### AQUI AGREGAMOS EL INGRESO A ARQUEO DE CAJA ####################
	$sql = "select montoinicial, ingresos, egresos from arqueocaja where codcaja = '".$_POST["codcaja"]."' and statusarqueo = '1'";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	$inicial = $row['montoinicial'];
	$ingreso = $row['ingresos'];
	$egreso = $row['egresos'];
	$total = $inicial+$ingreso-$egreso;
	$montomovimientocaja = strip_tags($_POST["montomovimientocaja"]);
	$movimientodb = strip_tags($_POST["montomovimientocajadb"]);
	$totalmovimiento = rount($montomovimientocaja-$movimientodb,2);

	if($_POST["tipomovimientocaja"]=="INGRESO"){

	$sql = " update arqueocaja set "
		." ingresos = ? "
		." where "
		." codcaja = ? and statusarqueo = '1';
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $ingresos);
		$stmt->bindParam(2, $codcaja);

		$ingresos = rount($totalmovimiento+$ingreso,2);
		$codcaja = strip_tags($_POST["codcaja"]);
		$stmt->execute();

	$sql = " update movimientoscajas set "
		." tipomovimientocaja = ?, "
		." codcaja = ?, "
		." nrorecibo = ?, "
		." montomovimientocaja = ?, "
		." descripcionmovimientocaja = ?, "
		." fechamovimientocaja = ? "
		." where "
		." codmovimientocaja = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $tipomovimientocaja);
		$stmt->bindParam(2, $codcaja);
		$stmt->bindParam(3, $nrorecibo);
		$stmt->bindParam(4, $montomovimientocaja);
		$stmt->bindParam(5, $descripcionmovimientocaja);
		$stmt->bindParam(6, $fechamovimientocaja);
		$stmt->bindParam(7, $codmovimientocaja);

		$tipomovimientocaja = strip_tags($_POST["tipomovimientocaja"]);
		$codcaja = strip_tags($_POST["codcaja"]);
		$nrorecibo = strip_tags($_POST["nrorecibo"]);
		$montomovimientocaja = strip_tags($_POST["montomovimientocaja"]);
		$descripcionmovimientocaja = strip_tags($_POST["descripcionmovimientocaja"]);
		$fechamovimientocaja = strip_tags(date("Y-m-d",strtotime($_POST['fechamovimientocaja'])));
		$codmovimientocaja = strip_tags($_POST["codmovimientocaja"]);
		$stmt->execute();

	} else {

		   if($totalmovimiento>$total){
		
		echo "2";
		exit;

	         } else {

	$sql = " update arqueocaja set "
		." egresos = ? "
		." where "
		." codcaja = ? and statusarqueo = '1';
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $egresos);
		$stmt->bindParam(2, $codcaja);

		$egresos = rount($totalmovimiento+$egreso,2);
		$codcaja = strip_tags($_POST["codcaja"]);
		$stmt->execute();

	$sql = " update movimientoscajas set "
		." tipomovimientocaja = ?, "
		." codcaja = ?, "
		." nrorecibo = ?, "
		." montomovimientocaja = ?, "
		." descripcionmovimientocaja = ?, "
		." fechamovimientocaja = ? "
		." where "
		." codmovimientocaja = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $tipomovimientocaja);
		$stmt->bindParam(2, $codcaja);
		$stmt->bindParam(3, $nrorecibo);
		$stmt->bindParam(4, $montomovimientocaja);
		$stmt->bindParam(5, $descripcionmovimientocaja);
		$stmt->bindParam(6, $fechamovimientocaja);
		$stmt->bindParam(7, $codmovimientocaja);

		$tipomovimientocaja = strip_tags($_POST["tipomovimientocaja"]);
		$codcaja = strip_tags($_POST["codcaja"]);
		$nrorecibo = strip_tags($_POST["nrorecibo"]);
		$montomovimientocaja = strip_tags($_POST["montomovimientocaja"]);
		$descripcionmovimientocaja = strip_tags($_POST["descripcionmovimientocaja"]);
		$fechamovimientocaja = strip_tags(date("Y-m-d",strtotime($_POST['fechamovimientocaja'])));
		$codmovimientocaja = strip_tags($_POST["codmovimientocaja"]);
		$stmt->execute();

	        }
	}	
	
echo "<span class='fa fa-check-square-o'></span> EL MOVIMIENTO DE CAJA HA SIDO ACTUALIZADO EXITOSAMENTE";
exit;
	}
	else
	{
		echo "2";
		exit;
	}
}
########################## FUNCION PARA ACTUALIZAR MOVIMIENTOS DE CAJAS ###########################	

######################## FUNCION PARA ELIMINAR MOVIMIENTOS DE CAJAS #########################
public function EliminarMovimientoCajas()
{
	if($_SESSION['acceso'] == "administrador") {

#################### AQUI AGREGAMOS EL INGRESO A ARQUEO DE CAJA ####################
	$sql = "select montoinicial, ingresos, egresos from arqueocaja where codcaja = '".base64_decode($_GET["codcaja"])."' and statusarqueo = '1'";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	$inicial = $row['montoinicial'];
	$ingreso = $row['ingresos'];
	$egreso = $row['egresos'];

if(base64_decode($_GET["tipomovimientocaja"])=="INGRESO"){

		$sql = " update arqueocaja set "
		." ingresos = ? "
		." where "
		." codcaja = ? and statusarqueo = '1';
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $ingresos);
		$stmt->bindParam(2, $codcaja);

		$entro = base64_decode($_GET["montomovimientocaja"]);
		$ingresos = number_format($ingreso-$entro,2);
		$codcaja = base64_decode($_GET["codcaja"]);
		$stmt->execute();

} else {

		$sql = " update arqueocaja set "
		." egresos = ? "
		." where "
		." codcaja = ? and statusarqueo = '1';
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $egresos);
		$stmt->bindParam(2, $codcaja);

		$salio = base64_decode($_GET["montomovimientocaja"]);
		$egresos = number_format($egreso-$salio,2);
		$codcaja = base64_decode($_GET["codcaja"]);
		$stmt->execute();
       }

		$sql = " delete from movimientoscajas where codmovimientocaja = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codmovimientocaja);
		$codmovimientocaja = base64_decode($_GET["codmovimientocaja"]);
		$stmt->execute();

		header("Location: movimientoscajas?mesage=1");
		exit;

	} else {

		header("Location: movimientoscajas?mesage=2");
		exit;
	} 
}
############################# FUNCION PARA ELIMINAR MOVIMIENTOS DE CAJAS  ##########################

############################# FUNCION BUSCAR MOVIMIENTOS POR FECHAS #############################
	public function BuscarMovimientosxFechas() 
	{
		self::SetNames();

	if ($_SESSION['acceso'] == "administrador") {
		
$sql = "SELECT * FROM movimientoscajas INNER JOIN cajas ON movimientoscajas.codcaja = cajas.codcaja LEFT JOIN usuarios ON movimientoscajas.codigo = usuarios.codigo LEFT JOIN periodoescolar ON movimientoscajas.codperiodo = periodoescolar.codperiodo WHERE movimientoscajas.codcaja = ? AND DATE_FORMAT(movimientoscajas.fechamovimientocaja,'%Y-%m-%d') >= ? AND DATE_FORMAT(movimientoscajas.fechamovimientocaja,'%Y-%m-%d') <= ? AND movimientoscajas.codperiodo = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim(base64_decode($_GET['codcaja'])));
		$stmt->bindValue(2, trim(date("Y-m-d",strtotime($_GET['desde']))));
		$stmt->bindValue(3, trim(date("Y-m-d",strtotime($_GET['hasta']))));
		$stmt->bindValue(4, trim($_GET['codperiodo']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{

echo "<div class='alert alert-danger'>";
echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
echo "<center><span class='fa fa-info-circle'></span> NO EXISTEN MOVIMIENTOS DE ESTA CAJA PARA LAS FECHAS INGRESADA</center>";
echo "</div>";
exit;
		}
		else
		{
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$this->p[]=$row;
				}
				return $this->p;
				$this->dbh=null;
			}
	
} else {

$sql = "SELECT * FROM movimientoscajas INNER JOIN cajas ON movimientoscajas.codcaja = cajas.codcaja LEFT JOIN usuarios ON movimientoscajas.codigo = usuarios.codigo LEFT JOIN periodoescolar ON movimientoscajas.codperiodo = periodoescolar.codperiodo WHERE movimientoscajas.codcaja = ? AND DATE_FORMAT(movimientoscajas.fechamovimientocaja,'%Y-%m-%d') >= ? AND DATE_FORMAT(movimientoscajas.fechamovimientocaja,'%Y-%m-%d') <= ? AND movimientoscajas.codperiodo = ? AND movimientoscajas.codigo = '".$_SESSION["codigo"]."'";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim(base64_decode($_GET['codcaja'])));
		$stmt->bindValue(2, trim(date("Y-m-d",strtotime($_GET['desde']))));
		$stmt->bindValue(3, trim(date("Y-m-d",strtotime($_GET['hasta']))));
		$stmt->bindValue(4, trim($_GET['codperiodo']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{

echo "<div class='alert alert-danger'>";
echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
echo "<center><span class='fa fa-info-circle'></span> NO EXISTEN MOVIMIENTOS DE ESTA CAJA PARA LAS FECHAS INGRESADA</center>";
echo "</div>";
exit;
		}
		else
		{
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$this->p[]=$row;
				}
				return $this->p;
				$this->dbh=null;
			}
    }
}
############################# FUNCION BUSCAR MOVIMIENTOS POR FECHAS #############################

################################# FIN DE CLASE MOVIMIENTOS DE CAJAS ################################






























###################################### CLASE TURNOS #####################################

################################### FUNCION REGISTRAR TURNOS ##################################
	public function RegistrarTurno()
	{
		self::SetNames();
		if(empty($_POST["turno"]))
		{
			echo "1";
			exit;
		}
				
    $sql = " select codturno from turnos ORDER BY codturno DESC limit 1 ";
	foreach ($this->dbh->query($sql) as $row){

      $codturno["codturno"]=$row["codturno"];
      }
          if(empty($codturno["codturno"]))
           {
			  $codturno = 'T001';
     }else
           {
               $num     = substr($codturno["codturno"] , 1);
               $dig     = $num + 1;
               $cod = str_pad($dig, 3, "0", STR_PAD_LEFT);
			   $codturno = 'T'.$cod;
         }

        $sql = " select * from turnos where turno = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["turno"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$query = " insert into turnos values (?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codturno);
			$stmt->bindParam(2, $turno);
			
		    $turno = strip_tags($_POST["turno"]);
			$stmt->execute();

	echo "<span class='fa fa-check-square-o'></span> EL TURNO HA SIDO REGISTRADO EXITOSAMENTE";
    exit;
		}
		else
		{
			echo "2";
			exit;
		}
	}
################################### FUNCION REGISTRAR TURNOS ##################################

################################ FUNCION LISTAR TURNOS #######################################
	public function ListarTurno()
	{
		self::SetNames();
		$sql = " select * from turnos";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
################################ FUNCION LISTAR TURNOS #######################################

#################################### FUNCION ID TURNOS #####################################
	public function TurnoPorId()
	{
		self::SetNames();
		$sql = " select * from turnos where codturno = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codturno"])) );
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
#################################### FUNCION ID TURNOS #####################################
	
################################## FUNCION ACTUALIZAR TURNOS #################################
	public function ActualizarTurno()
	{
		
		self::SetNames();
		if(empty($_POST["codturno"]) or empty($_POST["turno"]))
		{
			echo "1";
			exit;
		}
		$sql = " select * from turnos where codturno != ? and turno = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["codturno"], $_POST["turno"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
		$sql = " update turnos set "
			  ." turno = ? "
			  ." where "
			  ." codturno = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $turno);
		$stmt->bindParam(2, $codturno);
			
		$turno = strip_tags($_POST["turno"]);
		$codturno = strip_tags($_POST["codturno"]);
		$stmt->execute();
		
    echo "<span class='fa fa-check-square-o'></span> EL TURNO HA SIDO ACTUALIZADO EXITOSAMENTE";
    exit;
	}
		else
		{
			echo "2";
			exit;
		}
  }
################################## FUNCION ACTUALIZAR TURNOS #################################

################################# FUNCION ELIMINAR TURNOS ##################################
	
	public function EliminarTurno()
	{
		if($_SESSION['acceso'] == "administrador") {
		
		$sql = " select codturno from pagos where codturno = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codturno"])) );
		$num = $stmt->rowCount();
		if($num == 0)
		{

		$sql = " delete from turnos where codturno = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codturno);
		$codturno = base64_decode($_GET["codturno"]);
		$stmt->execute();
		
		header("Location: turnos?mesage=1");
		exit;
		   
		   }else {
		   
			header("Location: turnos?mesage=2");
			exit;
		  }
			
	} else {
		
		header("Location: turnos?mesage=3");
		exit;
	    }	
	}
################################# FUNCION ELIMINAR TURNOS ##################################

##################################### FIN DE CLASE TURNOS ########################################



































########################################## CLASE NIVELES #########################################

################################### FUNCION REGISTRAR NIVELES ##################################
	public function RegistrarNivel()
	{
		self::SetNames();
		if(empty($_POST["nivel"]) or empty($_POST["pagonivel"]))
		{
			echo "1";
			exit;
		}

       $sql = " select codnivel from niveles ORDER BY codnivel DESC limit 1 ";
	   foreach ($this->dbh->query($sql) as $row){

      $codnivel["codnivel"]=$row["codnivel"];
      }
          if(empty($codnivel["codnivel"]))
           {
			   $codnivel = 'N001';
     }else
           {
               $num     = substr($codnivel["codnivel"] , 1);
               $dig     = $num + 1;
               $cod = str_pad($dig, 3, "0", STR_PAD_LEFT);
			    $codnivel = 'N'.$cod;
         }

		$sql = " select * from niveles where nivel = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["nivel"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$query = " insert into niveles values (?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codnivel);
			$stmt->bindParam(2, $nivel);
			$stmt->bindParam(3, $pagonivel);
			
			$nivel = strip_tags($_POST["nivel"]);
			$pagonivel = strip_tags($_POST["pagonivel"]);
			$stmt->execute();

	echo "<span class='fa fa-check-square-o'></span> EL NIVEL HA SIDO REGISTRADO EXITOSAMENTE";
	exit;
		}
		else
		{
			echo "2";
			exit;
		}
	}
################################### FUNCION REGISTRAR NIVELES ##################################

################################## FUNCION LISTAR NIVELES ####################################
	public function ListarNivel()
	{
		self::SetNames();
		$sql = " select * from niveles";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
################################## FUNCION LISTAR NIVELES ####################################

################################## FUNCION ID NIVEL ################################
	public function NivelPorId()
	{
		self::SetNames();
		$sql = " select * from niveles where codnivel = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codnivel"])) );
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
################################## FUNCION ID NIVEL ################################

################################ FUNCION ACTUALIZAR NIVELES #############################
	public function ActualizarNivel()
	{
		
		self::SetNames();
		if(empty($_POST["codnivel"]) or empty($_POST["nivel"]) or empty($_POST["pagonivel"]))
		{
			echo "1";
			exit;
		}
		$sql = " select * from niveles where codnivel != ? and nivel = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["codnivel"], $_POST["nivel"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
		$sql = " update niveles set "
			  ." nivel = ?, "
			  ." pagonivel = ? "
			  ." where "
			  ." codnivel = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $nivel);
		$stmt->bindParam(2, $pagonivel);
		$stmt->bindParam(3, $codnivel);
			
		$nivel = strip_tags($_POST["nivel"]);
		$pagonivel = strip_tags($_POST["pagonivel"]);
		$codnivel = strip_tags($_POST["codnivel"]);
		$stmt->execute();
		
    echo "<span class='fa fa-check-square-o'></span> EL NIVEL HA SIDO ACTUALIZADO EXITOSAMENTE";
	exit;
	}
		else
		{
			echo "2";
			exit;
		}
  }
################################ FUNCION ACTUALIZAR NIVELES #############################

################################ FUNCION ELIMINAR NIVELES ################################
	public function EliminarNivel()
	{

		if($_SESSION['acceso'] == "administrador") {
		
		$sql = " select codnivel from grados where codnivel = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codnivel"])) );
		$num = $stmt->rowCount();
		if($num == 0)
		{

		$sql = " delete from niveles where codnivel = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codnivel);
		$codnivel = base64_decode($_GET["codnivel"]);
		$stmt->execute();
		
		header("Location: niveles?mesage=1");
		exit;
		   
		   }else {
		   
			header("Location: niveles?mesage=2");
			exit;
		  }
			
	} else {
		
		header("Location: niveles?mesage=3");
		exit;
	    }	
	}
################################ FUNCION ELIMINAR NIVELES ################################

################################ FIN DE CLASE NIVELES ###################################








































###################################### CLASE GRADOS ########################################

################################### FUNCION REGISTRAR GRADOS ###################################
	public function RegistrarGrados()
	{
		self::SetNames();
		if(empty($_POST["codnivel"]) or empty($_POST["grado"]))
		{
			echo "1";
			exit;
		}

       $sql = " select codgrado from grados ORDER BY codgrado DESC limit 1 ";
	   foreach ($this->dbh->query($sql) as $row){

      $codgrado["codgrado"]=$row["codgrado"];
      }
          if(empty($codgrado["codgrado"]))
           {
			   $codgrado = 'G001';
     }else
           {
               $num     = substr($codgrado["codgrado"] , 1);
               $dig     = $num + 1;
               $cod = str_pad($dig, 3, "0", STR_PAD_LEFT);
			    $codgrado = 'G'.$cod;
         }

		$sql = " select * from grados where codnivel = ? and grado = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["codnivel"], $_POST["grado"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$query = " insert into grados values (?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codgrado);
			$stmt->bindParam(2, $codnivel);
			$stmt->bindParam(3, $grado);
			
			$codnivel = strip_tags($_POST["codnivel"]);
			$grado = strip_tags($_POST["grado"]);
			$stmt->execute();

	echo "<span class='fa fa-check-square-o'></span> EL GRADO HA SIDO REGISTRADO EXITOSAMENTE";
	exit;
		}
		else
		{
			echo "2";
			exit;
		}
	}
################################### FUNCION REGISTRAR GRADOS ###################################

################################ FUNCION LISTAR GRADOS ####################################
	public function ListarGrados()
	{
		self::SetNames();
		$sql = " select * from grados INNER JOIN niveles ON grados.codnivel = niveles.codnivel";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
################################ FUNCION LISTAR GRADOS ####################################

############################ FUNCION LISTAR SEECIONES POR SECCIONES #############################
	public function ListarGradosNiveles()
	{
		self::SetNames();
		$sql = "select * from grados where codnivel = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_GET["codnivel"]) );
		$num = $stmt->rowCount();
		     if($num==0)
		{
			echo "<select name='codgrado' id='codgrado' class='form-control'>";
            echo "<option value=''>SIN RESULTADOS</option>";
			echo "</select>";
			exit;
		       }
		else
		{
		while($row = $stmt->fetch())
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
############################ FUNCION LISTAR SEECIONES POR SECCIONES #############################


################################## FUNCION ID GRADOS ##############################
	public function GradosPorId()
	{
		self::SetNames();
		$sql = " select * from grados where codgrado = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codgrado"])) );
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
################################## FUNCION ID GRADOS ##############################
	
################################ FUNCION ACTUALIZAR GRADOS #############################
	public function ActualizarGrados()
	{
		
		self::SetNames();
		if(empty($_POST["codgrado"]) or empty($_POST["codnivel"]) or empty($_POST["grado"]))
		{
			echo "1";
			exit;
		}
		$sql = " select * from grados where codgrado != ? and codnivel = ? and grado = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["codgrado"], $_POST["codnivel"], $_POST["grado"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
		$sql = " update grados set "
			  ." codnivel = ?, "
			  ." grado = ? "
			  ." where "
			  ." codgrado = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $codnivel);
		$stmt->bindParam(2, $grado);
		$stmt->bindParam(3, $codgrado);
			
		$codnivel = strip_tags($_POST["codnivel"]);
		$grado = strip_tags($_POST["grado"]);
		$codgrado = strip_tags($_POST["codgrado"]);
		$stmt->execute();
		
    echo "<span class='fa fa-check-square-o'></span> EL GRADO HA SIDO ACTUALIZADO EXITOSAMENTE";
	exit;
	}
		else
		{
			echo "2";
			exit;
		}
  }
################################ FUNCION ACTUALIZAR GRADOS #############################

############################### FUNCION ELIMINAR GRADOS #################################
	public function EliminarGrados()
	{

		if($_SESSION['acceso'] == "administrador") {
		
		$sql = " select codgrado from secciones where codgrado = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codgrado"])) );
		$num = $stmt->rowCount();
		if($num == 0)
		{

		$sql = " delete from grados where codgrado = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codgrado);
		$codgrado = base64_decode($_GET["codgrado"]);
		$stmt->execute();
		
		header("Location: grados?mesage=1");
		exit;
		   
		   }else {
		   
			header("Location: grados?mesage=2");
			exit;
		  }
			
	} else {
		
		header("Location: grados?mesage=3");
		exit;
	    }	
	}
############################### FUNCION ELIMINAR GRADOS #################################
	
#################################### FIN DE CLASE GRADOS ###################################





























####################################### CLASE SECCIONES #####################################

############################## FUNCION REGISTRAR SECCIONES ################################
	public function RegistrarSecciones()
	{
		self::SetNames();
		if(empty($_POST["codnivel"]) or empty($_POST["codgrado"]) or empty($_POST["seccion"]))
		{
			echo "1";
			exit;
		}

      $sql = " select codseccion from secciones ORDER BY codseccion DESC limit 1 ";
	  foreach ($this->dbh->query($sql) as $row){

      $codseccion["codseccion"]=$row["codseccion"];
      }
          if(empty($codseccion["codseccion"]))
           {
			   $codseccion = 'S001';
     }else
           {
               $num     = substr($codseccion["codseccion"] , 1);
               $dig     = $num + 1;
               $cod = str_pad($dig, 3, "0", STR_PAD_LEFT);
			   $codseccion = 'S'.$cod;
         }

		$sql = " select * from secciones where codnivel = ? and codgrado = ? and seccion = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["codnivel"], $_POST["codgrado"], $_POST["seccion"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$query = " insert into secciones values (?, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codseccion);
			$stmt->bindParam(2, $codnivel);
			$stmt->bindParam(3, $codgrado);
			$stmt->bindParam(4, $seccion);
			
		    $codnivel = strip_tags($_POST["codnivel"]);
			$codgrado = strip_tags($_POST["codgrado"]);
			$seccion = strip_tags($_POST["seccion"]);
			$stmt->execute();

	echo "<span class='fa fa-check-square-o'></span> LA SECCI&Oacute;N HA SIDO REGISTRADA EXITOSAMENTE";
	exit;
		}
		else
		{
			echo "2";
			exit;
		}
	}
############################## FUNCION REGISTRAR SECCIONES ################################

################################# FUNCION LISTAR SECCIONES #################################
	public function ListarSecciones()
	{
		self::SetNames();
		$sql = " SELECT * FROM secciones INNER JOIN grados ON secciones.codgrado = grados.codgrado INNER JOIN niveles ON secciones.codnivel = niveles.codnivel";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
################################# FUNCION LISTAR SECCIONES #################################

############################## FUNCION LISTAR SECCIONES POR GRADOS ############################
	public function ListarSeccionesGrados()
	{
		self::SetNames();
		$sql = "select * from secciones where codgrado = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_GET["codgrado"]) );
		$num = $stmt->rowCount();
		     if($num==0)
		{
			echo "<select name='codseccion' id='codseccion' class='form-control'>";
            echo "<option value=''>SIN RESULTADOS</option>";
			echo "</select>";
			exit;
		       }
		else
		{
		while($row = $stmt->fetch())
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
############################## FUNCION LISTAR SECCIONES POR GRADOS ############################

############################## FUNCION LISTAR MATERIAS POR GRADOS ############################
	public function ListarMateriasGrados()
	{
		self::SetNames();
		$sql = "select * from materias where codgrado = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_GET["codgrado"]) );
		$num = $stmt->rowCount();
		     if($num==0)
		{
			echo "<select name='codmateria' id='codmateria' class='form-control'>";
            echo "<option value=''>SIN RESULTADOS</option>";
			echo "</select>";
			exit;
		       }
		else
		{
		while($row = $stmt->fetch())
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
############################## FUNCION LISTAR MATERIAS POR GRADOS ############################

############################ FUNCION ID GRADOS #####################################
	public function SeccionesPorId()
	{
		self::SetNames();
		$sql = " select * from secciones where codseccion = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codseccion"])) );
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
############################ FUNCION ID GRADOS #####################################

############################## FUNCION ACTUALIZAR SECCIONES ###########################
	public function ActualizarSecciones()
	{
		
		self::SetNames();
		if(empty($_POST["codseccion"]) or empty($_POST["codnivel"]) or empty($_POST["codgrado"]) or empty($_POST["seccion"]))
		{
			echo "1";
			exit;
		}
		$sql = " select * from secciones where codseccion != ? and codnivel = ? and codgrado = ? and seccion = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["codseccion"], $_POST["codnivel"], $_POST["codgrado"], $_POST["seccion"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
		$sql = " update secciones set "
			  ." codnivel = ?, "
			  ." codgrado = ?, "
			  ." seccion = ? "
			  ." where "
			  ." codseccion = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $codnivel);
		$stmt->bindParam(2, $codgrado);
		$stmt->bindParam(3, $seccion);
		$stmt->bindParam(4, $codseccion);
			
		$codseccion = strip_tags($_POST["codseccion"]);
		$codnivel = strip_tags($_POST["codnivel"]);
		$codgrado = strip_tags($_POST["codgrado"]);
		$seccion = strip_tags($_POST["seccion"]);
		$stmt->execute();
		
    echo "<span class='fa fa-check-square-o'></span> LA SECCI&Oacute;N HA SIDO ACTUALIZADA EXITOSAMENTE";
	exit;
	}
		else
		{
			echo "2";
			exit;
		}
  }
############################## FUNCION ACTUALIZAR SECCIONES ###########################

########################### FUNCION ELIMINAR SECCIONES ###############################
	public function EliminarSecciones()
	{

		if($_SESSION['acceso'] == "administrador") {
		
		$sql = " select codseccion from pagos where codseccion = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codseccion"])) );
		$num = $stmt->rowCount();
		if($num == 0)
		{

		$sql = " delete from secciones where codseccion = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codseccion);
		$codseccion = base64_decode($_GET["codseccion"]);
		$stmt->execute();
		
		header("Location: secciones?mesage=1");
		exit;
		   
		   }else {
		   
			header("Location: secciones?mesage=2");
			exit;
		  }
			
	} else {
		
		header("Location: secciones?mesage=3");
		exit;
	    }	
	}
########################### FUNCION ELIMINAR SECCIONES ###############################
	
#################################### FIN DE CLASE SECCIONES ###################################


































###################################### CLASE AREAS DE MATERIAS #####################################

################################### FUNCION REGISTRAR AREAS ##################################
	public function RegistrarArea()
	{
		self::SetNames();
		if(empty($_POST["nomarea"]))
		{
			echo "1";
			exit;
		}

		$sql = " select codarea from areas ORDER BY codarea DESC limit 1 ";
	    foreach ($this->dbh->query($sql) as $row){

      $codarea["codarea"]=$row["codarea"];
      }
          if(empty($codarea["codarea"]))
           {
			  $codarea = 'AR001';

        }  else {

               $num     = substr($codarea["codarea"] , 2);
               $dig     = $num + 1;
               $cod = str_pad($dig, 3, "0", STR_PAD_LEFT);
			   $codarea = 'AR'.$cod;
         }

        $sql = " select * from areas where nomarea = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["nomarea"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$query = " insert into areas values (?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codarea);
			$stmt->bindParam(2, $nomarea);
			
		    $nomarea = strip_tags($_POST["nomarea"]);
			$stmt->execute();

	echo "<span class='fa fa-check-square-o'></span> EL AREA DE MATERIA HA SIDO REGISTRADO EXITOSAMENTE";
    exit;
		}
		else
		{
			echo "2";
			exit;
		}
	}
################################### FUNCION REGISTRAR AREAS ##################################

################################ FUNCION LISTAR AREAS #######################################
	public function ListarArea()
	{
		self::SetNames();
		$sql = " select * from areas";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
################################ FUNCION LISTAR AREAS #######################################

#################################### FUNCION ID AREAS #####################################
	public function AreaPorId()
	{
		self::SetNames();
		$sql = " select * from areas where codarea = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codarea"])) );
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
#################################### FUNCION ID AREAS #####################################
	
################################## FUNCION ACTUALIZAR AREAS #################################
	public function ActualizarArea()
	{
		
		self::SetNames();
		if(empty($_POST["codarea"]) or empty($_POST["nomarea"]))
		{
			echo "1";
			exit;
		}
		$sql = " select * from areas where codarea != ? and nomarea = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["codarea"], $_POST["nomarea"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
		$sql = " update areas set "
			  ." nomarea = ? "
			  ." where "
			  ." codarea = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $nomarea);
		$stmt->bindParam(2, $codarea);
			
		$nomarea = strip_tags($_POST["nomarea"]);
		$codarea = strip_tags($_POST["codarea"]);
		$stmt->execute();
		
    echo "<span class='fa fa-check-square-o'></span> EL AREA DE MATERIA HA SIDO ACTUALIZADO EXITOSAMENTE";
    exit;
	}
		else
		{
			echo "2";
			exit;
		}
  }
################################## FUNCION ACTUALIZAR AREAS #################################

################################# FUNCION ELIMINAR AREAS ##################################
	
	public function EliminarArea()
	{
		if($_SESSION['acceso'] == "administrador") {
		
		$sql = " select codarea from materias where codarea = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codarea"])) );
		$num = $stmt->rowCount();
		if($num == 0)
		{

		$sql = " delete from areas where codarea = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codarea);
		$codarea = base64_decode($_GET["codarea"]);
		$stmt->execute();
		
		header("Location: areas?mesage=1");
		exit;
		   
		   }else {
		   
			header("Location: areas?mesage=2");
			exit;
		  }
			
	} else {
		
		header("Location: areas?mesage=3");
		exit;
	    }	
	}
################################# FUNCION ELIMINAR AREAS ##################################

##################################### FIN DE CLASE AREAS DE MATERIAS ###############################
























######################################### CLASE MATERIAS ############################################

############################ FUNCION REGISTRAR MATERIAS ##############################
	public function RegistrarMaterias()
	{
		self::SetNames();
		if(empty($_POST["nommateria"]) or empty($_POST["codnivel"]) or empty($_POST["codgrado"]))
		{
			echo "1";
			exit;
		}


        $sql = " select codmateria from materias ORDER BY codmateria DESC limit 1 ";
	   foreach ($this->dbh->query($sql) as $row){

       $codmateria["codmateria"]=$row["codmateria"];
       }
          if(empty($codmateria["codmateria"]))
           {
			   $codmateria = 'M0001';
       } else
           {
               $num     = substr($codmateria["codmateria"] , 1);
               $dig     = $num + 1;
               $cod = str_pad($dig, 4, "0", STR_PAD_LEFT);
			   $codmateria = 'M'.$cod;
         }

		$sql = " select nommateria, codgrado from materias where nommateria = ? and codgrado = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["nommateria"], $_POST["codgrado"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$query = " insert into materias values (?, ?, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codmateria);
			$stmt->bindParam(2, $codarea);
			$stmt->bindParam(3, $nommateria);
			$stmt->bindParam(4, $codnivel);
			$stmt->bindParam(5, $codgrado);
			
			$codarea = strip_tags($_POST["codarea"]);
			$nommateria = strip_tags($_POST["nommateria"]);
			$codnivel = strip_tags($_POST["codnivel"]);
			$codgrado = strip_tags($_POST["codgrado"]);
			$stmt->execute();

	echo "<span class='fa fa-check-square-o'></span> LA MATERIA HA SIDO REGISTRADA EXITOSAMENTE";
	exit;
		}
		else
		{
			echo "2";
			exit;
		}
	}
############################ FUNCION REGISTRAR MATERIAS ##############################

############################### FUNCION LISTAR MATERIAS ################################
	public function ListarMaterias()
	{
		self::SetNames();
		$sql = " SELECT * FROM materias INNER JOIN grados ON materias.codgrado = grados.codgrado LEFT JOIN areas ON materias.codarea = areas.codarea LEFT JOIN niveles ON grados.codnivel = niveles.codnivel";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
############################### FUNCION LISTAR MATERIAS ################################

############################### FUNCION ID MATERIAS ################################
	public function MateriasPorId()
	{
		self::SetNames();
		$sql = " SELECT * FROM materias INNER JOIN grados ON materias.codgrado = grados.codgrado LEFT JOIN areas ON materias.codarea = areas.codarea LEFT JOIN niveles ON grados.codnivel = niveles.codnivel WHERE materias.codmateria = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codmateria"])) );
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
############################### FUNCION ID MATERIAS ################################

############################### FUNCION ID MATERIAS #2 ###############################
	public function MateriasId()
	{
		self::SetNames();
		$sql = " SELECT * FROM materias INNER JOIN grados ON materias.codgrado = grados.codgrado LEFT JOIN areas ON materias.codarea = areas.codarea LEFT JOIN niveles ON grados.codnivel = niveles.codnivel WHERE materias.codmateria = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_GET["codmateria"]));
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
############################### FUNCION ID MATERIAS #2 ###############################
	
################################# FUNCION ACTUALIZAR MATERIAS ################################
	public function ActualizarMaterias()
	{
		
		self::SetNames();
		if(empty($_POST["codmateria"]) or empty($_POST["codarea"]) or empty($_POST["nommateria"]) or empty($_POST["codnivel"]) or empty($_POST["codgrado"]))
		{
			echo "1";
			exit;
		}
		$sql = " select codmateria, nommateria, codgrado from materias where codmateria != ? and nommateria = ? and codgrado = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["codmateria"], $_POST["nommateria"], $_POST["codgrado"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
		$sql = " update materias set "
			  ." codarea = ?, "
			  ." nommateria = ?, "
			  ." codnivel = ?, "
			  ." codgrado = ? "
			  ." where "
			  ." codmateria = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $codarea);
		$stmt->bindParam(2, $nommateria);
		$stmt->bindParam(3, $codnivel);
		$stmt->bindParam(4, $codgrado);
		$stmt->bindParam(5, $codmateria);
			
		$codarea = strip_tags($_POST["codarea"]);
		$nommateria = strip_tags($_POST["nommateria"]);
		$codnivel = strip_tags($_POST["codnivel"]);
		$codgrado = strip_tags($_POST["codgrado"]);
		$codmateria = strip_tags($_POST["codmateria"]);
		$stmt->execute();
		
    echo "<span class='fa fa-check-square-o'></span> LA MATERIA HA SIDO ACTUALIZADA EXITOSAMENTE";
	exit;
	}
		else
		{
			echo "2";
			exit;
		}
  }
################################# FUNCION ACTUALIZAR MATERIAS ################################

################################ FUNCION ELIMINAR MATERIAS #################################
	public function EliminarMaterias()
	{

		if($_SESSION['acceso'] == "administrador") {
		
		$sql = " select codmateria from notas where codmateria = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codmateria"])) );
		$num = $stmt->rowCount();
		if($num == 0)
		{

		$sql = " delete from materias where codmateria = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codmateria);
		$codmateria = base64_decode($_GET["codmateria"]);
		$stmt->execute();
		
		header("Location: materias?mesage=1");
		exit;
		   
		   }else {
		   
			header("Location: materias?mesage=2");
			exit;
		  }
			
	} else {
		
		header("Location: materias?mesage=3");
		exit;
	    }	
	}
################################ FUNCION ELIMINAR MATERIAS #################################

###################### FUNCION BUSQUEDA MATERIAS REPORTES ###########################
	    public function BuscarMateriasReportes() 
	       {
		self::SetNames();
		$sql = " SELECT * FROM materias INNER JOIN grados ON materias.codgrado = grados.codgrado LEFT JOIN areas ON materias.codarea = areas.codarea LEFT JOIN niveles ON grados.codnivel = niveles.codnivel WHERE materias.codnivel = ? and materias.codgrado = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_GET['codnivel']));
		$stmt->bindValue(2, trim($_GET['codgrado']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
		
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON RESULTADOS PARA TU B&Uacute;SQUEDA REALIZADA</center>";
    echo "</div>";		
	exit;
		       }
		else
		{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
###################### FUNCION BUSQUEDA MATERIAS REPORTES ###########################

################################## FIN DE CLASE MATERIAS #####################################












































############################################ CLASE HORAS ############################################

############################## FUNCION REGISTRAR HORAS #################################
	public function RegistrarHoras()
	{
		self::SetNames();
		if(empty($_POST["nomhora"]))
		{
			echo "1";
			exit;
		}

      $sql = " select codhora from horas ORDER BY codhora DESC limit 1 ";
	  foreach ($this->dbh->query($sql) as $row){

      $codhora["codhora"]=$row["codhora"];
      }
          if(empty($codhora["codhora"]))
           {
			   $codhora = 'H001';
     } else {
               $num     = substr($codhora["codhora"] , 1);
               $dig     = $num + 1;
               $cod = str_pad($dig, 3, "0", STR_PAD_LEFT);
			   $codhora = 'H'.$cod;
         }

		$sql = " select nomhora from horas where nomhora = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["nomhora"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$query = " insert into horas values (?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codhora);
			$stmt->bindParam(2, $nomhora);
			
			$nomhora = strip_tags($_POST["nomhora"]);
			$stmt->execute();

	echo "<span class='fa fa-check-square-o'></span> LA HORA HA SIDO REGISTRADA EXITOSAMENTE";
    exit;
		}
		else
		{
			echo "2";
			exit;
		}
	}
############################## FUNCION REGISTRAR HORAS #################################

############################## FUNCION LISTAR HORAS ##############################
	public function ListarHoras()
	{
		self::SetNames();
		$sql = " select * from horas";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
############################## FUNCION LISTAR HORAS ##############################

############################## FUNCION ID HORAS #################################
	public function HorasPorId()
	{
		self::SetNames();
		$sql = " select * from horas where codhora = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codhora"])) );
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
############################## FUNCION ID HORAS #################################
	
############################# FUNCION ACTUALIZAR HORAS #########################
	public function ActualizarHoras()
	{
		
		self::SetNames();
		if(empty($_POST["codhora"]) or empty($_POST["nomhora"]))
		{
			echo "1";
			exit;
		}
		$sql = " select nomhora from horas where codhora != ? and nomhora = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["codhora"], $_POST["nomhora"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
		$sql = " update horas set "
			  ." nomhora = ? "
			  ." where "
			  ." codhora = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $nomhora);
		$stmt->bindParam(2, $codhora);
			
		$codhora = strip_tags($_POST["codhora"]);
		$nomhora = strip_tags($_POST["nomhora"]);
		$stmt->execute();
		
    echo "<span class='fa fa-check-square-o'></span> LA HORA HA SIDO ACTUALIZADA EXITOSAMENTE";
	exit;
	}
		else
		{
			echo "2";
			exit;
		}
  }
############################# FUNCION ACTUALIZAR HORAS #########################

############################# FUNCION ELIMINAR HORAS #############################
	
	public function EliminarHoras()
	{

		if($_SESSION['acceso'] == "administrador") {
		
		$sql = " select codhora from horarios where codhora = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codhora"])) );
		$num = $stmt->rowCount();
		if($num == 0)
		{

		$sql = " delete from horas where codhora = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codhora);
		$codhora = base64_decode($_GET["codhora"]);
		$stmt->execute();
		
		header("Location: horas?mesage=1");
		exit;
		   
		   }else {
		   
			header("Location: horas?mesage=2");
			exit;
		  }
			
	} else {
		
		header("Location: horas?mesage=3");
		exit;
	    }	
	}
############################# FUNCION ELIMINAR HORAS #############################

########################### FIN DE CLASE HORAS ###################################
































###################################### CLASE DIAS ###########################################

############################# FUNCION REGISTRAR DIAS ################################
	public function RegistrarDias()
	{
		self::SetNames();
		if(empty($_POST["nomdia"]))
		{
			echo "1";
			exit;
		}

      $sql = " select coddia from dias ORDER BY coddia DESC limit 1 ";
	  foreach ($this->dbh->query($sql) as $row){

      $coddia["coddia"]=$row["coddia"];
      }
          if(empty($coddia["coddia"]))
           {
			   $coddia = 'D001';
     } else
           {
               $num     = substr($coddia["coddia"] , 1);
               $dig     = $num + 1;
               $cod = str_pad($dig, 3, "0", STR_PAD_LEFT);
			   $coddia = 'D'.$cod;
         }

		$sql = " select nomdia from dias where nomdia = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["nomdia"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$query = " insert into dias values (?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $coddia);
			$stmt->bindParam(2, $nomdia);
			
			$nomdia = strip_tags($_POST["nomdia"]);
			$stmt->execute();

	echo "<span class='fa fa-check-square-o'></span> EL DIA HA SIDO REGISTRADO EXITOSAMENTE";
	exit;
		}
		else
		{
			echo "2";
			exit;
		}
	}
############################# FUNCION REGISTRAR DIAS ################################

############################## FUNCION LISTAR DIAS ###############################
	public function ListarDias()
	{
		self::SetNames();
		$sql = " select * from dias";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
############################## FUNCION LISTAR DIAS ###############################

############################### FUNCION ID DIAS ###################################
	public function DiasPorId()
	{
		self::SetNames();
		$sql = " select * from dias where coddia = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["coddia"])) );
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
############################### FUNCION ID DIAS ###################################
	
############################### FUNCION ACTUALIZAR DIAS ################################
	public function ActualizarDias()
	{
		
		self::SetNames();
		if(empty($_POST["coddia"]) or empty($_POST["nomdia"]))
		{
			echo "1";
			exit;
		}
		$sql = " select nomdia from dias where coddia != ? and nomdia = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["coddia"], $_POST["nomdia"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
		$sql = " update dias set "
			  ." nomdia = ? "
			  ." where "
			  ." coddia = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $nomdia);
		$stmt->bindParam(2, $coddia);
			
		$coddia = strip_tags($_POST["coddia"]);
		$nomdia = strip_tags($_POST["nomdia"]);
		$stmt->execute();
		

    echo "<span class='fa fa-check-square-o'></span> EL DIA HA SIDO ACTUALIZADO EXITOSAMENTE";
	exit;
	}
		else
		{
			echo "2";
			exit;
		}
  }
############################### FUNCION ACTUALIZAR DIAS ################################

############################## FUNCION ELIMINAR DIAS ##################################
	public function EliminarDias()
	{

		if($_SESSION['acceso'] == "administrador") {
		
		$sql = " select coddia from horarios where coddia = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["coddia"])) );
		$num = $stmt->rowCount();
		if($num == 0)
		{

		$sql = " delete from dias where coddia = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$coddia);
		$coddia = base64_decode($_GET["coddia"]);
		$stmt->execute();
		
		header("Location: dias?mesage=1");
		exit;
		   
		   }else {
		   
			header("Location: dias?mesage=2");
			exit;
		  }
			
	} else {
		
		header("Location: dias?mesage=3");
		exit;
	    }	
	}
############################## FUNCION ELIMINAR DIAS ##################################

##################################### FIN DE CLASE DIAS #######################################































############################################# CLASE AULAS ##########################################

############################### FUNCION REGISTRAR AULAS ###############################
	public function RegistrarAulas()
	{
		self::SetNames();
		if(empty($_POST["nomaula"]) or empty($_POST["descripcaula"]))
		{
			echo "1";
			exit;
		}

      $sql = " select codaula from aulas ORDER BY codaula DESC limit 1 ";
	  foreach ($this->dbh->query($sql) as $row){

      $codaula["codaula"]=$row["codaula"];
      }
          if(empty($codaula["codaula"]))
           {
			  $codaula = 'A001';
      }else
           {
               $num     = substr($codaula["codaula"] , 1);
               $dig     = $num + 1;
               $cod = str_pad($dig, 3, "0", STR_PAD_LEFT);
			   $codaula = 'A'.$cod;
         }  

		$sql = " select nomaula from aulas where nomaula = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["nomaula"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$query = " insert into aulas values (?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codaula);
			$stmt->bindParam(2, $nomaula);
			$stmt->bindParam(3, $descripcaula);
			
			$nomaula = strip_tags($_POST["nomaula"]);
			$descripcaula = strip_tags($_POST["descripcaula"]);
			$stmt->execute();

	echo "<span class='fa fa-check-square-o'></span> EL AULA DE CLASES HA SIDO REGISTRADA EXITOSAMENTE";
	exit;
		}
		else
		{
			echo "2";
			exit;
		}
	}
############################### FUNCION REGISTRAR AULAS ###############################

################################## FUNCION LISTAR AULAS ###############################
	public function ListarAulas()
	{
		self::SetNames();
		$sql = " select * from aulas";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
################################## FUNCION LISTAR AULAS ###############################

################################ FUNCION ID AULAS #####################################
	public function AulasPorId()
	{
		self::SetNames();
		$sql = " select * from aulas where codaula = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codaula"])) );
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
################################ FUNCION ID AULAS #####################################
	
################################## FUNCION ACTUALIZAR AULAS ###############################
	public function ActualizarAulas()
	{
		
		self::SetNames();
		if(empty($_POST["codaula"]) or empty($_POST["nomaula"]) or empty($_POST["descripcaula"]))
		{
			echo "1";
			exit;
		}
		$sql = " select nomaula from aulas where codaula != ? and nomaula = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["codaula"], $_POST["nomaula"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
		$sql = " update aulas set "
			  ." nomaula = ?, "
			  ." descripcaula = ? "
			  ." where "
			  ." codaula = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $nomaula);
		$stmt->bindParam(2, $descripcaula);
		$stmt->bindParam(3, $codaula);
			
		$codaula = strip_tags($_POST["codaula"]);
		$nomaula = strip_tags($_POST["nomaula"]);
		$descripcaula = strip_tags($_POST["descripcaula"]);
		$stmt->execute();
		
    echo "<span class='fa fa-check-square-o'></span> EL AULA DE CLASES HA SIDO ACTUALIZADA EXITOSAMENTE";
	exit;
	}
		else
		{
			echo "2";
			exit;
		}
  }
################################## FUNCION ACTUALIZAR AULAS ###############################

################################ FUNCION ELIMINAR AULAS ################################
	public function EliminarAulas()
	{

		if($_SESSION['acceso'] == "administrador") {
		
		$sql = " select codaula from horarios where codaula = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codaula"])) );
		$num = $stmt->rowCount();
		if($num == 0)
		{

		$sql = " delete from aulas where codaula = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codaula);
		$codaula = base64_decode($_GET["codaula"]);
		$stmt->execute();
		
		header("Location: aulas?mesage=1");
		exit;
		   
		   }else {
		   
			header("Location: aulas?mesage=2");
			exit;
		  }
			
	} else {
		
		header("Location: aulas?mesage=3");
		exit;
	    }	
	}
################################ FUNCION ELIMINAR AULAS ################################

####################################### FIN DE CLASE AULAS ########################################



































########################################## CLASE DOCENTES ##########################################

################################## FUNCION REGISTRAR DOCENTES #################################
	public function RegistrarDocentes()
	{
		self::SetNames();
		if(empty($_POST["ceddoc"]) or empty($_POST["nomdoc"]) or empty($_POST["tlfdoc"]) or empty($_POST["direcdoc"]))
		{
			echo "1";
			exit;
		}
		$sql = " select ceddoc from docentes where ceddoc = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["ceddoc"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$query = " insert into docentes values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $ceddoc);
			$stmt->bindParam(2, $nomdoc);
			$stmt->bindParam(3, $tlfdoc);
			$stmt->bindParam(4, $direcdoc);
			$stmt->bindParam(5, $especdoc);
			$stmt->bindParam(6, $fecnacdoc);
			$stmt->bindParam(7, $edocivildoc);
			$stmt->bindParam(8, $lugarnacdoc);
			$stmt->bindParam(9, $correodoc);
			$stmt->bindParam(10, $expedido);
			$stmt->bindParam(11, $horasdoc);
			$stmt->bindParam(12, $codcargodoc);
			$stmt->bindParam(13, $clavedoc);
			$stmt->bindParam(14, $ingresodoc);
			
			$ceddoc = strip_tags($_POST["ceddoc"]);
			$nomdoc = strip_tags($_POST["nomdoc"]);
			$tlfdoc = strip_tags($_POST["tlfdoc"]);
			$direcdoc = strip_tags($_POST["direcdoc"]);
			$especdoc = strip_tags($_POST["especdoc"]);
			$fecnacdoc = strip_tags(date("Y-m-d",strtotime($_POST['fecnacdoc'])));
			$edocivildoc = strip_tags($_POST["edocivildoc"]);
			$lugarnacdoc = strip_tags($_POST["lugarnacdoc"]);
			$correodoc = strip_tags($_POST["correodoc"]);
			$expedido = strip_tags($_POST["expedido"]);
			$horasdoc = strip_tags($_POST["horasdoc"]);
			$codcargodoc = strip_tags($_POST["codcargodoc"]);
			$clavedoc = strip_tags(sha1(md5($_POST["ceddoc"])));
			$ingresodoc = strip_tags(date("Y-m-d"));
			$stmt->execute();

	echo "<span class='fa fa-check-square-o'></span> EL DOCENTE HA SIDO REGISTRADO EXITOSAMENTE";
	exit;
		}
		else
		{
			echo "2";
			exit;
		}
	}
################################## FUNCION REGISTRAR DOCENTES #################################

################################# FUNCION LISTAR DOCENTES ############################
	public function ListarDocentes()
	{
		self::SetNames();
		$sql = " select * from docentes ORDER BY ceddoc ASC ";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
################################# FUNCION LISTAR DOCENTES ############################

############################## FUNCION ID DOCENTES ##############################
public function DocentesPorId()
	{
		self::SetNames();

	if ($_SESSION['acceso'] == "docente") {

		$sql = " SELECT * FROM docentes WHERE coddoc = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_SESSION["coddoc"]));
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}

	} else {

		$sql = " SELECT * FROM docentes WHERE coddoc = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(base64_decode($_GET["coddoc"])));
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
}
############################## FUNCION ID DOCENTES ##############################
	
############################## FUNCION ACTUALIZAR DOCENTES #########################
	public function ActualizarDocentes()
	{
		self::SetNames();
		if(empty($_POST["ceddoc"]) or empty($_POST["nomdoc"]) or empty($_POST["tlfdoc"]) or empty($_POST["direcdoc"]))
		{
			echo "1";
			exit;
		}
		$sql = "SELECT ceddoc FROM docentes WHERE coddoc != ? AND ceddoc = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["coddoc"], $_POST["ceddoc"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
		$sql = " UPDATE docentes set "
			  ." ceddoc = ?, "
			  ." nomdoc = ?, "
			  ." tlfdoc = ?, "
			  ." direcdoc = ?, "
			  ." especdoc = ?, "
			  ." fecnacdoc = ?, "
			  ." edocivildoc = ?, "
			  ." lugarnacdoc = ?, "
			  ." correodoc = ?, "
			  ." expedido = ?, "
			  ." horasdoc = ?, "
			  ." codcargodoc = ? "
			  ." where "
			  ." coddoc = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $ceddoc);
		$stmt->bindParam(2, $nomdoc);
		$stmt->bindParam(3, $tlfdoc);
		$stmt->bindParam(4, $direcdoc);
		$stmt->bindParam(5, $especdoc);
		$stmt->bindParam(6, $fecnacdoc);
		$stmt->bindParam(7, $edocivildoc);
		$stmt->bindParam(8, $lugarnacdoc);
		$stmt->bindParam(9, $correodoc);
		$stmt->bindParam(10, $expedido);
		$stmt->bindParam(11, $horasdoc);
		$stmt->bindParam(12, $codcargodoc);
		$stmt->bindParam(13, $coddoc);
			
		$ceddoc = strip_tags($_POST["ceddoc"]);
		$nomdoc = strip_tags($_POST["nomdoc"]);
		$tlfdoc = strip_tags($_POST["tlfdoc"]);
		$direcdoc = strip_tags($_POST["direcdoc"]);
		$especdoc = strip_tags($_POST["especdoc"]);
		$fecnacdoc = strip_tags(date("Y-m-d",strtotime($_POST['fecnacdoc'])));
		$edocivildoc = strip_tags($_POST["edocivildoc"]);
		$lugarnacdoc = strip_tags($_POST["lugarnacdoc"]);
		$correodoc = strip_tags($_POST["correodoc"]);
		$expedido = strip_tags($_POST["expedido"]);
		$horasdoc = strip_tags($_POST["horasdoc"]);
		$codcargodoc = strip_tags($_POST["codcargodoc"]);
		$coddoc = strip_tags($_POST["coddoc"]);
		$stmt->execute();

	if ($_SESSION['acceso'] == "docente") {

		echo "<span class='fa fa-check-square-o'></span> SUS DATOS HAN SIDO ACTUALIZADO EXITOSAMENTE";
		exit;

	} else {

		echo "<span class='fa fa-check-square-o'></span> EL DOCENTE HA SIDO ACTUALIZADO EXITOSAMENTE";
		exit;
	}
		
	}
		else
		{
			echo "2";
			exit;
		}
	}
############################## FUNCION ACTUALIZAR DOCENTES #########################

############################## FUNCION ELIMINAR DOCENTES ############################
	public function EliminarDocentes()
	{
		if($_SESSION['acceso'] == "administrador") {
		
		$sql = " select coddoc from notas where coddoc = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["coddoc"])) );
		$num = $stmt->rowCount();
		if($num == 0)
		{

		$sql = " delete from docentes where coddoc = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$coddoc);
		$coddoc = base64_decode($_GET["coddoc"]);
		$stmt->execute();
		
		header("Location: docentes?mesage=1");
		exit;
		   
		   }else {
		   
			header("Location: docentes?mesage=2");
			exit;
		  }
			
	} else {
		
		header("Location: docentes?mesage=3");
		exit;
	    }	
	}
############################## FUNCION ELIMINAR DOCENTES ############################

####################################### FIN DE CLASE DOCENTES ######################################




































############################# CLASE ASIGNACIONES DE MATERIAS A DOCENTES #############################

######################## FUNCION VERIFICA PERIODO PARA ASIGNACION DE MATERIAS #########################
	public function VerificaPeriodoAsignaciones()
	{
		self::SetNames();
		$sql = "SELECT * FROM periodoescolar WHERE statusperiodo = 1 ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<center><span class='fa fa-info-circle'></span> NO EXISTE UN PERIODO ESCOLAR ACTIVO PARA PROCESAR ASIGNACIONES DE MATERIAS A DOCENTES, <br> DIRIJASE AL ADMINISTRADOR DEL SISTEMA PARA QUE AGREGUE UN PERIODO ESCOLAR</center>";
	echo "</div>";
		}
		else
		{
		
     $sql ="SELECT * FROM docentes WHERE coddoc = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_GET["coddoc"]));
		$num = $stmt->rowCount();
		if($num==0)
		{
	      echo "<div class='alert alert-danger'>";
	      echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	      echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON RESULTADOS PARA TU BUSQUEDA</center>";
		  echo "</div>";		
		  exit;
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
}
########################### FUNCION VERIFICA PERIODO PARA ASIGNACION DE MATERIAS ######################

######################### FUNCION PARA REGISTRAR ASIGNACION DE MATERIAS ##########################
public function RegistrarAsignacion()
{
	self::SetNames();
	if(empty($_POST["coddoc"]) or empty($_POST["codturno"]) or empty($_POST["codnivel"]) or empty($_POST["codgrado"]) or empty($_POST["codseccion"]) or empty($_POST["codmateria"]))
	{
		echo "1";
		exit;
	}

		$sql = " SELECT * FROM asignaciones 
		WHERE coddoc = ? AND codturno = ? AND codseccion = ? AND codmateria = ? AND codperiodo = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_POST["coddoc"], $_POST["codturno"], $_POST["codseccion"], $_POST["codmateria"], $_POST["codperiodo"]));
		$num = $stmt->rowCount();
		if($num == 0)
		{
				$query = "INSERT INTO asignaciones values (null, ?, ?, ?, ?, ?, ?, ?, ?); ";
				$stmt = $this->dbh->prepare($query);
				$stmt->bindParam(1, $coddoc);
				$stmt->bindParam(2, $codturno);
				$stmt->bindParam(3, $codnivel);
				$stmt->bindParam(4, $codgrado);
				$stmt->bindParam(5, $codseccion);
				$stmt->bindParam(6, $codmateria);
				$stmt->bindParam(7, $codperiodo);
				$stmt->bindParam(8, $fechaasignacion);

				$coddoc = strip_tags($_POST["coddoc"]);
				$codturno = strip_tags($_POST['codturno']);
				$codnivel = strip_tags($_POST['codnivel']);
				$codgrado = strip_tags($_POST['codgrado']);
				$codseccion = strip_tags($_POST['codseccion']);
				$codmateria = strip_tags($_POST['codmateria']);
				$codperiodo = strip_tags($_POST['codperiodo']);
				$fechaasignacion = strip_tags(date("Y-m-d"));
				$stmt->execute();

		echo "<span class='fa fa-check-square-o'></span> LA ASIGNACION DE MATERIA FUE ASIGNADA AL DOCENTE EXITOSAMENTE";
		exit;

		} else{
			
			echo "2";
			exit;
		}
	}
############################ FUNCION PARA REGISTRAR ASIGNACION DE MATERIAS ############################

############################## FUNCION LISTAR ASIGNACIONES DE MATERIAS ################################
	public function ListarAsignacion()
	{
		self::SetNames();
		
	if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria") {

		$sql ="SELECT * FROM asignaciones INNER JOIN materias ON materias.codmateria = asignaciones.codmateria
		LEFT JOIN docentes ON docentes.coddoc = asignaciones.coddoc
		LEFT JOIN turnos ON turnos.codturno = asignaciones.codturno
		LEFT JOIN secciones ON secciones.codseccion = asignaciones.codseccion
		LEFT JOIN grados ON grados.codgrado = materias.codgrado 
		LEFT JOIN niveles ON grados.codnivel = niveles.codnivel 
		INNER JOIN periodoescolar ON asignaciones.codperiodo = periodoescolar.codperiodo WHERE periodoescolar.statusperiodo = 1";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;

	} else {

		$sql = "SELECT * FROM asignaciones INNER JOIN materias ON materias.codmateria = asignaciones.codmateria
		LEFT JOIN docentes ON docentes.coddoc = asignaciones.coddoc
		LEFT JOIN turnos ON turnos.codturno = asignaciones.codturno
		LEFT JOIN secciones ON secciones.codseccion = asignaciones.codseccion
		LEFT JOIN grados ON grados.codgrado = materias.codgrado 
		LEFT JOIN niveles ON grados.codnivel = niveles.codnivel
		INNER JOIN periodoescolar ON asignaciones.codperiodo = periodoescolar.codperiodo WHERE asignaciones.coddoc = '".$_SESSION["coddoc"]."' AND periodoescolar.statusperiodo = 1 ORDER BY materias.nommateria";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
########################### FUNCION LISTAR ASIGNACIONES DE MATERIAS ################################

############################ FUNCION ID ASIGNACIONES DE MATERIAS #################################
	public function AsignacionMateriasPorId()
	{
		self::SetNames();
		$sql ="SELECT * FROM asignaciones INNER JOIN materias ON materias.codmateria = asignaciones.codmateria
		LEFT JOIN docentes ON docentes.coddoc = asignaciones.coddoc
		LEFT JOIN turnos ON turnos.codturno = asignaciones.codturno
		LEFT JOIN secciones ON secciones.codseccion = asignaciones.codseccion
		LEFT JOIN grados ON grados.codgrado = materias.codgrado 
		LEFT JOIN niveles ON grados.codnivel = niveles.codnivel
		INNER JOIN periodoescolar ON asignaciones.codperiodo = periodoescolar.codperiodo WHERE asignaciones.codasignacion = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(base64_decode($_GET["codasignacion"])) );
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
############################ FUNCION ID ASIGNACIONES DE MATERIAS #################################
	
########################## FUNCION ELIMINAR ASIGNACIONES DE MATERIAS #########################
	public function EliminarAsignacion()
	{
		if($_SESSION['acceso'] == "administrador") {
		
		$sql = " SELECT coddoc, codmateria FROM notas WHERE coddoc = ? AND codmateria = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(base64_decode($_GET["coddoc"]),base64_decode($_GET["codmateria"])));
		$num = $stmt->rowCount();
		if($num == 0)
		{
		$sql = "DELETE FROM asignaciones WHERE codasignacion = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codasignacion);
		$codasignacion = base64_decode($_GET["codasignacion"]);
		$stmt->execute();
		
		header("Location: asignaciones?mesage=1");
		exit;
		   
	} else {
		   
		    header("Location: asignaciones?mesage=2");
			exit;
		} 
	} else {
		
		header("Location: asignaciones?mesage=3");
		exit;
	}	
} 
########################## FUNCION ELIMINAR ASIGNACIONES DE MATERIAS #########################

###################### FUNCION BUSQUEDA ASIGNACIONES DE MATERIAS REPORTES ###########################
	public function BuscarAsignacionMateriasReportes() 
	{
		self::SetNames();
		$sql ="SELECT * FROM asignaciones INNER JOIN materias ON materias.codmateria = asignaciones.codmateria
		LEFT JOIN docentes ON docentes.coddoc = asignaciones.coddoc
		LEFT JOIN turnos ON turnos.codturno = asignaciones.codturno
		LEFT JOIN secciones ON secciones.codseccion = asignaciones.codseccion
		LEFT JOIN grados ON grados.codgrado = materias.codgrado 
		LEFT JOIN niveles ON grados.codnivel = niveles.codnivel
		INNER JOIN periodoescolar ON asignaciones.codperiodo = periodoescolar.codperiodo WHERE asignaciones.coddoc = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_SESSION['acceso'] == 'docente' ? $_SESSION['coddoc'] : $_GET['coddoc']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{

	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON ASIGNACIONES DE MATERIAS PARA EL DOCENTE SELECCIONADO</center>";
		echo "</div>";		
	exit;
		}
		else
		{
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
###################### FUNCION BUSQUEDA ASIGNACIONES DE MATERIAS REPORTES ###########################

######################### FIN DE CLASE ASIGNACIONES DE MATERIAS A DOCENTES #########################


































################################### CLASE ESTUDIANTES #######################################

############################## FUNCION VERIFICAR INSCRIPCIONES ##########################
	public function VerificaInscripcion()
	{
		self::SetNames();
		$sql = " select * from cajas where codigo = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_SESSION["codigo"]) );
		$num = $stmt->rowCount();
		if($num==0){
		
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<center><span class='fa fa-info-circle'></span> DISCULPE, USTED NO TIENE ASIGNADA UNA CAJA PARA PROCESAR COBROS DE CUOTAS E INSCRIPCIONES, DIRIJASE AL ADMINISTRADOR DEL SISTEMA PARA QUE LE SEA ASIGNADA UNA CAJA</center>";
	echo "</div>";

	} else {

		$sql = " SELECT * FROM arqueocaja INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja WHERE cajas.codigo = ".$_SESSION["codigo"]." AND statusarqueo = '1'";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<center><span class='fa fa-info-circle'></span> POR FAVOR, DEBE DE REALIZAR EL ARQUEO DE CAJA PARA PROCESAR INSCRIPCIONES Y COBROS DE CUOTAS, PARA HACER EL ARQUEO DE CAJA HAZ CLIC <a href='forarqueo'>AQUI</a></center>";
	echo "</div>";

	} else {

	    $sql = "select * from configuracion";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		
		$fecha=strftime("%Y-%m-%d"); //fecha tipo 2011/06/14
		$inicio = $row['inicioinscripcion'];
		$fin = $row['fininscripcion'];
	
		if($fecha >= $inicio && $fecha <= $fin) { ?>

        <div class="row"> 
                        <div class="col-md-12"> 
                              <div class="form-group has-feedback"> 
<label class="control-label">Ingrese N&deg de DNI de Estudiante: <span class="symbol required"></span></label>
<input name="cedula" class="form-control" type="text" id="cedula" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese N&deg de DNI de Estudiante" autocomplete="off" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>    
                                                                </div> 
                                                            </div>				
        </div><br>

            <div class="text-right">
<button type="button" onClick="BuscaEstudiante(document.getElementById('cedula').value)" class="btn btn-primary"><span class="fa fa-search"></span> Realizar B&uacute;squeda</button>
		    </div>

	<?php	} else {

	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> EN ESTE MOMENTO EL PROCESO DE INSCRIPCI&Oacute;N, SE ENCUENTRA CERRADO O DESACTIVADO, <br> DIRIJASE AL ADMINISTRADOR DEL SISTEMA PARA QUE LO REINICIE O ACTIVE</center>";
    echo "</div>";
              }
         }
	}
}
############################## FUNCION VERIFICAR INSCRIPCIONES ##########################

########################## FUNCION BUSQUEDA ESTUDIANTES PARA INSCRIPCIONES #####################
public function BuscarEstudiante()
	{
		self::SetNames();		
	$est = " SELECT * FROM (estudiantes INNER JOIN padres ON estudiantes.cedpadre = padres.cedpadre) INNER JOIN turnos ON turnos.codturno = estudiantes.codturno INNER JOIN secciones ON secciones.codseccion = estudiantes.codseccion INNER JOIN grados ON grados.codgrado = secciones.codgrado INNER JOIN niveles ON secciones.codnivel = niveles.codnivel INNER JOIN periodoescolar ON periodoescolar.codperiodo = estudiantes.codperiodo WHERE estudiantes.cedest = '".$_GET["cedula"]."' and estudiantes.statusest = '1'";
		
		foreach ($this->dbh->query($est) as $row3)
		{
			$this->p3[] = $row3;
		}
		
	$conf = "select * from periodoescolar where statusperiodo = '1'";
		foreach ($this->dbh->query($conf) as $rowcon)
		{
			$this->pcon[] = $rowcon;
		}
		$mesesactivos = $rowcon['mesesactivos'];
		$periodo = $rowcon['periodo'];
		$cuotaunica = $rowcon['cuotaunica'];
				
	$sql ="SELECT periodo from periodoescolar where statusperiodo = 1";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO EXISTEN PERIODO ESCOLAR ACTIVO, POR FAVOR DEBER&Aacute; DE CREARLO</center>";
    echo "</div>";		
	exit;
		}
		else
		{
	$sql ="SELECT * from grados";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO EXISTEN GRADOS REGISTRADOS, POR FAVOR DEBER&Aacute; DE CREARLOS</center>";
    echo "</div>";		
    exit;
		}
		else
		{
	$sql ="SELECT * from secciones";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
    echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO EXISTEN SECCIONES REGISTRADAS, POR FAVOR DEBER&Aacute; DE CREARLAS</center>";
    echo "</div>";		
	exit;
		}
		else
		{
	$sql ="SELECT * from niveles";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO EXISTEN NIVELES REGISTRADOS, POR FAVOR DEBER&Aacute; DE CREARLOS</center>";
    echo "</div>";		
		exit;
		}
		else
		{
	$sql ="SELECT * from turnos";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO EXISTEN TURNOS REGISTRADOS, POR FAVOR DEBER&Aacute; DE CREARLOS</center>";
    echo "</div>";		
    exit;
		}
		else
		{				
	$sql = " SELECT * FROM estudiantes INNER JOIN padres ON estudiantes.cedpadre = padres.cedpadre WHERE estudiantes.cedest = ? and estudiantes.statusest = '1'";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_GET["cedula"]) );
		$num = $stmt->rowCount();
		if($num>0)
		{		
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
                            <div class="col-md-3"> 
                              <div class="form-group has-feedback"> 
   <label class="control-label">N&deg; de DNI: <span class="symbol required"></span></label>
<br /><abbr title="N&deg; de DNI del Estudiante"><?php echo $row3['cedest']; ?></abbr>
                          
                                                                </div> 
                                                            </div>
															
							<div class="col-md-6"> 
                               <div class="form-group has-feedback"> 
   <label class="control-label">Apellidos y Nombres: <span class="symbol required"></span></label> 
<br /><abbr title="Apellidos y Nombres del Estudiante"><?php echo $row3['papeest']." ".$row3['sapeest']." ".$row3['pnomest']." ".$row3['snomest']; ?></abbr>
                                                                </div>
                                                            </div>
                            <div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Nivel: <span class="symbol required"></span></label> 
<br /><abbr title="Nivel"><?php echo $row3['nivel']; ?></abbr>
                                                                </div> 
                                                            </div>  	
                    </div>
					
					 <div class="row">  

                           <div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Turno: <span class="symbol required"></span></label> 
<br /><abbr title="Turno"><?php echo $row3['turno']; ?></abbr>
                                                                </div> 
                                                            </div> 
															
							<div class="col-md-6"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Grado y Secci&oacute;n: <span class="symbol required"></span></label> 
<br /><abbr title="Grado y Secci&oacute;n"><?php echo $row3['grado']." / SECCI&Oacute;N '".$row3['seccion']."'"; ?></abbr>
                                                                </div> 
                                                            </div>
															
							<div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Becado: <span class="symbol required"></span></label> 
<br /><abbr title="Becado"><?php echo $row3['becado']; ?></abbr>  
                                                                </div> 
                                                            </div>
                     </div>	
					 
					 <div class="row"> 
															
							<div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Periodo Escolar: <span class="symbol required"></span></label> 
<br /><abbr title="Periodo Escolar Inscrito"><?php echo $row3['periodo']; ?></abbr>  
                                                                </div> 
                                                            </div>

                           <div class="col-md-6"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Fecha de Inscripci&oacute;n: <span class="symbol required"></span></label> 
<br /><abbr title="Fecha de Inscripci&oacute;n"><?php echo date("d-m-Y",strtotime($row3['fechainscripcion'])); ?></abbr>
                                                                </div> 
                                                            </div> 

                           <div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Edad: <span class="symbol required"></span></label> 
<br />
<abbr title="Edad"><?php echo edad($row3['fnacest'])." A&Ntilde;OS"; ?></abbr>
                                                                </div> 
                                                            </div> 
                      </div>

                       <div class="row">
                            <div class="col-md-3"> 
                              <div class="form-group has-feedback"> 
<label class="control-label">N&deg; de DNI de Padre/Tutor: <span class="symbol required"></span></label> 
<br /><abbr title="N&deg; de DNI de Padre/Tutor"><?php echo $row3['cedpadre']; ?></abbr>  
                                                                </div> 
                                                            </div>
          
          			<div class="col-md-6"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Nombres y Apellidos Padre/Tutor: <span class="symbol required"></span></label> 
<br /><abbr title="Nombres y Apellidos Padre/Tutor"><?php echo $row3['nompadre']." ".$row3['apepadre']; ?></abbr> 
                                                                </div> 
                                                            </div>
															
							<div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">N&deg; de Tel&eacute;fono: <span class="symbol required"></span></label> 
<br /><abbr title="N&deg; de Tel&eacute;fono"><?php echo $row3['tlfpadre']; ?></abbr>  
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
		<?php
		exit;
		}
		else
		{
$sql = " SELECT * FROM estudiantes INNER JOIN padres ON estudiantes.cedpadre = padres.cedpadre WHERE estudiantes.cedest = ? and estudiantes.statusest = '0'";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_GET["cedula"]) );
		$num = $stmt->rowCount();
		if($num==0)
		{
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
      <label class="control-label">N&deg; de DNI: <span class="symbol required"></span></label> 
<input name="cuotaunica" type="hidden" id="cuotaunica" value="<?php echo $cuotaunica; ?>"/>
<input name="cedest" class="form-control" type="text" id="cedest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese N&deg; de DNI de Estudiante" autocomplete="off" value="<?php echo $_GET['cedula']; ?>" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>   
                                                                </div> 
                                                            </div>
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
         <label class="control-label">Primer Nombre: <span class="symbol required"></span></label> 
<input name="pnomest" class="form-control" type="text" id="pnomest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Primer Nombre de Estudiante" autocomplete="off" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>  
                                                                </div> 
                                                            </div>  
                            <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
        <label class="control-label">Segundo Nombre: </label> 
<input name="snomest" class="form-control" type="text" id="snomest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Segundo Nombre de Estudiante" autocomplete="off"/>
                        <i class="fa fa-pencil form-control-feedback"></i>  
                                                                </div> 
                                                            </div>  
                    </div>
          
           <div class="row">
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
       <label class="control-label">Primer Apellido: <span class="symbol required"></span></label> 
<input name="papeest" class="form-control" type="text" id="papeest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Primer Apellido de Estudiante" autocomplete="off" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>  
                                                                </div> 
                                                            </div>  
 
                            <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
      <label class="control-label">Segundo Apellido: </label> 
<input name="sapeest" class="form-control" type="text" id="sapeest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Segundo Apellido de Estudiante" autocomplete="off"/>
                        <i class="fa fa-pencil form-control-feedback"></i>  
                                                                </div> 
                                                            </div> 
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
            <label class="control-label">Sexo: <span class="symbol required"></span></label> 
  <i class="fa fa-bars form-control-feedback"></i>
    <select name="sexoest" id="sexoest" class='form-control' required="required">
        <option value="">SELECCIONE</option>
        <option value="MASCULINO">MASCULINO</option>
        <option value="FEMENINO">FEMENINO</option>
     </select>  
                                                                </div> 
                                                            </div>  
                    </div>

                    <div class="row"> 
                           <div class="col-md-8"> 
                               <div class="form-group has-feedback"> 
  <label class="control-label">Direcci&oacute;n Domiciliaria: <span class="symbol required"></span></label> 
<input name="direcest" class="form-control" type="text" id="direcest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Direcci&oacute;n Domiciliaria" autocomplete="off" required="required"/>
                        <i class="fa fa-map-marker form-control-feedback"></i>  
                                                                </div> 
                                                            </div> 
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
      <label class="control-label">Fecha de Nacimiento: <span class="symbol required"></span></label> 
<input name="fnacest" class="form-control nacimiento" type="text" id="fnacest" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Fecha de Nacimiento" autocomplete="off" required="required"/>
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
      <label class="control-label">Seleccione Secci&oacute;n: <span class="symbol required"></span></label>  <i class="fa fa-bars form-control-feedback"></i>
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
<input name="periodo" class="form-control" type="text" id="periodo" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Periodo Escolar" autocomplete="off" value="<?php echo $periodo; ?>" readonly="readonly"/>
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
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Datos del Representante o Tutor</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12">
   <div class="box-body">


   	 <div class="row"> 
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
      <label class="control-label">N&deg; de DNI de Padre/Tutor: <span class="symbol required"></span></label> 
<input type="hidden" name="statuspad" id="statuspad" value="">
<input name="cedpadre" class="form-control" type="text" id="cedpadre" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese N&deg; de DNI de Padre/Tutor" autocomplete="off" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>   
                                                                </div> 
                                                            </div>
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Nombres: <span class="symbol required"></span></label> 
<input name="nompadre" class="form-control" type="text" id="nompadre" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nombre de Padre/Tutor" autocomplete="off" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>  
                                                                </div> 
                                                            </div>
                            <div class="col-md-4">
                 <div class="form-group has-feedback"> 
        <label class="control-label">Apellidos: <span class="symbol required"></span></label> 
<input name="apepadre" class="form-control" type="text" id="apepadre" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Apellidos de Padre/Tutor" autocomplete="off" required="required"/>
                        <i class="fa fa-pencil form-control-feedback"></i>  
                                                                </div> 
                                                            </div>  
                    </div>
          
          <div class="row">  
                <div class="col-md-4"> 
                    <div class="form-group has-feedback"> 
    <label class="control-label">N&deg; de Tel&eacute;fono: <span class="symbol required"></span></label> 
<input name="tlfpadre" class="form-control" type="text" id="tlfpadre" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Tel&eacute;fono de Padre/Tutor" autocomplete="off" required="required"/>
             <i class="fa fa-phone form-control-feedback"></i>    
                                                                </div> 
                                                            </div>   
                     </div> <br>

     <div class="text-right">
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><span class="fa fa-save"></span> Inscribir</button>
<button class="btn btn-danger" type="button" onclick="
        document.getElementById('cedest').value = '',
        document.getElementById('pnomest').value = '',
        document.getElementById('snomest').value = '',
		document.getElementById('papeest').value = '',
        document.getElementById('sapeest').value = '',
		document.getElementById('sexoest').value = '',
		document.getElementById('direcest').value = '',
		document.getElementById('fnacest').value = '',
		document.getElementById('codturno').value = '',
		document.getElementById('codnivel').value = '',
		document.getElementById('codgrado').value = '',
		document.getElementById('codseccion').value = '',
		document.getElementById('becado').value = '',
        document.getElementById('cedpadre').value = '',
        document.getElementById('nompadre').value = '',
        document.getElementById('apepadre').value = '',
        document.getElementById('tlfpadre').value = ''
        "><i class="fa fa-trash-o"></i> Limpiar</button>
                  </div>

                        </div><!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

            
	<?php  
	     exit;
               } else {
			              if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			                {
				          $this->p[] = $row;
			                }
			              return $this->p;
			              $this->dbh=null;
						  }
		              }
	              }
	          }
	      } 
       }
   }
}
########################## FUNCION BUSQUEDA ESTUDIANTES PARA INSCRIPCIONES #####################

########################### FUNCION REGISTRAR INSCRIPCIONES ###############################
	    public function RegistrarEstudiantes() {
		
		self::SetNames();
		if(empty($_POST["cedest"]) or empty($_POST["pnomest"]) or empty($_POST["papeest"]))
		{
			echo "1";
			exit;
		}

		$sql = "select * from periodoescolar where statusperiodo = '1'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$codperiodo = $row['codperiodo'];
		$cuota = $row['cuotaunica'];
		$mesesactivos = explode(", ",$row['mesesactivos']);
		$inicio = reset($mesesactivos); // Primero
        $fin = end($mesesactivos); // Ultimo
		
		################ AQUI CONSULTAMOS LOS NIVELES Y PAGOS PARA REGISTROS ###################
		$niv = "select codnivel,nivel,pagonivel from niveles where codnivel = '".$_POST["codnivel"]."'";
		foreach ($this->dbh->query($niv) as $row3)
		{
			$this->p3[] = $row3;
		}
		$codigonivel = $row3['codnivel'];
		$nivel = $row3['nivel'];
		$pagonivel = $row3['pagonivel'];

######################## FUNCION PARA GENERAL CODIGO DE RECIBO ###########################
$numrecibo = "C".GeraHash(18);
######################## FUNCION PARA GENERAL CODIGO DE RECIBO ###########################
				    
if (isset($_POST['update']) && $_POST['update'] == "ACTUALIZAR") {
		
		  ################ AQUI ACTUALIZAMOS LOS DATOS DEL ESTUDIANTE ###################
             $sql = " update estudiantes set "
			  ." cedpadre = ?, "
			  ." cedest = ?, "
			  ." pnomest = ?, "
			  ." snomest = ?, "
			  ." papeest = ?, "
			  ." sapeest = ?, "
			  ." sexoest = ?, "
			  ." direcest = ?, "
			  ." fnacest = ?, "
			  ." codseccion = ?, "
			  ." codturno = ?, "
			  ." codperiodo = ?, "
			  ." becado = ?, "
			  ." observacionest = ?, "
			  ." retiroest = ?, "
			  ." claveest = ?, "
			  ." statusest = ?, "
			  ." fechainscripcion = ? "
			  ." where "
			  ." codest = ?;
			   ";
		    $stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $cedpadre);
			$stmt->bindParam(2, $cedest);
			$stmt->bindParam(3, $pnomest);
			$stmt->bindParam(4, $snomest);
			$stmt->bindParam(5, $papeest);
			$stmt->bindParam(6, $sapeest);
			$stmt->bindParam(7, $sexoest);
			$stmt->bindParam(8, $direcest);
			$stmt->bindParam(9, $fnacest);
			$stmt->bindParam(10, $codseccion);
			$stmt->bindParam(11, $codturno);
			$stmt->bindParam(12, $codperiodo);
			$stmt->bindParam(13, $becado);
			$stmt->bindParam(14, $observacionest);
			$stmt->bindParam(15, $retiroest);
			$stmt->bindParam(16, $claveest);
			$stmt->bindParam(17, $statusest);
			$stmt->bindParam(18, $fechainscripcion);
		    $stmt->bindParam(19, $codest);
			
			$codest = strip_tags($_POST["codest"]);
			$cedpadre = strip_tags($_POST["cedpadre"]);
			$cedest = strip_tags($_POST["cedest"]);
			$pnomest = strip_tags($_POST["pnomest"]);
			$snomest = strip_tags($_POST["snomest"]);
			$papeest = strip_tags($_POST["papeest"]);
			$sapeest = strip_tags($_POST["sapeest"]);
			$sexoest = strip_tags($_POST["sexoest"]);
			$direcest = strip_tags($_POST["direcest"]);
			$fnacest = strip_tags(date("Y-m-d",strtotime($_POST['fnacest'])));
			$codseccion = strip_tags($_POST["codseccion"]);
			$codturno = strip_tags($_POST["codturno"]);
			$becado = strip_tags($_POST["becado"]);
			$observacionest = strip_tags("0");
			$retiroest = strip_tags("0000-00-00");
			$claveest = strip_tags(sha1(md5($_POST["cedest"])));
			$statusest = strip_tags("1");	
			$fechainscripcion = strip_tags(date("Y-m-d"));
			$stmt->execute();
			
		################ AQUI ACTUALIZAMOS LOS DATOS DEL TUTOR ###################3
             $sql = " update padres set "
			  ." cedpadre = ?, "
			  ." nompadre = ?, "
			  ." apepadre = ?, "
			  ." tlfpadre = ?, "
			  ." statuspad = ? "
			  ." where "
			  ." cedpadre = ?;
			   ";
		    $stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $cedpadre);
			$stmt->bindParam(2, $nompadre);
			$stmt->bindParam(3, $apepadre);
			$stmt->bindParam(4, $tlfpadre);
			$stmt->bindParam(5, $statuspad);
			$stmt->bindParam(6, $cedant);
			
			$cedpadre = strip_tags($_POST["cedpadre"]);
			$nompadre = strip_tags($_POST["nompadre"]);
			$apepadre = strip_tags($_POST["apepadre"]);
			$tlfpadre = strip_tags($_POST["tlfpadre"]);
			$statuspad = strip_tags("1");
			$cedant = strip_tags($_POST["cedant"]);
		    $stmt->execute();

			
		  if($_POST["becado"]=="COMPLETA"){

		 $query = " insert into pagos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
		    $stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $numcomprobante);
			$stmt->bindParam(2, $codest);
			$stmt->bindParam(3, $codseccion);
			$stmt->bindParam(4, $codturno);
			$stmt->bindParam(5, $codperiodo);
			$stmt->bindParam(6, $becado);
			$stmt->bindParam(7, $mespago);
			$stmt->bindParam(8, $montopago);
			$stmt->bindParam(9, $fechapago);
			$stmt->bindParam(10, $statuspago);
		    $stmt->bindParam(11, $codigo);
			
			$numcomprobante = strip_tags($numrecibo);
			$codest = strip_tags($_POST["codest"]);
			$codnivel = strip_tags($_POST["codnivel"]);
			$codseccion = strip_tags($_POST["codseccion"]);
			$codturno = strip_tags($_POST["codturno"]);
			$becado = strip_tags($_POST["becado"]);
			$mespago = strip_tags($inicio);
            $montopago = strip_tags($pagonivel);
		    $fechapago = strip_tags(date("Y-m-d"));
			$statuspago = strip_tags("1");
		    $codigo = strip_tags($_SESSION['codigo']);
		    $stmt->execute();

		    $query = " insert into pagos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
		    $stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $numcomprobante);
			$stmt->bindParam(2, $codest);
			$stmt->bindParam(3, $codseccion);
			$stmt->bindParam(4, $codturno);
			$stmt->bindParam(5, $codperiodo);
			$stmt->bindParam(6, $becado);
			$stmt->bindParam(7, $mespago);
			$stmt->bindParam(8, $montopago);
			$stmt->bindParam(9, $fechapago);
			$stmt->bindParam(10, $statuspago);
		    $stmt->bindParam(11, $codigo);
			
			$numcomprobante = strip_tags($numrecibo);
			$codest = strip_tags($_POST["codest"]);
			$codnivel = strip_tags($_POST["codnivel"]);
			$codseccion = strip_tags($_POST["codseccion"]);
			$codturno = strip_tags($_POST["codturno"]);
			$becado = strip_tags($_POST["becado"]);
			$mespago = strip_tags($fin);
            $montopago = strip_tags($pagonivel);
		    $fechapago = strip_tags(date("Y-m-d"));
			$statuspago = strip_tags("1");
		    $codigo = strip_tags($_SESSION['codigo']);
		    $stmt->execute();

		    $query = " insert into pagosextras values (null, ?, ?, ?, ?, ?); ";
		    $stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $numcomprobante);
			$stmt->bindParam(2, $codest);
			$stmt->bindParam(3, $cuotaunica);
			$stmt->bindParam(4, $descuento);
			$stmt->bindParam(5, $montomesextra);
			
			$numcomprobante = strip_tags($numrecibo);
			$codest = strip_tags($_POST["codest"]);	
		    $cuotaunica = strip_tags($_POST["cuotaunica"]);
		    $descuento = strip_tags("0.00");
		    $montomesextra = strip_tags("0.00");
		    $stmt->execute();

######################## AGREGO EL DINERO A CAJA ############################
		$sql = " SELECT * FROM arqueocaja INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja WHERE cajas.codigo = ".$_SESSION["codigo"]." AND statusarqueo = '1'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$codcaja = $row['codcaja'];
		$ingreso = $row['ingresos'];

		$sql = " update arqueocaja set "
		." ingresos = ? "
		." where "
		." codcaja = ? and statusarqueo = '1';
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $txtTotal);
		$stmt->bindParam(2, $codcaja);

        $suma = $pagonivel*2;
		$txtTotal = rount($suma+$cuota+$ingreso,2);
		$stmt->execute();
######################## AGREGO EL DINERO A CAJA ############################

		  
    echo "<span class='fa fa-check-square-o'></span> EL ESTUDIANTE HA SIDO INSCRITO EXITOSAMENTE <a href='reportepdf?codest=".base64_encode($codest)."&numcomprobante=".base64_encode($numrecibo)."&tipo=".base64_encode("COMPROBANTEPAGOS")."' class='on-default' data-placement='left' data-toggle='tooltip' data-original-title='Imprimir Comprobante' target='_black'><strong>IMPRIMIR COMPROBANTE DE PAGO</strong></a>";
    exit;
		  
		  } else {

		  ################ AQUI REGISTRAMOS LOS MESES A CANCELAR ###################3
		  foreach($mesesactivos as $value)
		       {
			         $status="0";
			         //$desc="0";
			         //$cuota="0";
			         //$mesextra="0";
					 $comprobante="0";
				     foreach($_POST['mespago'] as $valueSelected)
		              {
			              if($value==$valueSelected)
				          {
				          $status="1";
				          //$desc=$_POST["descuento"];
				          //$cuota=$_POST["cuotaunica"];
				          //$mesextra=$_POST["montomesextra"];
						  $comprobante=$numrecibo;
						  $fecha=date("Y-m-d");
				          }
			          }
		 
		    $query = " insert into pagos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
		    $stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $numcomprobante);
			$stmt->bindParam(2, $codest);
			$stmt->bindParam(3, $codseccion);
			$stmt->bindParam(4, $codturno);
			$stmt->bindParam(5, $codperiodo);
			$stmt->bindParam(6, $becado);
			$stmt->bindParam(7, $mespago);
			$stmt->bindParam(8, $montopago);
			$stmt->bindParam(9, $fechapago);
			$stmt->bindParam(10, $statuspago);
		    $stmt->bindParam(11, $codigo);
			
			$numcomprobante = strip_tags($comprobante);
			$codest = strip_tags($_POST["codest"]);
			$codnivel = strip_tags($_POST["codnivel"]);
			$codseccion = strip_tags($_POST["codseccion"]);
			$codturno = strip_tags($_POST["codturno"]);
			$becado = strip_tags($_POST["becado"]);
			$mespago = strip_tags($value);
if (strip_tags($codnivel==$codigonivel && $_POST["becado"]=="NO")) { $montopago = strip_tags($pagonivel); } elseif (strip_tags($codnivel==$codigonivel && $_POST["becado"]=="MEDIA")) { $montopago = strip_tags($pagonivel/2); } elseif (strip_tags($codnivel==$codigonivel && $_POST["becado"]=="NO")) { $montopago = strip_tags($pagonivel); } elseif (strip_tags($codnivel==$codigonivel && $_POST["becado"]=="MEDIA")) { $montopago = strip_tags($pagonivel/2); } elseif (strip_tags($codnivel==$codigonivel && $_POST["becado"]=="NO")) { $montopago = strip_tags($pagonivel); } elseif (strip_tags($codnivel==$codigonivel && $_POST["becado"]=="MEDIA")) { $montopago = strip_tags($pagonivel/2); }
		    $fechapago = strip_tags(date("Y-m-d"));
			$statuspago = strip_tags($status);
		    $codigo = strip_tags($_SESSION['codigo']);
		    $stmt->execute();

		    $sql = " update pagos set "
			  ." statuspago = ? "
			  ." where "
			  ." codest = ? AND mespago = ? AND codperiodo = ? AND mespago < '".date("m")."';
			   ";
		    $stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $statuspago);
		    $stmt->bindParam(2, $codest);
			$stmt->bindParam(3, $mespago);
			$stmt->bindParam(4, $codperiodo);
		
			$statuspago = strip_tags("3");
			$codest = strip_tags($_POST["codest"]);
			$mespago = strip_tags($value);
		    $stmt->execute();	    

                }

            $query = " insert into pagosextras values (null, ?, ?, ?, ?, ?); ";
		    $stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $numcomprobante);
		    $stmt->bindParam(2, $codest);
			$stmt->bindParam(3, $cuotaunica);
			$stmt->bindParam(4, $descuento);
			$stmt->bindParam(5, $montomesextra);
			
			$numcomprobante = strip_tags($numrecibo);
			$codest = strip_tags($_POST["codest"]);	
		    $cuotaunica = strip_tags($_POST["cuotaunica"]);
		    $descuento = strip_tags($_POST["descuento"]);
		    $montomesextra = strip_tags($_POST["montomesextra"]);
		    $stmt->execute();


######################## AGREGO EL DINERO A CAJA ############################
		$sql = " SELECT * FROM arqueocaja INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja WHERE cajas.codigo = ".$_SESSION["codigo"]." AND statusarqueo = '1'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$codcaja = $row['codcaja'];
		$ingreso = $row['ingresos'];

		$sql = " update arqueocaja set "
		." ingresos = ? "
		." where "
		." codcaja = ? and statusarqueo = '1';
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $txtTotal);
		$stmt->bindParam(2, $codcaja);

		$txtTotal = rount($_POST["total"]+$_POST["montomesextra"]+$ingreso,2);
		$stmt->execute();
######################## AGREGO EL DINERO A CAJA ############################	


    echo "<span class='fa fa-check-square-o'></span> EL ESTUDIANTE HA SIDO INSCRITO EXITOSAMENTE <a href='reportepdf?codest=".base64_encode($codest)."&numcomprobante=".base64_encode($numrecibo)."&tipo=".base64_encode("COMPROBANTEPAGOS")."' class='on-default' data-placement='left' data-toggle='tooltip' data-original-title='Imprimir Comprobante' target='_black'><strong>IMPRIMIR COMPROBANTE DE PAGO</strong></a>";
    exit;
		   }
	}
		else
	{
			

######################## FUNCION PARA CODIGO DE ESTUDIANTE ###########################
$sql = "SELECT codest FROM estudiantes ORDER BY idest DESC LIMIT 1";
		foreach ($this->dbh->query($sql) as $row){

			$numest=$row["codest"];

		}
		if(empty($numest))
		{
			$codigoest = "A1";

		} else {

			$resto = substr($numest, 0, 1);
			$coun = strlen($resto);
			$num     = substr($numest, $coun);
			$codigo     = $num + 1;
			$codigoest = "A".$codigo;
		}
######################## FUNCION PARA CODIGO DE ESTUDIANTE ###########################

			
################ AQUI REGISTRAMOS LOS DATOS DEL ESTUDIANTE ###################3
            $query = " insert into estudiantes values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codest);
			$stmt->bindParam(2, $cedpadre);
			$stmt->bindParam(3, $cedest);
			$stmt->bindParam(4, $pnomest);
			$stmt->bindParam(5, $snomest);
			$stmt->bindParam(6, $papeest);
			$stmt->bindParam(7, $sapeest);
			$stmt->bindParam(8, $sexoest);
			$stmt->bindParam(9, $direcest);
			$stmt->bindParam(10, $fnacest);
			$stmt->bindParam(11, $codseccion);
			$stmt->bindParam(12, $codturno);
			$stmt->bindParam(13, $codperiodo);
			$stmt->bindParam(14, $becado);
			$stmt->bindParam(15, $observacionest);
			$stmt->bindParam(16, $retiroest);
			$stmt->bindParam(17, $claveest);
			$stmt->bindParam(18, $statusest);
			$stmt->bindParam(19, $fechainscripcion);
			
			$codest = strip_tags($codigoest);
			$cedpadre = strip_tags($_POST["cedpadre"]);
			$cedest = strip_tags($_POST["cedest"]);
			$pnomest = strip_tags($_POST["pnomest"]);
			$snomest = strip_tags($_POST["snomest"]);
			$papeest = strip_tags($_POST["papeest"]);
			$sapeest = strip_tags($_POST["sapeest"]);
			$sexoest = strip_tags($_POST["sexoest"]);
			$direcest = strip_tags($_POST["direcest"]);
			$fnacest = strip_tags(date("Y-m-d",strtotime($_POST['fnacest'])));
			$codseccion = strip_tags($_POST["codseccion"]);
			$codturno = strip_tags($_POST["codturno"]);
			$becado = strip_tags($_POST["becado"]);
			$observacionest = strip_tags("0");
			$retiroest = strip_tags("0000-00-00");
			$claveest = strip_tags(sha1(md5($_POST["cedest"])));
			$statusest = strip_tags("1");
			$fechainscripcion = strip_tags(date("Y-m-d"));
			$stmt->execute();
			
			################ AQUI REGISTRAMOS LOS DATOS DEL TUTOR ###################
			
			if($_POST["statuspad"]!=""){
			
			$sql = " update padres set "
			  ." nompadre = ?, "
			  ." apepadre = ?, "
			  ." tlfpadre = ?, "
			  ." statuspad = ? "
			  ." where "
			  ." cedpadre = ?;
			   ";
		    $stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $nompadre);
			$stmt->bindParam(2, $apepadre);
			$stmt->bindParam(3, $tlfpadre);
			$stmt->bindParam(4, $statuspad);
			$stmt->bindParam(5, $cedpadre);
			
			$cedpadre = strip_tags($_POST["cedpadre"]);
			$nompadre = strip_tags($_POST["nompadre"]);
			$apepadre = strip_tags($_POST["apepadre"]);
			$tlfpadre = strip_tags($_POST["tlfpadre"]);
			$statuspad = strip_tags("1");
		    $stmt->execute();
			
			} else {
			
			$query = " insert into padres values (null, ?, ?, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $cedpadre);
			$stmt->bindParam(2, $nompadre);
			$stmt->bindParam(3, $apepadre);
			$stmt->bindParam(4, $tlfpadre);
			$stmt->bindParam(5, $statuspad);
			
			$cedpadre = strip_tags($_POST["cedpadre"]);
			$nompadre = strip_tags($_POST["nompadre"]);
			$apepadre = strip_tags($_POST["apepadre"]);
			$tlfpadre = strip_tags($_POST["tlfpadre"]);
			$statuspad = strip_tags("1");
			$stmt->execute();
			}
			
if($_POST["becado"]=="COMPLETA"){

		 $query = " insert into pagos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
		    $stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $numcomprobante);
			$stmt->bindParam(2, $codest);
			$stmt->bindParam(3, $codseccion);
			$stmt->bindParam(4, $codturno);
			$stmt->bindParam(5, $codperiodo);
			$stmt->bindParam(6, $becado);
			$stmt->bindParam(7, $mespago);
			$stmt->bindParam(8, $montopago);
			$stmt->bindParam(9, $fechapago);
			$stmt->bindParam(10, $statuspago);
		    $stmt->bindParam(11, $codigo);
			
			$numcomprobante = strip_tags($numrecibo);
			$codest = strip_tags($codigoest);
			$codnivel = strip_tags($_POST["codnivel"]);
			$codseccion = strip_tags($_POST["codseccion"]);
			$codturno = strip_tags($_POST["codturno"]);
			$becado = strip_tags($_POST["becado"]);
			$mespago = strip_tags($inicio);
            $montopago = strip_tags($pagonivel);
		    $fechapago = strip_tags(date("Y-m-d"));
			$statuspago = strip_tags("1");
		    $codigo = strip_tags($_SESSION['codigo']);
		    $stmt->execute();

		    $query = " insert into pagos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
		    $stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $numcomprobante);
			$stmt->bindParam(2, $codest);
			$stmt->bindParam(3, $codseccion);
			$stmt->bindParam(4, $codturno);
			$stmt->bindParam(5, $codperiodo);
			$stmt->bindParam(6, $becado);
			$stmt->bindParam(7, $mespago);
			$stmt->bindParam(8, $montopago);
			$stmt->bindParam(9, $fechapago);
			$stmt->bindParam(10, $statuspago);
		    $stmt->bindParam(11, $codigo);
			
			$numcomprobante = strip_tags($numrecibo);
			$codest = strip_tags($codigoest);
			$codnivel = strip_tags($_POST["codnivel"]);
			$codseccion = strip_tags($_POST["codseccion"]);
			$codturno = strip_tags($_POST["codturno"]);
			$becado = strip_tags($_POST["becado"]);
			$mespago = strip_tags($fin);
            $montopago = strip_tags($pagonivel);
		    $fechapago = strip_tags(date("Y-m-d"));
			$statuspago = strip_tags("1");
		    $codigo = strip_tags($_SESSION['codigo']);
		    $stmt->execute();

		    $query = " insert into pagosextras values (null, ?, ?, ?, ?, ?); ";
		    $stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $numcomprobante);
			$stmt->bindParam(2, $codest);
			$stmt->bindParam(3, $cuotaunica);
			$stmt->bindParam(4, $descuento);
			$stmt->bindParam(5, $montomesextra);
			
			$numcomprobante = strip_tags($numrecibo);
			$codest = strip_tags($codigoest);	
		    $cuotaunica = strip_tags($_POST["cuotaunica"]);
		    $descuento = strip_tags("0.00");
		    $montomesextra = strip_tags("0.00");
		    $stmt->execute();

######################## AGREGO EL DINERO A CAJA ############################
		$sql = " SELECT * FROM arqueocaja INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja WHERE cajas.codigo = ".$_SESSION["codigo"]." AND statusarqueo = '1'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$codcaja = $row['codcaja'];
		$ingreso = $row['ingresos'];

		$sql = " update arqueocaja set "
		." ingresos = ? "
		." where "
		." codcaja = ? and statusarqueo = '1';
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $txtTotal);
		$stmt->bindParam(2, $codcaja);

        $suma = $pagonivel*2;
		$txtTotal = rount($suma+$cuota+$ingreso,2);
		$stmt->execute();
######################## AGREGO EL DINERO A CAJA ############################

		  
    echo "<span class='fa fa-check-square-o'></span> EL ESTUDIANTE HA SIDO INSCRITO EXITOSAMENTE <a href='reportepdf?codest=".base64_encode($codest)."&numcomprobante=".base64_encode($numrecibo)."&tipo=".base64_encode("COMPROBANTEPAGOS")."' class='on-default' data-placement='left' data-toggle='tooltip' data-original-title='Imprimir Comprobante' target='_black'><strong>IMPRIMIR COMPROBANTE DE PAGO</strong></a>";
    exit;
			
			} else {
			
		################ AQUI REGISTRAMOS LOS MESES A CANCELAR ###################3
		  foreach($mesesactivos as $value)
		       {
			         $status="0";
			         //$desc="0";
			         //$cuota="0";
			         //$mesextra="0";
					 $comprobante="0";
				     foreach($_POST['mespago'] as $valueSelected)
		              {
			              if($value==$valueSelected)
				          {
				          $status="1";
				          //$desc=$_POST["descuento"];
				          //$cuota=$_POST["cuotaunica"];
				          //$mesextra=$_POST["montomesextra"];
						  $comprobante=$numrecibo;
						  $fecha=date("Y-m-d");
				          }
			          }

		 
		    $query = " insert into pagos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
		    $stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $numcomprobante);
			$stmt->bindParam(2, $codest);
			$stmt->bindParam(3, $codseccion);
			$stmt->bindParam(4, $codturno);
			$stmt->bindParam(5, $codperiodo);
			$stmt->bindParam(6, $becado);
			$stmt->bindParam(7, $mespago);
			$stmt->bindParam(8, $montopago);
			$stmt->bindParam(9, $fechapago);
			$stmt->bindParam(10, $statuspago);
		    $stmt->bindParam(11, $codigo);
			
			$numcomprobante = strip_tags($comprobante);
			$codest = strip_tags($codigoest);
			$codnivel = strip_tags($_POST["codnivel"]);
			$codseccion = strip_tags($_POST["codseccion"]);
			$codturno = strip_tags($_POST["codturno"]);
			$becado = strip_tags($_POST["becado"]);
			$mespago = strip_tags($value);
if (strip_tags($codnivel==$codigonivel && $_POST["becado"]=="NO")) { $montopago = strip_tags($pagonivel); } elseif (strip_tags($codnivel==$codigonivel && $_POST["becado"]=="MEDIA")) { $montopago = strip_tags($pagonivel/2); } elseif (strip_tags($codnivel==$codigonivel && $_POST["becado"]=="NO")) { $montopago = strip_tags($pagonivel); } elseif (strip_tags($codnivel==$codigonivel && $_POST["becado"]=="MEDIA")) { $montopago = strip_tags($pagonivel/2); } elseif (strip_tags($codnivel==$codigonivel && $_POST["becado"]=="NO")) { $montopago = strip_tags($pagonivel); } elseif (strip_tags($codnivel==$codigonivel && $_POST["becado"]=="MEDIA")) { $montopago = strip_tags($pagonivel/2); }
		    $fechapago = strip_tags(date("Y-m-d"));
			$statuspago = strip_tags($status);
		    $codigo = strip_tags($_SESSION['codigo']);
		    $stmt->execute();

		    $sql = " update pagos set "
			  ." statuspago = ? "
			  ." where "
			  ." codest = ? AND mespago = ? AND codperiodo = ? AND mespago < '".date("m")."';
			   ";
		    $stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $statuspago);
		    $stmt->bindParam(2, $codest);
			$stmt->bindParam(3, $mespago);
			$stmt->bindParam(4, $codperiodo);
		
			$statuspago = strip_tags("3");
			$codest = strip_tags($codigoest);
			$mespago = strip_tags($value);
		    $stmt->execute();

            }

            $query = " insert into pagosextras values (null, ?, ?, ?, ?, ?); ";
		    $stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $numcomprobante);
		    $stmt->bindParam(2, $codest);
			$stmt->bindParam(3, $cuotaunica);
			$stmt->bindParam(4, $descuento);
			$stmt->bindParam(5, $montomesextra);
			
			$numcomprobante = strip_tags($numrecibo);
			$codest = strip_tags($codigoest);	
		    $cuotaunica = strip_tags($_POST["cuotaunica"]);
		    $descuento = strip_tags($_POST["descuento"]);
		    $montomesextra = strip_tags($_POST["montomesextra"]);
		    $stmt->execute();

######################## AGREGO EL DINERO A CAJA ############################
		$sql = " SELECT * FROM arqueocaja INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja WHERE cajas.codigo = ".$_SESSION["codigo"]." AND statusarqueo = '1'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$codcaja = $row['codcaja'];
		$ingreso = $row['ingresos'];

		$sql = " update arqueocaja set "
		." ingresos = ? "
		." where "
		." codcaja = ? and statusarqueo = '1';
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $txtTotal);
		$stmt->bindParam(2, $codcaja);

		$txtTotal = rount($_POST["total"]+$_POST["montomesextra"]+$ingreso,2);
		$stmt->execute();
######################## AGREGO EL DINERO A CAJA ############################


	echo "<span class='fa fa-check-square-o'></span> EL ESTUDIANTE HA SIDO INSCRITO EXITOSAMENTE <a href='reportepdf?codest=".base64_encode($codest)."&numcomprobante=".base64_encode($numrecibo)."&tipo=".base64_encode("COMPROBANTEPAGOS")."' class='on-default' data-placement='left' data-toggle='tooltip' data-original-title='Imprimir Comprobante' target='_black'><strong>IMPRIMIR COMPROBANTE DE PAGO</strong></a>";
    exit;
			
			}
		}
	}  
########################### FUNCION REGISTRAR INSCRIPCIONES ###############################

########################### FUNCION LISTAR ESTUDIANTES ################################
	public function ListarEstudiantes()
	{
		self::SetNames();
		$sql = " SELECT * FROM estudiantes INNER JOIN turnos ON estudiantes.codturno = turnos.codturno INNER JOIN secciones ON secciones.codseccion = estudiantes.codseccion INNER JOIN grados ON secciones.codgrado = grados.codgrado INNER JOIN niveles ON secciones.codnivel = niveles.codnivel INNER JOIN periodoescolar ON periodoescolar.codperiodo = estudiantes.codperiodo WHERE estudiantes.codseccion = ? AND estudiantes.codturno = ? AND estudiantes.statusest = '1' ORDER BY estudiantes.papeest";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_GET['codseccion']));
		$stmt->bindValue(2, trim($_GET['codturno']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
		
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON RESULTADOS PARA TU B&Uacute;SQUEDA REALIZADA</center>";
    echo "</div>";		
	exit;
		       }
		else
		{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
	}
}
########################### FUNCION LISTAR ESTUDIANTES ################################

########################### FUNCION LISTAR ESTUDIANTES EN GENERAL ################################
	public function ListadoGeneral()
	{
		self::SetNames();
		$sql = " SELECT * FROM (estudiantes LEFT JOIN secciones ON estudiantes.codseccion = secciones.codseccion) LEFT JOIN grados ON secciones.codgrado = grados.codgrado LEFT JOIN niveles ON secciones.codnivel = niveles.codnivel LEFT JOIN periodoescolar ON periodoescolar.codperiodo = estudiantes.codperiodo ORDER BY nivel DESC, grado ASC, papeest ASC, seccion ASC";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
########################### FUNCION LISTAR ESTUDIANTES EN GENERAL ################################

########################### FUNCION ID ESTUDIANTES ################################
	public function EstudiantesPorId()
	{
		self::SetNames();
		$sql = " SELECT * FROM (estudiantes INNER JOIN padres ON estudiantes.cedpadre = padres.cedpadre) LEFT JOIN turnos ON turnos.codturno = estudiantes.codturno LEFT JOIN secciones ON estudiantes.codseccion = secciones.codseccion LEFT JOIN grados ON secciones.codgrado = grados.codgrado LEFT JOIN niveles ON secciones.codnivel = niveles.codnivel LEFT JOIN periodoescolar ON periodoescolar.codperiodo = estudiantes.codperiodo WHERE estudiantes.codest = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codest"])) );
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
########################### FUNCION ID ESTUDIANTES ################################

############################## FUNCION ACTUALIZAR ESTUDIANTES ##############################
	public function ActualizarEstudiante()
	{
		self::SetNames();
		if(empty($_POST["cedest"]) or empty($_POST["pnomest"]) or empty($_POST["papeest"]))
		{
			echo "1";
			exit;
		}
		$sql = " select * from estudiantes where codest != ? and cedest = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["codest"], $_POST["cedest"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
		################ AQUI ACTUALIZAMOS LOS DATOS DEL ESTUDIANTE ###################3
             $sql = " update estudiantes set "
			  ." cedest = ?, "
			  ." pnomest = ?, "
			  ." snomest = ?, "
			  ." papeest = ?, "
			  ." sapeest = ?, "
			  ." sexoest = ?, "
			  ." direcest = ?, "
			  ." fnacest = ? "
			  ." where "
			  ." codest = ?;
			   ";
		    $stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $cedest);
			$stmt->bindParam(2, $pnomest);
			$stmt->bindParam(3, $snomest);
			$stmt->bindParam(4, $papeest);
			$stmt->bindParam(5, $sapeest);
			$stmt->bindParam(6, $sexoest);
			$stmt->bindParam(7, $direcest);
			$stmt->bindParam(8, $fnacest);
		    $stmt->bindParam(9, $codest);
			
			$codest = strip_tags($_POST["codest"]);
			$cedest = strip_tags($_POST["cedest"]);
			$pnomest = strip_tags($_POST["pnomest"]);
			$snomest = strip_tags($_POST["snomest"]);
			$papeest = strip_tags($_POST["papeest"]);
			$sapeest = strip_tags($_POST["sapeest"]);
			$sexoest = strip_tags($_POST["sexoest"]);
			$direcest = strip_tags($_POST["direcest"]);
			$fnacest = strip_tags(date("Y-m-d",strtotime($_POST['fnacest'])));
			//if (strip_tags(isset($_POST['seccion']))) { $codgrado = strip_tags($_POST['seccion']); } else {  }
			
			$stmt->execute();	
		
    echo "<span class='fa fa-check-square-o'></span> EL ESTUDIANTE HA SIDO ACTUALIZADO EXITOSAMENTE";
    exit;
	}
		else
		{
			echo "2";
			exit;
		}
  }
############################## FUNCION ACTUALIZAR ESTUDIANTES ##############################

############################## FUNCION RETIRAR ESTUDIANTES ##############################
	public function RetiroEstudiante()
	{
		self::SetNames();
		if(empty($_POST["cedest"]) or empty($_POST["pnomest"]) or empty($_POST["papeest"]))
		{
			echo "1";
			exit;
		}
		$sql = " select * from estudiantes where codest != ? and cedest = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_POST["codest"], $_POST["cedest"]) );
		$num = $stmt->rowCount();
		if($num == 0)
		{
		################ AQUI RETIRAMOS ALL ESTUDIANTE ###################3
             $sql = " update estudiantes set "
			  ." observacionest = ?, "
			  ." retiroest = ?, "
			  ." statusest = ? "
			  ." where "
			  ." codest = ?;
			   ";
		    $stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $observacionest);
			$stmt->bindParam(2, $retiroest);
			$stmt->bindParam(3, $statusest);
		    $stmt->bindParam(4, $codest);
			
			$observacionest = strip_tags($_POST["observacionest"]);
			$retiroest = strip_tags(date("Y-m-d",strtotime($_POST['retiroest'])));
			$statusest = strip_tags("0");	
			$codest = strip_tags($_POST["codest"]);		
			$stmt->execute();

			$sql = " update pagos set "
			  ." statuspago = ? "
			  ." where "
			  ." codest = ? AND codperiodo = ? AND statuspago = 0;
			   ";
		    $stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $statuspago);
		    $stmt->bindParam(2, $codest);
			$stmt->bindParam(3, $codperiodo);
		
			$statuspago = strip_tags("3");
			$codest = strip_tags($_POST["codest"]);
			$codperiodo = strip_tags($_POST["codperiodo"]);
		    $stmt->execute();	
		
    echo "<div class='alert alert-info'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<span class='fa fa-check-square-o'></span> EL ESTUDIANTE FUE RETIRADO EXITOSAMENTE";
    echo "</div>";		
    exit;
	}
		else
		{
			echo "2";
			exit;
		}
  }
############################## FUNCION RETIRAR ESTUDIANTES ##############################

########################## FUNCION ELIMINAR ESTUDIANTES #########################
	public function EliminarEstudiantes()
	{

		if($_SESSION['acceso'] == "administrador") {
		
		$sql = " select * from estudiantes where cedpadre = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["cedpadre"])) );
		$num = $stmt->rowCount();
		if($num > 1)
		{
		
		$sql = " delete from estudiantes where codest = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codest);
		$codest = base64_decode($_GET["codest"]);
		$stmt->execute();
		
		$sql = " delete from pagos where codest = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codest);
		$codest = base64_decode($_GET["codest"]);
		$stmt->execute();
		
		$sql = " delete from pagospormora where codest = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codest);
		$codest = base64_decode($_GET["codest"]);
		$stmt->execute();

		echo "<div class='alert alert-info'>";
		echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
		echo "<center><span class='fa fa-check-square-o'></span> EL ESTUDIANTE FUE ELIMINADO EXITOSAMENTE </center>";
		echo "</div>";
		exit;
		   
		   }  else {
		
		$sql = " delete from estudiantes where codest = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codest);
		$codest = base64_decode($_GET["codest"]);
		$stmt->execute();
		
		$sql = " delete from notas where codest = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codest);
		$codest = base64_decode($_GET["codest"]);
		$stmt->execute();
		
		$sql = " delete from padres where cedpadre = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$cedpadre);
		$cedpadre = base64_decode($_GET["cedpadre"]);
		$stmt->execute();
		
		$sql = " delete from pagos where codest = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codest);
		$codest = base64_decode($_GET["codest"]);
		$stmt->execute();
		
		$sql = " delete from pagospormora where codest = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codest);
		$codest = base64_decode($_GET["codest"]);
		$stmt->execute();
		
		echo "<div class='alert alert-info'>";
		echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
		echo "<center><span class='fa fa-check-square-o'></span> EL ESTUDIANTE FUE ELIMINADO EXITOSAMENTE </center>";
		echo "</div>";
		exit;
		       }
		}
		else
		{
		echo "<div class='alert alert-warning'>";
		echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
		echo "<center><span class='fa fa-info-circle'></span> USTED NO PUEDE ELIMINAR ESTUDIANTES, NO ERES EL ADMINISTRADOR DEL SISTEMA </center>"; 
		echo "</div>";
		exit;
		}
	} 
########################## FUNCION ELIMINAR ESTUDIANTES #########################

######################### FUNCION BUSQUEDA ESTUDIANTES REPORTES #############################
public function BuscarEstudiantesReportes() 
	       {
		self::SetNames();

if ($_SESSION['acceso'] == "docente") {

		$sql = " SELECT * FROM asignaciones INNER JOIN periodoescolar ON asignaciones.codperiodo = periodoescolar.codperiodo
		WHERE asignaciones.coddoc = ? AND asignaciones.codturno = ? AND asignaciones.codseccion = ? AND periodoescolar.statusperiodo = 1";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_SESSION['coddoc']));
		$stmt->bindValue(2, trim($_GET['codturno']));
		$stmt->bindValue(3, trim($_GET['codseccion']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> ESTA SECCI&Oacute;N NO SE ENCUENTRA ASIGNADA A ESTE DOCENTE, VERIFIQUE NUEVAMENTE POR FAVOR</center>";
    echo "</div>";		
	exit;
		} 
} 

		$sql = " SELECT * FROM estudiantes INNER JOIN turnos ON estudiantes.codturno = turnos.codturno INNER JOIN secciones ON secciones.codseccion = estudiantes.codseccion INNER JOIN grados ON secciones.codgrado = grados.codgrado INNER JOIN niveles ON secciones.codnivel = niveles.codnivel INNER JOIN periodoescolar ON periodoescolar.codperiodo = estudiantes.codperiodo WHERE estudiantes.codseccion = ? and estudiantes.codturno = ? and estudiantes.statusest = '1' ORDER BY estudiantes.papeest";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_GET['codseccion']));
		$stmt->bindValue(2, trim($_GET['codturno']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
		
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON RESULTADOS PARA TU B&Uacute;SQUEDA REALIZADA</center>";
    echo "</div>";		
	exit;
		       }
		else
		{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
	}
}
######################### FUNCION BUSQUEDA ESTUDIANTES REPORTES #############################

######################################## FIN DE CLASE ESTUDIANTES ####################################






































######################################## CLASE TUTORES #########################################

################################# FUNCION LISTAR TUTORES ################################
	public function ListarTutores()
	{
		self::SetNames();
		$sql = " select * from padres ORDER BY apepadre";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}	
################################# FUNCION LISTAR TUTORES ################################

################################# FUNCION ID TUTORES #1 ###############################
	public function TutorPorIdMuestra()
	{
		self::SetNames();
		$sql = " SELECT * FROM (estudiantes INNER JOIN padres ON estudiantes.cedpadre = padres.cedpadre) LEFT JOIN turnos ON turnos.codturno = estudiantes.codturno LEFT JOIN secciones ON estudiantes.codseccion = secciones.codseccion LEFT JOIN grados ON secciones.codgrado = grados.codgrado LEFT JOIN niveles ON secciones.codnivel = niveles.codnivel LEFT JOIN periodoescolar ON periodoescolar.codperiodo = estudiantes.codperiodo WHERE padres.codpadre = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codpadre"])) );
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
################################# FUNCION ID TUTORES ################################


############################# FUNCION ID TUTORES #2 #################################
	public function TutorPorId()
	{
		self::SetNames();
		$sql = " SELECT * FROM estudiantes INNER JOIN padres ON estudiantes.cedpadre = padres.cedpadre WHERE padres.codpadre = ?";		
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codpadre"])) );
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
############################# FUNCION ID TUTORES #2 #################################

############################ FUNCION ACTUALIZAR TUTORES #############################
	public function ActualizarTutor()
	{
		
		self::SetNames();
		if(empty($_POST["cedpadre"]) or empty($_POST["nompadre"]) or empty($_POST["apepadre"]))
		{
			echo "1";
			exit;
		}
		################ AQUI ACTUALIZAMOS LOS DATOS DEL TUTOR ###################3
             $sql = " update padres set "
			  ." cedpadre = ?, "
			  ." nompadre = ?, "
			  ." apepadre = ?, "
			  ." tlfpadre = ? "
			  ." where "
			  ." codpadre = ?;
			   ";
		    $stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $cedpadre);
			$stmt->bindParam(2, $nompadre);
			$stmt->bindParam(3, $apepadre);
			$stmt->bindParam(4, $tlfpadre);
			$stmt->bindParam(5, $codpadre);
			
			$codpadre = strip_tags($_POST["codpadre"]);
			$cedpadre = strip_tags($_POST["cedpadre"]);
			$nompadre = strip_tags($_POST["nompadre"]);
			$apepadre = strip_tags($_POST["apepadre"]);
			$tlfpadre = strip_tags($_POST["tlfpadre"]);
		    $stmt->execute();

		    $sql = " update estudiantes set "
			  ." cedpadre = ? "
			  ." where "
			  ." cedpadre = ?;
			   ";
		    $stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $cedpadre);
			$stmt->bindParam(2, $cedant);
			
			$cedpadre = strip_tags($_POST["cedpadre"]);
			$cedant = strip_tags($_POST["cedant"]);
		    $stmt->execute();
		
    echo "<span class='fa fa-check-square-o'></span> EL PADRE/TUTOR HA SIDO ACTUALIZADO EXITOSAMENTE";
    exit;
	}
############################ FUNCION ACTUALIZAR TUTORES #############################

###################### FUNCION BUSQUEDA REPRESENTANTES REPORTES ###########################
	    public function BuscarRepresentantesReportes() 
	       {
		self::SetNames();

if ($_SESSION['acceso'] == "docente") {

		$sql = " SELECT * FROM asignaciones INNER JOIN periodoescolar ON asignaciones.codperiodo = periodoescolar.codperiodo
		WHERE asignaciones.coddoc = ? AND asignaciones.codturno = ? AND asignaciones.codseccion = ? AND periodoescolar.statusperiodo = 1";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_SESSION['coddoc']));
		$stmt->bindValue(2, trim($_GET['codturno']));
		$stmt->bindValue(3, trim($_GET['codseccion']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> ESTA SECCI&Oacute;N NO SE ENCUENTRA ASIGNADA A ESTE DOCENTE, VERIFIQUE NUEVAMENTE POR FAVOR</center>";
    echo "</div>";		
	exit;
		} 
}

		$sql = " SELECT * FROM (estudiantes INNER JOIN padres ON estudiantes.cedpadre = padres.cedpadre)  INNER JOIN turnos ON estudiantes.codturno = turnos.codturno INNER JOIN secciones ON secciones.codseccion = estudiantes.codseccion INNER JOIN grados ON secciones.codgrado = grados.codgrado INNER JOIN niveles ON secciones.codnivel = niveles.codnivel INNER JOIN periodoescolar ON periodoescolar.codperiodo = estudiantes.codperiodo WHERE estudiantes.codseccion = ? and estudiantes.codturno = ? and estudiantes.statusest = '1' ORDER BY estudiantes.papeest";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_GET['codseccion']));
		$stmt->bindValue(2, trim($_GET['codturno']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
		
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON RESULTADOS PARA TU B&Uacute;SQUEDA REALIZADA</center>";
    echo "</div>";		
	exit;
		       }
		else
		{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
###################### FUNCION BUSQUEDA REPRESENTANTES REPORTES ###########################

###################################### FIN DE CLASE TUTORES ######################################




































################################### CLASE PAGOS DE ESTUDIANTES ######################################

############################## FUNCION VERIFICAR PAGOS ##########################
	public function VerificaPagos()
	{
		self::SetNames();
		$sql = " select * from cajas where codigo = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array($_SESSION["codigo"]) );
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<center><span class='fa fa-info-circle'></span> DISCULPE, USTED NO TIENE ASIGNADA UNA CAJA PARA PROCESAR COBROS DE CUOTAS, DIRIJASE AL ADMINISTRADOR DEL SISTEMA PARA QUE LE SEA ASIGNADA UNA CAJA</center>";
	echo "</div>";

	} else {

		$sql = " SELECT * FROM arqueocaja INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja WHERE cajas.codigo = ".$_SESSION["codigo"]." AND statusarqueo = '1'";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<center><span class='fa fa-info-circle'></span> POR FAVOR, DEBE DE REALIZAR EL ARQUEO DE CAJA PARA PROCESAR COBROS DE CUOTAS, PARA HACER EL ARQUEO DE CAJA HAZ CLIC <a href='forarqueo'>AQUI</a></center>";
	echo "</div>";

	} else { ?>

		<div class="row"> 
                            <div class="col-md-8"> 
                              <div class="form-group has-feedback"> 
       <label class="control-label">B&uacute;squeda de Estudiante: <span class="symbol required"></span></label> 
<input name="codest" type="hidden" id="codest"/>
<input name="busqueda" class="form-control" type="text" id="busqueda" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese C&oacute;digo del Estudiante" autocomplete="off" required="required"/>
                        <i class="fa fa-search form-control-feedback"></i>    
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
<button type="button" onClick="CrearNuevoPago(document.getElementById('codest').value,document.getElementById('codperiodo').value)" class="btn btn-primary"><span class="fa fa-search"></span> Realizar B&uacute;squeda</button>
		    </div>

	<?php	
         }
	}
}
############################## FUNCION VERIFICAR PAGOS ##########################

############################## FUNCION MOSTRAR PAGOS DE ESTUDIANTES ###########################
public function BuscarPagosEstudiantes()
	{
		self::SetNames();
		//(Select sum(pagos extra) from pagosextra where nrorecibo =?) as sumPagosExtra
		$sql ="SELECT
       est.codest id,
       est.cedest cedula,
       est.pnomest pNombre,
       est.snomest sNombre,
       est.papeest pApellido,
       est.sapeest sApellido,
       est.fnacest,
       est.fechainscripcion,
	   padres.cedpadre,
	   padres.nompadre,
	   padres.apepadre,
	   padres.tlfpadre,
	   pagos.becado, 
	   pagos.montopago,
	   pagos.codseccion, 
	   pagos.codturno, 
	   pagos.codperiodo,
	   periodoescolar.periodo, 
	   periodoescolar.mesesactivos, 
	   periodoescolar.interesmora,
	   pagosextras.cuotaunica,
	   pagosextras.descuento,
	   pagosextras.montomesextra,
	   pagospormora.cantmora, 
	   niveles.nivel, 
	   grados.grado, 
	   secciones.seccion, 
	   turnos.turno,
       pag.mesespag,
       pag.totalpagad,
	   pag2.mesespag2,
	   pag2.totalpagad2,
       venc.mesesvenc,
       venc.totalvenc
     FROM
       estudiantes est

     LEFT JOIN
       ( SELECT
           codest, COUNT(mespago) AS totalpagad, 
           CASE WHEN statuspago = 1 THEN GROUP_CONCAT(DISTINCT mespago SEPARATOR ', ') END mesespag
         FROM pagos 
         WHERE statuspago = '1' AND codperiodo = '".$_GET['codperiodo']."'
         GROUP BY codest ) pag ON pag.codest = est.codest  

     LEFT JOIN
       ( SELECT
           codest, COUNT(mespago) AS totalpagad2,
           CASE WHEN statuspago = 3 THEN GROUP_CONCAT(DISTINCT mespago SEPARATOR ', ') END mesespag2
         FROM pagos
         WHERE statuspago = '3' AND codperiodo = '".$_GET['codperiodo']."'
         GROUP BY codest ) pag2 ON pag2.codest = est.codest

     LEFT JOIN
       ( SELECT
           codest, COUNT(mespago) AS totalvenc,
           CASE WHEN statuspago = 2 THEN GROUP_CONCAT(DISTINCT mespago SEPARATOR ', ') END mesesvenc
         FROM pagos
         WHERE statuspago = '2' AND codperiodo = '".$_GET['codperiodo']."'
         GROUP BY codest ) venc ON venc.codest = est.codest
         
		 INNER JOIN padres ON padres.cedpadre = est.cedpadre 
		 INNER JOIN pagos ON est.codest = pagos.codest
		 INNER JOIN turnos ON turnos.codturno = pagos.codturno
	     INNER JOIN secciones ON secciones.codseccion = pagos.codseccion 
	     INNER JOIN grados ON grados.codgrado = secciones.codgrado 
		 INNER JOIN niveles ON secciones.codnivel = niveles.codnivel		  
	     INNER JOIN periodoescolar ON periodoescolar.codperiodo = pagos.codperiodo 
	     LEFT JOIN pagospormora ON pagospormora.numcomprobante = pagos.numcomprobante
	     LEFT JOIN pagosextras ON pagosextras.codest = est.codest 
		 WHERE est.codest = ? AND pagos.codperiodo = ? AND est.becado != 'COMPLETA' GROUP BY id";
		 $stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_GET['codest']));
		$stmt->bindValue(2, trim($_GET['codperiodo']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON RESULTADOS PARA TU B&Uacute;SQUEDA REALIZADA</center>";
    echo "</div>";		
	exit;
		      } else {
			          if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			                {
				          $this->p[] = $row;
			                }
			              return $this->p;
			              $this->dbh=null;
		           }
	      }
############################## FUNCION MOSTRAR PAGOS DE ESTUDIANTES ###########################

######################## FUNCION REGISTRAR PAGOS DE ESTUDIANTES #######################
	    public function RegistrarPagos() {
		
		self::SetNames();
		if(empty($_POST["codest"]) or empty($_POST["codperiodo"]))
		{
			echo "1";
			exit;
		}

######################## FUNCION PARA GENERAL CODIGO DE RECIBO ###########################
$numrecibo = "C".GeraHash(18);
######################## FUNCION PARA GENERAL CODIGO DE RECIBO ###########################


		 ################ AQUI ACTUALIZAMOS LOS MESES A CANCELAR ###################3
            for($i=0;$i<count($_POST['mespago']);$i++){  //recorro el array
			    if (!empty($_POST['mespago'][$i])) {
			
			$sql = " update pagos set "
			  ." numcomprobante = ?, "
			  ." statuspago = ?, "
			  ." fechapago = ?, "
			  ." codigo = ? "
			  ." where "
			  ." codest = ? AND mespago = ? AND codperiodo = ?;
			   ";
		    $stmt = $this->dbh->prepare($sql);
		    $stmt->bindParam(1, $numcomprobante);
			$stmt->bindParam(2, $statuspago);
			$stmt->bindParam(3, $fechapago);
			$stmt->bindParam(4, $codigo);
		    $stmt->bindParam(5, $codest);
			$stmt->bindParam(6, $mespago);
			$stmt->bindParam(7, $codperiodo);
		
			$numcomprobante = strip_tags($numrecibo);
			$statuspago = strip_tags("1");
		    $fechapago = strip_tags(date("Y-m-d"));
		    $codigo = strip_tags($_SESSION['codigo']);
			$codest = strip_tags($_POST["codest"]);
			$mespago = strip_tags($_POST["mespago"][$i]);
			$codperiodo = strip_tags($_POST["codperiodo"]);
		    $stmt->execute();
		                                                }
		                                             }
		   if($_POST["cantmora"] != '0') {
		   $query = " insert into pagospormora values (null, ?, ?, ?, ?); ";
	       $stmt = $this->dbh->prepare($query);
		   $stmt->bindParam(1, $numcomprobante);
		   $stmt->bindParam(2, $codest);
		   $stmt->bindParam(3, $cantmora);
		   $stmt->bindParam(4, $codperiodo);
			
		   $numcomprobante = strip_tags($numrecibo);
		   $codest = strip_tags($_POST["codest"]);
		   $cantmora = ( $_POST['pagados'] >= $_POST['vencidos'] ? $_POST["cantmora"] : $_POST['pagados']);
		   $codperiodo = strip_tags($_POST["codperiodo"]);
		   $stmt->execute();
		                                  }
										  
######################## AGREGO EL DINERO A CAJA ############################
		$sql = " SELECT * FROM arqueocaja INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja WHERE cajas.codigo = ".$_SESSION["codigo"]." AND statusarqueo = '1'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$codcaja = $row['codcaja'];
		$ingreso = $row['ingresos'];

		$sql = " update arqueocaja set "
		." ingresos = ? "
		." where "
		." codcaja = ? and statusarqueo = '1';
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $txtTotal);
		$stmt->bindParam(2, $codcaja);

		$txtTotal = rount($_POST["total"]+$ingreso,2);
		$stmt->execute();
######################## AGREGO EL DINERO A CAJA ############################

	echo "<span class='fa fa-check-square-o'></span> EL PAGO HA SIDO REALIZADO EXITOSAMENTE <a href='reportepdf.php?codest=".base64_encode($codest)."&numcomprobante=".base64_encode($numcomprobante)."&tipo=".base64_encode("COMPROBANTEPAGOS")."' class='on-default' data-placement='left' data-toggle='tooltip' data-original-title='Imprimir Comprobante' target='_black'><strong>IMPRIMIR COMPROBANTE DE PAGO</strong></a>";
	exit;
	 }  
######################## FUNCION REGISTRAR PAGOS DE ESTUDIANTES #######################

####################### FUNCION LISTAR PAGOS DE ESTUDIANTES ###########################
	 public function ListarPagosxEstudiantes() 
	       {
		self::SetNames();
	$sql = " SELECT * FROM (estudiantes INNER JOIN pagos ON estudiantes.codest = pagos.codest) INNER JOIN padres ON padres.cedpadre = estudiantes.cedpadre INNER JOIN turnos ON turnos.codturno = pagos.codturno INNER JOIN secciones ON pagos.codseccion = secciones.codseccion INNER JOIN grados ON secciones.codgrado = grados.codgrado INNER JOIN niveles ON secciones.codnivel = niveles.codnivel INNER JOIN periodoescolar ON periodoescolar.codperiodo = pagos.codperiodo WHERE pagos.codest = ? and pagos.codperiodo = ? AND statuspago != '0' AND statuspago != '3'";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_GET['codest']));
		$stmt->bindValue(2, trim($_GET['codperiodo']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON RESULTADOS PARA TU B&Uacute;SQUEDA REALIZADA</center>";
    echo "</div>";		
	exit;
		       }
		else
		{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}	
####################### FUNCION LISTAR PAGOS DE ESTUDIANTES ###########################

######################## FUNCION ID PAGOS DE ESTUDIANTES ###########################
	public function PagosPorId()
	{
		self::SetNames();
		$sql = "SELECT * FROM (estudiantes INNER JOIN pagos ON estudiantes.codest = pagos.codest) LEFT JOIN pagosextras ON pagosextras.numcomprobante = pagos.numcomprobante INNER JOIN padres ON padres.cedpadre = estudiantes.cedpadre INNER JOIN turnos ON turnos.codturno = pagos.codturno INNER JOIN secciones ON pagos.codseccion = secciones.codseccion INNER JOIN grados ON secciones.codgrado = grados.codgrado INNER JOIN niveles ON secciones.codnivel = niveles.codnivel INNER JOIN periodoescolar ON periodoescolar.codperiodo = pagos.codperiodo LEFT JOIN pagospormora ON pagospormora.numcomprobante = pagos.numcomprobante WHERE pagos.codpago = ?";	
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(base64_decode($_GET["codpago"])) );
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
######################## FUNCION ID PAGOS DE ESTUDIANTES ###########################

######################## FUNCION ACTUALIZAR PAGOS DE ESTUDIANTES ###########################
	public function ActualizarPagos()
	{
		
		self::SetNames();
		if(empty($_POST["codpago"]) or empty($_POST["codest"]) or empty($_POST["montopago"]))
		{
			echo "1";
			exit;
		}
		
		################ AQUI ACTUALIZAMOS LOS DATOS DEL PAGO ###################3
             $sql = " update pagos set "
			  ." montopago = ? "
			  ." where "
			  ." codpago = ?;
			   ";
		    $stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $montopago);
		    $stmt->bindParam(2, $codpago);
			
			$codpago = strip_tags($_POST["codpago"]);
			$montopago = strip_tags($_POST["montopago"]);
			$stmt->execute();	
		
    echo "<span class='fa fa-check-square-o'></span> EL PAGO DEL ESTUDIANTE HA SIDO ACTUALIZADO EXITOSAMENTE";
	exit;
  }
######################## FUNCION ACTUALIZAR PAGOS DE ESTUDIANTES ###########################

######################## FUNCION ELIMINAR PAGOS DE ESTUDIANTES ##########################
	public function EliminarPagos()
	{

		if($_SESSION['acceso'] == "administrador") {

		$sql = " delete from pagos where codpago = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codpago);
		$codpago = base64_decode($_GET["codpago"]);
		$stmt->execute();
				
		header("Location: pagos?mesage=1");
		exit;
		   
		 } else {
		   
			header("Location: pagos?mesage=2");
			exit;
		  }
	} 
######################## FUNCION ELIMINAR PAGOS DE ESTUDIANTES ##########################

######################## FUNCION BUSQUEDA DE COMPROBANTES DE PAGOS ##########################
	    public function BuscarComprobantesReportes() 
	       {
		self::SetNames();
		$sql ="SELECT estudiantes.codest, estudiantes.cedest, estudiantes.pnomest, estudiantes.snomest, estudiantes.papeest, estudiantes.sapeest, estudiantes.fechainscripcion, pagos.codperiodo, pagos.mespago, pagos.montopago, pagos.fechapago, pagos.numcomprobante, COUNT(pagos.mespago) as cantidad, SUM(pagos.montopago) as sumpago, pagosextras.cuotaunica, pagosextras.descuento, pagosextras.montomesextra, pagospormora.cantmora, periodoescolar.periodo, periodoescolar.interesmora FROM (pagos LEFT JOIN estudiantes ON pagos.codest=estudiantes.codest) LEFT JOIN pagosextras ON pagosextras.numcomprobante = pagos.numcomprobante LEFT JOIN periodoescolar ON periodoescolar.codperiodo=pagos.codperiodo LEFT JOIN pagospormora ON pagospormora.numcomprobante = pagos.numcomprobante WHERE estudiantes.codest = ? and pagos.codperiodo = ? AND pagos.statuspago = '1' GROUP BY pagos.numcomprobante";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_GET['codest']));
		$stmt->bindValue(2, trim($_GET['codperiodo']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON RESULTADOS PARA TU B&Uacute;SQUEDA REALIZADA</center>";
    echo "</div>";		
	exit;
		       }
		else
		{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
######################## FUNCION BUSQUEDA DE COMPROBANTES DE PAGOS ##########################

######################### FUNCION PARA BUSCAR COMPROBANTE POR Nº ############################
public function BuscarComprobantePagos()
	{
		self::SetNames();
		$sql ="SELECT estudiantes.cedest, estudiantes.pnomest, estudiantes.snomest, estudiantes.papeest, estudiantes.sapeest, estudiantes.fechainscripcion, pagos.numcomprobante, pagos.becado, pagos.montopago, pagos.codseccion, pagos.codturno, pagos.codperiodo, pagos.mespago, pagos.fechapago, pagos.codigo, pagospormora.cantmora, pagosextras.cuotaunica, pagosextras.descuento, pagosextras.montomesextra, usuarios.codigo, usuarios.usuario, niveles.nivel, grados.grado, secciones.seccion, turnos.turno, padres.cedpadre, padres.nompadre, padres.apepadre, padres.tlfpadre, periodoescolar.periodo, periodoescolar.mesesactivos, periodoescolar.interesmora FROM (estudiantes LEFT JOIN pagos ON estudiantes.codest = pagos.codest) LEFT JOIN pagosextras ON pagosextras.numcomprobante = pagos.numcomprobante LEFT JOIN usuarios ON usuarios.codigo = pagos.codigo LEFT JOIN padres ON padres.cedpadre = estudiantes.cedpadre LEFT JOIN turnos ON turnos.codturno = pagos.codturno LEFT JOIN secciones ON pagos.codseccion = secciones.codseccion LEFT JOIN grados ON secciones.codgrado = grados.codgrado LEFT JOIN niveles ON secciones.codnivel = niveles.codnivel LEFT JOIN periodoescolar ON periodoescolar.codperiodo = pagos.codperiodo LEFT JOIN pagospormora ON pagospormora.numcomprobante = pagos.numcomprobante WHERE estudiantes.codest = ? AND pagos.numcomprobante = ? AND statuspago = '1'";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim(base64_decode($_GET["codest"])));
		$stmt->bindValue(2, trim(base64_decode($_GET["numcomprobante"])));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
    echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON RESULTADOS PARA TU B&Uacute;SQUEDA REALIZADA</center>";
    echo "</div>";		
	exit;
		      } else {
			            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			            {
				        $this->p[]=$row;
			            }
			            return $this->p;
			            $this->dbh=null;
		           }
	      }
######################### FUNCION PARA BUSCAR COMPROBANTE POR Nº ############################

########################## FUNCION PARA BUSQUEDA DE PAGOS GENERALES ###########################
	    public function BuscarPagosGeneralReportes() 
	       {
		self::SetNames();
		$sql ="SELECT estudiantes.codest, estudiantes.cedest, estudiantes.pnomest, estudiantes.snomest, estudiantes.papeest, estudiantes.sapeest, estudiantes.fnacest, estudiantes.fechainscripcion, pagos.codperiodo, pagos.mespago, pagos.montopago, pagosextras.cuotaunica, pagosextras.descuento, pagosextras.montomesextra, pagos.fechapago, GROUP_CONCAT(DISTINCT pagos.mespago SEPARATOR ', ') AS meses, COUNT(pagos.mespago) as cantidad, SUM(pagos.montopago) as sumpago, pagos.becado, pagospormora.cantmora, periodoescolar.periodo, periodoescolar.interesmora, niveles.nivel, grados.grado, secciones.seccion, turnos.turno FROM (pagos LEFT JOIN estudiantes ON pagos.codest=estudiantes.codest) LEFT JOIN pagosextras ON pagosextras.numcomprobante = pagos.numcomprobante LEFT JOIN turnos ON turnos.codturno=pagos.codturno LEFT JOIN secciones ON pagos.codseccion = secciones.codseccion LEFT JOIN grados ON secciones.codgrado = grados.codgrado LEFT JOIN niveles ON secciones.codnivel = niveles.codnivel LEFT JOIN periodoescolar ON periodoescolar.codperiodo = pagos.codperiodo LEFT JOIN pagospormora ON pagospormora.numcomprobante = pagos.numcomprobante WHERE pagos.fechapago >= ? AND pagos.fechapago <= ? AND pagos.codperiodo = ? AND pagos.statuspago = '1' GROUP BY pagos.codest";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim(date("Y-m-d",strtotime($_GET['desde']))));
		$stmt->bindValue(2, trim(date("Y-m-d",strtotime($_GET['hasta']))));
		$stmt->bindValue(3, trim($_GET['codperiodo']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON RESULTADOS PARA TU B&Uacute;SQUEDA REALIZADA</center>";
    echo "</div>";		
	exit;
		       }
		else
		{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
########################## FUNCION PARA BUSQUEDA DE PAGOS GENERALES ###########################


########################## FUNCION SUMA GASTOS POR FECHAS Y PERIODO ###########################
	   public function SumaGastosFechas()
	{
		self::SetNames();
		$sql = " SELECT SUM(montomovimientocaja) as egresos FROM movimientoscajas WHERE tipomovimientocaja = 'EGRESO' AND fechamovimientocaja >= ? AND fechamovimientocaja <= ? AND codperiodo = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute( array(date("Y-m-d",strtotime($_GET['desde'])),date("Y-m-d",strtotime($_GET['hasta'])),$_GET['codperiodo']) );
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
########################## FUNCION SUMA GASTOS POR FECHAS Y PERIODO ###########################

######################### FUNCION PARA BUSQUEDA DE PAGOS AL DIA ##########################
	    public function BuscarPagosAlDiaReportes() 
	       {
		self::SetNames();
		$sql ="SELECT est.codest AS id, GROUP_CONCAT(DISTINCT est.cedest) AS cedula, GROUP_CONCAT(DISTINCT est.pnomest) AS pNombre, GROUP_CONCAT(DISTINCT est.snomest) AS sNombre, GROUP_CONCAT(DISTINCT est.papeest) AS pApellido, GROUP_CONCAT(DISTINCT est.sapeest) AS sApellido, est.fnacest, est.fechainscripcion, GROUP_CONCAT(DISTINCT pagos.mespago SEPARATOR ', ') AS meses, pagos.becado, pagos.montopago, pagosextras.cuotaunica, pagosextras.descuento, pagosextras.montomesextra, pagos.fechapago, pagos.numcomprobante, pagospormora.cantmora, niveles.nivel, grados.grado, secciones.seccion, turnos.turno, periodoescolar.periodo, periodoescolar.interesmora FROM estudiantes est INNER JOIN pagos ON est.codest = pagos.codest LEFT JOIN pagosextras ON pagosextras.numcomprobante = pagos.numcomprobante INNER JOIN turnos ON turnos.codturno = pagos.codturno INNER JOIN secciones ON pagos.codseccion = secciones.codseccion INNER JOIN grados ON secciones.codgrado = grados.codgrado INNER JOIN niveles ON secciones.codnivel = niveles.codnivel INNER JOIN periodoescolar ON periodoescolar.codperiodo = pagos.codperiodo LEFT JOIN pagospormora ON pagospormora.numcomprobante = pagos.numcomprobante WHERE pagos.codseccion = ? AND pagos.codturno = ? AND pagos.codperiodo = ? AND pagos.statuspago = '1' GROUP BY id";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_GET['codseccion']));
		$stmt->bindValue(2, trim($_GET['codturno']));
		$stmt->bindValue(3, trim($_GET['codperiodo']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
    echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON RESULTADOS PARA TU B&Uacute;SQUEDA REALIZADA</center>";
    echo "</div>";		
	exit;
		       }
		else
		{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
######################### FUNCION PARA BUSQUEDA DE PAGOS AL DIA ##########################

######################### FUNCION PARA BUSQUEDA DE PAGOS VENCIDOS ############################
	    public function BuscarPagosVencidosReportes() 
	       {
		self::SetNames();
		$sql ="SELECT est.codest AS id, GROUP_CONCAT(DISTINCT est.cedest) AS cedula, GROUP_CONCAT(DISTINCT est.pnomest) AS pNombre, GROUP_CONCAT(DISTINCT est.snomest) AS sNombre, GROUP_CONCAT(DISTINCT est.papeest) AS pApellido, GROUP_CONCAT(DISTINCT est.sapeest) AS sApellido, est.fnacest, est.fechainscripcion, GROUP_CONCAT(DISTINCT pagos.mespago SEPARATOR ', ') AS meses, pagos.becado, pagos.montopago, pagosextras.cuotaunica, pagosextras.descuento, pagosextras.montomesextra, pagos.descuento, pagos.fechapago, pagos.numcomprobante, pagospormora.cantmora, niveles.nivel, grados.grado, secciones.seccion, turnos.turno, periodoescolar.periodo, periodoescolar.interesmora FROM estudiantes est INNER JOIN pagos ON est.codest = pagos.codest LEFT JOIN pagosextras ON pagosextras.numcomprobante = pagos.numcomprobante INNER JOIN turnos ON turnos.codturno = pagos.codturno INNER JOIN secciones ON pagos.codseccion = secciones.codseccion INNER JOIN grados ON secciones.codgrado = grados.codgrado INNER JOIN niveles ON secciones.codnivel = niveles.codnivel INNER JOIN periodoescolar ON periodoescolar.codperiodo = pagos.codperiodo LEFT JOIN pagospormora ON pagospormora.numcomprobante = pagos.numcomprobante WHERE pagos.codseccion = ? AND pagos.codturno = ? AND pagos.codperiodo = ? AND statuspago = '2' GROUP BY id";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_GET['codseccion']));
		$stmt->bindValue(2, trim($_GET['codturno']));
		$stmt->bindValue(3, trim($_GET['codperiodo']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON RESULTADOS PARA TU B&Uacute;SQUEDA REALIZADA</center>";
    echo "</div>";		
	exit;
		
	  } else {
	  
		while($row = $stmt->fetch())
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
######################### FUNCION PARA BUSQUEDA DE PAGOS VENCIDOS ############################

########################################## FIN DE CLASE PAGOS ###########################################











































######################################## CLASE NOTAS DE ESTUDIANTES ####################################

############################### FUNCION VERIFICA PERIODO ESCOLAR ###############################
	public function VerificaPeriodo()
	{
		self::SetNames();
		$sql = "select * from configuracion";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		
		$fecha=strftime("%Y-%m-%d"); //fecha tipo 2011/06/14
		$inicio = $row['inicionotas'];
		$fin = $row['finnotas'];
	
		if($fecha >= $inicio && $fecha <= $fin) {

		$sql = "SELECT * FROM periodoescolar WHERE statusperiodo = 1 ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{

	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO EXISTE UN PERIODO ESCOLAR ACTIVO PARA PROCESAR NOTAS, <br> DIRIJASE AL ADMINISTRADOR DEL SISTEMA PARA QUE LO AGREGUE POR FAVOR</center>";
    echo "</div>";
	//exit;
		}
		else
		{
			?>

        <div class="modal-footer"> 
<button type="button" onClick="BuscarEstudiantesNotas(document.getElementById('codturno').value,document.getElementById('codnivel').value,document.getElementById('codgrado').value,document.getElementById('codseccion').value,document.getElementById('codmateria').value)" class="btn btn-primary"><span class="fa fa-search"></span> Realizar B&uacute;squeda</button>
                          </div>
	<?php
		}
		   } else {

	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> EN ESTE MOMENTO EL PROCESO DE REGISTRO DE NOTAS, SE ENCUENTRA CERRADO O DESACTIVADO, <br> DIRIJASE AL ADMINISTRADOR DEL SISTEMA PARA QUE LO REINICIE O ACTIVE</center>";
    echo "</div>";
	//exit;

		}
	}
############################### FUNCION VERIFICA PERIODO ESCOLAR ###############################




/*if ($_SESSION['acceso'] == "docente") {

		$sql = " SELECT * FROM asignaciones INNER JOIN periodoescolar ON asignaciones.codperiodo = periodoescolar.codperiodo
		WHERE asignaciones.coddoc = ? AND asignaciones.codturno = ? AND asignaciones.codseccion = ? AND periodoescolar.statusperiodo = 1";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_SESSION['coddoc']));
		$stmt->bindValue(2, trim($_GET['codturno']));
		$stmt->bindValue(3, trim($_GET['codseccion']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> ESTA SECCI&Oacute;N NO SE ENCUENTRA ASIGNADA A ESTE DOCENTE, VERIFIQUE NUEVAMENTE POR FAVOR</center>";
    echo "</div>";		
	exit;
		} 
} */


######################### FUNCION BUSQUEDA ESTUDIANTES PARA NOTAS #############################
	    public function ProcesarNotasEstudiantes() 
	       {
		self::SetNames();

       $cont = "SELECT * FROM configuracion";
		foreach ($this->dbh->query($cont) as $rowt)
		{
			$this->pt[] = $rowt;
		}
		$trimestre = $rowt['trimestreactivo'];

		$perid = "SELECT codperiodo, periodo FROM periodoescolar WHERE statusperiodo = '1'";
		foreach ($this->dbh->query($perid) as $rowcon)
		{
			$this->pcon[] = $rowcon;
		}
		$codperiodo = $rowcon['codperiodo'];
		$periodo = $rowcon['periodo'];

		$mat = "SELECT * FROM materias WHERE codmateria = '".$_GET['codmateria']."'";
		foreach ($this->dbh->query($mat) as $rowmat)
		{
			$this->pmat[] = $rowmat;
		}
		$materia = $rowmat['nommateria'];

if ($_SESSION['acceso'] == "docente") {

		$sql = " SELECT * FROM asignaciones INNER JOIN periodoescolar ON asignaciones.codperiodo = periodoescolar.codperiodo
		WHERE asignaciones.coddoc = ? AND asignaciones.codturno = ? AND asignaciones.codseccion = ? AND asignaciones.codmateria = ? AND periodoescolar.statusperiodo = 1";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_SESSION['coddoc']));
		$stmt->bindValue(2, trim($_GET['codturno']));
		$stmt->bindValue(3, trim($_GET['codseccion']));
		$stmt->bindValue(4, trim($_GET['codmateria']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> ESTA MATERIA NO SE ENCUENTRA ASIGNADA A ESTE DOCENTE, POR LO TANTO LAS NOTAS NO PUEDEN CARGARSE, <br> VERIFIQUE NUEVAMENTE O CONTACTE CON EL DOCENTE RESPONSABLE DE LA CARGA DE NOTAS</center>";
    echo "</div>";		
	exit;
    }
}

		$sql = " SELECT * FROM asignaciones WHERE codturno = ? AND codseccion = ? AND codmateria = ? AND codperiodo = '".$codperiodo."'";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_GET['codturno']));
		$stmt->bindValue(2, trim($_GET['codseccion']));
		$stmt->bindValue(3, trim($_GET['codmateria']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> ESTA MATERIA NO SE ENCUENTRA ASIGNADA A UN DOCENTE, POR LO TANTO LAS NOTAS NO PUEDEN CARGARSE, <br> VERIFIQUE NUEVAMENTE O CONTACTE CON EL DOCENTE RESPONSABLE DE LA CARGA DE NOTAS</center>";
    echo "</div>";		
	exit;
		       


		       } else {

		$sql = " SELECT * FROM estudiantes INNER JOIN turnos ON estudiantes.codturno = turnos.codturno INNER JOIN secciones ON secciones.codseccion = estudiantes.codseccion INNER JOIN grados ON secciones.codgrado = grados.codgrado INNER JOIN niveles ON secciones.codnivel = niveles.codnivel INNER JOIN periodoescolar ON periodoescolar.codperiodo = estudiantes.codperiodo WHERE estudiantes.codseccion = ? and estudiantes.codturno = ? and estudiantes.statusest = '1' ORDER BY estudiantes.papeest";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_GET['codseccion']));
		$stmt->bindValue(2, trim($_GET['codturno']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON RESULTADOS PARA TU B&Uacute;SQUEDA REALIZADA</center>";
    echo "</div>";		
	exit;
		       } else {

$sql ="SELECT estudiantes.codest, estudiantes.cedest, estudiantes.pnomest, estudiantes.snomest, estudiantes.papeest, estudiantes.sapeest, estudiantes.codseccion, estudiantes.codturno, estudiantes.codperiodo, estudiantes.fechainscripcion, periodoescolar.periodo, notas.nota1, notas.nota2, notas.nota3, notas.definitiva, notas.literal, niveles.nivel, grados.grado, secciones.seccion FROM (estudiantes INNER JOIN turnos ON estudiantes.codturno = turnos.codturno) INNER JOIN secciones ON secciones.codseccion = estudiantes.codseccion INNER JOIN grados ON secciones.codgrado = grados.codgrado INNER JOIN niveles ON secciones.codnivel = niveles.codnivel INNER JOIN periodoescolar ON periodoescolar.codperiodo = estudiantes.codperiodo LEFT JOIN notas ON notas.codest = estudiantes.codest WHERE estudiantes.codseccion = ? AND estudiantes.codturno = ? AND notas.codmateria = ? AND estudiantes.statusest = '1' AND notas.codperiodo = '".$codperiodo."'";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_GET['codseccion']));
		$stmt->bindValue(2, trim($_GET['codturno']));
		$stmt->bindValue(3, trim($_GET['codmateria']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{ 

$est = " SELECT * FROM estudiantes INNER JOIN turnos ON estudiantes.codturno = turnos.codturno INNER JOIN secciones ON secciones.codseccion = estudiantes.codseccion INNER JOIN grados ON secciones.codgrado = grados.codgrado INNER JOIN niveles ON secciones.codnivel = niveles.codnivel INNER JOIN periodoescolar ON periodoescolar.codperiodo = estudiantes.codperiodo WHERE estudiantes.codseccion = '".$_GET['codseccion']."' AND estudiantes.codturno = '".$_GET['codturno']."' AND estudiantes.statusest = '1' ORDER BY estudiantes.papeest";
$stmt = $this->dbh->prepare($est);
foreach ($this->dbh->query($est) as $row)
		{
			$this->p[] = $row;
		}

$nivel = $row['nivel'];
$grado = $row['grado'];
$seccion = $row['seccion'];

if ($trimestre == 0) {

	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO EXISTE UN TRIMESTRE ACTIVO PARA PROCESAR NUEVAS NOTAS, DIRIJASE AL ADMINISTRADOR PARA QUE ACTIVE EL BIMESTRE</center>";
    echo "</div>";
}

if($nivel=="INICIAL"){

		?>

<input name="codperiodo" type="hidden" id="codperiodo" value="<?php echo $codperiodo; ?>"/>
<input name="nivel" type="hidden" id="nivel" value="<?php echo $nivel; ?>"/>
<input type="hidden" name="registrar" value="ok"/>

<div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-edit"></i> Gesti&oacute;n de Notas en <?php echo $nivel; ?> - <?php echo $grado; ?> Secci&oacute;n <?php echo $seccion; ?> del Periodo <?php echo $periodo; ?></h3>
</div>

<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">

<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
                        <tr role="row">
                        <th colspan="5"><?php echo "<h5><center>".$materia."</center></h5>"; ?></th>
                        </tr>
                         <tr role="row">
                          <th>N&deg;</th>
                          <th>Apellidos y Nombres del Estudiante</th>
                        <?php if ($trimestre == 0) { ?>
                          <th>1er Trimestre</th>
                          <th>2do Trimestre</th>
                          <th>3er Trimestre</th>
                        <?php } else { ?>
                          <th>1er Trimestre</th>
                        <?php } ?>  
                         </tr>
                         </thead>
                         <tbody>
<?php 
$a=1;
foreach ($this->dbh->query($est) as $nota){
?>

                                               <tr role="row" class="odd">
<td><input name="codest[]" type="hidden" id="codest" value="<?php echo $nota['codest']; ?>"/>
<?php echo $a++; ?></td>

<td><abbr title="<?php echo "N&deg; de C&oacute;digo: ".$nota['cedest']; ?>"><?php echo $nota['papeest']." ".$nota['sapeest']." ".$nota['pnomest']." ".$nota['snomest']; ?></abbr></td>

     
     <?php if ($trimestre == 0) { ?>

<!-- PROCESO NOTA 1 -->
<td align="center"><?php echo "<h5>0</h5>"; ?></td>

<!-- PROCESO NOTA 2 -->
<td align="center"><?php echo "<h5>0</h5>"; ?></td>

<!-- PROCESO NOTA 3 -->
<td align="center"><?php echo "<h5>0</h5>"; ?></td>

         <?php } else { ?>


<td align="center"><textarea class="form-control" style="width: 520px;height: 50px;" name="nota1[]" id="nota" onfocus="this.style.background=('#B7F0FF')" onBlur="this.style.background=('#FFF')" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Valoraci&oacute;n del 1er Trimestre"></textarea></td>

                         </tr>
                         <?php } } ?>
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

<input name="codperiodo" type="hidden" id="codperiodo" value="<?php echo $codperiodo; ?>"/>
<input name="nivel" type="hidden" id="nivel" value="<?php echo $nivel; ?>"/>
<input type="hidden" name="registrar" value="ok"/>

<div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-edit"></i> Gesti&oacute;n de Notas en <?php echo $nivel; ?> - <?php echo $grado; ?> Secci&oacute;n <?php echo $seccion; ?> del Periodo <?php echo $periodo; ?></h3>
</div>

<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">

<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
                         <tr role="row">
                           <th rowspan="2">N&deg;</th>
                           <th rowspan="2">Apellidos y Nombres del Estudiante</th>
            <th colspan="4"><center><?php echo "<h5><center>".$materia."</center></h5>"; ?></center></th>
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
foreach ($this->dbh->query($est) as $nota){
?>

                                               <tr role="row" class="odd">
<td><input name="codest[]" type="hidden" id="codest" value="<?php echo $nota['codest']; ?>"/>
<?php echo $a++; ?></td>

<td><abbr title="<?php echo "N&deg; de C&oacute;digo: ".$nota['cedest']; ?>"><?php echo $nota['papeest']." ".$nota['sapeest']." ".$nota['pnomest']." ".$nota['snomest']; ?></abbr></td>

<?php if ($trimestre == 0) { ?>

<!-- PROCESO NOTA 1 -->
<td align="center"><?php echo "<h5>0</h5>"; ?></td>

<!-- PROCESO NOTA 2 -->
<td align="center"><?php echo "<h5>0</h5>"; ?></td>

<!-- PROCESO NOTA 3 -->
<td align="center"><?php echo "<h5>0</h5>"; ?></td>

<!-- DEFINITIVA -->
<td align="center"><?php echo "<h5>0</h5>"; ?></td>

         <?php } else { ?>

         	<td align="center"><label class="label"><input class="form-control number" style="width: 70px;" name="nota1[]" id="nota" onfocus="this.style.background=('#B7F0FF')" onBlur="this.style.background=('#FFF')" type="text" size="3" maxlength="3" autocomplete="off" placeholder="N&deg;1"/></label></td>

<!-- PROCESO NOTA 2 -->
<td align="center"><?php echo "<h5>0</h5>"; ?></td>

<!-- PROCESO NOTA 3 -->
<td align="center"><?php echo "<h5>0</h5>"; ?></td>

<!-- DEFINITIVA -->
<td align="center"><?php echo "<h5>0</h5>"; ?></td>
                         </tr>
                         <?php } } ?>
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

	 }  exit;

	 } else {

		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		    }
	    }
	}
}
######################### FUNCION BUSQUEDA ESTUDIANTES PARA NOTAS #############################

############################# FUNCION PARA REGISTRAR NOTAS ###############################
	public function RegistrarNotas()
	{
		self::SetNames();
		if(empty($_POST["codturno"]) or empty($_POST["codnivel"]) or empty($_POST["codgrado"]) or empty($_POST["codseccion"]) or empty($_POST["codmateria"]))
		{
			echo "1";
			exit;
		}

		$sql = "SELECT coddoc FROM asignaciones WHERE codturno = '".$_POST['codturno']."' AND codseccion = '".$_POST['codseccion']."' AND codmateria = '".$_POST['codmateria']."' AND codperiodo = '".$_POST['codperiodo']."'";
		foreach ($this->dbh->query($sql) as $rowcon)
		{
			$this->pcon[] = $rowcon;
		}
		$coddoc = $rowcon['coddoc'];
		
		###################### AQUI VALIDO SI EXISTEN NOTAS EN BLANCO #######################
		for($i=0;$i<count($_POST['nota1']);$i++){  //recorro el array
        
        if (empty($_POST['nota1'][$i]) || trim($_POST['nota1'][$i])==""){
		echo "2";
		exit;
	                                    }
		                                        }
			
		########################### PROCESO PARA REGISTRO DE CARGA ##############################
		for($i=0;$i<count($_POST['codest']);$i++){  //recorro el array
        if (!empty($_POST['codest'][$i])) {
		    
		  $query = " insert into notas values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
		  $stmt = $this->dbh->prepare($query);
		  $stmt->bindParam(1, $codest);
		  $stmt->bindParam(2, $coddoc);
		  $stmt->bindParam(3, $codnivel);
		  $stmt->bindParam(4, $codgrado);
		  $stmt->bindParam(5, $codseccion);
		  $stmt->bindParam(6, $codturno);
		  $stmt->bindParam(7, $codperiodo);
		  $stmt->bindParam(8, $codmateria);
		  $stmt->bindParam(9, $nota1);
		  $stmt->bindParam(10, $nota2);
		  $stmt->bindParam(11, $nota3);
		  $stmt->bindParam(12, $definitiva);
		  $stmt->bindParam(13, $literal);
		
		  $codest = strip_tags($_POST["codest"][$i]);
		  $codnivel = strip_tags($_POST['codnivel']);
		  $codgrado = strip_tags($_POST['codgrado']);
		  $codseccion = strip_tags($_POST['codseccion']);
		  $codturno = strip_tags($_POST['codturno']);
		  $codperiodo = strip_tags($_POST['codperiodo']);
		  $codmateria = strip_tags($_POST['codmateria']);
		  $nota1 = strip_tags($_POST['nota1'][$i]);
		  $nota2 = strip_tags("0");
		  $nota3 = strip_tags("0");
		  $definitiva = ( $_POST['nivel'] == 'INICIAL' ? "0" : $_POST['nota1'][$i]);
		  $literal = strip_tags("0");
		  $stmt->execute();
		                                                }
	                                             }

	echo "<span class='fa fa-check-square-o'></span> LA CARGA DE NOTAS HA SIDO PROCESADA EXITOSAMENTE";
    exit;
	}
############################# FUNCION PARA REGISTRAR NOTAS ###############################

############################# FUNCION PARA ACTUALIZAR NOTAS ###############################
	public function ActualizarNotas()
	{
		self::SetNames();
		if(empty($_POST["codturno"]) or empty($_POST["codnivel"]) or empty($_POST["codgrado"]) or empty($_POST["codseccion"]) or empty($_POST["codmateria"]) or empty($_POST["trimestre"]))
		{
			echo "1";
			exit;
		}
									 
		if ($_POST['trimestre'] == 1) {

		###################### AQUI VALIDO SI EXISTEN NOTAS EN BLANCO #######################
		for($i=0;$i<count($_POST['nota1']);$i++){  //recorro el array
        
        if (empty($_POST['nota1'][$i]) || trim($_POST['nota1'][$i])==""){
		echo "2";
		exit;
	                                    }
		                                        }


		########################### PROCESO NOTA Nº1 ##############################
		for($i=0;$i<count($_POST['codest']);$i++){  //recorro el array
        if (!empty($_POST['codest'][$i])) {
		    
		  $sql = " update notas set "
			  ." nota1 = ?, "
			  ." definitiva = ? "
			  ." where "
			  ." codest = ? AND codperiodo = ? AND codmateria = ?;
			   ";
		  $stmt = $this->dbh->prepare($sql);
		  $stmt->bindParam(1, $nota1);
		  $stmt->bindParam(2, $definitiva);
		  $stmt->bindParam(3, $codest);
		  $stmt->bindParam(4, $codperiodo);
		  $stmt->bindParam(5, $codmateria);
		
		  $codest = strip_tags($_POST["codest"][$i]);
		  $codperiodo = strip_tags($_POST['codperiodo']);
		  $codmateria = strip_tags($_POST['codmateria']);
		  $nota1 = strip_tags($_POST['nota1'][$i]);
		  $definitiva = ( $_POST['nivel'] == 'INICIAL' ? "0" : $_POST['nota1'][$i]);
		  $stmt->execute();
		                                          }
	                                       }

		} elseif ($_POST['trimestre'] == 2) {

		###################### AQUI VALIDO SI EXISTEN NOTAS EN BLANCO #######################
		for($i=0;$i<count($_POST['nota2']);$i++){  //recorro el array
        
        if (empty($_POST['nota2'][$i]) || trim($_POST['nota2'][$i])==""){
		echo "2";
		exit;
	                                    }
		                                        }


########################### PROCESO NOTA Nº2 ##############################
		for($i=0;$i<count($_POST['codest']);$i++){  //recorro el array
        if (!empty($_POST['codest'][$i])) {
		    
	$sql = "select nota1, nota2, nota3 from notas where codest = '".$_POST["codest"][$i]."' and codperiodo = '".$_POST["codperiodo"]."' and codmateria = '".$_POST["codmateria"]."'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}

		 $sql = " update notas set "
			  ." nota2 = ?, "
			  ." definitiva = ? "
			  ." where "
			  ." codest = ? AND codperiodo = ? AND codmateria = ?;
			   ";
		  $stmt = $this->dbh->prepare($sql);
		  $stmt->bindParam(1, $nota2);
		  $stmt->bindParam(2, $definitiva);
		  $stmt->bindParam(3, $codest);
		  $stmt->bindParam(4, $codperiodo);
		  $stmt->bindParam(5, $codmateria);
		
		  $codest = strip_tags($_POST["codest"][$i]);
		  $codperiodo = strip_tags($_POST['codperiodo']);
		  $codmateria = strip_tags($_POST['codmateria']);
		  $nota2 = strip_tags($_POST['nota2'][$i]);
		  $suma = ( $_POST["nivel"]== "INICIAL" ? strip_tags("0") : $row['nota1'] + $_POST['nota2'][$i]);
		  $definitiva = ( $_POST["nivel"]== "INICIAL" ? strip_tags("0") : rount($suma/2,2));
		  $stmt->execute();

		                                                }
	                                             }
		} elseif ($_POST['bimestre'] == 3) {

		###################### AQUI VALIDO SI EXISTEN NOTAS EN BLANCO #######################
		for($i=0;$i<count($_POST['nota3']);$i++){  //recorro el array
        
        if (empty($_POST['nota3'][$i]) || trim($_POST['nota3'][$i])==""){
		echo "2";
		exit;
	                                    }
		                                        }

		########################### PROCESO NOTA Nº3 ##############################
		for($i=0;$i<count($_POST['codest']);$i++){  //recorro el array
        if (!empty($_POST['codest'][$i])) {
		    
	$sql = "select nota1, nota2, nota3 from notas where codest = '".$_POST["codest"][$i]."' and codperiodo = '".$_POST["codperiodo"]."' and codmateria = '".$_POST["codmateria"]."'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}

		 $sql = " update notas set "
			  ." nota3 = ?, "
			  ." definitiva = ? "
			  ." where "
			  ." codest = ? AND codperiodo = ? AND codmateria = ?;
			   ";
		  $stmt = $this->dbh->prepare($sql);
		  $stmt->bindParam(1, $nota3);
		  $stmt->bindParam(2, $definitiva);
		  $stmt->bindParam(3, $codest);
		  $stmt->bindParam(4, $codperiodo);
		  $stmt->bindParam(5, $codmateria);
		
		  $codest = strip_tags($_POST["codest"][$i]);
		  $codperiodo = strip_tags($_POST['codperiodo']);
		  $codmateria = strip_tags($_POST['codmateria']);
		  $nota3 = strip_tags($_POST['nota3'][$i]);
	$suma = ( $_POST["nivel"]== "INICIAL" ? strip_tags("0") : $row['nota1'] + $row['nota2'] + $_POST['nota3'][$i]);
		  $definitiva = ( $_POST["nivel"]== "INICIAL" ? strip_tags("0") : rount($suma/3,2));
		  $stmt->execute();
		                                                }
	                                             }

		}//FIN DE IF
	
	echo "<span class='fa fa-check-square-o'></span> LA CARGA DE NOTAS HA SIDO PROCESADA EXITOSAMENTE";
    exit;
	}
############################# FUNCION PARA ACTUALIZAR NOTAS ###############################

######################### FUNCION BUSQUEDA NOTAS DE ESTUDIANTES #############################
	    public function BuscarNotasEstudiantes() 
	       {
		self::SetNames();
$sql = " SELECT * FROM estudiantes INNER JOIN turnos ON estudiantes.codturno = turnos.codturno INNER JOIN secciones ON secciones.codseccion = estudiantes.codseccion INNER JOIN grados ON secciones.codgrado = grados.codgrado INNER JOIN niveles ON secciones.codnivel = niveles.codnivel INNER JOIN periodoescolar ON periodoescolar.codperiodo = estudiantes.codperiodo WHERE estudiantes.codest = ? AND estudiantes.statusest = '1'";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_GET['codest']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> EL ESTUDIANTE NO SE ENCUENTRA INSCRITO EN EL PERIODO ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR</center>";
    echo "</div>";		
	exit;
		       } else {

$perid = "select codperiodo, periodo from periodoescolar where statusperiodo = '1'";
		foreach ($this->dbh->query($perid) as $rowcon)
		{
			$this->pcon[] = $rowcon;
		}
		$codperiodo = $rowcon['codperiodo'];
		$periodo = $rowcon['periodo'];

$sql ="SELECT estudiantes.codest, estudiantes.cedest, estudiantes.pnomest, estudiantes.snomest, estudiantes.papeest, estudiantes.sapeest, estudiantes.becado, estudiantes.codseccion, estudiantes.codturno, estudiantes.codperiodo, estudiantes.fnacest, estudiantes.fechainscripcion, padres.cedpadre, padres.nompadre, padres.apepadre, padres.tlfpadre, periodoescolar.periodo, notas.nota1, notas.nota2, notas.nota3, notas.definitiva, notas.literal, notas.codmateria, areas.nomarea, materias.nommateria, niveles.nivel, grados.grado, secciones.seccion, turnos.turno FROM (estudiantes INNER JOIN notas ON estudiantes.codest = notas.codest) INNER JOIN padres ON padres.cedpadre = estudiantes.cedpadre INNER JOIN turnos ON estudiantes.codturno = turnos.codturno INNER JOIN secciones ON secciones.codseccion = estudiantes.codseccion INNER JOIN grados ON secciones.codgrado = grados.codgrado INNER JOIN niveles ON secciones.codnivel = niveles.codnivel INNER JOIN periodoescolar ON periodoescolar.codperiodo = estudiantes.codperiodo LEFT JOIN materias ON notas.codmateria = materias.codmateria LEFT JOIN areas ON areas.codarea = materias.codarea WHERE notas.codest = ? AND notas.codperiodo = '".$codperiodo."' AND estudiantes.statusest = '1' GROUP BY materias.codarea, materias.codmateria";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_GET['codest']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{

if(!empty(base64_decode($_GET['c']))){
		?>
		<script type='text/javascript' language='javascript'>
	    alert('ESTE ESTUDIANTE NO TIENE NOTAS REGISTRADAS ACTUALMENTE, \nVERIFIQUE NUEVAMENTE POR FAVOR.')
		var ventana = window.self;
        ventana.opener = window.self;
        ventana.close(); 
        </script> 
		<?php 
	    exit;

            } else {

	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> ESTE ESTUDIANTE NO TIENE NOTAS REGISTRADAS ACTUALMENTE, VERIFIQUE NUEVAMENTE POR FAVOR</center>";
    echo "</div>";		
	exit;
}

	 } else {

		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
	    }
	}
}
######################### FUNCION BUSQUEDA NOTAS DE ESTUDIANTES #############################

######################### FUNCION BUSQUEDA NOTAS POR CURSOS #############################
public function BuscarNotasxCursos() 
	       {
		self::SetNames();

if ($_SESSION['acceso'] == "docente") {

		$sql = " SELECT * FROM asignaciones INNER JOIN periodoescolar ON asignaciones.codperiodo = periodoescolar.codperiodo
		WHERE asignaciones.coddoc = ? AND asignaciones.codturno = ? AND asignaciones.codseccion = ? AND periodoescolar.statusperiodo = 1";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_SESSION['coddoc']));
		$stmt->bindValue(2, trim($_GET['codturno']));
		$stmt->bindValue(3, trim($_GET['codseccion']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> USTED NO TIENE ASIGNADO ESTE CURSO, VERIFIQUE NUEVAMENTE POR FAVOR</center>";
    echo "</div>";		
	exit;
    }
}


		$sql = " SELECT * FROM estudiantes INNER JOIN turnos ON estudiantes.codturno = turnos.codturno INNER JOIN padres ON padres.cedpadre = estudiantes.cedpadre INNER JOIN secciones ON secciones.codseccion = estudiantes.codseccion INNER JOIN grados ON secciones.codgrado = grados.codgrado INNER JOIN niveles ON secciones.codnivel = niveles.codnivel INNER JOIN periodoescolar ON periodoescolar.codperiodo = estudiantes.codperiodo WHERE estudiantes.codseccion = ? and estudiantes.codturno = ? and estudiantes.statusest = '1' ORDER BY estudiantes.papeest";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_GET['codseccion']));
		$stmt->bindValue(2, trim($_GET['codturno']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
		
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON RESULTADOS PARA TU B&Uacute;SQUEDA REALIZADA</center>";
    echo "</div>";		
	exit;
		       }
		else
		{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
######################### FUNCION BUSQUEDA NOTAS POR CURSOS #############################

######################### FUNCION BUSQUEDA NOTAS POR PERIODOS #############################
	    public function BuscarNotasxCursosDos() 
	       {
		self::SetNames();

$sql ="SELECT estudiantes.codest, estudiantes.cedest, estudiantes.pnomest, estudiantes.snomest, estudiantes.papeest, estudiantes.sapeest, estudiantes.becado, estudiantes.codseccion, estudiantes.codturno, estudiantes.codperiodo, estudiantes.fnacest, estudiantes.fechainscripcion, padres.cedpadre, padres.nompadre, padres.apepadre, padres.tlfpadre, periodoescolar.periodo, notas.nota1, notas.nota2, notas.nota3, notas.definitiva, notas.literal, notas.codmateria, areas.nomarea, materias.nommateria, niveles.nivel, grados.grado, secciones.seccion, turnos.turno FROM (estudiantes INNER JOIN notas ON estudiantes.codest = notas.codest) INNER JOIN padres ON padres.cedpadre = estudiantes.cedpadre INNER JOIN turnos ON notas.codturno = turnos.codturno INNER JOIN secciones ON secciones.codseccion = notas.codseccion INNER JOIN grados ON secciones.codgrado = grados.codgrado INNER JOIN niveles ON secciones.codnivel = niveles.codnivel INNER JOIN periodoescolar ON periodoescolar.codperiodo = notas.codperiodo LEFT JOIN materias ON notas.codmateria = materias.codmateria LEFT JOIN areas ON areas.codarea = materias.codarea WHERE notas.codseccion = ? AND notas.codturno = ? ORDER BY estudiantes.papeest";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_GET['codseccion']));
		$stmt->bindValue(2, trim($_GET['codturno']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> ESTE ESTUDIANTE NO TIENE NOTAS REGISTRADAS ACTUALMENTE</center>";
    echo "</div>";		
	exit;

	 } else {

		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
	    }
}
######################### FUNCION BUSQUEDA NOTAS POR PERIODOS #############################

######################### FUNCION BUSQUEDA NOTAS POR PERIODOS #############################
	    public function BuscarNotasxPeriodos() 
	       {
		self::SetNames();

$sql ="SELECT estudiantes.codest, estudiantes.cedest, estudiantes.pnomest, estudiantes.snomest, estudiantes.papeest, estudiantes.sapeest, estudiantes.becado, estudiantes.codseccion, estudiantes.codturno, estudiantes.codperiodo, estudiantes.fnacest, estudiantes.fechainscripcion, padres.cedpadre, padres.nompadre, padres.apepadre, padres.tlfpadre, periodoescolar.periodo, notas.nota1, notas.nota2, notas.nota3, notas.definitiva, notas.literal,  notas.codmateria, areas.nomarea, materias.nommateria, niveles.nivel, grados.grado, secciones.seccion, turnos.turno FROM (estudiantes INNER JOIN notas ON estudiantes.codest = notas.codest) INNER JOIN padres ON padres.cedpadre = estudiantes.cedpadre INNER JOIN turnos ON notas.codturno = turnos.codturno INNER JOIN secciones ON secciones.codseccion = notas.codseccion INNER JOIN grados ON secciones.codgrado = grados.codgrado INNER JOIN niveles ON secciones.codnivel = niveles.codnivel INNER JOIN periodoescolar ON periodoescolar.codperiodo = notas.codperiodo LEFT JOIN materias ON notas.codmateria = materias.codmateria LEFT JOIN areas ON areas.codarea = materias.codarea WHERE notas.codest = ? AND notas.codperiodo = ? ORDER BY estudiantes.papeest";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_GET['codest']));
		$stmt->bindValue(2, trim($_GET['codperiodo']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> ESTE ESTUDIANTE NO TIENE NOTAS REGISTRADAS EN EL PERIODO SELECCIONADO</center>";
    echo "</div>";		
	exit;

	 } else {

		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
	    }
}
######################### FUNCION BUSQUEDA NOTAS POR PERIODOS #############################

######################## FUNCION BUSQUEDA DE ESTUIDANTE NUEVA NOTA ##########################
	    public function BuscarEstudianteNuevaNota() 
	       {
		self::SetNames();
		$sql = " SELECT * FROM estudiantes INNER JOIN turnos ON estudiantes.codturno = turnos.codturno INNER JOIN padres ON padres.cedpadre = estudiantes.cedpadre INNER JOIN secciones ON secciones.codseccion = estudiantes.codseccion INNER JOIN grados ON secciones.codgrado = grados.codgrado INNER JOIN niveles ON secciones.codnivel = niveles.codnivel INNER JOIN periodoescolar ON periodoescolar.codperiodo = estudiantes.codperiodo WHERE estudiantes.codest = ? and estudiantes.statusest = '1' ORDER BY estudiantes.papeest";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim($_GET['codest']));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> ESTE ESTUDIANTE NO SE ENCUENTRA INSCRITO EN EL PERIODO ACTUAL</center>";
    echo "</div>";		
	exit;
		       }
		else
		{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
######################## FUNCION BUSQUEDA DE ESTUIDANTE NUEVA NOTA ##########################

######################### FUNCION BUSQUEDA NOTAS DE ESTUDIANTES #############################
	    public function VerificaNotasEstudiantes() 
	       {
		self::SetNames();
$sql ="SELECT * FROM notas INNER JOIN turnos ON notas.codturno = turnos.codturno INNER JOIN secciones ON secciones.codseccion = notas.codseccion INNER JOIN grados ON secciones.codgrado = grados.codgrado INNER JOIN niveles ON secciones.codnivel = niveles.codnivel INNER JOIN periodoescolar ON periodoescolar.codperiodo = notas.codperiodo LEFT JOIN materias ON notas.codmateria = materias.codmateria LEFT JOIN areas ON areas.codarea = materias.codarea WHERE notas.codest = ? and notas.codseccion = ? and notas.codturno = ? and notas.codperiodo = ? GROUP BY materias.codarea, materias.codmateria";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim(base64_decode($_GET['codest'])));
		$stmt->bindValue(2, trim(base64_decode($_GET['codseccion'])));
		$stmt->bindValue(3, trim(base64_decode($_GET['codturno'])));
		$stmt->bindValue(4, trim(base64_decode($_GET['codperiodo'])));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num>0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> PARA PROCESAR NOTAS A ESTE ESTUDIANTE, DEBERA DE DIRIJIRSE AL MODULO DE REGISTRO DE NOTAS NORMALMENTE </center>";
    echo "</div>";		
	exit;
		      
	 } else {

$sql ="SELECT * FROM notas INNER JOIN turnos ON notas.codturno = turnos.codturno INNER JOIN secciones ON secciones.codseccion = notas.codseccion INNER JOIN grados ON secciones.codgrado = grados.codgrado INNER JOIN niveles ON secciones.codnivel = niveles.codnivel INNER JOIN periodoescolar ON periodoescolar.codperiodo = notas.codperiodo LEFT JOIN materias ON notas.codmateria = materias.codmateria LEFT JOIN areas ON areas.codarea = materias.codarea WHERE notas.codseccion = ? and notas.codturno = ? and notas.codperiodo = ? GROUP BY materias.codarea, materias.codmateria";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim(base64_decode($_GET['codseccion'])));
		$stmt->bindValue(2, trim(base64_decode($_GET['codturno'])));
		$stmt->bindValue(3, trim(base64_decode($_GET['codperiodo'])));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{

	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO EXISTEN NOTAS REGISTRADAS PARA ESTE CURSO, VERIFIQUE NUEVAMENTE POR FAVOR</center>";
    echo "</div>";		
	exit;

	 } else {

		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
	    }
	  }
}
######################### FUNCION BUSQUEDA NOTAS DE ESTUDIANTES #############################

############################# FUNCION PARA REGISTRAR NOTAS ###############################
	public function RegistrarNotasNuevosInscritos()
	{
		self::SetNames();
		if(empty($_POST["codturno"]) or empty($_POST["codnivel"]) or empty($_POST["codgrado"]) or empty($_POST["codseccion"]))
		{
			echo "1";
			exit;
		}
		
		###################### AQUI VALIDO SI EXISTEN NOTAS EN BLANCO #######################
		for($i=0;$i<count($_POST['nota1']);$i++){  //recorro el array
        
             if (empty($_POST['nota1'][$i]) || trim($_POST['nota1'][$i])==""){
		     echo "2";
		     exit;
	         }
		}
			
		########################### PROCESO PARA REGISTRO DE CARGA ##############################
		for($i=0;$i<count($_POST['codmateria']);$i++){  //recorro el array
        if (!empty($_POST['codmateria'][$i])) {
		    
		  $query = " insert into notas values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
		  $stmt = $this->dbh->prepare($query);
		  $stmt->bindParam(1, $codest);
		  $stmt->bindParam(2, $coddoc);
		  $stmt->bindParam(3, $codnivel);
		  $stmt->bindParam(4, $codgrado);
		  $stmt->bindParam(5, $codseccion);
		  $stmt->bindParam(6, $codturno);
		  $stmt->bindParam(7, $codperiodo);
		  $stmt->bindParam(8, $codmateria);
		  $stmt->bindParam(9, $nota1);
		  $stmt->bindParam(10, $nota2);
		  $stmt->bindParam(11, $nota3);
		  $stmt->bindParam(12, $definitiva);
		  $stmt->bindParam(13, $literal);
		
		  $codest = strip_tags($_POST["codest"]);
		  $coddoc = strip_tags($_POST['coddoc'][$i]);
		  $codnivel = strip_tags($_POST['codnivel']);
		  $codgrado = strip_tags($_POST['codgrado']);
		  $codseccion = strip_tags($_POST['codseccion']);
		  $codturno = strip_tags($_POST['codturno']);
		  $codperiodo = strip_tags($_POST['codperiodo']);
		  $codmateria = strip_tags($_POST['codmateria'][$i]);
		  $nota1 = strip_tags($_POST['nota1'][$i]);
		  $nota2 = strip_tags("0");
		  $nota3 = strip_tags("0");
		  $definitiva = ( $_POST['nivel'] == 'INICIAL' ? "0" : $_POST['nota1'][$i]);
		  $literal = strip_tags("0");
		  $stmt->execute();
		                                                }
	                                             }

	echo "<span class='fa fa-check-square-o'></span> LA  CARGA DE NOTAS HA SIDO PROCESADA EXITOSAMENTE";
    exit;
	}
############################# FUNCION PARA REGISTRAR NOTAS ###############################

################################ FIN DE CLASE NOTAS DE ESTUDIANTES ###################################












































################################ CLASE HORARIOS DE CLASES ###################################

############################## FUNCION AGRUPAR DIAS ###############################
	public function AgruparDias()
	{
		self::SetNames();
		$sql ="SELECT GROUP_CONCAT(coddia SEPARATOR ', ') AS day FROM dias";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
############################## FUNCION AGRUPAR DIAS ###############################

############################## FUNCION AGRUPAR DIAS ###############################
	public function AgruparHorarios()
	{
		self::SetNames();
$sql ="SELECT GROUP_CONCAT(nommateria, ' ,', coddia, ' ,', nomhora SEPARATOR ', ') AS materia FROM horarios INNER JOIN horas ON horarios.codhora = horas.codhora INNER JOIN materias ON horarios.codmateria = materias.codmateria ORDER BY horas.codhora ASC";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
############################## FUNCION AGRUPAR DIAS ###############################


################################ FIN DE CLASE HORARIOS DE CLASES ###################################










#################################### FUNCION VERIFICA MESES VENCIDOS ######################################
	public function VerificaMesesVencidos()
	{
		self::SetNames();
		
		$sql ="SELECT periodo from periodoescolar where statusperiodo = 1";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	    echo "";
	    exit;
		}
		else
		{

		$sql2 = " SELECT periodoescolar.codperiodo, periodoescolar.diasvence, pagos.codpago, pagos.mespago from pagos LEFT JOIN periodoescolar ON pagos.codperiodo = periodoescolar.codperiodo WHERE pagos.statuspago = 0 AND periodoescolar.statusperiodo = 1";

		$array=array();
		foreach ($this->dbh->query($sql2) as $row)
		{
			$this->p2[] = $row;
		    $codigo = $row['codpago'];
		    $codperiodo = $row['codperiodo'];
		    $diasvence = $row['diasvence'];
			$array[]= $row['mespago'];
			
		$sql = " UPDATE pagos SET "
			  ." statuspago = ? "
			  ." WHERE "
			  ." codperiodo = $codperiodo AND mespago <= '".date('m')."' AND $diasvence < '".date('d')."' AND statuspago = '0';
			   ";
		    $stmt = $this->dbh->prepare($sql);
		    $stmt->bindParam(1, $statuspago);
			$statuspago = strip_tags("2");
			$stmt->execute();
		 }				
	 }
}
#################################### FUNCION VERIFICA MESES VENCIDOS ######################################



#################################### FUNCION PARA CONTAR REGISTROS ###################################
public function ContarRegistros()
	{
$sql = "SELECT
(SELECT COUNT(*) FROM usuarios) AS user,
(SELECT COUNT(*) FROM estudiantes WHERE statusest = '1') AS est,
(SELECT COUNT(*) FROM padres WHERE statuspad = '1') AS tutor,
(SELECT COUNT(*) FROM estudiantes WHERE sexoest = 'MASCULINO' AND statusest = '1') AS masculino,
(SELECT COUNT(*) FROM estudiantes WHERE sexoest = 'FEMENINO' AND statusest = '1') AS femenino,
(SELECT COUNT(*) FROM docentes) AS doc,
(SELECT COUNT(*) FROM pagos WHERE statuspago = '1') AS totalpag,
(SELECT COUNT(*) FROM pagos WHERE statuspago = '2') AS totalvenc,
(SELECT COUNT(*) FROM pagos WHERE statuspago = '0') AS totalpend";

		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
	
public function ContarCuotas() {

        $sql = "select count(*) from pagos where statuspago = '2'";

		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}

#################################### FUNCION PARA CONTAR REGISTROS ###################################


################# ACTUALIZACION EN GENERAL ############################
/*public function Update()
	{

	/*$sql = "select * from estudiantes";

	    $array=array();

		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;

			$numcomprobante = "C34";
			$numrecibo = "C".GeraHash(18);


			$update = " update pagos set "
			." numcomprobante = ? "
			." where "
			." numcomprobante = ?;
			";
			$stmt = $this->dbh->prepare($update);
			$stmt->bindParam(1, $numrecibo);
			$stmt->bindParam(2, $numcomprobante);
			$stmt->execute();

			$update = " update pagosextras set "
			." numcomprobante = ? "
			." where "
			." numcomprobante = ?;
			";
			$stmt = $this->dbh->prepare($update);
			$stmt->bindParam(1, $numrecibo);
			$stmt->bindParam(2, $numcomprobante);
			$stmt->execute();
		//}
 }*/

}
#################################### AQUI TERMINA LA CLASE LOGIN ###################################
?>