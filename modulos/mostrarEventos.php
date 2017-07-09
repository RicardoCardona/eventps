<?php
	// Desicion para descartar errores
	try{
		// Zona Horaria Bogota Colombia
		date_default_timezone_set('America/Bogota');
		
		// conexion a BD
		require "conexion.php";

		// Variable
		$fechaHoy=date('Y-m-d');

		// consulta con Inner Join
		$sql=$conn->prepare('SELECT relacionimagenes.idrelacionImagenes, evento.idEvento, evento.nombreEvento, evento.horaInicio, evento.fechaEvento, imagenes.imagen, imagenes.nombreImagen, sitio.nombreSitio, ciudades.Ciudad FROM relacionimagenes INNER JOIN evento ON evento.idEvento = relacionimagenes.idEvento INNER JOIN imagenes ON imagenes.idImagen = relacionimagenes.idImagen INNER JOIN sitio ON sitio.idSitio = evento.idSitio INNER JOIN ciudades ON ciudades.idCiudades = evento.idCiudad WHERE evento.estado = "activo" AND evento.tipoEvento = "venta" AND evento.fechaFinPublicacion >= :P1 AND relacionimagenes.tipoImagen = "principal" ORDER BY evento.idEvento DESC LIMIT 4');
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
								<img src="AdministracionEventos/img/'.$fila['imagen'].'" alt="image 1" width="250px" height="250px">
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
		}
		// else{
		// 	echo '<h5>No Existen Eventos Actualmente</h5>';
		// }

		//Cerrar la Conexión
		$conn=NULL;		
	}catch(PDOException $e){
		//decision de errores
		echo "ERROR: ".$e->getMessage();
		//salida
		exit();
	}
?>