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
	<script type="text/javascript" src="../Views/scripts/trailer.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../Views/styles/cartelera.css">
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
						<li><a href="mostrarTarifas.php">Tarifas</a></li>
						<li><a href="../Views/content/contacto.php">Contacto</a></li>
						<li><a href="../Views/content/ubicacion.php">Ubicación</a></li>
			<?php 
				}else{
			?>
			<li><a href="../Views/index.php">Inicio</a></li>
			<li><a href="mostrarTarifas.php">Tarifas</a></li>
			<li><a href="../Views/content/contacto.php">Contacto</a></li>
			<li><a href="../Views/content/ubicacion.php">Ubicación</a></li>
			<?php 
				}
			?>
		</ul>
	</nav>
	<main>
		<?php
		/*
		*	bucle para listar las distintas peliculas que tengan Visible="si"
		*/
			foreach ($mostrar as $key => $value) {
				if ($mostrar[$key]->getVisible()=="si"){
		?>
					<div class="container-fluid" >
						<div class="row" id="recuadroPelicula">
							<div class="offset-lg-1 offset-xl-3 col-xs-6 col-md-4 col-lg-3 col-xl-2" id="pelicula1">
								<img src="<?php echo $mostrar[$key]->getPortada(); ?>" id="imagenPelicula" class="img-fluid">
							</div>
							<div class="col-xs-6 col-md-5 col-lg-4 col-xl-3" id="pelicula2">
								<h2 id="tituloPelicula"><?php echo $mostrar[$key]->getTitulo(); ?></h2>
								<span><?php echo $mostrar[$key]->getDuracion() ." | ".$mostrar[$key]->getPais() ." | ".$mostrar[$key]->getGenero()." | ".$mostrar[$key]->getCalificacion(); ?></span>
								<br>
								<span><?php echo $mostrar[$key]->getReparto(); ?></span>
								<br>
								<span><?php echo $mostrar[$key]->getDirector(); ?></span>
								<br>
								<br>
								<br>
								<br>
								<?php
								/*
								*	bucle para listar las horas disponibles para la proyeccion de la pelicula
								*/
									foreach ($horas as $keyHora => $valueHora) {
										if ($horas[$keyHora]->getIdPelicula() == $mostrar[$key]->getIdPelicula()){	
								?>
								<span id="horario" class="mt-2 mb-2"><?php echo $horas[$keyHora]->getHora();  ?></span>
								<?php
										}
									}
								?>
							</div>
							<div class="col-xs-6 col-md-3 col-lg-3 col-xl-1 text-right" id="pelicula3">
								<div class="mt-2">
									 <?php 
									 	/*
										*	bucle para calcular la valoración de la pelicula
										*/
										$valor = 0;
										$cantidadValoraciones=0;
										foreach ($valoracion as $keyValor => $valueValor) {
											if($valoracion[$keyValor]->getIdPelicula() == $mostrar[$key]->getIdPelicula()){
													$valor=$valor + $valoracion[$keyValor]->getValoracion();
													$cantidadValoraciones++;
											}
										}
										if ($cantidadValoraciones > 0) {
									?>
											<span  id="valoracion"><?php echo  $valor/$cantidadValoraciones;?></span>
									<?php
									 	} else { 
									?>
											<span  id="valoracion">0.0</span>
									<?php
										} 
									?>	
								</div>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<input type="hidden" name="linktrailer" value="<?php echo $mostrar[$key]->getTrailer(); ?>" class="mostrarTrailer">
								<input type="button" name="trailer" class="trailer" value="Trailer">
							</div>
						</div>
					</div>
		<?php
				}
			}
		?>
		<div id="popup-trailer" style="display: none;">
			<div class="content-popup-trailer">
			    <div class="close-trailer">x</div>
			    <div class="container-fluid" id="trailer1"></div>
			</div>
		</div>
		<div class="popup-overlay-trailer"></div>	
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