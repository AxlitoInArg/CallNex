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
        <div class="container">
            <div class="logo">
                <img src="/callnex/imgs/icono_callnex.png" alt="Logo de CallNex">
            </div>
            <nav>
                <div class="menu-icon" id="menu-icon">
                    <i class="fas fa-bars"></i>
                </div>
                <ul class="nav-links" id="nav-links">
                    <li><a href="index.html"><i class="fas fa-home"></i><span class="nav-text">Inicio</span></a></li>
                    <li><a href="configuracion.html"><i class="fas fa-gear"></i><span class="nav-text">Configuración</span></a></li>
                    <li><a href="#"><i class="fas fa-question"></i><span class="nav-text">Ayuda</span></a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span class="nav-text">Cerrar sesión</span></a></li>
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
                    <input type="text" id="nombre" name="nombre" value="Nombre del usuario" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" value="usuario@ejemplo.com" required>
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
        const menuIcon = document.getElementById('menu-icon');
        const navLinks = document.getElementById('nav-links');

        menuIcon.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    </script>
</body>
</html>
