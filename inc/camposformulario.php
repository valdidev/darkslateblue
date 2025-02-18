<?php

// Este archivo carga las cabeceras de la tabla

include "config/config.php";

$peticion = "SHOW COLUMNS FROM " . $_GET['formulario'];
$resultado = $conexion->query($peticion);

while ($fila = $resultado->fetch_assoc()) {
	if (str_contains($fila['Field'], "_")) {
		echo "<select name='" . $fila['Field'] . "'>";
		$explotado = explode("_", $fila['Field']);
		$tabla = $explotado[0];
		$columna = $explotado[1];
		$peticion2 = "SELECT Identificador," . $columna . " FROM " . $tabla . ";";
		$resultado2 = $conexion->query($peticion2);
		while ($fila2 = $resultado2->fetch_assoc()) {

			echo "<option value='" . $fila2['Identificador'] . "'>" . $fila2[$columna] . "</option>";
		}
		echo "</select>";
	} else {
		echo "<input ";
		if ($fila['Field'] == "Identificador") {
			echo " type='hidden' ";
		} else if (str_contains($fila['Field'], "imagen")) {
			echo " type='file' ";
		} else if (str_contains($fila['Field'], "fecha")) {
			echo " type='date' ";
		} else {
			echo " type='text' ";
		}
		echo "
		  name='" . $fila['Field'] . "' 
		  placeholder='" . $fila['Field'] . "' 
		  
		  >";
	}
}

$conexion->close();
