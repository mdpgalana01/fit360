<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../../frontend/views/login.php");
    exit();
}

if ($_SESSION["rol"] !== "dietista") {
    header("Location: ../../frontend/views/no-autorizado.php");
    exit();
}
