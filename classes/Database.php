<?php

class Database{
    private PDO $pdo;

    function __construct(array $configs)
    {
        $user = $configs["user"];
        $db = $configs["db"];
        unset($configs['user']);
        unset($configs['db']);
        $dsn = self::dsnFromConfigs($configs, $db);
        $this->pdo = new PDO($dsn, $user, '', [
            PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC
        ]);
    }

    public static function dsnFromConfigs(array $configsArray, string $db):string
    {
        $dsnString =http_build_query($configsArray, '', ';');
        return $db . ":" . $dsnString;
    }

    public function query($query, $bindings)
    {
        $statement = $this->pdo->prepare($query);
        $statement->execute($bindings);

        return $statement;
    }
}
