<?php
/**
 * @class ConectorPDO
 * @brief Clase encargada de establecer la conexión segura con la base de datos MySQL usando variables de entorno.
 */
class ConectorPDO {
    private $host;
    private $db;
    private $user;
    private $pass;
    private $charset;

    /**
     * El constructor lee el archivo .env automáticamente cuando se instancia la clase.
     */
    public function __construct() {
        // Calculamos la ruta al archivo .env (2 niveles arriba: desde app/modelo/ hacia la raíz)
        $rutaEnv = __DIR__ . '/../../.env';

        $env = [];
        if (file_exists($rutaEnv)) {
            // parse_ini_file lee el .env y lo convierte en un arreglo asociativo
            $parsed = parse_ini_file($rutaEnv);
            if ($parsed !== false) {
                $env = $parsed;
            }
        }

        // Fallback a variables de entorno si faltan claves en .env
        $this->host    = isset($env['DB_HOST']) ? $env['DB_HOST'] : getenv('DB_HOST');
        $this->db      = isset($env['DB_NAME']) ? $env['DB_NAME'] : getenv('DB_NAME');
        $this->user    = isset($env['DB_USER']) ? $env['DB_USER'] : getenv('DB_USER');
        $this->pass    = isset($env['DB_PASS']) ? $env['DB_PASS'] : getenv('DB_PASS');
        $this->charset = isset($env['DB_CHARSET']) ? $env['DB_CHARSET'] : getenv('DB_CHARSET');

        // Validar elementos requeridos y lanzar excepción en lugar de terminar el proceso
        if (empty($this->host) || empty($this->db) || empty($this->user)) {
            throw new Exception("Configuración de BD incompleta. Comprueba .env o las variables de entorno (DB_HOST, DB_NAME, DB_USER). Ruta buscada: " . realpath(__DIR__ . '/../../'));
        }
    }

    /**
     * @brief Establece y retorna la instancia de la conexión a la base de datos.
     * @return PDO|null
     */
    public function conectar() {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        
        $opciones = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $conexion = new PDO($dsn, $this->user, $this->pass, $opciones);
            return $conexion;
        } catch (PDOException $e) {
            // Re-lanzar como excepción genérica para que el llamador la gestione
            throw new Exception("Error de PDO al conectar a la BD: " . $e->getMessage());
        }
    }
}
?>
