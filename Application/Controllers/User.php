<?php

namespace Application\Controllers\User;

require_once ('Application/Models/User.php');

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

}