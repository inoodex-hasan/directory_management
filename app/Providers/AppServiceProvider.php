<?php

namespace App\Providers;

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
        \Illuminate\Pagination\Paginator::useBootstrapFive();

        \Illuminate\Support\Facades\View::composer('frontend.layouts.right_sidebar', function ($view) {
            $view->with('sidebar_links', \App\Models\Link::where('status', 'approved')->orderBy('created_at', 'desc')->take(5)->get());
            $view->with('sidebar_blogs', \App\Models\Blog::where('is_published', '1')->orderBy('created_at', 'desc')->take(5)->get());
        });
    }
}
