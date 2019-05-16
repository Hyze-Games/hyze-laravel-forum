<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Chatter\Api')
    ->middleware('auth:api')
    ->group(function () {
        Route::post('/parsedown', 'ParsedownController@converter')
            ->name('api.parsedown');

    });

Route::name('chatter.api.')
    ->namespace('Chatter\Api')
    ->group(function () {

        Route::middleware('auth:api')
            ->group(function () {
                Route::post('/forums/{forum}/threads', 'ThreadApiController@store')
                    ->name('forums.threads');

                Route::get('/threads/{thread}/posts', 'ThreadApiController@posts')
                    ->name('threads.posts');

                Route::post('/threads/{thread}/posts', 'PostApiController@store')
                    ->name('threads.posts.store');

                Route::delete('/posts/{post}', 'PostApiController@destroy')
                    ->name('posts.destroy');

                Route::put('/posts/{post}', 'PostApiController@update')
                    ->name('posts.update');

                Route::post('/posts/{post}/replies', 'PostApiController@reply')
                    ->name('posts.replies.store');


            });

        Route::get('/posts/{post}/replies', 'PostApiController@replies')
            ->name('posts.replies');
    });