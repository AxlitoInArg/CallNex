document.addEventListener('DOMContentLoaded', () => {
    actualizarLlamados();

    document.getElementById('availability-btn').addEventListener('click', function() {
        isAvailable = !isAvailable;
        const availabilityText = document.getElementById('availability-text');
        const availabilityIcon = this.querySelector('i');

        if (isAvailable) {
            availabilityText.textContent = 'Disponible';
            availabilityIcon.classList.remove('fa-circle');
            availabilityIcon.classList.add('fa-check-circle');
            this.classList.add('available');
        } else {
            availabilityText.textContent = 'No Disponible';
            availabilityIcon.classList.remove('fa-check-circle');
            availabilityIcon.classList.add('fa-circle');
            this.classList.remove('available');
        }

        // Aquí puedes agregar una llamada AJAX para actualizar el estado en la base de datos
        // fetch('/update_availability.php', { method: 'POST', body: JSON.stringify({ available: isAvailable }) });
    });

    setInterval(() => {
        const llamadoAlumno = JSON.parse(localStorage.getItem('llamadoAlumno'));
        if (llamadoAlumno && !llamados.find(ll => ll.id === llamadoAlumno.id)) {
            llamados.push(llamadoAlumno);
            actualizarLlamados();
            guardarLlamados();
            localStorage.removeItem('llamadoAlumno');
        }
    }, 1000);

    setInterval(verificarCancelacion, 1000);
});

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
    localStorage.setItem('llamadoAlumno', JSON.stringify(llamado));
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
