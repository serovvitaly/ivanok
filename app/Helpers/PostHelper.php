<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 22.02.2016
 * Time: 12:06
 */

namespace App\Helpers;


class PostHelper
{


    public static function getPosts()
    {
        $auth_user = \Auth::user();

        if ($auth_user and $auth_user->isSuperAdmin()) {

            //return \App\Models\PostModel::orderBy('created_at', 'DESC')->paginate();
            return \App\Models\PostModel::where('is_published', '=', 1)->orderBy('counter', 'DESC')->paginate();
        }

        return \App\Models\PostModel::where('is_actual', '=', 1)->where('is_published', '=', '1')->orderBy('counter', 'DESC')->paginate();
    }
}