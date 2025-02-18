<?php
/*
	Este archivo se llama inmediatamente después del formulario de inicio de sesión y sirve para validar 
	las credenciales enviadas contra la base de datos y si la validación es correcta en ese caso nos reenvía al escritorio 
*/

session_start();
include "config/config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $conexion->real_escape_string($_POST['email']);
    $contrasena = $_POST['contrasena'];

    // Verificar si el email existe en la base de datos
    $peticion = "sELECT * FROM usuarios WHERE email = '$email'";
    $resultado = $conexion->query($peticion);

    if ($fila = $resultado->fetch_assoc()) {
        // Verificar la contraseña usando password_verify()
        if (password_verify($contrasena, $fila['contrasena'])) {
            $_SESSION['login'] = true;
            $_SESSION['pagina'] = 0;
            $_SESSION['nombre'] = $fila['nombrecompleto']; // Guardar el nombre del usuario
            echo '<meta http-equiv="refresh" content="0; url=escritorio.php">';
            exit;
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "El usuario no existe.";
    }
}
?>
