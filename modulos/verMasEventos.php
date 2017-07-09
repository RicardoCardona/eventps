<?php
	// Desicion para descartar errores
	try{
		// conexion a BD
		require "conexion.php";

		// consulta con Inner Join
		$sql=$conn->prepare('SELECT evento.idEvento, evento.nombreEvento, evento.fechaEvento, evento.horaInicio, evento.horaFin, evento.descripcionEvento, sitio.nombreSitio, ciudades.Ciudad FROM evento INNER JOIN sitio ON sitio.idSitio = evento.idSitio INNER JOIN ciudades ON ciudades.idCiudades = evento.idCiudad WHERE evento.estado = "activo" AND evento.idEvento = "'.$_REQUEST['idEvento'].'"');
		// array de varibales		
		$resultado=$sql->execute(array());
		// selección de resultados
		$resultado=$sql->fetchAll();
		// Conteo de cantidad de Resultados
		$num=$sql->rowCount();

		// decision de resultado
		if ($num>=1) {
			// Ciclo de muestra de Resultados
			foreach ($resultado as $fila) {
				// muestreo de Resultados
				echo '
					<div data-codigo="'.$fila['idEvento'].'" id="codigo"></div>
					<h3>'.$fila['nombreEvento'].'</h3>
					<hr>
					<section class="col-md-12">
						<article class="col-md-12">
							<div id="sliderEvento" class="col-md-5">
							
							</div>
							<div id="boleteria" class="col-md-6">

							</div>
						</article>

						<article class="col-md-12">
							<!--Contenedor-->
							<div class="col-md-12">
								<!--Pestañas-->
								<input type="radio" id="tab1" name="tabs" checked/>
								<input type="radio" id="tab2" name="tabs"/>

								<!--Titulos de Pestañas-->
								<label class="tabs" for="tab1">Datos Evento</label>
								<label class="tabs" for="tab2">Descripción</label>

								<!--Hoja de Pestaña 1-->
								<section class="tab-uno" id="hoja">
									<h3>'.$fila['nombreEvento'].'</h3>
									<article class="col-md-6">
											<p class="l">Artistas:</p><p id="artistas"></p>
											<p>Fecha: '.$fila['fechaEvento'].'</p>
											<p>Hora: '.$fila['horaInicio'].'</p>
											<p>Ciudad: '.$fila['Ciudad'].'</p>
											<p>Lugar: '.$fila['nombreSitio'].'</p>
									</article>
									
								</section>

								<!--Hoja de Pestaña 2-->
								<section class="tab-dos" id="hoja">
									<article>'.$fila['descripcionEvento'].'</article>
								</section>
							</div>
						</article>
					</section>
				';
			}
		}else{
			// muestreo de Resultados
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

	 // <div id="sliderSitio" class="col-md-6"> </div>
?>