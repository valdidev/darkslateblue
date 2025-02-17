<?php

// Este archivo inserta los campos que vienen del formulario

include "../utilidades/error.php";
include "../config/config.php";

$peticion = "
	dELETE FROM " . $_GET['tabla'] . "
	WHERE Identificador = " . $_GET['Identificador'] . "
";

$resultado = $conexion->query($peticion);

?>
<meta http-equiv="refresh" content="1; url=../escritorio.php">