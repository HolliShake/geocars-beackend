<?php

namespace App\Services\car_posting;

use App\Models\CarPosting;
use App\Services\GenericService;

class CarPostingService extends GenericService implements ICarPostingService {
    function __construct() {
        parent::__construct(CarPosting::class);
    }
}
