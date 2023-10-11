<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\{Admin, Card, Duel};
use App\Policies\{AdminPolicy, CardPolicy, DuelPolicy};

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Card::class => CardPolicy::class,
        Duel::class => DuelPolicy::class,
        Admin::class => AdminPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
