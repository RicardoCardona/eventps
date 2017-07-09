<?php
	try{
		require "conexion.php";

		$idArtista=$_REQUEST['idArtista'];

		$sql=$conn->prepare('SELECT imagenes.imagen, artistas.nombreArtista, artistas.informacionArtista FROM relacionimagenes INNER JOIN imagenes ON imagenes.idImagen = relacionimagenes.idImagen INNER JOIN artistas ON artistas.idArtista = relacionimagenes.idArtista WHERE relacionimagenes.tipoImagen="principal" AND artistas.idArtista = :P1');
		$resultado=$sql->execute(array('P1'=>$idArtista));
		$resultado=$sql->fetchAll();
		$num=$sql->rowCount();

		if ($num>=1) {
			foreach ($resultado as $fila) {
				echo '
					<article class="col-md-12">
						<h1 class="col-md-12" style="text-transform: uppercase;">'.$fila['nombreArtista'].'</h1>
  						<img src="AdministracionEventos/img/'.$fila['imagen'].'" class="col-md-6">
  						<p class="col-md-6 parrafoArtista" style="text-align: justify;">'.nl2br($fila['informacionArtista']).'</p>
					<article>
				';				
			}
		}else{
			echo '<h2>No Existen Informacion del Artista Actualmente</h2>';
		}
		$conn=NULL;		
	}catch(PDOException $e){
		echo "ERROR: ".$e->getMessage();
		exit();
	}
?>