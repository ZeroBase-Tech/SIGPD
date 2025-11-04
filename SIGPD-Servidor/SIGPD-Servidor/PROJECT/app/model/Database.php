<?php

//define('SERVERNAME', 'database'); // database es el nombre del servicio en docker-compose
//define('USERNAME', 'root'); // Nombre de usuario definido en docker-compose
//define('PASSWORD', 'Manzana@13'); // Contraseña definida en docker-compose
//define('DBNAME', 'draftotux'); // Nombre de la base de datos definido en docker-compose

define('SERVERNAME', '127.0.0.1'); // Host de MySQL en XAMPP
define('USERNAME', 'root');         // Usuario de MySQL en XAMPP (por defecto 'root')
define('PASSWORD', '');             // Contraseña de MySQL en XAMPP (por defecto vacía)
define('DBNAME', 'draftotux');      // Nombre de tu base de datos

class Database
{
    private static ?Database $instancia = null; // Dónde se guarda la única instancia
    private PDO $conexion; // Objeto de conexión con la BD

    // Constructor privado para evitar que se creen múltiples instancias de la clase
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
            self::$instancia = new Database(); // $this->instancia = new Database(); error
        }
        return self::$instancia;
    }

    public function getConexion(): PDO{
        return $this->conexion;
    }
}