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
* $_SESSION["asientos"] -> obtiene los asientos a partir de la petición ajax
* $precioFinal -> obtiene el precio final de la reserva
*/
$_SESSION["asientos"] = $_POST['asiento'];	
$_SESSION["precioFinal"] = $_SESSION["asientos"]*$_SESSION["precioUnidad"];
$precioFinal = [];
$precioFinal[] = $_SESSION["precioFinal"];
$precioFinal[] = $_SESSION["asientosDisponibles"]-$_SESSION["asientos"];
/*
* Se devuelve el precio final.
*/
echo json_encode($precioFinal);
 ?>