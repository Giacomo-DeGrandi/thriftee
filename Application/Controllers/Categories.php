<?php

namespace Application\Controllers\Categories;

require_once('Controller.php');
require_once ('Application/Models/Categories.php');

use Application\Controllers\Controller\Controller;
use Application\Models\Categories\Categories as CatModel;

class Categories extends Controller
{

    public function getAllCategories(): bool|array
    {
        return (new CatModel)->getAllCategories();
    }
}