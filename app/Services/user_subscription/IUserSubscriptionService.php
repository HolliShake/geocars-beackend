<?php
namespace App\Services\user_subscription;

use App\Services\IGenericService;

interface IUserSubscriptionService extends IGenericService {
    function getUserSubscriptionByUserId($user_id);
}
