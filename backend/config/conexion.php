<?php
# 02/0372026
# Archivo de conexión a la base de datos:
# Si lo ejecutamos y todo está bien, no se verá nada (pantalla en blanco).
# Eso significa que la conexión funciona.

# Si hubiera un error, aparecerá un mensaje: Error de conexión...

$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "fit360";

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");

?>



