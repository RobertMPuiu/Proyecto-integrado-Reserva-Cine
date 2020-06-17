<?php
/*
* Este fichero es una petición AJAX usado para el formulario de reserva. Se usa en la vista reservar.php
*/
session_start();
require '../Models/proyeccion.php';
require '../Models/tarifa.php';
/*
* recogemos los objetos que nos hacen falta.
*
* $_SESSION["horaSeleccionada"] -> obtiene las horas a partir de la petición ajax
* $_SESSION["proyeccion"] -> obtiene la proyeccion final de la reserva
* $tarifa=obtiene la tarifa de la proyeccion
* $_SESSION["precioUnidad"]=guarda en una sesion la tarifa
* $proyeccionesReserva = array con la tarifa y los asientos disponible
*/
$_SESSION["horaSeleccionada"] = $_POST['hora'];
$_SESSION["proyeccion"] = Proyeccion::obtenerProyeccionesReservar($_SESSION['idPelicula'],$_SESSION["fechaSeleccionada"],$_SESSION["salaSeleccionada"],$_SESSION["horaSeleccionada"]);
$tarifa= Tarifa::obtenerPrecio($_SESSION["proyeccion"]->getTipoEntrada());
$_SESSION["precioUnidad"]=$tarifa;
$_SESSION["idProyeccion"] = $_SESSION["proyeccion"]->getIdProyeccion();
$_SESSION["asientosDisponibles"] = $_SESSION["proyeccion"]->getDisponibles();
$proyeccionesReserva = [];
$proyeccionesReserva[] = $tarifa;
$proyeccionesReserva[] = $_SESSION["proyeccion"]->getDisponibles();
/*
* Se devuelve el array con el precio y los asientos disponibles.
*/
echo json_encode($proyeccionesReserva);
 ?>