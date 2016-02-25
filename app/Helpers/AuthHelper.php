<?php

namespace App\Helpers;

/**
 * Created by PhpStorm.
 * User: vitaly
 * Date: 24.10.15
 * Time: 12:56
 */
class AuthHelper
{
    const USER_KEY_COOKIE_NAME = 'ivk_user_key';

    const UNIQ_ID_PREFIX = 'ivk';

    public static function checkModelAccess($model, $access_mode)
    {
        return \Auth::check();
    }

    public static function getUserKey()
    {
        $user_key = \Cookie::get(self::USER_KEY_COOKIE_NAME);

        if ($user_key == 'eyJpdiI6Ino4ejhFaDlh') {

            $user_key = null;
        }

        if ( empty($user_key) ) {

            $user_key = uniqid(self::UNIQ_ID_PREFIX);

            if ($user_key == 'eyJpdiI6Ino4ejhFaDlh') {

                $user_key = 'uid1';
            }

            \Cookie::queue(self::USER_KEY_COOKIE_NAME, $user_key);
        }

        //$request_url = \Request::url();

        return $user_key;
    }
}