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


            <form action="../../backend/controllers/login-controller.php" method="POST" class="login-form"  autocomplete="off">

                <!--Input fantasma para engañar al navegador y que no coja por defecto un usuario y contraseña  -->
                <input type="text" name="fakeusernameremembered" style="display:none">
                <input type="password" name="fakepasswordremembered" style="display:none"> 
                

                <label>Email</label>
                <input type="email" id="email" name="email"  autocomplete="off" required>
                <div id="email-error" class="error-msg"></div>

                <label>Contraseña</label>
                <input type="password" id="password" name="contrasena" autocomplete="off" required>

                <!-- Botón mostrar/ocultar contraseña -->
                <button type="button" id="toggle-pass" class="toggle-pass">Mostrar</button>

                <div id="password-error" class="error-msg"></div>

                <button type="submit" id="btn-login" class="btn-login">Entrar</button>

                <div class="links">
                    <a href="recuperar.php">¿Has olvidado tu contraseña?</a>
                    <a href="registro.php">Crear cuenta</a>
                </div>
            </form>

        </div>

        <!-- Columna derecha -->
        <div class="login-right"></div>

    </div>
    <script src="../js/login.js"></script>

</body>

</html>
