<?php
require_once '../app/model/Database.php';

class Usuario {
    private $pdo;

    public function create($usuario, $nombre, $password) {
        $this->pdo = Database::getInstancia()->getConexion();

        // Hashear la contraseña con SHA-256
        $hash = hash('sha256', $password);

        $sql = "INSERT INTO Jugador (usuario, nombre, password) VALUES (:usuario, :nombre, :password)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':password', $hash);

        return $stmt->execute();
    }

    public function getUserByUsername($usuario) {
        $this->pdo = Database::getInstancia()->getConexion();
        $sql = "SELECT * FROM Jugador WHERE usuario = :usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function verifyLogin($usuario, $password) {
        $user = $this->getUserByUsername($usuario);

        if ($user && hash('sha256', $password) === $user['password']) {
            return $user; // login exitoso
        }

        return false; // error
    }
}
