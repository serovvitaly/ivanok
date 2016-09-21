<?php

namespace App\Http\Widget;
use Illuminate\Routing\Controller;

/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 13.04.2016
 * Time: 22:48
 */
abstract class Widget extends Controller
{
    abstract public function getContent();
}