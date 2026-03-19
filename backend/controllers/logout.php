// Cerrar sesión
<?php
session_start();
session_unset();
session_destroy();

header("Location: ../../frontend/views/login.php");
exit();
?>
