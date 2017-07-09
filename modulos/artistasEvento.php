<?php
	// Desicion para descartar errores
	try{
		// conexion a BD
		require "conexion.php";

		// Variable
		$id=$_POST['codigo'];

		// consulta
		$sql=$conn->prepare('SELECT artistas.nombreArtista FROM artistaevento INNER JOIN artistas ON artistas.idArtista = artistaevento.idArtista WHERE artistaevento.idEvento = :P1');
		// array de varibales
		$resultado=$sql->execute(array('P1'=>$id));
		// selección de resultados
		$resultado=$sql->fetchAll();
		// Conteo de cantidad de Resultados
		$num=$sql->rowCount();

		// decision de resultado
		if ($num>=1) {
			// Ciclo de muestra de Resultados
			foreach ($resultado as $fila) {
				if ($num == 1) {
					echo $fila['nombreArtista'];
				}else{
					echo $fila['nombreArtista'] .',';
				}				
			}
		}else{
			echo 'No Existen Artistas Actualmente';
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