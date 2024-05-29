<?php
if (session_status() == PHP_SESSION_NONE) session_start();

abstract class DBconection
{
    private static $server = 'localhost';
    private static $db = 'cex';
    private static $user = 'root';
    private static $password = '';

    public static function connectDB()
    {
        try {
            // Use utf8mb4 charset for full Unicode support, including emojis
            $connection = new PDO("mysql:host=" . self::$server . ";dbname=" . self::$db . ";charset=utf8mb4", self::$user, self::$password);
            // Set the PDO attribute to handle errors properly
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Ensure that the connection uses utf8mb4
            $connection->exec("SET NAMES 'utf8mb4'");
        } catch (PDOException $e) {
            echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
            die("Error: " . $e->getMessage());
        }
        return $connection;
    }
}
