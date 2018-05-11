<?php

namespace Optimus\Posts\Providers;

use Illuminate\Support\Facades\Route;

class PostServiceProvider extends ServiceProvider
{
    protected $controllerNamespace = 'Optimus\Posts\Http\Controllers';

    public function boot()
    {
        // Todo

        $this->mapAdminRoutes();
    }

    protected function mapAdminRoutes()
    {
        Route::prefix('api')
             ->middleware('admin')
             ->namespace($this->controllerNamespace)
             ->group(function () {
                 Route::apiResource('posts', 'PostsController');
                 Route::apiResource('post-tags', 'PostTagsController');

                 Route::get('post-comments', 'PostCommentsController@index');
                 Route::get('post-comments/{id}', 'PostCommentsController@show');
                 Route::delete('post-comments/{id}', 'PostCommentsController@destroy');
             });
    }
}
