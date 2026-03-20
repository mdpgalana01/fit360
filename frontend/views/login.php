<?php
// Mostrar errores del backend si vienen por GET
$errorMsg = "";
if (isset($_GET["error"])) {
    switch ($_GET["error"]) {
        case "campos_vacios":
            $errorMsg = "Por favor, rellena todos los campos.";
            break;
        case "usuario_no_encontrado":
            $errorMsg = "No existe ningún usuario con ese email.";
            break;
        case "contrasena_incorrecta":
            $errorMsg = "La contraseña no es correcta.";
            break;
        default:
            $errorMsg = "Ha ocurrido un error al iniciar sesión.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login | Fit360</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="login-container">

        <!-- Columna izquierda -->
        <div class="login-left">
            <div class="logo">
                <img src="../assets/img/logo/logo-fit360.png" alt="Fit360">
            </div>

            <h1>Iniciar sesión</h1>

            <?php if ($errorMsg): ?>
                <p class="error"><?php echo $errorMsg; ?></p>
            <?php endif; ?>

            <?php if (isset($_GET["msg"]) && $_GET["msg"] === "registro_ok"): ?>
                <p class="success">Tu cuenta ha sido creada correctamente. Ahora puedes iniciar sesión.</p>
            <?php endif; ?>


            <form action="../../backend/controllers/login-controller.php" method="POST" class="login-form">

                <label>Email</label>
                <input type="email" name="email" required>

                <label>Contraseña</label>
                <input type="password" name="contrasena" required>

                <button type="submit" class="btn-login">Entrar</button>

                <div class="links">
                    <a href="recuperar.php">¿Has olvidado tu contraseña?</a>
                    <a href="registro.php">Crear cuenta</a>
                </div>
            </form>
        </div>

        <!-- Columna derecha -->
        <div class="login-right"></div>

    </div>
</body>

</html>
