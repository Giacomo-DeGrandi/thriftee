<?php

namespace Application\Models\SubCategories;



use Application\Models\Database\Database;

Class SubCategories extends Database
{
    public function getAllSubCategories()
    {
        $sql = "SELECT * FROM sub_categories";
        $result = $this->selectQuery($sql);
        return $result->fetchAll();
    }

    public function getAllSubCategoriesByCat(mixed $subCat)
    {
        $sql = "SELECT * FROM sub_categories WHERE id_categories = :id";
        $params = [':id' => $subCat ];
        $result = $this->selectQuery($sql,  $params);
        return $result->fetchAll();
    }
}