<?php

namespace Optimus\Posts\Providers;

use Illuminate\Support\Facades\Route;

class PostServiceProvider extends ServiceProvider
{
    protected $controllerNamespace = 'Optimus\Posts\Http\Controllers';

    public function boot()
    {
        $this->mapAdminRoutes();
    }

    protected function mapAdminRoutes()
    {
        Route::prefix('api')
             ->middleware('api', 'auth:api')
             ->namespace($this->controllerNamespace)
             ->group(function () {
                 Route::apiResource('posts', 'PostsController');
                 Route::apiResource('post-tags', 'PostTagsController');
                 Route::apiResource('post-comments', 'PostCommentsController')->except(['store', 'update']);
             });
    }
}
