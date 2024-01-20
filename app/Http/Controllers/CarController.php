<?php

namespace App\Http\Controllers;

use CarService;

class CarController extends ControllerBase
{
    function __construct(CarService $service) {
        parent::__construct($service);
    }
}
