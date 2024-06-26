<?php
// Inicia sesión
session_start();

// Comprueba si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Conexión a la base de datos
include '../modelo/conexion_bd.php';

// Obtiene las notificaciones del usuario
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM notificaciones WHERE usuario_id = $user_id ORDER BY fecha DESC";
$result = mysqli_query($conexion, $query);

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
        </div>
    </header>

    <section class="main">
        <div class="container">
            <h2>Notificaciones</h2>
            <div class="notifications">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='notification'>";
                        echo "<p><strong>" . htmlspecialchars($row['titulo']) . "</strong></p>";
                        echo "<p>" . htmlspecialchars($row['mensaje']) . "</p>";
                        echo "<p class='date'>" . htmlspecialchars($row['fecha']) . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No tienes notificaciones.</p>";
                }
                ?>
            </div>
        </div>
    </section>
    <script>
        document.querySelector('.navbar-toggle').addEventListener('click', function() {
            document.querySelector('.navbar-menu ul').classList.toggle('active');
            document.querySelector('.navbar-menu').classList.toggle('active');
        });
    </script>
    <footer>
        <div class="container">
            <p>&copy; 2024 CallNex. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>