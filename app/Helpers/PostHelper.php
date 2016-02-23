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
        return \App\Models\PostModel::where('is_actual', '=', 1)->paginate();
    }
}