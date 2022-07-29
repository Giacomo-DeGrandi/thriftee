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

    protected static function renderParams(string $page, mixed $params)
    {
        $requested = $params;
        $rights = end($requested); // rights are always at the end of the array
        if(is_array($rights)){
            $header = 'Header'.ucfirst($rights[0]['name']);
        } else {
            $header = 'Header'.ucfirst($rights);
        }
        $chunks  = array_chunk($params, 1);
        require_once('Templates/'.$page.'.php');
        require_once('Templates/'.$header.'.php');
        require_once('Templates/Footer.php');
        require_once('Templates/Layout.php');
    }
}