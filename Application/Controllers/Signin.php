<?php

namespace Application\Controllers\Signin;

require_once('Header.php');
require_once('Controller.php');

use Application\Controllers\Controller\Controller;
use Application\Controllers\Header\Header;
use Application\Controllers\User\User;

class Signin extends Controller{

    public function showSignin()
    {
        self::render('Signin');
    }

    public function emailTestReceiver($email): string
    {
        return (new User)->emailExists($email);
    }


}