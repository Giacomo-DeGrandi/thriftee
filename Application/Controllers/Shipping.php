<?php
namespace Application\Controller\Shipping;

require_once('Controller.php');
require_once('Application/Models/Shipping.php');

use Application\Controllers\Controller\Controller;
use Application\Models\Shipping\Shipping as ShippingModel;

class Shipping extends Controller
{

    public function getAllShipNames(): bool|array
    {
       return (new ShippingModel)->getAllShipNames();
    }
}