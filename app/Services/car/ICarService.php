<?php

use App\Services\IGenericService;

interface ICarService extends IGenericService {
    function getCarsByUserSubscriptionId($user_subscription_id);
}
