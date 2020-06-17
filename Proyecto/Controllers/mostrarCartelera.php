<?php
/*
* Este fichero es el controlador usado para la página de cartelera. Se usa en las vistas cartelera.php y carteleraUsuarios.php
*/
session_start();
require '../Models/pelicula.php';
require '../Models/proyeccion.php';
require '../Models/valoracion.php';
/*
* recogemos los objetos que nos hacen falta mediante los metodos de los modelos.
*
* $mostrar -> recoge todas las películas disponibles
* $valoracion -> obtiene las valoraciones realizadas por los usuarios para calcular una valoración
*/
$mostrar=Pelicula::getCartelera();
$valoracion=Valoracion::obtenerValoracion();

/*
*	Este controlador no se usa
*/
if (isset($_POST['reservar'])){
	$horas=Proyeccion::getHorasOcupadas($peliculaSelected[0]);
}
/*
*	Controlador para la redireción del usuario a una cartelera u otra dependiendo de sus privilegios.
*/
if ($_SESSION["usuario"] && $_SESSION["admin"] == "no"){
	include "../Views/content/carteleraUsuarios.php";
}
else if ($_SESSION["usuario"] && $_SESSION["admin"] == "si"){
	include "../Views/content/carteleraUsuarios.php";
}
else{
	include "../Views/content/cartelera.php";
}



?>