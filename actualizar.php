<?php

/*
	Este script procesa la acción de actualización enviada desde el escritorio.
	Se invoca mediante peticiones AJAX y recibe cuatro parámetros principales: 
	- La tabla en la que se realizará la actualización.
	- La columna que se modificará.
	- El nuevo contenido que se asignará a la columna.
	- El identificador que determina el registro específico a actualizar.
	Con estos datos, el script construye y ejecuta una consulta SQL de tipo uPDATE en la base de datos.
*/

include "config/config.php";

$peticion = "
	uPDATE " . $_GET['tabla'] . "
	sET " . $_GET['columna'] . " = '" . $_GET['contenido'] . "'
	wHERE Identificador = " . $_GET['identificador'] . "
";

$resultado = $conexion->query($peticion);
