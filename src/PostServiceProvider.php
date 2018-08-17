<?php

namespace Optimus\Posts;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Optimus\Posts\Http\Requests\PostRequest;

class PostServiceProvider extends ServiceProvider
{
    protected $controllerNamespace = 'Optimus\Posts\Http\Controllers';

    public function boot()
    {
        // Migrations
        $this->loadMigrationsFrom(
            __DIR__ . '/../../database/migrations'
        );

        // Config
        $this->publishes([
            __DIR__ . '/../../config/post.php' => config_path('post.php')
        ], 'config');

        $this->mapAdminRoutes();

        // Todo: Bind overridable classes to ones specified in the config file.
        // $this->app->bind(PostRequest::class, config('post.requests.posts'));
    }

    protected function mapAdminRoutes()
    {
        Route::prefix('api')
             ->middleware('api', 'auth:admin')
             ->namespace($this->controllerNamespace)
             ->group(function () {
                 Route::apiResource('posts', 'PostsController');
                 Route::apiResource('post-categories', 'CategoriesController');
                 Route::apiResource('post-comments', 'CommentsController')->except([
                     'store', 'update'
                 ]);
             });
    }
}
