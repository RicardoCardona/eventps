<?php
	
	$username = $_REQUEST['usu'];
	$password= base64_encode($_REQUEST['pas']);

	include "conexion.php";

	$sql=$conn->query("SELECT * FROM user WHERE email = '$username' AND password = '$password'");
	$num=$sql->rowCount();

	if ($num>=1) {

		$datos=array();
		
		foreach ($sql as $fila) {
			$datos[]=$fila;
		}		
		echo json_encode($datos);
	}
?>