<?php

namespace App\Providers;

use DB;
use Log;
use App\User;
use App\Posts;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Relation::morphMap(
            [
                'posts' => Posts::class,
                'users' => User::class
            ]
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        DB::listen(function ($event) {
            Log::info('_______sql______', [Str::replaceArray('?', $event->bindings, $event->sql)]);
        });
    }
}
