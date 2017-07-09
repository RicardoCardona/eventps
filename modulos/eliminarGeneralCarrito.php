<?php
	try{
		require "conexion.php";

		$codigoEliminar=$_POST['codigoEliminar'];
		$localidaGeneral=$_POST['localidaGeneral'];

		$sql2=$conn->prepare('SELECT * FROM localidades WHERE idLocalidad = :P1');
		$resultado2=$sql2->execute(array('P1'=>$localidaGeneral));
		$resultado2=$sql2->fetchAll();
		$num2=$sql2->rowCount();

		if ($num2>=1) {
			foreach ($resultado2 as $fila) {					
				$idLocalidad=$fila['idLocalidad'];
				$aforoDisponible=$fila['aforoDisponible'];
			}
			$sql=$conn->prepare('DELETE FROM buffercarrito WHERE idBuffer = :P1');
			$resultado=$sql->execute(array('P1'=>$codigoEliminar));
			$num=$sql->rowCount();
			
			if ($num>=1) {
				$restaBoletas=$aforoDisponible+1;
				$sql4=$conn->prepare('UPDATE localidades SET aforoDisponible = :P2 WHERE idLocalidad = :P1');
				$resultado4=$sql4->execute(array('P1'=>$idLocalidad, 'P2'=>$restaBoletas));
				$num4=$sql4->rowCount();

				if ($num4>=1) {
					echo '
						<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							Boleto Eliminado Correctamente del Carrito.
						</div>
					';
				}else{
					echo '
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							No Se Puedo Eliminar El Boleto Del Carrito
						</div>
					';
				}
			}else{
				echo '
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						No Se Puedo Eliminar El Boleto Del Carrito
					</div>
				';
			}
		}else{
			echo '
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					Error Inesperado
				</div>
			';
		}
		$conn=NULL; //Cerrar la Conexión
	}catch(PDOException $e){
		echo "ERROR: ".$e->getMessage();
		exit();
	}
?>