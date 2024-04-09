<?php

namespace App\Services;

use App\Services\auth\AuthService;
use App\Services\auth\IAuthService;
use App\Services\car\CarService;
use App\Services\car\ICarService;
use App\Services\car_photo\CarPhotoService;
use App\Services\car_photo\ICarPhotoService;
use App\Services\subscription\ISubscriptionService;
use App\Services\subscription\SubscriptionService;
use App\Services\user\IUserService;
use App\Services\user\UserService;
use App\Services\user_access\IUserAccessService;
use App\Services\user_access\UserAccessService;
use App\Services\user_subscription\IUserSubscriptionService;
use App\Services\user_subscription\UserSubscriptionService;

class ServicesInjector
{
    public static function inject($app)
    {
        $app->bind(IAuthService::class, AuthService::class);
        $app->bind(IUserService::class, UserService::class);
        $app->bind(IUserAccessService::class, UserAccessService::class);
        $app->bind(ICarService::class, CarService::class);
        $app->bind(ICarPhotoService::class, CarPhotoService::class);
        $app->bind(ISubscriptionService::class, SubscriptionService::class);
        $app->bind(IUserSubscriptionService::class, UserSubscriptionService::class);
    }
}


