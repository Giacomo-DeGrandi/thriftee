<?php

namespace Application\Controllers\State;

require_once('Application/Models/State.php');

use Application\Controllers\Controller\Controller;
use Application\Models\State\State as StateModel;

class State extends Controller
{
    public function getNameByStateId (int $id) : array
    {
        return (new StateModel)->getNameByStateId($id);
    }

    public function getAllStates(): bool|array
    {
        return (new StateModel)->getAllStates();
    }

}