<?php
session_start();

//var_dump($_SESSION["rol"]);
//exit;

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../../frontend/views/login.php");
    exit();
}

if ($_SESSION["rol"] !== "entrenador") {
    header("Location: ../../frontend/views/no-autorizado.php");
    exit();
}
