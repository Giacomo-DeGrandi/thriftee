<?php

namespace Application\Controllers\Condition;

require_once('Application/Models/Condition.php');
require_once('Controller.php');

use Application\Controllers\Controller\Controller;
use Application\Models\Condition\Condition as ConditionModel;

class Condition extends Controller
{
    public function getAllCond(): bool|array
    {
        return (new ConditionModel)->getAllCond();
    }
}