<?php
// Inicia sesión
session_start();

// Comprueba si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header('Location: /callnex/index.html');
    exit();
}

// Conexión a la base de datos
include '../modelo/conexion_bd.php';

// Obtiene la información del usuario
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM usuarios WHERE id = $user_id";
$result = mysqli_query($conexion, $query);
$user = mysqli_fetch_assoc($result);

// Procesa el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($conexion, $_POST['apellido']);
    $email = mysqli_real_escape_string($conexion, $_POST['email']);

    $update_query = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', email = '$email' WHERE id = $user_id";
    echo $update_query;

    if (mysqli_query($conexion, $update_query)) {
        $_SESSION['success_message'] = "Perfil actualizado exitosamente.";
    } else {
        $_SESSION['error_message'] = "Error al actualizar el perfil.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - CallNex</title>
    <link rel="icon" href="/callnex/imgs/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="/callnex/css/perfil.css">
    <link rel="stylesheet" href="/callnex/css/inicio.css">
    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="container menu">
            <div class="logo">
                <img src="/callnex/imgs/icono_callnex.png" alt="Logo de CallNex">
            </div>
            <button class="navbar-toggle"><i class="fas fa-bars"></i></button>
            <nav class="navbar-menu">
                <ul>
                    <li><a href="inicio.php"><i class="fas fa-home"></i><span class="nav-text">Inicio</span></a></li>
                    <li><a href="noti.php"><i class="fas fa-bell"></i><span class="nav-text">Notificaciones</span></a></li>
                    <li><a href="config.php"><i class="fas fa-gear"></i><span class="nav-text">Configuración</span></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="main">
        <div class="container">
            <h2>Perfil</h2>
            <form class="profile-form">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre del usuario" value="<?php echo $_SESSION['nombre']?>">
                </div>
                <div class="form-group">
                    <label for="nombre">Apellido</label>
                    <input type="text" id="apellido" name="apellido" placeholder="Apellido del usuario" value="<?php echo $_SESSION['appelido']?>">
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" placeholder="tu correo" value="<?php echo $_SESSION['email']?>">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Cambiar contraseña">
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirmar Contraseña</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmar nueva contraseña">
                </div>
                <button type="submit" class="btn"><i class="fas fa-save"></i> Guardar Cambios</button>
            </form>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 CallNex. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script>
        document.querySelector('.navbar-toggle').addEventListener('click', function() {
            document.querySelector('.navbar-menu ul').classList.toggle('active');
            document.querySelector('.navbar-menu').classList.toggle('active');
        });
    </script>
</body>
</html>
