<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit();
}

require_once "../../backend/config/conexion.php";

$idUsuario = $_SESSION["id_usuario"];

// Obtener datos del usuario
$sql = "SELECT u.nombre, u.apellidos, u.email, u.rol, u.fecha_registro, 
               u.avatar,
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
    <title>Mi perfil - Fit360</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>
<div class="dashboard-container">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <img src="../assets/img/logo/logo-fit360.png" alt="Fit360">
        </div>

        <nav>
            <a href="dashboard.php">
                <img src="../assets/img/dashboard/icon-dashboard.png">
                <span>Inicio</span>
            </a>

            <a href="perfil.php" class="active">
                <img src="../assets/img/dashboard/icon-users.png">
                <span>Mi perfil</span>
            </a>

            <a href="#">
                <img src="../assets/img/dashboard/icon-routines.png">
                <span>Rutinas</span>
            </a>

            <a href="#">
                <img src="../assets/img/dashboard/icon-nutrition.png">
                <span>Nutrición</span>
            </a>

            <a href="#">
                <img src="../assets/img/dashboard/icon-progress.png">
                <span>Progreso</span>
            </a>

            <a href="../../backend/controllers/logout.php">
                <img src="../assets/img/dashboard/icon-logout.png">
                <span>Cerrar sesión</span>
            </a>
        </nav>
    </aside>

    <!-- Contenido principal -->
    <main class="main-content">

        <section class="profile-section">

            <div class="profile-card">
                <div class="profile-header-centered">

                    <h2 class="profile-title-centered">Información personal</h2>

                    <?php
                        $avatar = $usuario['avatar'] ?? "";

                        // Si no hay avatar, usar el avatar por defecto
                        if ($avatar === "" || !file_exists(__DIR__ . "/../assets/img/users/" . $avatar)) {
                            $avatar = "profile-avatar.png";

                        }
                    ?>

                    <div class="avatar-container-centered">
                        <img src="../assets/img/users/<?php echo htmlspecialchars($avatar); ?>"
                            alt="Avatar"
                            class="avatar-preview-centered">
                    </div>

                </div>

                <!-- IMPORTANTE: el input file va DENTRO del form -->
                <form action="../../backend/controllers/perfil-controller.php"
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

                    <div class="form-group">
                        <label>Gimnasio</label>
                        <input type="text" value="<?php echo htmlspecialchars($usuario['gimnasio']); ?>" disabled>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Rol</label>
                            <select name="rol" required>
                                <option value="admin"      <?php if ($usuario['rol'] === 'admin') echo 'selected'; ?>>Admin</option>
                                <option value="socio"      <?php if ($usuario['rol'] === 'socio') echo 'selected'; ?>>Socio</option>
                                <option value="entrenador" <?php if ($usuario['rol'] === 'entrenador') echo 'selected'; ?>>Entrenador</option>
                                <option value="dietista"   <?php if ($usuario['rol'] === 'dietista') echo 'selected'; ?>>Dietista</option>
                            </select>
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

</div> <!-- cierre de dashboard-container -->

</body>
</html>
