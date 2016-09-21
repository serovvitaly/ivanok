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

Route::get('phpinfo', function(Request $request){

    phpinfo();
});

Route::controller('/guru', 'GuruController');

Route::get('mem', function(){

    $memcached = new Memcached;

    $memcached->addServer('127.0.0.1', '11211');

    #$memcached->deleteMulti($memcached->getAllKeys());

    return json_encode($memcached->getAllKeys());
});

Route::get('/redirect/{base64url}', function($base64url){

    DB::table('redirect_log')->insert(
        [
            'url' => base64_decode($base64url),
            //'user_id' => 0,
            'user_key' => \App\Helpers\AuthHelper::getUserKey(),
            'http_referer' => Request::server('HTTP_REFERER')
        ]
    );
});

Route::get('/img/{width}x{height}/{img_file_name}', function($width, $height, $img_file_name){

    $img_dir = public_path('img/');

    $origin_dir = public_path('img/origin/');

    $origin_file_path = $origin_dir . $img_file_name;

    /**
     * @var \Intervention\Image\Image $img
     */
    if ( ! file_exists($origin_file_path) ) {

        $img = Image::make($img_dir . 'empty.jpg');

        Log::warning('Не найден орегинал изображения, файл - ' . $origin_file_path);

        return $img->response('jpg');
    }

    $img = Image::make($origin_file_path);

    $img->resize($width, $height);

    $new_file_dir = $img_dir . $width . 'x' . $height . '/';

    if ( ! file_exists($new_file_dir) ) {

        mkdir($new_file_dir);
    }

    $file_predir = substr($img_file_name, 0, 3);

    if ( ! file_exists($new_file_dir . $file_predir) ) {

        mkdir($new_file_dir . $file_predir);
    }

    $img->save($new_file_dir . $img_file_name);

    return $img->response('jpg');

})->where('img_file_name', '.*');



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


Route::group(['middleware' => 'web'], function () {

    Route::auth();

    /**
     * Возвращает виджет с социальным контентом
     */
    Route::get('/social-content', '\App\Http\Widget\SocialContentWidget@getContent');

    /**
     * Отслеживание пользователей Вконтакте
     */
    Route::post('/regclient', function () {

        DB::table('social_register')->insert([
            'session_id' => Session::getId(),
            'user_id' => '',
            'ip_address' => Request::ip(),
            'login' => trim(Request::get('vk_login')),
            'user_data' => trim(Request::get('user_data')),
            'snet' => 'VK',
        ]);

        return ['success' => true];
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

        //    DB::beginTransaction();
        //    $post->counter++;
        //    $post->save();
        //    DB::commit();
        }

        return view('default.post-full', ['post' => $post]);

    })->where('post_url', '.*');
});
