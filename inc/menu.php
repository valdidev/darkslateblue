<?php

include_once __DIR__ . "/../config/config.php";

if (!isset($bd) || empty($bd)) {
    die("Error: La variable \$bd no está definida en config.php");
}

$peticion = "SHOW TABLES IN " . $bd;
$resultado = $conexion->query($peticion);

if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "
        <li>
            <a href='?tabla=" . htmlspecialchars($fila['Tables_in_' . $bd], ENT_QUOTES, 'UTF-8') . "'>
                " . htmlspecialchars($fila['Tables_in_' . $bd], ENT_QUOTES, 'UTF-8') . "
            </a>
        </li>
        ";
    }
} else {
    echo "<li>Error al obtener las tablas</li>";
}

?>
