<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../frontend/login.php");
    exit();
}

require_once "conexion.php";

$idUsuario = $_SESSION["id_usuario"];

// Recoger datos del formulario
$nombre = trim($_POST["nombre"]);
$apellidos = trim($_POST["apellidos"]);
$rol = trim($_POST["rol"]); // nuevo campo

if ($nombre === "" || $apellidos === "") {
    header("Location: ../frontend/perfil.php?msg=campos_vacios");
    exit();
}

// Obtener avatar actual por si no se cambia
$sqlAvatar = "SELECT avatar FROM usuario WHERE id_usuario = ?";
$stmtAvatar = $conexion->prepare($sqlAvatar);
$stmtAvatar->bind_param("i", $idUsuario);
$stmtAvatar->execute();
$result = $stmtAvatar->get_result();
$usuarioActual = $result->fetch_assoc();
$avatar = $usuarioActual["avatar"]; // valor actual

// Procesar avatar si se ha subido uno nuevo
if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] === UPLOAD_ERR_OK) {

    $nombreTemp = $_FILES["avatar"]["tmp_name"];
    $nombreOriginal = $_FILES["avatar"]["name"];

    // Extensión segura
    $extension = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));
    $extensionesPermitidas = ["jpg", "jpeg", "png", "gif"];

    if (in_array($extension, $extensionesPermitidas)) {

        // Crear nombre único
        $nuevoNombre = "avatar_" . $idUsuario . "_" . time() . "." . $extension;

        // Ruta correcta donde guardar la imagen
        $rutaDestino = __DIR__ . "/../frontend/assets/img/users/" . $nuevoNombre;

        // Mover archivo
        if (move_uploaded_file($nombreTemp, $rutaDestino)) {
            $avatar = $nuevoNombre; // Guardamos solo el nombre del archivo
        }
    }
}

// Actualizar datos del usuario
$sql = "UPDATE usuario 
        SET nombre = ?, apellidos = ?, rol = ?, avatar = ?
        WHERE id_usuario = ?";

$stmt = $conexion->prepare($sql);

if (!$stmt) {
    die("Error en prepare: " . $conexion->error);
}

$stmt->bind_param("ssssi", $nombre, $apellidos, $rol, $avatar, $idUsuario);

if ($stmt->execute()) {

    // Actualizar sesión para que el dashboard muestre el nombre actualizado
    $_SESSION["nombre"] = $nombre;

    header("Location: ../frontend/perfil.php?msg=ok");
    exit();
} else {
    header("Location: ../frontend/perfil.php?msg=error");
    exit();
}
?>
