<?php
/*
* Este fichero es el controlador usado para la página de actualizar tarifas. Se usa en la vista nuevasTarifas.php
*/
session_start();
require '../Models/usuario.php';
include "../Views/content/login.php";
/*
* recogemos los objetos que nos hacen falta mediante los metodos de los modelos.
*
* $comprobarUsuario -> comprueba si el usuario introducido existe o no.
*/
$comprobarUsuario=Usuario::comprobarUsuarios();
/*
* controlador para crear sesiones al pulsar sobre el boton de login
*/
if (isset($_POST['login'])){
  if($comprobarUsuario[0] == $_POST['correoElectronico'] && $comprobarUsuario[1] == $_POST['contrasenia']) {
  	$_SESSION["usuario"] = $comprobarUsuario[2];
  	$_SESSION["admin"] = $comprobarUsuario[3];
  	$_SESSION["idUsuario"] = $comprobarUsuario[4];
    header("Location: ../Views/index.php");
  }
}
?>