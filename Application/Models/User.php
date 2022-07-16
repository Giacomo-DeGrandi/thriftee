<?php

namespace Application\Models\User;

require_once('Application/Models/Database.php');

use Application\Models\Database\Database;

Class User extends Database{

    public function checkExists($email): bool|array
    {
        $sql= 'SELECT * FROM users WHERE email = :email ; ' ;
        $params = [':email' => $email ];
        $check = $this->selectQuery($sql,$params);
        return $check->fetchAll();
    }

    public function signUp($name, $lastname, $username, $email, $password, $rights)
    {
        $sql = "INSERT INTO `users` ( `name`, `lastname`, `username`, `email`, `password`, `id_rights`) 
                VALUES ( :name, :lastname, :username, :email, :password, :rights)";

        $password = password_hash($password, PASSWORD_ARGON2ID);
        $params = ([':name' => $name,':lastname' => $lastname,':username' => $username, ':email' => $email,
            ':password' => $password, ':rights' => $rights]);
        $this->selectQuery($sql, $params);
    }

    public function getPw(string $email): bool|array
    {
        $sql = "SELECT password FROM users WHERE email = :email";
        $params = [':email' => $email ];
        $result = $this->selectQuery($sql,  $params);
        return $result->fetchAll();
    }

    public function getId(string $email): bool|array
    {
        $sql = "SELECT id FROM users WHERE email = :email";
        $params = [':email' => $email ];
        $result = $this->selectQuery($sql,  $params);
        return $result->fetchAll();
    }

    public function getRights(string $email): bool|array
    {
        $sql = "SELECT id_rights FROM users WHERE email = :email";
        $params = [':email' => $email ];
        $result = $this->selectQuery($sql,  $params);
        return $result->fetchAll();
    }


}