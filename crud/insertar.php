<?php

var_dump($_POST);
echo "<br>";
var_dump($_FILES);
echo "<br>";
include "../utilidades/error.php";
include "../config/config.php";

$peticion = "
iNSERT INTO 
" . $_GET['tabla'] . " 
VALUES(";

foreach (array_keys($_POST) as $clave) {
    if ($clave == "Identificador") {
        $peticion .= "NULL,";
    } else {
        $peticion .= "'" . $conexion->real_escape_string($_POST[$clave]) . "',";
    }
}

foreach ($_FILES as $clave => $archivo) {
    var_dump($archivo);
    if ($archivo['error'] !== UPLOAD_ERR_OK) {
        echo "Error en la subida del archivo. Código de error: " . $archivo['error'];
        continue;
    }

    $uploadDir = "../../static/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $fileTmpName = $archivo['tmp_name'];
    $fileName = basename($archivo['name']);
    $targetPath = $uploadDir . $fileName;

    if (move_uploaded_file($fileTmpName, $targetPath)) {
        $peticion .= "'" . $conexion->real_escape_string($fileName) . "',";
    } else {
        echo "Error al mover el archivo al directorio de destino.";
    }
}

$peticion = substr($peticion, 0, -1);
$peticion .= ")";

echo "Consulta SQL: " . $peticion . "<br>";
$resultado = $conexion->query($peticion);

if (!$resultado) {
    echo "Error en la inserción: " . $conexion->error;
} else {
    echo "Inserción realizada con éxito.";
}

?>
<meta http-equiv="refresh" content="5; url=../escritorio.php">