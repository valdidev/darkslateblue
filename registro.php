<?php
session_start();
include "config/config.php";

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $nombrecompleto = $conexion->real_escape_string($_POST['nombrecompleto']);
    $email = $conexion->real_escape_string($_POST['email']);
    $contrasena = $conexion->real_escape_string($_POST['contrasena']);
    $confirmar_contrasena = $conexion->real_escape_string($_POST['confirmar_contrasena']);

    // Validar datos
    $errores = [];

    if (empty($nombrecompleto)) {
        $errores[] = "El nombre completo es obligatorio.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El email no tiene un formato válido.";
    }

    if (empty($contrasena)) {
        $errores[] = "La contraseña es obligatoria.";
    }

    if ($contrasena !== $confirmar_contrasena) {
        $errores[] = "Las contraseñas no coinciden.";
    }

    // Si no hay errores, proceder con el registro
    if (empty($errores)) {
        // Verificar si el email ya está registrado
        $peticion = "sELECT * FROM usuarios WHERE email = '$email'";
        $resultado = $conexion->query($peticion);

        if ($resultado->num_rows > 0) {
            $errores[] = "El email ya está registrado.";
        } else {
            // Encriptar la contraseña
            $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

            // Insertar el nuevo usuario en la base de datos
            $peticion = "
                iNSERT INTO usuarios (email, contrasena, nombrecompleto)
                VALUES ('$email', '$contrasena_hash', '$nombrecompleto')
            ";

            if ($conexion->query($peticion)) {
                $_SESSION['mensaje'] = "Registro exitoso. ¡Bienvenido, $nombrecompleto!";
                echo '<meta http-equiv="refresh" content="0; url=index.html">';
                header("Location: index.html");
                exit;
            } else {
                $errores[] = "Error al registrar el usuario: " . $conexion->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="estilo/login.css">
</head>
<body>
    <main>
        <form action="registro.php" method="POST">
            <img src="logo.png" id="logo">
            <h1>Registro</h1>

            <?php if (!empty($errores)): ?>
                <div class="errores">
                    <?php foreach ($errores as $error): ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <input type="text" placeholder="Nombre completo" name="nombrecompleto" required>
            <input type="email" placeholder="Email" name="email" required>
            <input type="password" placeholder="Contraseña" name="contrasena" required>
            <input type="password" placeholder="Confirmar contraseña" name="confirmar_contrasena" required>
            <input type="submit" value="Registrarse">
            <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
        </form>
    </main>
</body>
</html>