<?php

namespace app\Controllers;


use app\Actions\RegisterUser;

class AuthenticationController
{
    /**
     * @throws \Exception
     */
    public function register()
    {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = (new RegisterUser($username, $email, $password))->execute();

        if ($user) {
            $_SESSION['user_id'] = $user["id"];
            return $user;

        } else {
            throw new \Exception("Registration failed", 404);
        }
    }

    /**
     * @throws \Exception
     */
    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        try {
            $user = (new LoginUser($email, $password))->execute();

            if ($user) {
                $_SESSION['user_id'] = $user["id"];
                return new Response(['message' => 'Login successful', 'user' => $user], 200);
            } else {
                return new Response(['error' => 'Invalid credentials'], 401);
            }
        } catch (\Exception $e) {
            return new Response(['error' => $e->getMessage()], 400);
        }
    }
}