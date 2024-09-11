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
    <!-- Biblioteca Paho MQTT -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js"></script>
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
                    <button class="btn" onclick="hacerLlamado()"><i class="fas fa-phone"></i> <span class="btn-text">Llamar</span></button>
                </div>
                <div class="function">
                    <h3>Cancelar Llamado</h3>
                    <button class="btn" onclick="cancelarLlamado()"><i class="fas fa-times"></i> <span class="btn-text">Cancelar</span></button>
                </div>
                <div class="function">
                    <h3>Enviar Mensaje a Aula</h3>
                    <p>Envía mensajes a las aulas para informar o asistir en tiempo real.</p>
                    <a href="#" class="btn"><i class="fas fa-envelope"></i> <span class="btn-text">Enviar Mensaje</span></a>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 CallNex. Todos los derechos reservados.</p>
        </div>
    </footer>

    <div id="notificacion"></div>

    <script>
        // Configuración del cliente MQTT
        const mqttHost = '192.168.0.182';  // IP del broker (Raspberry Pi)
        const mqttPort = 8080;  // Cambia a 8080 si tu broker MQTT está usando WebSocket en ese puerto
        const topicTest = 'test/topic';  // Tema para enviar el mensaje "hola"

        // Crear cliente MQTT con WebSocket
        let client = new Paho.MQTT.Client(mqttHost, mqttPort, `clientId-${Date.now()}`);

        // Conectar al broker MQTT
        function conectarMQTT() {
            client.connect({
                onSuccess: () => {
                    console.log("Conexión exitosa al broker MQTT");
                },
                onFailure: (err) => {
                    console.error("Error al conectar al broker MQTT: ", err);
                },
                useSSL: false  // Cambiar a true si el broker usa SSL
            });
        }

        // Llamar a la función de conectar cuando la página cargue
        document.addEventListener('DOMContentLoaded', () => {
            conectarMQTT();
        });

        // Función para realizar el llamado y enviar el mensaje
        function hacerLlamado() {
            if (client.isConnected()) {
                console.log('Cliente MQTT está conectado.');

                // Enviar el mensaje "hola" al topic test/topic
                const messageTest = new Paho.MQTT.Message("BALDACULOGORDO");
                messageTest.destinationName = topicTest;
                client.send(messageTest);

                console.log('Mensaje "hola" enviado al topic:', topicTest);
            } else {
                console.error('El cliente MQTT no está conectado.');
            }
        }
    </script>


</body>
</html>
