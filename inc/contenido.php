<?php

// Este archivo carga el contenido interno de cada tabla

include "config/config.php";

$peticion = "
	sELECT * 
	FROM " . $_GET['tabla'] . " 
	LIMIT 10  
	offsET " . ($_SESSION['pagina'] * 10) . " 
	";
$resultado = $conexion->query($peticion);

while ($fila = $resultado->fetch_assoc()) {
	$identificador = "";
	echo "<tr>";
	foreach ($fila as $clave => $valor) {
		if ($clave == "Identificador") {
			$identificador = $valor;
		}
		if (!str_contains($clave, "imagen")) {
			if (str_contains($clave, "_")) {
				$explotado = explode("_", $clave);
				$tabla = $explotado[0];
				$columna = $explotado[1];
				$peticion2 = "
	  				sELECT " . $columna . " 
	  				FROM " . $tabla . " 
	  				WHERE Identificador = " . $valor . ";";
				$resultado2 = $conexion->query($peticion2);
				while ($fila2 = $resultado2->fetch_assoc()) {
					echo "<td>" . $fila2[$columna] . "</td>";
				}
			} else {
				echo "<td
	  				tabla='" . $_GET['tabla'] . "'
	  				columna = '" . $clave . "'
	  				identificador = '" . $identificador . "'
	  			>" . $valor . "</td>";
			}
		} else {
			if ($valor == "") {
				echo "<td>
  			<img src='./img/placeholder.jpg'>
  			</td>";
			} else {
				echo "<td>
  			<img src='../static/" . $valor . "'>
  			</td>";
			}
		}
	}
	echo "
	<td>
		<a href='crud/eliminar.php?tabla=" . $_GET['tabla'] . "&Identificador=" . $identificador . "'>
			<button class='eliminar'>
				X
			</button>
		</a>
	</td>";
	echo "</tr>";
}


$conexion->close();
