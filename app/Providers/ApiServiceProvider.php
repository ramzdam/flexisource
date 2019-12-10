<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Jobs\RetrievePlayerDetail;
use App\Services\ApiService;


class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Http\Interfaces\ApiInterface',
            'App\Http\Services\ApiService'
        );

        // $this->app->bindMethod(RetrievePlayerDetail::class.'@handle', function ($job, $app) {
        //     return $job->handle($app->make(ApiService::class));
        // });
    }
}
