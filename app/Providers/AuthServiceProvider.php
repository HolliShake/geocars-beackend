<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $ROLE = [
            'admin',
            'renter',
            'lender'
        ];

        $OPERATION = [
            "read",
            "create",
            "update",
            "delete",
        ];

        $rules = [];

        foreach ($ROLE as $module) {
            foreach ($OPERATION as $operation) {
                $rules[$module . "-can-" . $operation] = $module . " can " . $operation;
            }
        }

        Passport::tokensCan([
            ...$rules,
        ]);
    }
}
