<?php
/*
* Este fichero es una petición AJAX usado para el formulario de reserva. Se usa en la vista reservar.php
*/
session_start();
require '../Models/proyeccion.php';
/*
* recogemos los objetos que nos hacen falta.
*
* $_SESSION["salaSeleccionada"] -> obtiene la sala a partir de la petición ajax
* $horas -> obtiene las hora para dicha sala y dicha fecha de dicha película
*/
$_SESSION["salaSeleccionada"] = $_POST['sala'];
$horas = Proyeccion::getHoras($_SESSION['idPelicula'],$_SESSION["fechaSeleccionada"],$_SESSION["salaSeleccionada"]);
/*
* Se devuelve el array de horas.
*/
echo json_encode($horas);
 ?>