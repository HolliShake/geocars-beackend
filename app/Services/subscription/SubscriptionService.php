<?php
namespace App\Services\subscription;

use App\Models\Subscription;
use App\Services\GenericService;

class SubscriptionService extends GenericService implements ISubscriptionService {

    function __construct() {
        parent::__construct(Subscription::class);
    }

}
