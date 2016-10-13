<?php

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

	$now = time();

	if($now > $_SESSION['expire']) {
	session_destroy();

	echo "Su sesion a terminado,
	<a href='login.php'>Necesita Hacer Login</a><br>";
	echo '<a href="layout.html">Pagina de Inicio</a>'; 
	exit();
	}
} else {
   echo "Esta pagina es solo para usuarios registrados.<br>";
   echo "<br><a href='login.php'>Login</a>";
   echo "<br><br><a href='registro.html'>Registrarme</a>";

exit();
}

?>