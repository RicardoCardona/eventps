<?php

	// Conexion metodo PDO

	$conn = new PDO('mysql:host=bynary01.com; dbname=bynary_midnight', 'bynary', '4QEH^z6Z{6Xv');

	// Limpieza de Cache y Seguridad

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Conexion a UTF8, uso de Tildes y Ñ

	$conn->exec("set names utf8");

?>