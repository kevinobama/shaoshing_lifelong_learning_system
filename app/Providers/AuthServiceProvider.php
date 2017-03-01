<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
//use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
        Passport::routes();

        //Passport::tokensExpireIn(Carbon::now()->addDays(15));
        //Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
        Passport::tokensCan([
            'read'  => 'Read access to user account',
            'write' => 'Write access to user account',
            'email' => 'Send emails',
        ]);
    }
}