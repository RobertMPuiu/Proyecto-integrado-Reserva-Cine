<?php
/*
* Este fichero es el controlador usado para la página de actualizar tarifas. Se usa en la vista nuevasTarifas.php
*/
require '../Models/tarifa.php';
/*
* recogemos los objetos que nos hacen falta mediante los metodos de los modelos.
*
* $mostrar -> obtiene todas las tarifas existentes
*/
$mostrar=Tarifa::getTarifas();

include "../Views/content/nuevasTarifas.php";
/*
* controlador para insertar una nueva tarifa
*/
if (isset($_POST['insertar'])) {
	Tarifa::subirTarifa($_POST['tipoEntradaS'],$_POST['definicionS'],$_POST['precioS']);
	header("Location: actualizarTarifas.php");
}
/*
* controlador para modificar una tarifa
*/
if (isset($_POST['actualizar'])) {
	Tarifa::actualizarTarifa($_POST['tipoEntradaA'],$_POST['definicionA'],$_POST['precioA']);
	header("Location: actualizarTarifas.php");
}
/*
* controlador para eliminar una tarifa
*/
if (isset($_POST['eliminar'])) {
	Tarifa::eliminarTarifa($_POST['tipoEntradaA']);
	header("Location: actualizarTarifas.php");
}

?>