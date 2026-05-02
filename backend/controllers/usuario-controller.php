<?php
require_once "../config/conexion.php";
require_once "../models/usuario.php";
session_start();

// Solo admin puede usar este controlador
if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== "admin") {
    header("Location: ../../frontend/views/no-autorizado.php");
    exit();
}

$usuarioModel = new Usuario($conexion);

/* ============================================================
   ELIMINAR USUARIO
   ============================================================ */
if (isset($_GET["eliminar"])) {
    $id = intval($_GET["eliminar"]);

    if ($usuarioModel->delete($id)) {
        header("Location: ../../frontend/views/admin/usuarios.php?msg=eliminado");
    } else {
        header("Location: ../../frontend/views/admin/usuarios.php?msg=error");
    }
    exit();
}

/* ============================================================
   CREAR USUARIO
   ============================================================ */
if (isset($_POST["accion"]) && $_POST["accion"] === "crear") {

    $nombre = trim($_POST["nombre"]);
    $apellidos = trim($_POST["apellidos"]);
    $email = trim($_POST["email"]);
    $rol = trim($_POST["rol"]);
    $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);

    $usuarioModel->create($nombre, $apellidos, $email, $contrasena, $rol);

    header("Location: ../../frontend/views/admin/usuarios.php?msg=creado");
    exit();
}

/* ============================================================
   EDITAR USUARIO
   ============================================================ */
if (isset($_POST["accion"]) && $_POST["accion"] === "editar") {

    $id = intval($_POST["id_usuario"]);
    $nombre = trim($_POST["nombre"]);
    $apellidos = trim($_POST["apellidos"]);
    $email = trim($_POST["email"]);
    $rol = trim($_POST["rol"]);

    $usuarioModel->update($id, $nombre, $apellidos, $email, $rol);

    header("Location: ../../frontend/views/admin/usuarios.php?msg=editado");
    exit();
}

/* ============================================================
   CAMBIAR ROL
   ============================================================ */
if (isset($_POST["accion"]) && $_POST["accion"] === "cambiar_rol") {

    $id = intval($_POST["id_usuario"]);
    $rol = trim($_POST["rol"]);

    $usuarioModel->changeRole($id, $rol);

    header("Location: ../../frontend/views/admin/usuarios.php?msg=rol_actualizado");
    exit();
}

?>
