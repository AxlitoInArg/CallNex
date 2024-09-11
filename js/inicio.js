// Configuración del cliente MQTT
const mqttHost = '192.168.0.182';  // IP del broker (Raspberry Pi)
const mqttPort = 8080;  // Puerto configurado para WebSocket en la Raspberry Pi
const topicTest = 'test/topic';  // Tema para enviar el mensaje "hola"

// Crear cliente MQTT con WebSocket
let client = new Paho.MQTT.Client(mqttHost, mqttPort, `clientId-${Date.now()}`);

// Función que se ejecuta al perder la conexión
client.onConnectionLost = (responseObject) => {
    if (responseObject.errorCode !== 0) {
        console.error("Conexión perdida: " + responseObject.errorMessage);
    }
};

// Función que se ejecuta al recibir un mensaje
client.onMessageArrived = (message) => {
    console.log("Mensaje recibido: " + message.payloadString);
};

// Conectar al broker MQTT
function conectarMQTT() {
    client.connect({
        onSuccess: () => {
            console.log("Conexión exitosa al broker MQTT");
        },
        onFailure: (err) => {
            console.error("Error al conectar al broker MQTT: ", err);
        },
        useSSL: false  // Cambiar a true si tu broker usa SSL
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
        const messageTest = new Paho.MQTT.Message("hola");
        messageTest.destinationName = topicTest;
        client.send(messageTest);

        console.log('Mensaje "hola" enviado al topic:', topicTest);
    } else {
        console.error('El cliente MQTT no está conectado.');
    }
}
