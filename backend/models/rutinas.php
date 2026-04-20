<?php
require_once __DIR__ . '/../config/conexion.php';

class Rutinas {
    private $conn;

    public function __construct() {
        global $conexion; // usar la conexión mysqli existente
        $this->conn = $conexion;
    }

    public function obtenerPorUsuario($usuario_id) {
        $sql = "SELECT * FROM rutinas WHERE usuario_id = ? ORDER BY fecha_creacion DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM rutinas WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function crear($usuario_id, $nombre, $descripcion, $dia_semana, $duracion, $ejercicios) {
        $sql = "INSERT INTO rutinas (usuario_id, nombre, descripcion, dia_semana, duracion, ejercicios)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isssis", $usuario_id, $nombre, $descripcion, $dia_semana, $duracion, $ejercicios);
        return $stmt->execute();
    }

    public function actualizar($id, $nombre, $descripcion, $dia_semana, $duracion, $ejercicios) {
        $sql = "UPDATE rutinas SET nombre=?, descripcion=?, dia_semana=?, duracion=?, ejercicios=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssisi", $nombre, $descripcion, $dia_semana, $duracion, $ejercicios, $id);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $sql = "DELETE FROM rutinas WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
