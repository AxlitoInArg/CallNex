let llamados = JSON.parse(localStorage.getItem('llamados')) || [];

function realizarLlamado() {
    const motivo = document.getElementById('motivo').value;
    const id = Date.now();
    const llamado = { id, motivo, estado: 'pendiente', mensaje: '' };
    llamados.push(llamado);
    localStorage.setItem('llamados', JSON.stringify(llamados));
    alert('Llamado realizado con éxito.');
}

function cancelarLlamado() {
    if (llamados.length > 0) {
        const cancelado = llamados.pop();
        localStorage.setItem('llamados', JSON.stringify(llamados));
        localStorage.setItem('cancelado', JSON.stringify(cancelado));
        alert('Llamado cancelado.');
    } else {
        alert('No hay llamados para cancelar.');
    }
}

function verificarEstado() {
    const llamado = JSON.parse(localStorage.getItem('llamado'));
    if (llamado) {
        const notificacion = document.getElementById('notificacion');
        notificacion.textContent = `Llamado ${llamado.estado}: ${llamado.mensaje}`;
        localStorage.removeItem('llamado');
    }
}

setInterval(verificarEstado, 1000);
