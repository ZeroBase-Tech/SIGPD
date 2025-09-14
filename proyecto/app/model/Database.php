<?php
class Database {
    private static $instancia = null;
    private $conexion;

    private function __construct() {
        $this->conexion = new PDO(
            "mysql:host=localhost;dbname=draftotux;charset=utf8",
            "root",
            ""
        );
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstancia() {
        if (!self::$instancia) {
            self::$instancia = new Database();
        }
        return self::$instancia;
    }

    public function getConexion() {
        return $this->conexion;
    }
}
