/*
03/03/2026
Este archivo:
    - recibe email y contrasena por POST
    - busca el usuario en la tabla
    - verifica la contraseña con password_verify()
    - inicia sesión
    - redirige a dashboard.php si todo va bien
    - si falla, devuelve al login con un mensaje

Más adelante, cuando tengamos el login.html, el formulario apuntará a ../backend/login.php por POST.    
*/

<?php
session_start();
require_once "conexion.php";

// 1. Comprobar que vienen datos por POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../frontend/login.html");
    exit();
}

$email = trim($_POST["email"] ?? "");
$contrasena = trim($_POST["contrasena"] ?? "");

// 2. Validaciones básicas
if ($email === "" || $contrasena === "") {
    // Más adelante esto lo mostraremos bonito en el front
    header("Location: ../frontend/login.html?error=campos_vacios");
    exit();
}

// 3. Buscar usuario por email
$sql = "SELECT id_usuario, nombre, email, contrasena, rol, id_gimnasio 
        FROM usuario 
        WHERE email = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    // No existe el usuario
    header("Location: ../frontend/login.html?error=usuario_no_encontrado");
    exit();
}

$usuario = $resultado->fetch_assoc();

// 4. Verificar contraseña
if (!password_verify($contrasena, $usuario["contrasena"])) {
    // Contraseña incorrecta
    header("Location: ../frontend/login.html?error=contrasena_incorrecta");
    exit();
}

// 5. Iniciar sesión
$_SESSION["id_usuario"]  = $usuario["id_usuario"];
$_SESSION["nombre"]      = $usuario["nombre"];
$_SESSION["email"]       = $usuario["email"];
$_SESSION["rol"]         = $usuario["rol"];
$_SESSION["id_gimnasio"] = $usuario["id_gimnasio"];

// 6. Redirigir al dashboard único
header("Location: dashboard.php");
exit();
?>
