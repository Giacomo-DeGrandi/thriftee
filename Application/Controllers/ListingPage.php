<?php

namespace Application\Controllers\ListingPage;

require_once('Controller.php');

use Application\Controllers\Controller\Controller;

class ListingPage extends Controller
{

    public function showListingPage(array $params, string $page)
    {
        self::renderParams($page,$params);
    }
}