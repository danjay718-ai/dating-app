<?php

namespace App\Providers;

use App\Models\Conversation;
use App\Models\Profile;
use App\Policies\ConversationPolicy;
use App\Policies\ProfilePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register Policies
        // This tells Laravel: "When authorizing actions on a Profile model,
        // use ProfilePolicy. Same for Conversation → ConversationPolicy."
        Gate::policy(Profile::class, ProfilePolicy::class);
        Gate::policy(Conversation::class, ConversationPolicy::class);
    }
}
