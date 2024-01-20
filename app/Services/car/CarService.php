
<?php

use App\Models\Car;
use App\Services\GenericService;

class CarService extends GenericService implements ICarService {

    function __construct() {
        parent::__construct(Car::class);
    }

    function getCarsByUserSubscriptionId($user_subscription_id) {
        return $this->model::with([
            'user_subscription' => function($query) {
                $query->with([
                    'user' => function($query) {
                        $query->with('user_access');
                    },
                    'subscription' => function($query) {
                        $query->with('subscription_type');
                    }
                ]);
            }
        ])->whereRaw('car.user_subscription.subscription_id', '=', $user_subscription_id)->get();
    }

}
