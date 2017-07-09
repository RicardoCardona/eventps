<?php
	// Desicion para descartar errores
	try{
		// conexion a BD
		require "conexion.php";

		// Variable
		$codigo=$_POST['codigo'];

		// consulta
		$sql=$conn->prepare('SELECT imagenes.imagen, relacionimagenes.idEvento FROM relacionimagenes INNER JOIN imagenes ON imagenes.idImagen = relacionimagenes.idImagen WHERE relacionimagenes.idEvento = :P1');
		// array de varibales
		$resultado=$sql->execute(array('P1'=>$codigo));
		// selección de resultados
		$resultado=$sql->fetchAll();
		// Conteo de cantidad de Resultados
		$num=$sql->rowCount();

		// decision de resultado
		if ($num>=1) {
			// Dato necesario no repetible sin resultado PHP, se usa para titulos su Enfoque es de "diseño".
			echo ' 		
					<article>
						<!-- SLIDER -->
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
								<!-- imagenes slider -->
								<div class="carousel-inner" role="listbox">
				';

			// Ciclo de muestra de Resultados
			$active="active";
			foreach ($resultado as $fila) {
				// muestreo de Resultados
				echo '
						<div class="item '.$active.'">
  							<img src="AdministracionEventos/img/'.$fila['imagen'].'">
						</div>
				';
				$active="";				
			}
			// Dato necesario no repetible sin resultado PHP, se usa para titulos su Enfoque es de "diseño".
			echo '
						<!-- Controles -->
						<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</article>
			';
		}else{
			echo '
				<div class="alert alert-danger alert-dismissable">
					No Existen Ubicaciones Actualmente
				</div>
			';
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