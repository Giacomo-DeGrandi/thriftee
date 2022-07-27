<?php

namespace Application\Models\Shipping;

require_once('Database.php');

use Application\Models\Database\Database;

class Shipping extends Database
{

    public function getAllShipNames(): bool|array
    {
        $sql= 'SELECT * FROM shipping ; ' ;
        $check = $this->selectQuery($sql);
        return $check->fetchAll();
    }
}
