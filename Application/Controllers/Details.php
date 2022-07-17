<?php

namespace Application\Controllers\Profile;

require_once('Controller.php');

use Application\Controllers\Controller\Controller;
use Application\Controllers\User\User;

class Details extends Controller{

    public function showDetails()
    {
        if(isset($_COOKIE['id']) && isset($_COOKIE['connected'])){

            self::render('Details');

        } else {

            session_destroy();
            setcookie('connected', 0, time() - 3600000 * 240);
            setcookie("id", 0, time() - 3600000 * 240);
            header('Location: index');
        }
    }


}