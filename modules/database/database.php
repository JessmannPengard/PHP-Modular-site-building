<!-- Database module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<?php
// Database connection data
require("database.config.php");

// Database class
class Database
{
    private $connection;

    public function __construct()
    {
        // Connect to database
        try {
            $this->connection = new PDO("mysql:host=" . HOST_NAME . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        } catch (PDOException $pe) {
            // Connection error
            $this->connection = null;
        }
    }

    // Get database connection
    public function getConnection()
    {
        return $this->connection;
    }

    // Close database connection
    public function closeConnection()
    {
        $this->connection = null;
    }
}