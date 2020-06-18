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
	<script type="text/javascript" src="../Views/scripts/reserva.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../Views/styles/cartelera.css">
	<link rel="stylesheet" type="text/css" href="../Views/styles/style.css">
	<link rel="stylesheet" type="text/css" href="../Views/styles/valorar.css">
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


		<div class="container-fluid" >
			<div class="row">
				<div class="offset-lg-1 offset-xl-2 col-xs-6 col-md-4 col-lg-3 col-xl-2" id="pelicula1">
					<img src="<?php echo $peliculaSelected[0]->getPortada(); ?>" id="imagenPelicula" class="img-fluid">
				</div>
				<div class="col-xs-7 col-md-6 col-lg-5 col-xl-5" id="pelicula2">
					<h2 id="tituloPelicula"><?php echo $peliculaSelected[0]->getTitulo(); ?></h2>

					<span><?php echo $peliculaSelected[0]->getDuracion() ." min | ".$peliculaSelected[0]->getPais() ." | ".$peliculaSelected[0]->getGenero()." | ".$peliculaSelected[0]->getCalificacion(); ?></span>
					<br>
					<br>
					<br>
					<span>Sinopsis: <?php echo $peliculaSelected[0]->getSinopsis(); ?></span>
					<br>

					<form action="mostrarTickets.php" method="POST">
						<span>Fecha: </span>
						<select name="fecha" id="fecha">
							<option selected="selected" disabled="disabled">-- Seleccione --</option>
							<?php foreach ($fechas as $keyFechas => $valueFechas) {
							?>
								<option value="<?php  echo $fechas[$keyFechas]; ?>"><?php  echo $fechas[$keyFechas]; ?></option>
							<?php 
								}
							?>
						</select>
						<br>
						<span> Sala: </span>
						<select name="sala" id="sala">
						</select>
						<br>
						<span> Hora: </span>
						<select name="hora" id="hora">
						</select>
						<br>
						<span> Asientos: </span>
						<input type="number" name="asientos" min="1" max="" id="asientos">
						<br>
						<span> Precio: </span>
						<span id="precio"></span>
						<span> € / asiento </span>
						<br>
						<span id="precioTotal"></span>
						<br>
						<button type="submit" name="terminarReserva" id="terminarReserva" value="">Reservar</button>
					</form>
				</div>
				<div class="col-xs-5 col-md-2 col-lg-2 col-xl-1 text-right" id="pelicula3">
					<?php
						if (isset($_POST['valorar'])) {
							Valoracion::subirValoracion($_POST['valoracion'],$_SESSION["idUsuario"],$peliculaSelected[0]->getIdPelicula());
						}
					?>
								<form action="mostrarCartelera.php" method="POST">
									<fieldset class="valoracion">
									    <input type="radio" id="star5" name="valoracion" value="10" />
									    <label class = "full" for="star5" title="Excelente"></label>
									    <input type="radio" id="star4half" name="valoracion" value="9" />
									    <label class="half" for="star4half" title="Genial"></label>
									    <br>
									    <input type="radio" id="star4" name="valoracion" value="8" />
									    <label class = "full" for="star4" title="Muy bueno"></label>
									    <input type="radio" id="star3half" name="valoracion" value="7" />
									    <label class="half" for="star3half" title="Bueno"></label>
									    <br>
									    <input type="radio" id="star3" name="valoracion" value="6" />
									    <label class = "full" for="star3" title="Acceptable"></label>
									    <input type="radio" id="star2half" name="valoracion" value="5" />
									    <label class="half" for="star2half" title="Regular"></label>
									    <br>
									    <input type="radio" id="star2" name="valoracion" value="4" />
									    <label class = "full" for="star2" title="Regular bajo"></label>
									    <input type="radio" id="star1half" name="valoracion" value="3" />
									    <label class="half" for="star1half" title="Mal"></label>
									    <br>
									    <input type="radio" id="star1" name="valoracion" value="2" />
									    <label class = "full" for="star1" title="Muy mal"></label>
									    <input type="radio" id="starhalf" name="valoracion" value="1" />
									    <label class="half" for="starhalf" title="Desastroso"></label>
									</fieldset>
									<input type="submit" name="valorar" id="valorar" value="Valorar">
								</form>
				</div>
				<br>
				<br>
				<br>
			</div>
			<br>
			<br>
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