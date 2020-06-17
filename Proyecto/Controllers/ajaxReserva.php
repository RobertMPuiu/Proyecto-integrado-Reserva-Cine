<?php
/*
* Este fichero es una petición AJAX usado para el formulario de reserva. Se usa en la vista 
* reservar.php
*/
session_start();
require '../Models/proyeccion.php';
/*
* recogemos los objetos que nos hacen falta.
*
* $_SESSION["fechaSeleccionada"] -> obtiene la fecha a partir de la petición ajax
* $salas -> obtiene las salas para dicha fecha de dicha película
*/
$_SESSION["fechaSeleccionada"] = $_POST['fecha'];	
$salas = Proyeccion::getSalas($_SESSION['idPelicula'],$_SESSION["fechaSeleccionada"]);
/*
* Se devuelve el array de salas.
*/
echo json_encode($salas);
 ?>