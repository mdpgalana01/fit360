<?php
require_once "../../../backend/middleware/admin.php";
require_once "../../../backend/config/conexion.php";

// Obtener/buscar usuarios
$busqueda = isset($_GET["busqueda"]) ? trim($_GET["busqueda"]) : "";

if ($busqueda !== "") {

    $texto = "%$busqueda%";

    $stmt = $conexion->prepare("
        SELECT id_usuario, nombre, apellidos, email, rol, fecha_registro, avatar
        FROM usuario
        WHERE nombre LIKE ?
           OR apellidos LIKE ?
           OR email LIKE ?
        ORDER BY fecha_registro DESC
    ");

    $stmt->bind_param("sss", $texto, $texto, $texto);
    $stmt->execute();
    $resultado = $stmt->get_result();

} else {

    $sql = "SELECT id_usuario, nombre, apellidos, email, rol, fecha_registro, avatar 
            FROM usuario
            ORDER BY fecha_registro DESC";

    $resultado = $conexion->query($sql);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de usuarios - Admin</title>
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


    <!-- CONTENIDO PRINCIPAL -->
    <main class="main-content">

        <header class="dashboard-header">
            <h1>Gestión de usuarios</h1>
        </header>

        <?php if (isset($_GET["msg"])): ?>
            <div class="alert 
                <?php 
                    if ($_GET["msg"] === "creado") echo 'alert-success';
                    if ($_GET["msg"] === "editado") echo 'alert-success';
                    if ($_GET["msg"] === "eliminado") echo 'alert-success';
                    if ($_GET["msg"] === "error") echo 'alert-error';
                    if ($_GET["msg"] === "no_encontrado") echo 'alert-error';
                ?>
            ">
                <?php
                    switch ($_GET["msg"]) {
                        case "creado":
                            echo "Usuario creado correctamente.";
                            break;
                        case "editado":
                            echo "Usuario actualizado correctamente.";
                            break;
                        case "eliminado":
                            echo "Usuario eliminado correctamente.";
                            break;
                        case "error":
                            echo "Ocurrió un error al procesar la acción.";
                            break;
                        case "no_encontrado":
                            echo "El usuario no existe o no se pudo cargar.";
                            break;
                    }
                ?>
            </div>
        <?php endif; ?>


        <section class="admin-section">

            <div class="admin-topbar">
                <form action="" method="GET" class="admin-search">
                    <input type="text" name="busqueda" placeholder="Buscar por nombre o email">
                    <button type="submit">Buscar</button>
                </form>

                <a href="usuario-crear.php" class="crear-usuario">+ Crear usuario</a>
            </div>



            <div class="table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Avatar</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Fecha registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($u = $resultado->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $u['id_usuario']; ?></td>

                                <td>
                                    <?php 
                                    $avatar = (!empty($u['avatar'])) 
                                        ? $u['avatar'] 
                                        : "default-avatar.png"; 
                                    ?>
                                    <img src="../../assets/img/users/<?php echo $avatar; ?>" class="table-avatar">

                                </td>

                                <td><?php echo $u['nombre'] . " " . $u['apellidos']; ?></td>

                                <td><?php echo $u['email']; ?></td>

                                <td>
                                    <span class="role-badge role-<?php echo $u['rol']; ?>">
                                        <?php echo ucfirst($u['rol']); ?>
                                    </span>
                                </td>

                                <td><?php echo $u['fecha_registro']; ?></td>

                                <td class="acciones">
                                    <a href="usuario-editar.php?id=<?= $u['id_usuario'] ?>">✏️ Editar</a>
                                    <a href="../../../backend/controllers/usuario-controller.php?eliminar=<?= $u['id_usuario'] ?>"
                                    onclick="return confirm('¿Eliminar usuario?')">🗑️ Eliminar</a>
                                </td>


                            </tr>
                        <?php endwhile; ?>

                        <?php if ($resultado->num_rows === 0): ?>
                            <tr>
                                <td colspan="7" style="text-align:center; padding: 15px; color:#666;">
                                    No se encontraron usuarios.
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>

                </table>
            </div>

        </section>

    </main>

</div>

</body>
</html>
