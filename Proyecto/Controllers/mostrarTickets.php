<?php
/*
* Este fichero es el controlador usado para la página de reserva. Se usa en las vistas tickets.php
*/
	session_start();
	require '../Models/proyeccion.php';
	require '../Models/reserva.php';
	/*
	*	metodo para actualizar los asientos de las proyecciones
	*/
	Proyeccion::actualizarAsientos($_POST['terminarReserva'],$_SESSION["idProyeccion"]);
	/*
	* 	Metodo para insertar la nueva reserva
	*/
	if (isset($_POST["terminarReserva"])) {
		Reserva::crearReserva($_SESSION['tituloPelicula'],$_POST['sala'],$_POST['fecha'],$_POST['hora'],$_POST['asientos'],$_SESSION["idProyeccion"],$_SESSION["idUsuario"],$_SESSION["precioFinal"]);
	}
	/*
	* Metodo para mostrar las reservas por usuario
	*/

	$reservas = Reserva::getReservasByIdUsuario($_SESSION["idUsuario"]);
	include "../Views/content/tickets.php";
?>