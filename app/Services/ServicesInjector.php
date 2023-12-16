<?php

namespace App\Services;

use App\Services\auth\AuthService;
use App\Services\auth\IAuthService;
use App\Services\user_access\IUserAccessService;
use App\Services\user_access\UserAccessService;

class ServicesInjector
{
    public static function inject($app)
    {
        $app->bind(IAuthService::class, AuthService::class);
        $app->bind(IUserAccessService::class, UserAccessService::class);
    }
}
