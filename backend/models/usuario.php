<?php

class Usuario {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    /* ============================================================
       OBTENER TODOS LOS USUARIOS
       ============================================================ */
    public function getAll() {
        $sql = "SELECT * FROM usuario ORDER BY fecha_registro DESC";
        return $this->conexion->query($sql);
    }

    /* ============================================================
   BUSCAR USUARIOS POR NOMBRE O EMAIL
   ============================================================ */
public function buscar($texto) {

    $texto = "%$texto%";

    $sql = "SELECT * FROM usuario 
            WHERE nombre LIKE ? 
               OR apellidos LIKE ?
               OR email LIKE ?
            ORDER BY fecha_registro DESC";

    $stmt = $this->conexion->prepare($sql);
    $stmt->bind_param("sss", $texto, $texto, $texto);
    $stmt->execute();

    return $stmt->get_result();
}


    /* ============================================================
       OBTENER USUARIO POR ID
       ============================================================ */
    public function getById($id) {
        $sql = "SELECT * FROM usuario WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /* ============================================================
       CREAR USUARIO
       ============================================================ */
    public function create($nombre, $apellidos, $email, $contrasena, $rol) {

        $sql = "INSERT INTO usuario (nombre, apellidos, email, contrasena, rol, fecha_registro)
                VALUES (?, ?, ?, ?, ?, CURDATE())";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sssss", $nombre, $apellidos, $email, $contrasena, $rol);

        return $stmt->execute();
    }

    /* ============================================================
       ACTUALIZAR USUARIO
       ============================================================ */
    public function update($id, $nombre, $apellidos, $email, $rol) {

        $sql = "UPDATE usuario 
                SET nombre = ?, apellidos = ?, email = ?, rol = ?
                WHERE id_usuario = ?";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ssssi", $nombre, $apellidos, $email, $rol, $id);

        return $stmt->execute();
    }

    /* ============================================================
       CAMBIAR ROL
       ============================================================ */
    public function changeRole($id, $rol) {

        $sql = "UPDATE usuario SET rol = ? WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("si", $rol, $id);

        return $stmt->execute();
    }

    /* ============================================================
       ELIMINAR USUARIO
       ============================================================ */
    public function delete($id) {

        $sql = "DELETE FROM usuario WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}

?>
