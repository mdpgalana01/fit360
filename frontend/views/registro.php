<?php
// Mostrar mensajes
$mensaje = "";
if (isset($_GET["msg"])) {
    switch ($_GET["msg"]) {
        case "campos_vacios":
            $mensaje = "Por favor, rellena todos los campos.";
            break;
        case "email_duplicado":
            $mensaje = "Ya existe un usuario con ese email.";
            break;
        case "registro_ok":
            $mensaje = "Cuenta creada correctamente. Ya puedes iniciar sesión.";
            break;
        default:
            $mensaje = "Ha ocurrido un error.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear cuenta | Fit360</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="login-container">

        <div class="login-left">
            <div class="logo">
                <img src="../assets/img/logo/logo-fit360.png" alt="Fit360">
            </div>

            <h1>Crear cuenta</h1>

            <?php if ($mensaje): ?>
                <p class="error"><?php echo $mensaje; ?></p>
            <?php endif; ?>

            <form action="../../backend/controllers/registro-controller.php" method="POST" class="login-form">

                <label>Nombre</label>
                <input type="text" name="nombre" required>

                <label>Apellidos</label>
                <input type="text" name="apellidos" required>

                <label>Email</label>
                <input type="email" name="email" required>

                <label>Contraseña</label>
                <input type="password" name="contrasena" required>

                <button type="submit" class="btn-login">Crear cuenta</button>

                <div class="links">
                    <a href="login.php">¿Ya tienes cuenta? Inicia sesión</a>
                </div>
            </form>
        </div>

        <div class="login-right"></div>

    </div>
</body>
</html>
