<?php

namespace Application\Models\State;

require_once('Database.php');

use Application\Models\Database\Database;

class State extends Database
{
    public function getNameByStateId(int $id): bool|array
    {
        $sql= 'SELECT state_name FROM state WHERE id = :id ; ' ;
        $params = [':id' => $id ];
        $check = $this->selectQuery($sql,$params);
        return $check->fetchAll();
    }
}