<?php
session_start();
// Inicializa la sesión

// Destruye todas las variables de la sesión
//$_SESSION = array();

$session_name = session_name();
//unset($_SESSION["acceso"]);
unset($_SESSION["password"]);
//session_destroy();

// Para borrar las cookies asociadas a la sesión
// Es necesario hacer una petición http para que el navegador las elimine
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