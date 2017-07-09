<?php
	try{
		require "conexion.php";

		$sql=$conn->prepare('SELECT imagenes.imagen FROM relacionimagenes INNER JOIN imagenes ON imagenes.idImagen = relacionimagenes.idImagen WHERE relacionimagenes.slider = "si"');
		$resultado=$sql->execute(array());
		$resultado=$sql->fetchAll();
		$num=$sql->rowCount();

		if ($num>=1) {
			echo ' 		
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<!-- imagenes slider -->
						<div class="carousel-inner" role="listbox">
				';

			$active="active";
			foreach ($resultado as $fila) {
				echo '
							<div class="item '.$active.'">
  								<img src="AdministracionEventos/img/'.$fila['imagen'].'">
							</div>
				';
				$active="";				
			}
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
					</div>
					<br>
				';
		}
		// else{
		// 	echo '
		// 		<h2>No Existen Imagenes Actualmente</h2>
		// 	';
		// }
		$conn=NULL;		
	}catch(PDOException $e){
		echo "ERROR: ".$e->getMessage();
		exit();
	}
?>