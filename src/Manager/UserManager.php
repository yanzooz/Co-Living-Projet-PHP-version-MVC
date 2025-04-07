<?php

namespace App\Manager;

use App\Model\User;

class UserManager extends DatabaseManager
{

    public function selectByUsername(string $username): User |false
    {
        $request = self::getConnexion()->prepare("SELECT * FROM users WHERE username = :username;");
        $request->execute([
            ":username" => $username
        ]);
        $arrayUser = $request->fetch();
        if (!$arrayUser) {
            return false;
        }
        return new User($arrayUser["id"], $arrayUser["username"], $arrayUser["email"], $arrayUser["password"], $arrayUser["role"]);
    }

    public function selectByEmail(string $email): bool
    {
        $request = self::getConnexion()->prepare("SELECT * FROM users WHERE email = :email;");
        $request->execute([
            ":email" => $email
        ]);
        $arrayUser = $request->fetch();
        if (!$arrayUser) {
            return false;
        }
        return true;
    }

    public function insert(User $user): bool {
        $request = self::getConnexion()->prepare("INSERT INTO users(username,email,password,role) VALUES(:username,:email,:password,:role)");
        $request->execute([
            "username"=> $user->getUsername(),
            "email"=> $user->getEmail(),
            "password"=>$user->getPassword(),
            "role"=>$user->getRole()
        ]);
        return $request->rowCount() > 0;
    }
    
}
