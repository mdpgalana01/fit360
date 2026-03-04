/*
03/03/2026
Este archivo:
    - comprueba que hay sesión
    - muestra un saludo

Según el rol, muestra secciones distintas (de momento solo texto, luego ya lo adaptaré al wireframe)
*/

<?php
session_start();

// 1. Comprobar que el usuario ha iniciado sesión
if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../frontend/login.php");
    exit();
}

$nombre = $_SESSION["nombre"];
$rol    = $_SESSION["rol"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Fit360</title>
    <link rel="stylesheet" href="../frontend/dashboard.css">
</head>
<body>
    <header class="topbar">
        <div class="logo">Fit360</div>
        <div class="user-info">
            <span><?php echo htmlspecialchars($nombre); ?></span>
            <span class="rol"><?php echo htmlspecialchars($rol); ?></span>
            <a href="logout.php">Cerrar sesión</a>
        </div>
    </header>

    <div class="layout">
        <nav class="sidebar">
            <!-- Menú dinámico según rol -->
            <ul>
                <li>Inicio</li>

                <?php if ($rol === "admin"): ?>
                    <li>Usuarios</li>
                    <li>Clases</li>
                    <li>Rutinas</li>
                    <li>Estadísticas</li>
                <?php endif; ?>

                <?php if ($rol === "entrenador"): ?>
                    <li>Mis clases</li>
                    <li>Mis rutinas</li>
                    <li>Socios</li>
                <?php endif; ?>

                <?php if ($rol === "nutricionista"): ?>
                    <li>Pautas</li>
                    <li>Socios</li>
                <?php endif; ?>

                <?php if ($rol === "socio"): ?>
                    <li>Mis clases</li>
                    <li>Mis rutinas</li>
                    <li>Mi progreso</li>
                    <li>Mi nutrición</li>
                <?php endif; ?>
            </ul>
        </nav>

        <main class="content">
            <h1>Bienvenida, <?php echo htmlspecialchars($nombre); ?></h1>
            <p>Aquí irá el contenido principal según el rol.</p>
        </main>
    </div>
</body>
</html>

