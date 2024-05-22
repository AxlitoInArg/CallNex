<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/callnex/imgs/logo.png" type="image/x-icon">
    <title>Document</title>
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

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $contrasena = $_POST["password"];

    // Consultar la base de datos para verificar el usuario
    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND contrasena = '$contrasena'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['email'] = $email;
        echo json_encode(['success' => true, 'message' => 'Inicio de sesión exitoso. Redirigiendo...']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Correo electrónico o contraseña incorrectos.']);
    }
}

mysqli_close($conn);
?>

</body>
</html>