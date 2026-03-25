<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../models/progreso.php';
require_once __DIR__ . '/../config/session.php';

// Verificar que el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: /frontend/views/login.php");
    exit;
}

// Instancia del modelo (pasamos la conexión mysqli)
$progreso = new Progreso($conexion);

// Acción enviada desde la vista
$accion = $_POST['accion'] ?? null;

switch ($accion) {

    case 'crear':
        // Recoger datos del formulario
        $data = [
            'usuario_id'     => $_SESSION['id_usuario'],
            'peso'           => $_POST['peso'],
            'grasa'          => $_POST['grasa'] ?? null,
            'pecho'          => $_POST['pecho'] ?? null,
            'cintura'        => $_POST['cintura'] ?? null,
            'cadera'         => $_POST['cadera'] ?? null,
            'foto'           => null, // De momento no gestionamos fotos
            'fecha_registro' => date('Y-m-d')
        ];

        // VALIDACIONES BÁSICAS

        // 1. Peso vacío
        if (!isset($data['peso']) || $data['peso'] === '') {
            header("Location: ../../frontend/views/progreso.php?error=campos");
            exit;
        }

        // 2. Peso no numérico
        if (!is_numeric($data['peso'])) {
            header("Location: ../../frontend/views/progreso.php?error=numerico");
            exit;
        }

        // 3. Peso negativo
        if ($data['peso'] < 0) {
            header("Location: ../../frontend/views/progreso.php?error=negativo");
            exit;
        }

        // 4. Validar otros campos numéricos opcionales
        $camposOpcionales = ['grasa', 'pecho', 'cintura', 'cadera'];

        foreach ($camposOpcionales as $campo) {
            if ($data[$campo] !== '' && !is_numeric($data[$campo])) {
                header("Location: ../../frontend/views/progreso.php?error=numerico");
                exit;
            }
        }

        // Guardar en la base de datos
        $progreso->crear($data);

        // Volver a la vista
        header("Location: ../../frontend/views/progreso.php?ok=1");
        exit;

    default:
        // Obtener registros del usuario
        $registros = $progreso->obtenerPorUsuario($_SESSION['id_usuario']);
        break;
}
