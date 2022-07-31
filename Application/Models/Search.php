<?php

namespace Application\Models\Search;

require_once ('Database.php');


use Application\Models\Database\Database;

class Search extends Database
{

    public function searchAll(mixed $title, mixed $cat, mixed $min, mixed $max, mixed $cond, mixed $year, mixed $ship): bool|array
    {
        $sql = "SELECT * FROM listings WHERE INSTR( title , :title )
             AND  INSTR(id_categories , :id_categories )
             AND price >= :min AND price <= :max
             AND INSTR( obj_condition , :cond )
             AND year >= :year 
             AND INSTR( shipping , :ship ) 
             AND offer_state != 2
             AND offer_state != 3";
            if($min === '' ){ $min = '0'; }
            if($max === '' ){ $max = '1000000'; }
            $params = [':title' => $title, ':id_categories' => $cat , ':min' => $min, ':max' => $max, ':cond' => $cond, ':year' => $year, ':ship' => $ship ];
            $check = $this->selectQuery($sql, $params);
            return $check->fetchAll();
    }

    public function searchAllLikeFirst(mixed $title, mixed $cat, mixed $min, mixed $max, mixed $cond, mixed $year, mixed $ship): bool|array
    {
        $sql = "SELECT * FROM listings WHERE title like :title
             AND id_categories like :id_categories 
             AND price >= :min AND price <= :max
             AND obj_condition like :cond 
             AND year >= :year 
             AND shipping  like :ship 
             AND offer_state != 2
             AND offer_state != 3";
        if($min === '' ){ $min = '0'; }
        if($max === '' ){ $max = '1000000'; }
        $params = [':title' => $title .'%' , ':id_categories' =>  $cat .'%' , ':min' => $min  , ':max' => $max , ':cond' => $cond .'%' , ':year' => '%'. $year .'%', ':ship' => $ship.'%' ];
        $check = $this->selectQuery($sql,$params);
        return $check->fetchAll();
    }

    public function searchAllLikeAll(mixed $title, mixed $cat, mixed $min, mixed $max, mixed $cond, mixed $year, mixed $ship): bool|array
    {
        $sql = "SELECT * FROM listings WHERE title like :title
             AND id_categories like :id_categories 
             AND price >= :min AND price <= :max
             AND obj_condition like :cond 
             AND year >= :year 
             AND shipping  like :ship
             AND offer_state != 2
             AND offer_state != 3";
        if($min === '' ){ $min = '0'; }
        if($max === '' ){ $max = '1000000'; }
        $params = [':title' => '%'. $title .'%' , ':id_categories' => '%'. $cat .'%' , ':min' =>  $min , ':max' => $max  , ':cond' => '%'. $cond .'%' , ':year' => '%'. $year . '%', ':ship' => '%'. $ship.'%' ];
        $check = $this->selectQuery($sql,$params);
        return $check->fetchAll();
    }



}