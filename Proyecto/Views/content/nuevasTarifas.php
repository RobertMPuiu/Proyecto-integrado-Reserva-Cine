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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../Views/styles/tarifas.css">
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
				<span><a href="">Cerrar Sesión</a></span>
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
				<div class=" offset-lg-2 offset-xl-3 col-xs-6 col-md-12 col-lg-8 col-xl-6">
				<table class="table">
				  <thead>
				    <tr>
				      <th scope="col">Tipo de entrada</th>
				      <th scope="col">Descripcion</th>
				      <th scope="col">Precio</th>
				      <th scope="col">Acciones</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 
						foreach ($mostrar as $key => $value) {
				  	?>
				  	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				  		 <tr>
					    	<td>
					    		<div class="form-group">
	                    			<input type="text" name="tipoEntradaA" id="tipoEntradaA" class="form-control" value="<?php echo $mostrar[$key]->getTipoEntrada(); ?>" readonly="readonly">
	                 		 	</div>
					    	</td>
					    	<td>
					    		<div class="form-group">
				                    <input type="text" name="definicionA" id="definicionA" class="form-control" value="<?php echo $mostrar[$key]->getDefinicion(); ?>">
				                </div>
					    	</td>
					    	<td>
					    		<div class="form-group">
	                    			<input type="text" name="precioA" id="precioA" class="form-control" value="<?php echo $mostrar[$key]->getPrecio(); ?>">
	                  			</div>
					    	</td>
					    	<td>
					    		<input name="actualizar" id="actualizar" class="btn btn-primary" type="submit" value="Actualizar">
					    		<input name="eliminar" id="eliminar" class="btn btn-primary" type="submit" value="Eliminar">
					    	</td>
					    </tr>
					</form>
				    <?php 
						}
				    ?>
				    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					    <tr>
					    	<td>
					    		<div class="form-group">
	                    			<input type="text" name="tipoEntradaS" id="tipoEntradaS" class="form-control" placeholder="Tipo de entrada">
	                 		 	</div>
					    	</td>
					    	<td>
					    		<div class="form-group">
				                    <input type="text" name="definicionS" id="definicionS" class="form-control" placeholder="Definicion de la tarifa">
				                </div>
					    	</td>
					    	<td>
					    		<div class="form-group">
	                    			<input type="text" name="precioS" id="precioS" class="form-control" placeholder="Precio">
	                  			</div>
					    	</td>
					    	<td>
					    		<input name="insertar" id="insertar" class="btn btn-primary" type="submit" value="Insertar">
					    	</td>
					    </tr>
				    </form>
				  </tbody>
				</table>
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