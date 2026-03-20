<?php
session_start();

// Cerrar sesión completamente
session_unset();
session_destroy();

header("Location: ../../frontend/views/login.php");
exit();
?>
