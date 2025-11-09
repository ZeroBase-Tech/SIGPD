<?php

define('SERVERNAME', 'database'); // database es el nombre del servicio en docker-compose
define('USERNAME', 'root'); // Nombre de usuario definido en docker-compose
define('PASSWORD', 'Manzana@13'); // Contraseña definida en docker-compose
define('DBNAME', 'draftotux'); // Nombre de la base de datos definido en docker-compose

class Database
{
    private static ?Database $instancia = null; // Dónde se guarda la única instancia
    private PDO $conexion;

    private function __construct() {
        $host = SERVERNAME;
        $db = DBNAME;
        $user = USERNAME;
        $pass = PASSWORD;
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        try {
            $this->conexion = new PDO($dsn, $user, $pass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Conexión exitosa";
        } catch (PDOException $e) {
            echo "Error al conectar" . $e->getMessage() . "";
            exit;
        }
    }

    public static function getInstancia(): Database {
        if (self::$instancia === null) {
            self::$instancia = new Database();
        }
        return self::$instancia;
    }

    public function getConexion(): PDO{
        return $this->conexion;
    }
}