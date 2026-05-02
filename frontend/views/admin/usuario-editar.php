<?php
require_once "../../../backend/middleware/admin.php";
require_once "../../../backend/config/conexion.php";
require_once "../../../backend/models/usuario.php";

if (!isset($_GET["id"])) {
    header("Location: usuarios.php");
    exit();
}

$idUsuario = intval($_GET["id"]);

$usuarioModel = new Usuario($conexion);
$usuario = $usuarioModel->getById($idUsuario);

if (!$usuario) {
    header("Location: usuarios.php?msg=no_encontrado");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar usuario - Admin</title>
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="../../css/admin-forms.css">
</head>

<body>

<div class="dashboard-container">

    <!-- SIDEBAR ADMIN -->
    <aside class="sidebar">
        <div class="logo">
            <img src="../../assets/img/logo/logo-fit360.png" alt="Fit360">
        </div>

        <nav>
            <a href="dashboard.php">
                <img src="../../assets/img/dashboard/icon-dashboard.png">
                <span>Inicio</span>
            </a>

            <a href="usuarios.php" class="active">
                <img src="../../assets/img/dashboard/icon-users.png">
                <span>Usuarios</span>
            </a>

            <a href="gimnasios.php">
                <img src="../../assets/img/dashboard/icon-workout.png">
                <span>Gimnasios</span>
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

    <!-- CONTENIDO PRINCIPAL -->
    <main class="main-content">

        <header class="dashboard-header">
            <h1>Editar usuario</h1>
        </header>

        <section class="admin-section">

            <form action="../../../backend/controllers/usuario-controller.php" 
                  method="POST" 
                  class="admin-form">

                <input type="hidden" name="accion" value="editar">
                <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">

                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" 
                           value="<?php echo htmlspecialchars($usuario['nombre']); ?>" 
                           required>
                </div>

                <div class="form-group">
                    <label>Apellidos</label>
                    <input type="text" name="apellidos" 
                           value="<?php echo htmlspecialchars($usuario['apellidos']); ?>" 
                           required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" 
                           value="<?php echo htmlspecialchars($usuario['email']); ?>" 
                           required>
                </div>

                <div class="form-group">
                    <label>Rol</label>
                    <select name="rol" required>
                        <option value="socio"      <?php if ($usuario['rol'] === 'socio') echo 'selected'; ?>>Socio</option>
                        <option value="entrenador" <?php if ($usuario['rol'] === 'entrenador') echo 'selected'; ?>>Entrenador</option>
                        <option value="dietista"   <?php if ($usuario['rol'] === 'dietista') echo 'selected'; ?>>Dietista</option>
                        <option value="admin"      <?php if ($usuario['rol'] === 'admin') echo 'selected'; ?>>Administrador</option>
                    </select>
                </div>

                <div class="admin-form-actions">
                    <button type="submit" class="admin-btn-primary">Guardar cambios</button>
                    <a href="usuarios.php" class="admin-btn-secondary">Cancelar</a>
                </div>


            </form>

        </section>

    </main>

</div>

</body>
</html>
