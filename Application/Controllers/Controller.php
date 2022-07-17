<?php

namespace Application\Controllers\Controller;


Class Controller{

    public static function render($page)
    {
        require_once('Templates/'.$page.'.php');
        require_once('Templates/Header.php');
        require_once('Templates/Footer.php');
        require_once('Templates/Layout.php');
    }
}