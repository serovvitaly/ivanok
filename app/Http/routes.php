<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*

Route::group(['middleware' => ['web']], function () {

    Route::any('login', function () {

        $errors = new \Illuminate\Support\MessageBag;

        return view('auth.login', ['errors' => $errors]);
    });

    Route::any('register', function () {

        $errors = new \Illuminate\Support\MessageBag;

        return view('auth.register', ['errors' => $errors]);
    });

    Route::any('password/reset', function () {

        $errors = new \Illuminate\Support\MessageBag;

        return view('auth.passwords.reset', [
            'errors' => $errors,
            'token' => $errors,
        ]);
    });
});
*/
/**
 * Роутинг Административной части
 */
Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth',
    //'namespace' => 'Admin'
], function () {

    Route::get('/', function () {

        return 'Админка';
    });

});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {

    Route::auth();

    /**
     * Временные URL для статей
     * @todo Со временем нужно перенести в БД
     */
    Route::get('/post/1900', function () {

        return view('default.post.post-zootopia');
    });

    Route::get('/', function(){
        return view('welcome', [
            'message' => 'Редактор'
        ]);
    });

    Route::resource('/post', 'PostController');

    Route::get('/post/{post_id}/set-int', 'PostController@setInt');
    Route::get('/post/{post_id}/publish', 'PostController@publish');
    Route::get('/post/{post_id}/unpublish', 'PostController@unpublish');

    Route::get('/home', 'HomeController@index');

    /**
     * Вывод страницы Автора
     */
    Route::get('/author/{author_login}',function($author_login){

        $author = \App\User::where('login', '=', $author_login)->first();

        if ($author) {

            return view('default.author', ['author' => $author]);
        }

        abort(404);
    });

    /**
     * Вывод страницы Поста
     */
    Route::get('/{post_url}',function($post_url){

        $post = \App\Models\PostModel::where('url', '=', '/' . $post_url)->first();

        if ( ! $post ) {
            abort(404);
        }

        $auth_user = \Auth::user();

        if ( ! $post->isPublished() and Gate::denies('update-post', $post) ) {

            abort(404);
        }

        if (!$auth_user or Gate::denies('update-post', $post)) {

            DB::beginTransaction();
            $post->counter++;
            $post->save();
            DB::commit();
        }

        return view('default.post-full', ['post' => $post]);

    })->where('post_url', '.*');
});
