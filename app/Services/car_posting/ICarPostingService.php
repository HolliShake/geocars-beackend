<?php

namespace App\Services\car_posting;

use App\Services\IGenericService;

interface ICarPostingService extends IGenericService {
    function getActiveCarPostingsByUserSubscriptionId($user_subscription_id);
    function getExpiredCarPostingsByUserSubscriptionId($user_subscription_id);
}
