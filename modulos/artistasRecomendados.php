<?php
	try{
		require "conexion.php";

		$sql=$conn->prepare('SELECT imagenes.imagen, artistas.nombreArtista, artistas.idArtista FROM relacionimagenes INNER JOIN imagenes ON imagenes.idImagen = relacionimagenes.idImagen INNER JOIN artistas ON artistas.idArtista = relacionimagenes.idArtista ORDER BY RAND() LIMIT 5');
		$resultado=$sql->execute(array());
		$resultado=$sql->fetchAll();
		$num=$sql->rowCount();

		if ($num>=1) {
			foreach ($resultado as $fila) {
				if (strlen($fila['nombreArtista']) >= 6) {
					echo '
						<div id="recomendados">
							<div>
								<img src="AdministracionEventos/img/'.$fila['imagen'].'">
							</div>
							<div>
								<h4>'.substr($fila['nombreArtista'], 0, 6).'..</h4>
								<a class="activeH" href="verMasArtistas.php?idArtista='.$fila['idArtista'].'">Ver Más</a>
							</div>
						</div>
					';
				}else{					
					echo '
						<div id="recomendados">
							<div>
								<img src="AdministracionEventos/img/'.$fila['imagen'].'">
							</div>
							<div>
								<h4>'.$fila['nombreArtista'].'</h4>
								<a class="activeH" href="verMasArtistas.php?idArtista='.$fila['idArtista'].'">Ver Más</a>
							</div>
						</div>
					';
				}
			}
		}
		// else{
		// 	echo '
		// 		<h2>No Existen Artistas Recomendados Actualmente</h2>
		// 	';
		// }
		$conn=NULL;		
	}catch(PDOException $e){
		echo "ERROR: ".$e->getMessage();
		exit();
	}
?>
