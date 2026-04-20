<?php
require_once __DIR__ . '/../models/rutinas.php';
require_once __DIR__ . '/../config/session.php';

$rutinas = new Rutinas();

// Crear rutina
if (isset($_POST['crear_rutina'])) {
    $rutinas->crear(
        $_SESSION['id_usuario'],
        $_POST['nombre'],
        $_POST['descripcion'],
        $_POST['dia_semana'],
        $_POST['duracion'],
        $_POST['ejercicios']
    );
    header("Location: ../../frontend/views/rutinas.php?ok=creada");
    exit;
}

// Actualizar rutina
if (isset($_POST['actualizar_rutina'])) {
    $rutinas->actualizar(
        $_POST['id'],
        $_POST['nombre'],
        $_POST['descripcion'],
        $_POST['dia_semana'],
        $_POST['duracion'],
        $_POST['ejercicios']
    );
    header("Location: ../../frontend/views/rutinas.php?ok=actualizada");
    exit;
}

// Eliminar rutina
if (isset($_GET['eliminar'])) {
    $rutinas->eliminar($_GET['eliminar']);
    header("Location: ../../frontend/views/rutinas.php?ok=eliminada");
    exit;
}
