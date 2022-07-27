<?php

namespace Application\Models\Categories;

require_once('Database.php');

use Application\Models\Database\Database;

class Categories extends Database
{

    public function getAllCatsName(): bool|array
    {
        $sql = "SELECT * FROM categories";
        $result = $this->selectQuery($sql);
        return $result->fetchAll();
    }

}