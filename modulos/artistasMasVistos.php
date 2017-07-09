<?php
	try{
		require "conexion.php";

		$sql=$conn->prepare('SELECT imagenes.imagen, artistas.nombreArtista, artistas.idArtista FROM relacionimagenes INNER JOIN imagenes ON imagenes.idImagen = relacionimagenes.idImagen INNER JOIN artistas ON artistas.idArtista = relacionimagenes.idArtista WHERE relacionimagenes.tipoImagen="principal" AND artistas.estado = "activo" AND artistas.masVisto = "si"');
		$resultado=$sql->execute(array());
		$resultado=$sql->fetchAll();
		$num=$sql->rowCount();

		if ($num>=1) {
			foreach ($resultado as $fila) {
				if (strlen($fila['nombreArtista']) >= 15) {
					echo '
						<article class="contenedorArtista">
	  						<img src="AdministracionEventos/img/'.$fila['imagen'].'" class="imagenArtista">
	  						<h3 class="nombreArtista">'.substr($fila['nombreArtista'], 0, 14).'..</h3></center>
	  						<a class="verMasArtista" href="verMasArtistas.php?idArtista='.$fila['idArtista'].'">Ver Más</a>
	  						<br>
	  						<button type="button" class="contratarArtista">CONTRATAR</button>
						</article>
					';
				}else{
					echo '
						<article class="contenedorArtista">
	  						<img src="AdministracionEventos/img/'.$fila['imagen'].'" class="imagenArtista">
	  						<h3 class="nombreArtista">'.$fila['nombreArtista'].'</h3></center>
	  						<a class="verMasArtista" href="verMasArtistas.php?idArtista='.$fila['idArtista'].'">Ver Más</a>
	  						<br>
	  						<button type="button" class="contratarArtista">CONTRATAR</button>
						</article>
					';
				}
			}
		}else{
			echo '<h2>No Existen Imagenes Actualmente</h2>';
		}
		$conn=NULL;		
	}catch(PDOException $e){
		echo "ERROR: ".$e->getMessage();
		exit();
	}
?>