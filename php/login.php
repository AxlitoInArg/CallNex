<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CallNex</title>
    <link rel="stylesheet" href="/callnex/css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="/callnex/php/procesar_login.php" method="post">
            <div class="input-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Iniciar sesión</button>
        </form>
        <p>No tienes una cuenta? <a href="/callnex/php/registro.php">Regístrate aquí</a></p>
    </div>
</body>
</html>
