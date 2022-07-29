<?php

namespace Application\Controllers\Rights;

require_once ('Controller.php');
require_once ('Application/Models/Rights.php');


use Application\Controllers\Controller\Controller;
use Application\Models\Rights\Rights as RightsModel;

class Rights extends Controller
{
    public function getRightsName(mixed $rights): array|bool
    {
        return (new RightsModel)->getRightsName($rights);
    }
}