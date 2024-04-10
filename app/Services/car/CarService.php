<?php
namespace App\Services\car;

use App\Models\Car;
use App\Services\GenericService;

class CarService extends GenericService implements ICarService {

    function __construct() {
        parent::__construct(Car::class);
    }

    function get($id) {
        return $this->model::with('car_photo')->find($id);
    }

    function getCarsByUserSubscriptionId($user_subscription_id) {
        return $this->model::with('car_photo')->where('user_subscription_id', $user_subscription_id)->get();
    }

    function getAvailableCarsByUserSubscriptionId($user_subscription_id) {
        return $this->model::with('car_photo')->where('user_subscription_id', $user_subscription_id)->where('units_left', '>', 0)->get();
    }

}
