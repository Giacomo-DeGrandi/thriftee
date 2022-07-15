<?php

use Application\Controllers\Homepage\Homepage;
use Application\Controllers\Header\Header;
use Application\Controllers\Signin\Signin;
use Application\Controllers\Signup\Signup;


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
            $signin->showSignin();
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


