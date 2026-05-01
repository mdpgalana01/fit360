<?php
require_once "../../../backend/middleware/admin.php";
require_once "../../../backend/config/conexion.php";

if (!isset($_GET["id"])) {
    header("Location: gimnasios.php");
    exit();
}

$id = $_GET["id"];

$sql = "SELECT * FROM gimnasio WHERE id_gimnasio = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$gimnasio = $resultado->fetch_assoc();

if (!$gimnasio) {
    echo "Gimnasio no encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar gimnasio - Fit360</title>
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="../../css/admin-forms.css">

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
                <h1>Editar gimnasio</h1>
            </header>

            <section class="admin-card">
                <h2>Datos del gimnasio</h2>

                <form action="../../../backend/controllers/gimnasio-controller.php" method="POST" class="admin-form">

                    <input type="hidden" name="accion" value="editar">
                    <input type="hidden" name="id_gimnasio" value="<?= $gimnasio['id_gimnasio'] ?>">

                    <label>Nombre del gimnasio</label>
                    <input type="text" name="nombre" value="<?= htmlspecialchars($gimnasio['nombre']) ?>" required>

                    <label>Dirección</label>
                    <input type="text" name="direccion" value="<?= htmlspecialchars($gimnasio['direccion']) ?>" required>

                    <label>Email de contacto</label>
                    <input type="email" name="email_contacto" value="<?= htmlspecialchars($gimnasio['email_contacto']) ?>" required>

                    <label>Teléfono</label>
                    <input type="text" name="telefono" value="<?= htmlspecialchars($gimnasio['telefono']) ?>" required>

                    <label>Activo</label>
                    <select name="activo">
                        <option value="1" <?= $gimnasio['activo'] ? 'selected' : '' ?>>Sí</option>
                        <option value="0" <?= !$gimnasio['activo'] ? 'selected' : '' ?>>No</option>
                    </select>

                    <div class="admin-form-actions">
                        <button type="submit" class="admin-btn-primary">Guardar cambios</button>
                        <a href="gimnasios.php" class="admin-btn-secondary">Cancelar</a>
                    </div>

                </form>
            </section>

        </div>

    </main>


</div>

</body>
</html>
