<?php
session_start();
// Inicializa la sesi�n

// Destruye todas las variables de la sesi�n
//$_SESSION = array();

$session_name = session_name();
//unset($_SESSION["acceso"]);
unset($_SESSION["password"]);
//session_destroy();

// Para borrar las cookies asociadas a la sesi�n
// Es necesario hacer una petici�n http para que el navegador las elimine
if ( isset( $_COOKIE[ $session_name ] ) ) {
   // if ( setcookie(session_name(), '', time()-3600, '/') ) {
        ?>
	<script type='text/javascript' language='javascript'>
	document.location.href='lockscreen'	 
	</script> 
	<?php
        exit();   
   // }
}
?>