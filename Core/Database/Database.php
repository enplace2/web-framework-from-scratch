<?php

namespace Core\Database;

use PDO;

class Database
{
    protected array $configs;
    protected PDO $pdo;

    protected array  $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //PDO will throw exceptions when errors occur.
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Query results will be returned as associative arrays by default.
        PDO::ATTR_EMULATE_PREPARES   => false, //Disables emulated prepared statements and forces PDO to use real prepared statements.
    ];

    public function __construct(array $configs, ?array $options = null)
    {
        if ($options) $this->options = $options;
        $this->configs = $configs;

        $dsn = $this->buildDsn($configs);
        $user = $configs['username'] ?? '';
        $password = $configs['password'] ?? '';

        $this->pdo = new PDO($dsn, $user, $password, $this->options);
    }

    protected function buildDsn(array $configs): string
    {
        $dsnArgs = [
            'host'    => $configs['host'] ?? '127.0.0.1',
            'port'    => $configs['port'] ?? '3306',
            'dbname'  => $configs['dbname'] ?? '',
            'charset' => $configs['charset'] ?? 'utf8mb4'
        ];

        $dsnString = http_build_query($dsnArgs, '', ';');
        return "{$configs['driver']}:$dsnString";
    }

    public function query($query, ?array $bindings = []): bool|\PDOStatement
    {
        $statement = $this->pdo->prepare($query);
        $statement->execute($bindings);
        return $statement;
    }

    public function get($query, ?array $bindings =[]): bool|array
    {
        return $this->query($query, $bindings)->fetchAll();
    }

    public function fetch($query, ?array $bindings = [])
    {
        return $this->query($query, $bindings)->fetch();
    }

    public function pdo()
    {
        return $this->pdo;
    }
}