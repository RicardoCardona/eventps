<?php
	try{
		date_default_timezone_set('America/Bogota');

		require "conexion.php";

		$fechaHoy=date('Y-m-d');

		$sql=$conn->prepare('SELECT artistas.nombreArtista, ciudades.Ciudad, evento.fechaEvento FROM artistaevento INNER JOIN evento ON evento.idEvento = artistaevento.idEvento INNER JOIN artistas ON artistas.idArtista = artistaevento.idArtista INNER JOIN ciudades ON ciudades.idCiudades = evento.idCiudad WHERE evento.fechaFinPublicacion >= :P1 AND evento.estado = "activo" AND evento.tipoEvento = "publico" LIMIT 9');
		$resultado=$sql->execute(array('P1'=>$fechaHoy));
		$resultado=$sql->fetchAll();
		$num=$sql->rowCount();

		//operación de caluclo
		if ($num>=1) {
			echo '				
				<table class="table">
                    <tr>
                    	<th>ARTISTAS</th>
                    	<th>LUGAR</th>
                    	<th>FECHA Y HORA</th>
                    </tr>
			';
			foreach ($resultado as $fila) {
				echo '
					<tr>						
						<td class="activeH" style="text-transform: uppercase; font-size: 1.3em;">'.$fila['nombreArtista'].'</td>
						<td>'.$fila['Ciudad'].'</td>
						<td>'.$fila['fechaEvento'].'</td>				
					</tr>
				';
			}
			echo '
				</table>
			';
		}else{
			echo '
				<h3>Todavia No Se Han Ingresado Eventos</h3>
			';
		}
		$conn=NULL; //Cerrar la Conexión
	}catch(PDOException $e){
		echo "ERROR: ".$e->getMessage();
		exit();
	}
?>