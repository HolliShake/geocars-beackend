<?php

namespace App\Http\Controllers;

use App\Services\car_posting\ICarPostingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function createCarPosting() {
        return $this->genericCreate();
    }

    public function updateCarPosting($car_posting_id) {
        $validator = Validator::make(request()->all(), $this->updateRules());

        if ($validator->fails()) {
            return $this->badRequest([ 'validation' => $validator->errors() ]);
        }

        $old = $this->service->get($car_posting_id);

        if (!$old) {
            return $this->notFound([ 'message' => 'Item not found!' ]);
        }

        $updated = (object) array_merge((array) $old, request()->all());
        $uresult = $this->service->update($updated);

        return ($uresult)
        ? $this->ok($this->service->get($car_posting_id))
        : $this->badRequest([ 'message' => 'Failed to update item!' ]);
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
