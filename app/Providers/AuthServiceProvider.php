<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\{Admin, Card, Game};
use App\Policies\{AdminPolicy, CardPolicy, GamePolicy};

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
        Game::class => GamePolicy::class,
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
