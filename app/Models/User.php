<?php

namespace app\Models;

use Core\Database\Database;

class User
{
    protected Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public static function create(string $username, string $email, string $password): ?array
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $db = app(Database::class);

        $result = $db->query(
            "INSERT INTO users (username, email, password) VALUES (?, ?, ?)",
            [$username, $email, $hashedPassword]
        );

        if ($result === false) {
            return null;
        }

        return self::findByEmail($email);
    }

    public static function findByEmail(string $email)
    {
        $db = app(Database::class);
        return $db->fetch("SELECT * FROM users WHERE email = ?", [$email]);
    }

    public function verifyPassword(string $password, string $hashedPassword): bool
    {
        return password_verify($password, $hashedPassword);
    }
}