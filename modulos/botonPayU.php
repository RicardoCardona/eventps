<?php
	// Desicion para descartar errores
	try{
		session_start();
		date_default_timezone_set('America/Bogota');

		require "conexion.php";		
		$idCliente=$_SESSION['idCliente'];
		$email=$_SESSION['email'];
		$valorTotal=0;
		$hoy=date("Y-m-d H:i:s").' '.rand(0, 99);

		$sql=$conn->prepare('SELECT localidades.valor FROM buffercarrito INNER JOIN localidades ON localidades.idLocalidad=buffercarrito.idLocalidad WHERE buffercarrito.idUsuario = :P1');
		$resultado=$sql->execute(array('P1'=>$idCliente));
		$resultado=$sql->fetchAll();
		$num=$sql->rowCount();
			
		if ($num>=1) {
			foreach ($resultado as $fila) {
				$valorTotal=$fila['valor']+$valorTotal;	
			}

			// $firma = "WOA7FwIq9Crk5p4t52U125J4TM~639893~$idCliente~$valorTotal~COP";
			$firma = "4Vj8eK4rloUd272L48hsrarnUA~508029~$hoy~10000~COP";
			$firmaMD5 = md5($firma);

			if ($num > 1) {
				$boletos = 'TICKETS';
			}else{
				$boletos = 'TICKET';
			}
			echo '
				<form method="post" action="https://sandbox.gateway.payulatam.com/ppp-web-gateway">
					<input name="merchantId"    	type="hidden"  value="508029">
					<input name="ApiKey"    		type="hidden"  value="4Vj8eK4rloUd272L48hsrarnUA">
					<input name="referenceCode" 	type="hidden"  value="'.$hoy.'">
					<input name="accountId"     	type="hidden"  value="512321">
					<input name="description"   	type="hidden"  value="'.$num.' '.$boletos.'">					
					<input name="amount"        	type="hidden"  value="10000">
					<input name="tax"           	type="hidden"  value="0">
					<input name="taxReturnBase" 	type="hidden"  value="0">
					<input name="currency"      	type="hidden"  value="COP">
					<input name="signature"     	type="hidden"  value="'.$firmaMD5.'">
					<input name="test"          	type="hidden"  value="1">
					<input name="buyerEmail"    	type="hidden"  value="uno@yopmail.com">
					<input name="responseUrl"    	type="hidden"  value="http://www.bynary01.com/mi/confirmacion.php">
					<input type="image" border="0" alt="" src="http://www.payulatam.com/img-secure-2015/boton_pagar_mediano.png" onClick="this.form.urlOrigen.value = window.location.href;"/>
				</form>
			';

			// echo '
			// 	<form method="post" action="https://gateway.payulatam.com/ppp-web-gateway/">
			// 		<input name="merchantId"    	type="hidden"  value="639893">
			// 		<input name="accountId"     	type="hidden"  value="512321">
			// 		<input name="description"   	type="hidden"  value="'.$num.' '.$boletos.'">
			// 		<input name="referenceCode" 	type="hidden"  value="'.$idCliente.'">
			// 		<input name="amount"        	type="hidden"  value="'.$valorTotal.'">
			// 		<input name="tax"           	type="hidden"  value="0">
			// 		<input name="taxReturnBase" 	type="hidden"  value="0">
			// 		<input name="currency"      	type="hidden"  value="COP">
			// 		<input name="signature"     	type="hidden"  value="'.$firmaMD5.'">
			// 		<input name="test"          	type="hidden"  value="1">
			// 		<input name="buyerEmail"    	type="hidden"  value="'.$email.'">
			// 		<input name="responseUrl"    	type="hidden"  value="http://www.bynary01.com/mi/confirmacion2.php">
			// 		<input name="confirmationUrl"   type="hidden"  value="http://www.bynary01.com/mi/pago/respuestaSi.php">
			// 		<input type="image" border="0" alt="" src="http://www.payulatam.com/img-secure-2015/boton_pagar_mediano.png" onClick="this.form.urlOrigen.value = window.location.href;"/>
			// 	</form>
			// ';
		}else{
			echo '<h4 style="color: black;">No Existen Boletos Cargados En El Carrito</h4>';
		}

		//Cerrar la Conexión
		$conn=NULL;		
	}catch(PDOException $e){
		echo "ERROR: ".$e->getMessage();
		exit();
	}
?>