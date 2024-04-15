<?php

namespace App\Services\car_posting;

use App\Models\CarPosting;
use App\Services\GenericService;

class CarPostingService extends GenericService implements ICarPostingService {
    function __construct() {
        parent::__construct(CarPosting::class);
    }

    public function getActiveCarPostingsByUserSubscriptionId($user_subscription_id) {
        return $this->model::with('car')
            ->where('post_date', '<=', now())
            ->where('expiry_date', '>=', now())
            ->whereHas('car', function($query) use ($user_subscription_id) {
                // car units left is not zero
                $query
                    ->where('units_left', '>', 0)
                    ->where('user_subscription_id', $user_subscription_id)
                    ->where('never_expires', true);
            })
            ->get();
    }

    public function getExpiredCarPostingsByUserSubscriptionId($user_subscription_id) {
        return $this->model::with('car')
            ->where('expiry_date', '<=', now())
            ->whereHas('car', function($query) use ($user_subscription_id) {
                // car units left is not zero
                $query
                    ->where('units_left', '>', 0)
                    ->where('user_subscription_id', $user_subscription_id)
                    ->where('never_expires', false);
            })
            ->get();
    }
}
