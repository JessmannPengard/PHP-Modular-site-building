<?php
// Datos de conexión a la base de datos
require("database.config.php");

// Clase de la base de datos, con esto nos conectamos a la base de datos
class Database
{
    private $connection;

    public function __construct()
    {
        // Conectarse a la base de datos
        try {
            $this->connection = new PDO("mysql:host=" . HOST_NAME . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        } catch (PDOException $pe) {
            // Error de conexión
            $this->connection = null;
        }
    }

    // Método que devuelve la conexión a la base de datos
    public function getConnection()
    {
        return $this->connection;
    }

    // Cerrar la conexión
    public function closeConnection()
    {
        $this->connection = null;
    }
}