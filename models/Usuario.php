<?php

class Usuario {
    
    // Crea un nuevo usuario
    public static function crear($nombre, $correo, $claveHash, $numeroTelefono = null) {
        global $conn;

        $stmt = $conn->prepare("INSERT INTO usuario (nombre, correo, clave, numeroTelefono) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $correo, $claveHash, $numeroTelefono);
        return $stmt->execute();
    }

    // Busca un usuario por correo electrónico
    public static function buscarPorCorreo($correo) {
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM usuario WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    // Opcional: Obtener usuario por ID
    public static function obtenerPorId($id) {
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM usuario WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
