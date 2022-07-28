<?php

namespace Application\Controllers;

require_once('Controller.php');
require_once('Application/Models/SubCategories.php');

use Application\Controllers\Controller\Controller;
use Application\Models\SubCategories\SubCategories as SubCat;

class SubCategories extends Controller
{

    public function getAllSubCategoriesByCat(mixed $subCat): bool|array
    {
        return (new SubCat)->getAllSubCategoriesByCat($subCat);
    }

    public function getAllSubCats(): bool|array
    {
        return (new SubCat)->getAllSubCats();
    }
}