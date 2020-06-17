<?php
/*
* Este fichero es el controlador usado para la accion de añadir una película del panel de administrador. Se usa en la vista insertar.php
*/
require '../Models/pelicula.php';
include "../Views/content/insertar.php";
/*
* controlador para añadir una película
*/
if(isset($_POST['insertar'])){
 	Pelicula::subirPelicula($_POST["imagen"], $_POST["tituloPelicula"], $_POST["pais"],$_POST["genero"],$_POST["duracion"],$_POST["clasificacion"],$_POST["fechaEstreno"],$_POST["director"],$_POST["reparto"],$_POST["sinopsis"],$_POST["trailer"]);
 	$existe=Pelicula::existePelicula($_POST["tituloPelicula"]);
}
?>