<?php
	// Desicion para descartar errores
	try{
		// conexion a BD
		require "conexion.php";

		$codigoEliminar=$_POST['codigoEliminar'];
		$estado="activo";

		$sql=$conn->prepare('SELECT * FROM buffercarrito WHERE idBuffer = :P1');
		$resultado=$sql->execute(array('P1'=>$codigoEliminar));
		$resultado=$sql->fetchAll();
		$num=$sql->rowCount();

		if ($num>=1) {
			foreach ($resultado as $fila) {
				$fila['idUbicacion'];
			}
			$sql2=$conn->prepare('UPDATE ubicacion SET estado = :P1 WHERE idUbicacion = :P2');		
			$resultado2=$sql2->execute(array('P1'=>$estado, 'P2'=>$fila['idUbicacion']));
			$num2=$sql2->rowCount();

			if ($num2>=1) {
				$sql3=$conn->prepare('DELETE FROM buffercarrito WHERE idBuffer = :P1');
				$resultado3=$sql3->execute(array('P1'=>$codigoEliminar));
				$num3=$sql3->rowCount();
			}	
			echo '
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					Boleto Eliminado Correctamente del Carrito
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

		$conn=NULL; //Cerrar la Conexión
	}catch(PDOException $e){
		echo "ERROR: ".$e->getMessage();
		exit();
	}
?>