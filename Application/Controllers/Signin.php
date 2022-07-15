<?php

namespace Application\Controllers\Signin;

require_once('Header.php');

use Application\Controllers\Header\Header;

class Signin{

    public function showSignin(){

        require_once('Templates/Signin.php');
        $header = Header::execute();
        require_once ($header);
        require_once('Templates/Footer.php');
        require_once('Templates/Layout.php');
    }



}