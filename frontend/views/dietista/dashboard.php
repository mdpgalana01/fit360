<?php
require_once "../../../backend/middleware/dietista.php";
require_once "../../../backend/config/conexion.php";

$id = $_SESSION["id_usuario"];

$sql = "SELECT nombre, avatar FROM usuario WHERE id_usuario = ?";
$stmt = $conexion->prepare($sql);
if (!$stmt) {
    die("Error en prepare(): " . $conexion->error);
}
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

$nombre = $usuario['nombre'];
$avatar = $usuario['avatar'] ?? "";

if ($avatar === "" || !file_exists(__DIR__ . "/../../assets/img/users/" . $avatar)) {
    $avatar = "profile-avatar.png";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel dietista - Fit360</title>
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div id="loading-screen">
    <div class="loading-content">
        <img src="../../assets/img/logo/logo-fit360.png" class="loading-logo" alt="Fit360">
        <p class="loading-text">Cargando tu panel de dietista...</p>
        <div class="loading-bar">
            <div class="loading-progress" id="loading-progress"></div>
        </div>
        <span id="loading-percent">0%</span>
    </div>
</div>

<div class="dashboard-container">

    <aside class="sidebar">
        <div class="logo">
            <img src="../../assets/img/logo/logo-fit360.png" alt="Fit360">
        </div>

        <nav>
            <a href="#" class="active">
                <img src="../../assets/img/dashboard/icon-dashboard.png">
                <span>Inicio</span>
            </a>

            <a href="#">
                <img src="../../assets/img/dashboard/icon-nutrition.png">
                <span>Planes nutricionales</span>
            </a>

            <a href="#">
                <img src="../../assets/img/dashboard/icon-health.png">
                <span>Salud y hábitos</span>
            </a>

            <a href="#">
                <img src="../../assets/img/dashboard/icon-progress.png">
                <span>Seguimiento</span>
            </a>

            <a href="perfil.php">
                <img src="../../assets/img/dashboard/icon-settings.png">
                <span>Mi perfil</span>
            </a>


            <a href="../../../backend/controllers/logout.php">
                <img src="../../assets/img/dashboard/icon-logout.png">
                <span>Cerrar sesión</span>
            </a>
        </nav>
    </aside>

    <main class="main-content">

        <header class="dashboard-header">
            <div class="header-search">
                <input type="text" placeholder="Buscar socio, plan...">
            </div>

            <div class="header-right">
                <div class="header-icons">
                    <img src="../../assets/img/dashboard/icon-bell.png" class="header-icon" alt="">
                    <img src="../../assets/img/dashboard/icon-settings.png" class="header-icon" alt="">
                </div>

                <div class="header-user">
                    <a href="perfil.php" class="user-name-link">
                        <?php echo htmlspecialchars($nombre); ?>
                    </a>
                    <div class="user-avatar">
                        <img src="../../assets/img/users/<?php echo htmlspecialchars($avatar); ?>" alt="Usuario">
                    </div>
                </div>
            </div>
        </header>

        <section class="dashboard-banner">
            <div class="banner-text">
                <h1>Hola, <?php echo htmlspecialchars($nombre); ?></h1>
                <p class="subtitle">Tu panel como dietista</p>
                <span class="description">Crea, ajusta y sigue los planes nutricionales de los socios.</span>
            </div>
        </section>

        <section class="dashboard-grid">

            <div class="card">
                <img src="../../assets/img/dashboard/icon-nutrition.png" class="card-icon" alt="">
                <h3>Planes activos</h3>
                <div class="title">18 planes en curso</div>
                <span>Revisa y ajusta la alimentación.</span>
            </div>

            <div class="card">
                <img src="../../assets/img/dashboard/icon-health.png" class="card-icon" alt="">
                <h3>Salud general</h3>
                <p class="title">Estado estable</p>
                <span>Sin alertas críticas recientes.</span>
            </div>

            <div class="card">
                <img src="../../assets/img/dashboard/icon-progress.png" class="card-icon" alt="">
                <h3>Progreso nutricional</h3>
                <p class="title">Seguimiento activo</p>
                <span>Evalúa adherencia y resultados.</span>
            </div>

            <div class="card">
                <img src="../../assets/img/dashboard/icon-stats.png" class="card-icon" alt="">
                <h3>Indicadores clave</h3>
                <p class="title">Peso, IMC, hábitos</p>
                <span>Resumen de métricas relevantes.</span>
            </div>

            <div class="card">
                <img src="../../assets/img/dashboard/icon-time.png" class="card-icon" alt="">
                <h3>Próxima revisión</h3>
                <p class="title">Cita con Ana López</p>
                <span>Mañana - 11:30 h</span>
            </div>

            <div class="card">
                <img src="../../assets/img/dashboard/icon-calendar.png" class="card-icon" alt="">
                <h3>Agenda</h3>
                <p class="title">Revisiones semanales</p>
                <span>Organiza tus citas y seguimientos.</span>
            </div>

        </section>

    </main>
</div>

<script src="../../js/dashboard.js"></script>
</body>
</html>
