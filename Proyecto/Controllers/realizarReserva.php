<?php
/*
* Este fichero es el controlador usado para la página de reserva. Se usa en las vistas reservar.php
*/
session_start();
require '../Models/pelicula.php';
require '../Models/proyeccion.php';
require '../Models/valoracion.php';
/*
* recogemos los objetos que nos hacen falta mediante los metodos de los modelos.
*
* $_SESSION['idPelicula'] -> sesion que guarda la id de la película
* $peliculaSelected -> obtiene la película elegida a partir de la ID
* $fechas -> obtiene las fechas de la pelicula elegida a partir de la ID
*/
$_SESSION['idPelicula']=$_POST['reservar'];
$peliculaSelected = Pelicula::getPeliculaByID($_POST['reservar']);
$_SESSION['tituloPelicula']=$peliculaSelected[0]->getTitulo();
$fechas = Proyeccion::getFechas($_POST['reservar']);
include "../Views/content/reservar.php";
 ?>