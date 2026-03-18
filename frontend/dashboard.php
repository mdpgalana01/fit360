<?php
session_start();

// Comprobar que el usuario ha iniciado sesión
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit();
}

// $nombre = $_SESSION["nombre"];

require_once "../backend/conexion.php";

$idUsuario = $_SESSION["id_usuario"];

// Consulta para obtener datos completos del usuario + gimnasio
$sql = "SELECT u.nombre, u.apellidos, u.email, u.rol, u.fecha_registro,
               g.nombre AS gimnasio
        FROM usuario u
        LEFT JOIN gimnasio g ON u.id_gimnasio = g.id_gimnasio
        WHERE u.id_usuario = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Fit360</title>
    <link rel="stylesheet" href="./css/dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>

<div class="dashboard-container">

    <aside class="sidebar">
        <div class="logo">
            <img src="./assets/img/logo/logo-fit360.png" alt="Fit360">
        </div>

        <nav>
            <a href="#" class="active">
            <img src="./assets/img/dashboard/icon-dashboard.png">
            <span>Inicio</span>
            </a>

            <a href="perfil.php">
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

        <div class="header-right">
        
            <div class="header-icons">
                <img src="assets/img/dashboard/icon-bell.png" class="header-icon" alt="">
                <img src="assets/img/dashboard/icon-settings.png" class="header-icon" alt="">
            </div>

            <div class="header-user">
                <span class="user-name"><?php echo htmlspecialchars($usuario["nombre"]); ?></span>
                <div class="user-avatar">
                    <img src="./assets/img/users/user-profile.jpg" alt="Usuario">
                </div>
            </div>

        </div>

    </header>


    <!-- Banner grande -->
    <section class="dashboard-banner">
        <div class="banner-text">
            <h1>Bienvenida de nuevo, <?php echo htmlspecialchars($usuario["nombre"]); ?></h1>
            <p class="subtitle">Tu progreso en Fit360</p>
            <span class="description">Revisa tus rutinas, clases y evolución de un vistazo.</span>
        </div>
    </section>

    <!-- Tarjetas del dashboard -->
    <section class="dashboard-grid">
        
        <div class="card">
            <img src="assets/img/dashboard/icon-routines.png" class="card-icon" alt="">
            <h3>RUTINA ACTUAL</h3>
            <div class="title">Piernas y glúteos</div>
            <span>45 min</span>
        </div>


        <div class="card">
            <img src="assets/img/dashboard/icon-progress.png" class="card-icon" alt="">
            <h3>Progreso</h3>
            <p class="title">Semana 3 de 86</p>
            <span>2% completado</span>
        </div>

        <div class="card">
            <img src="assets/img/dashboard/icon-time.png" class="card-icon" alt="">
            <h3>Próxima clase hoy</h3>
            <p class="title">HIIT Cardio con Laura</p>
            <span>18:00 h</span>
        </div>

        <div class="card">
            <img src="assets/img/dashboard/icon-workout.png" class="card-icon" alt="">
            <h3>Rutina anterior</h3>
            <p class="title">Core con pesas</p>
            <span>45 min</span>
        </div>

        <div class="card">
            <img src="assets/img/dashboard/icon-stats.png" class="card-icon" alt="">
            <h3>Progreso semanal</h3>
            <p class="title">Has entrenado 4 días</p>
            <span>+12% respecto a la pasada</span>
        </div>

        <div class="card">
            <img src="assets/img/dashboard/icon-calendar.png" class="card-icon" alt="">
            <h3>Próxima clase semanal</h3>
            <p class="title">Yoga Flow con Jo</p>
            <span>Viernes - 09:30 h</span>
        </div>

    </section>

</main>

</div>

</body>
</html>

