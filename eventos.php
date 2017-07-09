<!--
	Compañía: Bynary01
	Autor: Ricardo Cardona
	Sistema: 2park
	Fecha: 25/09/2016
	Descripción: Index Midnight	
-->
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<title>EVENTOS | MIDNIGHT</title>
	<!-- Favicon -->
	<link rel="shortcut icon" href="img/plantilla/favicon.png">
	<!-- fuente -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Oswald" rel="stylesheet">
	<!-- estilos bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- estilos libres css -->
	<link rel="stylesheet" href="css/estilo.css">
	<!-- conexion jquery -->
	<script src="js/jquery.min.js"></script>
	<!-- conexion bootstrap js-->
	<script src="js/bootstrap.min.js"></script>
	<!-- codigo libre js-->
	<script src="js/codigo.js"></script>
	<!-- js Menú Pegajoso -->
	<script type="text/javascript" src="js/sticky_menu.js"></script>
</head>
<body>
	<div id="body2">
		<!-- Boton Carrito -->
		<div id="caja"></div>
		<div id="caja2" class="hidden-xs hidden-md">
			<a href="carrito.php" id="carrito"><img src="img/plantilla/carrito.png"></a>
		</div>

		<!-- contenedor -->
		<div class="container">
			<header class="col-md-12">
				<div class="navegador">
					<!-- logo -->
					<a href="index.php"><img src="img/plantilla/logo.png" class="col-md-3"></a>
					<!-- menu -->
					<nav role="navigation" class="col-md-9">
					    <div class="navbar-header">
					        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle btn btn-lg">
					            <span class="glyphicon glyphicon-menu-hamburger"></span>
					        </button>
					    </div> 
					    <div id="navbarCollapse" class="collapse navbar-collapse">
					        <ul class="navbar-nav" id="menu">
					            <li><a href="index.php">INICIO</a></li>
					            <li><a href="quienSomos.php">QUIÉNES SOMOS</a></li>
					            <li><a href="artistas.php">ARTISTAS</a></li>
					            <li><a href="contratacion.php">CONTRATACIÓN</a></li>
					            <li><a href="eventos.php" class="active">EVENTOS</a></li>
					            <li><a href="contactenos.php">CONTÁCTENOS</a></li>
					        </ul>
					    </div>
					</nav>
				</div>
			</header>
			<section class="col-md-12 center">
				<h1>EVENTOS</h1>
				<?php
					// Desicion para descartar errores
					try{
						// Zona Horaria Bogota Colombia
						date_default_timezone_set('America/Bogota');
		
						// conexion a BD
						require "modulos/conexion.php";

						// Variable
						$fechaHoy=date('Y-m-d');

						// consulta con Inner Join
						$sql=$conn->prepare('SELECT relacionimagenes.idrelacionImagenes, evento.idEvento, evento.nombreEvento, evento.horaInicio, evento.fechaEvento, imagenes.imagen, imagenes.nombreImagen, sitio.nombreSitio, ciudades.Ciudad FROM relacionimagenes INNER JOIN evento ON evento.idEvento = relacionimagenes.idEvento INNER JOIN imagenes ON imagenes.idImagen = relacionimagenes.idImagen INNER JOIN sitio ON sitio.idSitio = evento.idSitio INNER JOIN ciudades ON ciudades.idCiudades = evento.idCiudad WHERE evento.estado = "activo" AND evento.fechaFinPublicacion >= :P1 AND relacionimagenes.tipoImagen = "principal" AND evento.tipoEvento = "venta" ORDER BY evento.idEvento DESC');
						// array de varibales
						$resultado=$sql->execute(array('P1'=>$fechaHoy));
						// selección de resultados
						$resultado=$sql->fetchAll();
						// Conteo de cantidad de Resultados
						$num=$sql->rowCount();

						// decision de resultado
						if ($num>=1) {
							// Ciclo de muestra de Resultados
							foreach ($resultado as $fila) {
								// muestreo de Resultados
								if (strlen($fila['nombreEvento']) >= 15) {
									echo '
										<div class="portfolio-group">
											<a class="portfolio-item" href="evento.php?idEvento='.$fila['idEvento'].'">
												<img src="AdministracionEventos/img/'.$fila['imagen'].'" alt="image 1" 	width="250px" height="250px">
												<div class="detail">
													<h3>'.substr($fila['nombreEvento'], 0, 14).'..</h3>
													<p><strong>Fecha: </strong>'.$fila['fechaEvento'].'</p>
													<p><strong>Hora: </strong>'.$fila['horaInicio'].'</p>
													<p><strong>Ciudad: </strong>'.$fila['Ciudad'].'</p>
													<p><strong>Lugar: </strong>'.$fila['nombreSitio'].'</p>
													<button class="btn btn-success btn-sm">Ver Mas</button>
												</div>
											</a>
										</div>
									';					
								}else{
									echo '
										<div class="portfolio-group">
											<a class="portfolio-item" href="evento.php?idEvento='.$fila['idEvento'].'">
												<img src="AdministracionEventos/img/'.$fila['imagen'].'" alt="image 1" width="250px" height="250px">
												<div class="detail">
													<h3>'.$fila['nombreEvento'].'</h3>
													<p><strong>Fecha: </strong>'.$fila['fechaEvento'].'</p>
													<p><strong>Hora: </strong>'.$fila['horaInicio'].'</p>
													<p><strong>Ciudad: </strong>'.$fila['Ciudad'].'</p>
													<p><strong>Lugar: </strong>'.$fila['nombreSitio'].'</p>
													<button class="btn btn-success btn-sm">Ver Mas</button>
												</div>
											</a>
										</div>
									';
								}
							}
						}else{
							echo '<h5>No Existen Eventos Actualmente</h5>';
						}
						//Cerrar la Conexión
						$conn=NULL;		
					}catch(PDOException $e){
						//decision de errores
						echo "ERROR: ".$e->getMessage();
						//salida
						exit();
					}
				?>
			</section>
			<footer class="col-md-12">
				<br><br>
				<p class="col-md-3">APLICA RESTRICCIONES TÉRMINOS Y CONDICIONES MIDNIGHT <a href="AdministracionEventos/index.php">Panel</a></p>
				<p class="col-md-3"><img src="img/plantilla/logo.png" width="100%"></p>
				<p class="col-md-3">SI TIENES ALGUNA INQUIETUD CONTACTENOS</p>
				<p class="col-md-3">TEL: (57 1) 656 3653 CARRERA 50 #100-88  - BOGOTÁ</p>
			</footer>
		</div>		
	</div>
</body>
</html>
