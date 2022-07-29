<?php

namespace Application\Models\Rights;

require_once ('Database.php');

use Application\Models\Database\Database;

class Rights extends Database
{

    public function getRightsName(mixed $rights): bool|array
    {
        $sql = "SELECT name FROM rights WHERE id = :id_rights";
        $params = [':id_rights' => $rights ];
        $result = $this->selectQuery($sql,  $params);
        return $result->fetchAll();
    }
}