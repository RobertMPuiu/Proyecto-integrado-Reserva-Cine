<?php
/*
* Este fichero es el controlador usado para la página de actualizar cartelera. Se usa en la vista nuevaCartelera.php
*/
require '../Models/proyeccion.php';
require '../Models/pelicula.php';
require '../Models/sala.php';
/*
* $horasDisponibles es un array auxiliar cuya función es usada para detectar que horas son las que están ocupadas
*/
$horasDisponibles = [
    1 => "10:00",
   	2 => "12:00",
   	3 => "14:00",
   	4 => "16:00",
   	5 => "18:00",
   	6 => "20:00",
   	7 => "22:00"
];
/*
* recogemos los objetos que nos hacen falta mediante los metodos de los modelos.
*
* $obtenerPeliculas -> obtiene todas las peliculas existentes
* $proyeccionNoDisponible -> segun la fecha, sala y hora, te dice si existe dicha proyección a la hora de crear una nueva.
* $peliculasNoVisibles -> te muestra las películas que no estan en cartelera, dando la posibilidad de añadirlas.
* $mostrarProyecciones -> obtiene todas las proyecciones existentes
* $fechaActual -> setea una fecha actual con un formato YYYY-mm-dd 
*/
$obtenerPeliculas=Pelicula::getCartelera();
$proyeccionNoDisponible=Proyeccion::proyeccionesNoDisponibles($_POST['fechaProyec'],$_POST['salaProyec'],$_POST['horaProyec']);
$peliculasNoVisibles=Pelicula::obtenerPeliculasNoVisibles();
$mostrarProyecciones= Proyeccion::obtenerProyecciones();
$fechaActual = date('Y-m-d');
/*
* sistema para establecer el tipo de entrada cuando se configura una nueva proyección. Es un sistema sencillo de switch case, donde recoge el dia, y se le establecen las distintas opciones posibles.
*/
if (isset($_POST['anadirProyeccion'])){
	$fechaElegida = date("w",$_POST['fechaProyec']);
	switch ($fechaElegida) {
  	case 0:
    $oferta="Entrada Normal";
    break;
  	case 1:
    $oferta="Entrada Normal";
    break;
  	case 2:
    $oferta="Entrada Normal";
    break;
    case 3:
    $oferta="Dia espectador";
    break;
  	case 4:
    $oferta="Dia Pareja";
    break;
  	case 5:
    $oferta="Entrada Normal";
    break;
    case 6:
    if ($_POST['horaProyec']== "12:00") {
    	$oferta="Matinal";
    }
    break;
  	case 7:
    if ($_POST['horaProyec']== "12:00") {
    	$oferta="Matinal";
    }
    break;
  default:
     $oferta="Entrada Normal";
}
if ($_POST['salaProyec']== "5") {
	$oferta="3D";
}

/*
* Se comprueba si existe la proyección, y si no existe, se crea una nueva. de lo contrario, crea un mensaje de error.
*/
if (empty($proyeccionNoDisponible)) {
		$mensaje="Proyección añadida con éxito";
		$butacas=Sala::obtenerButacas($_POST['salaProyec']);
		Proyeccion::subirProyeccion($_POST['fechaProyec'],$_POST['horaProyec'],$butacas[0],$_POST['salaProyec'],$_POST['seleccionProyec'],$oferta);

	}else{
		$mensaje="Esta proyección no está disponible";
	}
}
/*
* controlador para establecer una película visible
*/
if (isset($_POST["anadir"])) {
	Pelicula::establecerPeliculaVisible($_POST['seleccion']);
	header("Location: actualizarCartelera.php");
}
/*
* controlador para establecer una película no visible
*/
if (isset($_POST["eliminar"])) {
	Pelicula::establecerPeliculaNoVisible($_POST['idOculto']);
	header("Location: actualizarCartelera.php");
}
/*
* controlador para actualizar una proyección
*/
if (isset($_POST['actualizarProyeccion'])) {
	Proyeccion::actualizarProyeccion($_POST['fecha'],$_POST['hora'],$_POST['disponibles'],$_POST['sala'],$_POST['pelicula'],$_POST['tipoEntrada'],$_POST['idProyeccion']);
	header("Location: actualizarCartelera.php");
}
/*
* controlador para eliminar una proyección
*/
if (isset($_POST['eliminarProyeccion'])) {
	Proyeccion::eliminarProyeccion($_POST['idProyeccion']);
	header("Location: actualizarCartelera.php");
}

include "../Views/content/nuevaCartelera.php";
?>