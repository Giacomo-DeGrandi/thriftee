<?php

namespace Application\Models\Condition;

require_once('Database.php');

use Application\Models\Database\Database;

class Condition extends Database
{
    public function getAllCond(): bool|array
    {
        $sql= 'SELECT * FROM conditions ' ;
        $check = $this->selectQuery($sql);
        return $check->fetchAll();
    }
}