<?php
session_start();

// Comprobar que el usuario ha iniciado sesión
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit();
}

$nombre = $_SESSION["nombre"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Fit360</title>
    <link rel="stylesheet" href="./css/dashboard.css">
</head>
<body>

<div class="dashboard-container">

    <aside class="sidebar">
        <h2>Fit360</h2>
        <nav>
            <a href="#">Inicio</a>
            <a href="#">Mi perfil</a>
            <a href="#">Rutinas</a>
            <a href="#">Nutrición</a>
            <a href="#">Progreso</a>
            <a href="../backend/logout.php">Cerrar sesión</a>
        </nav>
    </aside>

    <main class="main-content">
        <header class="dashboard-header">
            <div class="user-info">
                <img src="assets/img/users/user-profile.jpg" alt="Foto de perfil" class="profile-photo">
                <div>
                    <h1>Bienvenida de nuevo, <?php echo htmlspecialchars($nombre); ?></h1>
                    <p class="subtitle">Tu progreso en Fit360</p>
                </div>
            </div>
        </header>

        <p>Este es tu panel principal.</p>
    </main>

</div>

</body>
</html>
