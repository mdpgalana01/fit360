<?php
// Solo entrenadores pueden entrar aquí
require_once "../../../backend/middleware/entrenador.php";
require_once "../../../backend/config/conexion.php";

$idUsuario = $_SESSION["id_usuario"];

// Obtener datos del usuario
$sql = "SELECT u.nombre, u.apellidos, u.email, u.rol, u.fecha_registro, 
               u.avatar
        FROM usuario u
        WHERE u.id_usuario = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

// Avatar
$avatar = $usuario['avatar'] ?? "";
if ($avatar === "" || !file_exists(__DIR__ . "/../../assets/img/users/" . $avatar)) {
    $avatar = "profile-avatar.png";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi perfil (Entrenador) - Fit360</title>
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="../../css/perfil.css">
</head>

<body>
<div class="dashboard-container">

    <!-- Sidebar ENTRENADOR -->
    <aside class="sidebar">
        <div class="logo">
            <img src="../../assets/img/logo/logo-fit360.png" alt="Fit360">
        </div>

        <nav>
            <a href="dashboard.php">
                <img src="../../assets/img/dashboard/icon-dashboard.png">
                <span>Inicio</span>
            </a>

            <a href="#">
                <img src="../../assets/img/dashboard/icon-routines.png">
                <span>Mis rutinas</span>
            </a>

            <a href="#">
                <img src="../../assets/img/dashboard/icon-classes.png">
                <span>Clases asignadas</span>
            </a>

            <a href="#">
                <img src="../../assets/img/dashboard/icon-progress.png">
                <span>Progreso alumnos</span>
            </a>

            <a href="perfil.php" class="active">
                <img src="../../assets/img/dashboard/icon-settings.png">
                <span>Mi perfil</span>
            </a>

            <a href="../../../backend/controllers/logout.php">
                <img src="../../assets/img/dashboard/icon-logout.png">
                <span>Cerrar sesión</span>
            </a>
        </nav>
    </aside>


    <!-- Contenido principal -->
    <main class="main-content">

        <section class="profile-section">

            <div class="profile-card">
                <div class="profile-header-centered">

                    <h2 class="profile-title-centered">Información personal (Entrenador)</h2>

                    <div class="avatar-container-centered">
                        <img src="../../assets/img/users/<?php echo htmlspecialchars($avatar); ?>"
                             alt="Avatar"
                             class="avatar-preview-centered">
                    </div>

                </div>

                <form action="../../../backend/controllers/perfil-controller.php"
                      method="POST"
                      enctype="multipart/form-data"
                      class="profile-form">

                    <div class="avatar-block-centered">
                        <label>Foto de perfil</label>

                        <label class="avatar-upload-centered">
                            Cambiar foto
                            <input type="file" name="avatar" accept="image/*">
                        </label>
                    </div>

                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text" name="apellidos" value="<?php echo htmlspecialchars($usuario['apellidos']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Email (no editable)</label>
                        <input type="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" disabled>
                    </div>

                    <div class="form-row">
                        <div class="form-group half">
                            <label>Rol</label>
                            <input type="text" value="<?php echo htmlspecialchars($usuario['rol']); ?>" disabled>
                        </div>

                        <div class="form-group half">
                            <label>Fecha de registro</label>
                            <input type="text" value="<?php echo htmlspecialchars($usuario['fecha_registro']); ?>" disabled>
                        </div>
                    </div>

                    <button type="submit" class="btn-save">Guardar cambios</button>

                </form>

            </div>

        </section>

    </main>

</div>

</body>
</html>
