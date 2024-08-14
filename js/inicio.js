let llamado = null;
let notificaciones = [];

function hacerLlamado() {
    llamado = {
        id: Date.now(),
        estado: 'pendiente',
        mensaje: ''
    };
    localStorage.setItem('llamado', JSON.stringify(llamado));
    agregarNotificacion('Llamado enviado a preceptor');
    mostrarAviso('Llamado realizado exitosamente', 'success');
}

function cancelarLlamado() {
    if (llamado && llamado.estado === 'pendiente') {
        llamado = {
            ...llamado,
            estado: 'cancelado',
            mensaje: 'Pedido cancelado'
        };
        localStorage.setItem('llamado', JSON.stringify(llamado));
        localStorage.setItem('cancelado', JSON.stringify(llamado));
        agregarNotificacion('Llamado cancelado');
        mostrarAviso('Llamado cancelado', 'warning');
        setTimeout(() => {
            localStorage.removeItem('cancelado');
            localStorage.removeItem('llamado');
        }, 1000);
    } else {
        mostrarAviso('No hay llamado pendiente para cancelar', 'error');
    }
}

function verificarEstadoLlamado() {
    const llamadoGuardado = localStorage.getItem('llamado');
    if (llamadoGuardado) {
        llamado = JSON.parse(llamadoGuardado);
        if (llamado.estado !== 'pendiente') {
            agregarNotificacion(`Llamado ${llamado.estado}: ${llamado.mensaje}`);
            localStorage.removeItem('llamado');
        }
    }
}

function agregarNotificacion(mensaje) {
    notificaciones.push(mensaje);
    localStorage.setItem('notificaciones', JSON.stringify(notificaciones));
}

function verNotificaciones() {
    const notificacionesGuardadas = JSON.parse(localStorage.getItem('notificaciones')) || [];
    const notificacionDiv = document.getElementById('notificacion');
    notificacionDiv.innerHTML = notificacionesGuardadas.join('<br>');
}

function borrarNotificaciones() {
    notificaciones = [];
    localStorage.removeItem('notificaciones');
    document.getElementById('notificacion').innerText = 'Historial de notificaciones borrado';
}

function mostrarAviso(mensaje, tipo) {
    const avisoDiv = document.createElement('div');
    avisoDiv.className = `aviso ${tipo}`;
    avisoDiv.innerText = mensaje;
    document.body.appendChild(avisoDiv);

    setTimeout(() => {
        avisoDiv.remove();
    }, 3000); // El aviso desaparecerá después de 3 segundos
}

setInterval(verificarEstadoLlamado, 1000);
document.addEventListener('DOMContentLoaded', () => {
    notificaciones = JSON.parse(localStorage.getItem('notificaciones')) || [];
    verNotificaciones();
});
