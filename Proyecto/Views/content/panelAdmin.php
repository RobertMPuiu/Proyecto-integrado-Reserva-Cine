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
	<script type="text/javascript" src="../scripts/panelAdmin.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../styles/panelAdmin.css">
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
				<span><a href="mostrarTickets.php"><?php echo $_SESSION["usuario"]; ?></a></span>
					<span>/</span>
				<span><a href="">Cerrar Sesión</a></span>
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
					<li><a href="ubicacion.php">Ubicación</a></li>
					<li><a href="panelAdmin.php">Panel Administrador</a></li>
					<li><a href="../../Controllers/actualizarCartelera.php">Actualizar cartelera</a></li>
					<li><a href="../../Controllers/actualizarTarifas.php">Actualizar tarifas</a></li>
					<?php 
					}else if ($_SESSION["usuario"] && $_SESSION["admin"] == "no"){
				?>
						<li><a href="../Views/index.php">Inicio</a></li>
						<li><a href="mostrarCartelera.php">Cartelera</a></li>
						<li><a href="mostrarTarifas.php">Tarifas</a></li>
						<li><a href="../Views/content/contacto.php">Contacto</a></li>
						<li><a href="../Views/content/ubicacion.php">Ubicación</a></li>
			<?php 
				}else{
			?>
			<li><a href="../index.php">Inicio</a></li>
			<li><a href="../../Controllers/mostrarCartelera.php">Cartelera</a></li>
			<li><a href="../../Controllers/mostrarTarifas.php">Tarifas</a></li>
			<li><a href="ubicacion.php">Ubicación</a></li>
			<?php 
				}
			?>
		</ul>
	</nav>
	<main>
		<div class="container-fluid" >
			<div class="row">
				<div class="offset-lg-1 offset-xl-2 col-xs-6 col-md-4 col-lg-3 col-xl-2 text-center" id="panel1">
					<h2>Añadir</h2>
					<img src="../images/add.png" class="img-fluid">
				</div>
				<div class="offset-lg-1 offset-xl-1 col-xs-6 col-md-4 col-lg-3 col-xl-2 text-center" id="panel2">
					<h2>Modificar</h2>
					<img src="../images/modify.png" class="img-fluid">
				</div>
				<div class="offset-lg-1 offset-xl-1 col-xs-6 col-md-4 col-lg-3 col-xl-2 text-center" id="panel3">
					<h2>Eliminar</h2>
					<img src="../images/remove.png" class="img-fluid">
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