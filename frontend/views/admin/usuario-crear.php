<?php
require_once "../../../backend/middleware/admin.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear usuario - Admin</title>
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
            <h1>Crear nuevo usuario</h1>
        </header>

        <section class="admin-section">

            <form action="../../../backend/controllers/usuario-controller.php" 
                  method="POST" 
                  class="admin-form"
                  autocomplete="off">

                <input type="hidden" name="accion" value="crear">

                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" required>
                </div>

                <div class="form-group">
                    <label>Apellidos</label>
                    <input type="text" name="apellidos" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" autocomplete="off" required>
                </div>

                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" name="contrasena" autocomplete="new-password" required>
                </div>

                <div class="form-group">
                    <label>Rol</label>
                    <select name="rol" required>
                        <option value="socio">Socio</option>
                        <option value="entrenador">Entrenador</option>
                        <option value="dietista">Dietista</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>

                <div class="admin-form-actions">
                    <button type="submit" class="admin-btn-primary">Crear usuario</button>
                    <a href="usuarios.php" class="admin-btn-secondary">Cancelar</a>
                </div>


            </form>

        </section>

    </main>

</div>

</body>
</html>
