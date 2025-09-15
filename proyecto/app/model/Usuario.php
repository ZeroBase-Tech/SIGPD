<?php
require_once __DIR__ . '/Database.php';

class Usuario {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstancia()->getConexion();
    }

    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM usuario");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
