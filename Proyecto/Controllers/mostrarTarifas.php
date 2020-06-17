<?php
/*
* Este fichero es el controlador usado para la página de tarifas. Se usa en las vistas tarifas.php
*/
require '../Models/tarifa.php';
/*
* recogemos los objetos que nos hacen falta mediante los metodos de los modelos.
*
* $mostrar -> recoge todas las tarifas disponibles
*/
$mostrar=Tarifa::getTarifas();
include "../Views/content/tarifas.php";
?>