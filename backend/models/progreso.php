<?php

class Progreso
{
    private $conn;
    private $table = "progreso";

    public function __construct($conexion)
    {
        $this->conn = $conexion;
    }

    public function crear($data)
    {
        $sql = "INSERT INTO $this->table 
                (usuario_id, peso, grasa, pecho, cintura, cadera, foto, fecha_registro)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "idddddss",
            $data['usuario_id'],
            $data['peso'],
            $data['grasa'],
            $data['pecho'],
            $data['cintura'],
            $data['cadera'],
            $data['foto'],
            $data['fecha_registro']
        );

        return $stmt->execute();
    }

    public function obtenerPorUsuario($usuario_id)
    {
        $sql = "SELECT * FROM $this->table 
                WHERE usuario_id = ?
                ORDER BY fecha_registro DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();

        $resultado = $stmt->get_result();
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM progreso WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }


    public function actualizar($data) {
        $stmt = $this->conn->prepare("
            UPDATE progreso 
            SET peso = ?, grasa = ?, pecho = ?, cintura = ?, cadera = ?
            WHERE id = ?
        ");

        $stmt->bind_param(
            "dddddi",
            $data['peso'],
            $data['grasa'],
            $data['pecho'],
            $data['cintura'],
            $data['cadera'],
            $data['id']
        );

        return $stmt->execute();
    }


    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM progreso WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

}
