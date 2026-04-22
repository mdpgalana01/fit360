<?php

require_once __DIR__ . '/../config/conexion.php';

class Nutricion {

    private $db;

    public function __construct() {
        // Usamos la conexión global creada en conexion.php
        global $conexion;
        $this->db = $conexion;
    }

    public function getAll($usuario_id) {
        $sql = "SELECT * FROM nutricion WHERE usuario_id = ? ORDER BY fecha DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM nutricion WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($data) {
        $sql = "INSERT INTO nutricion (usuario_id, fecha, calorias, proteinas, carbohidratos, grasas, notas)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(
            "isiiiis",
            $data["usuario_id"],
            $data["fecha"],
            $data["calorias"],
            $data["proteinas"],
            $data["carbohidratos"],
            $data["grasas"],
            $data["notas"]
        );

        return $stmt->execute();
    }

    public function update($id, $data) {
        $sql = "UPDATE nutricion SET fecha=?, calorias=?, proteinas=?, carbohidratos=?, grasas=?, notas=? WHERE id=?";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(
            "siiiisi",
            $data["fecha"],
            $data["calorias"],
            $data["proteinas"],
            $data["carbohidratos"],
            $data["grasas"],
            $data["notas"],
            $id
        );

        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM nutricion WHERE id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
