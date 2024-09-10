<?php
namespace app\Actions;
use app\Models\User;

class RegisterUser
{
    protected string $username;
    protected string $email;
    protected string $password;
    public function __construct(string $username, string $email, string $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $this->validate();
        $user =  User::create($this->username, $this->email, $this->password);

        if($user){
            $_SESSION['user_id'] = $user["id"];
        }
        if(!$user){
            throw new \Exception("Registration Failed");
        }
        return $user;
    }
    protected function validate(){

        if (empty($this->username) || empty($this->email) || empty($this->password)) {
            throw new \Exception("Username, email and password required", 404);
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Invalid email format", 404);
        }

        // Check if email already exists (you'll need to implement this function)
        $existingUser = User::findByEmail($this->email);
        if ($existingUser) {
            throw new \Exception("Email already in use ", 404);
        }

    }
}