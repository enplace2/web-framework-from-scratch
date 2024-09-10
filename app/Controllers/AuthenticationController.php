<?php

namespace app\Controllers;


use app\Actions\LoginUser;
use app\Actions\RegisterUser;
use Core\Response\Response;
use Exception;

class AuthenticationController
{

    /**
     * @return Response
     * @throws Exception
     */
    public function register(): Response
    {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = (new RegisterUser($username, $email, $password))->execute();
        return new Response([
            'message'   => "Registration successful!",
            'user'      => $user,
        ]);
    }


    /**
     * @return Response
     * @throws Exception
     */
    public function login(): Response
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = (new LoginUser($email, $password))->execute();
        return new Response([
            'message'   => "Login successful!",
            'user'      => $user,
        ]);
    }
}