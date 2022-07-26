<?php

namespace Application\Models\Listing;

require_once('Database.php');

use Application\Models\Database\Database;

class Listing extends Database
{

    public function registerListing(mixed $id, mixed $title, mixed $price, mixed $category, mixed $subCat,
                                    mixed $description, mixed $cond, mixed $ship, mixed $year, mixed $newFilepath1,
                                    mixed $newFilepath2, mixed $newFilepath3, mixed $newFilepath4)
    {
        $datenow = date('Y-m-d H:i:s');

        $sql = "INSERT INTO `listings` ( `id_owner`,`title`, `id_categories`, `id_subcategories`, `img_url_1`, 
                        `img_url_2`, `img_url_3`, `img_url_4`, `obj_condition`, `shipping`, `year`, `description`, 
                        `price`, `added_on`, `views`, `offer_state`) 
                        VALUES ( :id_owner, :title, :id_categories, :id_subcategories, :img_url_1, :img_url_2, 
                                :img_url_3, :img_url_4, :obj_condition, :shipping, :year, :description, :price, 
                                :added_on, :views, :offer_state)";

        $params = ([':id_owner' => $id,':title' => $title , ':id_categories' => $category, ':id_subcategories' => $subCat,
            ':img_url_1' => $newFilepath1, ':img_url_2' => $newFilepath2,  ':img_url_3' => $newFilepath3,
            ':img_url_4' => $newFilepath4, ':obj_condition' => $cond, ':shipping' => $ship, ':year' => $year,
            ':description' => $description, ':price' => $price, ':added_on' => $datenow, ':views' => 0 , ':offer_state' => 1]); // state 1 = ACTIVE

        $this->selectQuery($sql, $params);
    }

    public function getAllListingByUser(mixed $id): bool|array
    {
        $sql= 'SELECT * FROM listings WHERE id_owner = :id_owner ; ' ;
        $params = [':id_owner' => $id ];
        $check = $this->selectQuery($sql,$params);
        return $check->fetchAll();
    }
}
