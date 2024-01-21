<?php

namespace Alura\Leilao\Infra;

class ConnectionCreator
{
    private static $pdo = null;

    public static function getConnectionFile(): \PDO
    {
        if (is_null(self::$pdo)) {
            $caminhoBanco = __DIR__ . '/../../banco.sqlite';
            self::$pdo = new \PDO('sqlite:' . $caminhoBanco);
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }

    public static function getConnectionMemory(): \PDO
    {
        if (is_null(self::$pdo)) {
            self::$pdo = new \PDO('sqlite::memory:');
            self::$pdo->exec('create table leiloes (
            id INTEGER primary key,
            descricao TEXT,
            finalizado BOOL,
            dataInicio TEXT
                     );');
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
}
