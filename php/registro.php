<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="/css/registro.css">
</head>
<body>
    <div class="container">
        <h1>Registro</h1>
        
        <?php
        // Verificar si se ha enviado el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Procesar los datos del formulario
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "callnex";

            $conn = mysqli_connect($servername, $username, $password, $database);

            if (!$conn) {
                die("Conexión fallida: " . mysqli_connect_error());
            }

            $nombre = $_POST["nombre"];
            $email = $_POST["email"];
            $contrasena = $_POST["contrasena"];

            // Verificar si el email ya está registrado
            $sql = "SELECT id FROM usuarios WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<p class='error'>El correo electrónico ya está registrado.</p>";
            } else {
                // Insertar nuevo usuario en la base de datos
                $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES ('$nombre', '$email', '$contrasena')";
                
                if (mysqli_query($conn, $sql)) {
                    echo "<p class='success'>Registro exitoso. <a href='inicio.php'>Ir al inicio</a></p>";
                } else {
                    echo "Error al registrar usuario: " . mysqli_error($conn);
                }
            }

            mysqli_close($conn);
        }
        ?>

        <!-- Formulario de registro -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <button type="submit">Registrarse</button>
        </form>
    </div>
</body>
</html>
