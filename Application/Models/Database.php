<?php

namespace Application\Models\Database;


use PDO;

Abstract Class Database{

    private $conn;

    function connect(){

        /*
        $server="localhost:3306";
        $username="digitree";
        $password="@LaPlateforme92.@";
        $database="carlo-de-grandi-giacomo_little_discord";*/

        $server="localhost";
        $username="root";
        $password="";
        $database="thriftee";

        $dsn = "mysql:host=$server;dbname=$database;charset=UTF8";
        $this->conn = new PDO($dsn, $username, $password);
        return $this->conn;
    }

    function selectQuery($sql, $p = null){
        if ($p === null) {
            $r = $this->connect()->query($sql);
        } else {
            $r = $this->connect()->prepare($sql);
            $r -> execute($p);
        }
        return $r;
    }

}