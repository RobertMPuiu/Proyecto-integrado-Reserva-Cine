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
						<li><a href="mostrarCartelera.php">Cartelera</a></li>
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
			<?php if (isset($_POST['anadirProyeccion'])) {
											if (empty($proyeccionNoDisponible)) {
								?>
												<span style="color:green; text-align: center;"> <?php echo $mensaje; ?></span>
								<?php
											}else{
								?> 
												<span style="color:red; text-align: center;"> <?php echo $mensaje; ?></span>
								<?php
											}
										} 
								?>		
			<?php 
				foreach ($obtenerPeliculas as $key => $value) {
					if ($obtenerPeliculas[$key]->getVisible()=="si"){
						$obtenerFechas=Proyeccion::getFechas($obtenerPeliculas[$key]->getIdPelicula());

			?>
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
							<div class="row" id="recuadroPelicula">
								<div class="offset-lg-1 offset-xl-3 col-xs-6 col-md-4 col-lg-3 col-xl-2" id="pelicula1">
									<img src="<?php echo $obtenerPeliculas[$key]->getPortada(); ?>" id="imagenPelicula" class="img-fluid">
								</div>
								<div class="col-xs-6 col-md-5 col-lg-4 col-xl-3" id="pelicula2">
									<h2 id="tituloPelicula"><?php echo $obtenerPeliculas[$key]->getTitulo(); ?></h2>
									<div class="form-group ">
									 	<input type="hidden" name="idOculto" id="idOculto" value="<?php echo $obtenerPeliculas[$key]->getIdPelicula(); ?>" class="form-control">
									</div>
									<?php	
										foreach ($obtenerFechas as $keyFecha => $valueFecha){

											$obtenerSalas=Proyeccion::getSalas($obtenerPeliculas[$key]->getIdPelicula(),$valueFecha);
									?>
											<div class="form-group ">
						                    	<label for="fechaOculta">Dia : <?php echo $obtenerFechas[$keyFecha]; ?></label>
						                    	<input type="hidden" name="fechaOculta" id="fechaOculta" value="<?php echo $obtenerFechas[$keyFecha]; ?>" class="form-control">
						                 	</div>
					 						<?php 
					 							foreach ($obtenerSalas as $keySala => $valueSala) {
					 								$obtenerHoras=Proyeccion::getHoras($obtenerPeliculas[$key]->getIdPelicula(),$valueFecha,$valueSala);
					 						?>
									                    <span id="salaCartelera">Sala nº <?php echo $obtenerSalas[$keySala]; ?>: </span>
									                    <input type="hidden" name="salaOculta" id="salaOculta" value="<?php echo $obtenerSalas[$keySala]; ?>" class="form-control">

	                  								<?php 
	                  									foreach ($obtenerHoras as $keyHora => $valueHora) { 
	                  								?>
										                    	<span id="horaCartelera"><?php echo $obtenerHoras[$keyHora]; ?></span>
										                    	<input type="hidden" name="horaOculta" id="horaOculta" value="<?php echo $obtenerHoras[$keyHora]; ?>" class="form-control">
	              									<?php 
	              										}
	              										?><hr><?php  
	             								} 
	                  					} 
	                  				?>
								</div>
								<div class="col-xs-6 col-md-3 col-lg-3 col-xl-1 text-right" id="pelicula3">
									<input name="eliminar" id="eliminar" class="btn btn-primary" type="submit" value="Eliminar">
								</div>
							</div>
						</form>
					<?php
					}
				}
			?>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="offset-lg-1 offset-xl-3 col-xs-12 col-md-10 col-lg-10 col-xl-8" id="peliculaVisibilidad">
								<div class="form-group">
									<select name="seleccion">
										<?php foreach ($peliculasNoVisibles as $keyPvisibles => $valuePvisibles) {
										 ?>
										<option value="<?php  echo $peliculasNoVisibles[$keyPvisibles]->getIdPelicula(); ?>"><?php echo $peliculasNoVisibles[$keyPvisibles]->getTitulo();  ?></option>
										<?php 
											}
										?>
									</select>	
									<input name="anadir" id="anadir" class="btn btn-primary  login-btn mb-4" type="submit" value="Añadir a cartelera">	
								</div>
				</div>
			</form>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="offset-lg-1 offset-xl-3 col-xs-12 col-md-10 col-lg-10 col-xl-8" id="peliculaVisibilidad">
								<div class="form-group">
									<select name="seleccionProyec">
										<?php foreach ($obtenerPeliculas as $keyPvisibles => $valuePvisibles) {
										 ?>
										<option value="<?php  echo $obtenerPeliculas[$keyPvisibles]->getIdPelicula(); ?>"><?php echo $obtenerPeliculas[$keyPvisibles]->getTitulo();  ?></option>
										<?php 
											}
										?>
									</select>		
							            <label for="fechaProyec">Fecha: </label>
							            <select name="fechaProyec">
							            	<?php for ($j=0; $j<=14; $j++) { 
							            		?>
							            		<option value="<?php echo date('Y-m-d',strtotime($fechaActual.'+'.$j.' days')); ?>"><?php echo date("Y-m-d",strtotime($fechaActual."+".$j." days")); ?></option>
							            		<?php
							            	} ?>
							            </select>
							            <label for="salaProyec">Sala: </label>
							            <select name="salaProyec">
							            	<?php for ($j=1; $j<=10; $j++) { 
							            		?>
							            		<option value="<?php echo $j; ?>">Sala nº <?php echo $j; ?></option>
							            		<?php
							            	} ?>
							            </select>
							            <label for="horaProyec">Hora: </label>
							            <select name="horaProyec">
							            	<?php foreach ($horasDisponibles as $keyHoraDisp=>$valueHoraDisp) {
							            		?>
							            		<option value="<?php echo $horasDisponibles[$keyHoraDisp]; ?>"><?php echo $horasDisponibles[$keyHoraDisp]; ?></option>
							            		<?php
							            	} ?>
							            </select>    
								<input name="anadirProyeccion" id="anadirProyeccion" class="btn btn-primary  login-btn mb-4" type="submit" value="Añadir proyeccion">
								
								</div>
				</div>
			</form>
			
			<table class="table">
				  <thead>
				    <tr>
				      <th scope="col">Id de Proyeccion</th>
				      <th scope="col">Fecha</th>
				      <th scope="col">Hora</th>
				      <th scope="col">Butacas Disponibles</th>
				      <th scope="col">Sala</th>
				      <th scope="col">Pelicula</th>
				      <th scope="col">Tipo de entrada</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 
						foreach ($mostrarProyecciones as $key => $value) {
				  	?>
				  	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				  		 <tr>
					    	<td>
					    		<div class="form-group">
	                    			<input type="text" name="idProyeccion" id="idProyeccion" class="form-control" value="<?php echo $mostrarProyecciones[$key]->getIdProyeccion(); ?>" readonly="readonly">
	                 		 	</div>
					    	</td>
					    	<td>
					    		<div class="form-group">
				                    <input type="text" name="fecha" id="fecha" class="form-control" value="<?php echo $mostrarProyecciones[$key]->getFecha(); ?>">
				                </div>
					    	</td>
					    	<td>
					    		<div class="form-group">
	                    			<input type="text" name="hora" id="hora" class="form-control" value="<?php echo $mostrarProyecciones[$key]->getHora(); ?>">
	                  			</div>
					    	</td>
					    	<td>
					    		<div class="form-group">
	                    			<input type="text" name="disponibles" id="disponibles" class="form-control" value="<?php echo $mostrarProyecciones[$key]->getDisponibles(); ?>">
	                  			</div>
					    	</td>
					    	<td>
					    		<div class="form-group">
	                    			<input type="text" name="sala" id="sala" class="form-control" value="<?php echo $mostrarProyecciones[$key]->getSala(); ?>">
	                  			</div>
					    	</td>
					    	<td>
					    		<div class="form-group">
	                    			<input type="text" name="pelicula" id="pelicula" class="form-control" value="<?php echo $mostrarProyecciones[$key]->getIdPelicula(); ?>">
	                  			</div>
					    	</td>
					    	<td>
					    		<div class="form-group">
	                    			<input type="text" name="tipoEntrada" id="tipoEntrada" class="form-control" value="<?php echo $mostrarProyecciones[$key]->getTipoEntrada(); ?>">
	                  			</div>
					    	</td>
					    	<td>
					    		<input name="actualizarProyeccion" id="actualizarProyeccion" class="btn btn-primary" type="submit" value="Actualizar">
					    		<input name="eliminarProyeccion" id="eliminarProyeccion" class="btn btn-primary" type="submit" value="Eliminar">
					    	</td>
					    </tr>
					</form>
				    <?php 
						}
				    ?>
				  </tbody>
				</table>
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