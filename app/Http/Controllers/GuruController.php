<?php

namespace App\Http\Controllers;

use App\Models\NewPostModel;
use Illuminate\Http\Request;

use App\Http\Requests;

class GuruController extends Controller
{
    public function getIndex()
    {
        //var_dump(\App\Helpers\AuthHelper::getUserKey());

        return view('guru.index');
    }

    public function getPost($post_id)
    {
        $post = NewPostModel::findOrFail($post_id);

        return view('guru.post', ['post' => $post]);
    }
}
