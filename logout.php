<?php
session_start();
// Inicializa la sesión

// Destruye todas las variables de la sesión
$_SESSION = array();
 
//guardar el nombre de la sessión para luego borrar las cookies
$session_name = session_name();
 
//Para destruir una variable en específico
unset($_SESSION['user']);
unset($_SESSION['pass']);
unset($_SESSION['codigo']);
unset($_SESSION['hora']);
unset($_SESSION['minut']);
unset($_SESSION['autorizacion']);
 
// Finalmente, destruye la sesión
  session_destroy();

// Para borrar las cookies asociadas a la sesión
// Es necesario hacer una petición http para que el navegador las elimine
if ( isset( $_COOKIE[ $session_name ] ) ) {
    if ( setcookie(session_name(), '', time()-3600, '/') ) {
        ?>
	<script type='text/javascript' language='javascript'>
	document.location.href='index' 
	</script> 
	<?php
        exit();   
    }
}
?>