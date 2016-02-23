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

/**
 * Группа Роутов для авторизованных пользователей
 */
Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', function(){
        return view('welcome', [
            'message' => 'Редактор'
        ]);
    });

    Route::resource('/post', 'PostController');

    Route::get('/post-create', 'PostController@getCreatingForm');

    Route::get('/home', 'HomeController@index');
});

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

    Route::get('/{post_url}',function($post_url){

        $post = \App\Models\PostModel::where('url', '=', '/' . $post_url)->first();

        if ($post) {

            DB::beginTransaction();
            $post->counter++;
            $post->save();
            DB::commit();

            return view('default.post-full', ['post' => $post]);
        }

        abort(404);

    })->where('post_url', '.*');
});
