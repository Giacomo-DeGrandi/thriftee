<?php

namespace Application\Models\User;

require_once('Database.php');

use Application\Models\Database\Database;
use Application\Models\User\User as Usermodel;

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
        $sql = "INSERT INTO `users` ( `name`, `lastname`, `username`, `email`, `password`, `id_rights`) VALUES ( :name, :lastname, :username, :email, :password, :rights)";
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

    public function getRightsById(int $id): bool|array
    {
        $sql = "SELECT id_rights FROM users WHERE id = :id";
        $params = [':id' => $id ];
        $result = $this->selectQuery($sql,  $params);
        return $result->fetchAll();
    }

    public function registerDetails(mixed $address, mixed $city, mixed $zipCode, mixed $bios, string $newFilepath, int $id, int $rights)
    {
        $sql = 'UPDATE `users` SET `address`=:address,`zip_code`=:zip_code, `city`= :city, `bios`= :bios, `img_profile`= :img_profile, `id_rights`= :id_rights WHERE id = :id';
        $params = ([':address' => $address,':zip_code' => $zipCode,':city' => $city, ':bios' => $bios, ':img_profile' => $newFilepath, ':id_rights' => $rights, ':id' => $id]);
        $this->selectQuery($sql, $params);
    }

    public function getAddress(mixed $id): bool|array
    {
        $sql = "SELECT address FROM users WHERE id = :id";
        $params = [':id' => $id ];
        $result = $this->selectQuery($sql,  $params);
        return $result->fetchAll();
    }

    public function getAllInfosByid(mixed $id): bool|array
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $params = [':id' => $id ];
        $result = $this->selectQuery($sql,  $params);
        return $result->fetchAll();
    }

    public function getAllUsers(): bool|array
    {
        $sql = "SELECT * FROM users ";
        $result = $this->selectQuery($sql);
        return $result->fetchAll();
    }

    public function getUserMailById(mixed $idOwner)
    {
        $sql = "SELECT email FROM users WHERE id = :id";
        $params = [':id' => $idOwner ];
        $result = $this->selectQuery($sql,  $params);
        return $result->fetchAll();
    }

    public function registerNewImage(mixed $filePaths, mixed $id): bool|array
    {
        $sql = "UPDATE users SET img_profile = :img_profile WHERE id = :id;";
        $params = [':img_profile' => $filePaths, ':id' => $id];
        $result = $this->selectQuery($sql, $params);
        return $result->fetchAll();
    }

    public function updatePersonalInfo(mixed $id, mixed $name, mixed $lastname, mixed $filePath, mixed $bios, mixed $email): bool|array
    {
        $sql = "UPDATE users SET name = :name, email = :email, lastname = :lastname, img_profile = :img_profile, bios = :bios  WHERE id = :id;";
        $params = [':name' => $name, ':email' => $email, ':lastname' => $lastname ,':img_profile' => $filePath, ':bios' => $bios, ':id' => $id];
        $result = $this->selectQuery($sql, $params);
        return $result->fetchAll();
    }

    public function getProPicPath(mixed $id): bool|array
    {
        $sql = "SELECT `img_profile` FROM `users` WHERE id = :id";
        $params = [':id' => intval($id) ];
        $result = $this->selectQuery($sql,  $params);
        return $result->fetchAll();
    }

    public function emailExistsUpdate($email, $id): bool|array
    {
        $sql= 'SELECT * FROM users WHERE email = :email AND id != :id ' ;
        $params = [':email' => $email, ':id' => intval($id) ];
        $check = $this->selectQuery($sql,$params);
        return $check->fetchAll();
    }

    public function updatePassword(mixed $password, mixed $id): bool|array
    {
        $password = password_hash($password,PASSWORD_ARGON2ID);
        $sql = "UPDATE users SET password = :password WHERE id = :id;";
        $params = [':password' => $password, ':id' => $id];
        $result = $this->selectQuery($sql, $params);
        return $result->fetchAll();
    }

    public function updateAddress(mixed $address, mixed $zipCode, mixed $city, mixed $id): bool|array
    {
        $sql = "UPDATE users SET address = :address, zip_code = :zipCode, city = :city WHERE id = :id;";
        $params = [':address' => $address, ':zipCode' => $zipCode, ':city' => $city , ':id' => $id];
        $result = $this->selectQuery($sql, $params);
        return $result->fetchAll();
    }

}










