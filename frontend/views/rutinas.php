<?php
require_once __DIR__ . '/../../backend/controllers/rutinas-controller.php';
$rutinasLista = $rutinas->obtenerPorUsuario($_SESSION['id_usuario']);

if (isset($_GET['editar'])) {
    $rutinaEditar = $rutinas->obtenerPorId($_GET['editar']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Rutinas - Fit360</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/rutinas.css">
</head>

<script>
    setTimeout(() => {
        const msg = document.querySelector('.msg');
        if (msg) {
            msg.style.transition = "opacity 0.5s";
            msg.style.opacity = "0";
            setTimeout(() => msg.remove(), 500);
        }
    }, 3000);
</script>

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

            <a href="perfil.php">
                <img src="../assets/img/dashboard/icon-users.png">
                <span>Mi perfil</span>
            </a>

            <a href="rutinas.php" class="active">
                <img src="../assets/img/dashboard/icon-routines.png">
                <span>Rutinas</span>
            </a>

            <a href="nutricion.php">
                <img src="../assets/img/dashboard/icon-nutrition.png">
                <span>Nutrición</span>
            </a>

            <a href="progreso.php">
                <img src="../assets/img/dashboard/icon-progress.png">
                <span>Progreso</span>
            </a>

            <a href="../../backend/controllers/logout.php">
                <img src="../assets/img/dashboard/icon-logout.png">
                <span>Cerrar sesión</span>
            </a>
        </nav>
    </aside>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="main-content">

        <div class="rutinas-container">
            <h1 class="page-title">Mis Rutinas</h1>

            <?php if (isset($_GET['ok'])): ?>
                <div class="msg success">Registro guardado correctamente.</div>
            <?php endif; ?>

            <?php if (isset($_GET['error']) && $_GET['error'] === 'campos'): ?>
                <div class="msg error">El peso es obligatorio.</div>
            <?php endif; ?>

            <?php if (isset($_GET['error']) && $_GET['error'] === 'numerico'): ?>
                <div class="msg error">Todos los valores deben ser numéricos.</div>
            <?php endif; ?>

            <?php if (isset($_GET['error']) && $_GET['error'] === 'negativo'): ?>
                <div class="msg error">El peso no puede ser negativo.</div>
            <?php endif; ?>

        

        <?php if (!isset($rutinaEditar)): ?>
        <section class="form-card">
            <h2>Añadir rutina</h2>
            <form method="POST">
                <input type="text" name="nombre" placeholder="Nombre de la rutina" required>
                <textarea name="descripcion" placeholder="Descripción"></textarea>
                <input type="text" name="dia_semana" placeholder="Día de la semana">
                <input type="number" name="duracion" placeholder="Duración (min)">
                <textarea name="ejercicios" placeholder="Ejercicios (separados por comas)"></textarea>
                <button type="submit" name="crear_rutina">Guardar</button>
            </form>
        </section>
        <?php endif; ?>

        <?php if (isset($rutinaEditar)): ?>
        <section class="form-card edit">
            <h2>Editar rutina</h2>
            <form method="POST">
                <input type="hidden" name="id" value="<?= $rutinaEditar['id'] ?>">
                <input type="text" name="nombre" value="<?= $rutinaEditar['nombre'] ?>" required>
                <textarea name="descripcion"><?= $rutinaEditar['descripcion'] ?></textarea>
                <input type="text" name="dia_semana" value="<?= $rutinaEditar['dia_semana'] ?>">
                <input type="number" name="duracion" value="<?= $rutinaEditar['duracion'] ?>">
                <textarea name="ejercicios"><?= $rutinaEditar['ejercicios'] ?></textarea>
                <button type="submit" name="actualizar_rutina">Actualizar</button>
            </form>
        </section>
        <?php endif; ?>

        <section class="tabla-card">
            <h2>Listado de rutinas</h2>
            <table>
                <tr>
                    <th>Nombre</th>
                    <th>Día</th>
                    <th>Duración</th>
                    <th>Acciones</th>
                </tr>

                <?php foreach ($rutinasLista as $r): ?>
                <tr>
                    <td><?= $r['nombre'] ?></td>
                    <td><?= $r['dia_semana'] ?></td>
                    <td><?= $r['duracion'] ?> min</td>
                    <td class="acciones">
                        <a href="rutinas.php?editar=<?= $r['id'] ?>">✏️ Editar</a>
                        <a href="rutinas.php?eliminar=<?= $r['id'] ?>" onclick="return confirm('¿Eliminar rutina?')">🗑️ Eliminar</a>
                    </td>

                </tr>
                <?php endforeach; ?>

            </table>
        </section>

    </main>

</div>

</body>
</html>
