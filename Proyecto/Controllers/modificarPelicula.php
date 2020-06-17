<?php
/*
* Este fichero es el controlador usado para la accion de modificar una película del panel de administrador. Se usa en la vista modificar.php
*/
require '../Models/pelicula.php';
/*
* recogemos los objetos que nos hacen falta mediante los metodos de los modelos.
*
* $mostrar -> recoge todas las películas disponibles
*/
$mostrar=Pelicula::getCartelera();

include '../Views/content/modificar.php';
/*
* controlador para modificar una película
*/
if (isset($_POST['modificar'])){
	Pelicula::actualizarPelicula($_POST["imagen"], $_POST["tituloPelicula"], $_POST["pais"],$_POST["genero"],$_POST["duracion"],$_POST["calificacion"],$_POST["fechaEstreno"],$_POST["director"],$_POST["reparto"],$_POST["sinopsis"],$_POST["trailer"],$_POST["idPelicula"]);
}

?>