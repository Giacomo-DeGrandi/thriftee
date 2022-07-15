<?php

namespace Application\Controllers\Homepage;

require_once('Header.php');

use Application\Controllers\Header\Header;

class Homepage
{
    public function execute()
    {
        $header = Header::execute();
        require_once ($header);
        require_once('Templates/Homepage.php');
        require_once('Templates/Footer.php');
        require_once('Templates/Layout.php');
    }
}
