<?php
class UsuarioModel {
    private static $usuariosDB = [
        [
            'id' => 1,
            'username' => 'admin',
            'password' => 'admin123',
            'rol' => 'admin'
        ],
        [
            'id' => 2,
            'username' => 'logistica',
            'password' => 'rivera2026',
            'rol' => 'operador'
        ]
    ];

    public static function verificarCredenciales($username, $password) {
        foreach (self::$usuariosDB as $user) {
            if ($user['username'] === $username && $user['password'] === $password) {
                return $user;
            }
        }
        return null;
    }
}