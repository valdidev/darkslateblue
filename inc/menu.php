<?php

/* 
	Este archivo carga las entradas del menu de la izquierda
	Este archivo genera elementos de lista que tienen un hipervinculo	
*/

include __DIR__ . "/../config/config.php";

$peticion = "SHOW TABLES in " . $bd;
//echo $peticion;
$resultado = $conexion->query($peticion);

while ($fila = $resultado->fetch_assoc()) {
	echo "
		<li>
			<a href='?tabla=" . $fila['Tables_in_' . $bd] . "'>
				" . $fila['Tables_in_' . $bd] . "
			</a>
		</li>
	";
}
