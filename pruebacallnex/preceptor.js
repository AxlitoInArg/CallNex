let llamados = JSON.parse(localStorage.getItem('llamados')) || [];

function aceptarLlamado(id) {
    const llamado = llamados.find(ll => ll.id === id);
    if (llamado) {
        llamado.estado = 'aceptado';
        llamado.mensaje = 'En seguida voy';
        actualizarLlamados();
        guardarLlamados();
        enviarNotificacionAlumno(llamado);
    }
}

function rechazarLlamado(id) {
    const llamado = llamados.find(ll => ll.id === id);
    if (llamado) {
        llamado.estado = 'rechazado';
        llamado.mensaje = 'No puedo';
        actualizarLlamados();
        guardarLlamados();
        enviarNotificacionAlumno(llamado);
    }
}

function actualizarLlamados() {
    const list = document.getElementById('llamadosList');
    list.innerHTML = '';
    llamados.forEach(llamado => {
        const item = document.createElement('li');
        item.innerHTML = `
            Llamado ID: ${llamado.id} - Estado: ${llamado.estado} <br>
            <button onclick="aceptarLlamado(${llamado.id})">Aceptar</button>
            <button onclick="rechazarLlamado(${llamado.id})">Rechazar</button>
            <select onchange="cambiarMensaje(${llamado.id}, this.value)">
                <option value="">Seleccionar mensaje</option>
                <option value="En seguida voy">En seguida voy</option>
                <option value="Estoy yendo">Estoy yendo</option>
                <option value="No puedo">No puedo</option>
                <option value="No puedo, va un reemplazo">No puedo, va un reemplazo</option>
            </select>
        `;
        list.appendChild(item);
    });
}

function cambiarMensaje(id, mensaje) {
    const llamado = llamados.find(ll => ll.id === id);
    if (llamado) {
        llamado.mensaje = mensaje;
        guardarLlamados();
    }
}

function guardarLlamados() {
    localStorage.setItem('llamados', JSON.stringify(llamados));
}

function enviarNotificacionAlumno(llamado) {
    localStorage.setItem('llamado', JSON.stringify(llamado));
}

function verificarCancelacion() {
    const cancelado = JSON.parse(localStorage.getItem('cancelado'));
    if (cancelado) {
        const index = llamados.findIndex(ll => ll.id === cancelado.id);
        if (index > -1) {
            llamados.splice(index, 1);
            actualizarLlamados();
            guardarLlamados();
        }
        localStorage.removeItem('cancelado');
    }
}

function borrarHistorialLlamados() {
    llamados = [];
    localStorage.removeItem('llamados');
    actualizarLlamados();
}

// Simulación de recepción de llamado
setInterval(() => {
    const llamado = JSON.parse(localStorage.getItem('llamado'));
    if (llamado && !llamados.find(ll => ll.id === llamado.id)) {
        llamados.push(llamado);
        actualizarLlamados();
        guardarLlamados();
    }
}, 1000);

setInterval(verificarCancelacion, 1000);

document.addEventListener('DOMContentLoaded', actualizarLlamados);