<?php
	session_start();
  	require '../Models/usuario.php';	
        if (isset($_POST["register"])) { 
           $existeCorreo=Usuario::existeCorreo($_POST["email"]);   	
        	if ($existeCorreo) {
        		$mensaje="este correo ya existe";
        	}
        	else{
        		  Usuario::crearUsuario($_POST["nombre"], $_POST["apellidos"], $_POST["dni"],$_POST["email"],$_POST["password"],$_POST["ciudad"],$_POST["direccion"],$_POST["codPostal"]);
              $comprobarUsuario=Usuario::comprobarUsuariosRegistro();
              if($comprobarUsuario[0] == $_POST['email'] && $comprobarUsuario[1] == $_POST['password']) {
                  $_SESSION["usuario"] = $comprobarUsuario[2];
                  $_SESSION["admin"] = $comprobarUsuario[3];
                  $_SESSION["idUsuario"] = $comprobarUsuario[4];
                  header("Location: ../Views/index.php");
                }

        	}

        }
        include "../Views/content/register.php";
?>