<?php

namespace App\Http\Controllers;

use App\Services\car_posting\ICarPostingService;
use Illuminate\Http\Request;

class CarPostingController extends ControllerBase
{
    public function __construct(ICarPostingService $service) {
        parent::__construct($service);
    }

    public function getAllCarPostings() {
        return $this->genericGetAll();
    }

    public function getActiveCarPostingsByUserSubscriptionId($user_subscription_id) {
        return $this->service->getActiveCarPostingsByUserSubscriptionId($user_subscription_id);
    }

    public function getExpiredCarPostingsByUserSubscriptionId($user_subscription_id) {
        return $this->service->getExpiredCarPostingsByUserSubscriptionId($user_subscription_id);
    }

    public function getCarPosting($car_posting_id) {
        return $this->genericGet($car_posting_id);
    }

    public function createCarPosting(Request $request) {
        return $this->genericCreate($request);
    }

    public function updateCarPosting(Request $request, $car_posting_id) {
        return $this->genericUpdate($request, $car_posting_id);
    }

    public function deleteCarPosting($car_posting_id) {
        return $this->genericDelete($car_posting_id);
    }

    function createRules()
    {
        return [
            'car_id' => 'required|numeric|exists:car,id',
            'price' => 'required|numeric',
            'excess_charges' => 'required|numeric',
            'days' => 'required|numeric',
            'post_date' => 'required|date',
            'expiry_date' => 'required|date',
            'never_expires' => 'required|boolean',
        ];
    }
}
