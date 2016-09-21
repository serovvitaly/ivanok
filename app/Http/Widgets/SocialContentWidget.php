<?php

namespace App\Http\Widget;

/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 13.04.2016
 * Time: 22:48
 */
class SocialContentWidget extends Widget
{

    public function getContent()
    {
        $html = '';

        return ['success' => true, 'html' => $html];
    }
}