<?php
	try{
		require "conexion.php";

		$id=$_POST['localidad'];

		$sql2=$conn->prepare('SELECT * FROM localidades WHERE idLocalidad = :P1');
		$resultado2=$sql2->execute(array('P1'=>$id));
		$resultado2=$sql2->fetchAll();
		$num2=$sql2->rowCount();

		if ($num2>=1) {
			foreach ($resultado2 as $fila) {
				$idLocalidad=$fila['idLocalidad'];
				$aforoDisponible=$fila['aforoDisponible'];
				$localidad=$fila['tipoLocalidad'];
			}
			$sql=$conn->prepare('SELECT * FROM ubicacion WHERE idLocalidad = :P1 AND estado = "activo" ORDER BY idUbicacion ASC');
			$resultado=$sql->execute(array('P1'=>$id));
			$resultado=$sql->fetchAll();
			$num=$sql->rowCount();

			if ($num>=1) {
				echo ' <button type="button" class="center-block btn btn-primary btn-lg btn-block">TARIMA</button><br>
						<table>';

				foreach ($resultado as $fila) {
					echo '	
							<tr class="col-md-1 col-sm-2 col-xs-2">
								<td class="ubicacion2" data-ubicacion="'.$fila['idUbicacion'].'">
									<button type="button" class="ubicacion btn btn-default btn-xs" data-toggle="button" aria-pressed="false" autocomplete="off">'.$fila['columna'].'-'.$fila['fila'].'</button>
								</td>
							</tr>
					';
				}
				echo '
					</table>';
			}else{
				echo '
					<div class="alert alert-danger alert-dismissable">
						No Existen Ubicaciones Actualmente
					</div>
				';
			}
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
		echo "ERROR: ".$e->getMessage();
		exit();
	}
?>