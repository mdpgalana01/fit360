<!-- archivo de seguridad (middleware) -->
<?php
session_start();

// Si no hay sesión, fuera
if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../../frontend/views/login.php");
    exit();
}
?>
