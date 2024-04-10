<?php
namespace App\Services\user_subscription;

use App\Models\UserSubscription;
use App\Services\GenericService;

class UserSubscriptionService extends GenericService implements IUserSubscriptionService {
    function __construct() {
        parent::__construct(UserSubscription::class);
    }

    function getUserSubscriptionByUserId($user_id) {
        return $this->model::with('subscription')->where('user_id', $user_id)->get();
    }

    function getSelectedUserSubscription($user_id) {
        return $this->model::with('subscription')->where('user_id', $user_id)->where('is_selected', 1)->first();
    }
}
