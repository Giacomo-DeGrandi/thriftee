<?php

namespace Application\Models\Listing;

require_once('Database.php');

use Application\Models\Database\Database;

class Listing extends Database
{

    public function registerListing(mixed $id, mixed $title, mixed $price, mixed $category, mixed $subCat, mixed $description, mixed $cond, mixed $ship, mixed $year, mixed $newFilepath1, mixed $newFilepath2, mixed $newFilepath3, mixed $newFilepath4)
    {
        $datenow = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `listings` ( `id_owner`,`title`, `id_categories`, `id_subcategories`, `img_url_1`, `img_url_2`, `img_url_3`, `img_url_4`, `obj_condition`, `shipping`, `year`, `description`, `price`, `added_on`, `views`) VALUES ( :id_owner, :title, :id_categories, :id_subcategories, :img_url_1, :img_url_2, :img_url_3, :img_url_4, :obj_condition, :shipping, :year, :description, :price, :added_on, :views)";
        $params = ([':id_owner' => $id,':title' => $title , ':id_categories' => $category, ':id_subcategory' => $subCat, ':img_url_1' => $newFilepath1, ':img_url_2' => $newFilepath2,  ':img_url_3' => $newFilepath3,  ':img_url_4' => $newFilepath4, ':obj_condition' => $cond, ':shipping' => $ship, ':year' => $year, ':description' => $description, ':price' => $price, ':added_on' => $datenow, ':views' => 0 ]);
        $this->selectQuery($sql, $params);
    }
}
