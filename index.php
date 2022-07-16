<?php

session_start();

require_once('Application/Lib/Token.php');

use Application\Controllers\Homepage\Homepage;
use Application\Controllers\Header\Header;
use Application\Controllers\Profile\Details;
use Application\Controllers\Signin\Signin;
use Application\Controllers\Signup\Signup;
use Application\Lib\Token\Token;


if(isset($_GET)){

    // $_GET switch

    switch($_GET):

        case isset($_GET['signup']):
            require_once('Application/Controllers/Signup.php');
            $signup = new Signup;
            $signup->showSignup();
        break;

        case isset($_GET['signin']):
            require_once('Application/Controllers/Signin.php');
            $signin = new Signin;
            $_SESSION['token']= (new Token)->generateToken();
            $_SESSION['token-expire']= (new Token)->generateExpiration();
            $signin->showSignin();
        break;

        case isset($_GET['details']):
            require_once('Application/Controllers/Details.php');
            $details = new Details;
            $_SESSION['token']= (new Token)->generateToken();
            $_SESSION['token-expire']= (new Token)->generateExpiration();
            $details->showDetails();
         break;

    endswitch;


} else {

    // Default Homepage
    require_once('Application/Controllers/Homepage.php');
    require_once('Application/Controllers/Header.php');

    $homepage = new Homepage;
    $homepage->execute();

    $header = new Header;
    $header->execute();

}


