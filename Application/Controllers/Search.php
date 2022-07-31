<?php

namespace Application\Controllers\Search;

require_once ('Controller.php');
require_once ('Application/Models/Search.php');

use Application\Controllers\Controller\Controller;
use Application\Models\Search\Search as SearchModel;

class Search extends Controller
{

    public function showSearchPage(array $params, string $page)
    {
        self::renderParams($page, $params);
    }


    public function searchAll(mixed $title, mixed $cat, mixed $min, mixed $max, mixed $cond, mixed $year, mixed $ship): bool|array
    {
        return (new SearchModel())->searchAll($title, $cat, $min, $max, $cond, $year, $ship);
    }

    public function searchAllLikeFirst(mixed $title, mixed $cat, mixed $min, mixed $max, mixed $cond, mixed $year, mixed $ship): bool|array
    {
        return (new SearchModel())->searchAllLikeFirst($title, $cat, $min, $max, $cond, $year, $ship);

    }

    public function searchAllLikeAll(mixed $title, mixed $cat, mixed $min, mixed $max, mixed $cond, mixed $year, mixed $ship): bool|array
    {
        return (new SearchModel())->searchAllLikeAll($title, $cat, $min, $max, $cond, $year, $ship);
    }


}
//        return (new SearchModel)->searchNav();























