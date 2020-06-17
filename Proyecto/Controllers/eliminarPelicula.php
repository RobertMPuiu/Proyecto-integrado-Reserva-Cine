<?php
/*
* Este fichero es el controlador usado para la accion de eliminar una película del panel de administrador. Se usa en la vista eliminar.php
*/
require '../Models/pelicula.php';
/*
* recogemos los objetos que nos hacen falta mediante los metodos de los modelos.
*
* $mostrar -> recoge todas las películas disponibles
*/
$mostrar=Pelicula::getCartelera();

include '../Views/content/eliminar.php';
/*
* controlador para eliminar una película
*/
if (isset($_POST['eliminar']) && ($_POST['eleccion'] != "-1")){
	Pelicula::eliminarPelicula($_POST['eleccion']);
}
?>