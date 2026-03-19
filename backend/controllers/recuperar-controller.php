<?php
require_once __DIR__ . '/../config/conexion.php';

// 1. Comprobar método
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../../frontend/views/recuperar.php");
    exit();
}

$email = trim($_POST["email"] ?? "");

// 2. Validar email vacío
if ($email === "") {
    header("Location: ../../frontend/views/recuperar.php?msg=email_vacio");
    exit();
}

// 3. Comprobar si el email existe
$sql = "SELECT id_usuario FROM usuario WHERE email = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

// 4. Siempre devolvemos el mismo mensaje por seguridad
header("Location: ../../frontend/views/recuperar.php?msg=ok");
exit();
