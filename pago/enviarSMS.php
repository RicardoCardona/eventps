<?php

			$sql13=$conn->prepare('SELECT * FROM tickets WHERE idFacturas = :P1');
			$resultado13=$sql13->execute(array('P1'=>$idFacturas));
			$resultado13=$sql13->fetchAll();
			$num13=$sql13->rowCount();

			if ($num13>=1) {
				foreach ($resultado13 as $fila) {
					$linkPdf=$fila['linkPdf'];
				}
				$sql15=$conn->prepare('SELECT * FROM setup');
				$resultado15=$sql15->execute(array());
				$resultado15=$sql15->fetchAll();
				$num15=$sql15->rowCount();

				if ($num15>=1) {
					foreach ($resultado15 as $fila) {
						$username = $fila['username'];
						$password = base64_decode($fila['password']);
						$country = $fila['pais'];
						$message = $fila['mensaje'].' '.$linkPdf;
					}

					$sql14=$conn->prepare('SELECT * FROM celularUsuario WHERE idUsuario = :P1 AND estado = "1"');
					$resultado14=$sql14->execute(array('P1'=>$idCliente));
					$resultado14=$sql14->fetchAll();
					$num14=$sql14->rowCount();

					if ($num14>=1) {
						foreach ($resultado14 as $fila) {
							$mobile = $fila['celular'];
							$operator = $fila['operador'];

							// Url del web service
							$urlSMS= 'https://apismsi.aldeamo.com/smsr/r/hcws/smsSendGet/'.$username.'/'.$password.'/'.$mobile.'/'.$country.'/'.$message;
							$respuestaSms = trim(file_get_contents($urlSMS), "\xEF\xBB\xBF");


							$sql16=$conn->prepare('INSERT INTO smsTracking (celular, idTicket, sms, respuestaSms) VALUES (:P1,:P2,:P3,:P4)');
							$resultado16=$sql16->execute(array('P1'=>$mobile, 'P2'=>$idTicket,'P3'=>$message,'P4'=>$respuestaSms));
							$num16=$sql16->rowCount();

							if ($num16>=1) {
								print "<script>window.location='../confirmacion.php';</script>";
							}else{
								echo 'ERROR INESPERADO11';
							}
						}
						echo 'ENVIADO CORRECTAMENTE';
					}else{
						echo 'ERROR INESPERADO14';
					}
				}else{
					echo 'ERROR INESPERADO15';
				}
			}else{
				echo 'ERROR INESPERADO13';
			}
?>