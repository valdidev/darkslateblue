<?php

/*
El presente archivo procesa la acción de actualización enviada desde el escritorio de la aplicación de administración este archivo se llama mediante peticiones AJAX y se le envía por una parte la tabla por otra parte la columna y por otra parte el contenido junto con el identificador el archivo coge esos cuatro datos y construye una petición de tipo Update para ejecutar contra la base de datos 

*/


include "config/config.php";                          

$peticion = "
	uPDATE " . $_GET['tabla'] . "
	sET " . $_GET['columna'] . " = '" . $_GET['contenido'] . "'
	wHERE Identificador = " . $_GET['identificador'] . "
";

$resultado = $conexion->query($peticion);
