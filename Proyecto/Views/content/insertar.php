<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Insertar Pelicula</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="../Views/scripts/menu.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../Views/styles/insertar.css">
	<link rel="stylesheet" type="text/css" href="../Views/styles/style.css">
</head>
<body>
	<header>
		<div id="openmenu">
			<span></span>
			<span></span>
			<span></span>
		</div>
    	<div id="titulo"><img src="../Views/images/logo.PNG"></div>
		<div id="usuario">
			<?php 
			if ($_SESSION["usuario"]) {
				?>
				<span><a href="mostrarTickets.php"><?php echo $_SESSION["usuario"]; ?></a></span>
					<span>/</span>
				<span><a href="cerrarSesion.php">Cerrar Sesión</a></span>
				 <?php
			}else{
			?>
			<span><a href="comprobarUsuario.php">Iniciar sesión</a></span>
			<span>/</span>
			<span><a href="crearUsuario.php">Registrarse</a></span>
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
					<li><a href="../Views/index.php">Inicio</a></li>
					<li><a href="mostrarCartelera.php">Cartelera</a></li>
					<li><a href="mostrarTarifas.php">Tarifas</a></li>
					<li><a href="../Views/content/contacto.php">Contacto</a></li>
					<li><a href="../Views/content/ubicacion.php">Ubicación</a></li>
					<li><a href="../Views/content/panelAdmin.php">Panel Administrador</a></li>
					<li><a href="actualizarCartelera.php">Actualizar cartelera</a></li>
					<li><a href="actualizarTarifas.php">Actualizar tarifas</a></li>
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
			<li><a href="../Views/index.php">Inicio</a></li>
			<li><a href="mostrarCartelera.php">Cartelera</a></li>
			<li><a href="mostrarTarifas.php">Tarifas</a></li>
			<li><a href="../Views/content/contacto.php">Contacto</a></li>
			<li><a href="../Views/content/ubicacion.php">Ubicación</a></li>
			<?php 
				}
			?>
		</ul>
	</nav>
	<main>
	    <div class="container-fluid" >
			<div class="row" id="recuadroPelicula">
				<div class="offset-lg-1 offset-xl-3 col-xs-6 col-md-8 col-lg-10 col-xl-6" id="insertarPelicula">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	                  <div class="form-group">
	                    <label for="imagen">Portada</label>
	                    <input type="text" name="imagen" id="imagen" class="form-control" placeholder="Ruta de la imagen de portada" required="required">
	                  </div>
	                  <div class="form-group">
	                    <label for="tituloPelicula">Titulo</label>
	                    <input type="text" name="tituloPelicula" id="tituloPelicula" class="form-control" placeholder="Titulo de la pelicula" required="required">
	                  </div>
	                   <div class="form-group">
	                    <label for="pais">Pais</label>
	                    <input type="text" name="pais" id="pais" class="form-control" placeholder="Pais de origen" required="required">
	                  </div>
	                  <div class="form-group">
	                    <label for="genero">Género</label>
	                    <input type="text" name="genero" id="genero" class="form-control" placeholder="genero de la pelicula" required="required">
	                  </div>
	                  <div class="form-group">
	                    <label for="duracion">Duración</label>
	                    <input type="text" name="duracion" id="duracion" class="form-control" placeholder="duracion de la pelicula" required="required">
	                  </div>
	                  <div class="form-group">
	                    <label for="calificacion">Calificación</label>
	                    <input type="text" name="calificacion" id="calificacion" class="form-control" placeholder="calificacion de la pelicula" required="required">
	                  </div>
	                  <div class="form-group">
	                    <label for="fechaEstreno">Fecha de estreno</label>
	                    <input type="date" name="fechaEstreno" id="fechaEstreno" class="form-control" required="required">
	                  </div>
	                  <div class="form-group">
	                    <label for="director">Director</label>
	                    <input type="text" name="director" id="director" class="form-control" placeholder="director de la pelicula" required="required">
	                  </div>
	                  <div class="form-group">
	                    <label for="reparto">Reparto</label>
	                    <input type="text" name="reparto" id="reparto" class="form-control" placeholder="reparto de la pelicula" required="required">
	                  </div>
	                   <div class="form-group">
	                    <label for="sinopsis">Sinopsis</label>
	                    <input type="text" name="sinopsis" id="sinopsis" class="form-control" placeholder="sinopsis de la pelicula" required="required">
	                  </div>
	                  <div class="form-group">
	                    <label for="trailer">Trailer</label>
	                    <input type="text" name="trailer" id="trailer" class="form-control" placeholder="link del trailer" required="required">
	                  </div>
	                 
	                  <input name="insertar" id="insertar" class="btn btn-primary  login-btn mb-4" type="submit" value="Insertar Pelicula" >
	                </form>
	                <?php
	                if(isset($_POST['insertar'])){
						if($existe){
					?>
					<p align="center" id="mensajeError">Se ha producido un error al insertar la pelicula: Ya existe en la base de datos.</p>
					<?php
						}else{
					?>
					<p align="center" id="mensajeExito">La película se ha añadido con éxito</p>
					<?php
						}
					}
					?>
				</div>
			</div>
		</div>
  	</main>
	<footer id="footerMain">
			<div class="container-fluid">
				<div class="row">
					<div class="offset-lg-1 col-xs-6 col-md-4 col-lg-3 text-center">
						<h5>Redes Sociales</h5>
						<a href=""><img src="../Views/images/logoFacebook.png"></a>
						<a href=""><img src="../Views/images/logoInstagram.png"></a>
						<a href=""><img src="../Views/images/logoTwitter.png"></div></a>
					<div class="col-xs-6 col-md-4 col-lg-4  text-center">
						<h5>Enlaces web</h5>
						<?php 
					if ($_SESSION["usuario"] && $_SESSION["admin"] == "si"){
				?>
						<a href="../Views/index.php">Inicio</a>
						<br>
						<a href="mostrarCartelera.php">Cartelera</a>
						<br>
						<a href="mostrarTarifas.php">Tarifas</a>
						<br>
						<a href="../Views/content/contacto.php">Contacto</a>
						<br>
						<a href="../Views/content/ubicacion.php">Ubicación</a>
						<br>
						<a href="../Views/content/panelAdmin.php">Panel Administrador</a>
						<br>
						<a href="actualizarCartelera.php">Actualizar cartelera</a>
						<br>
						<a href="actualizarTarifas.php">Actualizar tarifas</a>
						<?php 
					}else if ($_SESSION["usuario"] && $_SESSION["admin"] == "no"){
				?>
						<a href="../Views/index.php">Inicio</a>
						<br>
						<a href="mostrarCartelera.php">Cartelera</a>
						<br>
						<a href="mostrarTarifas.php">Tarifas</a>
						<br>
						<a href="../Views/content/contacto.php">Contacto</a>
						<br>
						<a href="../Views/content/ubicacion.php">Ubicación</a>
						<br>
				<?php 
					}else{
				?>
						<a href="../Views/index.php">Inicio</a>
						<br>
						<a href="mostrarCartelera.php">Cartelera</a>
						<br>
						<a href="mostrarTarifas.php">Tarifas</a>
						<br>
						<a href="../Views/content/contacto.php">Contacto</a>
						<br>
						<a href="../Views/content/ubicacion.php">Ubicación</a>
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