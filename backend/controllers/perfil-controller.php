<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../../frontend/views/login.php");
    exit();
}

require_once __DIR__ . '/../config/conexion.php';

$idUsuario = $_SESSION["id_usuario"];

// Recoger datos del formulario
$nombre = trim($_POST["nombre"]);
$apellidos = trim($_POST["apellidos"]);

if ($nombre === "" || $apellidos === "") {
    redirigirSegunRol($_SESSION["rol"] ?? 'socio', "campos_vacios");
    exit();
}

// Obtener datos actuales del usuario (incluido rol y avatar)
$sqlUsuario = "SELECT rol, avatar FROM usuario WHERE id_usuario = ?";
$stmtUsuario = $conexion->prepare($sqlUsuario);
$stmtUsuario->bind_param("i", $idUsuario);
$stmtUsuario->execute();
$resultUsuario = $stmtUsuario->get_result();
$usuarioActual = $resultUsuario->fetch_assoc();

if (!$usuarioActual) {
    redirigirSegunRol($_SESSION["rol"] ?? 'socio', "error");
    exit();
}

$rol = $usuarioActual["rol"];      // rol REAL desde BD
$avatar = $usuarioActual["avatar"]; // avatar actual

// Procesar avatar si se ha subido uno nuevo
if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] === UPLOAD_ERR_OK) {

    $nombreTemp = $_FILES["avatar"]["tmp_name"];
    $nombreOriginal = $_FILES["avatar"]["name"];

    $extension = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));
    $extensionesPermitidas = ["jpg", "jpeg", "png", "gif"];

    if (in_array($extension, $extensionesPermitidas)) {

        $nuevoNombre = "avatar_" . $idUsuario . "_" . time() . "." . $extension;

        $rutaDestino = __DIR__ . "/../../frontend/assets/img/users/" . $nuevoNombre;

        if (move_uploaded_file($nombreTemp, $rutaDestino)) {
            $avatar = $nuevoNombre;
        }
    }
}

// Actualizar datos del usuario (SIN tocar el rol)
$sql = "UPDATE usuario 
        SET nombre = ?, apellidos = ?, avatar = ?
        WHERE id_usuario = ?";

$stmt = $conexion->prepare($sql);

if (!$stmt) {
    die("Error en prepare: " . $conexion->error);
}

$stmt->bind_param("sssi", $nombre, $apellidos, $avatar, $idUsuario);

if ($stmt->execute()) {

    // Actualizar sesión para que el dashboard muestre el nombre correcto
    $_SESSION["nombre"] = $nombre;
    $_SESSION["rol"] = $rol; // nos aseguramos de mantener el rol real

    redirigirSegunRol($rol, "ok");
    exit();

} else {
    redirigirSegunRol($rol, "error");
    exit();
}


// ---------------------------------------------------------
// FUNCIÓN DE REDIRECCIÓN SEGÚN ROL
// ---------------------------------------------------------
function redirigirSegunRol($rol, $msg)
{
    switch ($rol) {

        case "admin":
            header("Location: ../../frontend/views/admin/perfil.php?msg=$msg");
            break;

        case "entrenador":
            header("Location: ../../frontend/views/entrenador/perfil.php?msg=$msg");
            break;

        case "dietista":
            header("Location: ../../frontend/views/dietista/perfil.php?msg=$msg");
            break;

        default: // socio
            header("Location: ../../frontend/views/perfil.php?msg=$msg");
            break;
    }
    exit();
}
?>
