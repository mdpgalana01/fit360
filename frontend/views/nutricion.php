<?php
require_once __DIR__ . '/../../backend/controllers/nutricion-controller.php';
$nutricionLista = $nutricion->getAll($_SESSION['id_usuario']);

if (isset($_GET['editar'])) {
    $registroEditar = $nutricion->getById($_GET['editar']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nutrición - Fit360</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/nutricion.css">
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

            <a href="rutinas.php">
                <img src="../assets/img/dashboard/icon-routines.png">
                <span>Rutinas</span>
            </a>

            <a href="nutricion.php" class="active">
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

    <!-- Contenido principal -->
    <div class="nutricion-container">
            <h1 class="page-title">Mi Nutrición</h1>

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

        

        <!-- FORMULARIO CREAR -->
        <?php if (!isset($registroEditar)): ?>
        <section class="form-card">
            <h2>Añadir registro nutricional</h2>

            <form method="POST">
                <input type="hidden" name="crear_nutricion" value="1">

                <input type="date" name="fecha" required>

                <input type="number" name="calorias" placeholder="Calorías (kcal)" min="0">
                <input type="number" name="proteinas" placeholder="Proteínas (g)" min="0">
                <input type="number" name="carbohidratos" placeholder="Carbohidratos (g)" min="0">
                <input type="number" name="grasas" placeholder="Grasas (g)" min="0">

                <textarea name="notas" placeholder="Notas adicionales"></textarea>

                <button type="submit">Guardar</button>
            </form>
        </section>
        <?php endif; ?>

        <!-- FORMULARIO EDITAR -->
        <?php if (isset($registroEditar)): ?>
        <section class="form-card edit">
            <h2>Editar registro</h2>

            <form method="POST">
                <input type="hidden" name="actualizar_nutricion" value="1">
                <input type="hidden" name="id" value="<?= $registroEditar['id'] ?>">

                <input type="date" name="fecha" value="<?= $registroEditar['fecha'] ?>" required>

                <input type="number" name="calorias" value="<?= $registroEditar['calorias'] ?>" min="0">
                <input type="number" name="proteinas" value="<?= $registroEditar['proteinas'] ?>" min="0">
                <input type="number" name="carbohidratos" value="<?= $registroEditar['carbohidratos'] ?>" min="0">
                <input type="number" name="grasas" value="<?= $registroEditar['grasas'] ?>" min="0">

                <textarea name="notas"><?= $registroEditar['notas'] ?></textarea>

                <button type="submit">Actualizar</button>
            </form>
        </section>
        <?php endif; ?>

        <!-- TABLA -->
        <section class="tabla-card">
            <h2>Historial nutricional</h2>

            <table>
                <tr>
                    <th>Fecha</th>
                    <th>Calorías</th>
                    <th>Proteínas</th>
                    <th>Carbohidratos</th>
                    <th>Grasas</th>
                    <th>Notas</th>
                    <th>Acciones</th>
                </tr>

                <?php foreach ($nutricionLista as $n): ?>
                <tr>
                    <td><?= $n['fecha'] ?></td>
                    <td><?= $n['calorias'] ?></td>
                    <td><?= $n['proteinas'] ?></td>
                    <td><?= $n['carbohidratos'] ?></td>
                    <td><?= $n['grasas'] ?></td>
                    <td class="nota-corta" title="<?= htmlspecialchars($n['notas']) ?>">
                        <?= htmlspecialchars($n['notas']) ?>
                    </td>
                    <td class="acciones">

                        <a href="nutricion.php?editar=<?= $n['id'] ?>">✏️ Editar</a>
                        <a href="nutricion.php?eliminar=<?= $n['id'] ?>" onclick="return confirm('¿Eliminar registro?')">🗑️ Eliminar</a>
                    </td>


                </tr>
                <?php endforeach; ?>

            </table>
        </section>

    </main>

</div>

</body>
</html>
