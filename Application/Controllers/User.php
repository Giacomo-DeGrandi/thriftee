<?php

namespace Application\Controllers\User;

require_once ('Application/Models/User.php');
require_once ('Application/Lib/Token.php');

use Application\Lib\Token\Token;
use Application\Models\User\User as Usermodel;

class User
{
    public function emailExists($email): string
    {
        $exist = (new Usermodel)->checkExists($email);
        if(!empty($exist)){
            return 'exists';
        } else {
            return '';
        }
    }

    public function signUp(mixed $name, mixed $lastname, mixed $username, mixed $email, mixed $pw, int $rights)
    {
        (new Usermodel)->signUp( $name, $lastname, $username, $email, $pw, $rights );
    }

    public function getPw(string $email): bool|array
    {
        return (new Usermodel)->getPw( $email);
    }

    public function getId(string $email): bool|array
    {
        return (new Usermodel)->getId( $email);
    }

    public function getRights(string $email): bool|array
    {
        return (new Usermodel)->getRights($email);
    }

}