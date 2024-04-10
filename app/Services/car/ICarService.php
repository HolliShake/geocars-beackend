<?php
namespace App\Services\car;

use App\Services\IGenericService;

interface ICarService extends IGenericService {
    function getCarsByUserSubscriptionId($user_subscription_id);
    function getAvailableCarsByUserSubscriptionId($user_subscription_id);
}
