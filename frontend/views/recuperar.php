<?php
$mensaje = "";
if (isset($_GET["msg"])) {
    switch ($_GET["msg"]) {
        case "email_vacio":
            $mensaje = "Por favor, introduce tu email.";
            break;
        case "email_no_existe":
            $mensaje = "Si existe una cuenta con ese email, recibirás instrucciones.";
            break;
        case "ok":
            $mensaje = "Si existe una cuenta con ese email, recibirás instrucciones.";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar contraseña | Fit360</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="login-container">

        <div class="login-left">
            <div class="logo">
                <img src="../assets/img/logo/logo-fit360.png" alt="Fit360">
            </div>

            <h1>Recuperar contraseña</h1>

            <?php if ($mensaje): ?>
                <p class="error"><?php echo $mensaje; ?></p>
            <?php endif; ?>

            <form action="../../backend/controllers/recuperar-controller.php" method="POST" class="login-form">

                <!--Input fantasma para engañar al navegador y que no coja por defecto un usuario y contraseña  -->
                <input type="text" name="fakeusernameremembered" style="display:none">
                

                <label>Email</label>
                <input type="email" name="email" required>

                <button type="submit" class="btn-login">Enviar instrucciones</button>

                <div class="links">
                    <a href="login.php">Volver al login</a>
                </div>
            </form>
        </div>

        <div class="login-right"></div>

    </div>
</body>
</html>
