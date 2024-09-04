<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - CallNex</title>
    <link rel="icon" href="/callnex/imgs/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="/callnex/css/inicio.css">
    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $mensaje = $_POST['mensaje'];
    $fecha = $_POST['fecha'];

    $sql = "INSERT INTO notificaciones (titulo, mensaje, fecha) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssdii", $titulo, $mensaje, $fecha);

    if ($stmt->execute()) {
        echo "Notificacion enviada";
    } else {
        echo "Error al enviar notificacion: " . $stmt->error;
    }
        
    $stmt->close();
    $stmt->close();
}



?>


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
            <h2>Bienvenido a CallNex</h2>
            <div class="functions">
                <div class="function">
                    <h3>Realizar Llamado</h3>
                    <p>Seleccione el motivo de su llamado:</p>
                    <select id="motivo">
                        <option value="consulta">Consulta</option>
                        <option value="emergencia">Emergencia</option>
                        <option value="asistencia">Asistencia</option>
                    </select>
                    <button class="btn"><i class="fas fa-phone"></i> <span class="btn-text">Llamar</span></button>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 CallNex. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="/callnex/js/inicio.js"></script>
    <script>
        document.querySelector('.navbar-toggle').addEventListener('click', function() {
            document.querySelector('.navbar-menu ul').classList.toggle('active');
            document.querySelector('.navbar-menu').classList.toggle('active');
        });
    </script>
</body>
</html>