<?php
/*
* Este fichero es el controlador usado para cerrar sesión. Se usa al clicar sobre cerrar sesión.
* Destruye todas las sesiones y hace una redirección a la página de inicio.
*/
	session_start();
	session_unset();
	header('Location: ../Views/index.php');
?>