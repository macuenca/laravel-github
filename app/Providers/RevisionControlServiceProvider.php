<?php

namespace App\Providers;

use App\Helpers\GitHubService;
use Illuminate\Support\ServiceProvider;

class RevisionControlServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Helpers\RevisionControlServiceInterface', function() {
            return new GitHubService();
        });
    }

    /**
     * Services provided by the provider
     *
     * @return array
     */
    public function provides()
    {
        return ['App\Helpers\RevisionControlServiceInterface'];
    }
}
