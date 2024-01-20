<?php

namespace App\Http\Controllers;

use App\Services\user_subscription\IUserSubscriptionService;

class UserSubscriptionController extends ControllerBase
{
    function __construct(IUserSubscriptionService $service) {
        parent::__construct($service);
    }

    function getUserSubscriptionByUserId($user_id) {
        return $this->service->getUserSubscriptionByUserId($user_id);
    }

    function getUserSubscription($user_subscription_id) {
        return $this->genericGet($user_subscription_id);
    }

    function getCurrentUserSubscription() {
        $user_id = auth()->user()->id;
        return $this->service->getUserSubscriptionByUserId($user_id);
    }

    function createUserSubscription() {
        return $this->genericCreate();
    }

    function updateUserSubscription($user_subscription_id) {
        return $this->genericUpdate($user_subscription_id);
    }

    function deleteUserSubscription($user_subscription_id) {
        return $this->genericDelete($user_subscription_id);
    }

    //
    function subscribeAttempt($subscription_id) {
        $user_id = auth()->user()->id;
        $data = [
            'user_id' => $user_id,
            'subscription_id' => $subscription_id,
            'is_active' => true
        ];

        $result = $this->service->create($data);

        return ($result)
            ? $this->created($result)
            : $this->badRequest([ 'message' => 'Subscription failed!' ]);
    }

    function createRules()
    {
        return [
            'user_id' => 'required|numeric',
            'subscription_id' => 'required|numeric',
        ];
    }
}
