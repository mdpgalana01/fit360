<?php
require_once "../../../backend/middleware/admin.php";
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
    <title>Panel admin - Fit360</title>
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div id="loading-screen">
    <div class="loading-content">
        <img src="../../assets/img/logo/logo-fit360.png" class="loading-logo" alt="Fit360">
        <p class="loading-text">Cargando panel de administración...</p>
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

            <a href="usuarios.php">
                <img src="../../assets/img/dashboard/icon-users.png">
                <span>Gestión usuarios</span>
            </a>

            <a href="#">
                <img src="../../assets/img/dashboard/icon-classes.png">
                <span>Clases y horarios</span>
            </a>

            <a href="#">
                <img src="../../assets/img/dashboard/icon-stats.png">
                <span>Estadísticas</span>
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
                <input type="text" placeholder="Buscar...">
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
                <p class="subtitle">Panel de administración</p>
                <span class="description">Gestiona usuarios, clases, estadísticas y el funcionamiento global del gimnasio.</span>
            </div>
        </section>

        <section class="dashboard-grid">

            <div class="card">
                <img src="../../assets/img/dashboard/icon-users.png" class="card-icon" alt="">
                <h3>Usuarios activos</h3>
                <div class="title">245 socios</div>
                <span>Revisa altas, bajas y roles.</span>
            </div>

            <div class="card">
                <img src="../../assets/img/dashboard/icon-classes.png" class="card-icon" alt="">
                <h3>Clases de hoy</h3>
                <p class="title">18 clases programadas</p>
                <span>Comprueba ocupación y asistencia.</span>
            </div>

            <div class="card">
                <img src="../../assets/img/dashboard/icon-stats.png" class="card-icon" alt="">
                <h3>Estadísticas</h3>
                <p class="title">Visión general</p>
                <span>Actividad, reservas y uso del centro.</span>
            </div>

            <div class="card">
                <img src="../../assets/img/dashboard/icon-health.png" class="card-icon" alt="">
                <h3>Salud del sistema</h3>
                <p class="title">Todo funcionando</p>
                <span>Sin incidencias registradas.</span>
            </div>

            <div class="card">
                <img src="../../assets/img/dashboard/icon-admin.png" class="card-icon" alt="">
                <h3>Gestión interna</h3>
                <p class="title">Roles y permisos</p>
                <span>Control total de accesos.</span>
            </div>

            <div class="card">
                <img src="../../assets/img/dashboard/icon-calendar.png" class="card-icon" alt="">
                <h3>Próximos eventos</h3>
                <p class="title">Reuniones y campañas</p>
                <span>Planifica acciones para socios.</span>
            </div>

        </section>

    </main>
</div>

<script src="../../js/dashboard.js"></script>
</body>
</html>
