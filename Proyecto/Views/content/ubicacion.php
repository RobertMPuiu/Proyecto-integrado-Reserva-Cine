<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Inicio</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="../scripts/menu.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../styles/ubicacion.css">
	<link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>
<body>
	<header>
		<div id="openmenu">
			<span></span>
			<span></span>
			<span></span>
		</div>
    	<div id="titulo"><img src="../images/logo.PNG"></div>
		<div id="usuario">
			<?php 
			if ($_SESSION["usuario"]) {
				?>
				<span><a href="../../Controllers/mostrarTickets.php"><?php echo $_SESSION["usuario"]; ?></a></span>
					<span>/</span>
				<span><a href="../../Controllers/cerrarSesion.php">Cerrar Sesión</a></span>
				 <?php
			}else{
			?>
			<span><a href="../../Controllers/comprobarUsuario.php">Iniciar sesión</a></span>
			<span>/</span>
			<span><a href="../../Controllers/crearUsuario.php">Registrarse</a></span>
			<?php 
				}
			?>
		</div>
	</header>
	<nav id="menu">
		<ul>
			<?php 
				if ($_SESSION["usuario"] && $_SESSION["admin"] == "si"){
			?>
					<li><a href="../index.php">Inicio</a></li>
					<li><a href="../../Controllers/mostrarCartelera.php">Cartelera</a></li>
					<li><a href="../../Controllers/mostrarTarifas.php">Tarifas</a></li>
					<li><a href="contacto.php">Contacto</a></li>
					<li><a href="panelAdmin.php">Panel Administrador</a></li>
					<li><a href="../../Controllers/actualizarCartelera.php">Actualizar cartelera</a></li>
					<li><a href="../../Controllers/actualizarTarifas.php">Actualizar tarifas</a></li>
					<?php 
					}else if ($_SESSION["usuario"] && $_SESSION["admin"] == "no"){
				?>
						<li><a href="../../Controllers/mostrarCartelera.php">Cartelera</a></li>
						<li><a href="../../Controllers/mostrarTarifas.php">Tarifas</a></li>
						<li><a href="contacto.php">Contacto</a></li>
						<li><a href="../Views/index.php">Inicio</a></li>
			<?php 
				}else{
			?>
			<li><a href="../index.php">Inicio</a></li>
			<li><a href="../../Controllers/mostrarCartelera.php">Cartelera</a></li>
			<li><a href="../../Controllers/mostrarTarifas.php">Tarifas</a></li>
			<li><a href="contacto.php">Contacto</a></li>
			<?php 
				}
			?>
		</ul>
	</nav>
	<main>
		<div class="container-fluid" >
			<div class="row">
				<div class="offset-lg-1 offset-xl-3 col-xs-6 col-md-4 col-lg-3 col-xl-6 text-center" id="ubicacion">
					<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1332.9734199167285!2d-5.965394251424104!3d37.38124802375349!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2ses!4v1588362116236!5m2!1ses!2ses" width="700" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
				</div>
			</div>
		</div>
	</main>
	<footer id="footerMain">
			<div class="container-fluid">
				<div class="row">
					<div class="offset-lg-1 col-xs-6 col-md-4 col-lg-3 text-center">
						<h5>Redes Sociales</h5>
						<a href=""><img src="../images/logoFacebook.png"></a>
						<a href=""><img src="../images/logoInstagram.png"></a>
						<a href=""><img src="../images/logoTwitter.png"></div></a>
					<div class="col-xs-6 col-md-4 col-lg-4  text-center">
						<h5>Enlaces web</h5>
						<?php 
					if ($_SESSION["usuario"] && $_SESSION["admin"] == "si"){
				?>
						<a href="../index.php">Inicio</a>
						<br>
						<a href="../../Controllers/mostrarCartelera.php">Cartelera</a>
						<br>
						<a href="../../Controllers/mostrarTarifas.php">Tarifas</a>
						<br>
						<a href="contacto.php">Contacto</a>
						<br>
						<a href="ubicacion.php">Ubicación</a>
						<br>
						<a href="../../Controllers/actualizarCartelera.php">Actualizar cartelera</a>
						<br>
						<a href="../../Controllers/actualizarTarifas.php">Actualizar tarifas</a>
						<?php 
					}else if ($_SESSION["usuario"] && $_SESSION["admin"] == "no"){
				?>
						<a href="../index.php">Inicio</a>
						<br>
						<a href="../../Controllers/mostrarCartelera.php">Cartelera</a>
						<br>
						<a href="../../Controllers/mostrarTarifas.php">Tarifas</a>
						<br>
						<a href="contacto.php">Contacto</a>
						<br>
						<a href="ubicacion.php">Ubicación</a>
						<br>
				<?php 
					}else{
				?>
						<a href="../index.php">Inicio</a>
						<br>
						<a href="../../Controllers/mostrarCartelera.php">Cartelera</a>
						<br>
						<a href="../../Controllers/mostrarTarifas.php">Tarifas</a>
						<br>
						<a href="contacto.php">Contacto</a>
						<br>
						<a href="ubicacion.php">Ubicación</a>
						<br>
				<?php 
					}
				?>
					</div>
					<div class="col-xs-6 col-md-4 col-lg-2 offset-lg-1 text-center">
						<h5>FilmZona</h5>
						<br>
					</div>
				</div>	
			</div>
		</footer>
</body>
</html>