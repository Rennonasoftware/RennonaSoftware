<?php

namespace App\Modelo;

use PDO;
use PDOException;
use Exception;

class ConectorPDO {
    private static string $host = 'localhost';
    private static string $dbName = 'nombre_bd';
    private static string $user = 'root';
    private static string $pass = '';
    private static string $charset = 'utf8mb4';

    private static ?PDO $conexion = null;

    private function __construct() {}

    public static function getConexion(): PDO {
        if (self::$conexion === null) {
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$dbName . ";charset=" . self::$charset;

            $opciones = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                self::$conexion = new PDO($dsn, self::$user, self::$pass, $opciones);
            } catch (PDOException $e) {
                throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
            }
        }

        return self::$conexion;
    }
}