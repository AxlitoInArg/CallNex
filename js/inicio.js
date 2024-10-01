let llamado = null;
let notificaciones = [];

// Función para hacer el llamado
function hacerLlamado() {
    const cursoDiv = document.getElementById('curso_division');
    const grupo = document.getElementById('grupo'); // Grupo seleccionado

    // Obtener el texto del curso y división
    const cursoSeleccionado = cursoDiv.options[cursoDiv.selectedIndex].text;
    
    // Obtener el texto del grupo seleccionado
    const grupoSeleccionado = grupo.options[grupo.selectedIndex].text;

    // Crear el objeto de llamado
    llamado = {
        id: Date.now(),
        estado: 'pendiente',
        curso: cursoSeleccionado,
        grupo: grupoSeleccionado,
        mensaje: `Te llama el curso ${cursoSeleccionado} y grupo ${grupoSeleccionado}`
    };

    // Guardar el llamado en localStorage
    localStorage.setItem('llamado', JSON.stringify(llamado));

    // Crear la notificación y agregarla
    const mensajeNotificacion = `Te llama el curso ${cursoSeleccionado} y grupo ${grupoSeleccionado}`;
    agregarNotificacion(mensajeNotificacion);

    // Enviar la llamada al preceptor
    enviarLlamadoAPreceptor(cursoSeleccionado, grupoSeleccionado);
    
    // Deshabilitar el botón de "Realizar Llamado" hasta que llegue el preceptor
    document.querySelector('.btn').disabled = true;
}

// Agregar notificaciones
function agregarNotificacion(mensaje) {
    notificaciones.push(mensaje);
    localStorage.setItem('notificaciones', JSON.stringify(notificaciones));
    guardarNotificacionEnDB(mensaje); // Guardar en la base de datos
}

// Enviar llamado al preceptor
function enviarLlamadoAPreceptor(curso, grupo) {
    fetch('vista_preceptor.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ curso, grupo }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Llamado enviado correctamente al preceptor');
            agregarNotificacion('Mensaje enviado al preceptor.');
        } else {
            console.error('Error al enviar el llamado al preceptor');
            agregarNotificacion('Error al enviar el llamado al preceptor.');
        }
    })
    .catch(error => console.error('Error:', error));
}

// Función para manejar la aceptación del preceptor
function aceptarLlamado(motivo) {
    const mensaje = `El preceptor ha aceptado el llamado: ${motivo}`;
    agregarNotificacion(mensaje);
    console.log(mensaje);
}

// Función para manejar el rechazo del preceptor
function rechazarLlamado(motivo) {
    const mensaje = `El preceptor ha rechazado el llamado: ${motivo}`;
    agregarNotificacion(mensaje);
    console.log(mensaje);
}

// Guardar notificación en la base de datos
function guardarNotificacionEnDB(mensaje) {
    const user_id = sessionStorage.getItem('id'); // Obtener ID del usuario

    fetch('guardar_notificacion.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ user_id, mensaje }),
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            console.error('Error al guardar la notificación en la base de datos');
        }
    })
    .catch(error => console.error('Error:', error));
}

function borrarNotificaciones() {
    const user_id = sessionStorage.getItem('id'); // Obtener ID del usuario
    if (user_id) {
        // Eliminar las notificaciones de la base de datos
        fetch('borrar_notificaciones.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ user_id }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Historial de notificaciones borrado.');
                localStorage.removeItem('notificaciones'); // Limpiar el localStorage
                notificaciones = []; // Limpiar el array de notificaciones
                mostrarNotificaciones(); // Actualizar la vista de notificaciones
            } else {
                console.error('Error al borrar las notificaciones en la base de datos.');
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

function mostrarNotificaciones() {
    const notificacionDiv = document.getElementById('notificacion');
    notificacionDiv.innerHTML = ''; // Limpiar el contenido existente
    notificaciones.forEach(mensaje => {
        const notificationElement = document.createElement('div');
        notificationElement.className = 'notification';
        notificationElement.innerText = mensaje;
        notificacionDiv.appendChild(notificationElement);
    });
}