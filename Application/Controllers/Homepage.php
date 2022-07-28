<?php

namespace Application\Controllers\Homepage;

require_once('Header.php');
require_once('Controller.php');

use Application\Controllers\Controller\Controller;
use Application\Controllers\Header\Header;

class Homepage extends Controller {

    public function showHome($params){
        self::renderParams('Homepage',$params);
    }
}
