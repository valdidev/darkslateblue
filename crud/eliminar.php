<?php

// Este archivo inserta los campos que vienen del formulario

include "../utilidades/error.php";                           // Incluyo los mensajes de error
include "../config/config.php";                          // Traigo la conexión a la base de datos

$peticion = "
	dELETE FROM " . $_GET['tabla'] . "
	HERE Identificador = " . $_GET['Identificador'] . "
";

$resultado = $conexion->query($peticion);

?>
<meta http-equiv="refresh" content="1; url=../escritorio.php">