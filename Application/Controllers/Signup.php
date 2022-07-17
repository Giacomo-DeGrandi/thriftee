<?php

namespace Application\Controllers\Signup;

require_once('User.php');
require_once('Controller.php');

use Application\Controllers\Controller\Controller;
use Application\Controllers\User\User;

class Signup extends Controller{

    public function showSignup()
    {
        self::render('Signup');
    }

    public function emailTestReceiver($email): string
    {
        return (new User)->emailExists($email);
    }

    public function signUp( mixed $name, mixed $lastname, mixed $username, mixed $email, mixed $pw, int $rights )
    {
        (new User)->signUp( $name, $lastname, $username, $email, $pw, $rights );
    }

}

