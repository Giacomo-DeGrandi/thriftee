<?php

namespace Application\Controllers\Signin;

require_once('Header.php');

use Application\Controllers\Header\Header;
use Application\Controllers\User\User;

class Signin{

    public function showSignin()
    {
        require_once('Templates/Signin.php');
        $header = Header::execute();
        require_once ($header);
        require_once('Templates/Footer.php');
        require_once('Templates/Layout.php');
    }

    public function emailTestReceiver($email): string
    {
        return (new User)->emailExists($email);
    }


}