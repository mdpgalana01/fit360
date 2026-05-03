<?php
session_start();
require_once __DIR__ . '/../config/conexion.php';

// 1. Comprobar método
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../../frontend/views/registro.php");
    exit();
}

$nombre      = trim($_POST["nombre"] ?? "");
$apellidos   = trim($_POST["apellidos"] ?? "");
$email       = trim($_POST["email"] ?? "");
$contrasena  = trim($_POST["contrasena"] ?? "");

// 2. Validar campos vacíos
if ($nombre === "" || $apellidos === "" || $email === "" || $contrasena === "") {
    header("Location: ../../frontend/views/registro.php?msg=campos_vacios");
    exit();
}

// 3. Comprobar si el email ya existe
$sql = "SELECT id_usuario FROM usuario WHERE email = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    header("Location: ../../frontend/views/registro.php?msg=email_duplicado");
    exit();
}

// 4. Hashear contraseña
$hash = password_hash($contrasena, PASSWORD_DEFAULT);

// 5. Insertar usuario
$sql = "INSERT INTO usuario (nombre, apellidos, email, contrasena, fecha_registro, rol, id_gimnasio, avatar)
        VALUES (?, ?, ?, ?, CURDATE(), 'socio', 1, 'default-avatar.png')";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssss", $nombre, $apellidos, $email, $hash);

if ($stmt->execute()) {
    header("Location: ../../frontend/views/login.php?msg=registro_ok");
    exit();
} else {
    header("Location: ../../frontend/views/registro.php?msg=error");
    exit();
}

?>
