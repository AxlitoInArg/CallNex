<<<<<<< HEAD
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
}

function cancelarLlamado() {
    llamado = {
        ...llamado,
        estado: 'cancelado',
        mensaje: 'Pedido cancelado'
    };
    localStorage.setItem('llamado', JSON.stringify(llamado));
    localStorage.setItem('cancelado', JSON.stringify(llamado));
    document.getElementById('notificacion').innerText = 'Llamado cancelado';
    setTimeout(() => {
        localStorage.removeItem('cancelado');
        localStorage.removeItem('llamado');
    }, 1000);
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

setInterval(verificarEstadoLlamado, 1000);
document.addEventListener('DOMContentLoaded', () => {
    notificaciones = JSON.parse(localStorage.getItem('notificaciones')) || [];
=======
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
}

function cancelarLlamado() {
    llamado = {
        ...llamado,
        estado: 'cancelado',
        mensaje: 'Pedido cancelado'
    };
    localStorage.setItem('llamado', JSON.stringify(llamado));
    localStorage.setItem('cancelado', JSON.stringify(llamado));
    document.getElementById('notificacion').innerText = 'Llamado cancelado';
    setTimeout(() => {
        localStorage.removeItem('cancelado');
        localStorage.removeItem('llamado');
    }, 1000);
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

setInterval(verificarEstadoLlamado, 1000);
document.addEventListener('DOMContentLoaded', () => {
    notificaciones = JSON.parse(localStorage.getItem('notificaciones')) || [];
>>>>>>> 768621c2718a214ebbb933d3d4407b609e82cac1
});