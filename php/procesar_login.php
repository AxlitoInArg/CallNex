<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // Verificar si se enviaron los datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar que se hayan enviado el correo electrónico y la contraseña
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            // Aquí iría tu lógica para verificar las credenciales de inicio de sesión
            // Si las credenciales son válidas, puedes redirigir al usuario a la página deseada
            // Por ejemplo:
            header("Location: /callnex/php/inicio.php");
            exit; // Es importante detener la ejecución del script después de la redirección
        } else {
            // Si no se enviaron el correo electrónico y la contraseña, redirigir al usuario al formulario de inicio de sesión
            header("Location: login.php");
            exit;
        }
    } else {
        // Si no se envió un formulario POST, redirigir al usuario al formulario de inicio de sesión
        header("Location: login.php");
        exit;
    }
    ?>
</body>
</html>