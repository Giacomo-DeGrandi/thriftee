<?php

namespace Application\Controllers\Profile;

require_once('Header.php');
require_once('User.php');

use Application\Controllers\Header\Header;
use Application\Controllers\User\User;

class Details{

    public function showDetails()
    {
        require_once('Templates/Details.php');
        $header = Header::execute();
        require_once($header);
        require_once('Templates/Footer.php');
        require_once('Templates/Layout.php');
    }


}