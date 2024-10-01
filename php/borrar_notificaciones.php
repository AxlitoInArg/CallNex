<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'mensaje' => 'No estás autenticado.']);
    exit();
}

include '../modelo/conexion_bd.php';

$user_id = $_SESSION['user_id'];
$query = "DELETE FROM notificaciones WHERE usuario_id = $user_id";

if (mysqli_query($conexion, $query)) {
    echo json_encode(['success' => true, 'mensaje' => 'Notificaciones eliminadas.']);
} else {
    echo json_encode(['success' => false, 'mensaje' => 'Error al borrar las notificaciones.']);
}
?>
