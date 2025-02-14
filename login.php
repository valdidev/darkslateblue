<?php
/*
	Este archivo se llama inmediatamente después del formulario de inicio de sesión y sirve para validar 
	las credenciales enviadas contra la base de datos y si la validación es correcta en ese caso nos reenvía al escritorio 
*/

session_start();

include "config/config.php";

$peticion = "
		sELECT * FROM usuarios
		WHERE 
		email = '" . $_POST['email'] . "'
		AND
		contrasena = '" . $_POST['contrasena'] . "'
		";

$resultado = $conexion->query($peticion);

if ($fila = $resultado->fetch_assoc()) {
	$_SESSION['login'] = true;
	$_SESSION['pagina'] = 0;
	echo '<meta http-equiv="refresh" content="0; url=escritorio.php">';
} else {
	echo "Intento de acceso incorrecto";
}
