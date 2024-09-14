<?php

namespace app\Actions;

use app\Models\User;

class LoginUser
{
    protected string $email;
    protected string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $this->validate();
        $user = User::findByEmail($this->email);

        if (!$user || !password_verify($this->password, $user['password'])) {
            throw new \Exception("Invalid credentials");
        }
        $_SESSION['user_id'] = $user["id"];

        return $user;
    }

    protected function validate()
    {
        if (empty($this->email) || empty($this->password)) {
            throw new \Exception("Email and password are required");
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Invalid email format");
        }
    }
}