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

        // Verificamos si el archivo .env existe
        if (file_exists($rutaEnv)) {
            // parse_ini_file lee el .env y lo convierte en un arreglo asociativo
            $env = parse_ini_file($rutaEnv);
            
            $this->host    = $env['DB_HOST'];
            $this->db      = $env['DB_NAME'];
            $this->user    = $env['DB_USER'];
            $this->pass    = $env['DB_PASS'];
            $this->charset = $env['DB_CHARSET'];
            } else {
            // Esto te dirá exactamente dónde está buscando PHP el archivo
            die("Error crítico: No encuentro el archivo .env en esta ruta: " . realpath(__DIR__ . '/../../'));
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
            // ESTO ES MAGIA: Imprimirá en pantalla el motivo exacto del rechazo
            die("Error de PDO al conectar a la BD: " . $e->getMessage());
        }
    }
}
?>