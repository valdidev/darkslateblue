<?php

/*
	Este script maneja las solicitudes de actualización enviadas desde el panel de administración.
	Se ejecuta a través de peticiones AJAX y requiere cuatro parámetros clave:
	- El nombre de la tabla donde se realizará la actualización.
	- La columna que se desea modificar.
	- El nuevo valor que se asignará a la columna.
	- El identificador único del registro que se actualizará.
	Con esta información, el script genera y ejecuta una consulta SQL de tipo uPDATE en la base de datos.
*/

include "config/config.php";

$peticion = "
	uPDATE " . $_GET['tabla'] . "
	sET " . $_GET['columna'] . " = '" . $_GET['contenido'] . "'
	wHERE Identificador = " . $_GET['identificador'] . "
";

$resultado = $conexion->query($peticion);
