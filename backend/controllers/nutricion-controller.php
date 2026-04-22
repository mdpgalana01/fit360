<?php
require_once __DIR__ . '/../models/nutricion.php';
require_once __DIR__ . '/../config/session.php';

$nutricion = new Nutricion();

// Crear registro nutricional
if (isset($_POST['crear_nutricion'])) {
    $nutricion->create([
        "usuario_id" => $_SESSION['id_usuario'],
        "fecha" => $_POST["fecha"],
        "calorias" => $_POST["calorias"],
        "proteinas" => $_POST["proteinas"],
        "carbohidratos" => $_POST["carbohidratos"],
        "grasas" => $_POST["grasas"],
        "notas" => $_POST["notas"]
    ]);

    header("Location: ../../frontend/views/nutricion.php?ok=creado");
    exit;
}

// Actualizar registro nutricional
if (isset($_POST['actualizar_nutricion'])) {
    $nutricion->update($_POST["id"], [
        "fecha" => $_POST["fecha"],
        "calorias" => $_POST["calorias"],
        "proteinas" => $_POST["proteinas"],
        "carbohidratos" => $_POST["carbohidratos"],
        "grasas" => $_POST["grasas"],
        "notas" => $_POST["notas"]
    ]);

    header("Location: ../../frontend/views/nutricion.php?ok=actualizado");
    exit;
}

// Eliminar registro
if (isset($_GET['eliminar'])) {
    $nutricion->delete($_GET['eliminar']);
    header("Location: ../../frontend/views/nutricion.php?ok=eliminado");
    exit;
}
