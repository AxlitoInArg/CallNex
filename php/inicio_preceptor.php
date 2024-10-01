<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include '../modelo/conexion_bd.php';

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM notificaciones WHERE usuario_id = $user_id ORDER BY fecha DESC";
$result = mysqli_query($conexion, $query);

// Cargar las notificaciones en un array para ser utilizadas en el script
$notificaciones = [];
while ($row = mysqli_fetch_assoc($result)) {
    $notificaciones[] = $row['mensaje'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones - CallNex</title>
    <link rel="icon" href="/callnex/imgs/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="/callnex/css/noti.css">
    <link rel="stylesheet" href="/callnex/css/inicio.css">
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
        <h2>Notificaciones</h2>
        <div class="function">
            <button class="btn" onclick="verNotificaciones()"><i class="fas fa-bell"></i> <span class="btn-text">Ver Notificaciones</span></button>
            <div id="notificacion" class="btn-text"></div>
            <button class="btn" onclick="borrarNotificaciones()"><i class="fas fa-trash"></i> <span class="btn-text">Borrar Historial</span></button>
        </div>
        <div class="notifications">
            <?php foreach ($notificaciones as $mensaje): ?>
                <div class="notification">
                    <p><?php echo htmlspecialchars($mensaje); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <script>
        // Cargar las notificaciones desde localStorage
        const storedNotificaciones = JSON.parse(localStorage.getItem('notificaciones')) || [];
        notificaciones = storedNotificaciones; // Utilizar el array de notificaciones
        mostrarNotificaciones(); // Llamar a la función para mostrar las notificaciones

        document.querySelector('.navbar-toggle').addEventListener('click', function() {
            document.querySelector('.navbar-menu ul').classList.toggle('active');
            document.querySelector('.navbar-menu').classList.toggle('active');
        });
    </script>
    <script src="/callnex/js/inicio.js"></script>
    <footer>
        <div class="container">
            <p>&copy; 2024 CallNex. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
