<?php

require_once __DIR__ . '/ConectorPDO.php';
require_once __DIR__ . '/usuario.php';

class AccesoDatosUsuario
{
    private PDO $conexion;

    public function __construct()
    {
        $conector = new ConectorPDO();
        $this->conexion = $conector->conectar();
    }

    public function obtenerTodosLosUsuarios()
    {
        // GROUP_CONCAT permite mostrar en una sola fila todos los roles de cada usuario.
        $sql = "
            SELECT
                u.cedula,
                GROUP_CONCAT(r.nombre_rol SEPARATOR ', ') AS roles
            FROM usuarios u
            LEFT JOIN usuario_rol ur
                ON u.cedula = ur.cedula
            LEFT JOIN roles r
                ON ur.id_rol = r.id_rol
            WHERE u.estado = 1
            GROUP BY u.cedula
            ORDER BY u.cedula
        ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearUsuario($cedula, $password, $rol)
    {
        try {
            // Usuario y rol se guardan juntos: si una operación falla, ninguna queda aplicada.
            $this->conexion->beginTransaction();

            $sqlUsuario = "
                INSERT INTO usuarios
                (cedula, password_hash, estado)
                VALUES
                (:cedula, :password, 1)
            ";

            $stmt = $this->conexion->prepare($sqlUsuario);

            $stmt->execute([
                ':cedula' => $cedula,
                ':password' => password_hash(
                    $password,
                    PASSWORD_DEFAULT
                )
            ]);

            $sqlRol = "
                SELECT id_rol
                FROM roles
                WHERE nombre_rol = :rol
                LIMIT 1
            ";

            $stmtRol = $this->conexion->prepare($sqlRol);

            $stmtRol->execute([
                ':rol' => $rol
            ]);

            $idRol = $stmtRol->fetchColumn();

            if (!$idRol) {
                throw new Exception("El rol seleccionado no existe.");
            }

            $sqlRelacion = "
                INSERT INTO usuario_rol
                (cedula, id_rol)
                VALUES
                (:cedula, :id_rol)
            ";

            $stmtRelacion = $this->conexion->prepare($sqlRelacion);

            $stmtRelacion->execute([
                ':cedula' => $cedula,
                ':id_rol' => $idRol
            ]);

            $this->conexion->commit();

            return true;

        } catch (Exception $e) {

            if ($this->conexion->inTransaction()) {
                $this->conexion->rollBack();
            }

            error_log(
                "Error al crear usuario: " . $e->getMessage()
            );

            return false;
        }
    }

    public function eliminarUsuario($cedula)
    {
        $sql = "
            UPDATE usuarios
            SET estado = 0
            WHERE cedula = :cedula
        ";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ':cedula' => $cedula
        ]);
    }

    public function modificarUsuario(
        $cedula,
        $password = '',
        $rol = ''
    ) {
        try {
            // La transacción mantiene sincronizados el cambio de contraseña y la relación de roles.
            $this->conexion->beginTransaction();

            if (!empty($password)) {

                $sql = "
                    UPDATE usuarios
                    SET password_hash = :password
                    WHERE cedula = :cedula
                ";

                $stmt = $this->conexion->prepare($sql);

                $stmt->execute([
                    ':password' => password_hash(
                        $password,
                        PASSWORD_DEFAULT
                    ),
                    ':cedula' => $cedula
                ]);
            }

            if (!empty($rol)) {

                $sqlRol = "
                    SELECT id_rol
                    FROM roles
                    WHERE nombre_rol = :rol
                    LIMIT 1
                ";

                $stmtRol = $this->conexion->prepare($sqlRol);

                $stmtRol->execute([
                    ':rol' => $rol
                ]);

                $idRol = $stmtRol->fetchColumn();

                if (!$idRol) {
                    throw new Exception(
                        "El rol seleccionado no existe."
                    );
                }

                $sqlEliminarRoles = "
                    DELETE FROM usuario_rol
                    WHERE cedula = :cedula
                ";

                $stmtEliminar = $this->conexion->prepare(
                    $sqlEliminarRoles
                );

                $stmtEliminar->execute([
                    ':cedula' => $cedula
                ]);

                $sqlNuevoRol = "
                    INSERT INTO usuario_rol
                    (cedula, id_rol)
                    VALUES
                    (:cedula, :id_rol)
                ";

                $stmtNuevoRol = $this->conexion->prepare(
                    $sqlNuevoRol
                );

                $stmtNuevoRol->execute([
                    ':cedula' => $cedula,
                    ':id_rol' => $idRol
                ]);
            }

            $this->conexion->commit();

            return true;

        } catch (Exception $e) {

            if ($this->conexion->inTransaction()) {
                $this->conexion->rollBack();
            }

            error_log(
                "Error al modificar usuario: " . $e->getMessage()
            );

            return false;
        }
    }

    public function obtenerPorCedula($cedula)
    {
        // El JOIN devuelve una fila por rol; luego se agrupan para construir el objeto Usuario.
        $sql = "
            SELECT
                u.cedula,
                u.password_hash,
                r.nombre_rol
            FROM usuarios u
            LEFT JOIN usuario_rol ur
                ON u.cedula = ur.cedula
            LEFT JOIN roles r
                ON ur.id_rol = r.id_rol
            WHERE
                u.cedula = :cedula
                AND u.estado = 1
        ";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':cedula' => $cedula
        ]);

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($resultados)) {
            return null;
        }

        $roles = [];

        foreach ($resultados as $fila) {

            if (!empty($fila['nombre_rol'])) {
                $roles[] = strtolower(
                    trim($fila['nombre_rol'])
                );
            }
        }

        return new Usuario(
            $resultados[0]['cedula'],
            null,
            null,
            $resultados[0]['password_hash'],
            array_unique($roles)
        );
    }
}