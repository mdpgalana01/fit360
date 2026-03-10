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
<!--        
        <nav>
            <a href="#">Inicio</a>
            <a href="#">Mi perfil</a>
            <a href="#">Rutinas</a>
            <a href="#">Nutrición</a>
            <a href="#">Progreso</a>
            <a href="../backend/logout.php">Cerrar sesión</a>
        </nav>
-->
        <nav>

<a href="#">
<img src="./assets/img/dashboard/icon-dashboard.png">
<span>Inicio</span>
</a>

<a href="#">
<img src="./assets/img/dashboard/icon-users.png">
<span>Mi perfil</span>
</a>

<a href="#">
<img src="./assets/img/dashboard/icon-routines.png">
<span>Rutinas</span>
</a>

<a href="#">
<img src="./assets/img/dashboard/icon-nutrition.png">
<span>Nutrición</span>
</a>

<a href="#">
<img src="./assets/img/dashboard/icon-progress.png">
<span>Progreso</span>
</a>

<a href="../backend/logout.php">
<img src="./assets/img/dashboard/icon-logout.png">
<span>Cerrar sesión</span>
</a>

</nav>
    </aside>

    <main class="main-content">

    <header class="dashboard-header">

        <div class="header-search">
            <input type="text" placeholder="Buscar...">
        </div>

        <div class="header-user">
            <span class="user-name"><?php echo htmlspecialchars($nombre); ?></span>
            <div class="user-avatar">
                <img src="./assets/img/users/user-profile.jpg" alt="Usuario">
            </div>
        </div>

    </header>

    <!-- Banner grande -->
    <section class="dashboard-banner">
        <div class="banner-text">
            <h1>Bienvenida de nuevo, <?php echo htmlspecialchars($nombre); ?></h1>
            <p class="subtitle">Tu progreso en Fit360</p>
            <span class="description">Revisa tus rutinas, clases y evolución de un vistazo.</span>
        </div>
    </section>

    <!-- Tarjetas del dashboard -->
    <section class="dashboard-grid">
        
        <div class="card">
            <h3>Rutina actual</h3>
            <p class="title">Piernas y glúteos</p>
            <span>45 min</span>
        </div>

        <div class="card">
            <h3>Progreso</h3>
            <p class="title">Semana 3 de 86</p>
            <span>2% completado</span>
        </div>

        <div class="card">
            <h3>Próxima clase</h3>
            <p class="title">HIIT Cardio con Laura</p>
            <span>Mañana - 18:00 h</span>
        </div>

        <div class="card">
            <h3>Rutina anterior</h3>
            <p class="title">Core con pesas</p>
            <span>45 min</span>
        </div>

        <div class="card">
            <h3>Progreso semanal</h3>
            <p class="title">Has entrenado 4 días</p>
            <span>+12% respecto a la pasada</span>
        </div>

        <div class="card">
            <h3>Próxima clase</h3>
            <p class="title">Yoga Flow con Jo</p>
            <span>Viernes - 09:30 h</span>
        </div>

    </section>

</main>

</div>

</body>
</html>

