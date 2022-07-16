<?php

namespace Application\Controllers\Signup;

require_once('Header.php');
require_once('User.php');

use Application\Controllers\Header\Header;
use Application\Controllers\User\User;

class Signup{

    public function showSignup()
    {
        require_once('Templates/Signup.php');
        $header = Header::execute();
        require_once($header);
        require_once('Templates/Footer.php');
        require_once('Templates/Layout.php');
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

