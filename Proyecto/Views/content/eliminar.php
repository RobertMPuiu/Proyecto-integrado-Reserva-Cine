<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>FilmZona</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="../Views/scripts/menu.js"></script>
	<script type="text/javascript" src="../Views/scripts/eliminar.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../Views/styles/eliminar.css">
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
	                    <label for="Imagen portada">Película</label>
	                    <select class="form-control" id="eleccion" name="eleccion">
	                    	<option value="-1" disabled="disabled">--Seleccione--</option>
	                    	<?php
	                    	/*
							*	bucle para listar las peliculas
							*/
								foreach ($mostrar as $key => $value) {
							?>
	                    	<option value="<?php echo $mostrar[$key]->getIdPelicula(); ?>"><?php echo $mostrar[$key]->getTitulo(); ?></option>
	                    	<?php
								}
							?>
	                    </select>
	                  </div>
	                  <input name="eliminar" id="eliminar" class="btn btn-primary  login-btn mb-4" type="submit" value="Eliminar Pelicula" disabled="disabled">
	                </form>
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