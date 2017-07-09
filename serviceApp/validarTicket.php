<?php
	try{

		if (isset($_REQUEST['codigoTicket'])) {

			require "conexion.php";

			$codigoTicket = $_REQUEST['codigoTicket'];
			$idLector = 1;

			$datos = array();

			$sql=$conn->prepare('SELECT * FROM tickets WHERE codigoTicket = :P1 AND estado = "0"');
			$resultado=$sql->execute(array('P1'=>$codigoTicket));
			$resultado=$sql->fetchAll();
			$num=$sql->rowCount();

			if ($num>=1) {
				foreach ($resultado as $fila) {
					$idTicket = $fila['idTicket'];
				}

				$sql2=$conn->prepare('UPDATE tickets SET estado = "1", fechaHoraEntrada = NOW(), idLector = :P2 WHERE idTicket = :P1');
				$resultado2=$sql2->execute(array('P1'=>$idTicket, 'P2'=>$idLector));
				$num2=$sql2->rowCount();

				if ($num2>=1) {
					$respuesta = '[{"respuesta":"1","0":"1"}]';
					echo $respuesta;
				}else{
					$respuesta = '[{"respuesta":"2","1":"2"}]';
					echo $respuesta;
				}
			}else{
				$respuesta = '[{"respuesta":"3","2":"3"}]';
				echo $respuesta;
			}
		}else{
			$respuesta = '[{"respuesta":"4","3":"4"}]';
			echo $respuesta;
		}
		
		$conn=NULL;
	}catch(PDOException $e){
		echo "ERROR: ".$e->getMessage();
		exit();
	}
?>