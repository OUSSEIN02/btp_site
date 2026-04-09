<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Message;


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
       
        Schema::defaultStringLength(191);

        // 🔔 Notifications = messages non lus
        View::composer('*', function ($view) {
            $view->with([
                'unreadMessagesCount' => Message::where('is_read', false)->count(),
                'lastUnreadMessages'  => Message::where('is_read', false)
                                                ->latest()
                                                ->take(5)
                                                ->get(),
            ]);
        });
    }
}
