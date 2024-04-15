<?php

namespace App\Http\Controllers;

use App\Services\subscription\ISubscriptionService;

class SubscriptionController extends ControllerBase
{
    function __construct(ISubscriptionService $service) {
        parent::__construct($service);
    }

    function getAllSubscriptions() {
        return $this->genericGetAll();
    }

    function getSubscription($subscription_id) {
        return $this->genericGet($subscription_id);
    }

    function createSubscription() {
        return $this->genericCreate();
    }

    function updateSubscription($subscription_id) {
        return $this->genericUpdate($subscription_id);
    }

    function deleteSubscription($subscription_id) {
        return $this->genericDelete($subscription_id);
    }

    function createRules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'max_cars' => 'required|numeric',
            'is_analytics_enabled' => 'required|boolean',
            'is_tracking_enabled' => 'required|boolean',
            'is_search_priority' => 'required|boolean',
            'tracking_interval_in_minutes' => 'required|numeric',
        ];
    }

}
