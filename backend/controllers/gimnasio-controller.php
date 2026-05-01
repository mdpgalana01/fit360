<?php
require_once "../config/conexion.php";

// Crear gimnasio
if (isset($_POST["accion"]) && $_POST["accion"] === "crear") {

    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $email = $_POST["email_contacto"];
    $telefono = $_POST["telefono"];
    $activo = $_POST["activo"];

    $sql = "INSERT INTO gimnasio (nombre, direccion, email_contacto, telefono, fecha_alta, activo)
            VALUES (?, ?, ?, ?, CURDATE(), ?)";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssi", $nombre, $direccion, $email, $telefono, $activo);

    if ($stmt->execute()) {
        header("Location: ../../frontend/views/admin/gimnasios.php?msg=creado");
        exit();
    } else {
        echo "Error al crear gimnasio: " . $conexion->error;
    }
}

// Editar gimnasio
if (isset($_POST["accion"]) && $_POST["accion"] === "editar") {

    $id = $_POST["id_gimnasio"];
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $email = $_POST["email_contacto"];
    $telefono = $_POST["telefono"];
    $activo = $_POST["activo"];

    $sql = "UPDATE gimnasio 
            SET nombre = ?, direccion = ?, email_contacto = ?, telefono = ?, activo = ?
            WHERE id_gimnasio = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssii", $nombre, $direccion, $email, $telefono, $activo, $id);

    if ($stmt->execute()) {
        header("Location: ../../frontend/views/admin/gimnasios.php?msg=editado");
        exit();
    } else {
        echo "Error al editar gimnasio: " . $conexion->error;
    }
}



// Eliminar gimnasio
if (isset($_GET["eliminar"])) {

    $id = $_GET["eliminar"];

    $sql = "DELETE FROM gimnasio WHERE id_gimnasio = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../../frontend/views/admin/gimnasios.php?msg=eliminado");
        exit();
    } else {
        echo "Error al eliminar gimnasio: " . $conexion->error;
    }
}

?>
