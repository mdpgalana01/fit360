<?php
//session_start();
//var_dump($_SESSION);
//exit;
require_once __DIR__ . '/../../backend/controllers/progreso-controller.php';


if (isset($_GET['editar'])) {
    $registro = $progreso->obtenerPorId($_GET['editar']);
}


// Crear arrays para el gráfico
$fechas = [];
$pesos  = [];
$grasas = [];

if (!empty($registros)) {
    foreach ($registros as $r) {
        $fechas[] = $r['fecha_registro'];
        $pesos[]  = (float)$r['peso'];
        $grasas[] = $r['grasa'] !== null ? (float)$r['grasa'] : null;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Progreso</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/progreso.css"> <!-- si tienes un CSS -->
</head>

<!-- Para que los mensajes desaparezcan solos a los 3 segundos -->
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

    <!-- SIDEBAR -->
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

            <a href="#">
            <img src="../assets/img/dashboard/icon-routines.png">
            <span>Rutinas</span>
            </a>

            <a href="#">
            <img src="../assets/img/dashboard/icon-nutrition.png">
            <span>Nutrición</span>
            </a>

            <a href="progreso.php" class="active">
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

        <div class="progreso-container">
            <h1>Mi Progreso</h1>

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




            <!-- FORMULARIO -->
             <?php if (!isset($registro)): ?>
            <section>
                <div class="progreso-card">
                    <h2>Añadir registro</h2>

                    <form class="progreso-form" action="../../backend/controllers/progreso-controller.php" method="POST">
                        <input type="hidden" name="accion" value="crear">

                        <label>Peso (kg):</label>
                        <input type="number" step="0.01" name="peso" required>

                        <label>Grasa corporal (%):</label>
                        <input type="number" step="0.01" name="grasa">

                        <label>Pecho (cm):</label>
                        <input type="number" step="0.01" name="pecho">

                        <label>Cintura (cm):</label>
                        <input type="number" step="0.01" name="cintura">

                        <label>Cadera (cm):</label>
                        <input type="number" step="0.01" name="cadera">

                        <button class="btn-progreso" type="submit">Guardar</button>
                    </form>
                </div>
            </section>
            <?php endif; ?>

            <?php if (isset($registro)): ?>
            <section>
                <div class="progreso-card">
                    <h2>Editar registro</h2>

                    <form class="progreso-form" action="../../backend/controllers/progreso-controller.php" method="POST">
                        <input type="hidden" name="accion" value="actualizar">
                        <input type="hidden" name="id" value="<?= $registro['id'] ?>">

                        <label>Peso (kg):</label>
                        <input type="number" step="0.01" name="peso" value="<?= $registro['peso'] ?>" required>

                        <label>Grasa corporal (%):</label>
                        <input type="number" step="0.01" name="grasa" value="<?= $registro['grasa'] ?>">

                        <label>Pecho (cm):</label>
                        <input type="number" step="0.01" name="pecho" value="<?= $registro['pecho'] ?>">

                        <label>Cintura (cm):</label>
                        <input type="number" step="0.01" name="cintura" value="<?= $registro['cintura'] ?>">

                        <label>Cadera (cm):</label>
                        <input type="number" step="0.01" name="cadera" value="<?= $registro['cadera'] ?>">

                        <button class="btn-progreso" type="submit">Actualizar</button>
                    </form>
                </div>
            </section>
            <?php endif; ?>


            <!-- TABLA -->
            <section>
                <h2>Historial de progreso</h2>

                <?php if (!empty($registros)): ?>
                    <table class="progreso-table">
                        <tr>
                            <th>Fecha</th>
                            <th>Peso</th>
                            <th>Grasa</th>
                            <th>Pecho</th>
                            <th>Cintura</th>
                            <th>Cadera</th>
                            <th>Acciones</th>
                        </tr>

                        <?php foreach ($registros as $r): ?>
                            <tr>
                                <td><?= htmlspecialchars($r['fecha_registro']) ?></td>
                                <td><?= htmlspecialchars($r['peso']) ?> kg</td>
                                <td><?= $r['grasa'] !== null ? htmlspecialchars($r['grasa']) . '%' : '-' ?></td>
                                <td><?= $r['pecho'] !== null ? htmlspecialchars($r['pecho']) . ' cm' : '-' ?></td>
                                <td><?= $r['cintura'] !== null ? htmlspecialchars($r['cintura']) . ' cm' : '-' ?></td>
                                <td><?= $r['cadera'] !== null ? htmlspecialchars($r['cadera']) . ' cm' : '-' ?></td>
                                <td>
                                    <form action="../../backend/controllers/progreso-controller.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="accion" value="editar">
                                        <input type="hidden" name="id" value="<?= $r['id'] ?>">
                                        <button type="submit" class="btn-editar">Editar</button>
                                    </form>

                                    <form action="../../backend/controllers/progreso-controller.php" method="POST" style="display:inline;" 
                                        onsubmit="return confirm('¿Seguro que deseas eliminar este registro?');">
                                        <input type="hidden" name="accion" value="eliminar">
                                        <input type="hidden" name="id" value="<?= $r['id'] ?>">
                                        <button type="submit" class="btn-eliminar">Eliminar</button>
                                    </form>
                                </td>

                            </tr>
                        <?php endforeach; ?>

                    </table>

                    <h2>Evolución del peso</h2>
                    <canvas id="graficoPeso" height="100"></canvas>

                <?php else: ?>
                    <p>No hay registros todavía.</p>
                <?php endif; ?>
            </section>

        </div>

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const fechas = <?php echo json_encode($fechas); ?>;
    const pesos  = <?php echo json_encode($pesos); ?>;
    const grasas = <?php echo json_encode($grasas); ?>;
</script>

<script>
    if (fechas.length > 0) {
        const ctx = document.getElementById('graficoPeso').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: fechas,
                datasets: [
                    {
                        label: 'Peso (kg)',
                        data: pesos,
                        borderColor: '#E53935',
                        backgroundColor: 'rgba(229, 57, 53, 0.2)',
                        borderWidth: 2,
                        tension: 0.3,
                        pointRadius: 4,
                        pointBackgroundColor: '#E53935'
                    },
                    {
                        label: 'Grasa corporal (%)',
                        data: grasas,
                        borderColor: '#1E88E5',
                        backgroundColor: 'rgba(30, 136, 229, 0.2)',
                        borderWidth: 2,
                        tension: 0.3,
                        pointRadius: 4,
                        pointBackgroundColor: '#1E88E5'
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });
    }
</script>


</body>
</html>

