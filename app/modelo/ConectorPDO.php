<?php

class ConectorPDO
{
    private string $host;
    private string $db;
    private string $user;
    private string $pass;
    private string $charset;

    public function __construct()
    {
        $rutaEnv = __DIR__ . '/../../.env';

        $env = [];

        if (file_exists($rutaEnv)) {
            $parsed = parse_ini_file($rutaEnv);

            if ($parsed !== false) {
                $env = $parsed;
            }
        }

        $this->host = $env['DB_HOST'] ?? getenv('DB_HOST') ?: 'localhost';
        $this->db = $env['DB_NAME'] ?? getenv('DB_NAME') ?: 'sgrsi_db';
        $this->user = $env['DB_USER'] ?? getenv('DB_USER') ?: 'root';
        $this->pass = $env['DB_PASS'] ?? getenv('DB_PASS') ?: '';
        $this->charset = $env['DB_CHARSET'] ?? getenv('DB_CHARSET') ?: 'utf8mb4';
    }

    public function conectar(): PDO
    {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";

        $opciones = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        try {
            return new PDO(
                $dsn,
                $this->user,
                $this->pass,
                $opciones
            );
        } catch (PDOException $e) {
            throw new Exception(
                "No se pudo conectar a la base de datos: " . $e->getMessage()
            );
        }
    }
}