<?php
//session_start();
require_once "../../../backend/middleware/admin.php";
require_once "../../../backend/config/conexion.php";

// Obtener todos los gimnasios
$sql = "SELECT * FROM gimnasio ORDER BY id_gimnasio DESC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de gimnasios - Fit360</title>
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="../../css/admin-forms.css"
</head>

<body>

<div class="dashboard-container">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <img src="../../assets/img/logo/logo-fit360.png" alt="Fit360">
        </div>

        <nav>
            <a href="dashboard.php">
                <img src="../../assets/img/dashboard/icon-dashboard.png">
                <span>Inicio</span>
            </a>

            <a href="gimnasios.php" class="active">
                <img src="../../assets/img/dashboard/icon-admin.png">
                <span>Gestión gimnasios</span>
            </a>

            <a href="usuarios.php">
                <img src="../../assets/img/dashboard/icon-users.png">
                <span>Gestión usuarios</span>
            </a>

            <a href="../../../backend/controllers/logout.php">
                <img src="../../assets/img/dashboard/icon-logout.png">
                <span>Cerrar sesión</span>
            </a>
        </nav>
    </aside>

    <!-- Contenido principal -->
    <main class="main-content">

        <div class="admin-container">

            <header class="dashboard-header">
                <h1>Gestión de gimnasios</h1>
                <a href="gimnasio-crear.php" class="admin-btn-primary">+ Añadir gimnasio</a>
            </header>

            <?php if (isset($_GET['msg'])): ?>
                <div class="admin-alert 
                    <?= $_GET['msg'] === 'creado' ? 'success' : '' ?>
                    <?= $_GET['msg'] === 'editado' ? 'info' : '' ?>
                    <?= $_GET['msg'] === 'eliminado' ? 'danger' : '' ?>
                ">
                    <?php
                        if ($_GET['msg'] === 'creado') echo "Gimnasio creado correctamente.";
                        if ($_GET['msg'] === 'editado') echo "Gimnasio actualizado correctamente.";
                        if ($_GET['msg'] === 'eliminado') echo "Gimnasio eliminado.";
                    ?>
                </div>
            <?php endif; ?>

            <section class="admin-card">
                <h2>Listado de gimnasios</h2>

                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Activo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($g = $resultado->fetch_assoc()): ?>
                            <tr>
                                <td><?= $g['id_gimnasio'] ?></td>
                                <td><?= htmlspecialchars($g['nombre']) ?></td>
                                <td><?= htmlspecialchars($g['direccion']) ?></td>
                                <td><?= htmlspecialchars($g['email_contacto']) ?></td>
                                <td><?= htmlspecialchars($g['telefono']) ?></td>
                                <td><?= $g['activo'] ? "Sí" : "No" ?></td>

                                <td class="admin-actions">
                                    <a href="gimnasio-editar.php?id=<?= $g['id_gimnasio'] ?>">
                                        ✏️ Editar
                                    </a>
                                    <a href="../../../backend/controllers/gimnasio-controller.php?eliminar=<?= $g['id_gimnasio'] ?>"
                                    onclick="return confirm('¿Seguro que deseas eliminar este gimnasio?')">
                                        🗑️ Eliminar
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>

                </table>
            </section>

        </div>

    </main>


</div>

</body>
</html>
