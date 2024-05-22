<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/callnex/imgs/logo.png" type="image/x-icon">
    <title>Login - CallNex</title>
    <link rel="stylesheet" href="/callnex/css/login.css">
</head>
<body>
    <?php
    session_start();

    // Datos de conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "callnex";

    // Conexión a la base de datos
    $conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Inicializar variables para manejar mensajes
    $login_success = false;
    $error_message = "";

    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $contrasena = $_POST["password"];

        // Consultar la base de datos para verificar el usuario
        $sql = "SELECT * FROM usuarios WHERE email = '$email' AND contrasena = '$contrasena'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $_SESSION['email'] = $email;
            $login_success = true;
        } else {
            $error_message = "Correo electrónico o contraseña incorrectos.";
        }
    }

    mysqli_close($conn);
    ?>

    <div class="login-container">
        <h2>Logueo - CallNex</h2>
        <?php if ($login_success): ?>
            <p class="success-message">Inicio de sesión exitoso. Redirigiendo...</p>
            <script>
                setTimeout(function() {
                    window.location.href = '/callnex/php/inicio.php'; // Cambiar a la página de inicio correspondiente
                }, 3000); // Redirigir después de 3 segundos
            </script>
        <?php else: ?>
            <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="input-group">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <?php if (!empty($error_message)): ?>
                    <p class="error-message"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <button type="submit" class="btn">Iniciar sesión</button>
            </form>
            <p>No tienes una cuenta? <a href="http://localhost/callnex/php/registro.php">Regístrate aquí</a></p>
        <?php endif; ?>
    </div>

</body>
</html>
